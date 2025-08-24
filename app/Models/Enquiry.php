<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Enquiry extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $fillable = [
        'call_id','service_type','service_id','service_center_name','brand_id','brand_name','gategory_id','gategory_name','model_no','description','product_code','serial_no','warranty_type','customer_remarks','partner_id','partner_name','partner_phone','store_name','date_of_purchase','invoice_no','customer_name','customer_phone','alter_phone','customer_address','lat','lang','customer_state','customer_district','customer_city','customer_area','customer_pincode','created_by','remarks','status','is_transfered'
     ];

    /**
     * Service center
     */
    public function service_center()
    {
        return $this->hasOne(Service::class, 'service_id', 'service_id');
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
        return $this->hasOne(Product::class, 'model_no', 'model_no');
    }


     /**
     *Dealer
     */
    public function dealer()
    {
        return $this->hasOne(Distributor::class, 'partner_id', 'partner_id');
    }

      /**
     *Service Executive
     */
    public function executive()
    {
        return $this->hasOne(Executive::class, 'id', 'executive_id');
    }

    /**
     *Service list
     */
    public function enquirylist()
    {
        return $this->hasMany(Enquirylist::class, 'call_id', 'call_id');
    }

    /**
     *Service images
     */
    public function enquiryimage()
    {
        return $this->hasMany(Enquiryimage::class, 'call_id', 'call_id');
    }


}
