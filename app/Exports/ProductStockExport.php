<?php

namespace App\Exports;

use App\Models\PModel;
use App\Models\Material;
use App\Models\MaterialCompatibleModel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Illuminate\Support\Collection;

class ProductStockExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $reqToBuild;

    public function __construct($reqToBuild)
    {
        // Convert $reqToBuild to a collection if it's not already
        $this->reqToBuild = is_array($reqToBuild) ? collect($reqToBuild) : $reqToBuild;
    }
    
    public function collection()
    {   
        // Group the collection by material_code and calculate sum for min_assembly_qty_set and required_to_build
        $grouped = $this->reqToBuild->groupBy('material_code')->map(function ($items) {
            $modelCodes = $items->pluck('model_code')->unique()->implode(','); // Concatenate unique model_codes
            return [
                'model_code' => $modelCodes,
                'material_code' => $items->first()->material_code,
                'material_desc' => $items->first()->material_desc,
                'category' => $items->first()->category,
                'item_group_code' => $items->first()->item_group_code,
                'item_group_desc' => $items->first()->item_group_desc,
                'consider_build_count' => $items->first()->consider_build_count,
                'min_assembly_qty_set' => $items->sum('min_assembly_qty_set'),
                'uom' => $items->first()->uom,
                'total_stock_qty' => $items->first()->total_stock_qty,
                'required_to_build' => $items->sum('required_to_build'),
            ];
        })->filter(function ($item) {
            // Filter only rows where total_stock_qty is less than required_to_build
            return $item['total_stock_qty'] < $item['required_to_build'];
        });

        return new Collection($grouped->values()->all());
    }

    public function map($reqToBuild): array
    {
        if (is_array($reqToBuild)) {
            // Convert the array to an object
            $reqToBuild = (object)$reqToBuild;
        }
        $modelCodes = is_array($reqToBuild->model_code) ? implode(',', $reqToBuild->model_code) : $reqToBuild->model_code;
        return [
            $modelCodes, // Modify this line to print model_codes
            $reqToBuild->material_code,
            $reqToBuild->material_desc,
            $reqToBuild->category,
            $reqToBuild->item_group_code,
            $reqToBuild->item_group_desc,
            $reqToBuild->consider_build_count,
            (string)$reqToBuild->min_assembly_qty_set,
            $reqToBuild->uom,
            (string)$reqToBuild->total_stock_qty,
            (string)$reqToBuild->required_to_build
        ];
    }

    public function headings(): array
    {
        return [
            'Model Code',
            'Item Code',
            'Item Description',
            'Category',
            'Item Group Code',
            'Item Group Name',
            'Consider to Build Count',
            'Min. Assembly Qty',
            'Unit of Measurement',
            'Total Stock Qty',
            'Required Qty To Build'
        ];
    }
}
