<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'customer_id',
        'subtotal',
        'discount',
        'taxable_value',
        'gst_percentage',
        'total_gst_amount',
        'round_off_value',
        'net_total',
        'declaration',
        'delivery_note',
        'terms_of_payment',
        'buyer_order_no',
        'buyer_order_date',
        'dispatch_doc_no',
        'delivery_note_date',
        'dispatch_through',
        'destination',
        'terms_of_delivery'
    ];
}
