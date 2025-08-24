<?php

namespace App\Imports;

use App\Models\Pricemaster;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PriceImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pricemaster([
            'product_code'    => $row['product_code'], 
            'product_name'    => $row['product_name'], 
            'product_category'    => $row['product_category'], 
            'model_no'    => $row['model_no'], 
            'price'    => $row['price'],
            'discount_mrp'    => $row['discount_mrp'], 
            'distributor'    => $row['distributor'], 
            'dealor'    => $row['dealer'], 
        ]);
    }
}
