<?php

use App\Exports\PriceExport;
use App\Exports\NoStockExport;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\InwardInvoiceController;
use App\Http\Controllers\InwardDCController;
use App\Http\Controllers\DCController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ABController;
use App\Http\Controllers\MBController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\LAController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DispatchController;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

use App\Imports\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('/');
Route::get('/register', [LoginController::class, 'register']);
Route::get('/dashboard', [DashboardController::class, 'sample']);
Route::post('/user_login', [LoginController::class, 'login']);
Route::post('/login_by_admin', [LoginController::class, 'login_by_admin'])->name('login.by.admin');
Route::post('/sent_otp', [LoginController::class, 'sent_otp'])->name('sent.otp');
Route::post('/resent_otp', [LoginController::class, 'resent_otp'])->name('resent.otp');
Route::post('/verify_otp', [LoginController::class, 'verify_otp'])->name('verify.otp');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//////////////////////////////////// Admins ////////////////////////////////////
Route::controller(UserController::class)->group(function () {
    Route::get('/user_profile', 'index')->name('user.profile');
    Route::post('/user_update', 'user_update')->name('user.update');
    Route::post('/user_password_update', 'user_password_update')->name('user.password.update');
    Route::post('/costing_password_update', 'costing_password_update')->name('costing.password.update');
});

//////////////////////////////////// Dashboard ////////////////////////////////////
Route::controller(DashboardController::class)->group(function () {
    Route::get('admin_dashboard', 'index')->name('admin.dashboard');
    Route::post('admin_dashboard', 'index_filter')->name('admin.dashboard');
});

//////////////////////////////////// Units ////////////////////////////////////
Route::controller(UnitController::class)->group(function () {
    Route::get('/unit_master', 'unit_master')->name('unit.master')->middleware('AATA');
    Route::get('/add_unit', 'index')->name('add.unit')->middleware('AATB');
    Route::post('/unit_store', 'unit_store')->name('unit.store')->middleware('AATB');
    Route::get('/unit_edit/{id}', 'unit_edit')->name('unit.edit')->middleware('AATB');
    Route::post('/unit_update', 'unit_update')->name('unit.update')->middleware('AATB');
    Route::get('/unit_delete/{id}', 'unit_delete')->middleware('AATB');
});

//////////////////////////////////// Models ////////////////////////////////////
Route::controller(ModelController::class)->group(function () {
    Route::get('/model_master', 'model_master')->name('model.master')->middleware('AATA');
    Route::get('/add_model', 'index')->name('add.model')->middleware('AATB');
    Route::post('/model_store', 'model_store')->name('model.store')->middleware('AATB');
    Route::get('/model_edit/{id}', 'model_edit')->name('model.edit')->middleware('AATB');
    Route::post('/model_update', 'model_update')->name('model.update')->middleware('AATB');
    Route::get('/model_delete/{id}', 'model_delete')->middleware('AATB');

    Route::post('/update_model_adj_qty', 'update_model_adj_qty')->name('update.model.adj.qty')->middleware('AATB');
});

//////////////////////////////////// Items ////////////////////////////////////
Route::controller(ItemController::class)->group(function () {
    Route::get('/item_type_master', 'item_type_master')->name('item.type.master')->middleware('AATA');
    Route::get('/add_item_type', 'add_item_type')->name('add.item.type')->middleware('AATB');
    Route::post('/item_type_store', 'item_type_store')->name('item.type.store')->middleware('AATB');
    Route::get('/item_type_edit/{id}', 'item_type_edit')->name('item.type.edit')->middleware('AATB');
    Route::post('/item_type_update', 'item_type_update')->name('item.type.update')->middleware('AATB');
    Route::get('/item_type_delete/{id}', 'item_type_delete')->middleware('AATB');

    Route::get('/item_group_master', 'item_group_master')->name('item.group.master')->middleware('AATA');
    Route::get('/add_item_group', 'add_item_group')->name('add.item.group')->middleware('AATB');
    Route::post('/item_group_store', 'item_group_store')->name('item.group.store')->middleware('AATB');
    Route::get('/item_group_edit/{id}', 'item_group_edit')->name('item.group.edit')->middleware('AATB');
    Route::post('/item_group_update', 'item_group_update')->name('item.group.update')->middleware('AATB');
    Route::get('/item_group_delete/{id}', 'item_group_delete')->middleware('AATB');
});

