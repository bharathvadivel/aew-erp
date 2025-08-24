<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PModel;
use App\Models\Contact;
use App\Models\FinancialYear;
use App\Models\DocOrder;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\DeliveryChallan;
use App\Models\DeliveryChallanDetail;
use App\Models\DCPaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class DCController extends Controller
{
    public function index()
    {
        $fy = FinancialYear::orderBy('id', 'desc')->first();
        $start_year = $fy->fy_start_year;
        $end_year = $fy->fy_end_year;

        $financial_year = $start_year.$end_year;

        $dc_order = DocOrder::where('fy_id', $fy->id)->first();

        $customers = Contact::orderBy('id', 'asc')->get();
        
        $dc_no = 'LB-DC-'.$financial_year.'-'.$dc_order->dc_no;
        
        return view('logics.manufacture.delivery_challans.add_dc', compact('dc_no', 'customers'));
    }

    public function dc_itemcode_select(Request $request)
    {
        $item_type = $request->item_type;
        if($item_type=='SPG'){
            $row = Material::where('deleted_status', '=', '0')->orderBy('id', 'asc')->get();
            $output = '<option value="">Click Item to Add</option>';
            foreach ($row as $key => $vl) {
                $output .= '<option value="' . $vl->material_code . '">' . $vl->material_code . ' - ' . $vl->material_desc . '</option>';
            }
            $val = array("output" => $output, "item_type" => $item_type);
        }
        else if($item_type=='FAG'){
            $row = PModel::where('status', '=', 'Enable')->orderBy('id', 'asc')->get();
            $output = '<option value="">Click Item to Add</option>';
            foreach ($row as $key => $vl) {
                $output .= '<option value="' . $vl->model_code . '">' . $vl->model_code . ' - ' . $vl->model_desc . '</option>';
            }
            $val = array("output" => $output, "item_type" => $item_type);
        }
        else if($item_type=='NSG'){
            $val = array("output" => '', "item_type" => $item_type);
        }
        else{
            $output = 'No Stock Available or Unit Found';
            $val = array("output" => $output, "item_type" => $item_type);
        }
        
        return json_encode($val);
    }

    public function dc_product_select(Request $request)
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

    public function dc_item_insert(Request $request)
    {   
        $dcNo = $request->dcNo;
        $dcDate = $request->dcDate;
        $itemType = $request->itemType;
        $itemCode = $request->itemCode;
        $itemDesc = $request->itemDesc;
        $itemAddlDesc = $request->itemAddlDesc;
        $itemHSNCode = $request->itemHSNCode;
        $itemPrice = $request->itemPrice;
        $qty = $request->qty;
        $uom = $request->uom;
        $itemSubTotal = $request->itemSubTotal;

        $input['dc_no'] = $dcNo;
        $input['dc_date'] = $dcDate;
        $input['item_type'] = $itemType;
        $input['item_code'] = $itemCode;
        $input['item_desc'] = $itemDesc;
        $input['item_additional_desc'] = $itemAddlDesc;
        $input['item_hsnsac_code'] = $itemHSNCode;
        $input['item_price'] = $itemPrice;
        $input['item_qty'] = $qty;
        $input['item_uom'] = $uom;
        $input['item_sub_total'] = $itemSubTotal;

        if($itemType == "SPG"){
            $qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
            $subtractQty = $qty_select->total_stock_qty-$qty;
            $qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$subtractQty));
        } else if($itemType == "FAG"){
            $qty_select = DB::table('p_models')->where('model_code', $itemCode)->first();
            $subtractQty = $qty_select->fully_assembled_qty-$qty;
            $qty_update = DB::table('p_models')->where('model_code', $itemCode)->update(array('fully_assembled_qty'=>$subtractQty));
        }

        $datas = DeliveryChallanDetail::create($input);

        if($datas){
            $output = '
            <tr>
                <td style="max-width:150px;">
                    <input style="display: none; background: #e0e0e0;" class="itemType3" type="text" name="itemType3" id="itemType3" value="'.$itemType.'">
                    <input style="background: #e0e0e0;" class="item_code1 form-control" type="text" name="item_code1" id="item_code1" value="'.$itemCode.'" readonly>
                </td>
                <td>
                    <textarea style="background: #e0e0e0;" class="item_desc1 form-control" type="text" name="item_desc1" id="item_desc1" readonly>'.$itemDesc.'</textarea>
                </td>
                <td>
                    <textarea style="background: #e0e0e0;" class="item_addl_desc1 form-control" type="text" name="item_addl_desc1" id="item_addl_desc1" readonly>'.$itemAddlDesc.'</textarea>
                </td>
                <td style="max-width:150px;">
                    <input style="background: #e0e0e0;" class="item_hsnsac_code1 form-control" type="text" name="item_hsnsac_code1" id="item_hsnsac_code1" value="'.$itemHSNCode.'" readonly>
                </td>
                <td style="max-width:80px;">
                    <input style="background: #e0e0e0;" class="qty1 form-control" type="text" name="qty1" id="qty1" value="'.$qty.'" readonly>
                </td>
                <td style="max-width:80px;">
                    <input style="background: #e0e0e0;" class="item_uom1 form-control" type="text" name="item_uom1" id="item_uom1" value="'.$uom.'" readonly>
                </td>
                <td style="max-width:120px;">
                    <input style="background: #e0e0e0;" class="rate1 form-control" type="text" name="rate1" id="rate1" value="'.$itemPrice.'" readonly>
                </td>
                <td style="max-width:120px;">
                    <input style="background: #e0e0e0;" class="amount1 form-control" type="text" name="amount1" id="amount1" readonly style="border: none;" value="'.$itemSubTotal.'" readonly>
                </td>
                <td class="editc">
                    <a class="delete-row"><i data-placement="top" title="Delete" class="fa fa-trash" style="color:white; background: red; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                </td>
            </tr>
            ';

            $dcData = DB::table('delivery_challan_details')->where('dc_no', $dcNo)->get();

            // Calculate the sum of the 'sub_total' column
            $subTotalSum = $dcData->sum('item_sub_total');
            $return = array("status" =>true,'output'=>$output,'subTotalSum' => $subTotalSum);
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular added failed','output'=>'');
            return json_encode($return);
        }
        
    }

    public function dc_item_remove(Request $request)
    {
        $dcNo = $request->dcNo;
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

        $datas = DeliveryChallanDetail::where('dc_no', $dcNo)->where('item_code', $itemCode)->delete();

        if($datas){
            $dcData = DB::table('delivery_challan_details')->where('dc_no', $dcNo)->get();

            // Calculate the sum of the 'sub_total' column
            $subTotalSum = $dcData->sum('item_sub_total');
            $netTotalSum = $dcData->sum('item_total');
            $gstAveragePercentage = $dcData->avg('item_gst_percent');
            $gstAvgAmount = number_format($subTotalSum*($gstAveragePercentage/100),2);
            $return = array("status" =>true,'output'=>'','subTotalSum'=>$subTotalSum,'netTotalSum'=>$netTotalSum,'gstAveragePercentage'=>$gstAveragePercentage,'gstAvgAmount'=>$gstAvgAmount);
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular added failed','output'=>'');
            return json_encode($return);
        }
    }

    public function dc_store(Request $request)
    {
        $dc_no = $request->dc_no;
        $dc_date = $request->dc_date;
        $customer_id = $request->customer_name;
        $get_customer_name = Contact::where('id', $customer_id)->pluck('customer_name')->first();
        $customer_name = $get_customer_name;
        $customer_bill_address = $request->input('forBillingAddress');
        $customer_ship_address = $request->input('forShippingAddress');
        $customer_mobile_no = $request->customer_mobile;
        $customer_gst_no = $request->customer_gst_no;
        $subtotal = $request->subTotal;
        $client_note = $request->input('forClientNote');
        $remarks = $request->input('forRemarks');
        $terms_of_delivery = $request->input('forTermsofDelivery');
        $forBuyerOrderNo = $request->forBuyerOrderNo;
        $forBuyerOrderDate = $request->forBuyerOrderDate;
        $forDispatchDocNo = $request->forDispatchDocNo;
        $forDispatchedThrough = $request->forDispatchedThrough;
        $forDestination = $request->forDestination;
        
        $input['dc_no'] = $dc_no;
        $input['dc_date'] = date('Y-m-d', strtotime("$dc_date"));
        $input['customer_id'] = $customer_id;
        $input['customer_name'] = $customer_name;
        $input['customer_bill_address'] = $customer_bill_address;
        $input['customer_ship_address'] = $customer_ship_address;
        $input['customer_mobile_no'] = $customer_mobile_no;
        $input['customer_gst_no'] = $customer_gst_no;
        $input['subtotal'] = $subtotal;
        $input['client_note'] = $client_note;
        $input['remarks'] = $remarks;
        $input['terms_of_delivery'] = $terms_of_delivery;
        $input['buyer_order_no'] = $forBuyerOrderNo;
        $input['buyer_order_date'] = $forBuyerOrderDate;
        $input['dispatch_doc_no'] = $forDispatchDocNo;
        $input['dispatch_through'] = $forDispatchedThrough;
        $input['destination'] = $forDestination;
        
        $datas = DeliveryChallan::create($input);

        if($datas){
            $fy = FinancialYear::orderBy('id', 'desc')->first();
            $increment_dc_no = DB::table('doc_orders')->where('fy_id', $fy->id)->increment('dc_no');
            if($increment_dc_no){
                return redirect()->to('dc_master')->with('success', 'Delivery Challan Created!');
            }else {
                return redirect()->back()->with('warning', 'Delivery Challan Created! Without Incrementing DC Count');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    public function dc_master()
    {
        $dcs =  DB::table('delivery_challans')->orderBy('id', 'desc')->get();
        $dc_details =  DB::table('delivery_challan_details')->get();
        $dc_payment_details = DB::table('dc_payment_details')->get();

        $from_date=date('Y-m-d');
        $to_date=date('Y-m-d');
        
        return view('logics.manufacture.delivery_challans.dc_master', compact('dcs', 'dc_details', 'dc_payment_details', 'from_date', 'to_date'));
    }

    public function dc_master_filter(Request $request)
    {
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        
        $dcs = DeliveryChallan::whereDate('dc_date', '>=', $from_date)
            ->whereDate('dc_date', '<=', $to_date)
            ->orderBy('id', 'desc')
            ->get();

        return view('logics.manufacture.delivery_challans.dc_master', compact('dcs', 'from_date', 'to_date'));
    }

    public function dc_edit($dc_no)
    {
        $dcs =  DB::table('delivery_challans')->where('dc_no', $dc_no)->first();
        $dc_details =  DB::table('delivery_challan_details')->where('dc_no', $dc_no)->get();
        $dc_payment_details = DB::table('dc_payment_details')->where('dc_no', $dc_no)->get();
        $customers = Contact::orderBy('id', 'asc')->get();
        $customer_id = Contact::where('id', $dcs->customer_id)->pluck('id')->first();
        return view('logics.manufacture.delivery_challans.dc_edit', compact('dc_no', 'dcs', 'dc_details', 'dc_payment_details', 'customers', 'customer_id'));
    }

    public function dc_update(Request $request)
    {
        $dc_no = $request->dc_no;
        $dc_date = $request->dc_date;
        $customer_id = $request->customer_name;
        $get_customer_name = Contact::where('id', $customer_id)->pluck('customer_name')->first();
        $customer_name = $get_customer_name;
        $customer_bill_address = $request->input('forBillingAddress');
        $customer_ship_address = $request->input('forShippingAddress');
        $customer_mobile_no = $request->customer_mobile;
        $customer_gst_no = $request->customer_gst_no;
        $subtotal = $request->subTotal;
        $net_total = $request->subtotal;
        $client_note = $request->input('forClientNote');
        $remarks = $request->input('forRemarks');
        $terms_of_delivery = $request->input('forTermsofDelivery');
        $forBuyerOrderNo = $request->forBuyerOrderNo;
        $forBuyerOrderDate = $request->forBuyerOrderDate;
        $forDispatchDocNo = $request->forDispatchDocNo;
        $forDispatchedThrough = $request->forDispatchedThrough;
        $forDestination = $request->forDestination;
        
        $input['dc_no'] = $dc_no;
        $input['dc_date'] = date('Y-m-d', strtotime("$dc_date"));
        $input['customer_id'] = $customer_id;
        $input['customer_name'] = $customer_name;
        $input['customer_bill_address'] = $customer_bill_address;
        $input['customer_ship_address'] = $customer_ship_address;
        $input['customer_mobile_no'] = $customer_mobile_no;
        $input['customer_gst_no'] = $customer_gst_no;
        $input['subtotal'] = $subtotal;
        $input['net_total'] = $net_total;
        $input['client_note'] = $client_note;
        $input['remarks'] = $remarks;
        $input['terms_of_delivery'] = $terms_of_delivery;
        $input['buyer_order_no'] = $forBuyerOrderNo;
        $input['buyer_order_date'] = $forBuyerOrderDate;
        $input['dispatch_doc_no'] = $forDispatchDocNo;
        $input['dispatch_through'] = $forDispatchedThrough;
        $input['destination'] = $forDestination;
        
        // Find the existing invoice by ID and update the record
        $dcs = DeliveryChallan::where('dc_no', $dc_no)->first();

        if ($dcs) {
            $dcs->update($input);
            return redirect()->to('dc_master')->with('success', 'Delivery Challan Updated!');
        } else {
            return redirect()->back()->with('error', 'Delivery Challan Not Found!');
        }
    }

    public function dc_delete($dc_no)
    {
        $dc_details = DB::table('delivery_challan_details')->where('dc_no', $dc_no)->get();

        foreach ($dc_details as $sets=>$vl) {    
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

        $dc_items = DB::table('delivery_challan_details')->where('dc_no', $dc_no)->delete();
        $dc_del = DB::table('delivery_challans')->where('dc_no', $dc_no)->delete();
        $dc_pay_detail_del = DB::table('dc_payment_details')->where('dc_no', $dc_no)->delete();

        $remember =   isset($dc_del) ? redirect()->back()->with('error', 'DC deleted successfully!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function dc_print($dc_no)
    {
        $scpinvoice = DB::table('scp_invoices')
        ->join('services', 'services.service_id', '=', 'scpinvoices.scp_id')
        ->where('scpinvoices.scp_invoice_no', $scp_invoice_no)
        ->orderBy('scpinvoices.id', 'desc')
        ->get(['scpinvoices.*', 'services.name', 'services.gstin_no', 'services.service_center_name', 'services.state', 'services.phone']);

        return view('logics.admin.scpinvoice_print', compact('scpinvoices'));
    }

    public function generate_dc_pdf($dc_no)
    {
        $dcs = DB::table('delivery_challans')->where('dc_no', $dc_no)->orderBy('id', 'desc')->first();
        return view('logics.manufacture.delivery_challans.dc_stream_pdf', compact('dcs', 'dc_no'));
    }

    public function financialyear()
    {
        $financial_year_to = (date('m') > 3) ? date('y') +1 : date('y');
        $financial_year_from = $financial_year_to - 1;
        $financial_year= $financial_year_from.$financial_year_to;
        return $financial_year;
    }
}