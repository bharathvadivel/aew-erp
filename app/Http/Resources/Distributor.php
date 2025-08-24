<?php

namespace App\Http\Resources;

use App\Models\Userlocation;
use Illuminate\Http\Resources\Json\JsonResource;

class Distributor extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $data=[
       'partner_type'=>$this->partner_type,
       'partner_id'=>$this->partner_id,
       'store_name'=>$this->store_name,
       'phone'=>$this->phone,
       'name'=>$this->name,
       'email'=>$this->email,
       'gstin_no'=>$this->gstin_no,
       'state'=>$this->state,
       'country'=>$this->country,
       'status'=>$this->status,
       'credit_limit'=>$this->credit_limit,
       'credit_days'=>$this->credit_days,
       'status'=>$this->status,
       'created_id'=>$this->created_id,
       'created_at'=>basicDateFormat($this->created_at),
       'token'=>$this->token,

        ];

        $data['location']=Userlocation::select('location_id', 'address','pincode','city','district','lat','lang')->where('partner_id',$this->partner_id)->get()->toArray();
        return ['status'=>true,"message"=>"login successfully ","data"=>$data];
    }
}
