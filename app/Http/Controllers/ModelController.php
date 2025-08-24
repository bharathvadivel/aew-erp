<?php

namespace App\Http\Controllers;

use App\Models\PModel;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StateImport;
use App\DataTables\StateDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ExportState;


class ModelController extends Controller
{
    function index()
    {
        return view('logics.manufacture.models.add_model');
    }

    function model_master()
    {
        $pmodel = DB::table('p_models')->orderBy('order', 'asc')->get();
        return view('logics.manufacture.models.model_master', compact('pmodel'));
    }

    function model_store(Request $request)
    {
        $pmodel = PModel::where('model_code', $request->model_code)->get();

        if (count($pmodel) <= 0) {

            $model = new PModel;

            $model->model_code = $request->model_code;
            $model->model_name = $request->model_name;
            $model->model_desc = $request->model_desc;
            $model->power = $request->power;
            $model->head_range = $request->head_range;
            $model->discharge = $request->discharge;
            $model->pipe_size = $request->pipe_size;
            $model->order = $request->order;
            
            $data = $model->save();

            $remember =   isset($data) ?  redirect()->back()->with('success', 'Model Added!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
            return $remember;
        } else {
            return redirect()->back()->with('error', 'This model already exist!.');
        }
    }

    function model_delete($id)
    {
        $ch = DB::table('p_models')->where('id', $id)->delete();
        $remember =   isset($ch) ?  redirect()->back()->with('error', 'Model Removed!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function model_edit($id)
    {
        $model = PModel::where('id', $id)->first();
        return view('logics.manufacture.models.model_edit', compact('model'));
    }

    public function model_update(Request $request)
    {

        $id = $request->id;

        $model = PModel::find($id);

        $model->model_code = $request->model_code;
        $model->model_name = $request->model_name;
        $model->model_desc = $request->model_desc;
        $model->power = $request->power;
        $model->head_range = $request->head_range;
        $model->discharge = $request->discharge;
        $model->pipe_size = $request->pipe_size;
        $model->order = $request->order;
        $model->status = $request->status;

        $val = $model->update();

        $remember =   isset($val) ?  redirect('model_master')->with('info', 'Model Updated!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function update_model_adj_qty(Request $request)
    {
        $model_code = $request->model_code;

        $model = PModel::where('model_code', $model_code)->first();

        $model->adjust_production_qty = $request->roundOffValue;

        $val = $model->update();

        $remember =   isset($val) ?  redirect('production')->with('info', 'Round OFF Value Updated!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    // public function model_update(Request $request)
    // {

    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'pincode' => 'required',
    //             'city_code' => 'required',
    //             'area' => 'required',
    //             'city' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
    //             'district' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
    //             'state' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
    //             'country' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
    //             'status' => 'required|in:Enable,Disable',
    //         ],
    //         [
    //             'regex' => 'The :attribute field not allowed special characters.',
    //             'in' => 'The :attribute field only allowed enable and disable values.',

    //         ]
    //     );
    //     if ($validator->fails()) {
    //         foreach ($validator->errors()->all() as $error) {
    //             return redirect()->back()->with('warning', $error);
    //         }
    //     }

    //     $id = $request->id;

    //     $profile = State::find($id);

    //     $profile->pincode = $request->pincode;
    //     $profile->city_code = $request->city_code;
    //     $profile->area = $request->area;
    //     $profile->city = $request->city;
    //     $profile->district = $request->district;
    //     $profile->state = strtoupper($request->state);
    //     $profile->country = $request->country;
    //     $profile->status = $request->status;
    //     $val = $profile->update();
    //     $remember =   isset($val) ?  redirect('state_master')->with('info', 'Location updated successfully!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
    //     return $remember;
    // }
}
