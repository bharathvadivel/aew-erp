<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listasmid extends Model
{
    use HasFactory;

    protected $fillable = [
        'regional_id','asm_id'
       ];
}
