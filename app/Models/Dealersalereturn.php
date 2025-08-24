<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealersalereturn extends Model
{
    use HasFactory;
    protected $fillable = [
        'salereturn_no','partnerinvoice_no','partner_id','partner_name','partner_type','location_id','by_order_no','date','ew_bill_no','others','gst','hsn_code','gstin_no','gategory_id','gategory','description','model_no','qty','stock','price','billing_price','total','sub_total','taxable_value','tcs_val','round_off','grand_total','credit_days','credit_limit','available_limit','partner_type','address','pincode','city','district','state','country','created_by','delivery_id','delivery_location_id','delivery_address','tcs'
     ];
}
