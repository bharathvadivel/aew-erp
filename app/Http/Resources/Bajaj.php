<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Bajaj extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = '';
    public function toArray($request)
    {
        return [
            'brand' => $this->brand ? $this->brand->brand_name : '',
            'category' => $this->gategory ? $this->gategory->gategory_name : '',
            'product_id' => $this->product ? $this->product->id : '',
            'description' => $this->product ? $this->product->description : '',
            'model_number' => $this->model_no,
            'serial_number' => $this->serial_no
        ];
    }
}
