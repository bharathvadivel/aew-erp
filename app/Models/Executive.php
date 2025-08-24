<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Executive extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $fillable = [
        'executive_id','name','email','dob','proof','service_id','phone','password','address','pin_code','district','city','state','country','created_id','status'
     ];

          public function scopeProof($query, $image)
    {
        return url('/application/executive') . '/' . $image;
    }

    /**
     * executive service calls
     */
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class, 'executive_id', 'executive_id');
    }
}
