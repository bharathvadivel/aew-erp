<?php

namespace App\Imports;

use App\Models\Warserial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
ini_set('max_execution_time',0);

class User implements ToModel, WithStartRow, WithCustomCsvSettings
{
    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $de=implode(",", $row);

        $str_arr = explode(",", $de);
        $ch=Warserial::where('serial_no', $str_arr[1])->first();
        if (!$ch) {
            $dom=$str_arr[4]!='' ? date('Y-m-d',strtotime($str_arr[4])):null;
            $dop=$str_arr[5]!='' ? date('Y-m-d',strtotime($str_arr[5])):null;
            $sed=$str_arr[12]!='' ? date('Y-m-d',strtotime($str_arr[12])):null;
            $eed=$str_arr[13]!='' ? date('Y-m-d',strtotime($str_arr[13])):null;
            $ped=$str_arr[14]!='' ? date('Y-m-d',strtotime($str_arr[14])):null;
            $pped=$str_arr[15]!='' ? date('Y-m-d',strtotime($str_arr[15])):null;

            return new Warserial([
           'serial_no'     => $str_arr[1],
           'gategory'     => $str_arr[2],
           'model_no'     => $str_arr[3],
           'dom'     => $dom,
           'date_of_purchase'     => $dop,
           'standard_warranty'     => $str_arr[6],
           'extended_warranty'     => $str_arr[7],
           'part1'     => $str_arr[8],
           'part1_warranty'     => $str_arr[9],
           'part2'     => $str_arr[10],
           'part2_warranty'     => $str_arr[11],
           'standard_warranty_exp_date'     =>$sed,
           'extended_warranty_exp_date'     => $eed,
           'part1_warranty_exp_date'     => $ped,
           'part2_warranty_exp_date'     => $pped,
           'customer_name'     => $str_arr[16],
           'customer_phone'     => $str_arr[17],
        ]);
        }
    }
}
