<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssemblyBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'invoice_due_date',
        'customer_name',
        'customer_bill_address',
        'customer_ship_address',
        'customer_mobile_no',
        'customer_gst_no',
        'discount',
        'gst_percentage',
        'taxable_value',
        'subtotal',
        'net_total',
        'client_note'
    ];
}
