<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partmodels extends Model
{
    use HasFactory;
    protected $fillable = ['partcodes_id','model_no'];
}
