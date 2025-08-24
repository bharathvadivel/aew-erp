<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Resources\Json\JsonResource;

class Serial extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $count = DB::table('serials')->where('model_no', $this->model_no)->where('status', 'unused')->count();
        $apiorder_id=array();
        $ch_data=DB::table('apiorders')->whereIn('partner_type', ['distributor','direct_dealer'])->where('status', 'Pending')->get();
        foreach ($ch_data as $set) {
            $apiorder_id[]=$set->id;
        }

        $minus=DB::table('apiorderlists')->whereIn('apiorder_id', $apiorder_id)->where('model_no', $this->model_no)->sum('qty');
        $total= $count;
        $pending=$minus;

        $warehouse = DB::table('warehouses')->where('warehouse_id', $this->warehouse_id)->first();
        if ($warehouse) {
            $warehouse_name=$warehouse->name;
        } else {
            $warehouse_name='';
        }


        $data = [
                   'id' => $this->id,
                   'shop_name' =>$warehouse_name,
                   'category_name' =>$this->gategory,
                   'model_no' => $this->model_no,
                   'quantity' => $total,
                   'order_in'=>$minus
               ];
        return $data;
    }
}
