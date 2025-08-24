<?php

namespace App\Exports;

use App\Models\State;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportState implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return State::select("pincode", "city_code", "area","city","district","state","country","status","created_at")->get();
    }
      public function headings(): array
    {
         return ["pincode", "city_code", "area","city","district","state","country","status","created_at"];

}
}
