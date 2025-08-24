<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InwardInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'inward_bill_type',
        'invoice_date',
        'customer_bill_no',
        'customer_bill_date',
        'customer_id',
        'customer_name',
        'customer_bill_address',
        'customer_ship_address',
        'customer_mobile_no',
        'customer_gst_no',
        'subtotal',
        'discount',
        'taxable_value',
        'gst_percentage',
        'gst_amount',
        'net_total',
        'client_note'
    ];
}
