<?php

namespace App\Http\Controllers;

use App\Exports\NoStockExport;
use App\Exports\LowStockExport;
use App\Exports\BomStockExport;

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

class ProductController extends Controller
{
    public function index()
    {
        $item_groups = DB::table('item_groups')->orderBy('id', 'desc')->get();
        $units = DB::table('units')->orderBy('id', 'desc')->get();
        $models = DB::table('p_models')->orderBy('order', 'asc')->get();
        $materials = DB::table('materials')->where('deleted_status', '=', 0)->orderBy('total_stock_qty', 'asc')->get();
        
        return view('logics.manufacture.products.product_master', compact('item_groups', 'units', 'models', 'materials'));
    }

    public function edit_fag_stock()
    {
        $models = DB::table('p_models')->orderBy('order', 'asc')->get();
        return view('logics.manufacture.products.edit_fag_stock', compact('models'));
    }

    public function fag_stock_update()
    {
        return view('logics.manufacture.products.update_fag_stock');
    }
    function import_materials_qty_list()
    {   
        return view('logics.manufacture.materials.update_material_list');
    }

    public function import_fag_stock(Request $request)
    {
        if ($request->hasFile('fag_stock_data')) {
            $extension = $request->file('fag_stock_data')->getClientOriginalExtension();
            if ($extension == "csv") {
                $data = Excel::import(new FagStockImport, $request->file('fag_stock_data'));
    
                $remember = isset($data) ? redirect()->back()->with('success', 'FAG Stocks Updated!') : redirect()->back()->with('warning', 'Failed to import FAG Stocks!');
                
                return $remember;
            } else {
                return redirect()->back()->with('error', 'Not Valid or No File Found!.');
            }
        } else {
            return redirect()->back()->with('error', 'Not Valid or No File Found!.');
        }
    }

    public function export_no_stock_excel()
    {
        $exportname='no-stock-report-'.date('d-m-Y').'.xlsx';
        
        $material_data = DB::table('materials')
            ->leftJoin('material_compatible_models', 'materials.material_code', '=', 'material_compatible_models.material_code')
            ->where('materials.total_stock_qty', '<=', 0)
            ->where('materials.total_stock_qty', '<=', 0)
            ->where('materials.deleted_status', '=', 0)
            ->select('materials.material_code', 'materials.material_desc', 'materials.item_group_code', 'materials.item_group_desc', 'materials.total_stock_qty', 'materials.uom', 'materials.consider_build_count', 'material_compatible_models.model_code','material_compatible_models.min_assembly_qty_set')
            ->get();

        return Excel::download(new NoStockExport($material_data), $exportname) ;
    }

    public function export_low_stock_excel()
    {
        $exportname='low-stock-report-'.date('d-m-Y').'.xlsx';
        $threshold = 25; // 25% threshold
        $specifiedValue = 100; // Replace with the specific value you want to compare against

        $material_data = DB::table('materials')
            ->leftJoin('material_compatible_models', 'materials.material_code', '=', 'material_compatible_models.material_code')
            ->where('materials.total_stock_qty', '<', ($threshold / 100) * $specifiedValue)
            ->where('materials.total_stock_qty', '>', 0)
            ->where('materials.deleted_status', '=', 0)
            ->select('materials.material_code', 'materials.material_desc', 'materials.item_group_code', 'materials.item_group_desc', 'materials.total_stock_qty', 'materials.uom',  'materials.consider_build_count', 'material_compatible_models.model_code','material_compatible_models.min_assembly_qty_set')
            ->get();

        return Excel::download(new LowStockExport($material_data), $exportname) ;
    }


    public function export_bom_excel($model_code)
    {
        $exportname = $model_code.'-bom-stock-report-'.date('d-m-Y').'.xlsx';
        
        $materialstocks = DB::table('materials as a')
            ->select('a.material_code', 'a.material_desc', 'a.category', 'a.total_stock_qty', 'a.uom', 'a.consider_build_count', 'b.min_assembly_qty_set', 'b.model_code', DB::raw('ROUND(a.total_stock_qty / b.min_assembly_qty_set) as calculated_column'))
            ->join('material_compatible_models as b', 'a.material_code', '=', 'b.material_code')
            ->where('b.model_code', $model_code)
            ->orderBy('calculated_column', 'asc')
            ->get();

        return Excel::download(new BomStockExport($materialstocks), $exportname) ;
    }
}
