<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no',
        'item_type',
        'item_code',
        'item_desc',
        'item_add_desc',
        'item_hsnsac_code',
        'item_qty',
        'item_uom',
    ];
}
