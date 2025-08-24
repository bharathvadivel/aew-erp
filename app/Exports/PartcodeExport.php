<?php

namespace App\Exports;

use App\Models\Partcode;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PartcodeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Partcode::select("id", "part_code", "created_at")->get();
    }
     public function headings(): array
    {
        return ["id", "part_code", "created_at"];
    }
}
