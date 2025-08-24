<?php

namespace App\Exports;

use App\Models\Bajaj;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;

class BajajExport implements FromCollection, WithHeadings, WithMapping
{

        private $i = 1;
        protected $from_date;
        protected $to_date;
        protected $search;



function __construct($from_date, $to_date,$search)
{
    $this->from_date = $from_date;
    $this->to_date = $to_date;
    $this->search = $search;

}


    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return[
            'id',
            'category',
            'model_no',
            'serial_no',
            'status',
            'sold_by',
            'created_at',
            'updated_at',
        ];
    }

    public function collection()
    {

        $bajaj=Bajaj::with('product');

    if($this->from_date!='') {
        $bajaj=$bajaj->whereDate('updated_at', '>=', $this->from_date)->whereDate('updated_at', '<=', $this->to_date);
    }
         if ($this->search!='') {
                        $search=$this->search;
            $bajaj=$bajaj->where(function ($q) use ($search) {
        $q->where('product_id', 'LIKE', "%{$this->search}%")->orWhere('gategory_id', 'LIKE', "%{$this->search}%")->orWhere('model_no', 'LIKE', "%{$this->search}%")->orWhere('serial_no', 'LIKE', "%{$this->search}%")->orWhere('status', 'LIKE', "%{$this->search}%")->orWhere('created_at', 'LIKE', "%{$this->search}%")->orWhere('updated_at', 'LIKE', "%{$this->search}%");

});
    }
        return $bajaj->orderBy('id', 'desc')->get();
    }

    public function map($bajaj): array
    {

        $fields = [
           $this->i++,
           $bajaj->product && $bajaj->product->gategory ? $bajaj->product->gategory->gategory_name:'',
           $bajaj->product ? $bajaj->product->model_no:'',
           $bajaj->serial_no,
           $bajaj->status=='unused' ? 'Unsold':'Sold',
          $bajaj->status=='unused' ? '': ($bajaj->sold_by==1 ? 'Cash':'Bajaj/TVS'),
           basicDateFormat($bajaj->created_at),
          basicDateFormat( $bajaj->updated_at),

      ];
        return $fields;
    }
}
