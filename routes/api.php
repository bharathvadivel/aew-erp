<?php

use App\Http\Controllers\Apicontroller;
use App\Http\Controllers\ApiproductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiloginController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApiamountcollectController;
use App\Http\Controllers\ApicustomerController;
use App\Http\Controllers\ApireportsController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('serial-list', [Apicontroller::class,'serial_list']);
Route::post('check-serial', [Apicontroller::class,'check_serial']);
Route::post('serial-validate', [Apicontroller::class,'serial_validate']);


Route::get('app_version', [ApiloginController::class,'app_version']);

Route::post('app_crash', [ApiloginController::class,'app_crash']);



Route::post('login', [ApiloginController::class,'login'])->name('login');

Route::post('invoice_login', [ApiloginController::class,'invoice_login'])->name('invoice.login');




///////////////////////////////////////////////marketing//////////////////////////////
Route::post('marketing_creatives', [ApiproductController::class,'marketing_creatives'])->name('marketing.creatives')->middleware('auth:sanctum');

/////////////////////////////////////////////category name/////////////////////////////
Route::get('product_category', [ApiproductController::class,'product_category'])->name('product.category')->middleware('auth:sanctum');
////////////////////////////////////////////Inventory/////////////////////////////
Route::get('warehouse_data', [ApiproductController::class,'warehouse_data'])->name('warehouse.data')->middleware('auth:sanctum');

Route::post('availability', [ApiproductController::class,'availability'])->name('availability')->middleware('auth:sanctum');
Route::post('inventory', [ApiproductController::class,'inventory'])->name('inventory')->middleware('auth:sanctum');

Route::post('model_no', [ApiproductController::class,'model_no'])->name('model_no');

//////////////////////////////////////////order partnerlist////////////////////////////
Route::post('order_partner', [ApiloginController::class,'order_partner'])->name('order.partner')->middleware('auth:sanctum');
Route::post('partner_location', [ApiloginController::class,'partner_location'])->name('partner.location')->middleware('auth:sanctum');


Route::controller(ApiproductController::class)->group(function () {
    Route::get('product_list', 'product_list');
    Route::post('/dealer-serial-store','dealer_serial_store')->name('dealer.serial.store');
});

/////////////////////////////////////////////order/////////////////////////////
Route::post('order', [ApiproductController::class,'order'])->name('order')->middleware('auth:sanctum');
Route::post('order_list', [ApiproductController::class,'order_list'])->name('order.list')->middleware('auth:sanctum');
Route::post('price_product_list', [ApiproductController::class,'price_product_list'])->name('price.product.list')->middleware('auth:sanctum');
Route::post('single_order_list', [ApiproductController::class,'single_order_list'])->name('single.order.list')->middleware('auth:sanctum');
Route::post('stock', [ApiproductController::class,'stock'])->name('stock')->middleware('auth:sanctum');

/////////////////////////////////////////////dashboard/////////////////////////////
Route::post('dashboard_title', [ApiloginController::class,'dashboard_title'])->name('dashboard.title')->middleware('auth:sanctum');

/////////////////////////////otp////////////////////////////////////////////////////

Route::post('sent_otp', [LoginController::class,'sent_otp'])->name('sent.otp')->middleware('auth:sanctum');
Route::post('verify_otp', [LoginController::class,'verify_otp'])->name('verify.otp')->middleware('auth:sanctum');
Route::post('resent_otp', [LoginController::class,'resent_otp'])->name('resent.otp')->middleware('auth:sanctum');

////////////////////////////////////////////Service enquiry////////////////////////

Route::post('enquiry_list', [EnquiryController::class,'enquiry_list_api'])->name('enquiry.list')->middleware('auth:sanctum');

Route::post('enquiry_check', [EnquiryController::class,'enquiry_check_api'])->name('enquiry.check')->middleware('auth:sanctum');

Route::post('part_list', [EnquiryController::class,'part_list'])->name('part.list')->middleware('auth:sanctum');

Route::post('enquiry_image_list', [EnquiryController::class,'enquiry_image_list'])->name('enquiry.image.list')->middleware('auth:sanctum');

Route::post('w_serial_check', [EnquiryController::class,'w_serial_check_app'])->name('w.serial.check.app')->middleware('auth:sanctum');

