<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScpReturnStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'transfer_no','from_service_id','to_warehouse_id','gategory_id','gategory','product_code','model_no','description','serial_no','stock','status','login_id'
       ];
}
