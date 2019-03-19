<?php

namespace App\Http\Resources\Crm\Customer; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper
use Illuminate\Support\Facades\Log;


class CustomerAnalytics extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */


    public function toArray($request) {
        //Log::debug($this);
        return [
            'bank' => $this->current_bank,
            'analytics' => json_decode($this->analytics, true),
            'userinput' => json_decode($this->user_input_json, true),
            'spark' => [
                'info' => $this->spark_vazhnaya_informaciya,
                'birthday' => $this->spark_data_rozhdeniya_ip,
            ],
        ];
    }

    protected  function _isEmpty($value, $default='Отсутствует') {
        return is_null($value) ? $default : $value;
    }

}


