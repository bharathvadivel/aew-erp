<?php

namespace App\Imports;

use App\Models\Material;
use App\Models\ItemGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MaterialUpdateImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        try {

            $IGCode = $row['item_group_code'];
            // Check if the item group code already exists in the database
            $existingItemGroup = ItemGroup::where('item_group_code', $IGCode)->first();
            // If the material code exists, update the existing material
            if ($existingItemGroup) {
                $existingItemGroup->update([
                    'item_group_code' => $row['item_group_code'],
                    'item_group_desc' => $row['item_group_description']
                    // Add more fields to update as needed
                ]);
            }

            $materialCode = $row['item_code'];
    
            // Check if the material code already exists in the database
            $existingMaterial = Material::where('material_code', $materialCode)->first();
    
            // If the material code exists, update the existing material
            if ($existingMaterial) {
                $existingMaterial->update([
                    'material_desc'         => $row['description'],
                    'item_group_code'       => $row['item_group_code'],
                    'item_group_desc'       => $row['item_group_description'],
                    'category'              => $row['category'],
                    'uom'                   => $row['uom'],
                    'total_stock_qty'       => $row['total_stock_qty'],
                    'consider_build_count'  => $row['consider_build_count']
                    // Add more fields to update as needed
                ]);

                Log::info("Item with code $materialCode updated successfully.");

                return $existingMaterial;
            }
    
            // If the material code doesn't exist, skip importing it
            Log::info("Item with code $materialCode not found. Skipping Import!.");

            return null;
        } catch (\Exception $e) {
            Log::error('Failed to import items: ' . $e->getMessage());
            throw $e;
        }
    }
}