<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Resources\Json\JsonResource;

class Disserial extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $count = DB::table('disserials')->where('dis_id', $this->dis_id)->where('model_no', $this->model_no)->where('status', 'unused')->count();

        $apiorder_id=array();

        $ch_data=DB::table('apiorders')->where('to_id', $this->dis_id)->where('status', 'Pending')->get();

        foreach ($ch_data as $set) {
            $apiorder_id[]=$set->id;
        }


        $minus=DB::table('apiorderlists')->whereIn('apiorder_id', $apiorder_id)->where('model_no', $this->model_no)->sum('qty');

        $total= $count;
        $pending=$minus;


        $distributor = DB::table('distributors')->where('partner_id', $this->dis_id)->first();
        if ($distributor) {
            $distributor_store_name=$distributor->store_name;
        } else {
            $distributor_store_name='';
        }

        $data = [
                   'id' => $this->id,
                   'shop_name' =>$distributor_store_name,
                   'category_name' =>$this->gategory,
                   'model_no' => $this->model_no,
                   'quantity' => $total,
                   'order_in' => $pending,
               ];

        return $data;
    }
}
