<?php

namespace App\Http\Resources\Crm\Portfolio; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper
use Illuminate\Support\Facades\Log;
use App\Http\Resources\Crm\Task\TaskResource;


class PortfolioResource extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

    public function toArray($request) {
        //Log::debug($this);
        return [
            'id' => $this->client_id,
            'valuation' => $this->priority,
            'name' => $this->name,
            'industry' => $this->okved_vid_deyatelnosti,
            'activity' => [
                'result' => $this->posledniy_resultat_text,
                'date' => $this->data_posledniy_contact_unixtime,
            ],
            'money' => [
                'period' => $this->vyruchka_period,
                'amount' => $this->vyruchka_za_god,
            ],
            'lastTask' => new TaskResource($this->tasks),
        ];
    }
}


