<?php

namespace App\Http\Controllers;

use App\Models\ItemGroup;
use App\Models\ItemType;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StateImport;
use App\DataTables\StateDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ExportState;


class ItemController extends Controller
{
    function add_item_type()
    {
        return view('logics.manufacture.item_types.add_item_type');
    }

    function item_type_master()
    {
        $item_type = DB::table('item_types')->orderBy('id', 'desc')->get();
        return view('logics.manufacture.item_types.item_type_master', compact('item_type'));
    }

    function item_type_store(Request $request)
    {
        $item_type = ItemType::where('item_type_code', $request->item_type_code)->get();

        if (count($item_type) <= 0) {

            $item_type = new ItemType;

            $item_type->item_type_code = $request->item_type_code;
            $item_type->item_type_name = $request->item_type_name;
            $item_type->item_type_desc = $request->item_type_desc;
            
            $data = $item_type->save();

            $remember =   isset($data) ?  redirect()->back()->with('success', 'Item Type Added!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
            return $remember;
        } else {
            return redirect()->back()->with('error', 'This Item Type already exist!.');
        }
    }

    function item_type_delete($id)
    {
        $ch = DB::table('item_types')->where('id', $id)->delete();
        $remember =   isset($ch) ?  redirect()->back()->with('error', 'Model Removed!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function item_type_edit($id)
    {
        $item_type = ItemType::where('id', $id)->first();
        return view('logics.manufacture.item_types.edit_item_type', compact('item_type'));
    }

    public function item_type_update(Request $request)
    {

        $id = $request->id;

        $item_type = ItemType::where('item_type_code', $request->item_type_code)->get();

        if (count($item_type) <= 0) {

            $item_type->item_type_code = $request->item_type_code;
            $item_type->item_type_name = $request->item_type_name;
            $item_type->item_type_desc = $request->item_type_desc;
            
            $val = $item_type->update();

            $remember =   isset($val) ?  redirect('item_type_master')->with('info', 'Item Type Updated!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
            return $remember;
        } else {
            return redirect()->back()->with('error', 'This Item Type already exist!.');
        }
        
    }


    function add_item_group()
    {
        return view('logics.manufacture.item_groups.add_item_group');
    }

    function item_group_master()
    {
        $item_group = DB::table('item_groups')->orderBy('id', 'desc')->get();
        return view('logics.manufacture.item_groups.item_group_master', compact('item_group'));
    }

    function item_group_store(Request $request)
    {
        $item_group = ItemGroup::where('item_group_code', $request->item_group_code)->get();

        if (count($item_group) <= 0) {

            $item_group = new ItemGroup;

            $item_group->item_group_code = $request->item_group_code;
            $item_group->item_group_name = $request->item_group_name;
            $item_group->item_group_desc = $request->item_group_desc;
            
            $data = $item_group->save();

            $remember =   isset($data) ?  redirect()->back()->with('success', 'Item Type Added!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
            return $remember;
        } else {
            return redirect()->back()->with('error', 'This Item Group already exist!.');
        }
    }

    function item_group_delete($id)
    {
        $ch = DB::table('item_groups')->where('id', $id)->delete();
        $remember =   isset($ch) ?  redirect()->back()->with('error', 'Model Removed!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function item_group_edit($id)
    {
        $item_group = ItemGroup::where('id', $id)->first();
        return view('logics.manufacture.item_groups.edit_item_group', compact('item_group'));
    }

    public function item_group_update(Request $request)
    {

        $id = $request->id;

        $item_group = ItemGroup::where('item_group_code', $request->item_group_code)->get();

        if (count($item_group) <= 0) {

            $item_group->item_group_code = $request->item_group_code;
            $item_group->item_group_name = $request->item_group_name;
            $item_group->item_group_desc = $request->item_group_desc;

            $val = $item_group->update();

            $remember =   isset($val) ?  redirect('item_group_master')->with('info', 'Item Group Updated!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
            return $remember;
        } else {
            return redirect()->back()->with('error', 'This Item Group already exist!.');
        }
    }
}
