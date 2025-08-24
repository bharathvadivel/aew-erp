<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_code',
        'material_desc',
        'category',
        'item_group_code',
        'item_group_desc',
        'uom',
        'total_stock_qty',
        'consider_build_count',
        'deleted_status',
        // add any other attributes that should be fillable
    ];
}