<?php

namespace App\Http\Resources;
use App\Models\Apiorderlist;

use Illuminate\Http\Resources\Json\JsonResource;

class Apiorder extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {

        $data=parent::toArray($request);
        $row=Apiorderlist::where('order_id', $this->order_id)->first();
        $data['grand_total']=$row->grand_total;
        $list=Apiorderlist::where('order_id', $this->order_id)->get()->toArray();
        $data['items']=$list;

        return $data;
    }
}
