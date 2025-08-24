<?php

namespace App\Imports;

use App\Models\Disinvoice;
use Maatwebsite\Excel\Concerns\ToModel;

class Dinvoice implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Disinvoice([
            'serial_no'    => $row['serial_no']
        ]);
    }
}
