<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesExecutive extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sales_executive_id','name','email','phone','address','pin_code','district','city','state','country','status'
     ];
}
