<?php

namespace App\Exports;

use App\Models\PModel;
use App\Models\Material;
use App\Models\MaterialCompatibleModel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Collection;

class CostingModelExport implements FromCollection, WithHeadings
{
    protected $costModelList;

    public function __construct($costModelList)
    {
        $this->costModelList = $costModelList;
    }

    public function collection()
    {
        return $this->costModelList;
    }

    public function headings(): array
    {
        return [
            'Material Code', 
            'Material Description',
            'Total Stock Qty',
            'UOM',
            'Purchase Cost',
            'Min Assembly Qty Set',
            'Material Cost',
            'Up Down Same',
            'How Much',
            'Customer Bill No',
            'Customer Bill Date',
            'Customer Name',
        ];
    }
}
