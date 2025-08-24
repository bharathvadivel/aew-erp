<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryChallanDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'dc_no','dc_date','item_type','item_code','item_desc','item_additional_desc','item_hsnsac_code','item_price','item_qty','item_uom','item_sub_total','item_gst_percent','item_total'
    ];
}