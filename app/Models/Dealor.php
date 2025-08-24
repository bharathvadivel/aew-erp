<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealor extends Model
{
    use HasFactory;
    protected $fillable = [
        'dealor_id','name','email','gstin_no','address','pin_code','phone','password','city','district','state','country','credit_limit','credit_days','status'
     ];
}
