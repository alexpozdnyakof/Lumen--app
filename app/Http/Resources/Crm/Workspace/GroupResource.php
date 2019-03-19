<?php

namespace App\Http\Resources\Crm\Workspace; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper


class GroupResource extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

    public function toArray($request) {
        return [
            'id' => $this->spisok_id,
            'name' => $this->spisok_name,
            'description' => $this->spisok_opisanie,
            'author' => $this->spisok_creator_uid,
            'created_at' => $this->spisok_create_time,
            'valuation' => $this->spisok_ball,
            'customers' => $this->customers_count

        ];
    }
}
