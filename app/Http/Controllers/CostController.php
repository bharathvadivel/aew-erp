<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Material;
use App\Models\PModel;
use App\Models\Costing;
use App\Models\FinancialYear;
use App\Models\DocOrder;

use App\Imports\CostingImport;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class CostController extends Controller
{
    public function index()
    {
        return view('logics.manufacture.costing.costing');
    }

    public function costing_password_check(Request $request)
    {
        $login_id = session()->get('partner_id');
        $passcode = $request->passcode;
        $cred = Admin::where('partner_id', $login_id)->where('costing_password', $passcode)->get();

        if($cred){
            $request->session()->put('costing_active', 'true');            
            return redirect()->route('costing.master');
        } else {
            return redirect()->back()->with('error', 'Invalid Password! Try Again.');
        }
    }

    public function costing_lock(Request $request)
    {
        session()->forget('costing_active');
        return view('logics.manufacture.costing.costing');
    }

    public function costing_master(Request $request)
    {
        $costing_active = session()->get('costing_active');
        if ($costing_active=='true') {
            // Password verification successful
            $materials = Material::orderBy('id', 'desc')->where('deleted_status', '=', 0)->get();
            $item_groups = DB::table('item_groups')->orderBy('id', 'desc')->get();
            $units = DB::table('units')->orderBy('id', 'desc')->get();
            $models = DB::table('p_models')->orderBy('order', 'asc')->get();
            
            return view('logics.manufacture.costing.costing_master', compact('materials', 'item_groups', 'units', 'models'));
        } else {
            // Password verification failed
            return redirect()->route('costing');
        }
    }

    public function costing_edit($material_code)
    {
        $costing_active = session()->get('costing_active');
        if ($costing_active=='true') {
            $material = Material::where('material_code', $material_code)->first();
            $material_last_price = Costing::where('item_code', $material_code)->orderBy('id', 'desc')->first();
            $costing_data = Costing::where('item_code', $material_code)->orderBy('id', 'desc')->get();
            return view('logics.manufacture.costing.costing_edit', compact('material','material_last_price','costing_data', 'material_code'));
        } else {
            // Password verification failed
            return redirect()->route('costing');
        }
    }

    public function costing_update(Request $request)
    {
        $costing_active = session()->get('costing_active');
        if ($costing_active=='true') {
            $item_code = $request->item_code;
            $price = $request->price;

            $previous_price = Costing::where('item_code', $item_code)->orderBy('id', 'desc')->first();
            $previous_pricing = $previous_price ? $previous_price->pricing : 0;

            if($previous_price){
                if($price < $previous_pricing){
                    $up_down_same = "Decreased";
                    $how_much = $previous_pricing-$price;
                } elseif($price > $previous_pricing){
                    $up_down_same = "Increased";
                    $how_much = $price-$previous_pricing;
                } elseif($price == $previous_pricing){
                    $up_down_same = "Same";
                    $how_much = 0;
                }
            
                $input['item_code'] = $item_code;
                $input['pricing'] = $price;
                $input['up_down_same'] = $up_down_same;
                $input['how_much'] = $how_much;
                $input['entry_origin'] = "Manual";

                $datas = Costing::create($input);

                if($datas){
                    return redirect()->back()->with('success', 'Costing Added!');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong please try again!');
                }
            }else {
                $input['item_code'] = $item_code;
                $input['pricing'] = $price;
                $input['up_down_same'] = "";
                $input['how_much'] = 0;

                $datas = Costing::create($input);

                if($datas){
                    return redirect()->back()->with('success', 'Costing Added As New Entry!');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong please try again!');
                }
            }
        } else {
            // Password verification failed
            return redirect()->route('costing');
        }
        
    }

    function import_costing()
    {   
        $costing_active = session()->get('costing_active');
        if ($costing_active=='true') {
            return view('logics.manufacture.costing.import_costing');
        } else {
            // Password verification failed
            return redirect()->route('costing');
        }
    }

    function import_costing_data(Request $request)
    {   
        $costing_active = session()->get('costing_active');
        if ($costing_active=='true') {
            if ($request->hasFile('costing_data')) {
                $extension = $request->file('costing_data')->getClientOriginalExtension();
                if ($extension == "csv") {
                    $data = Excel::import(new CostingImport, $request->file('costing_data'));

                    $remember = isset($data) ? redirect()->back()->with('success', 'Costing Data Added!') : redirect()->back()->with('warning', 'Failed to import Costing Data!');
                    
                    return $remember;
                } else {
                    return redirect()->back()->with('error', 'Not Valid or No File Found!.');
                }
            } else {
                return redirect()->back()->with('error', 'Not Valid or No File Found!.');
            }
        } else {
            // Password verification failed
            return redirect()->route('costing');
        }
    }

}
