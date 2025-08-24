<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Asm extends JsonResource
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
            'partner_type' => 'asm',
            'partner_id' => $this->asm_id,
            'store_name' => "",
            'gstin_no' => "",
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'state' => $this->state,
            'country' => $this->country,
            'status' => $this->status,
            'created_id' => $this->created_id,
            'created_at' =>basicDateFormat($this->created_at),
            'token' => $this->token,
            'credit_limit' => "",
            'credit_days' => "",

        ];
        $location= array(
            'location_id'=>"",
            'address' => $this->address,
            'city' => $this->city,
            'district' => $this->district,
            'pincode' => $this->pin_code,
            'lat' => "",
            'lang' => ""

        );
        $data['location']=array($location);

        return ['status' => true, "message" => "The request has succeeded", "data" => $data];
    }
}
