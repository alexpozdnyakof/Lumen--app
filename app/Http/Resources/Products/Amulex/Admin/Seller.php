<?php

namespace App\Http\Resources\Products\Amulex\Admin; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper

class Seller extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */


    public function toArray($request) {
        //Log::debug($this);
        return [
            'id' => $this->counter,
            'name' => $this->ФИО,
            'rb' => $this->rb
        ];
    }
}