<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineBillDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no','invoice_date','from_item_code','from_item_qty','item_type','item_code','item_desc','item_category','item_price','item_qty','item_sub_total','item_gst_percent','item_total'
    ];
}
