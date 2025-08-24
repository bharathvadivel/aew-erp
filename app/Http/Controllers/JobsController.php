<?php

namespace App\Http\Controllers;

use App\Models\JobCard;
use App\Models\PModel;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactImport;
use App\Imports\ContactUpdateImport;
use App\DataTables\StateDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ExportState;


class JobsController extends Controller
{
    function add_job_card()
    {   
        $employees = DB::table('employees')->orderBy('id', 'desc')->get();
        return view('logics.manufacture.job_cards.add_job_card', compact('employees'));
    }

    function job_card_master()
    {   
        $job_cards = DB::table('job_cards')->orderBy('id', 'desc')->get();
        return view('logics.manufacture.job_cards.job_card_master', compact('job_cards'));
    }

    function department_wise_master()
    {   
        $department="all";
        $job_cards = DB::table('job_cards')->orderBy('id', 'desc')->get();
        return view('logics.manufacture.job_cards.department_wise_master', compact('job_cards','department'));
    }

    public function department_wise_master_filter(Request $request)
    {
        $department=$request->department_list;
        
        $job_cards = JobCard::where('worked_dept', '=', $department)->orderBy('id', 'desc')->get();

        return view('logics.manufacture.job_cards.department_wise_master', compact('job_cards', 'department'));
    }

    function job_card_store(Request $request)
    {   
        $employee_id = $request->employee_id;
        $job_date = $request->job_date;
        $worked_dept = $request->department;
        $nature_of_work = $request->nature_of_work;
        $model_code = $request->model_code;
        $assigned_qty = $request->assigned_qty;
        $approved_qty = $request->approved_qty;
        $defective_qty = $request->defective_qty;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $remarks = $request->remarks;

        $input['employee_id'] = $employee_id;
        $input['job_date'] = date('Y-m-d', strtotime($job_date));
        $input['worked_dept'] = $worked_dept;
        $input['nature_of_work'] = $nature_of_work;
        $input['model_code'] = $model_code;
        $input['assigned_qty'] = $assigned_qty;
        $input['approved_qty'] = $approved_qty;
        $input['defective_qty'] = $defective_qty;
        $input['start_time'] = date('H:i:s', strtotime($start_time));
        $input['end_time'] = date('H:i:s', strtotime($end_time));
        $input['remarks'] = $remarks;

        $datas = JobCard::create($input);

        if ($datas) {
            if ($worked_dept == "Packing") {
                // Find the job card by model code
                $pModelUpdate = PModel::where('model_code', $model_code)->first();

                if (!$pModelUpdate) {
                    return redirect()->back()->with('error', 'Job Card created but Model Code not found: ' . $model_code);
                }else{
                    // Fetch current fully_assembled_qty
                    $current_qty = $pModelUpdate->fully_assembled_qty;
                    
                    // Add the approved_qty to current_qty
                    $new_qty = $current_qty + $approved_qty;
                    
                    if ($pModelUpdate) {
                        // Update fully_assembled_qty
                        $pModelUpdate->update(['fully_assembled_qty' => $new_qty]);
                    
                        return redirect()->to('job_card_master')->with('success', 'Job Card created and FAG stock updated! Previous Qty: ' . $current_qty . ', New Qty: ' . $new_qty);
                    } else {
                        return redirect()->back()->with('error', 'Job Card created but failed to update FAG stock! Model Code: ' . $model_code . 'and '. $current_qty . ', New Qty: ' . $new_qty);
                    }
                }
            } else {
                return redirect()->to('job_card_master')->with('success', 'Job Card created!');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please try again!');
        }
    }

    function job_card_delete($id)
    {
        $ch = DB::table('job_cards')->where('id', $id)->delete();
        $remember =   isset($ch) ?  redirect()->back()->with('error', 'Job Card Removed!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function job_card_edit($id)
    {
        $employee_id = $id;
        $employees = DB::table('employees')->orderBy('id', 'desc')->get();
        $job_card = JobCard::where('id', $id)->first();

        return view('logics.manufacture.job_cards.edit_job_card', compact('job_card', 'employees', 'employee_id'));
    }

    public function job_card_update(Request $request)
    {
        $job_id = $request->job_id;
        
        // Fetch input values
        $assigned_qty = (int) $request->assigned_qty;
        $approved_qty = (int) $request->approved_qty;
        $defective_qty = (int) $request->defective_qty;

        // Validation: Ensure sum of approved and defective does not exceed assigned
        if (($approved_qty + $defective_qty) > $assigned_qty) {
            return redirect()->route('job.card.edit', ['id' => $job_id])
                ->withInput()
                ->with('error', 'Total of Approved and Defective Quantity cannot exceed Assigned Quantity.');
        }

        // Prepare data for update
        $input = [
            'employee_id' => $request->employee_id,
            'job_date' => date('Y-m-d', strtotime($request->job_date)),
            'worked_dept' => $request->worked_dept,
            'nature_of_work' => $request->nature_of_work,
            'model_code' => $request->model_code,
            'assigned_qty' => $assigned_qty,
            'approved_qty' => $approved_qty,
            'defective_qty' => $defective_qty,
            'start_time' => date('H:i:s', strtotime($request->start_time)),
            'end_time' => date('H:i:s', strtotime($request->end_time)),
            'remarks' => $request->remarks,
        ];

        // Find the job card by ID and update
        $jobcard = JobCard::find($job_id);
        
        if ($jobcard) {
            $jobcard->update($input);
            return redirect()->to('job_card_master')->with('success', 'Job Card Updated!');
        } else {
            return redirect()->back()->with('error', 'Job Card Not Found!');
        }
    }


    function import_job_card()
    {   
        return view('logics.manufacture.job_cards.job_cards_import');
    }

    function import_jobcard_store(Request $request)
    {
        if ($request->hasFile('job_cards_data')) {
            $extension = $request->file('job_cards_data')->getClientOriginalExtension();
            if ($extension == "csv") {
                $data = Excel::import(new ContactImport, $request->file('job_cards_data'));

                $remember = isset($data) ? redirect()->back()->with('success', 'Job Cards and Details Added!') : redirect()->back()->with('warning', 'Failed to import Job Cards & Details!');
                
                return $remember;
            } else {
                return redirect()->back()->with('error', 'Not Valid or No File Found!.');
            }
        } else {
            return redirect()->back()->with('error', 'Not Valid or No File Found!.');
        }
    }
}
