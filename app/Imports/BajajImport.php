<?php

namespace App\Imports;

use App\Models\Bajaj;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BajajImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    
    public function model(array $row)
    {
        return new Bajaj([
            'brand_name'    => $row['brand_name'],
            'gategory_name'    => $row['categories'],
            'product_code'    => $row['product_code'],
            'description'    => $row['description'],
            'model_no'    => $row['model_no'],
            'serial_no'    => $row['serial_number'],
        ]);
    }
}
