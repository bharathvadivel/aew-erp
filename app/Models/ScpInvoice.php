<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScpInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'scp_invoice_no','scp_id','bill_type','scp_name','location_id','by_order_no','date','ew_bill_no','others','distance','transporter_id','transporter_name','gst','hsn_code','gstin_no','brand_id','gategory_id','gategory','description','model_no','qty','stock','price','billing_price','basic_allowance','sta','partner_allowance','additional_discount','total','sub_total','taxable_value','tcs_val','round_off','grand_total','credit_days','credit_limit','available_limit','partner_type','address','pincode','city','district','state','country','created_by','from_address','from_location_id','delivery_location_id','new_delivery_address','delivery_address','ch_box_status','tcs','login_id','order_id','order_by','status'
     ];

    /**
     *Direct partners
     */
    public function partners()
    {
        return $this->belongsTo(Service::class, 'scp_id', 'service_id');
    }

      /**
     *To warehouse
     */
    public function towarehouse()
    {
        return $this->hasOne(Warehouse::class, 'warehouse_id', 'scp_id');
    }


    /**
     *From warehouse
     */
    public function fromwarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'created_by', 'warehouse_id');
    }



    /**
     *direct partners ASM
     */
    public function asm()
    {
        return $this->hasOne(Asm::class, 'asm_id', 'order_by');
    }

     /**
     *Brand
     */
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
       /**
     *Category
     */
    public function gategory()
    {
        return $this->hasOne(Gategory::class, 'id', 'gategory_id');
    }

       /**
     *Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'model_no', 'model_no');
    }

     /**
     *Service partner Billing address
     */
    public function service_partner_billing_address()
    {
        return $this->hasOne(Userlocation::class, 'location_id', 'location_id');
    }

       /**
     *To Warehouse  Billing address
     */
    public function warehouse_billing_address()
    {
        return $this->hasOne(Warehouse::class, 'location_id', 'location_id');
    }


     /**
     *From address
     */
    public function from_address()
    {
        return $this->hasOne(Warehouse::class, 'location_id', 'from_location_id');
    }

      /**
     *Service partner Delivery address
     */
    public function service_partner_delivery_address()
    {
        return $this->hasOne(Userlocation::class, 'location_id', 'delivery_location_id');
    }

      /**
     *To Warehouse Delivery address
     */
    public function warehouse_delivery_address()
    {
        return $this->hasOne(Warehouse::class, 'location_id', 'delivery_location_id');
    }

    /**
    *** Sold to Service Partners Serial List
    */
    public function service_serials()
    {
        return $this->hasMany(Scpserial::class, 'scp_invoice_no', 'scp_invoice_no');
    }

    /**
     *Sold to Waerhouse Serial List
     */
    public function warehouse_serials()
    {
        return $this->hasMany(Serial::class, 'purchase_no', 'scp_invoice_no');
    }
}
