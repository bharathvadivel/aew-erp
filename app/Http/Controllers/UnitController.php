<?php

namespace App\Http\Controllers;


use App\Models\Unit;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\StateDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ExportState;


class UnitController extends Controller
{
    function index()
    {
        return view('logics.manufacture.units.add_unit');
    }

    function unit_master()
    {
        $unit = DB::table('units')->orderBy('id', 'desc')->get();
        return view('logics.manufacture.units.unit_master', compact('unit'));
    }

    function unit_store(Request $request)
    {
        $unit = Unit::where('unit_code', $request->unitcode)->get();

        if (count($unit) <= 0) {

            $unit = new Unit;
            $unit->unit_code = $request->unitcode;
            $unit->unit_desc = $request->unitdesc;
            $data = $unit->save();

            $remember =   isset($data) ?  redirect()->to('unit_master')->with('success', 'Unit Added!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
            return $remember;
        } else {
            return redirect()->back()->with('error', 'This unit  already taken!.');
        }
    }

    function unit_delete($id)
    {
        $ch = DB::table('units')->where('id', $id)->delete();
        $remember =   isset($ch) ?  redirect()->back()->with('error', 'Unit Removed!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function unit_edit($id)
    {
        $unit = Unit::where('id', $id)->first();
        return view('logics.manufacture.units.unit_edit', compact('unit'));
    }

    public function unit_update(Request $request)
    {

        $id = $request->id;

        $input['unit_code'] = $request->unitcode;
        $input['unit_desc'] = $request->unitdesc;

        // Find the existing contact by ID and update the record
        $unit = Unit::where('id', $id)->first();

        if ($unit) {
            $unit->update($input);
            return redirect()->to('unit_master')->with('success', 'Unit Updated!');
        } else {
            return redirect()->back()->with('error', 'Unit not found!');
        }
    }
}
