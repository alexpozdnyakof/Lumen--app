<?php

namespace App\Http\Resources\Crm\Task; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper
use Illuminate\Support\Facades\Log;
use DateTime;


class TaskResource extends JsonResource{
 /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

    public function toArray($request) {
        return [
            'id' => $this->a_id,
            'customer' => ['id' => $this->customer->client_id, 'name' => $this->customer->name, 'valuation' => $this->customer->priority],
            'status' =>  $this->_checkStatus($this->act_result, $this->act_start_time),
            'result' => $this->act_result,
            //'author' => $this->author,
            'created' => $this->created_server_unixtime,
            'type' => $this->act_type == 0 ? 'Звонок' : 'Встреча',
            'start_date' => $this->act_start_time * 1000,
            'comment' => $this->act_zametka_text,
            //'customer' => ['id' => $this->client_id, 'name' => $this->name, 'valuation' => $this->priority],
            //'author' => ['id' => $this->counter, 'name' => $this->ФИО]
        ];
    }

    protected  function _checkStatus($result, $startTime) {
        $now = new DateTime();
        if (is_null($result)) {
            return $startTime > $now->getTimestamp() ? 'Запланировано': 'Просрочено';
        }
        return 'Завершено';
    }
}


