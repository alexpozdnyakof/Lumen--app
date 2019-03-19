<?php

namespace App\Http\Resources\Products\Amulex\Admin; // setting up namespace for auto discover
use Illuminate\Http\Resources\Json\JsonResource; // resource json helper
use Illuminate\Support\Facades\Log;
use App\Http\Resources\Products\Amulex\Admin\Type as TypeResource;

class Certificate extends JsonResource{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */


    public function toArray($request) {
        //Log::debug($this);
        return [
            'id' => $this->id,
            'company' => $this->company,
            'created' => $this->created,
            'status' =>  $this->status,
            'updated' =>  $this->updated,
            'ceo' => $this->ceo,
            'tax' => $this->tax,
            'phone' => $this->phone,
            'email' => $this->email,
            'seller' => [
                'name' => $this->sellerprofile->ФИО,
                'id' =>$this->sellerprofile->counter
            ],
            'serial'=> $this->whenLoaded('amulexcode', function () {
                return $this->amulexcode->serial_code;
            }),
            'amulexId'=> $this->whenLoaded('amulexcode', function () {
                return $this->amulexcode->id;
            }),
            'type'=> $this->whenLoaded('amulexcode', function () {
                return $this->amulexcode->description->name;
            }),
            'payer'=> $this->whenLoaded('payment', function () {
                return [
                    'id' => $this->payment ? $this->payment->amulex_memorder_id : null,
                    'name' => $this->payment ? $this->payment->payer_name : null,
                    'activatedId' => $this->payment ? $this->payment->cert_id : null,
                ];
            }),
        ];
    }
    protected  function _makeStatus($status) {
        switch($status) {
            case 0:
                return 'Ожидает оплаты';
            case 1:
                return 'Оплачен';
            case 2:
                return 'Просрочен';
            default:
                   return 'Неизвестен';
        }
        return is_null($value) ? $default : $value;
    }

    protected  function _makeSerial($amulex) {
        return $amulex->serial_code;
    }

    protected  function _isEmpty($value, $default='Отсутствует') {
        return is_null($value) ? $default : $value;
    }

}


