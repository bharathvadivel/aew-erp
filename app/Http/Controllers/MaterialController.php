<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PModel;
use App\Models\MaterialCompatibleModel;
use App\Models\ItemGroup;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MaterialImport;
use App\Imports\MaterialCompatibleImport;
use App\Imports\MaterialUpdateImport;
use App\DataTables\StateDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ExportState;


class MaterialController extends Controller
{
    function index()
    {   
        $item_groups = DB::table('item_groups')->orderBy('id', 'desc')->get();
        $units = DB::table('units')->orderBy('id', 'desc')->get();
        $models = DB::table('p_models')->orderBy('id', 'desc')->get();
        return view('logics.manufacture.materials.add_material', compact('item_groups', 'units', 'models'));
    }

    public function gen_material_code(Request $request)
    {
        $prefix = $request->input('prefix');

        // Use Laravel's query builder to get the last item group with the given prefix
        $itemGroup = DB::table('materials')->where('item_group_code', $prefix)->orderBy('id', 'desc')->first();

        if ($itemGroup) {
            $currentCCode = $itemGroup->material_code;

            // Split the string using the '-' character as the delimiter
            $alphabetseries = explode('-', $currentCCode);

            $groupcode =  isset($alphabetseries[0]) ? $alphabetseries[0] : null;
            $getalphabetseries = isset($alphabetseries[1]) ? $alphabetseries[1][0] : null;
            $last4Digits = substr($currentCCode, -3);

            if ($last4Digits === '999') {
                $alphabet = isset($alphabetseries[1]) ? $alphabetseries[1][0] : '';

                if (preg_match('/^[A-Z]+$/', $alphabet)) {
                    $characters = str_split($alphabet);
                    $index = count($characters) - 1;
                    while ($index >= 0 && $characters[$index] === 'Z') {
                        $characters[$index] = 'A';
                        $index--;
                    }

                    if ($index === -1) {
                        array_unshift($characters, 'A');
                    } else {
                        $characters[$index] = ++$characters[$index];
                    }

                    $nextAlphabet = implode('', $characters);
                    $updatedCCode = $groupcode . '-' . $nextAlphabet . '001';
                } else {
                    return response()->json(['error' => 'Invalid format of CCode after \'-\'']);
                }
            } else {
                $groupcode = isset($alphabetseries[0]) ? $alphabetseries[0] : null;
                //echo nl2br("\n".$groupcode);

                // Get the first letter after the '-' character
                $getalphabetseries = isset($alphabetseries[1]) ? $alphabetseries[1][0] : null;
                //echo nl2br("\n".$getalphabetseries);

                
                $last4Digits = substr($currentCCode, -3);
                $incrementedNumber = (int)$last4Digits + 1;
                $paddedIncrementedNumber = str_pad($incrementedNumber, 3, '0', STR_PAD_LEFT);
                $updatedCCode = $groupcode . '-' . $getalphabetseries . $paddedIncrementedNumber;
            }

            return response()->json(['materialCode' => $updatedCCode]);
        } else {
            $updatedCCode = $prefix . '-A001';
            return response()->json(['materialCode' => $updatedCCode]);
        }
    }


    public function get_item_description(Request $request)
    {
        $prefix = $request->input('prefix');

        // Use Laravel's query builder to get the last item group with the given prefix
        $itemGroup = DB::table('item_groups')->where('item_group_code', $prefix)->orderBy('id', 'desc')->first();

        if ($itemGroup) {
            $description = $itemGroup->item_group_desc;

            return response()->json(['itemDesc' => $description]);
        } else {
            $description = 'N/A';
            return response()->json(['itemDesc' => $description]);
        }
    }

    public function check_material_duplicate(Request $request)
    {
        $material_code = $request->material_code;

        $material = Material::where('material_code', $material_code)->first();

        if ($material) {
            // If a record with the material code exists
            $response = array('duplicate' => true);
        } else {
            // If no record with the material code is found
            $response = array('duplicate' => false);
        }

        // Return the response in JSON format
        return response()->json($response);
    }

