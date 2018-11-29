<?php

namespace App\Http\Resources; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper
use App\Http\Resources\Permission as PermissionResource;
use App\Http\Resources\Role as RoleResource;

class UserExtended extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

     public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => $this->photo,
            'branch' => $this->branch,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'permissions' => PermissionResource::collection($this->whenLoaded('permissions')),
        ];
    }
}
