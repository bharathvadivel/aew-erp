<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Promoter extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = [
        'promoter_id','name','proof','email','dob','dealor_id','phone','password','address','pin_code','district','city','state','country','created_id','status'
     ];


          public function scopeProof($query, $image)
    {
        return url('/application/promoter') . '/' . $image;
    }

}
