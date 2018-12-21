<?php

namespace App\Http\Resources\Loans\Calculator; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper


class Keys extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

     public function toArray($request) {
         return $this->collateral;
    }

}