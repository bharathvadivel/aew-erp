<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricemaster extends Model
{
    use HasFactory;
    protected $fillable = [
      'partner_name','partner_id','partner_type','model_no','mop','billing_price'
     ];
}
