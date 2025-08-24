<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Enquirylist extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'call_id','enquiry_id','service_type','service_id','service_center_name','executive_id','executive_name','partner_id','partner_name','date_of_purchase','invoice_no','customer_name','model_no','serial_no','punch_location','part_code','part_name','fulfillment_status','remarks','status','end_date'
     ];
}
