<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Sanctum\HasApiTokens;


class Employee extends Model
{
    // use HasFactory,HasApiTokens;
    use HasFactory;
    
    protected $fillable = [
        'employee_no',
        'employee_name',
        'department',
        'designation',
        'date_of_joining',
        'qualification',
        'work_period',
        'address',
        'mail_id',
        'contact_no',
        'emergency_contact_no',
        'dob',
        'blood_group',
        'aadhaar_number',
        'pan_number',
        'esi_number',
        'pf_uan_number',
        'bank_name',
        'bank_branch',
        'bank_account_number',
        'bank_ifsc_code'

    ];
    // public function scopeProof($query, $image)
    // {
    //     return url('/application/employee') . '/' . $image;
    // }

}
