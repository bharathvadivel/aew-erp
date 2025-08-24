<?php

namespace App\Exports;

use App\Models\Pricemaster;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PriceExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        $head=Pricemaster::select('partner_id', 'partner_name')->groupBy('partner_id')->get();
        $val=array();
        foreach ($head as $key => $value) {
            $val[]='"'.$value->partner_id.'"';
        }
        $_words = implode(',', $val);

        return [" ","parner_id",$_words];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pricemaster::select('partner_id', 'partner_name')->first();
    }
}
