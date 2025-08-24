<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PModel;
use App\Models\Contact;
use App\Models\FinancialYear;
use App\Models\DocOrder;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\InvoicePaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class SalesController extends Controller
{
    public function index()
    {
        $fy = FinancialYear::orderBy('id', 'desc')->first();
        $start_year = $fy->fy_start_year;
        $end_year = $fy->fy_end_year;

        $financial_year = $start_year.$end_year;

        $inv_order = DocOrder::where('fy_id', $fy->id)->first();

        $customers = Contact::orderBy('id', 'asc')->get();
        
        $invoice_no = 'LB-INV-'.$financial_year.'-'.$inv_order->invoice_no;
        
        return view('logics.manufacture.sales.add_invoice', compact('invoice_no','customers'));
    }

    public function inv_itemcode_select(Request $request)
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

    public function inv_product_select(Request $request)
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

    public function invoice_item_insert(Request $request)
    {   
        $invoiceNo = $request->invoiceNo;
        $itemType = $request->itemType;
        $itemCode = $request->itemCode;
        $itemDesc = $request->itemDesc;
        $itemAddDesc = $request->itemAddDesc;
        $item_hsnsac_code = $request->item_hsnsac_code;
        $qty = $request->qty;
        $item_uom = $request->item_uom;
        $itemPrice = $request->itemPrice;
        $itemSubTotal = $request->itemSubTotal;
        $tax = $request->tax;
        $tax_amount = $request->tax_amount;
        $state_gst_percent = $request->state_gst_percent;
        $state_tax_amount = $request->state_tax_amount;
        $central_gst_percent = $request->central_gst_percent;
        $central_tax_amount = $request->central_tax_amount;
        $netTotal = $request->netTotal;

        $input['invoice_no'] = $invoiceNo;
        $input['item_type'] = $itemType;
        $input['item_code'] = $itemCode;
        $input['item_desc'] = $itemDesc;
        $input['item_add_desc'] = $itemAddDesc;
        $input['item_hsnsac_code'] = $item_hsnsac_code;
        $input['item_qty'] = $qty;
        $input['item_uom'] = $item_uom;
        $input['item_price'] = $itemPrice;
        $input['item_sub_total'] = $itemSubTotal;
        $input['item_gst_percent'] = $tax;
        $input['tax_amount'] = $tax_amount;
        $input['state_gst_percent'] = $state_gst_percent;
        $input['state_tax_amount'] = $state_tax_amount;
        $input['central_gst_percent'] = $central_gst_percent;
        $input['central_tax_amount'] = $central_tax_amount;
        $input['item_net_total'] = $netTotal;

        if($itemType == "SPG"){
            $qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
            $subtractQty = $qty_select->total_stock_qty-$qty;
            $qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$subtractQty));
        } else if($itemType == "FAG"){
            // $qty_select = DB::table('p_models')->where('model_code', $itemCode)->first();
            // $subtractQty = $qty_select->fully_assembled_qty-$qty;
            // $qty_update = DB::table('p_models')->where('model_code', $itemCode)->update(array('fully_assembled_qty'=>$subtractQty));
        }

        $datas = InvoiceDetail::create($input);

        if($datas){
            $output = '
            <tr>
                <td  style="max-width:150px;">
                    <input style="display: none;" class="itemType3" type="text" name="itemType3" id="itemType3" value="'.$itemType.'">
                    <input style="background:none;border:none;" class="item_code1 form-control" type="text" name="item_code1" id="item_code1" value="'.$itemCode.'" readonly>
                </td>
                <td>
                    <input style="background:none;border:none;" class="item_desc1 form-control" type="text" name="item_desc1" id="item_desc1" value="'.$itemDesc.'" readonly>
                    <br>
                    <b>Additional Description:</b>
                    <input style="background:none;border:none;" class="item_add_desc1 form-control" type="text" name="item_add_desc1" id="item_add_desc1" value="'.$itemAddDesc.'" readonly>
                </td>
                <td style="max-width:150px;"><input style="background:none;border:none;" class="item_hsnsac_code1 form-control" type="text" name="item_hsnsac_code1" id="item_hsnsac_code1" value="'.$item_hsnsac_code.'" readonly></td>
                <td style="max-width:80px;">
                    <input style="background:none;border:none;" class="qty1 form-control" type="text" name="qty1" id="qty1" value="'.$qty.'" readonly>
                </td>
                <td style="max-width:80px;"><input style="background:none;border:none;" class="item_uom1 form-control" type="text" name="item_uom1" id="item_uom1" value="'.$item_uom.'" readonly></td>
                <td style="max-width:80px;"><input style="background:none;border:none;" class="rate1 form-control" type="text" name="rate1" id="rate1" value="'.$itemPrice.'" readonly></td>
                <td><input style="background:none;border:none;" class="tax1 form-control" type="text" name="tax1" id="tax1" value="'.$tax.'" readonly></td>
                <td><input style="background:none;border:none;" class="amount1 form-control" type="text" name="amount1" id="amount1" readonly style="border: none;" value="'.$netTotal.'" readonly></td>

                <td class="editc">
                    <a class="delete-row"><i data-placement="top" title="Delete" class="fa fa-trash" style="color:white; background: red; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                </td>
            </tr>
            ';

            $invoiceData = DB::table('invoice_details')->where('invoice_no', $invoiceNo)->get();

            // Calculate the sum of the 'sub_total' column
            $subTotalSum = $invoiceData->sum('item_sub_total');
            $netTotalSum = $invoiceData->sum('item_net_total');
            $gstAveragePercentage = $invoiceData->avg('item_gst_percent');
            $gstAvgAmount = number_format($subTotalSum*($gstAveragePercentage/100),2);
            $return = array("status" =>true,'output'=>$output,'subTotalSum' => $subTotalSum,'netTotalSum'=>$netTotalSum,'gstAveragePercentage'=>$gstAveragePercentage,'gstAvgAmount'=>$gstAvgAmount);
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular added failed','output'=>'');
            return json_encode($return);
        }
        
    }

    public function invoice_item_remove(Request $request)
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

        $datas = InvoiceDetail::where('invoice_no', $invoiceNo)->where('item_code', $itemCode)->delete();

        if($datas){
            $invoiceData = DB::table('invoice_details')->where('invoice_no', $invoiceNo)->get();

            // Calculate the sum of the 'sub_total' column
            $subTotalSum = $invoiceData->sum('item_sub_total');
            $netTotalSum = $invoiceData->sum('item_total');
            $gstAveragePercentage = $invoiceData->avg('item_gst_percent');
            $gstAvgAmount = number_format($subTotalSum*($gstAveragePercentage/100),2);
            $return = array("status" =>true,'output'=>'','subTotalSum'=>$subTotalSum,'netTotalSum'=>$netTotalSum,'gstAveragePercentage'=>$gstAveragePercentage,'gstAvgAmount'=>$gstAvgAmount);
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular added failed','output'=>'');
            return json_encode($return);
        }
    }

    public function invoice_store(Request $request)
    {
        $invoice_no = $request->invoice_no;
        $invoice_date = $request->invoice_date;
        $customer_id = $request->customer_name;
        $subtotal = $request->subTotal;
        $discount = $request->discount;
        $taxable_value = $request->taxTotal;

        $gst_percentage = $request->gstPercentage;
        $total_gst_amount = $taxable_value*($gst_percentage/100);
        // Calculate round-off value
        $round_off_value = round($total_gst_amount) - $total_gst_amount;

        $round_off_value = $round_off_value;
        $net_total = $taxable_value + $total_gst_amount + $round_off_value;

        $delivery_note = $request->forDeliveryNote;
        $delivery_note_date = $request->forDeliveryNoteDate;
        $terms_of_payment = $request->forTermsPayment;
        $buyer_order_no = $request->forBuyerOrderNo;
        $buyer_order_date = $request->forBuyerOrderDate;
        $dispatch_doc_no = $request->forDispatchDocNo;
        $dispatch_through = $request->forDispatchedThrough;
        $destination = $request->forDestination;
        $terms_of_delivery = $request->forTermsofDelivery;

        $declaration = $request->forClientNote;
        
        $input['invoice_no'] = $invoice_no;
        $input['invoice_date'] = date('Y-m-d', strtotime("$invoice_date"));
        $input['customer_id'] = $customer_id;
        $input['subtotal'] = $subtotal;
        $input['discount'] = $discount;
        $input['taxable_value'] = $taxable_value;

        $input['gst_percentage'] = $gst_percentage;
        $input['total_gst_amount'] = $total_gst_amount;
        
        $input['round_off_value'] = $round_off_value;
        $input['net_total'] = $net_total;

        $input['delivery_note'] = $delivery_note;
        $input['delivery_note_date'] = $delivery_note_date; //Storing Date value as date since it is not mandatory
        $input['terms_of_payment'] = $terms_of_payment;
        $input['buyer_order_no'] = $buyer_order_no;
        $input['buyer_order_date'] = $buyer_order_date; //Storing Date value as date since it is not mandatory
        
        $input['dispatch_doc_no'] = $dispatch_doc_no;
        $input['dispatch_through'] = $dispatch_through;
        $input['destination'] = $destination;
        $input['terms_of_delivery'] = $terms_of_delivery;

        $input['declaration'] = $declaration;

        $datas = Invoice::create($input);

        if($datas){
            $fy = FinancialYear::orderBy('id', 'desc')->first();
            $increment_inv_no = DB::table('doc_orders')->where('fy_id', $fy->id)->increment('invoice_no');
            if($increment_inv_no){
                return redirect()->to('invoice_master')->with('success', 'Invoice Created!');
            }else {
                return redirect()->back()->with('warning', 'Invoice Created! Without Incrementing Invoice Count');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    public function invoice_master()
    {
        $invoices =  DB::table('invoices')->orderBy('id', 'desc')->get();
        $invoice_details =  DB::table('invoice_details')->get();
        $invoice_payment_details = DB::table('invoice_payment_details')->get();

        $from_date=date('Y-m-d');
        $to_date=date('Y-m-d');
        
        return view('logics.manufacture.sales.invoice_master', compact('invoices', 'invoice_details', 'invoice_payment_details', 'from_date', 'to_date'));
    }

    public function invoice_master_filter(Request $request)
    {
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        
        $invoices = Invoice::whereDate('invoice_date', '>=', $from_date)
            ->whereDate('invoice_date', '<=', $to_date)
            ->orderBy('id', 'desc')
            ->get();

        return view('logics.manufacture.sales.invoice_master', compact('invoices', 'from_date', 'to_date'));
    }

    public function invoice_edit($invoice_no)
    {
        $invoices =  DB::table('invoices')->where('invoice_no', $invoice_no)->first();
        $invoice_details =  DB::table('invoice_details')->where('invoice_no', $invoice_no)->get();
        $invoice_payment_details = DB::table('invoice_payment_details')->where('invoice_no', $invoice_no)->get();
        $customers = Contact::orderBy('id', 'asc')->get();
        $customer_id = Contact::where('id', $invoices->customer_id)->pluck('id')->first();
        return view('logics.manufacture.sales.invoice_edit', compact('invoice_no', 'invoices', 'invoice_details', 'invoice_payment_details', 'customers', 'customer_id'));
    }

    public function invoice_update(Request $request)
    {
        $invoice_no = $request->invoice_no;
        $invoice_date = $request->invoice_date;
        $customer_id = $request->customer_name;
        $subtotal = $request->subTotal;
        $discount = $request->discount;
        $taxable_value = $request->taxTotal;

        $gst_percentage = $request->gstPercentage;
        $total_gst_amount = $taxable_value*($gst_percentage/100);
        // Calculate round-off value
        $round_off_value = round($total_gst_amount) - $total_gst_amount;

        $round_off_value = $round_off_value;
        $net_total = $taxable_value + $total_gst_amount + $round_off_value;

        $delivery_note = $request->forDeliveryNote;
        $delivery_note_date = $request->forDeliveryNoteDate;
        $terms_of_payment = $request->forTermsPayment;
        $buyer_order_no = $request->forBuyerOrderNo;
        $buyer_order_date = $request->forBuyerOrderDate;
        $dispatch_doc_no = $request->forDispatchDocNo;
        $dispatch_through = $request->forDispatchedThrough;
        $destination = $request->forDestination;
        $terms_of_delivery = $request->forTermsofDelivery;

        $declaration = $request->forClientNote;
        
        $input['invoice_no'] = $invoice_no;
        $input['invoice_date'] = date('Y-m-d', strtotime("$invoice_date"));
        $input['customer_id'] = $customer_id;
        $input['subtotal'] = $subtotal;
        $input['discount'] = $discount;
        $input['taxable_value'] = $taxable_value;

        $input['gst_percentage'] = $gst_percentage;
        $input['total_gst_amount'] = $total_gst_amount;
        
        $input['round_off_value'] = $round_off_value;
        $input['net_total'] = $net_total;

        $input['delivery_note'] = $delivery_note;
        $input['delivery_note_date'] = $delivery_note_date; //Storing Date value as date since it is not mandatory
        $input['terms_of_payment'] = $terms_of_payment;
        $input['buyer_order_no'] = $buyer_order_no;
        $input['buyer_order_date'] = $buyer_order_date; //Storing Date value as date since it is not mandatory
        
        $input['dispatch_doc_no'] = $dispatch_doc_no;
        $input['dispatch_through'] = $dispatch_through;
        $input['destination'] = $destination;
        $input['terms_of_delivery'] = $terms_of_delivery;

        $input['declaration'] = $declaration;
        
        // Find the existing invoice by ID and update the record
        $invoice = Invoice::where('invoice_no', $invoice_no)->first();

        if ($invoice) {
            $invoice->update($input);
            return redirect()->to('invoice_master')->with('success', 'Invoice Updated!');
        } else {
            return redirect()->back()->with('error', 'Invoice not found!');
        }
    }

    public function invoice_delete($invoice_no)
    {
        $invoice_details = DB::table('invoice_details')->where('invoice_no', $invoice_no)->get();

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

        $inv_items = DB::table('invoice_details')->where('invoice_no', $invoice_no)->delete();
        $inv_del = DB::table('invoices')->where('invoice_no', $invoice_no)->delete();
        $inv_pay_detail_del = DB::table('invoice_payment_details')->where('invoice_no', $invoice_no)->delete();
        
        $remember =   isset($inv_del) ? redirect()->back()->with('error', 'Invoice deleted successfully!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function invoice_print($invoice_no)
    {
        $scpinvoice = DB::table('scp_invoices')
        ->join('services', 'services.service_id', '=', 'scpinvoices.scp_id')
        ->where('scpinvoices.scp_invoice_no', $scp_invoice_no)
        ->orderBy('scpinvoices.id', 'desc')
        ->get(['scpinvoices.*', 'services.name', 'services.gstin_no', 'services.service_center_name', 'services.state', 'services.phone']);

        return view('logics.admin.scpinvoice_print', compact('scpinvoices'));
    }

    public function generate_o_invoice_pdf($invoice_no)
    {
        $invoices = DB::table('invoices')->where('invoice_no', $invoice_no)->orderBy('id', 'desc')->first();

        return view('logics.manufacture.sales.invoice_original_pdf', compact('invoices', 'invoice_no'));
    }
    public function generate_b_invoice_pdf($invoice_no)
    {
        $invoices = DB::table('invoices')->where('invoice_no', $invoice_no)->orderBy('id', 'desc')->first();

        return view('logics.manufacture.sales.invoice_buyer_pdf', compact('invoices', 'invoice_no'));
    }
    public function generate_d_invoice_pdf($invoice_no)
    {
        $invoices = DB::table('invoices')->where('invoice_no', $invoice_no)->orderBy('id', 'desc')->first();

        return view('logics.manufacture.sales.invoice_duplicate_pdf', compact('invoices', 'invoice_no'));
    }
    public function generate_e_invoice_pdf($invoice_no)
    {
        $invoices = DB::table('invoices')->where('invoice_no', $invoice_no)->orderBy('id', 'desc')->first();

        return view('logics.manufacture.sales.invoice_extra_pdf', compact('invoices', 'invoice_no'));
    }
        
    public function financialyear()
    {
        $financial_year_to = (date('m') > 3) ? date('y') +1 : date('y');
        $financial_year_from = $financial_year_to - 1;
        $financial_year= $financial_year_from.$financial_year_to;
        return $financial_year;
    }

}
