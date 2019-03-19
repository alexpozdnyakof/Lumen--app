<?php

namespace App\Http\Resources\Crm\Customer; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper
use Illuminate\Support\Facades\Log;


class CustomerCompact extends JsonResource{
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
            'office' => $this->terofis,
            'company_group' => $this->_isEmpty($this->gruppa_kompaniy),
            'size' => $this->_isEmpty($this->razmer_predpriyatiya, 'Не указан'),
            'employees' => $this->_isEmpty($this->NumberOfEmployeesRange, 'Не указано'),
            'industry' => $this->_isEmpty($this->otrasl, 'Не указана'),
            'channel' => $this->channel,
            'valuation' => $this->priority,
            'blacklist' => $this->is_in_blacklist,
            'proceed' => [
                'period' => $this->vyruchka_period,
                'amount' => $this->vyruchka_za_god,
            ],
            'details' => [
                'inn' => $this->inn,
                'ogrn' => $this->ogrn,
                'opf' => $this->opf,
                'codes' => [
                    'okved' => ['main' => $this->okved_main, 'all' => explode(";", $this->okved_all)],
                    'spark' => $this->code_spark,
                    'kpp' => $this->code_kpp,
                    'okpo' => $this->code_okpo,
                    'okopf' => $this->code_okopf,
                    'oktmo' => $this->code_oktmo,
                    'okfs' => $this->code_okfs,
                    'okogu' => $this->code_okogu,
                    'okato' => $this->code_okato,
                ],
            ],
            'payroll' => [
                'bank' => $this->_isEmpty($this->current_payroll_bank, 'Не указан'),
                'fot' => $this->_isEmpty($this->payroll_fot, 'Не указан'),
            ],
            'dates' => [
                'registration' => $this->date_reg_yyyymmdd,
                'update' => $this->date_update_unixtime,
                'сloseout' => $this->date_liquidation_yyyymmdd,
                'contact' => $this->data_posledniy_contact_unixtime,
                'open' => $this->date_client_otkryt_yyyymmdd,
                'closed' => $this->date_client_zakryt_yyyymmdd,
            ],
            'contacts' => [
                'phones' =>  json_decode($this->contact_phones_array, true),
                'email' => $this->contact_email,
                'website' => $this->contact_website,
                'address' => [
                    'registration' => $this->_isEmpty($this->adres_reg, 'Не указан'),
                    'fact' => $this->_isEmpty($this->adres_fact, 'Не указан'),
                    'mail' => $this->_isEmpty($this->adres_pocht, 'Не указан'),
                    'region' => $this->_isEmpty($this->adres_region, 'Не указан'),
                ],
                'managers' => [
                    'name' => $this->management_name,
                    'management_post' => $this->management_post,
                    'inn' => $this->management_in
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
            ],

            'author' => $this->created_uid,
        ];
    }

    protected  function _isEmpty($value, $default='Отсутствует') {
        return is_null($value) ? $default : $value;
    }

}


