<?php

namespace App\Http\Resources; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper


class Permission extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

     public function toArray($request) {
         return $this->slug;
    }

}