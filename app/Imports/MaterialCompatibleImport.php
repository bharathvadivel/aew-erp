<?php

namespace App\Imports;

use App\Models\MaterialCompatibleModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MaterialCompatibleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        try {

            // $prefix = $row['item_group_code'];

            // // Use Laravel's query builder to get the last item group with the given prefix
            // $itemGroup = DB::table('materials')->where('item_group_code', $prefix)->orderBy('id', 'desc')->first();

            // if ($itemGroup) {
            //     $currentCCode = $itemGroup->material_code;

            //     // Split the string using the '-' character as the delimiter
            //     $alphabetseries = explode('-', $currentCCode);

            //     $groupcode =  isset($alphabetseries[0]) ? $alphabetseries[0] : null;
            //     $getalphabetseries = isset($alphabetseries[1]) ? $alphabetseries[1][0] : null;
            //     $last4Digits = substr($currentCCode, -3);

            //     if ($last4Digits === '999') {
            //         $alphabet = isset($alphabetseries[1]) ? $alphabetseries[1][0] : '';

            //         if (preg_match('/^[A-Z]+$/', $alphabet)) {
            //             $characters = str_split($alphabet);
            //             $index = count($characters) - 1;
            //             while ($index >= 0 && $characters[$index] === 'Z') {
            //                 $characters[$index] = 'A';
            //                 $index--;
            //             }

            //             if ($index === -1) {
            //                 array_unshift($characters, 'A');
            //             } else {
            //                 $characters[$index] = ++$characters[$index];
            //             }

            //             $nextAlphabet = implode('', $characters);
            //             $updatedCCode = $groupcode . '-' . $nextAlphabet . '001';
            //         } else {
            //             throw new \Exception('Invalid format of CCode after \'-\'');
            //         }
            //     } else {
            //         $groupcode = isset($alphabetseries[0]) ? $alphabetseries[0] : null;

            //         // Get the first letter after the '-' character
            //         $getalphabetseries = isset($alphabetseries[1]) ? $alphabetseries[1][0] : null;

            //         $last4Digits = substr($currentCCode, -3);
            //         $incrementedNumber = (int)$last4Digits + 1;
            //         $paddedIncrementedNumber = str_pad($incrementedNumber, 3, '0', STR_PAD_LEFT);
            //         $updatedCCode = $groupcode . '-' . $getalphabetseries . $paddedIncrementedNumber;
            //     }
            // } else {
            //     $updatedCCode = $prefix . '-A001';
            // }

            $materialc = new MaterialCompatibleModel([
                'material_code'         => $row['item_code'],
                'model_code'            => $row['model_code'],
                'min_assembly_qty_set'  => $row['min_assembly_qty_set'],
            ]);

            $materialc->save();

            return $materialc;

        } catch (\Exception $e) {
            Log::error('Failed to import material: ' . $e->getMessage());
            throw $e;
        }
    }    
}