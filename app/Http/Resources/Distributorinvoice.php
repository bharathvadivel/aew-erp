<?php

namespace App\Http\Resources;

use App\Models\Distributorserial;
use App\Models\Distributor;
use App\Models\Product;

use App\Models\Distributorinvoice as Distributorinvoicenew;

use Illuminate\Http\Resources\Json\JsonResource;

class Distributorinvoice extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        $list = Distributorinvoicenew::select('model_no', 'qty')->where('partnerinvoice_no', $this->partnerinvoice_no)->get()->toArray();

        $taxable_value = Distributorinvoicenew::where('partnerinvoice_no', $this->partnerinvoice_no)->sum('taxable_value');

        $data=[
                'created_at'=>basicDateFormat($this->created_at),
                'invoice_no'=>$this->partnerinvoice_no,
               'sales_to'=>$this->partners ? $this->partners->store_name : '',
               'product_list'=>$list,
                'taxable_value'=>$taxable_value
        ];

        return $data;
    }
}
