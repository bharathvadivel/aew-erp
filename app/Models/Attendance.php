<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
        protected $fillable = [
        'date','partner_id','partner_type','name','place','in_time','out_time','working_time','status','days','remarks'
       ];
}