//////////////////////////////////// Material ////////////////////////////////////
Route::controller(MaterialController::class)->group(function () {
    Route::get('/material_master', 'material_master')->name('material.master')->middleware('AATA');
    Route::get('/add_material', 'index')->name('add.material')->middleware('AATB');
    Route::get('/import_materials_list', 'import_materials_list')->name('material.list.import')->middleware('AATB');
    Route::get('/import_materials_qty_list', 'import_materials_qty_list')->name('material.list.qty.import')->middleware('AATB');
    
    Route::post('/import_materials', 'import_materials')->name('add.material.list')->middleware('AATB');
    Route::post('/import_material_compatibles', 'import_material_compatibles')->name('add.material.list')->middleware('AATB');
    Route::post('/import_update_materials', 'import_update_materials')->name('update.material.list')->middleware('AATB');

    Route::post('/material_product_select', 'material_product_select')->name('material.product.select')->middleware('AATB');
    Route::post('/material_model_insert', 'material_model_insert')->name('material.model.insert')->middleware('AATB');
    Route::post('/material_model_remove', 'material_model_remove')->name('material.model.remove')->middleware('AATB');
    
    Route::post('/material_store', 'material_store')->name('material.store')->middleware('AATB');
    Route::get('/material_edit/{id}', 'material_edit')->name('material.edit')->middleware('AATB');
    Route::post('/material_update', 'material_update')->name('material.update')->middleware('AATB');
    Route::get('/material_delete/{id}', 'material_delete')->middleware('AATB');

    Route::post('/gen_material_code', 'gen_material_code')->name('gen.material.code')->middleware('AATB');
    Route::post('/get_item_description', 'get_item_description')->name('get.item.description')->middleware('AATB');
    
    Route::post('/check_material_duplicate', 'check_material_duplicate')->name('check.material.duplicate')->middleware('AATB');
    Route::post('/check_material_duplicate_edit_page', 'check_material_duplicate_edit_page')->name('check.material.duplicate.edit.page')->middleware('AATB');

    Route::get('/download-items-import-sample', 'download_items_import_sample')->name('download.items.import.sample')->middleware('AATB');
    Route::get('/download-items-compatible-import-sample', 'download_items_compatible_import_sample')->name('download.items.compatible.import.sample')->middleware('AATB');

});

//////////////////////////////////// Costings ////////////////////////////////////
Route::controller(CostController::class)->group(function () {
    Route::get('/costing', 'index')->name('costing')->middleware('AATB');
    Route::post('/costing_password_check', 'costing_password_check')->name('costing.password.check')->middleware('AATB');
    Route::get('/costing_lock', 'costing_lock')->name('costing.lock')->middleware('AATB');
    Route::get('/costing_master', 'costing_master')->name('costing.master')->middleware('AATB');

    Route::get('/costing_edit/{material_code}', 'costing_edit')->name('costing.edit')->middleware('AATB');
    Route::post('/costing_update', 'costing_update')->name('costing.update')->middleware('AATB');

    Route::get('/import_costing', 'import_costing')->name('import.costing')->middleware('AATB');
    Route::post('/import_costing_data', 'import_costing_data')->name('import.costing.data')->middleware('AATB');
});

//////////////////////////////////// Product ////////////////////////////////////
Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'index')->name('product.master')->middleware('AATA');
    Route::get('/edit_fag_stock', 'edit_fag_stock')->name('edit.fag.stock')->middleware('AATB');
    Route::get('/fag_stock_update', 'fag_stock_update')->name('update.fag.stock')->middleware('AATB');

    Route::post('/import_fag_stock', 'import_fag_stock')->name('import.fag.stock')->middleware('AATB');

    Route::get('/export_no_stock_excel', 'export_no_stock_excel')->name('export.no.stock.excel')->middleware('AATB');
    Route::get('/export_low_stock_excel', 'export_low_stock_excel')->name('export.low.stock.excel')->middleware('AATB');

    Route::get('/export_bom_excel/{model_code}', 'export_bom_excel')->name('export.bom.excel')->middleware('AATB');
});

