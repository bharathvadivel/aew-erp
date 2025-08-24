<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Warehouse extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $fillable = [
        'warehouse_id', 'name','email','gstin_no','location_id','address','pin_code','phone','password','lat','lang','district','city','state','country','created_id','status','tcs_no','tcs_type'
    ];
    protected $guarded = ['id', '_token'];

        /**
     *Statecode
     */
    public function state_code()
    {
        return $this->belongsTo(Statecode::class, 'state', 'state');
    }
}
