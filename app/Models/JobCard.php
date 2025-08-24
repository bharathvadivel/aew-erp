<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Sanctum\HasApiTokens;


class JobCard extends Model
{
    // use HasFactory,HasApiTokens;
    use HasFactory;
    
    protected $fillable = [
        'employee_id',
        'job_date',
        'worked_dept',
        'nature_of_work',
        'model_code',
        'assigned_qty',
        'approved_qty',
        'defective_qty',
        'start_time',
        'end_time',
        'remarks'
    ];
    // public function scopeProof($query, $image)
    // {
    //     return url('/application/employee') . '/' . $image;
    // }

}