//////////////////////////////////// Contacts ////////////////////////////////////
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact_master', 'contact_master')->name('contact.master')->middleware('AATA');
    Route::get('/add_contact', 'add_contact')->name('add.contact')->middleware('AATB');
    Route::post('/contact_store', 'contact_store')->name('contact.store')->middleware('AATB');
    Route::get('/contact_edit/{id}', 'contact_edit')->name('contact.edit')->middleware('AATB');
    Route::post('/contact_update', 'contact_update')->name('contact.update')->middleware('AATB');
    Route::get('/contact_delete/{id}', 'contact_delete')->middleware('AATB');
    Route::post('/get_individual_customer_data', 'get_individual_customer_data')->name('get.customer.data.by.id')->middleware('AATB');

    Route::get('/import_contact_list', 'import_contact_list')->name('contact.import')->middleware('AATB');
    Route::post('/import_contact_store', 'import_contact_store')->name('import.contact.store')->middleware('AATB');

    Route::get('/import_contact_update_list', 'import_contact_update_list')->name('contact.update.import')->middleware('AATB');
    Route::post('/import_contact_update_store', 'import_contact_update_store')->name('import.contact.update.store')->middleware('AATB');
});

//////////////////////////////////// Employees ////////////////////////////////////
Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employee_master', 'employee_master')->name('employee.master')->middleware('AATA');
    Route::get('/add_employee', 'add_employee')->name('add.employee')->middleware('AATB');
    Route::post('/employee_store', 'employee_store')->name('employee.store')->middleware('AATB');
    Route::get('/employee_edit/{id}', 'employee_edit')->name('employee.edit')->middleware('AATB');
    Route::post('/employee_update', 'employee_update')->name('employee.update')->middleware('AATB');
    Route::get('/employee_delete/{id}', 'employee_delete')->middleware('AATB');

    Route::post('/get_individual_employee_data', 'get_individual_employee_data')->name('get.employee.data.by.id')->middleware('AATB');
});

//////////////////////////////////// Job Cards ////////////////////////////////////
Route::controller(JobsController::class)->group(function () {
    Route::get('/job_card_master', 'job_card_master')->name('job.card.master')->middleware('AATA');
    Route::get('/department_wise_master', 'department_wise_master')->name('department.wise.master')->middleware('AATA');
    Route::post('/department_wise_master', 'department_wise_master_filter')->name('department.wise.master')->middleware('AATA');
    Route::get('/add_job_card', 'add_job_card')->name('add.job.card')->middleware('AATB');
    Route::post('/job_card_store', 'job_card_store')->name('job.card.store')->middleware('AATB');
    Route::get('/job_card_edit/{id}', 'job_card_edit')->name('job.card.edit')->middleware('AATB');
    Route::post('/job_card_update', 'job_card_update')->name('job.card.update')->middleware('AATB');
    Route::get('/job_card_delete/{id}', 'job_card_delete')->middleware('AATB');

    Route::post('/get_model_detail', 'get_model_detail')->name('get.model.detail')->middleware('AATB');
});

//////////////////////////////////// Sales ////////////////////////////////////
Route::controller(SalesController::class)->group(function () {
    Route::get('/invoice_master', 'invoice_master')->name('invoice.master')->middleware('AATA');
    Route::post('/invoice_master', 'invoice_master_filter')->name('invoice.master')->middleware('AATA');
    Route::get('/add_invoice', 'index')->name('add.invoice')->middleware('AATB');
    Route::post('/inv_itemcode_select', 'inv_itemcode_select')->name('inv.itemcode.select')->middleware('AATB');
    Route::post('/inv_product_select', 'inv_product_select')->name('inv.product.select')->middleware('AATB');
    
    Route::post('/invoiceno', 'invoiceno')->name('invoiceno')->middleware('AATB');
    Route::post('/invoice_item_insert', 'invoice_item_insert')->name('invoice.item.insert')->middleware('AATB');
    Route::post('/invoice_item_remove', 'invoice_item_remove')->name('invoice.item.remove')->middleware('AATB');

    Route::post('/invoice_store', 'invoice_store')->name('invoice.store')->middleware('AATB');

    Route::get('/invoice_edit/{id}', 'invoice_edit')->name('invoice.edit')->middleware('AATB');
    Route::post('/invoice_update', 'invoice_update')->name('invoice.update')->middleware('AATB');
    Route::delete('/invoice_delete/{invoice_no}', 'invoice_delete')->name('invoice.delete')->middleware('AATB');

    Route::get('/generateopdf/{invoice_no}', 'generate_o_invoice_pdf')->name('invoice.generateopdf')->middleware('AATB');
    Route::get('/generatebpdf/{invoice_no}', 'generate_b_invoice_pdf')->name('invoice.generatebpdf')->middleware('AATB');
    Route::get('/generatedpdf/{invoice_no}', 'generate_d_invoice_pdf')->name('invoice.generatedpdf')->middleware('AATB');
    Route::get('/generateepdf/{invoice_no}', 'generate_e_invoice_pdf')->name('invoice.generateepdf')->middleware('AATB');
});

