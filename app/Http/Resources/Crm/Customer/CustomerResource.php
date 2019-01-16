<?php

namespace App\Http\Resources\Crm\Customer; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper
use Illuminate\Support\Facades\Log;

use App\Http\Resources\Crm\Task\TaskResource;

class CustomerResource extends JsonResource{
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
            'name' => $this->name,
            'tasks' => TaskResource::collection($this->tasks),
            'main' => [
                'inn' => $this->inn,
                'ogrn' => $this->ogrn,
                'office' => $this->terofis,
                'company_group' => $this->gruppa_kompaniy,
                'opf' => $this->opf,
                'okved' => ['main' => $this->okved_main, 'all' => explode(",", $this->okved_all)],
                'industry' => $this->okved_vid_deyatelnosti,
            ],
            'analytics' => json_decode($this->analytics, true),
            'userinput' => json_decode($this->user_input_json, true),
            'checkpoints' => [
                'registration' => $this->date_reg_yyyymmdd,
                'update' => $this->date_update_unixtime,
                'liquidate' => $this->date_liquidation_yyyymmdd,
                'contact' => $this->data_posledniy_contact_unixtime,
                'open' => $this->date_client_otkryt_yyyymmdd,
                'closed' => $this->date_client_zakryt_yyyymmdd,
            ],
            'managment' => [
                'name' => $this->management_name,
                'management_post' => $this->management_post,
                'inn' => $this->management_in
            ],
            'contacts' => [
                'phones' =>  json_decode($this->contact_phones_array, true),
                'email' => $this->contact_email,
                'website' => $this->contact_website
            ],
            'address' => [
                'registration' => $this->adres_reg,
                'fact' => $this->adres_fact,
                'mail' => $this->adres_pocht,
                'region' => $this->adres_region,
            ],
            'codes' => [
                'spark' => $this->code_spark,
                'kpp' => $this->code_kpp,
                'okpo' => $this->code_okpo,
                'okopf' => $this->code_okopf,
                'oktmo' => $this->code_oktmo,
                'okfs' => $this->code_okfs,
                'okogu' => $this->code_okogu,
                'okato' => $this->code_okato,
            ],
            'spark' => [
                'info' => $this->spark_vazhnaya_informaciya,
                'birthday' => $this->spark_data_rozhdeniya_ip,
            ],
            'dadata' => [
                'updated_at' => $this->dadata_update_time,
                'status' => $this->dadata_status,
                'tax-office' => $this->dadata_tax_office,
                'geo' => [
                    'latitude' => $this->dadata_geo_lat,
                    'longitude' => $this->dadata_geo_lon,
                ],
                'city' => $this->dadata_city,
                'region' => $this->dadata_city_district_with_type,
                'region_full' => $this->dadata_city_district_with_type,
                'area' => $this->dadata_area_with_type
            ],
            'money' => [
                'period' => $this->vyruchka_period,
                'count' => $this->vyruchka_za_god,
            ],
            'author' => $this->created_uid,
        ];
    }

}


