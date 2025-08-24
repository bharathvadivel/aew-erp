<?php

namespace App\Exports;

use App\Models\Enquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EnquiryExport implements FromCollection, WithMapping, WithHeadings
{
    private $i = 1;

    protected $enquiry;


    public function __construct($enquiry)
    {
        $this->enquiry = $enquiry;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->enquiry;
    }

    public function map($enquiry): array
    {
        /**
         * aging time (aging time is difference between call closed date to created date )
         */
        $date1=date_create(date('Y-m-d', strtotime($enquiry->created_at)));
        if ($enquiry->closed_date!='') {
            $date2=date_create(date('Y-m-d', strtotime($enquiry->closed_date)));
            $closed_date=basicDateFormat($enquiry->closed_date);
        } else {
            $date2=date_create(date('Y-m-d'));
            $closed_date='00-00-0000';
        }
        $diff=date_diff($date1, $date2);
        $aging_time=$diff->format("%a");


        /**
        * aging unit (aging unit is difference between call current date to created date )
        */
        $date_of_purchase=date_create(date('Y-m-d', strtotime($enquiry->date_of_purchase)));
        $unit=date_create(date('Y-m-d'));
        $age_unit_data=date_diff($date_of_purchase, $unit);
        $age_unit=$age_unit_data->format("%a");


        /**
         * aging bracket (age bracket is ageing time compare with days)
         */

        if ($aging_time < 7) {
            $age_bracket='< 7 days';
        } elseif ($aging_time>= 7 && $aging_time <= 14) {
            $age_bracket='7 TO 14 days' ;
        } elseif ($aging_time>= 15 && $aging_time <= 20) {
            $age_bracket='15 TO 20 days';
        } else {
            $age_bracket='> 21 days' ;
        }

        /**
         *get part code and part names and get part pending raised date
         */

        $part_code_row='';
        $part_name_row='';
        $part_date='00-00-0000';

        foreach ($enquiry->enquirylist as $key=>$val) {
            if ($val->status=='Part pending') {
                if ($val->part_code!='') {
                    $part_code_row.=implode(",", json_decode($val->part_code));
                    $part_name_row.=implode(",", json_decode($val->part_name));
                    $part_date=basicDateFormat($val->created_at);
                }
            }
        }

        return [
            $this->i++,
            $enquiry->call_id,
            $aging_time,
            $age_unit,
            $age_bracket,
            $enquiry->service_center ? $enquiry->service_center->service_center_name : '',
            $enquiry->executive ? $enquiry->executive->name : '',
            $enquiry->status,
            $enquiry->remarks,
            $enquiry->enquirylist ? $part_code_row : '',
            $enquiry->enquirylist ? $part_name_row : '',
            $enquiry->service_type,
            $enquiry->warranty_type,
            $enquiry->product ? $enquiry->product->description : '',
            $enquiry->gategory ? $enquiry->gategory->gategory_name : '',
            $enquiry->product ? $enquiry->product->model_no : '',
            $enquiry->serial_no,
            $enquiry->customer_name,
            $enquiry->customer_address,
            $enquiry->customer_pincode,
            $enquiry->customer_state,
            $enquiry->customer_phone,
            $enquiry->alter_phone,
            $enquiry->dealer ? $enquiry->dealer->store_name : '',
            $enquiry->dealer ? $enquiry->dealer->phone : '',
            basicDateFormat($enquiry->date_of_purchase),
            basicDateFormat($enquiry->created_at),
            $enquiry->enquirylist ? $part_date : '00-00-0000',
            basicDateFormat($enquiry->end_date),
            $closed_date
        ] ;
    }

       public function headings(): array
       {
           return [
               'S.No',
               'Call ID',
               'Age',
               'Age of Unit',
               'Age Bracket',
               'Service Center',
               'Executive Name',
               'Status',
               'Remarks',
               'Part Code',
               'Part Details',
               'Service Type',
               'Warranty Type',
               'Product Name',
               'Category Name',
               'Model No',
               'Product Serial No',
               'Customer Name',
               'Address',
               'Customer Pincode',
               'Customer State',
               'Mobile',
               'Alt Mobile',
               'Dealer Name',
               'Dealer Number',
               'Date of Purchase',
               'Allocated Date',
               'Part Pending Request Date',
               'End Date',
               'Closed Date',
           ] ;
       }
}
