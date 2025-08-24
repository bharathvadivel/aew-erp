<?php

namespace App\Http\Resources;

use App\Models\Disserial;
use App\Models\Product;
use App\Models\Distributor;
use App\Models\Disinvoice as Disinvoicenew;



use Illuminate\Http\Resources\Json\JsonResource;

class Disinvoice extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        $list = Disinvoicenew::select('model_no', 'qty')->where('disinvoice_no', $this->disinvoice_no)->get()->toArray();

        $taxable_value = Disinvoicenew::where('disinvoice_no', $this->disinvoice_no)->sum('taxable_value');


        $data=[
                'created_at'=>basicDateFormat($this->created_at),
                'invoice_no'=>$this->disinvoice_no,
                'sales_to'=>$this->partners ? $this->partners->store_name : '',
                'sales_by'=>$this->asm ? $this->asm->name : '',
                'product_list'=>$list,
                'taxable_value'=>$taxable_value
        ];



        return $data;
    }
}
