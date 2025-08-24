<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disserial extends Model
{
  use HasFactory;
    protected $fillable = [
        'disinvoice_no','gategory_id','gategory','product_code','model_no','description','serial_no','dis_id','remarks'
       ];

}
