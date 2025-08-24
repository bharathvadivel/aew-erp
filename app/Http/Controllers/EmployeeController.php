<?php

namespace App\Http\Controllers;

use App\Models\Employee;

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


class EmployeeController extends Controller
{
    function add_employee()
    {
        return view('logics.manufacture.employees.add_employee');
    }

    function employee_master()
    {
        $employees = DB::table('employees')->orderBy('id', 'desc')->get();
        return view('logics.manufacture.employees.employee_master', compact('employees'));
    }

    public function get_individual_employee_data(Request $request){
        $emp_id = $request->emp_id;
        $emp_info = Employee::where('id', $emp_id)->get();
        return json_encode($emp_info);
    }

    function employee_store(Request $request)
    {
        $employee_no = $request->empNo;
        $employee_name = $request->empName;
        $department = $request->department;
        $designation = $request->designation;
        $date_of_joining = $request->doj;
        $qualification = $request->qualification;
        $work_period = $request->workingPeriod;

        $address = $request->input('address');
        $mail_id = $request->email;
        $contact_no = $request->contactNo;
        $emergency_contact_no = $request->emcontactNo;
        $dob = $request->dob;
        $blood_group = $request->bloodGroup;

        $aadhaar_number = $request->aadhaar;
        $pan_number = $request->pan;
        $esi_number = $request->esi;
        $pf_uan_number = $request->pfUan;

        $bank_name = $request->bankName;
        $bank_branch = $request->bankBranch;
        $bank_account_number = $request->accNo;
        $bank_ifsc_code = $request->ifsc;
        
        $input['employee_no'] = $employee_no;
        $input['employee_name'] = $employee_name;
        $input['department'] = $department;
        $input['designation'] = $designation;
        $input['date_of_joining'] = date('Y-m-d', strtotime("$date_of_joining"));
        $input['qualification'] = $qualification;
        $input['work_period'] = $work_period;
        
        $input['address'] = $address;
        $input['mail_id'] = $mail_id;
        $input['contact_no'] = $contact_no;
        $input['emergency_contact_no'] = $emergency_contact_no;
        $input['dob'] = date('Y-m-d', strtotime("$dob"));
        $input['blood_group'] = $blood_group;

        $input['aadhaar_number'] = $aadhaar_number;
        $input['pan_number'] = $pan_number;
        $input['esi_number'] = $esi_number;
        $input['pf_uan_number'] = $pf_uan_number;

        $input['bank_name'] = $bank_name;
        $input['bank_branch'] = $bank_branch;
        $input['bank_account_number'] = $bank_account_number;
        $input['bank_ifsc_code'] = $bank_ifsc_code;
        

        $datas = Employee::create($input);

        if($datas){
            return redirect()->to('employee_master')->with('success', 'Employee Created!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    function employee_delete($id)
    {
        $ch = DB::table('employees')->where('id', $id)->delete();
        $remember =   isset($ch) ?  redirect()->back()->with('error', 'Employee Removed!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function employee_edit($id)
    {
        $employee = Employee::where('id', $id)->first();
        return view('logics.manufacture.employees.edit_employee', compact('employee'));
    }

    public function employee_update(Request $request)
    {
        $e_id = $request->id;

        $employee_no = $request->empNo;
        $employee_name = $request->empName;
        $department = $request->department;
        $designation = $request->designation;
        $date_of_joining = $request->doj;
        $qualification = $request->qualification;
        $work_period = $request->workingPeriod;

        $address = $request->input('address');
        $mail_id = $request->email;
        $contact_no = $request->contactNo;
        $emergency_contact_no = $request->emcontactNo;
        $dob = $request->dob;
        $blood_group = $request->bloodGroup;

        $aadhaar_number = $request->aadhaar;
        $pan_number = $request->pan;
        $esi_number = $request->esi;
        $pf_uan_number = $request->pfUan;

        $bank_name = $request->bankName;
        $bank_branch = $request->bankBranch;
        $bank_account_number = $request->accNo;
        $bank_ifsc_code = $request->ifsc;
        
        $input['employee_no'] = $employee_no;
        $input['employee_name'] = $employee_name;
        $input['department'] = $department;
        $input['designation'] = $designation;
        $input['date_of_joining'] = date('Y-m-d', strtotime("$date_of_joining"));
        $input['qualification'] = $qualification;
        $input['work_period'] = $work_period;
        
        $input['address'] = $address;
        $input['mail_id'] = $mail_id;
        $input['contact_no'] = $contact_no;
        $input['emergency_contact_no'] = $emergency_contact_no;
        $input['dob'] = date('Y-m-d', strtotime("$dob"));
        $input['blood_group'] = $blood_group;

        $input['aadhaar_number'] = $aadhaar_number;
        $input['pan_number'] = $pan_number;
        $input['esi_number'] = $esi_number;
        $input['pf_uan_number'] = $pf_uan_number;

        $input['bank_name'] = $bank_name;
        $input['bank_branch'] = $bank_branch;
        $input['bank_account_number'] = $bank_account_number;
        $input['bank_ifsc_code'] = $bank_ifsc_code;

        // Find the existing employee by ID and update the record
        $employee = Employee::where('id', $e_id)->first();

        if ($employee) {
            $employee->update($input);
            return redirect()->to('employee_master')->with('success', 'Employee Updated!');
        } else {
            return redirect()->back()->with('error', 'Employee not found!');
        }
        
    }

    function import_employee_list()
    {   
        return view('logics.manufacture.employees.employee_import');
    }

    function import_employee_store(Request $request)
    {
        if ($request->hasFile('employees_data')) {
            $extension = $request->file('employees_data')->getClientOriginalExtension();
            if ($extension == "csv") {
                $data = Excel::import(new ContactImport, $request->file('employees_data'));

                $remember = isset($data) ? redirect()->back()->with('success', 'Employee and Details Added!') : redirect()->back()->with('warning', 'Failed to import Employee Details!');
                
                return $remember;
            } else {
                return redirect()->back()->with('error', 'Not Valid or No File Found!.');
            }
        } else {
            return redirect()->back()->with('error', 'Not Valid or No File Found!.');
        }
    }
}
