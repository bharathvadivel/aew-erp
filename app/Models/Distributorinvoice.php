<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributorinvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'partnerinvoice_no','partner_id','partner_name','by_order_no','date','ew_bill_no','others','gst','hsn_code','gstin_no','gategory_id','gategory','description','model_no','qty','stock','price','billing_price','total','sub_total','taxable_value','tcs_val','round_off','grand_total','credit_days','credit_limit','available_limit','partner_type','address','pincode','city','district','state','country','sub_location_id','created_by','from_location_id','from_address','delivery_location_id','delivery_address','ch_box_status','tcs','order_id','order_by'
     ];


    /**
     *Distributor partners
     */
    public function partners()
    {
        return $this->hasOne(Distributor::class, 'partner_id', 'partner_id');
    }
}