//////////////////////////////////// Orders ////////////////////////////////////
Route::controller(OrderController::class)->group(function () {
    Route::get('/order_master', 'order_master')->name('order.master')->middleware('AATA');
    Route::post('/order_master', 'order_master_filter')->name('order.master')->middleware('AATA');

    Route::get('/manage_orders', 'manage_orders')->name('manage.orders')->middleware('AATA');
    Route::post('/manage_orders', 'manage_orders_filter')->name('manage.orders')->middleware('AATA');

    Route::get('/orders/{id}', 'orders_by_customer_id')->name('orders.by.customer.id')->middleware('AATA');

    Route::get('/add_order', 'add_order')->name('add.order')->middleware('AATB');
    Route::post('/order_itemcode_select', 'order_itemcode_select')->name('order.itemcode.select')->middleware('AATB');
    Route::post('/order_product_select', 'order_product_select')->name('order.product.select')->middleware('AATB');
    
    Route::post('/order_item_insert', 'order_item_insert')->name('order.item.insert')->middleware('AATB');
    Route::post('/order_item_remove', 'order_item_remove')->name('order.item.remove')->middleware('AATB');

    Route::post('/order_store', 'order_store')->name('order.store')->middleware('AATB');

    Route::get('/order_edit/{id}', 'order_edit')->name('order.edit')->middleware('AATB');
    Route::post('/order_update', 'order_update')->name('order.update')->middleware('AATB');
    Route::delete('/order_delete/{invoice_no}', 'order_delete')->name('order.delete')->middleware('AATB');
});

//////////////////////////////////// Dispatch ////////////////////////////////////
Route::controller(DispatchController::class)->group(function () {
    Route::get('/dispatch_master', 'dispatch_master')->name('dispatch.master')->middleware('AATA');
    Route::post('/dispatch_master', 'dispatch_master_filter')->name('dispatch.master')->middleware('AATA');

    Route::get('/manage_dispatch', 'manage_dispatch')->name('manage.dispatch')->middleware('AATA');
    Route::post('/manage_dispatch', 'manage_dispatch_filter')->name('manage.dispatch')->middleware('AATA');

    Route::get('/dispatch/{id}', 'dispatch_by_customer_id')->name('dispatch.by.customer.id')->middleware('AATA');

    Route::get('/add_dispatch', 'add_dispatch')->name('add.dispatch')->middleware('AATB');
    Route::post('/dispatch_itemcode_select', 'dispatch_itemcode_select')->name('dispatch.itemcode.select')->middleware('AATB');
    Route::post('/dispatch_product_select', 'dispatch_product_select')->name('dispatch.product.select')->middleware('AATB');
    
    Route::post('/dispatch_item_insert', 'dispatch_item_insert')->name('dispatch.item.insert')->middleware('AATB');
    Route::post('/dispatch_item_remove', 'dispatch_item_remove')->name('dispatch.item.remove')->middleware('AATB');

    Route::post('/dispatch_store', 'dispatch_store')->name('dispatch.store')->middleware('AATB');

    Route::get('/dispatch_edit/{id}', 'dispatch_edit')->name('dispatch.edit')->middleware('AATB');
    Route::post('/dispatch_update', 'dispatch_update')->name('dispatch.update')->middleware('AATB');
    Route::delete('/dispatch_delete/{invoice_no}', 'dispatch_delete')->name('dispatch.delete')->middleware('AATB');
});

