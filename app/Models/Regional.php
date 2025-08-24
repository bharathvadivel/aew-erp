<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Regional extends Model
{
    use HasApiTokens,HasFactory;

    protected $fillable = [
        'regional_id','name','email','dob','phone','password','address','pin_code','district','city','state','country','created_id','status'
     ];
}
