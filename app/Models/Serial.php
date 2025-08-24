<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    use HasFactory;
    protected $fillable = [
              'purchase_no',
        'warehouse_id',
        'gategory_id',
        'gategory',
        'product_code',
        'model_no',
        'description',
        'serial_no',
        'dom',
        'remarks',
        'price',
        'gst',
        'date',
        'suppliers',
        'type'
       ];
}
