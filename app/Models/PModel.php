<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PModel extends Model
{
    use HasFactory;

    protected $table = 'p_models';
    
    protected $fillable = [
        'model_code',
        'model_name',
        'model_desc',
        'adjust_production_qty',
        'fully_assembled_qty',
        'power',
        'head_range',
        'discharge',
        'pipe_size',
        'order',
        'status'
    ];
}