//////////////////////////////////// Production ////////////////////////////////////
Route::controller(ProductionController::class)->group(function () {
    Route::get('/production', 'index')->name('production.report')->middleware('AATA');

    Route::get('/production_requirement_report', 'production_requirement_report')->name('production.requirement.report')->middleware('AATA');

    Route::get('/daily_plan', 'daily_plan')->name('daily.plan')->middleware('AATA');
    Route::post('/add_daily_plan', 'add_daily_plan')->name('add.daily.plan')->middleware('AATA');
    Route::post('/update_daily_plan', 'update_daily_plan')->name('update.daily.plan')->middleware('AATA');
    Route::get('/delete_daily_plan/{id}', 'delete_daily_plan')->name('delete.daily.plan')->middleware('AATA');
});

//////////////////////////////////// Inward Invoices ////////////////////////////////////
Route::controller(InwardInvoiceController::class)->group(function () {
    Route::get('/inwd_invoice_master', 'inwd_invoice_master')->name('inwd.invoice.master')->middleware('AATA');
    Route::post('/inwd_invoice_master', 'inwd_invoice_master_filter')->name('inwd.invoice.master')->middleware('AATA');
    Route::get('/add_inwd_invoice', 'index')->name('add.inwd.invoice')->middleware('AATB');
    Route::post('/inwd_itemcode_select', 'inwd_itemcode_select')->name('inwd.itemcode.select')->middleware('AATB');
    Route::post('/inwd_product_select', 'inwd_product_select')->name('inwd.product.select')->middleware('AATB');
    
    Route::post('/get_inwd_bill_no', 'get_inwd_bill_no')->name('get.inwd.bill.no')->middleware('AATB');

    Route::post('/inwd_invoice_item_insert', 'inwd_invoice_item_insert')->name('inwd.invoice.item.insert')->middleware('AATB');
    Route::post('/inwd_invoice_item_remove', 'inwd_invoice_item_remove')->name('inwd.invoice.item.remove')->middleware('AATB');

    Route::post('/inwd_invoice_store', 'inwd_invoice_store')->name('inwd.invoice.store')->middleware('AATB');

    Route::get('/inwd_invoice_edit/{id}', 'inwd_invoice_edit')->name('inwd.invoice.edit')->middleware('AATB');
    Route::post('/inwd_invoice_update', 'inwd_invoice_update')->name('inwd.invoice.update')->middleware('AATB');
    Route::delete('/inwd_invoice_delete/{invoice_no}', 'inwd_invoice_delete')->name('inwd.invoice.delete')->middleware('AATB');

    Route::get('/inwd_generatepdf/{invoice_no}', 'generate_inwd_invoice_pdf')->name('inwd.invoice.generatepdf')->middleware('AATB');
});

//////////////////////////////////// Inward DC ////////////////////////////////////
Route::controller(InwardDCController::class)->group(function () {
    Route::get('/inwd_dc_master', 'inwd_dc_master')->name('inwd.dc.master')->middleware('AATA');
    Route::post('/inwd_dc_master', 'inwd_dc_master_filter')->name('inwd.dc.master')->middleware('AATA');
    Route::get('/add_inwd_dc', 'index')->name('add.inwd.dc')->middleware('AATB');
    Route::post('/inwd_itemcode_select', 'inwd_itemcode_select')->name('inwd.itemcode.select')->middleware('AATB');
    Route::post('/inwd_product_select', 'inwd_product_select')->name('inwd.product.select')->middleware('AATB');

    Route::post('/inwd_dc_item_insert', 'inwd_dc_item_insert')->name('inwd.dc.item.insert')->middleware('AATB');
    Route::post('/inwd_dc_item_remove', 'inwd_dc_item_remove')->name('inwd.dc.item.remove')->middleware('AATB');

    Route::post('/inwd_dc_store', 'inwd_dc_store')->name('inwd.dc.store')->middleware('AATB');

    Route::get('/inwd_dc_edit/{id}', 'inwd_dc_edit')->name('inwd.dc.edit')->middleware('AATB');
    Route::post('/inwd_dc_update', 'inwd_dc_update')->name('inwd.dc.update')->middleware('AATB');
    Route::delete('/inwd_dc_delete/{dc_no}', 'inwd_dc_delete')->name('inwd.dc.delete')->middleware('AATB');

    Route::get('/inwd_generatepdf/{dc_no}', 'generate_inwd_dc_pdf')->name('inwd.dc.generatepdf')->middleware('AATB');
});

