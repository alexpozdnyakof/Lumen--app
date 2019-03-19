<?php

namespace App\Http\Resources\Products\Amulex\Admin; // setting up namespace for auto discover
use  App\Http\Resources\Products\Amulex\Admin\Payment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentCollection extends ResourceCollection{
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
            'data' => Payment::collection($this->collection),
        );
    }
}
