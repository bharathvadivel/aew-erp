<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Contact;
use App\Models\PModel;
use App\Models\Costing;
use App\Models\FinancialYear;
use App\Models\DocOrder;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\InwardInvoice;
use App\Models\InwardInvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class InwardInvoiceController extends Controller
{
    public function index()
    {
        $fy = FinancialYear::orderBy('id', 'desc')->first();
        $start_year = $fy->fy_start_year;
        $end_year = $fy->fy_end_year;

        $financial_year = $start_year.$end_year;

        $inwd_inv_order = DocOrder::where('fy_id', $fy->id)->first();

        $customers = Contact::orderBy('id', 'asc')->get();
        
        $invoice_no = 'LB-INV-'.$financial_year.'-'.$inwd_inv_order->inward_invoice_no;
        
        return view('logics.manufacture.inward_invoice.add_inwd_invoice', compact('invoice_no', 'customers'));
    }

    public function get_inwd_bill_no(Request $request)
    {
        $inward_bill_type = $request->inward_type;

        $row = DB::table('inward_invoices')->where('inward_bill_type', $inward_bill_type)->orderBy('id', 'desc')->limit(1)->first();
        $financial_year = $this->financialyear();
        
        if ($row === null) {
            $id = 1;
        } else {
            $id = $row->id + 1;
        }

        if($inward_bill_type == 'invoice'){
            $inward_bill_no = 'LB-INV-'.$financial_year.'-'.$id;
        }
        else{
            $inward_bill_no = 'LB-DC-'.$financial_year.'-'.$id;
        }
        return json_encode($inward_bill_no);
    }
    

    public function inwd_itemcode_select(Request $request)
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

    public function inwd_product_select(Request $request)
    {
        $itemType = $request->itemType;
        $model_no = $request->model_no;

        if ($itemType == 'SPG') {
            $row = Material::where('material_code', $model_no)->first();
            if ($row && $row->total_stock_qty >= 0) {
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
        } else if ($itemType == 'FAG') {
            $row = PModel::where('model_code', $model_no)->first();
            if ($row && $row->fully_assembled_qty >= 0) {
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

        return response()->json($val);
    }

    public function inwd_invoice_item_insert(Request $request)
    {   
        $invoiceNo = $request->invoiceNo;
        $invoiceDate = $request->invoiceDate;
        $itemType = $request->itemType;
        $itemCode = $request->itemCode;
        $itemDesc = $request->itemDesc;
        $itemPrice = $request->itemPrice;
        $qty = $request->qty;
        $itemSubTotal = $request->itemSubTotal;
        $tax = $request->tax;
        $netTotal = $request->netTotal;

        $input['invoice_no'] = $invoiceNo;
        $input['invoice_date'] = $invoiceDate;
        $input['item_type'] = $itemType;
        $input['item_code'] = $itemCode;
        $input['item_desc'] = $itemDesc;
        $input['item_price'] = $itemPrice;
        $input['item_qty'] = $qty;
        $input['item_sub_total'] = $itemSubTotal;
        $input['item_gst_percent'] = $tax;
        $input['item_total'] = $netTotal;

        if($itemType == "SPG"){
            $previous_price = Costing::where('item_code', $itemCode)->orderBy('id', 'desc')->first();
            $previous_pricing = $previous_price ? $previous_price->pricing : 0;

            if($previous_price){
                if($itemPrice < $previous_pricing){
                    $up_down_same = "Decreased";
                    $how_much = $previous_pricing-$itemPrice;
                } elseif($itemPrice > $previous_pricing){
                    $up_down_same = "Increased";
                    $how_much = $itemPrice-$previous_pricing;
                } elseif($itemPrice == $previous_pricing){
                    $up_down_same = "Same";
                    $how_much = 0;
                }
            
                $cdata['item_code'] = $itemCode;
                $cdata['pricing'] = $itemPrice;
                $cdata['up_down_same'] = $up_down_same;
                $cdata['how_much'] = $how_much;
                $cdata['entry_origin'] = "Inward Invoice";
                $cdata['inwd_invoice_no'] = $invoiceNo;

                $cdatas = Costing::create($cdata);
                $qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
                $subtractQty = $qty_select->total_stock_qty+$qty;
                $qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$subtractQty));
            }else {
                $cdata['item_code'] = $itemCode;
                $cdata['pricing'] = $itemPrice;
                $cdata['up_down_same'] = "";
                $cdata['how_much'] = 0;
                $cdata['entry_origin'] = "Inward Invoice";
                $cdata['inwd_invoice_no'] = $invoiceNo;

                $cdatas = Costing::create($cdata);
                $qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
                $subtractQty = $qty_select->total_stock_qty+$qty;
                $qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$subtractQty));
            }
        } else if($itemType == "FAG"){
            $qty_select = DB::table('p_models')->where('model_code', $itemCode)->first();
            $subtractQty = $qty_select->fully_assembled_qty+$qty;
            $qty_update = DB::table('p_models')->where('model_code', $itemCode)->update(array('fully_assembled_qty'=>$subtractQty));
        }

        $datas = InwardInvoiceDetail::create($input);

        if($datas){
            $getuom = DB::table('materials')->where('material_code', $itemCode)->first();
            $uom = $getuom->uom;
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
                <td>'.$uom.'</td>
                <td><input style="background: #e0e0e0;" class="rate1 form-control" type="text" name="rate1" id="rate1" value="'.$itemPrice.'" readonly></td>
                <td><input style="background: #e0e0e0;" class="tax1 form-control" type="text" name="tax1" id="tax1" value="'.$tax.'" readonly></td>
                <td><input style="background: #e0e0e0;" class="amount1 form-control" type="text" name="amount1" id="amount1" readonly style="border: none;" value="'.$itemSubTotal.'" readonly></td>

                <td class="editc">
                    <a class="delete-row"><i data-placement="top" title="Delete" class="fa fa-trash" style="color:white; background: red; box-shadow: none; border-radius: 3px; padding: 10px;"></i></a>
                </td>
            </tr>
            ';

            $invoiceData = DB::table('inward_invoice_details')->where('invoice_no', $invoiceNo)->get();

            // Calculate the sum of the 'sub_total' column
            $subTotalSum = $invoiceData->sum('item_sub_total');
            $netTotalSum = $invoiceData->sum('item_total');
            $gstAveragePercentage = $invoiceData->avg('item_gst_percent');
            $gstAvgAmount = number_format($subTotalSum*($gstAveragePercentage/100),2);
            $return = array("status" =>true,'output'=>$output,'subTotalSum' => $subTotalSum,'netTotalSum'=>$netTotalSum,'gstAveragePercentage'=>$gstAveragePercentage,'gstAvgAmount'=>$gstAvgAmount);
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular added failed','output'=>'');
            return json_encode($return);
        }
        
    }

    public function inwd_invoice_item_remove(Request $request)
    {
        $invoiceNo = $request->invoiceNo;
        $itemType = $request->itemType;
        $itemCode = $request->itemCode;
        $qty = $request->qty;

        if($itemType == "SPG"){
            $qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
            $addQty = $qty_select->total_stock_qty-$qty;
            $qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$addQty));
        } else if($itemType == "FAG"){
            $qty_select = DB::table('p_models')->where('model_code', $itemCode)->first();
            $addQty = $qty_select->fully_assembled_qty-$qty;
            $qty_update = DB::table('p_models')->where('model_code', $itemCode)->update(array('fully_assembled_qty'=>$addQty));
        }

        $datas = InwardInvoiceDetail::where('invoice_no', $invoiceNo)->where('item_code', $itemCode)->delete();

        if($datas){
            $invoiceData = DB::table('inward_invoice_details')->where('invoice_no', $invoiceNo)->get();

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

    public function inwd_invoice_store(Request $request)
    {
        $invoice_no = $request->invoice_no;
        $invoice_date = $request->invoice_date;
        $inward_bill_type = $request->invoice_type;
        $customer_bill_no = $request->cust_order_no;
        $customer_bill_date = $request->cust_order_date;
        $customer_id = $request->customer_name;
        $get_customer_name = Contact::where('id', $customer_id)->pluck('customer_name')->first();
        $customer_name = $get_customer_name;
        $customer_bill_address = $request->input('forBillingAddress');
        $customer_ship_address = $request->input('forShippingAddress');
        $customer_mobile_no = $request->customer_mobile;
        $customer_gst_no = $request->customer_gst_no;
        $subtotal = $request->subTotal;
        $discount = $request->discount;
        $taxable_value = $request->taxTotal;

        $gst_percentage = $request->gstPercentage;

        if (!is_numeric($gst_percentage)) {
            // Handle the case where $gst_percentage is not numeric
            return redirect()->back()->with('error', 'Invalid GST percentage value!');
        }

        $gst_amount = $taxable_value*($gst_percentage / 100); // Calculate GST amount based on the percentage
        $net_total = $taxable_value + $gst_amount;
        $client_note = $request->input('forClientNote');
        
        $input['invoice_no'] = $invoice_no;
        $input['invoice_date'] = date('Y-m-d', strtotime("$invoice_date"));
        $input['inward_bill_type'] = $inward_bill_type;
        $input['customer_bill_no'] = $customer_bill_no;
        $input['customer_bill_date'] = date('Y-m-d', strtotime("$customer_bill_date"));
        $input['customer_id'] = $customer_id;
        $input['customer_name'] = $customer_name;
        $input['customer_bill_address'] = $customer_bill_address;
        $input['customer_ship_address'] = $customer_ship_address;
        $input['customer_mobile_no'] = $customer_mobile_no;
        $input['customer_gst_no'] = $customer_gst_no;
        $input['subtotal'] = $subtotal;
        $input['discount'] = $discount;
        $input['taxable_value'] = $taxable_value;
        $input['gst_percentage'] = $gst_percentage;
        $input['gst_amount'] = $gst_amount;
        $input['net_total'] = $net_total;
        $input['client_note'] = $client_note;
        

        $datas = InwardInvoice::create($input);

        if($datas){
            $fy = FinancialYear::orderBy('id', 'desc')->first();
            $increment_inwd_inv_no = DB::table('doc_orders')->where('fy_id', $fy->id)->increment('inward_invoice_no');

            if($increment_inwd_inv_no){
                return redirect()->to('inwd_invoice_master')->with('success', 'Inward Invoice Created!');
            }else {
                return redirect()->back()->with('warning', 'Inward Invoice Created! Without Incrementing Inwd Invoice Count');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    public function inwd_invoice_master()
    {
        $invoices =  DB::table('inward_invoices')->orderBy('id', 'desc')->get();
        $invoice_details =  DB::table('inward_invoice_details')->get();

        $from_date=date('Y-m-d');
        $to_date=date('Y-m-d');
        
        return view('logics.manufacture.inward_invoice.inwd_invoice_master', compact('invoices', 'invoice_details', 'from_date', 'to_date'));
    }

    public function inwd_invoice_master_filter(Request $request)
    {
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        
        $invoices = InwardInvoice::whereDate('invoice_date', '>=', $from_date)
            ->whereDate('invoice_date', '<=', $to_date)
            ->orderBy('id', 'desc')
            ->get();

        return view('logics.manufacture.inward_invoice.inwd_invoice_master', compact('invoices', 'from_date', 'to_date'));
    }

    public function inwd_invoice_edit($invoice_no)
    {
        $invoices =  DB::table('inward_invoices')->where('invoice_no', $invoice_no)->first();
        $invoice_details =  DB::table('inward_invoice_details')->where('invoice_no', $invoice_no)->get();
        $customers = Contact::orderBy('id', 'asc')->get();
        $customer_id = Contact::where('id', $invoices->customer_id)->pluck('id')->first();

        return view('logics.manufacture.inward_invoice.inwd_invoice_edit', compact('invoice_no', 'invoices', 'invoice_details', 'invoice_details','customers','customer_id'));
    }

    public function inwd_invoice_update(Request $request)
    {
        $invoice_no = $request->invoice_no;
        $invoice_date = $request->invoice_date;
        $inward_bill_type = $request->invoice_type;
        $customer_bill_no = $request->cust_order_no;
        $customer_bill_date = $request->cust_order_date;
        $customer_id = $request->customer_name;
        $get_customer_name = Contact::where('id', $customer_id)->pluck('customer_name')->first();
        $customer_name = $get_customer_name;
        $customer_bill_address = $request->input('forBillingAddress');
        $customer_ship_address = $request->input('forShippingAddress');
        $customer_mobile_no = $request->input('customer_mobile');
        $customer_gst_no = $request->input('customer_gst_no');
        $subtotal = $request->subTotal;
        $discount = $request->discount;
        $taxable_value = $request->taxTotal;

        $gst_percentage = $request->gstPercentage;

        if (!is_numeric($gst_percentage)) {
            // Handle the case where $gst_percentage is not numeric
            return redirect()->back()->with('error', 'Invalid GST percentage value!');
        }

        $gst_amount = $taxable_value*($gst_percentage / 100); // Calculate GST amount based on the percentage
        $net_total = $taxable_value + $gst_amount;

        $client_note = $request->input('forClientNote');
        
        $input['invoice_no'] = $invoice_no;
        $input['invoice_date'] = date('Y-m-d', strtotime("$invoice_date"));
        $input['inward_bill_type'] = $inward_bill_type;
        $input['customer_bill_no'] = $customer_bill_no;
        $input['customer_bill_date'] = date('Y-m-d', strtotime("$customer_bill_date"));
        $input['customer_id'] = $customer_id;
        $input['customer_name'] = $customer_name;
        $input['customer_bill_address'] = $customer_bill_address;
        $input['customer_ship_address'] = $customer_ship_address;
        $input['customer_mobile_no'] = $customer_mobile_no;
        $input['customer_gst_no'] = $customer_gst_no;
        $input['subtotal'] = $subtotal;
        $input['discount'] = $discount;
        $input['taxable_value'] = $taxable_value;
        $input['gst_percentage'] = $gst_percentage;
        $input['gst_amount'] = $gst_amount;
        $input['net_total'] = $net_total;
        $input['client_note'] = $client_note;
        
        // Find the existing invoice by ID and update the record
        $invoice = InwardInvoice::where('invoice_no', $invoice_no)->first();

        if ($invoice) {
            $invoice->update($input);
            return redirect()->to('inwd_invoice_master')->with('success', 'Inward Invoice Updated!');
        } else {
            return redirect()->back()->with('error', 'Invoice not found!');
        }
    }

    public function inwd_invoice_delete($invoice_no)
    {
        $invoice_details = DB::table('inward_invoice_details')->where('invoice_no', $invoice_no)->get();

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

        $inv_items = DB::table('inward_invoice_details')->where('invoice_no', $invoice_no)->delete();

        $inv_del = DB::table('inward_invoices')->where('invoice_no', $invoice_no)->delete();

        $remember =   isset($inv_del) ? redirect()->back()->with('error', 'Inward Invoice deleted successfully!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function inwd_invoice_print($invoice_no)
    {
        $scpinvoice = DB::table('scp_invoices')
        ->join('services', 'services.service_id', '=', 'scpinvoices.scp_id')
        ->where('scpinvoices.scp_invoice_no', $scp_invoice_no)
        ->orderBy('scpinvoices.id', 'desc')
        ->get(['scpinvoices.*', 'services.name', 'services.gstin_no', 'services.service_center_name', 'services.state', 'services.phone']);

        return view('logics.admin.scpinvoice_print', compact('scpinvoices'));
    }

    public function generate_inwd_invoice_pdf($invoice_no)
    {
        $invoices = DB::table('inward_invoices')->where('invoice_no', $invoice_no)->orderBy('id', 'desc')->first();

        return view('logics.manufacture.inward_invoice.inwd_invoice_stream_pdf', compact('invoices', 'invoice_no'));
    }

        
    public function financialyear()
    {
        $financial_year_to = (date('m') > 3) ? date('y') +1 : date('y');
        $financial_year_from = $financial_year_to - 1;
        $financial_year= $financial_year_from.$financial_year_to;
        return $financial_year;
    }

}
