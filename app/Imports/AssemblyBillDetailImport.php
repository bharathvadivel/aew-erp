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

class AssemblyBillDetailImport implements ToModel, WithHeadingRow
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
            
            $itemType = $row['item_type_spg_or_fag'];
            $itemCode = $row['item_code'];
            $itemDesc = DB::table('materials')->where('material_code', $itemCode)->first();
            $qty = $row['item_qty'];
            // Check if the inventory is already exists in the AssemblyBillDetail
            $existingABillDetail = AssemblyBillDetail::where('invoice_no', $invoice_no)->where('item_code', $itemCode)->first();

            // If the invoice_no exists, skip importing it
            if ($existingABillDetail) {
                Log::info("Assembly Bill Detail with bill_no and item_code already exists. Skipping import.");
                return null;
            }
                
            if($itemType == "SPG"){
                $qty_select = DB::table('materials')->where('material_code', $itemCode)->first();
                $subtractQty = $qty_select->total_stock_qty-$qty;
                $qty_update = DB::table('materials')->where('material_code', $itemCode)->update(array('total_stock_qty'=>$subtractQty));
            } else if($itemType == "FAG"){
                $qty_select = DB::table('p_models')->where('model_code', $itemCode)->first();
                $subtractQty = $qty_select->fully_assembled_qty-$qty;
                $qty_update = DB::table('p_models')->where('model_code', $itemCode)->update(array('fully_assembled_qty'=>$subtractQty));
            }
            // Create and save the new Assembly Bill
            $abilldetails = new AssemblyBillDetail([
                'invoice_no'    => $invoice_no,
                'invoice_date'  => $invoice_date,
                'item_code'     => $itemCode,
                'item_type'     => $itemType,
                'item_desc'     => $itemDesc->material_desc,
                'item_qty'      => $qty
            ]);
    
            $abilldetails->save();

            return $abilldetails;
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