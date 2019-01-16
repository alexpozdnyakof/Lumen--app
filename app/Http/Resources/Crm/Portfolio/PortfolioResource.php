<?php

namespace App\Http\Resources\Crm\Portfolio; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper
use Illuminate\Support\Facades\Log;


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
            'bank_pro' => $this->current_bank,
            'bank_payroll' => $this->current_payroll_bank,
            'name' => $this->name,
            'industry' => $this->okved_vid_deyatelnosti,
            'activity_last' => $this->posledniy_resultat_text,
            'activity_date' => $this->data_posledniy_contact_unixtime,
            'budget_period' => $this->vyruchka_period,
            'budget_year' => $this->vyruchka_za_god,
        ];
    }
/*
    public static function collection($resource)
    {   $collectionArray = parent::collection($resource) -> toArray();
        $collection = parent::collection($collectionArray['data'])->collection;
        if ($collection->count() > 1) {
            return [Str::plural(self::$wrap) => $collection];
        }
        // This is according to API specs, but Postman collection gives an error:
        return [self::$wrap => $collection->first()];
    }
*/
            /*
    'data' => $this->collection,
    'pagination' => [
        'total' => $this->total(),
        'count' => $this->count(),
        'per_page' => $this->perPage(),
        'current_page' => $this->currentPage(),
        'total_pages' => $this->lastPage()
*/
}


