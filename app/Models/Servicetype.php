<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicetype extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_table_id','service_id','service_pincode_id','service_type','gategory_id'
       ];
}
