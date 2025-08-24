<?php
namespace App\Http\Controllers;

use App\Models\Routing;
use App\Models\RoutingDetail;
use App\Models\FinancialYear;
use App\Models\DocOrder;

use App\Imports\RoutingImport;
use App\Imports\RoutingDetailImport;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class RoutingController extends Controller
{
    public function index()
    {
        $fy = FinancialYear::orderBy('id', 'desc')->first();
        $start_year = $fy->fy_start_year;
        $end_year = $fy->fy_end_year;

        $financial_year = $start_year.$end_year;

        $routing = DocOrder::where('fy_id', $fy->id)->first();
        
        $routing_no = 'LB-R-'.$financial_year.'-'.$routing->routing_no;
        
        return view('logics.manufacture.routing.add_routing', compact('routing_no'));
    }

    public function routing_item_insert(Request $request)
    {   
        $material_code = $request->material_code;
        $opt_name = $request->opt_name;
        $opt_desc = $request->opt_desc;

        $input['material_code'] = $material_code;
        $input['operation_name'] = $opt_name;
        $input['operation_desc'] = $opt_desc;

        $datas = RoutingDetail::create($input);

        if($datas){
            $output = '
            <tr>
                <td>
                    <input hidden class="id1 form-control" type="text" name="id1" id="id1" value="'.$datas->id.'"/>
                    <input style="background: #e0e0e0;" class="opt_name1 form-control" type="text" name="opt_name1" id="opt_name1" value="'.$opt_name.'" readonly>
                </td>
                <td><input style="background: #e0e0e0;" class="opt_desc1 form-control" type="text" name="opt_desc1" id="opt_desc1" value="'.$opt_desc.'" readonly></td>
                <td class="editc">
                    <a class="delete-row"><i data-placement="top" title="Delete" class="fa fa-trash" style="color:white; background: red; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                </td>
            </tr>
            ';

            $return = array("status" =>true,'output'=>$output);
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular added failed','output'=>'');
            return json_encode($return);
        }
        
    }

    public function routing_item_remove(Request $request)
    {
        $id = $request->id;
        $material_code = $request->material_code;

        $datas = RoutingDetail::where('id', $id)->delete();

        if($datas){
            $return = array("status" =>true,'output'=>'');
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular deletion failed','output'=>'');
            return json_encode($return);
        }
    }

    public function routing_store(Request $request)
    {
        $routing_code = $request->routing_code;
        $routing_name = $request->routing_name;
        $note = $request->input('forRoutingDescription');
        
        $input['routing_code'] = $routing_code;
        $input['routing_name'] = $routing_name;
        $input['note'] = $note;
        

        $datas = Routing::create($input);

        if($datas){
            $fy = FinancialYear::orderBy('id', 'desc')->first();
            $increment_r_no = DB::table('doc_orders')->where('fy_id', $fy->id)->increment('routing_no');

            if($increment_r_no){
                return redirect()->to('routing_master')->with('success', 'Routing Created!');
            }else {
                return redirect()->back()->with('warning', 'Routing Created! Without Incrementing Routing Count');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    public function routing_master()
    {
        
        $material = DB::table('materials')->where('deleted_status', '0')->orderBy('id', 'desc')->get();
        
        return view('logics.manufacture.routing.routing_master', compact('material'));
    }

    public function routing_edit($material_code)
    {
        $routing =  DB::table('routings')->where('material_code', $material_code)->first();
        $routing_details =  DB::table('routing_details')->where('material_code', $material_code)->get();
        $material = DB::table('materials')->where('deleted_status', '0')->where('material_code', $material_code)->first();

        return view('logics.manufacture.routing.routing_edit', compact('material_code', 'routing', 'routing_details', 'material'));
    }

    public function routing_update(Request $request)
    {
        $material_code = $request->material_code;
        $converted_item_code = $request->converted_item_code;
        $note = $request->input('forRoutingDescription');
        
        $input['material_code'] = $material_code;
        $input['converted_to_item_code'] = $converted_item_code;
        $input['note'] = $note;
        
        // Find the existing routing by material code
        $routing = Routing::where('material_code', $material_code)->first();

        if ($routing) {
            // If routing found, update the existing record
            $routing->update($input);
            return redirect()->to('routing_master')->with('success', 'Routing Updated!');
        } else {
            // If routing not found, create a new record
            Routing::create($input);
            return redirect()->to('routing_master')->with('success', 'New Routing Created!');
        }
    }

    public function routing_delete($routing_code)
    {
        $routing_details = DB::table('routing_details')->where('routing_code', $routing_code)->get();

        $inv_items = DB::table('routings')->where('routing_code', $routing_code)->delete();
        $inv_del = DB::table('routing_details')->where('routing_code', $routing_code)->delete();

        $remember =   isset($inv_del) ? redirect()->back()->with('error', 'Routing deleted successfully!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    function import_routing()
    {   
        return view('logics.manufacture.routing.import_routing');
    }

    function import_routing_data(Request $request)
    {
        if ($request->hasFile('routing_data')) {
            $extension = $request->file('routing_data')->getClientOriginalExtension();
            if ($extension == "csv") {
                try {
                    $data = Excel::import(new RoutingImport, $request->file('routing_data'));

                    // Check if RoutingImport was successful
                    if ($data) {
                        // Continue with RoutingDetailImport
                        $detailImport = new RoutingDetailImport();
                        $detailData = Excel::import($detailImport, $request->file('routing_data'), null, \Maatwebsite\Excel\Excel::CSV);
                        if($detailData){
                            return redirect()->back()->with('success', 'Routing and Its Details Import Success!');
                        }else {
                            return redirect()->back()->with('warning', 'Something went wrong during Routing Details import. Please try again!');
                        }
                    } else {
                        $remember = redirect()->back()->with('warning', 'Something went wrong during Routing import. Please try again!');
                    }

                    return $remember;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
                }
            } else {
                return redirect()->back()->with('error', 'Not Valid or No File Found!.');
            }
        } else {
            return redirect()->back()->with('error', 'Not Valid or No File Found!.');
        }
    }
        
    public function financialyear()
    {
        $financial_year_to = (date('m') > 3) ? date('y') +1 : date('y');
        $financial_year_from = $financial_year_to - 1;
        $financial_year= $financial_year_from.$financial_year_to;
        return $financial_year;
    }

}
