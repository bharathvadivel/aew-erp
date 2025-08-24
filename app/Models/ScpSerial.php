<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScpSerial extends Model
{
  use HasFactory;
    protected $fillable = [
        'call_id','scp_invoice_id','scp_invoice_return_id','scp_invoice_no','sp_return_no','serial_no','brand_id','gategory_id','gategory','description','model_no','product_code','scp_name','scp_id','location_id','remarks','status'
       ];

}
