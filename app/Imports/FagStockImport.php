<?php

namespace App\Imports;

use App\Models\PModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FagStockImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {   
        try {

            $ModelCode = $row['model_code'];
            // Check if the model code already exists in the database
            $existingPModel = PModel::where('model_code', $ModelCode)->first();
            // If the model code exists, update the existing p_models
            if ($existingPModel) {
                $existingPModel->update([
                    'model_code' => $row['model_code'],
                    'fully_assembled_qty' => $row['fag_stock']
                    // Add more fields to update as needed
                ]);

                Log::info("Model with code ".$ModelCode." updated successfully.");

                return $existingPModel;
            }
    
            // If the material code doesn't exist, skip importing it
            Log::info("Model with code ".$ModelCode." not found. Skipping Import!.");

            return null;
        } catch (\Exception $e) {
            Log::error('Failed to import items: ' . $e->getMessage());
            throw $e;
        }
    }
}