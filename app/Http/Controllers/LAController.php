<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PModel;
use App\Models\LossItem;
use App\Models\LossItemDetail;
use App\Models\FinancialYear;
use App\Models\DocOrder;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class LAController extends Controller
{
    public function index()
    {
        $fy = FinancialYear::orderBy('id', 'desc')->first();
        $start_year = $fy->fy_start_year;
        $end_year = $fy->fy_end_year;

        $financial_year = $start_year.$end_year;

        $la = DocOrder::where('fy_id', $fy->id)->first();
        
        $invoice_no = 'LB-LA-'.$financial_year.'-'.$la->loss_no;
        
        return view('logics.manufacture.loss_and_adjustments.add_la', compact('invoice_no'));
    }

    public function la_master()
    {
        
        $invoices =  DB::table('loss_items')->orderBy('id', 'desc')->get();
        $invoice_details =  DB::table('loss_item_details')->get();
        
        return view('logics.manufacture.loss_and_adjustments.la_master', compact('invoices', 'invoice_details'));
    }

    public function la_itemcode_select(Request $request)
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

    public function la_product_select(Request $request)
    {
        $itemType = $request->itemType;
        $model_no = $request->model_no;

        if($itemType == 'SPG'){
            $row = Material::where('material_code', $model_no)->first();
            if($row->total_stock_qty >= 0){
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

    public function la_item_insert(Request $request)
    {   
        $invoiceNo = $request->invoiceNo;
        $invoiceDate = $request->invoiceDate;
        $itemType = $request->itemType;
        $itemCode = $request->itemCode;
        $itemDesc = $request->itemDesc;
        $qty = $request->qty;
        $operation_name = $request->operation_name;
        $remarks = $request->remarks;

        $input['invoice_no'] = $invoiceNo;
        $input['invoice_date'] = $invoiceDate;
        $input['item_type'] = $itemType;
        $input['item_code'] = $itemCode;
        $input['item_desc'] = $itemDesc;
        $input['item_qty'] = $qty;
        $input['operation_name'] = $operation_name;
        $input['remarks'] = $remarks;

        if($itemType == "SPG"){
            $qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
            $subtractQty = $qty_select->total_stock_qty-$qty;
            $qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$subtractQty));
        } else if($itemType == "FAG"){
            $qty_select = DB::table('p_models')->where('model_code', $itemCode)->first();
            $subtractQty = $qty_select->fully_assembled_qty-$qty;
            $qty_update = DB::table('p_models')->where('model_code', $itemCode)->update(array('fully_assembled_qty'=>$subtractQty));
        }

        $datas = LossItemDetail::create($input);

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
                <td><input style="background: #e0e0e0;" class="operation_name1 form-control" type="text" name="operation_name1" id="operation_name1" value="'.$operation_name.'" readonly></td>
                <td><input style="background: #e0e0e0;" class="remarks1 form-control" type="text" name="remarks1" id="remarks1" value="'.$remarks.'" readonly></td>
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

    public function la_item_remove(Request $request)
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

        $datas = LossItemDetail::where('invoice_no', $invoiceNo)->where('item_code', $itemCode)->delete();

        if($datas){
            $return = array("status" =>true,'output'=>'');
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular added failed','output'=>'');
            return json_encode($return);
        }
    }

    public function la_store(Request $request)
    {
        $invoice_no = $request->invoice_no;
        $invoice_date = $request->invoice_date;
        $client_note = $request->input('forClientNote');
        
        $input['invoice_no'] = $invoice_no;
        $input['invoice_date'] = date('Y-m-d', strtotime("$invoice_date"));
        $input['client_note'] = $client_note;
        

        $datas = LossItem::create($input);

        if($datas){
            $fy = FinancialYear::orderBy('id', 'desc')->first();
            $increment_mb_no = DB::table('doc_orders')->where('fy_id', $fy->id)->increment('loss_no');

            if($increment_mb_no){
                return redirect()->to('mb_master')->with('success', 'Loss Record Created!');
            }else {
                return redirect()->back()->with('warning', 'Loss Record Created! Without Incrementing Loss Record Count');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    public function la_edit($invoice_no)
    {
        $invoices =  DB::table('loss_items')->where('invoice_no', $invoice_no)->first();
        $invoice_details =  DB::table('loss_item_details')->where('invoice_no', $invoice_no)->get();

        return view('logics.manufacture.loss_and_adjustments.edit_la', compact('invoice_no', 'invoices', 'invoice_details'));
    }

    public function la_update(Request $request)
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
        $invoice = LossItem::where('invoice_no', $invoice_no)->first();

        if ($invoice) {
            $invoice->update($input);
            return redirect()->to('mb_master')->with('success', 'Loss Record Updated!');
        } else {
            return redirect()->back()->with('error', 'Loss Record not found!');
        }
    }

    public function la_delete($invoice_no)
    {
        $invoice_details = DB::table('loss_item_details')->where('invoice_no', $invoice_no)->get();

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

        $inv_items = DB::table('loss_items')->where('invoice_no', $invoice_no)->delete();
        if ($inv_items) {
            $inv_del = DB::table('loss_item_details')->where('invoice_no', $invoice_no)->delete();
        }
        $remember =   isset($inv_del) ? redirect()->back()->with('error', 'Loss Record deleted successfully!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }
        
    public function financialyear()
    {
        $financial_year_to = (date('m') > 3) ? date('y') +1 : date('y');
        $financial_year_from = $financial_year_to - 1;
        $financial_year= $financial_year_from.$financial_year_to;
        return $financial_year;
    }

}
