<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Material;
use App\Models\PModel;
use App\Models\MaterialCompatibleModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use GuzzleHttp\Psr7\Response;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function sample()
    {
        return view('logics.dashboard');
    }

    public function index()
    {   
        // Get the start and end dates of the current financial year
        $currentYear = date('Y');
        $nextYear = $currentYear+1;
        $financialYearStart = "{$currentYear}-01-01";
        $financialYearEnd = "{$nextYear}-12-31";

        // Retrieve the sum of the subtotal for the current financial year
        $total_sales_amount = Invoice::whereBetween('invoice_date', [$financialYearStart, $financialYearEnd])->sum('subtotal');
        $total_sales_count = Invoice::whereBetween('invoice_date', [$financialYearStart, $financialYearEnd])->count();

        $currentYear1 = date('Y');
        $currentMonth1 = date('m');

        if ($currentMonth1 >= 4) {
            $financialYearStart1 = "{$currentYear1}-04-01 00:00:00";
            $financialYearEnd1 = ($currentYear1 + 1) . "-03-31 23:59:59";
        } else {
            $financialYearStart1 = ($currentYear1 - 1) . "-04-01 00:00:00";
            $financialYearEnd1 = "{$currentYear1}-03-31 23:59:59";
        }

        $total_sold_count = InvoiceDetail::whereBetween('created_at', [$financialYearStart1, $financialYearEnd1])->sum('item_qty');

        $invoices = Invoice::whereDate('invoice_date', date('Y-m-d'))->orderBy('id', 'desc')->get();
        // $total_sales=$invoices->sum('subtotal');

        // Retrieve the sum of the subtotal for the current financial year
        $fag_stocks = PModel::sum('fully_assembled_qty');

        $filter='';
        $from_date='';
        $to_date='';

        $threshold = 25; // 25% threshold
        $specifiedValue = 100; // Replace with the specific value you want to compare against

        $material = DB::table('materials')
            ->where('total_stock_qty', '<', ($threshold / 100) * $specifiedValue)
            ->where('total_stock_qty', '>', 0)
            ->where('deleted_status', '=', 0)
            ->orderBy('total_stock_qty', 'asc')
            ->get();

        $materials = DB::table('materials')
            ->where('total_stock_qty', '<=', 0)
            ->where('deleted_status', '=', 0)
            ->orderBy('id', 'desc')
            ->get();

        $item_groups = DB::table('item_groups')->orderBy('id', 'desc')->get();
        $units = DB::table('units')->orderBy('id', 'desc')->get();
        $models = DB::table('p_models')->orderBy('id', 'desc')->get();

        return view('logics.admin.admin_dashboard', compact('invoices','total_sales_count', 'total_sales_amount', 'total_sold_count', 'fag_stocks', 'filter', 'from_date', 'to_date', 'material', 'materials', 'item_groups', 'units', 'models'));
    }

}
