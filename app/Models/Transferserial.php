<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferserial extends Model
{
    use HasFactory;
    protected $fillable = [
        'transfer_no','from_warehouse_id','to_warehouse_id','gategory_id','gategory','product_code','model_no','description','stock','dom','login_id'
       ];
}
