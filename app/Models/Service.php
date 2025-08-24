<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Service extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $fillable = [
        'service_id','service_center_name','name','email','phone','password','gstin_no','location_id','address','pincode','district','city','state','country','lat','lang','created_id','status'
     ];

    /**
     *enquiry calls
     *@return service details
     */
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class, 'service_id', 'service_id');
    }

       /**
     *get partner locations
     */
    public function locations()
    {
        return  $this->hasMany(Userlocation::class, 'partner_id', 'service_id');
    }
         /**
     *Statecode
     */
    public function state_code()
    {
        return $this->belongsTo(Statecode::class, 'state', 'state');
    }
}
