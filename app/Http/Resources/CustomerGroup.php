<?php
namespace App\Http\Resources; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper

class CustomerGroup extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

     public function toArray($request) {
        return [
            'id' => $this->group->id,
            'name' => $this->group->spisok_name,
            'description' => $this->group->spisok_opisanie,
            'valuation' => $this->group->spisok_ball,
       ];
    }
}

/*"groups": [
        {
            "id": 1,
            "spisok_id": 1,
            "client_id": 1,
            "add_uid": null,
            "add_time": null,
            "otrabotan_a_id": null,
            "pivot": {
                "uid": 20,
                "client_id": 1
            },
            "group": {
                "id": 1,
                "spisok_id": 1,
                "spisok_name": "Контрагенты клиентов Росбанк: ПАО Московский кредитный банк",
                "spisok_opisanie": "Контрагенты клиентов Росбанк: ПАО Московский кредитный банк",
                "spisok_creator_uid": 8,
                "spisok_create_time": 1502899343,
                "spisok_edit_uid": 8,
                "spisok_edit_time": 1503666079,
                "spisok_is_pro": 10,
                "business_id": 1,
                "spisok_ball": 13,
                "is_visible": 1,
                "spisok_is_payroll": 1
            }
        },
*/
