<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssemblyBillDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no','invoice_date','item_type','item_code','item_desc','item_price','item_qty','item_sub_total','item_gst_percent','item_total'
    ];
}
