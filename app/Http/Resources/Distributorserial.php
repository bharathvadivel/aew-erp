<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Resources\Json\JsonResource;

class Distributorserial extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $count = DB::table('distributorserials')->where('partner_id', $this->partner_id)->where('model_no', $this->model_no)->where('status', 'unused')->count();
        $data = [
                   'id' => $this->id,
                   'category_name' =>$this->gategory,
                   'model_no' => $this->model_no,
                   'quantity' => $count,

               ];

        return $data;
    }
}
