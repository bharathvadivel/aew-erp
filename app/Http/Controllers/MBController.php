<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PModel;
use App\Models\MachineBill;
use App\Models\MachineBillDetail;
use App\Models\FinancialYear;
use App\Models\DocOrder;
use App\Models\Routing;

use App\Imports\MachineBillImport;
use App\Imports\MachineBillDetailImport;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class MBController extends Controller
{
    public function index()
    {
        $fy = FinancialYear::orderBy('id', 'desc')->first();
        $start_year = $fy->fy_start_year;
        $end_year = $fy->fy_end_year;

        $financial_year = $start_year.$end_year;

        $mb_order = DocOrder::where('fy_id', $fy->id)->first();
        
        $invoice_no = 'LB-MB-'.$financial_year.'-'.$mb_order->machine_bill_no;
        $rc_materials = Material::where('deleted_status', '=', '0')->orderBy('id', 'asc')->get();
        return view('logics.manufacture.machine_bill.add_mb', compact('invoice_no', 'rc_materials'));
    }

    public function mb_itemcode_select(Request $request)
    {
        $item_type = $request->item_type;
        if($item_type=='SPG'){
            $row = Material::where('deleted_status', '=', '0')->orderBy('id', 'asc')->get();
            $output = '<option value="">Click Item to Add</option>';
            foreach ($row as $key => $vl) {
                $output .= '<option value="' . $vl->material_code . '">' . $vl->material_code . ' - ' . $vl->material_desc . '</option>';
            }
        }
        else if($item_type=='FAG'){
            $row = PModel::where('status', '=', 'Enable')->orderBy('id', 'asc')->get();
            $output = '<option value="">Click Item to Add</option>';
            foreach ($row as $key => $vl) {
                $output .= '<option value="' . $vl->model_code . '">' . $vl->model_code . ' - ' . $vl->model_desc . '</option>';
            }
        }
        else{
            $output = 'No Stock Available or Unit Found';
        }
        $val = array("output" => $output, "item_type" => $item_type);
        return json_encode($val);
    }

    public function mb_product_select(Request $request)
    {
        $model_no = $request->model_no;

        $row = Material::where('material_code', $model_no)->first();
        $val = array(
            "item_code" => $row->material_code, 
            "item_desc" => $row->material_desc,
            "item_category" => $row->category, 
            "totalQty" => $row->total_stock_qty,
            "uom" => $row->uom,
        );
        
        return json_encode($val);
    }

    public function mb_process_product_select(Request $request)
    {
        $model_no = $request->model_no;

        $row = Material::where('material_code', $model_no)->first();
        $route_row = Routing::where('material_code', $model_no)->first();
        if ($route_row !== null) {
            if ($row->total_stock_qty >= 0) {
                $val = array(
                    "category" => $row->category,
                    "converted_to_item_code" => $route_row->converted_to_item_code,
                    "qty" => $row->total_stock_qty
                );
            } else {
                $val = array(
                    "error" => "No stock available"
                );
            }
        } else {
            $val = array(
                "error" => "Route not found for material code: $model_no"
            );
        }
        return json_encode($val);
    }

    public function mb_item_insert(Request $request)
    {   
        $invoiceNo = $request->invoiceNo;
        $invoiceDate = $request->invoiceDate;
        $unProcessedItemCode = $request->unprocessed_item_code;
        $unProcessedItemCodeQty = $request->unprocessed_item_code_qty;
        $itemType = $request->itemType;
        $itemCode = $request->itemCode;
        $itemDesc = $request->itemDesc;
        $itemCategory = $request->itemCategory;
        $qty = $request->qty;

        $input['invoice_no'] = $invoiceNo;
        $input['invoice_date'] = $invoiceDate;
        $input['from_item_code'] = $unProcessedItemCode;
        $input['from_item_qty'] = $unProcessedItemCodeQty;
        $input['item_type'] = $itemType;
        $input['item_code'] = $itemCode;
        $input['item_desc'] = $itemDesc;
        $input['item_category'] = $itemDesc;
        $input['item_qty'] = $qty;

        if($itemType == "SPG"){
            $qty_select = DB::table('materials')->where('material_code', $unProcessedItemCode)->first();
            $subtractQty = $qty_select->total_stock_qty-$qty;
            $qty_update = DB::table('materials')->where('material_code', $unProcessedItemCode)->update(array('total_stock_qty'=>$subtractQty));

            $process_qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
            $add_process_qty = $process_qty_select->total_stock_qty+$qty;
            $process_qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$add_process_qty));
        }

        $datas = MachineBillDetail::create($input);

        if($datas){
            $output = '
            <tr>
                <td>
                    <input style="display: none; background: #e0e0e0;" class="itemType3" type="text" name="itemType3" id="itemType3" value="'.$itemType.'">
                    <input style="background: #e0e0e0;" class="item_code1 form-control" type="text" name="item_code1" id="item_code1" value="'.$itemCode.'" readonly>
                </td>
                <td>
                    <input style="background: #e0e0e0;" class="item_desc1 form-control" type="text" name="item_desc1" id="item_desc1" value="'.$itemDesc.'" readonly>
                </td>
                <td>
                    <input style="background: #e0e0e0;" class="itemCategory1 form-control" type="text" name="itemCategory1" id="itemCategory1" value="'.$itemCategory.'" readonly>
                </td>
                <td>
                    <input style="background: #e0e0e0;" class="qty1 form-control" type="text" name="qty1" id="qty1" value="'.$qty.'" readonly>
                </td>
                <td class="editc">
                    <a class="delete-row"><i data-placement="top" title="Delete" class="fa fa-trash" style="color:white; background: red; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                </td>
            </tr>
            ';

            $return = array("status" =>true,'output'=>$output,'subtractQty'=>$subtractQty);
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular added failed','output'=>'');
            return json_encode($return);
        }
        
    }

    public function mb_item_remove(Request $request)
    {
        $invoiceNo = $request->invoiceNo;
        $unProcessedItemCode = $request->unprocessed_item_code;
        $itemType = $request->itemType;
        $itemCode = $request->itemCode;
        $qty = $request->qty;

        if($itemType == "SPG"){
            $qty_select = DB::table('materials')->where('material_code', $unProcessedItemCode)->first();
            $addQty = $qty_select->total_stock_qty+$qty;
            $qty_update = DB::table('materials')->where('material_code', $unProcessedItemCode)->update(array('total_stock_qty'=>$addQty));

            $process_qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
            $subQty = $process_qty_select->total_stock_qty-$qty;
            $process_qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$subQty));
        }

        $datas = MachineBillDetail::where('invoice_no', $invoiceNo)->where('item_code', $itemCode)->delete();

        if($datas){
            $return = array("status" =>true,'output'=>'','updatedQty'=>$addQty);
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular added failed','output'=>'');
            return json_encode($return);
        }
    }

    public function mb_store(Request $request)
    {
        $invoice_no = $request->invoice_no;
        $invoice_date = $request->invoice_date;
        $customer_bill_address = $request->input('forBillingAddress');
        $customer_ship_address = $request->input('forShippingAddress');
        $customer_mobile_no = $request->customer_mobile;
        $client_note = $request->input('forClientNote');
        
        $input['invoice_no'] = $invoice_no;
        $input['invoice_date'] = date('Y-m-d', strtotime("$invoice_date"));
        $input['customer_bill_address'] = $customer_bill_address;
        $input['customer_ship_address'] = $customer_ship_address;
        $input['customer_mobile_no'] = $customer_mobile_no;
        $input['client_note'] = $client_note;
        

        $datas = MachineBill::create($input);

        if($datas){
            $fy = FinancialYear::orderBy('id', 'desc')->first();
            $increment_mb_no = DB::table('doc_orders')->where('fy_id', $fy->id)->increment('machine_bill_no');

            if($increment_mb_no){
                return redirect()->to('mb_master')->with('success', 'Machine Bill Created!');
            }else {
                return redirect()->back()->with('warning', 'Machine Bill Created! Without Incrementing Machine Bill Count');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    public function mb_master()
    {
        $invoices =  DB::table('machine_bills')->orderBy('id', 'desc')->get();
        $invoice_details =  DB::table('machine_bill_details')->get();

        $from_date=date('Y-m-d');
        $to_date=date('Y-m-d');
        
        return view('logics.manufacture.machine_bill.mb_master', compact('invoices', 'invoice_details', 'from_date', 'to_date'));
    }

    public function mb_master_filter(Request $request)
    {
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        
        $invoices = MachineBill::whereDate('invoice_date', '>=', $from_date)
            ->whereDate('invoice_date', '<=', $to_date)
            ->orderBy('id', 'desc')
            ->get();

        return view('logics.manufacture.machine_bill.mb_master', compact('invoices', 'from_date', 'to_date'));
    }

    public function mb_edit($invoice_no)
    {
        $invoices =  DB::table('machine_bills')->where('invoice_no', $invoice_no)->first();
        $invoice_details =  DB::table('machine_bill_details')->where('invoice_no', $invoice_no)->get();
        $rc_materials = Material::where('deleted_status', '=', '0')->orderBy('id', 'asc')->get();

        return view('logics.manufacture.machine_bill.mb_edit', compact('invoice_no', 'invoices', 'invoice_details', 'rc_materials'));
    }

    public function mb_update(Request $request)
    {
        $invoice_no = $request->invoice_no;
        $invoice_date = $request->invoice_date;
        $customer_bill_address = $request->input('forBillingAddress');
        $customer_ship_address = $request->input('forShippingAddress');
        $customer_mobile_no = $request->customer_mobile;
        $client_note = $request->input('forClientNote');
        
        $input['invoice_no'] = $invoice_no;
        $input['invoice_date'] = date('Y-m-d', strtotime("$invoice_date"));
        $input['customer_bill_address'] = $customer_bill_address;
        $input['customer_ship_address'] = $customer_ship_address;
        $input['customer_mobile_no'] = $customer_mobile_no;
        $input['client_note'] = $client_note;
        
        // Find the existing invoice by ID and update the record
        $invoice = MachineBill::where('invoice_no', $invoice_no)->first();

        if ($invoice) {
            $invoice->update($input);
            return redirect()->to('mb_master')->with('success', 'Machine Bill Updated!');
        } else {
            return redirect()->back()->with('error', 'Machine Bill not found!');
        }
    }

    public function mb_delete($invoice_no)
    {
        $invoice_details = DB::table('machine_bill_details')->where('invoice_no', $invoice_no)->get();

        foreach ($invoice_details as $sets=>$vl) {    
            if($vl->item_type == "SPG"){
                $qty_select = DB::table('materials')->where('material_code', $vl->from_item_code)->first();
                $addQty = $qty_select->total_stock_qty+$vl->item_qty;
                $qty_update = DB::table('materials')->where('material_code', $vl->from_item_code)->update(array('total_stock_qty'=>$addQty));

                $process_qty_select = DB::table('materials')->where('material_code', $vl->item_code)->first();
                $sub_process_qty = $process_qty_select->total_stock_qty-$vl->item_qty;
                $process_qty_update = DB::table('materials')->where('material_code', $vl->item_code)->update(array('total_stock_qty'=>$sub_process_qty));
            }
        }

        $inv_items = DB::table('machine_bills')->where('invoice_no', $invoice_no)->delete();
        if ($inv_items) {
            $inv_del = DB::table('machine_bill_details')->where('invoice_no', $invoice_no)->delete();
        }
        $remember =   isset($inv_del) ? redirect()->back()->with('error', 'Machine bill deleted successfully!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    function import_machine_bill_list()
    {   
        return view('logics.manufacture.machine_bill.add_mbill_list');
    }

    function import_machine_bills(Request $request)
    {
        if ($request->hasFile('m_bills')) {
            $extension = $request->file('m_bills')->getClientOriginalExtension();
            if ($extension == "csv") {
                try {
                    $data = Excel::import(new MachineBillImport, $request->file('m_bills'));

                    // Check if MachineBillImport was successful
                    if ($data) {
                        // Continue with MachineBillDetailImport
                        $detailImport = new MachineBillDetailImport();
                        $detailData = Excel::import($detailImport, $request->file('m_bills'), null, \Maatwebsite\Excel\Excel::CSV);
                        
                        if($detailData){
                            $fy = FinancialYear::orderBy('id', 'desc')->first();
                            $increment_mb_no = DB::table('doc_orders')->where('fy_id', $fy->id)->increment('machine_bill_no');
                            $remember = isset($increment_mb_no) ? redirect()->back()->with('success', 'Machine Bills and Details Added!') : redirect()->back()->with('warning', 'Machine Bill Created! Without Incrementing Machine Bill Count');
                        }else {
                            return redirect()->back()->with('warning', 'Failed to import Machine Bill Details!');
                        }

                        
                    } else {
                        $remember = redirect()->back()->with('warning', 'Something went wrong during Machine Bill import. Please try again!');
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

    public function mb_print($invoice_no)
    {
        $scpinvoice = DB::table('scp_invoices')
        ->join('services', 'services.service_id', '=', 'scpinvoices.scp_id')
        ->where('scpinvoices.scp_invoice_no', $scp_invoice_no)
        ->orderBy('scpinvoices.id', 'desc')
        ->get(['scpinvoices.*', 'services.name', 'services.gstin_no', 'services.service_center_name', 'services.state', 'services.phone']);

        return view('logics.manufacture.machine_bill.mb_print', compact('scpinvoices'));
    }

    public function generate_invoice_pdf($invoice_no)
    {
        $invoices = DB::table('invoices')->where('invoice_no', $invoice_no)->orderBy('id', 'desc')->first();

        return view('logics.manufacture.machine_bill.mb_stream_pdf', compact('invoices', 'invoice_no'));
    }

        
    public function financialyear()
    {
        $financial_year_to = (date('m') > 3) ? date('y') +1 : date('y');
        $financial_year_from = $financial_year_to - 1;
        $financial_year= $financial_year_from.$financial_year_to;
        return $financial_year;
    }

}
