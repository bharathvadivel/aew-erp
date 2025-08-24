<?php

namespace App\Imports;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactUpdateImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        try {

            

            $contactId = $row['s_no'];
    
            // Check if the Contact already exists in the database
            $existingContact = Contact::where('id', $contactId)->first();
    
            // If the material code exists, update the existing material
            if ($existingContact) {
                $existingContact->update([
                    'customer_type'             => $row['customer_type'],
                    'customer_name'           => $row['customer_name'],
                    'customer_billing_address'  => $row['customer_billing_address'],
                    'customer_shipping_address'  => $row['customer_shipping_address'],
                    'customer_mobile_no'     => $row['customer_mobile_no'],
                    'customer_email'            => $row['customer_email'],
                    'customer_gst_no'            => $row['customer_gst_no'],
                    'state_code'            => $row['state_code']
                    // Add more fields to update as needed
                ]);

                Log::info("Contact with id $contactId updated successfully.");

                return $existingMaterial;
            }
    
            // If the material code doesn't exist, skip importing it
            Log::info("Contact with code $contactId not found. Skipping Import!.");

            return null;
        } catch (\Exception $e) {
            Log::error('Failed to import items: ' . $e->getMessage());
            throw $e;
        }
    }
}