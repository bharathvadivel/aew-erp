<?php

namespace App\Exports;

use App\Models\PModel;
use App\Models\Material;
use App\Models\MaterialCompatibleModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BomStockExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $materialstocks;

    public function __construct($materialstocks)
    {
        $this->materialstocks = $materialstocks;
    }
    
    public function collection()
    {   
        return $this->materialstocks;
    }

    public function map($materialstocks): array
    {   
        return [
            $materialstocks->model_code,
            $materialstocks->material_code,
            $materialstocks->material_desc,
            $materialstocks->category,
            $materialstocks->total_stock_qty,
            $materialstocks->uom,
            $materialstocks->consider_build_count,
            $materialstocks->min_assembly_qty_set,
        ] ;
    }

    public function headings(): array
    {
        return [
            'Model Code',
            'Item Code',
            'Item Description',
            'Category',
            'Total Stock Qty',
            'UOM',
            'Consider Build Count',
            'Min. Assembly Qty'
        ];
    }
}
