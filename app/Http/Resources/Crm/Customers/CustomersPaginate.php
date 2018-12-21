<?php

namespace App\Http\Resources\Crm\Customers; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper
use App\Http\Resources\Crm\Customers\CustomersList as CustomersListResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class CustomersPaginate extends ResourceCollection{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

    public function __construct($resource){}
    public function toArray($request) {
        return array(
            /*
            'pages' =>  json_encode([
                'total' => $this->total(),
                'current' => $this->currentPage(),
                'per_page' => $this->perPage()
                ]),
            */
            'data' => CustomersList::collection($this->collection),
        );
    }
}
