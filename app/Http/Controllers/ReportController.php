<?php

namespace App\Http\Controllers;

use App\Exports\CostingModelExport;
use App\Exports\ProductStockExport;
use App\Imports\FagStockImport;

use App\Models\Material;
use App\Models\MaterialCompatibleModel;
use App\Models\PModel;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use DataTables;
use App\CentralLogics\Helpers;

class ReportController extends Controller
{
    public function order_dispatch_report()
    {
        // Fetch all product models ordered by 'order' column
        $p_models = DB::table('p_models')->orderBy('order', 'asc')->get();

        // Fetch customers who have at least one order or dispatch
        $customers = DB::table('contacts')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('orders')
                    ->whereColumn('orders.customer_id', 'contacts.id');
            })
            ->orWhereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('dispatchs')
                    ->whereColumn('dispatchs.customer_id', 'contacts.id');
            })
            ->select('contacts.id', 'contacts.customer_name')
            ->distinct()
            ->get();

        // Fetch order summary
        $orderSummary = DB::table('orders')
            ->join('order_details', 'orders.invoice_no', '=', 'order_details.invoice_no')
            ->select('orders.customer_id', 'order_details.item_code', DB::raw('SUM(order_details.item_qty) as total_order_qty'))
            ->groupBy('orders.customer_id', 'order_details.item_code')
            ->get();

        // Fetch dispatch summary
        $dispatchSummary = DB::table('dispatchs')
            ->join('dispatch_details', 'dispatchs.invoice_no', '=', 'dispatch_details.invoice_no')
            ->select('dispatchs.customer_id', 'dispatch_details.item_code', DB::raw('SUM(dispatch_details.item_qty) as total_dispatch_qty'))
            ->groupBy('dispatchs.customer_id', 'dispatch_details.item_code')
            ->get();

        // Organize data
        $orderData = [];
        foreach ($orderSummary as $order) {
            $orderData[$order->customer_id][$order->item_code] = $order->total_order_qty;
        }

        $dispatchData = [];
        foreach ($dispatchSummary as $dispatch) {
            $dispatchData[$dispatch->customer_id][$dispatch->item_code] = $dispatch->total_dispatch_qty;
        }

        // Calculate pending orders
        $summaryData = [];
        foreach ($customers as $customer) {
            foreach ($p_models as $mod) {
                $orderedQty = $orderData[$customer->id][$mod->model_code] ?? 0;
                $dispatchedQty = $dispatchData[$customer->id][$mod->model_code] ?? 0;
                $pendingQty = $orderedQty - $dispatchedQty;
                $summaryData[$customer->id][$mod->model_code] = $pendingQty;
            }
        }

        return view('logics.manufacture.reports.order_dispatch_report', compact('p_models', 'customers', 'summaryData'));
    }

    public function stock_report()
    {
        $item_groups = DB::table('item_groups')->orderBy('id', 'desc')->get();
        $units = DB::table('units')->orderBy('id', 'desc')->get();
        $models = DB::table('p_models')->orderBy('order', 'asc')->get();
        $materials = DB::table('materials')->where('deleted_status', '=', 0)->orderBy('total_stock_qty', 'asc')->get();
        
        return view('logics.manufacture.reports.stock_report', compact('item_groups', 'units', 'models', 'materials'));
    }

    public function export_low_product_stock_excel(Request $request)
    {
        $exportname='material-required-stock-report-'.date('d-m-Y').'.xlsx';
        $threshold = $request->to_build_count; // #Nos threshold
        $model_code = $request->model_code; // Replace with the specific value you want to compare against

        if($model_code == "All"){
            $reqToBuild = DB::table('materials as a')
                ->select('b.model_code',
                        'a.material_code',
                        'a.material_desc',
                        'a.category',
                        'a.item_group_code',
                        'a.item_group_desc',
                        'a.consider_build_count',
                        'b.min_assembly_qty_set',
                        'a.uom',
                        'a.total_stock_qty',
                        DB::raw('ABS(ROUND(b.min_assembly_qty_set * ' . $threshold . ', 3)) AS required_to_build')
                )
                ->join('material_compatible_models as b', 'a.material_code', '=', 'b.material_code')
                ->join('p_models', 'b.model_code', '=', 'p_models.model_code')
                ->whereRaw('a.total_stock_qty <= ABS(ROUND(b.min_assembly_qty_set * ' . $threshold . ', 3))')
                ->orderBy('p_models.order', 'ASC')
                ->get();
        } else{
            $reqToBuild = DB::table('materials as a')
                ->select('b.model_code',
                        'a.material_code',
                        'a.material_desc',
                        'a.category',
                        'a.item_group_code',
                        'a.item_group_desc',
                        'a.consider_build_count',
                        'b.min_assembly_qty_set',
                        'a.uom',
                        'a.total_stock_qty',
                        DB::raw('ABS(ROUND(b.min_assembly_qty_set * ' . $threshold . ', 3)) AS required_to_build')
                )
                ->join('material_compatible_models as b', 'a.material_code', '=', 'b.material_code')
                ->where('b.model_code', $model_code)
                ->whereRaw('a.total_stock_qty <= ABS(ROUND(b.min_assembly_qty_set * ' . $threshold . ', 3))')
                ->orderBy('required_to_build', 'ASC')
                ->get();
        }
        // return redirect()->back()->with('warning', $reqToBuild);
        return Excel::download(new ProductStockExport($reqToBuild), $exportname);
    }

    public function export_low_product_stock_by_model_excel(Request $request)
    {
        $exportname='required-stock-model-wise-thresholds-'.date('d-m-Y').'.xlsx';

        // 1. Initialize an array to store all data
        $thresholds = [];
        $reqToBuild = collect(); // Initialize an empty Collection to store all data

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'to_build_count_') === 0 && !empty($value)) {
                $thresholds[$key] = $value;
            }
        }

        // 2. Process non-empty to_build_count_* variables
        foreach ($thresholds as $key => $value) {
            if (strpos($key, 'to_build_count_') === 0 && !empty($value)) {
                // 3. Extract the model code from the key
                $model_id = substr($key, strrpos($key, '_') + 1);

                // 5. Fetch model_code from p_models using $key alias id
                $model_code = DB::table('p_models')->where('id', $model_id)->value('model_code');

                // 6. Construct and execute the query
                $reqToBuildItem = DB::table('materials as a')
                    ->select('b.model_code',
                        'a.material_code', // Use the actual column name here
                        'a.material_desc',
                        'a.category',
                        'a.item_group_code',
                        'a.item_group_desc',
                        'a.consider_build_count',
                        'b.min_assembly_qty_set',
                        'a.uom',
                        'a.total_stock_qty',
                        DB::raw('ABS(ROUND(b.min_assembly_qty_set * ' . $value . ', 3)) AS required_to_build')
                    )
                    ->join('material_compatible_models as b', 'a.material_code', '=', 'b.material_code')
                    ->join('p_models', function ($join) use ($model_code) {
                        $join->on('b.model_code', '=', 'p_models.model_code')
                            ->where('p_models.model_code', $model_code);
                    })
                    
                    ->orderBy('p_models.order', 'ASC')
                    ->get();

                // Push the query result into the $reqToBuild Collection
                $reqToBuild = $reqToBuild->concat($reqToBuildItem);
            }
        }

        // 7. Export all data to Excel
        if (count($reqToBuild) > 0) { // Check if any data is available
            return Excel::download(new ProductStockExport($reqToBuild), $exportname);
            // return redirect()->back()->with('warning', $reqToBuild);
        } else { // Handle no data case (optional)
            return redirect()->back()->with('warning', 'No data found for export');
        }
    }

    public function costing_model_report($model_code)
    {
        $exportname='costing-report-by-'.$model_code.date('d-m-Y').'.xlsx';

        // 1. Initialize an array to store all data
        $costModelList = collect(); // Initialize an empty Collection to store all data
        

        $costModelList = DB::table('materials as m')
            ->join('material_compatible_models as mcm', 'm.material_code', '=', 'mcm.material_code')
            ->leftJoinSub(
                DB::table('costings')
                    ->select(
                        'id',
                        'item_code',
                        'pricing',
                        'up_down_same',
                        'how_much',
                        'inwd_invoice_no',
                        DB::raw('MAX(created_at) as latest_created_at')
                    )
                    ->whereIn('id', function ($query) {
                        $query->select(DB::raw('MAX(id)'))
                            ->from('costings')
                            ->groupBy('item_code');
                    })
                    ->groupBy('item_code', 'pricing', 'up_down_same', 'how_much', 'inwd_invoice_no'),
                'latest_costings',
                'm.material_code',
                '=',
                'latest_costings.item_code'
            )
            ->leftJoin('inward_invoices as ii', 'latest_costings.inwd_invoice_no', '=', 'ii.invoice_no')
            ->select(
                'm.material_code as Material_Code',
                'm.material_desc as Material_Description',
                'm.total_stock_qty as Total_Stock_Qty',
                'm.uom as UOM',
                DB::raw('IFNULL(latest_costings.pricing, "") as Purchase_Cost'),
                DB::raw('IFNULL(mcm.min_assembly_qty_set, "") as Min_Assembly_Qty_Set'),
                DB::raw('IFNULL(ROUND(latest_costings.pricing * mcm.min_assembly_qty_set, 2), "") as Material_Cost'),
                DB::raw('IFNULL(latest_costings.up_down_same, "") as Up_Down_Same'),
                DB::raw('IFNULL(latest_costings.how_much, "") as How_Much'),
                DB::raw('IFNULL(ii.customer_bill_no, "") as Customer_Bill_No'),
                DB::raw('IFNULL(ii.customer_bill_date, "") as Customer_Bill_Date'),
                DB::raw('IFNULL(ii.customer_name, "") as Customer_Name')
            )
            ->where('mcm.model_code', $model_code) // Replace $model_code with the desired value
            ->orderBy('m.material_code', 'asc')
            ->get();
        

        // Export all data to Excel
        if (count($costModelList) > 0) { // Check if any data is available
            return Excel::download(new CostingModelExport($costModelList), $exportname);
            // return redirect()->back()->with('warning', $costModelList);
        } else { // Handle no data case (optional)
            return redirect()->back()->with('warning', 'No data found for export');
        }
    }
}