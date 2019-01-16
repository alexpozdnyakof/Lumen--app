<?php

namespace App\Http\Resources\Crm\Task; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper
use Illuminate\Support\Facades\Log;


class TaskResource extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

    public function toArray($request) {
        return [
            'id' => $this->a_id,
            'customer' => $this->client_id,
            'author' => $this->creator_uid,
            'created' => $this->created_server_unixtime,
            'type' => $this->act_type == 0 ? 'Звонок' : 'Встреча',
            'start_date' => $this->act_start_time * 1000,
            'customer' => ['id' => $this->client_id, 'name' => $this->name, 'valuation' => $this->priority],
            'author' => ['id' => $this->counter, 'name' => $this->ФИО]
        ];
    }
}


