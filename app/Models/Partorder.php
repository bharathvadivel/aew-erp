<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partorder extends Model
{
    use HasFactory;
    protected $fillable = [
      'call_id','invoice_no','enquirylist_id','service_type','service_id','service_center_phone','service_center_name','service_center_address','service_center_city','service_center_district','service_center_state','customer_name','customer_phone','model_no','serial_no','part_code','part_name','fulfillment_status','warranty_type','remarks','status'
     ];
}