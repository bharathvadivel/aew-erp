<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warserial extends Model
{
    use HasFactory;
    protected $fillable = [
        'serial_no','customer_name','customer_phone','gategory_id','gategory','model_no','dom','date_of_purchase','standard_warranty','extended_warranty','part1','part1_warranty','part2','part2_warranty','standard_warranty_exp_date','extended_warranty_exp_date','part1_warranty_exp_date','part2_warranty_exp_date','remarks'
    ];

     public function scopeProof($query, $image)
    {
        return url('/application/warranty') . '/' . $image;
    }
        /**
     *Product details
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'model_no', 'model_no');
    }
}
