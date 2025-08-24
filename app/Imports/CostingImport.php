<?php

namespace App\Imports;

use App\Models\Material;
use App\Models\PModel;
use App\Models\Costing;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CostingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {   
        try {
            $item_code = $row['item_code'];
            $pricing = $row['pricing'];
            
            $previous_price = Costing::where('item_code', $item_code)->orderBy('id', 'desc')->first();
            $previous_pricing = $previous_price ? $previous_price->pricing : 0;

            if($previous_price){
                if($price < $previous_pricing){
                    $up_down_same = "Down";
                    $how_much = $previous_pricing-$price;
                } elseif($price > $previous_pricing){
                    $up_down_same = "Up";
                    $how_much = $price-$previous_pricing;
                } elseif($price == $previous_pricing){
                    $up_down_same = "Same";
                    $how_much = 0;
                }
            
                // Create and save the new Assembly Bill
                $costingData = new Costing([
                    'item_code'     => $item_code,
                    'pricing'       => $pricing,
                    'up_down_same'  => $up_down_same,
                    'how_much'      => $how_much,
                ]);
        
                $costingData->save();

                return $costingData;
            } else {
                $up_down_same = "";
                $how_much = 0;

                // Create and save the new Assembly Bill
                $costingData = new Costing([
                    'item_code'     => $item_code,
                    'pricing'       => $pricing,
                    'up_down_same'  => $up_down_same,
                    'how_much'      => $how_much,
                ]);
        
                $costingData->save();

                return $costingData;
            }
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