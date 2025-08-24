<?php

namespace App\Http\Controllers;

use App\Models\Contact;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactImport;
use App\Imports\ContactUpdateImport;
use App\DataTables\StateDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ExportState;


class ContactController extends Controller
{
    function add_contact()
    {
        return view('logics.manufacture.contacts.add_contact');
    }

    function contact_master()
    {
        $contacts = DB::table('contacts')->orderBy('id', 'desc')->get();
        return view('logics.manufacture.contacts.contact_master', compact('contacts'));
    }

    public function get_individual_customer_data(Request $request){
        $customer_id = $request->customer_id;
        $customer_info = Contact::where('id', $customer_id)->get();
        return json_encode($customer_info);
    }

    function contact_store(Request $request)
    {
        $contact_type = $request->contact_type;
        $contact_name = $request->contact_name;
        $contact_bill_address = $request->input('forBillingAddress');
        $contact_ship_address = $request->input('forShippingAddress');
        $contact_phone_no = $request->contact_phone_no;
        $contact_email = $request->contact_email;
        $contact_gstin = $request->contact_gstin;
        $state_code = $request->state_code;
        
        $input['customer_type'] = $contact_type;
        $input['customer_name'] = $contact_name;
        $input['customer_billing_address'] = $contact_bill_address;
        $input['customer_shipping_address'] = $contact_ship_address;
        $input['customer_mobile_no'] = $contact_phone_no;
        $input['customer_email'] = $contact_email;
        $input['customer_gst_no'] = $contact_gstin;
        $input['state_code'] = $state_code;

        $datas = Contact::create($input);

        if($datas){
            return redirect()->to('contact_master')->with('success', 'Contact Created!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    function contact_delete($id)
    {
        $ch = DB::table('contacts')->where('id', $id)->delete();
        $remember =   isset($ch) ?  redirect()->back()->with('error', 'Contact Removed!') :  redirect()->back()->with('warning', 'Something went wrong please try again!');
        return $remember;
    }

    public function contact_edit($id)
    {
        $contact = Contact::where('id', $id)->first();
        return view('logics.manufacture.contacts.edit_contact', compact('contact'));
    }

    public function contact_update(Request $request)
    {
        $c_id = $request->id;

        $contact_type = $request->contact_type;
        $contact_name = $request->contact_name;
        $contact_bill_address = $request->input('forBillingAddress');
        $contact_ship_address = $request->input('forShippingAddress');
        $contact_phone_no = $request->contact_phone_no;
        $contact_email = $request->contact_email;
        $contact_gstin = $request->contact_gstin;
        $state_code = $request->state_code;
        
        $input['customer_type'] = $contact_type;
        $input['customer_name'] = $contact_name;
        $input['customer_billing_address'] = $contact_bill_address;
        $input['customer_shipping_address'] = $contact_ship_address;
        $input['customer_mobile_no'] = $contact_phone_no;
        $input['customer_email'] = $contact_email;
        $input['customer_gst_no'] = $contact_gstin;
        $input['state_code'] = $state_code;

        // Find the existing contact by ID and update the record
        $contact = Contact::where('id', $c_id)->first();

        if ($contact) {
            $contact->update($input);
            return redirect()->to('contact_master')->with('success', 'Contact Updated!');
        } else {
            return redirect()->back()->with('error', 'Contact not found!');
        }
        
    }

    function import_contact_list()
    {   
        return view('logics.manufacture.contacts.contact_import');
    }

    function import_contact_store(Request $request)
    {
        if ($request->hasFile('contacts_data')) {
            $extension = $request->file('contacts_data')->getClientOriginalExtension();
            if ($extension == "csv") {
                $data = Excel::import(new ContactImport, $request->file('contacts_data'));

                $remember = isset($data) ? redirect()->back()->with('success', 'Contacts and Details Added!') : redirect()->back()->with('warning', 'Failed to import Contacts Details!');
                
                return $remember;
            } else {
                return redirect()->back()->with('error', 'Not Valid or No File Found!.');
            }
        } else {
            return redirect()->back()->with('error', 'Not Valid or No File Found!.');
        }
    }

    function import_contact_update_list()
    {   
        return view('logics.manufacture.contacts.contact_update_import');
    }

    function import_contact_update_store(Request $request)
    {
        if ($request->hasFile('contacts_data')) {
            $extension = $request->file('contacts_data')->getClientOriginalExtension();
            if ($extension == "csv") {
                $data = Excel::import(new ContactUpdateImport, $request->file('contacts_data'));
    
                $remember = isset($data) ? redirect()->back()->with('success', 'Contacts Updated!') : redirect()->back()->with('warning', 'Something went wrong please try again!');
                return $remember;
            } else {
                return redirect()->back()->with('error', 'Not Valid or No File Found!.');
            }
        } else {
            return redirect()->back()->with('error', 'Not Valid or No File Found!.');
        }
    }
}
