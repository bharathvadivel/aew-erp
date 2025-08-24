<?php

namespace App\Imports;

use App\Models\Material;
use App\Models\ItemGroup;
use App\Models\Routing;
use App\Models\RoutingDetail;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RoutingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {   
        try {
            $material_code = $row['item_code'];
            $converted_to_item_code = $row['converted_to_item_code'];
            $note = $row['routing_note'];
    
            // Check if the invoice_no already exists in the database
            $existingRoute = Routing::where('material_code', $material_code)->first();
    
            // If the invoice_no exists, skip importing it
            if ($existingRoute) {
                Log::info("Routing with material_code already exists. Skipping Import.");
                return null;
            }

            // Create and save the new Assembly Bill
            $routings = new Routing([
                'material_code'  => $material_code,
                'converted_to_item_code'  => $converted_to_item_code,
                'note'           => $note
            ]);
    
            $routings->save();

            return $routings;
        } catch (\Exception $e) {
            Log::error('Failed to import Routing: ' . $e->getMessage());
            throw $e;
        }
    }

    public function headingRow(): int
    {
        return 1; // Assuming your heading row is at index 1
    }
}