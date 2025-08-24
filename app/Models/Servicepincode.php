<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicepincode extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_table_id','service_id','service_pincode'
       ];
}
