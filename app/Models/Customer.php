<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Customer extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = [
       'customer_id','name','address','pincode','phone','district','city','area','state','customerinvoice_no','partner_id','promoter_id','status'
     ];
}