/////////////////////////////////////////////Amount collect/////////////////////////////
Route::post('amount_collect', [ApiamountcollectController::class,'amount_collect'])->name('amount.collect')->middleware('auth:sanctum');
Route::post('amount_collect_masters', [ApiamountcollectController::class,'amount_collect_masters'])->name('amount.collect.masters')->middleware('auth:sanctum');
Route::get('amount_collect_content', [ApiamountcollectController::class,'amount_collect_content'])->name('amount.collect.content')->middleware('auth:sanctum');
Route::post('amount_collect_delete', [ApiamountcollectController::class,'amount_collect_delete'])->name('amount.collect.delete')->middleware('auth:sanctum');
///////////////////////////////////////////////////warehouse api/////////////////////////

Route::post('order_to_list', [ApiproductController::class,'order_to_list'])->name('order.to.list')->middleware('auth:sanctum');

////////////////////////////////////////////////Customer list///////////////////////////////

Route::post('customer_list', [ApicustomerController::class,'customer_list'])->name('customer.list')->middleware('auth:sanctum');

/////////////////////////////////////////Record sale////////////////////////////////////////
/**
 * record_sale no need- currently this api not used
 */

Route::post('record_sale', [ApireportsController::class,'record_sale'])->name('record.sale')->middleware('auth:sanctum');

//////////////////////////////////////////////////reports////////////////////////////////////

Route::post('asm_data', [ApireportsController::class,'asm_data'])->name('asm.data')->middleware('auth:sanctum');

Route::get('promoter_data', [ApireportsController::class,'promoter_data'])->name('promoter.data')->middleware('auth:sanctum');

Route::post('reports', [ApireportsController::class,'reports'])->name('reports')->middleware('auth:sanctum');

Route::post('promoter_reports', [ApireportsController::class,'promoter_reports'])->name('promoter.reports')->middleware('auth:sanctum');

Route::post('regional_reports', [ApireportsController::class,'regional_reports'])->name('regional.reports')->middleware('auth:sanctum');

Route::post('asm_reports', [ApireportsController::class,'asm_reports'])->name('asm.reports')->middleware('auth:sanctum');

Route::post('sub_dealer_reports', [ApireportsController::class,'sub_dealer_reports'])->name('sub.dealer.reports')->middleware('auth:sanctum');

Route::post('direct_dealer_reports', [ApireportsController::class,'direct_dealer_reports'])->name('direct.dealer.reports')->middleware('auth:sanctum');

Route::post('brand_leader_reports', [ApireportsController::class,'brand_leader_reports'])->name('brand.leader.reports')->middleware('auth:sanctum');

Route::post('distributor_reports', [ApireportsController::class,'distributor_reports'])->name('distributor.reports')->middleware('auth:sanctum');

Route::post('admin_reports', [ApireportsController::class,'admin_reports'])->name('admin.reports')->middleware('auth:sanctum');

Route::post('service_reports', [ApireportsController::class,'service_reports'])->name('service.reports')->middleware('auth:sanctum');

Route::post('service_status_list', [ApireportsController::class,'service_status_list'])->name('service.status.list')->middleware('auth:sanctum');


/////////////////////////////////////////////Attendance//////////////////////////////////////

Route::post('punch', [AttendanceController::class,'punch'])->name('punch')->middleware('auth:sanctum');

Route::post('attendance_store_list', [AttendanceController::class,'attendance_store_list'])->name('attendance.store.list')->middleware('auth:sanctum');

Route::post('user_day_attendance', [AttendanceController::class,'user_day_attendance'])->name('user.day.attendance')->middleware('auth:sanctum');

Route::post('admin_day_attendance', [AttendanceController::class,'admin_day_attendance'])->name('admin.day.attendance')->middleware('auth:sanctum');

Route::post('user_month_attendance', [AttendanceController::class,'user_month_attendance'])->name('user.month.attendance')->middleware('auth:sanctum');

Route::post('admin_month_attendance', [AttendanceController::class,'admin_month_attendance'])->name('admin.month.attendance')->middleware('auth:sanctum');

Route::post('attendance_user', [AttendanceController::class,'attendance_user'])->name('attendance.user')->middleware('auth:sanctum');
