<?php

namespace App\Http\Resources\Crm\Customers; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper


class CustomersList extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    private $pagination;

    public function __construct($resource)
    {

    }
    public function toArray($request) {
        return array(
           'id' => $this->client_id,
           'valuation' => $this->priority,
           'bank_pro' => $this->current_bank,
           'bank_payroll' => $this->current_payroll_bank,
           'name' => $this->name,
           'industry' => $this->okved_vid_deyatelnosti,
           'activity_last' => $this->posledniy_resultat_text,
           'activity_date' => $this->data_posledniy_contact_unixtime,
           'groups' => $this->groups,
           'budget_period' => $this->vyruchka_period,
           'budget_year' => $this->vyruchka_za_god,
        );
    }

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


