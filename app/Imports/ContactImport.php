<?php

namespace App\Imports;

use App\Models\Contact;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {   
        try {
            // Create and save the new Contact
            $contacts = new Contact([
                'customer_type'             => $row['customer_type'],
                'customer_name'           => $row['customer_name'],
                'customer_billing_address'  => $row['customer_billing_address'],
                'customer_shipping_address'  => $row['customer_shipping_address'],
                'customer_mobile_no'     => $row['customer_mobile_no'],
                'customer_email'            => $row['customer_email'],
                'customer_gst_no'            => $row['customer_gst_no'],
                'state_code'            => $row['state_code']
            ]);
    
            $contacts->save();

            return $contacts;
        } catch (\Exception $e) {
            Log::error('Failed to import contact: ' . $e->getMessage());
            throw $e;
        }
    }

    public function headingRow(): int
    {
        return 1; // Assuming your heading row is at index 1
    }
}