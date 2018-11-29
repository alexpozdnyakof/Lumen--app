<?php

namespace App\Http\Resources; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper


class UserResource extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

     /*
     public function toArray($request) {
         return array(
            'id'            => $this->id,
            'username'      => $this->username,
            'glavniy'       => $this->glavniy,
            'count'         => $this->count
         );
        }
    */
   // ['id', 'name', 'email', 'rb', 'chief', 'branch', 'phone', 'state', 'city', 'photo', 'employment', 'cisco', 'branch', 'office']

    public function toArray($request) {
        return array(
           'id' => $this->id,
           'name' => $this->name,
           'email' => $this->email,
           'rb' => $this->rb,
           'chief' => $this->chief,
           'branch' => $this->branch,
           'phone' => $this->phone,
           'state' => $this->state,
           'city' =>  $this->city,
           'photo' => $this->photo,
           'employmment' => $this->employment,
           'cisco' => $this->cisco,
           'branch' => $this->branch,
           'office' => $this->office
        );
       }
}


