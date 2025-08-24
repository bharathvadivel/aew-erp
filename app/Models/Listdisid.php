<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listdisid extends Model
{
    use HasFactory;
    protected $fillable = [
        'asm_id','partner_id','partner_type','type'
       ];
}
