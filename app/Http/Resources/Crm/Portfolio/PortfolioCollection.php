<?php

namespace App\Http\Resources\Crm\Portfolio; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;

class PortfolioCollection extends ResourceCollection{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

    public function toArray($request)
    {
        return $this->collection->transform(function ($item, $key) {
            Log::debug($item);
            return new PortfolioResource($item);
        });
    }


}


