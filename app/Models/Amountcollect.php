<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Amountcollect extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = [
       'invoice_no', 'payment_mode','reference_no','amount','available_limit','credit_limit','partner_id','partner_type','partner_name','partner_store_name','proof','remarks','payment_status','login_id','login_name','login_type'
     ];
}
