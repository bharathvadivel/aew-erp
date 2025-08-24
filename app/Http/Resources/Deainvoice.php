<?php

namespace App\Http\Resources;

use App\Models\Deaserial;
use App\Models\Product;
use App\Models\Deainvoice as Deainvoicenew;


use Illuminate\Http\Resources\Json\JsonResource;

class Deainvoice extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        $list = Deainvoicenew::select('model_no', 'qty')->where('created_by', $this->created_by)->whereDate('created_at', date('Y-m-d', strtotime($this->created_at)))->get()->toArray();
        $total_qty=Deainvoicenew::where('created_by', $this->created_by)->whereDate('created_at', date('Y-m-d', strtotime($this->created_at)))->sum('qty');
        $total_qty=(int) $total_qty;
        $data=[
                'created_at'=>basicDateFormat($this->created_at),
               'sales_to'=>$this->customer_name,
               'sales_by'=>$this->promoter ? $this->promoter->name : '',
               'total_qty'=> $total_qty,
                'product_list'=>$list


        ];

        return $data;
    }
}