    public function check_material_duplicate_edit_page(Request $request)
    {
        $material_id = $request->material_id;
        $material_code = $request->material_code;

        $material = Material::where('material_code', $material_code)->first();

        if ($material) {
            $materialidchk = Material::where('material_code', $material_code)->where('id', $material_id)->first();
            if ($materialidchk) {
                // If no record with the material code is found
                $response = array('duplicate' => false);
            } else{
                // If a record with the material code exists
                $response = array('duplicate' => true);
            }  
        } else {
            // If no record with the material code is found
            $response = array('duplicate' => false);
        }

        // Return the response in JSON format
        return response()->json($response);
    }

    function material_master()
    {
        $material = DB::table('materials')->orderBy('id', 'desc')->get();
        return view('logics.manufacture.materials.material_master', compact('material'));
    }

    public function material_product_select(Request $request)
    {
        $model_no = $request->model_no;
        
        $row = PModel::where('model_code', $model_no)->first();
        $val = array(
            "model_code" => $row->model_code
        );

        return json_encode($val);
    }

    public function material_model_insert(Request $request)
    {   
        $materialCode = $request->materialCode;
        $suitableModelCode = $request->suitableModelCode;
        $minQty = $request->minQty;

        $input['material_code'] = $materialCode;
        $input['model_code'] = $suitableModelCode;
        $input['min_assembly_qty_set'] = $minQty;

        $datas = MaterialCompatibleModel::create($input);

        if($datas){
            $output = '
            <tr>
                <td>
                    <input style="background: #e0e0e0;" class="suitableModelCode1 form-control" type="text" name="suitable_model_code1" id="suitable_model_code1" value="'.$suitableModelCode.'" readonly>
                </td>
                <td>
                    <input style="background: #e0e0e0;" class="qty1 form-control" type="text" name="min_assembly_qty_set1" id="min_assembly_qty_set1" value="'.$minQty.'" readonly>
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

    public function material_model_remove(Request $request)
    {
        $material_code = $request->material_code;
        $suitable_model_code = $request->suitable_model_code;

        $datas = MaterialCompatibleModel::where('material_code', $material_code)->where('model_code', $suitable_model_code)->delete();

        if($datas){
            $return = array("status" =>true,'output'=>'');
            return json_encode($return);
        } else {
            $return = array("status" =>false,'message'=>'Particular delete failed','output'=>'');
            return json_encode($return);
        }
    }

    function material_store(Request $request)
    {
        $material = Material::where('material_code', $request->material_code)->get();

        if (count($material) <= 0) {

            $ig_code = $request->item_group_code;
            $itemgroup = ItemGroup::find($ig_code);
            if ($itemgroup) {
                $itemgroup->item_group_desc = $request->item_group_desc;
                $itemgroup->update();
            }

            $material = new Material;

            $material->material_code = $request->material_code;
            $material->material_desc = $request->material_desc;
            $material->item_group_code = $request->item_group_code;
            $material->item_group_desc = $request->item_group_desc;
            $material->category = $request->category;
            $material->uom = $request->uom;
            $material->total_stock_qty = $request->total_stock_qty;
            $material->consider_build_count = $request->consider_build;
            
            $data = $material->save();

            $remember =   isset($data) ?  redirect()->back()->with('success', 'Material Added!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
            return $remember;
        } else {
            return redirect()->back()->with('error', 'This material already exist!.');
        }
    }

    function material_delete($id)
    {
        $getMaterial = DB::table('materials')->where('id', $id)->first();
        $ch2 = DB::table('material_compatible_models')->where('material_code', $getMaterial->material_code)->delete();

        $ch = DB::table('materials')->where('id', $id)->update(['deleted_status' => '1']);

        $remember =   isset($ch) ?  redirect()->back()->with('error', 'Model Removed!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function material_edit($id)
    {   
        $material = Material::where('id', $id)->first();
        $compatibleModels = MaterialCompatibleModel::where('material_code', $material->material_code)->get();

        $item_groups = DB::table('item_groups')->orderBy('id', 'desc')->get();
        $units = DB::table('units')->orderBy('id', 'desc')->get();
        $unit_code = DB::table('units')->where('unit_code', $material->uom)->orderBy('id', 'desc')->first();
        $models = DB::table('p_models')->orderBy('id', 'desc')->get();

        return view('logics.manufacture.materials.edit_material', compact('material', 'compatibleModels', 'item_groups', 'units', 'unit_code', 'models'));
    }

    public function material_update(Request $request)
    {

        $ig_code = $request->item_group_code;
        $itemgroup = ItemGroup::find($ig_code);
        if ($itemgroup) {
            $itemgroup->item_group_desc = $request->item_group_desc;
            $itemgroup->update();
        }

        $id = $request->id;

        $material = Material::find($id);

        $material->material_code = $request->material_code;
        $material->material_desc = $request->material_desc;
        $material->item_group_code = $request->item_group_code;
        $material->item_group_desc = $request->item_group_desc;
        $material->category = $request->category;
        $material->uom = $request->uom;
        $material->total_stock_qty = $request->total_stock_qty;
        $material->consider_build_count = $request->consider_build;

        $val = $material->update();

        $remember =   isset($val) ?  redirect('material_master')->with('info', 'Material Updated!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    function import_materials_list()
    {   
        return view('logics.manufacture.materials.add_material_list');
    }

    function import_materials_qty_list()
    {   
        return view('logics.manufacture.materials.update_material_list');
    }

    function import_materials(Request $request)
    {
        if ($request->hasFile('materials')) {
            $extension = $request->file('materials')->getClientOriginalExtension();
            if ($extension == "csv") {
                $data = Excel::import(new MaterialImport, $request->file('materials'));
    
                $remember = isset($data) ? redirect()->back()->with('success', 'Items List Added!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
                return $remember;
            } else {
                return redirect()->back()->with('error', 'Not Valid or No File Found!.');
            }
        } else {
            return redirect()->back()->with('error', 'Not Valid or No File Found!.');
        }
    }

    function import_material_compatibles(Request $request)
    {
        if ($request->hasFile('materialcompatibles')) {
            $extension = $request->file('materialcompatibles')->getClientOriginalExtension();
            if ($extension == "csv") {
                $data = Excel::import(new MaterialCompatibleImport, $request->file('materialcompatibles'));
    
                $remember = isset($data) ? redirect()->back()->with('success', 'Item Compatible List Added!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
                return $remember;
            } else {
                return redirect()->back()->with('error', 'Not Valid or No File Found!.');
            }
        } else {
            return redirect()->back()->with('error', 'Not Valid or No File Found!.');
        }
    }

    function import_update_materials(Request $request)
    {
        if ($request->hasFile('itemsbulkupdate')) {
            $extension = $request->file('itemsbulkupdate')->getClientOriginalExtension();
            if ($extension == "csv") {
                $data = Excel::import(new MaterialUpdateImport, $request->file('itemsbulkupdate'));
    
                $remember = isset($data) ? redirect()->back()->with('success', 'Items Updated!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
                return $remember;
            } else {
                return redirect()->back()->with('error', 'Not Valid or No File Found!.');
            }
        } else {
            return redirect()->back()->with('error', 'Not Valid or No File Found!.');
        }
    }

    public function download_items_import_sample()
    {
        $filePath = public_path('user/csv/items_import_sample.csv'); // Ensure the file exists in this path

        if (!File::exists($filePath)) {
            return abort(404, 'File not found.');
        }

        return Response::download($filePath, 'items_import_sample.csv', [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="items_import_sample.csv"',
        ]);
    }

    
    public function download_items_compatible_import_sample()
    {
        $filePath = public_path('user/csv/items_compatible_import_sample.csv');

        if (!file_exists($filePath)) {
            return abort(404, 'File not found.');
        }

        return Response::download($filePath, 'items_compatible_import_sample.csv', [
            'Content-Type' => 'text/csv'
        ]);
    }
}
