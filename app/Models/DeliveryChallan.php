<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryChallan extends Model
{
    use HasFactory;

    protected $fillable = [
        'dc_no',
        'dc_date',
        'dc_due_date',
        'customer_id',
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
        'client_note',
        'remarks',
        'buyer_order_no',
        'buyer_order_date',
        'dispatch_doc_no',
        'dispatch_through',
        'destination',
        'terms_of_delivery'
    ];
}
