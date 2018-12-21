<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CustomerGroup as GroupResource;


class Manager extends JsonResource
{

    public function toArray($request)
    {
        return [
            'groups' => GroupResource::collection($this->whenLoaded('groups')),
        ];
    }
}
       // return GroupResource::collection($this->whenLoaded('groups'));

/*
"id": 1,
        "name": "Контрагенты клиентов Росбанк: ПАО Московский кредитный банк",
        "description": "Контрагенты клиентов Росбанк: ПАО Московский кредитный банк",
        "valuation": 13
*/
   // return [
            //'id' => $this->counter,
            //'name' => $this->name,
            //'rb' => $this->rb,
            //GroupResource::collection($this->whenLoaded('groups')),
           /* 'company' => $this->store->company,
            'company' => $this->store->company,
            'status'  => $this->store->status,
            'tax'  => $this->store->tax,
            'created_at' => $this->store->created,
            'updated_at' => $this->store->updated,
            */
    //    ];