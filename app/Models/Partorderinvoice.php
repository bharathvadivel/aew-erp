<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partorderinvoice extends Model
{
    use HasFactory;
       protected $fillable = [
      'partorder_id','call_id','invoice_no','enquirylist_id','service_type','service_id','billing_service_id','service_center_phone','service_center_name','service_center_address','service_center_city','service_center_district','service_center_state','customer_name','customer_phone','model_no','serial_no','part_code','part_name','hsn_code','price','gst','qty','subtotal','total','round_off','grand_total','part_category','part_status','warranty_type','remarks','customerinvoice_no','created_by','status'
     ];


    /**
    * Billing Service center
    * @return Json
    */
    public function billing_service_center()
    {
        return $this->belongsTo(Service::class, 'billing_service_id', 'service_id');
    }
       /**
    * Delivery Service center
    * @return Json
    */
    public function delivery_service_center()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }
}
