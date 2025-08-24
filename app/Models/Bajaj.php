<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bajaj extends Model
{
    use HasFactory;

    /**
     *Brand
     */
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

        /**
     *Category
     */
    public function gategory()
    {
        return $this->hasOne(Gategory::class, 'id', 'gategory_id');
    }

      /**
     *Product
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'model_no', 'model_no');
    }
}
