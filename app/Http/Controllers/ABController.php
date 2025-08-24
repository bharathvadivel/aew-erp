<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PModel;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\InvoicePaymentDetail;
use App\Models\AssemblyBill;
use App\Models\AssemblyBillDetail;
use App\Models\FinancialYear;
use App\Models\DocOrder;

use App\Imports\AssemblyBillImport;
use App\Imports\AssemblyBillDetailImport;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class ABController extends Controller
{
    public function index()
    {
        $fy = FinancialYear::orderBy('id', 'desc')->first();
        $start_year = $fy->fy_start_year;
        $end_year = $fy->fy_end_year;

        $financial_year = $start_year.$end_year;

        $ab_order = DocOrder::where('fy_id', $fy->id)->first();
        
        $invoice_no = 'LB-AB-'.$financial_year.'-'.$ab_order->assembly_bill_no;
        
        return view('logics.manufacture.assembly_bill.add_ab', compact('invoice_no'));
    }

    public function ab_itemcode_select(Request $request)
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

    public function ab_product_select(Request $request)
    {
        $itemType = $request->itemType;
        $model_no = $request->model_no;

        if($itemType == 'SPG'){
            $row = Material::where('material_code', $model_no)->first();
            if($row->total_stock_qty > 0){
                $val = array(
                    "itemType" => $itemType,
                    "item_code" => $row->material_code, 
                    "item_desc" => $row->material_desc,
                    "totalQty" => $row->total_stock_qty,
                    "uom" => $row->uom,
                );
            } else {
                $val = array(
                    "error" => "No stock available"
                );
            }
        }
        else if($itemType == 'FAG'){
            $row = PModel::where('model_code', $model_no)->first();
            if($row->fully_assembled_qty >= 0){
                $val = array(
                    "itemType" => $itemType,
                    "item_code" => $row->model_code, 
                    "item_desc" => $row->model_desc,
                    "totalQty" => $row->fully_assembled_qty,
                    "uom" => $row->uom
                );
            } else {
                $val = array(
                    "error" => "No stock available"
                );
            }
            
        }
        return json_encode($val);
    }

    public function ab_item_insert(Request $request)
    {   
        $invoiceNo = $request->invoiceNo;
        $invoiceDate = $request->invoiceDate;
        $itemType = $request->itemType;
        $itemCode = $request->itemCode;
        $itemDesc = $request->itemDesc;
        $qty = $request->qty;

        $input['invoice_no'] = $invoiceNo;
        $input['invoice_date'] = $invoiceDate;
        $input['item_type'] = $itemType;
        $input['item_code'] = $itemCode;
        $input['item_desc'] = $itemDesc;
        $input['item_qty'] = $qty;

        if($itemType == "SPG"){
            $qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
            $subtractQty = $qty_select->total_stock_qty-$qty;
            $qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$subtractQty));
        } else if($itemType == "FAG"){
            $qty_select = DB::table('p_models')->where('model_code', $itemCode)->first();
            $subtractQty = $qty_select->fully_assembled_qty-$qty;
            $qty_update = DB::table('p_models')->where('model_code', $itemCode)->update(array('fully_assembled_qty'=>$subtractQty));
        }

        $datas = AssemblyBillDetail::create($input);

        if($datas){
            $output = '
            <tr>
                <td>
                    <input style="display: none; background: #e0e0e0;" class="itemType3" type="text" name="itemType3" id="itemType3" value="'.$itemType.'">
                    <input style="background: #e0e0e0;" class="item_code1 form-control" type="text" name="item_code1" id="item_code1" value="'.$itemCode.'" readonly>
                </td>
                <td><input style="background: #e0e0e0;" class="item_desc1 form-control" type="text" name="item_desc1" id="item_desc1" value="'.$itemDesc.'" readonly></td>
                <td>
                    <input style="background: #e0e0e0;" class="qty1 form-control" type="text" name="qty1" id="qty1" value="'.$qty.'" readonly>
                </td>
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

    public function ab_item_remove(Request $request)
    {
        $invoiceNo = $request->invoiceNo;
        $itemType = $request->itemType;
        $itemCode = $request->itemCode;
        $qty = $request->qty;

        if($itemType == "SPG"){
            $qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
            $addQty = $qty_select->total_stock_qty+$qty;
            $qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$addQty));
        } else if($itemType == "FAG"){
            $qty_select = DB::table('p_models')->where('model_code', $itemCode)->first();
            $addQty = $qty_select->fully_assembled_qty+$qty;
            $qty_update = DB::table('p_models')->where('model_code', $itemCode)->update(array('fully_assembled_qty'=>$addQty));
        }

        $datas = AssemblyBillDetail::where('invoice_no', $invoiceNo)->where('item_code', $itemCode)->delete();

        if($datas){
            $return = array("status" =>true,'output'=>'');
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular added failed','output'=>'');
            return json_encode($return);
        }
    }

    public function ab_store(Request $request)
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
        

        $datas = AssemblyBill::create($input);

        if($datas){
            $fy = FinancialYear::orderBy('id', 'desc')->first();
            $increment_ab_no = DB::table('doc_orders')->where('fy_id', $fy->id)->increment('assembly_bill_no');

            if($increment_ab_no){
                return redirect()->to('ab_master')->with('success', 'Assembly Bill Created!');
            }else {
                return redirect()->back()->with('warning', 'Assembly Bill Created! Without Incrementing Assembly Bill Count');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    public function ab_master()
    {
        $invoices = DB::table('assembly_bills')->orderBy('id', 'desc')->get();
        
        // Fetch all details once
        $invoice_details = DB::table('assembly_bill_details')->get();
    
        // Group details by invoice_no and count qty
        $details_grouped = $invoice_details->groupBy('invoice_no')->map(function ($items) {
            return $items->count();
        });
    
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d');
    
        return view('logics.manufacture.assembly_bill.ab_master', compact(
            'invoices', 'details_grouped', 'from_date', 'to_date'
        ));
    }


    public function ab_master_filter(Request $request)
    {
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        
        $invoices = AssemblyBill::whereDate('invoice_date', '>=', $from_date)
            ->whereDate('invoice_date', '<=', $to_date)
            ->orderBy('id', 'desc')
            ->get();

        return view('logics.manufacture.assembly_bill.ab_master', compact('invoices', 'from_date', 'to_date'));
    }

    public function ab_edit($invoice_no)
    {
        $invoices =  DB::table('assembly_bills')->where('invoice_no', $invoice_no)->first();
        $invoice_details =  DB::table('assembly_bill_details')->where('invoice_no', $invoice_no)->get();

        return view('logics.manufacture.assembly_bill.ab_edit', compact('invoice_no', 'invoices', 'invoice_details'));
    }

    public function ab_update(Request $request)
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
        $invoice = AssemblyBill::where('invoice_no', $invoice_no)->first();

        if ($invoice) {
            $invoice->update($input);
            return redirect()->to('ab_master')->with('success', 'Assembly Bill Updated!');
        } else {
            return redirect()->back()->with('error', 'Assembly Bill not found!');
        }
    }

    public function ab_delete($invoice_no)
    {
        $invoice_details = DB::table('assembly_bill_details')->where('invoice_no', $invoice_no)->get();

        foreach ($invoice_details as $sets=>$vl) {    
            if($vl->item_type == "SPG"){
                $qty_select = DB::table('materials')->where('material_code', $vl->item_code)->first();
                $addQty = $qty_select->total_stock_qty+$vl->item_qty;
                $qty_update = DB::table('materials')->where('material_code', $vl->item_code)->update(array('total_stock_qty'=>$addQty));
            } else if($vl->item_type == "FAG"){
                $qty_select = DB::table('p_models')->where('model_code', $vl->item_code)->first();
                $addQty = $qty_select->fully_assembled_qty+$vl->item_qty;
                $qty_update = DB::table('p_models')->where('model_code', $vl->item_code)->update(array('fully_assembled_qty'=>$addQty));
            }
        }

        $inv_items = DB::table('assembly_bills')->where('invoice_no', $invoice_no)->delete();
        $inv_del = DB::table('assembly_bill_details')->where('invoice_no', $invoice_no)->delete();

        $remember =   isset($inv_del) ? redirect()->back()->with('error', 'Assembly bill deleted successfully!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    function import_abill_list()
    {   
        return view('logics.manufacture.assembly_bill.add_abill_list');
    }

    function import_abills(Request $request)
    {
        if ($request->hasFile('a_bills')) {
            $extension = $request->file('a_bills')->getClientOriginalExtension();
            if ($extension == "csv") {
                try {
                    $data = Excel::import(new AssemblyBillImport, $request->file('a_bills'));

                    // Check if AssemblyBillImport was successful
                    if ($data) {
                        // Continue with AssemblyBillDetailImport
                        $detailImport = new AssemblyBillDetailImport();
                        $detailData = Excel::import($detailImport, $request->file('a_bills'), null, \Maatwebsite\Excel\Excel::CSV);
                        if($detailData){
                            $fy = FinancialYear::orderBy('id', 'desc')->first();
                            $increment_ab_no = DB::table('doc_orders')->where('fy_id', $fy->id)->increment('assembly_bill_no');
                            $remember = isset($increment_ab_no) ? redirect()->back()->with('success', 'Assembly Bills and Details Added!') : redirect()->back()->with('warning', 'Assembly Bill Created! Without Incrementing Assembly Bill Count');
                        }else {
                            return redirect()->back()->with('warning', 'Failed to import Assembly Bill Details!');
                        }

                        
                    } else {
                        $remember = redirect()->back()->with('warning', 'Something went wrong during Assembly Bill import. Please try again!');
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

    public function ab_print($invoice_no)
    {
        $scpinvoice = DB::table('scp_invoices')
        ->join('services', 'services.service_id', '=', 'scpinvoices.scp_id')
        ->where('scpinvoices.scp_invoice_no', $scp_invoice_no)
        ->orderBy('scpinvoices.id', 'desc')
        ->get(['scpinvoices.*', 'services.name', 'services.gstin_no', 'services.service_center_name', 'services.state', 'services.phone']);

        return view('logics.manufacture.assembly_bill.ab_print', compact('scpinvoices'));
    }

    public function generate_invoice_pdf($invoice_no)
    {
        $invoices = DB::table('invoices')->where('invoice_no', $invoice_no)->orderBy('id', 'desc')->first();

        return view('logics.manufacture.assembly_bill.ab_stream_pdf', compact('invoices', 'invoice_no'));
    }

        
    public function financialyear()
    {
        $financial_year_to = (date('m') > 3) ? date('y') +1 : date('y');
        $financial_year_from = $financial_year_to - 1;
        $financial_year= $financial_year_from.$financial_year_to;
        return $financial_year;
    }

}
