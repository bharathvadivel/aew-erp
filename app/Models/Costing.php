<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costing extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'pricing',
        'up_down_same',
        'how_much',
        'entry_origin',
        'inwd_invoice_no'
        // add any other attributes that should be fillable
    ];
}