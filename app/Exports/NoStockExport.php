<?php

namespace App\Exports;

use App\Models\PModel;
use App\Models\Material;
use App\Models\MaterialCompatibleModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NoStockExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $material_data;

    public function __construct($material_data)
    {
        $this->material_data = $material_data;
    }
    
    public function collection()
    {   
        return $this->material_data;
    }

    public function map($material_data): array
    {
        return [
            $material_data->material_code,
            $material_data->material_desc,
            $material_data->item_group_code,
            $material_data->item_group_desc,
            (string)$material_data->total_stock_qty,
            $material_data->uom,
            $material_data->consider_build_count,
            $material_data->model_code,
            $material_data->min_assembly_qty_set,
        ] ;
    }

    public function headings(): array
    {
        return [
            'Item Code',
            'Item Description',
            'Item Group Code',
            'Item Group Name',
            'Total Stock Qty',
            'Unit of Measurement',
            'Consider to Build Count',
            'Model Code',
            'Min. Assembly Qty'
        ];
    }
}
