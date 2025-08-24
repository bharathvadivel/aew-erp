<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'partner_id',
        'partner_type',
        'created_id',
        'name',
        'phone',
        'password',
        'costing_password',
        'email',
        'address',
        'city',
        'district',
        'pincode',
        'state',
    ];
}
