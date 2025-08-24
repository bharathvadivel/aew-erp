<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PModel;
use App\Models\Contact;
use App\Models\FinancialYear;
use App\Models\DocOrder;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Dispatch;
use App\Models\DispatchDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class DispatchController extends Controller
{
    public function dispatch_master()
    {
        // Fetch all product models dispatched by 'dispatch' column
        $p_models = DB::table('p_models')->orderBy('order', 'asc')->get();

        // Fetch customers who have placed at least one dispatch
        $customers = DB::table('contacts')
            ->join('dispatchs', 'contacts.id', '=', 'dispatchs.customer_id')
            ->select('contacts.id', 'contacts.customer_name')
            ->distinct() // Ensure each customer is listed only once
            ->get();

        // Fetch dispatch summary for customers who have placed dispatchs
        $dispatchSummary = DB::table('dispatchs')
            ->join('dispatch_details', 'dispatchs.invoice_no', '=', 'dispatch_details.invoice_no')
            ->select('dispatchs.customer_id', 'dispatch_details.item_code', DB::raw('SUM(dispatch_details.item_qty) as total_qty'))
            ->whereIn('dispatchs.customer_id', $customers->pluck('id')) // Filter by customers who have dispatchs
            ->groupBy('dispatchs.customer_id', 'dispatch_details.item_code')
            ->get();

        // Organize the data for easy access in the Blade template
        $summaryData = [];
        foreach ($dispatchSummary as $summary) {
            $summaryData[$summary->customer_id][$summary->item_code] = $summary->total_qty;
        }

        return view('logics.manufacture.dispatch.dispatch_master', compact('p_models', 'customers', 'summaryData'));
    }

    public function manage_dispatch()
    {
        $p_models =  DB::table('p_models')->orderBy('order', 'asc')->get();
        $invoices =  DB::table('dispatchs')->orderBy('id', 'desc')->get();
        $invoice_details =  DB::table('dispatch_details')->get();

        $from_date=date('Y-m-d');
        $to_date=date('Y-m-d');
        
        return view('logics.manufacture.dispatch.manage_dispatch', compact('p_models','invoices', 'invoice_details', 'from_date', 'to_date'));
    }

    public function manage_dispatch_filter(Request $request)
    {
        $p_models =  DB::table('p_models')->orderBy('order', 'asc')->get();
        $invoices =  DB::table('dispatchs')->orderBy('id', 'desc')->get();
        $invoice_details =  DB::table('dispatch_details')->get();
        
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        
        $invoices = InwardDc::whereDate('invoice_date', '>=', $from_date)
            ->whereDate('invoice_date', '<=', $to_date)
            ->orderBy('id', 'desc')
            ->get();

        return view('logics.manufacture.dispatch.manage_dispatch', compact('p_models','invoices', 'invoice_details', 'from_date', 'to_date'));
    }

    public function dispatch_by_customer_id($id)
    {
        $invoices = DB::table('dispatchs')
        ->join('dispatch_details', 'dispatchs.invoice_no', '=', 'dispatch_details.invoice_no')
        ->where('dispatchs.customer_id', $id)
        ->select(
            'dispatchs.customer_id',
            'dispatchs.invoice_no',
            'dispatchs.invoice_date',
            'dispatch_details.item_code',
            'dispatch_details.item_qty',
            'dispatchs.client_note'
        )
        ->get();
        
        return view('logics.manufacture.dispatch.dispatch_by_customer', compact('id', 'invoices'));
    }

    public function add_dispatch()
    {
        $fy = FinancialYear::orderBy('id', 'desc')->first();
        $start_year = $fy->fy_start_year;
        $end_year = $fy->fy_end_year;

        $financial_year = $start_year.$end_year;

        $inv_order = DocOrder::where('fy_id', $fy->id)->first();

        $customers = Contact::orderBy('customer_name', 'asc')->get();

        $models = PModel::where('status', '=', 'Enable')->orderBy('id', 'asc')->get();
        
        $invoice_no = 'LB-DIS-'.$financial_year.'-'.$inv_order->dispatch_no;
        
        return view('logics.manufacture.dispatch.add_dispatch', compact('invoice_no','customers','models'));
    }

    public function dispatch_product_select(Request $request)
    {
        $model_no = $request->model_no;

        $row = PModel::where('model_code', $model_no)->first();
        if($row->fully_assembled_qty >= 0){
            $val = array(
                "item_code" => $row->model_code, 
                "item_desc" => $row->model_desc,
                "totalQty" => $row->fully_assembled_qty,
                "uom" => "Nos"
            );
        } else {
            $val = array(
                "error" => "No stock available"
            );
        }
        return json_encode($val);
    }

    public function dispatch_item_insert(Request $request)
    {   
        $invoiceNo = $request->invoiceNo;
        $invoiceDate = $request->invoiceDate;
        $itemCode = $request->itemCode;
        $itemDesc = $request->itemDesc;
        $qty = $request->qty;
        
        $input['invoice_no'] = $invoiceNo;
        $input['invoice_date'] = $invoiceDate;
        $input['item_type'] = "FAG";
        $input['item_code'] = $itemCode;
        $input['item_desc'] = $itemDesc;
        $input['item_qty'] = $qty;
        $input['item_uom'] = "Nos";

        $datas = DispatchDetail::create($input);

        if($datas){
            $uom = "Nos";
            $output = '
            <tr>
                <td>
                    <input style="background: #e0e0e0;" class="item_code1 form-control" type="text" name="item_code1" id="item_code1" value="'.$itemCode.'" readonly>
                </td>
                <td><input style="background: #e0e0e0;" class="item_desc1 form-control" type="text" name="item_desc1" id="item_desc1" value="'.$itemDesc.'" readonly></td>
                <td>
                    <input style="background: #e0e0e0;" class="qty1 form-control" type="text" name="qty1" id="qty1" value="'.$qty.'" readonly>
                </td>
                <td>'.$uom.'</td>
                
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

    public function dispatch_item_remove(Request $request)
    {
        $invoiceNo = $request->invoiceNo;
        $itemCode = $request->itemCode;

        $datas = DispatchDetail::where('invoice_no', $invoiceNo)->where('item_code', $itemCode)->delete();

        if($datas){
            $return = array("status" =>true,'output'=>'');
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular removing failed','output'=>'');
            return json_encode($return);
        }
    }

    public function dispatch_store(Request $request)
    {
        $invoice_no = $request->invoice_no;
        $invoice_date = $request->invoice_date;
        $customer_id = $request->customer_name;
        $client_note = $request->input('forClientNote');
        
        $input['invoice_no'] = $invoice_no;
        $input['invoice_date'] = date('Y-m-d', strtotime("$invoice_date"));
        $input['customer_id'] = $customer_id;
        $input['client_note'] = $client_note;
        
        $datas = Dispatch::create($input);

        if($datas){
            $fy = FinancialYear::orderBy('id', 'desc')->first();
            $increment_inwd_dc_no = DB::table('doc_orders')->where('fy_id', $fy->id)->increment('dispatch_no');

            if($increment_inwd_dc_no){
                return redirect()->to('manage_dispatch')->with('success', 'Order Created!');
            }else {
                return redirect()->back()->with('warning', 'Order Created! Without Incrementing Order Count.');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    public function dispatch_edit($invoice_no)
    {
        $invoices =  DB::table('dispatchs')->where('invoice_no', $invoice_no)->first();
        $invoice_details =  DB::table('dispatch_details')->where('invoice_no', $invoice_no)->get();
        $customers = Contact::orderBy('customer_name', 'asc')->get();
        $customer_id = Contact::where('id', $invoices->customer_id)->pluck('id')->first();
        
        $models = PModel::where('status', '=', 'Enable')->orderBy('id', 'asc')->get();
        return view('logics.manufacture.dispatch.dispatch_edit', compact('invoice_no', 'invoices', 'invoice_details','customers','customer_id','models'));
    }

    public function dispatch_update(Request $request)
    {
        $invoice_no = $request->invoice_no;
        $invoice_date = $request->invoice_date;
        $customer_id = $request->customer_name;
        $client_note = $request->input('forClientNote');
        
        $input['invoice_no'] = $invoice_no;
        $input['invoice_date'] = date('Y-m-d', strtotime("$invoice_date"));
        $input['customer_id'] = $customer_id;
        $input['client_note'] = $client_note;
        
        // Find the existing invoice by ID and update the record
        $invoice = Dispatch::where('invoice_no', $invoice_no)->first();

        if ($invoice) {
            $invoice->update($input);
            return redirect()->to('manage_dispatch')->with('success', 'Dispatch Updated!');
        } else {
            return redirect()->back()->with('error', 'Order not found!');
        }
    }

    public function dispatch_delete($invoice_no)
    {
        $invoice_details = DB::table('dispatch_details')->where('invoice_no', $invoice_no)->get();
        $inv_items = DB::table('dispatch_details')->where('invoice_no', $invoice_no)->delete();
        $inv_del = DB::table('dispatchs')->where('invoice_no', $invoice_no)->delete();
        
        $remember =   isset($inv_del) ? redirect()->back()->with('error', 'Dispatch deleted successfully!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
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
