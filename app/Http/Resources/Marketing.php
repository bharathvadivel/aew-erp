<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Marketing extends JsonResource
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
            'title'=>$this->title,
            'posts'=>json_decode($this->posts),
             ];
             return $data;
    }
}
