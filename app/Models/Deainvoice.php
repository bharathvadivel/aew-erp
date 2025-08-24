<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deainvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'customerinvoice_no','sub_location_id','customer_name','customer_phone','date','gst','hsn_code','gategory_id','gategory','description','model_no','qty','stock','price','billing_price','total','sub_total','taxable_value','round_off','grand_total','partner_type','address','pincode','city','area','district','state','created_by','promoter_id'
     ];


    /**
    *get dealer data
    */
    public function partners()
    {
        return $this->hasOne(Distributor::class, 'partner_id', 'created_by');
    }

     /**
    *get promoter data
    */
    public function promoter()
    {
        return $this->hasOne(Promoter::class, 'promoter_id', 'promoter_id');
    }
}