//////////////////////////////////// Delivery Challans ////////////////////////////////////
Route::controller(DCController::class)->group(function () {
    Route::get('/dc_master', 'dc_master')->name('dc.master')->middleware('AATA');
    Route::post('/dc_master', 'dc_master_filter')->name('dc.master')->middleware('AATA');
    Route::get('/add_dc', 'index')->name('add.dc')->middleware('AATB');
    Route::post('/dc_itemcode_select', 'dc_itemcode_select')->name('dc.itemcode.select')->middleware('AATB');
    Route::post('/dc_product_select', 'dc_product_select')->name('dc.product.select')->middleware('AATB');
    
    Route::post('/dcno', 'dcno')->name('dcno')->middleware('AATB');
    Route::post('/dc_item_insert', 'dc_item_insert')->name('dc.item.insert')->middleware('AATB');
    Route::post('/dc_item_remove', 'dc_item_remove')->name('dc.item.remove')->middleware('AATB');

    Route::post('/dc_store', 'dc_store')->name('dc.store')->middleware('AATB');

    Route::get('/dc_edit/{id}', 'dc_edit')->name('dc.edit')->middleware('AATB');
    Route::post('/dc_update', 'dc_update')->name('dc.update')->middleware('AATB');
    Route::delete('/dc_delete/{dc_no}', 'dc_delete')->name('dc.delete')->middleware('AATB');

    Route::get('/generatedcpdf/{dc_no}', 'generate_dc_pdf')->name('dc.generatepdf')->middleware('AATB');
});

//////////////////////////////////// Routing ////////////////////////////////////
Route::controller(RoutingController::class)->group(function () {
    Route::get('/routing_master', 'routing_master')->name('routing.master')->middleware('AATA');
    // Route::get('/add_routing', 'index')->name('add.routing')->middleware('AATB');
    
    Route::post('/routingno', 'routingno')->name('routingno')->middleware('AATB');
    Route::post('/routing_item_insert', 'routing_item_insert')->name('routing.item.insert')->middleware('AATB');
    Route::post('/routing_item_remove', 'routing_item_remove')->name('routing.item.remove')->middleware('AATB');

    // Route::post('/routing_store', 'routing_store')->name('routing.store')->middleware('AATB');

    Route::get('/routing_edit/{material_code}', 'routing_edit')->name('routing.edit')->middleware('AATB');
    Route::post('/routing_update', 'routing_update')->name('routing.update')->middleware('AATB');
    // Route::delete('/routing_delete/{material_code}', 'routing_delete')->name('routing.delete')->middleware('AATB');

    Route::get('/import_routing', 'import_routing')->name('import.routing')->middleware('AATB');
    Route::post('/import_routing_data', 'import_routing_data')->name('import.routing.data')->middleware('AATB');
});

//////////////////////////////////// Loss and Adjustments ////////////////////////////////////
Route::controller(LAController::class)->group(function () {
    Route::get('/la_master', 'la_master')->name('la.master')->middleware('AATA');
    Route::get('/add_la', 'index')->name('add.la')->middleware('AATB');
    Route::post('/la_itemcode_select', 'la_itemcode_select')->name('la.itemcode.select')->middleware('AATB');
    Route::post('/la_product_select', 'la_product_select')->name('la.product.select')->middleware('AATB');
    
    Route::post('/lano', 'lano')->name('lano')->middleware('AATB');
    Route::post('/la_item_insert', 'la_item_insert')->name('la.item.insert')->middleware('AATB');
    Route::post('/la_item_remove', 'la_item_remove')->name('la.item.remove')->middleware('AATB');

    Route::post('/la_store', 'la_store')->name('la.store')->middleware('AATB');

    Route::get('/la_edit/{material_code}', 'la_edit')->name('la.edit')->middleware('AATB');
    Route::post('/la_update', 'la_update')->name('la.update')->middleware('AATB');
    Route::delete('/la_delete/{material_code}', 'la_delete')->name('la.delete')->middleware('AATB');
});

