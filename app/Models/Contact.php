<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_type',
        'customer_name',
        'customer_billing_address',
        'customer_shipping_address',
        'customer_mobile_no',
        'customer_email',
        'customer_gst_no',
        'state_code'
    ];
}
