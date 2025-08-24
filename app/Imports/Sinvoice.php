<?php

namespace App\Imports;

use App\Models\Scpinvoice;
use Maatwebsite\Excel\Concerns\ToModel;

class Sinvoice implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Scpinvoice([
            'serial_no'    => $row['serial_no']
        ]);
    }
}
