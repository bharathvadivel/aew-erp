<?php

namespace App\Imports;

use App\Models\Material;
use App\Models\ItemGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MaterialImport implements ToModel, WithHeadingRow
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
    
            // If the material code exists, skip importing it
            if ($existingMaterial) {
                Log::info("Material with code $materialCode already exists. Skipping import.");
                return null;
            }
    
            // Create and save the new material
            $material = new Material([
                'material_code'        => $materialCode,
                'material_desc'        => $row['item_description'],
                'item_group_code'      => $row['item_group_code'],
                'item_group_desc'      => $row['item_group_description'],
                'category'             => $row['category'],
                'uom'                  => $row['unit_of_measure'],
                'total_stock_qty'      => $row['total_stock_qty'],
                'consider_build_count' => $row['consider_build_count']
            ]);
    
            $material->save();
    
            return $material;
        } catch (\Exception $e) {
            Log::error('Failed to import material: ' . $e->getMessage());
            throw $e;
        }

        // try {

        //     $material = new Material([
        //         'material_code'        => $row['item_code'],
        //         'material_desc'        => $row['item_description'],
        //         'item_group_code'      => $row['item_group_code'],
        //         'uom'                  => $row['unit_of_measure'],
        //         'total_stock_qty'      => $row['total_stock_qty']
        //     ]);

        //     $material->save();

        //     return $material;

        // } catch (\Exception $e) {
        //     Log::error('Failed to import material: ' . $e->getMessage());
        //     throw $e;
        // }
    }
}