//////////////////////////////////// Assembly Billing ////////////////////////////////////
Route::controller(ABController::class)->group(function () {
    Route::get('/ab_master', 'ab_master')->name('ab.master')->middleware('AATA');
    Route::post('/ab_master', 'ab_master_filter')->name('ab.master')->middleware('AATA');
    Route::get('/add_ab', 'index')->name('add.ab')->middleware('AATB');
    Route::post('/ab_itemcode_select', 'ab_itemcode_select')->name('ab.itemcode.select')->middleware('AATB');
    Route::post('/ab_product_select', 'ab_product_select')->name('ab.product.select')->middleware('AATB');
    
    Route::post('/abno', 'abno')->name('abno')->middleware('AATB');
    Route::post('/ab_item_insert', 'ab_item_insert')->name('ab.item.insert')->middleware('AATB');
    Route::post('/ab_item_remove', 'ab_item_remove')->name('ab.item.remove')->middleware('AATB');

    Route::post('/ab_store', 'ab_store')->name('ab.store')->middleware('AATB');

    Route::get('/ab_edit/{id}', 'ab_edit')->name('ab.edit')->middleware('AATB');
    Route::post('/ab_update', 'ab_update')->name('ab.update')->middleware('AATB');
    Route::delete('/ab_delete/{ab_no}', 'ab_delete')->name('ab.delete')->middleware('AATB');

    Route::get('/generatepdf/{ab_no}', 'generate_ab_pdf')->name('ab.generatepdf')->middleware('AATB');

    Route::get('/import_abill_list', 'import_abill_list')->name('assembly.bill.import')->middleware('AATB');
    Route::post('/import_abills', 'import_abills')->name('import.abills')->middleware('AATB');
});


//////////////////////////////////// Machine Billing ////////////////////////////////////
Route::controller(MBController::class)->group(function () {
    Route::get('/mb_master', 'mb_master')->name('mb.master')->middleware('AATA');
    Route::post('/mb_master', 'mb_master_filter')->name('mb.master')->middleware('AATA');
    Route::get('/add_mb', 'index')->name('add.mb')->middleware('AATB');
    Route::post('/mb_itemcode_select', 'mb_itemcode_select')->name('mb.itemcode.select')->middleware('AATB');
    Route::post('/mb_product_select', 'mb_product_select')->name('mb.product.select')->middleware('AATB');
    Route::post('/mb_process_product_select', 'mb_process_product_select')->name('mb.process.product.select')->middleware('AATB');
    
    Route::post('/mbno', 'mbno')->name('mbno')->middleware('AATB');
    Route::post('/mb_item_insert', 'mb_item_insert')->name('mb.item.insert')->middleware('AATB');
    Route::post('/mb_item_remove', 'mb_item_remove')->name('mb.item.remove')->middleware('AATB');

    Route::post('/mb_store', 'mb_store')->name('mb.store')->middleware('AATB');

    Route::get('/mb_edit/{id}', 'mb_edit')->name('mb.edit')->middleware('AATB');
    Route::post('/mb_update', 'mb_update')->name('mb.update')->middleware('AATB');
    Route::delete('/mb_delete/{mb_no}', 'mb_delete')->name('mb.delete')->middleware('AATB');

    Route::get('/generatepdf/{mb_no}', 'generate_mb_pdf')->name('mb.generatepdf')->middleware('AATB');

    Route::get('/import_machine_bill_list', 'import_machine_bill_list')->name('machine.bill.import')->middleware('AATB');
    Route::post('/import_machine_bills', 'import_machine_bills')->name('import.machine.bills')->middleware('AATB');
});

//////////////////////////////////// Reports ////////////////////////////////////
Route::controller(ReportController::class)->group(function () {
    Route::get('/stock_report', 'stock_report')->name('stock.report')->middleware('AATB');
    Route::get('/export_low_product_stock_excel', 'export_low_product_stock_excel')->name('export.low.product.stock')->middleware('AATB');

    Route::get('/export_low_product_stock_by_model_excel', 'export_low_product_stock_by_model_excel')->name('export.low.product.stock.by.model')->middleware('AATB');

    Route::get('/costing_model_report/{model_code}', 'costing_model_report')->name('costing.model.report')->middleware('AATB');

    Route::get('/order_dispatch_report', 'order_dispatch_report')->name('order.dispatch.report')->middleware('AATB');
});