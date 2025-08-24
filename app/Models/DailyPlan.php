<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyPlan extends Model
{
    use HasFactory;

    protected $table = 'daily_plans';
    
    protected $fillable = [
        'plan_date',
        'model_code',
        'qty'
    ];
}
