<?php
namespace App\Http\Controllers;

use App\Models\Admin;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {   
        $partner_id = session()->get('partner_id');
        $user_data = Admin::where('partner_id', $partner_id)->first();
        
        return view('logics.manufacture.user.user_profile', compact('user_data'));
    }

    public function user_update(Request $request)
    {
        $partner_id = $request->partner_id;
        $phone = $request->phone;
        $email = $request->email;

        $input['phone'] = $phone;
        $input['email'] = $email;
        
        // Find the existing invoice by ID and update the record
        $admin = Admin::where('partner_id', $partner_id)->first();

        if ($admin) {
            $admin->update($input);
            return redirect()->to('user_profile')->with('success', 'Phone and Email Updated!');
        } else {
            return redirect()->back()->with('error', 'Details not found!');
        }
    }


    public function user_password_update(Request $request)
    {
        $partner_id = $request->partner_id;
        $password = $request->pswd;

        // Hash the password
        $hashedPassword = Hash::make($password);

        // Prepare the input data
        $input['password'] = $hashedPassword;

        // Find the existing admin by partner_id
        $admin = Admin::where('partner_id', $partner_id)->first();

        if ($admin) {
            // Update the admin's password
            $admin->update($input);
            return redirect()->to('user_profile')->with('success', 'Password Updated!');
        } else {
            return redirect()->back()->with('error', 'Details not found!');
        }
    }

    public function costing_password_update(Request $request)
    {
        $partner_id = $request->partner_id;
        $costing_password = $request->cpswd;

        $input['costing_password'] = $costing_password;
        
        // Find the existing invoice by ID and update the record
        $admin = Admin::where('partner_id', $partner_id)->first();

        if ($admin) {
            $admin->update($input);
            return redirect()->to('user_profile')->with('success', 'Costing Password Updated!');
        } else {
            return redirect()->back()->with('error', 'Details not found!');
        }
    }

}
