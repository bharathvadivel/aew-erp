<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
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
        'item_price',
        'item_sub_total',
        'item_gst_percent',
        'tax_amount',
        'state_gst_percent',
        'state_tax_amount',
        'central_gst_percent',
        'central_tax_amount',
        'item_net_total'
    ];
}
