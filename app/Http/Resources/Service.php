<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Service extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'partner_type' => 'service_center',
            'partner_id' => $this->service_id,
            'store_name' => $this->service_center_name,
            'gstin_no' => "",
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'state' => $this->state,
            'country' => $this->country,
            'status' => $this->status,
            'created_id' => $this->created_id,
            'created_at' => basicDateFormat($this->created_at),
            'token' => $this->token,
            'credit_limit' => "",
            'credit_days' => "",

        ];
        $location=array(
            'location_id'=>$this->location_id,
            'address' => $this->address,
            'city' => $this->city,
            'district' => $this->district,
            'pincode' =>$this->pincode,
            'lat' => $this->lat,
            'lang' => $this->lang,
        );

        $data['location']=array($location);

        return ['status' => true, "message" => "The request has succeeded", "data" => $data];
    }
}
