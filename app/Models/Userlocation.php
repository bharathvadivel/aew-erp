<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userlocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'partner_type','partner_id','created_id','location_id','address','pincode','city','district','lat','lang'
     ];
}
