<?php

namespace App\Imports;

use App\Models\Serial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class SerialImport implements ToModel, WithHeadingRow
{
    public function __construct($product_code, $model_no, $description, $gategory, $warehouse_id, $purchase_no)
    {
        $this->product_code = $product_code;
        $this->model_no = $model_no;
        $this->description = $description;
        $this->gategory = $gategory;
        $this->warehouse_id = $warehouse_id;
        $this->purchase_no = $purchase_no;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $ser = $row['serial_no'];
        $dom = date('Y-m-d', strtotime($row['date_of_manufacturing']));


        $ch = DB::table('serials')->where('serial_no', $ser)->get();
        if ($ch->isEmpty()) {
            return new Serial([
                'purchase_no'    => $this->purchase_no,
                'warehouse_id'    => $this->warehouse_id,
                'gategory'    => $this->gategory,
                'product_code'    => $this->product_code,
                'model_no'    => $this->model_no,
                'description'    => $this->description,
                'serial_no'    => $row['serial_no'],
                'dom'         => $dom,
            ]);
        }
    }
}
