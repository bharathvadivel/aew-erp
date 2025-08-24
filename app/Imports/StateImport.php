<?php

namespace App\Imports;

use App\Models\State;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StateImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new State([
          'pincode'     => $row['pincode'],
            'area'    => $row['area'],
            'city'    => $row['city'],
            'district'    => $row['district'],
            'state'    => strtoupper($row['state']),
            'country'    => $row['country'],
          'city_code'     => $row['citycode'],

        ]);
    }
}
