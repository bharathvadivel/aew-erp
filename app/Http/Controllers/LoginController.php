<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Asm;
use App\Models\Dealor;
use App\Models\Distributor;
use App\Models\Employee;
use App\Models\Executive;
use App\Models\Promoter;
use App\Models\Regional;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Warehouse;
use App\Models\FinancialYear;
use App\Models\DocOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function register()
    {
        return view('login.register');
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                echo '<script>alert("Please enter valid credentials");
                    window.location.href="' . url('/') . '"</script>';
            }
        }

        $username = $request->input('username');

        

        $admin = Admin::where('name', $request->username)->where('status', 'Enable')->first();


        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $request->session()->put('name', $username);
                $request->session()->put('partner_id', $admin->partner_id);
                $request->session()->put('partner_type', $admin->partner_type);
                $request->session()->put('store_name', $admin->name);
                $request->session()->put('phone', $admin->phone);
                $request->session()->put('email', $admin->email);
                $request->session()->put('address', $admin->address);

                if ($admin->partner_type == 'admin' || $admin->partner_type == 'trainee') {
                    // Get today's date
                    $currentDate = date('Y-m-d');

                    // Check if it's April 1
                    if (date('m-d', strtotime($currentDate)) == '04-01') {
                        // Create the financial year
                        $currentYear = date('Y');
                        $nextYear = $currentYear + 1;
                        // Get last two digits of current year and next year
                        $lastTwoDigitsCurrentYear = substr($currentYear, -2);
                        $lastTwoDigitsNextYear = substr($nextYear, -2);

                        $check_fy_year_apr_one = FinancialYear::orderby('id', 'desc')->first();

                        if($check_fy_year_apr_one->fy_start_year != $lastTwoDigitsCurrentYear && $check_fy_year_apr_one->fy_end_year!=$lastTwoDigitsNextYear){
                            FinancialYear::create([
                                'fy_start_year' => $lastTwoDigitsCurrentYear,
                                'fy_end_year' => $lastTwoDigitsNextYear,
                            ]);
    
                            $get_last_fy_id = FinancialYear::orderby('id', 'desc')->first();
                            $new_fy_doc_order_no = 1;
    
                            DocOrder::create([
                                'fy_id' => $get_last_fy_id->id,
                                'invoice_no' => $new_fy_doc_order_no,
                                'dc_no' => $new_fy_doc_order_no,
                                'inward_invoice_no' => $new_fy_doc_order_no,
                                'inward_dc_no' => $new_fy_doc_order_no,
                                'assembly_bill_no' => $new_fy_doc_order_no,
                                'machine_bill_no' => $new_fy_doc_order_no,
                                'routing_no' => $new_fy_doc_order_no,
                                'loss_no' => $new_fy_doc_order_no,
                                'order_no' => $new_fy_doc_order_no,
                                'dispatch_no' => $new_fy_doc_order_no,
                            ]);
                        }
                        
                    }

                    echo '<script>window.location.href="' . url('/admin_dashboard') . '"</script>';
                } 
                // elseif ($admin->partner_type == 'service_admin') {
                //     echo '<script>window.location.href="' . url('/enquiry_dashboard') . '"</script>';
                // } elseif ($admin->partner_type == 'factory_admin') {
                //     echo '<script>window.location.href="' . url('/factory_dashboard') . '"</script>';
                // } 
                else {
                    echo '<script>alert("Invalid Login Details");
                    window.location.href="' . url('/') . '"</script>';
                }
            } else {
                echo '<script>alert("Invalid Login Details");
                    window.location.href="' . url('/') . '"</script>';
            }
        }  else {
            echo '<script>alert("Invalid Login Details");
                window.location.href="' . url('/') . '"</script>';
        }
    }

    public function logout()
    {
        session()->forget('partner_type');
        session()->forget('phone');
        session()->forget('name');
        session()->forget('partner_id');

        echo '<script>alert("Logout Successfully");
        window.location.href="' . url('/') . '"</script>';
    }

    public function user_exist($phone)
    {
        if (Admin::where('phone', $phone)->first()) {
            return 1;
        }

        if (Warehouse::where('phone', $phone)->first()) {
            return 1;
        }

        if (Distributor::where('phone', $phone)->first()) {
            return 1;
        }


        if (Distributor::where('phone', $phone)->first()) {
            return 1;
        }

        if (Dealor::where('phone', $phone)->first()) {
            return 1;
        }

        if (Service::where('phone', $phone)->first()) {
            return 1;
        }

        if (Executive::where('phone', $phone)->first()) {
            return 1;
        }

        if (Promoter::where('phone', $phone)->first()) {
            return 1;
        }

        if (Asm::where('phone', $phone)->first()) {
            return 1;
        }

        if (Regional::where('phone', $phone)->first()) {
            return 1;
        }


        if (Employee::where('phone', $phone)->first()) {
            return 1;
        }

        return 0;
    }

    public function partner_details($partner_id)
    {
        $dis = Distributor::where('partner_id', $partner_id)->first();
        $asm = Asm::where('asm_id', $partner_id)->first();
        $regional = Regional::where('regional_id', $partner_id)->first();
        $admin = Admin::where('partner_id', $partner_id)->first();
        $service = Service::where('service_id', $partner_id)->first();

        if ($dis) {
            return $dis->name;
        } elseif ($asm) {
            return $asm->name;
        } elseif ($regional) {
            return $regional->name;
        } elseif ($admin) {
            return $admin->name;
        } elseif ($service) {
            return $service->name;
        } else {
            $empty = '';
            return $empty;
        }
    }
    
    public function login_by_admin(Request $request)
    {
        $phone = $request->input('phone');

        $dis = Distributor::where('phone', $request->phone)->where('status', 'Enable')->first();
        
        $asm = Asm::where('phone', $request->phone)->where('status', 'Enable')->first();

        $regional = Regional::where('phone', $request->phone)->where('status', 'Enable')->first();

        $admin = Admin::where('phone', $request->phone)->where('status', 'Enable')->first();

        $service = Service::where('phone', $request->phone)->where('status', 'Enable')->first();

        $warehouse = Warehouse::where('phone', $request->phone)->where('status', 'Enable')->first();

        $employee = Employee::where('phone', $request->phone)->where('status', 'Enable')->first();

        $promoter = Promoter::where('phone', $request->phone)->where('status', 'Enable')->first();


        if ($dis) {
            $request->session()->put('phone', $phone);
            $request->session()->put('store_name', $dis->store_name);

            $request->session()->put('name', $dis->name);

            $request->session()->put('email', $dis->email);
            $request->session()->put('address', $dis->address);

            $request->session()->put('partner_id', $dis->partner_id);
            $request->session()->put('partner_type', $dis->partner_type);
            if ($dis->partner_type == 'distributor') {
                echo '<script>alert("Login Successfully");
                window.location.href="' . url('/distributor_dashboard') . '"</script>';
            } elseif ($dis->partner_type=='sub_dealer') {
                echo '<script>alert("Login Successfully");
                window.location.href="' . url('/dealer_dashboard') . '"</script>';
            } else {
                echo '<script>alert("Login Successfully");
                window.location.href="' . url('/direct_dealer_dashboard') . '"</script>';
            }
        } elseif ($asm) {
            $request->session()->put('phone', $phone);
            $request->session()->put('name', $asm->name);
            $request->session()->put('store_name', $asm->name);

            $request->session()->put('email', $asm->email);
            $request->session()->put('address', $asm->address);

            $request->session()->put('partner_id', $asm->asm_id);
            $request->session()->put('partner_type', 'asm');

            echo '<script>alert("Login Successfully");
            window.location.href="' . url('/asm_dashboard') . '"</script>';
        } elseif ($regional) {
            $request->session()->put('phone', $phone);
            $request->session()->put('name', $regional->name);
            $request->session()->put('store_name', $regional->name);


            $request->session()->put('email', $regional->email);

            $request->session()->put('address', $regional->address);

            $request->session()->put('partner_id', $regional->regional_id);
            $request->session()->put('partner_type', 'regional_head');

            echo '<script>alert("Login Successfully");
            window.location.href="' . url('/regional_dashboard') . '"</script>';
        } elseif ($warehouse) {
            $request->session()->put('phone', $phone);
            $request->session()->put('name', $warehouse->name);
            $request->session()->put('store_name', $warehouse->name);

            $request->session()->put('email', $warehouse->email);
            $request->session()->put('address', $warehouse->address);
            $request->session()->put('partner_id', $warehouse->warehouse_id);
            $request->session()->put('partner_type', 'warehouse');

            echo '<script>alert("Login Successfully");
            window.location.href="' . url('/warehouse_dashboard') . '"</script>';
        } elseif ($admin) {
            $request->session()->put('phone', $phone);
            $request->session()->put('partner_id', $admin->partner_id);
            $request->session()->put('partner_type', $admin->partner_type);
            $request->session()->put('name', $admin->name);
            $request->session()->put('store_name', $admin->name);

            $request->session()->put('email', $admin->email);
            $request->session()->put('address', $admin->address);

            if ($admin->partner_type == 'admin') {
                echo '<script>alert("Login Successfully");
                window.location.href="' . url('/admin_dashboard') . '"</script>';
            } elseif ($admin->partner_type == 'service_admin') {
                echo '<script>alert("Login Successfully");
                window.location.href="' . url('/enquiry_dashboard') . '"</script>';
            } elseif ($admin->partner_type == 'factory_admin') {
                echo '<script>alert("Login Successfully");
                window.location.href="' . url('/factory_dashboard') . '"</script>';
            } else {
                echo '<script>alert("Login Successfully");
                window.location.href="' . url('/partorder_master') . '"</script>';
            }
        } elseif ($service) {
            $request->session()->put('phone', $phone);
            $request->session()->put('name', $service->name);
            $request->session()->put('store_name', $service->service_center_name);

            $request->session()->put('email', $service->email);
            $request->session()->put('address', $service->address);

            $request->session()->put('partner_id', $service->service_id);
            $request->session()->put('partner_type', 'service_center');

            echo '<script>alert("Login Successfully");
            window.location.href="' . url('/enquiry_dashboard') . '"</script>';
        } elseif ($employee) {
            $request->session()->put('phone', $phone);
            $request->session()->put('name', $employee->name);
            $request->session()->put('store_name', $employee->name);

            $request->session()->put('email', $employee->email);
            $request->session()->put('address', $employee->address);

            $request->session()->put('partner_id', $employee->emp_id);
            $request->session()->put('partner_type', $employee->employee_type);

            if ($employee->employee_type == 'HR') {
                echo '<script>alert("Login Successfully");
                window.location.href="' . url('/hr_dashboard') . '"</script>';
            } else {
                echo '<script>alert("Login Successfully");
                window.location.href="' . url('/accounts_dashboard') . '"</script>';
            }
        } elseif ($promoter) {
            $request->session()->put('phone', $phone);
            $request->session()->put('name', $promoter->name);
            $request->session()->put('store_name', $promoter->name);

            $request->session()->put('email', $promoter->email);
            $request->session()->put('address', $promoter->address);

            $request->session()->put('partner_id', $promoter->promoter_id);
            $request->session()->put('partner_type', 'brand_promoter');

            echo '<script>alert("Login Successfully");
            window.location.href="' . url('/dashboard') . '"</script>';
        } else {
            return  redirect()->back()->with('warning', 'Login failed!');
        }
    }
}
