<?php

namespace App\Exports;

use App\Models\Enquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;

class CustomerSupportExport implements FromCollection, WithHeadings, WithMapping
{
    private $i = 1;
    protected $from_date;
    protected $to_date;
    protected $search;
    protected $service_status;
    protected $update_status;




    public function __construct($from_date, $to_date, $search,$service_status,$update_status)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->search = $search;
        $this->service_status = $service_status;
        $this->update_status = $update_status;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return[
            'id',
            'call_id',
            'service_center_name',
            'status',
            'service_type',
            'description',
            'model_no',
            'customer_name',
            'customer_address',
            'customer_mobile',
            'feed_back',
            'product_rating',
            'service_rating',
            'remarks',
            'opening_date',
            'closing_date',
            'days_taken'
        ];
    }

    public function collection()
    {

     $enquiry=Enquiry::with('executive', 'service_center', 'brand', 'gategory', 'product', 'dealer', 'enquirylist');


if($this->service_status=='all') {
    $enquiry= Enquiry::whereIn('status', ['Completed','Closing request','Completed part return success','Completed part return pending','Completed part return processed']);
} elseif($this->service_status=='1') {
    $enquiry= Enquiry::whereIn('status', ['Completed','Completed part return success','Completed part return pending','Completed part return processed']);
} else {
    $enquiry= Enquiry::whereIn('status', ['Closing request']);
}

if($this->update_status=='1') {
    $enquiry= $enquiry->whereNotNull('service_rating');
} elseif($this->update_status=='0') {
    $enquiry= $enquiry->whereNull('service_rating');

}


        if($this->from_date!='') {
            $enquiry=$enquiry->whereDate('created_at', '>=', $this->from_date)->whereDate('created_at', '<=', $this->to_date);
        }

        if ($this->search!='') {
            $search=$this->search;
            $enquiry=$enquiry->where(function ($q) use ($search) {
                $q->orWhere('call_id', 'LIKE', "%{$search}%")->orWhere('service_type', 'LIKE', "%{$search}%")->orWhere('model_no', 'LIKE', "%{$search}%")->orWhere('serial_no', 'LIKE', "%{$search}%")->orWhere('customer_name', 'LIKE', "%{$search}%")->orWhere('customer_phone', 'LIKE', "%{$search}%")->orWhere('alter_phone', 'LIKE', "%{$search}%")->orWhere('finish_date', 'LIKE', "%{$search}%");
            });
        }
        return $enquiry->orderBy('id', 'desc')->get();
    }

    public function map($enquiry): array
    {


$date1=date_create(date('Y-m-d', strtotime($enquiry->created_at)));
$date2=date_create($enquiry->finish_date);
$diff=date_diff($date1, $date2);
$between=$diff->format("%a");

        $fields = [
           $this->i++,
            $enquiry->call_id,
           $enquiry->service_center ? $enquiry->service_center->service_center_name : '',
            $enquiry->status,
             $enquiry->service_type,
            $enquiry->product ? $enquiry->product->description : '',
          $enquiry->model_no,
                      $enquiry->customer_name,
            $enquiry->customer_address,
            $enquiry->customer_phone,
            $enquiry->feed_back,
            $enquiry->product_rating,
            $enquiry->service_rating,
            $enquiry->calling_remarks,
           basicDateFormat($enquiry->created_at),
          basicDateFormat($enquiry->finish_date),
          $between

      ];
        return $fields;
    }
}
