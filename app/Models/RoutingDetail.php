<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_code',
        'operation_name',
        'operation_desc',
        'status',
        'remarks'
    ];
}
