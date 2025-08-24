<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Enquiry extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->closed_date!='') {
            $date1=date_create(date('Y-m-d', strtotime($this->created_at)));
            $date2=date_create(date('Y-m-d', strtotime($this->closed_date)));
            $diff=date_diff($date1, $date2);
            $aging_time=$diff->format("%a");
        } else {
            $date1=date_create(date('Y-m-d', strtotime($this->created_at)));
            $date2=date_create(date('Y-m-d'));
            $diff=date_diff($date1, $date2);
            $aging_time=$diff->format("%a");
        }
        $data=[
                 'call_id'=>$this->call_id,
                 'model_no'=>$this->model_no,
                 'status'=>$this->status,
                 'age'=>$aging_time,
                 'remarks'=>$this->remarks,
                  ];
        return $data;
    }
}
