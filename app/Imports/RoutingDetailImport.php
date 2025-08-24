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

class RoutingDetailImport implements ToModel, WithHeadingRow
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
            $operation_name = $row['process_code'];
            $operation_desc = $row['process_description'];
            
            // Check if the inventory is already exists in the AssemblyBillDetail
            $existingRoutingDetail = RoutingDetail::where('material_code', $material_code)->where('operation_name', $operation_name)->first();

            // If the invoice_no exists, skip importing it
            if ($existingRoutingDetail) {
                Log::info("Routing Detail with material_code and process_code already exists. Skipping Import.");
                return null;
            }

            // Create and save the new Assembly Bill
            $routingdetails = new RoutingDetail([
                'material_code'    => $material_code,
                'operation_name'   => $operation_name,
                'operation_desc'   => $operation_desc,
            ]);
    
            $routingdetails->save();

            return $routingdetails;
        } catch (\Exception $e) {
            Log::error('Failed to Import Routing Detail: ' . $e->getMessage());
            throw $e;
        }
    }

    public function headingRow(): int
    {
        return 1; // Assuming your heading row is at index 1
    }
}