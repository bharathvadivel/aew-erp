<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialCompatibleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_code',
        'model_code',
        'min_assembly_qty_set',
        // add any other attributes that should be fillable
    ];
}