<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_code','model_no','hsn_code','ean','description','product_type','compatible_models','gategory_id','brand_id','basic_allowance','sta','gst','mrp','mop','bajaj_status','enquiry_status','product_status'
    ];

    /**
    ** brand
    **/
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    /**
    ** Category
    **/
    public function gategory()
    {
        return $this->hasOne(Gategory::class, 'id', 'gategory_id');
    }
}
