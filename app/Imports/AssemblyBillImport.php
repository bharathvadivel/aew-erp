<?php

namespace App\Imports;

use App\Models\Material;
use App\Models\ItemGroup;
use App\Models\AssemblyBill;
use App\Models\AssemblyBillDetail;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssemblyBillImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {   
        try {
            $invoice_no = $row['bill_no'];
            $invoice_date = date('Y-m-d');
    
            // Check if the invoice_no already exists in the database
            $existingABill = AssemblyBill::where('invoice_no', $invoice_no)->first();
    
            // If the invoice_no exists, skip importing it
            if ($existingABill) {
                Log::info("Assembly Bill with bill_no already exists. Skipping import.");
                return null;
            }

            // Create and save the new Assembly Bill
            $abills = new AssemblyBill([
                'invoice_no'             => $invoice_no,
                'invoice_date'           => $invoice_date,
                'customer_bill_address'  => $row['authorised_person'],
                'customer_ship_address'  => $row['receiver'],
                'customer_mobile_no'     => $row['receiver_phone_no'],
                'client_note'            => $row['bill_note']
            ]);
    
            $abills->save();

            return $abills;
        } catch (\Exception $e) {
            Log::error('Failed to import material: ' . $e->getMessage());
            throw $e;
        }
    }

    public function headingRow(): int
    {
        return 1; // Assuming your heading row is at index 1
    }
}