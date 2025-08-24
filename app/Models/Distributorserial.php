<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributorserial extends Model
{
  use HasFactory;
    protected $fillable = [
        'partnerinvoice_no','gategory_id','product_code','model_no','description','serial_no','remarks','partner_id'
       ];
}
