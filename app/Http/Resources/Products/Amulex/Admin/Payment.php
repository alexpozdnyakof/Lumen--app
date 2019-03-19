<?php

namespace App\Http\Resources\Products\Amulex\Admin; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper

class Payment extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */


    public function toArray($request) {
        //Log::debug($this);
        return [
            'id' => $this->amulex_memorder_id,
            'date' => $this->dtprov,
            'comment' => $this->reason,
            'inn' =>  $this->payer_inn,
            'payer' =>  $this->payer_name,
            'activatedId' => $this->cert_id,
            'company' => $this->whenLoaded('activated', function () {
                return $this->activated ? $this->activated->company : null;
            })
        ];
    }
}