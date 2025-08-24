<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Distributor extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $fillable = [
       'partner_type','partner_id','created_id','store_name','email','dob','name','gstin_no','phone','password','state','country','available_limit','credit_limit','credit_days','tcs_no','tcs_type','status'
    ];


    /**
     *get this direct partner ASM
     */
    public function asm()
    {
        return  $this->hasOne(Listdisid::class, 'partner_id', 'partner_id');
    }

       /**
     *get partner locations
     */
    public function locations()
    {
        return  $this->hasMany(Userlocation::class, 'partner_id', 'partner_id');
    }
         /**
     *Statecode
     */
    public function state_code()
    {
        return $this->belongsTo(Statecode::class, 'state', 'state');
    }
}
