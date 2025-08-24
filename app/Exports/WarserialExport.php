<?php

namespace App\Exports;

use App\Models\Warserial;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;

class WarserialExport   implements FromCollection, WithHeadings, WithMapping
{
    private $i = 1;
    protected $search;



    public function __construct($search)
    {
        $this->search = $search;

    }


        /**
        * @return \Illuminate\Support\Collection
        */
        public function headings(): array
        {
            return[
                'id',
                'serial_no',
                'customer_name',
                'category',
                'model_no',
                'dom',
                'date_of_purchase',
                'standard_warranty',
                'extended_warranty',
                'part1',
                'part1_warranty',
                'part2',
                'part2_warranty',
                'standard_warranty_exp_date',
                'extended_warranty_exp_date',
                'part1_warranty_exp_date',
                'part2_warranty_exp_date',
                'remarks',
                'created_at',
            ];
        }

        public function collection()
        {

            $data=Warserial::with('product');
            if ($this->search!='') {
                $data=$data->where('serial_no', 'LIKE', "%{$this->search}%")->orWhere('customer_name', 'LIKE', "%{$this->search}%")->orWhere('customer_phone', 'LIKE', "%{$this->search}%")->orWhere('model_no', 'LIKE', "%{$this->search}%");
            }
            return $data->orderBy('id', 'desc')->get();
        }

        public function map($data): array
        {
            $fields = [
               $this->i++,
               $data->serial_no,
               $data->customer_name,
               $data->product && $data->product->gategory ? $data->product->gategory->gategory_name : '',
               $data->model_no,
               $data->dom!='' ? basicDateFormat($data->dom):'',
               $data->date_of_purchase!='' ? basicDateFormat($data->date_of_purchase):'',
               $data->standard_warranty==0 ?'0':$data->standard_warranty,
               $data->extended_warranty==0 ?'0':$data->extended_warranty,
               $data->part1,
               $data->part1_warranty==0 ?'0':$data->part1_warranty,
               $data->part2,
               $data->part2_warranty==0 ?'0':$data->part2_warranty,
               $data->standard_warranty_exp_date!='' ? basicDateFormat($data->standard_warranty_exp_date):'',
               $data->extended_warranty_exp_date!='' ? basicDateFormat($data->extended_warranty_exp_date):'',
               $data->part1_warranty_exp_date!='' ? basicDateFormat($data->part1_warranty_exp_date):'',
               $data->part2_warranty_exp_date!='' ? basicDateFormat($data->part2_warranty_exp_date):'',
               $data->remarks,
               basicDateFormat($data->created_at),

      ];
            return $fields;
        }
}
