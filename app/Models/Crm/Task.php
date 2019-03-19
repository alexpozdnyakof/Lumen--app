<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Model;
use DateTime;

/**
 * @property int $a_id
 * @property int $client_id
 * @property int $creator_uid
 * @property int $created_server_unixtime
 * @property int $act_type
 * @property int $act_start_time
 * @property int $act_end_time
 * @property int $act_result
 * @property int $act_result_uid
 * @property int $act_result_unixtime
 * @property int $act_result_next_etap
 * @property string $act_result_reason
 * @property int $next_contact
 * @property string $act_zametka_text
 * @property int $act_is_first_contact
 * @property int $group_id
 * @property int $executor_uid
 * @property string $act_sub_status
 * @property int $act_id
 */
class Task extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_activity';
    //protected $dates = ['created_server_unixtime', 'act_start_time'];
   
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'a_id';
   
    /**
     * @var array
     */
    protected $fillable = [
        'client_id', //клиент
        'creator_uid', // кто создал
        'created_server_unixtime', // когда создана
        'act_type',  // 0 || 1
        'act_start_time', // запланированное для незакрытых и завершенное для закрытых
        'act_result_uid', // кто заврешил активность
        'executor_uid', // кто завершил
        'act_id',// связь с типами
        'act_result_reason',// результат
        'act_zametka_text', // заметка по клиенту?!
        'act_is_first_contact', // первый ли контакт?
        'group_id', // возможно пэйролл - про 1/2


        'act_result_unixtime',
        'act_sub_status',
        'act_result',
        'next_contact',
        'act_end_time',
        'act_result_next_etap',
    ];

    public $timestamps = false;

    const CREATED_AT = 'created_server_unixtime';
   // const UPDATED_AT = 'act_start_time';
    protected $dateFormat = 'U';
    public function manager() {
        return $this->hasOne(Manager::class, 'counter', 'executor_uid' );
    }

    public function author() {
        return $this->hasOne(Manager::class, 'counter', 'creator_uid');
    }

    public function type() {
        return $this->hasOne(TaskType::class, 'act_id', 'act_id');
    }

    public function customer() {
        return $this->hasOne(Customer::class, 'client_id', 'client_id');
    }

    public function getStatusAttribute($value) {
       return $this->attributes['act_type'];
    }


    public function scopeStatus($query, string $status) {
        $now = new DateTime();
        switch($status) {
            case 'completed':
                return $query->whereNotNull('act_result');
            case 'planned':
                return $query->whereNull('act_result')->where('act_start_time', '>', $now->getTimestamp());
            case 'duedate':
                return $query->whereNull('act_result')->where('act_start_time', '<', $now->getTimestamp());
        }
    }

    public function scopeOwner($query, int $user) {
        return $query->where('executor_uid', $user)->orWhere('creator_uid', $user);
     }

    public function scopeWithAuthor($query) {
        return $query->with([
            'author' => function($q) {
                $q->select('counter', 'ФИО');
            }
        ]);
    }
     public function scopeWithCustomer($query) {
        return $query->with([
            'customer' => function($q) {
                $q->select('client_id', 'name', 'priority');
            }
        ]);
     }

     public function scopeListView($query) {
        return $query->with([
            'author' => function($q) {
                $q->select('counter', 'ФИО');
            },
            'customer' => function($q) {
                $q->select('client_id', 'name', 'priority');
            }
        ]);
    }

     public function scopeHasCustomer($query, $customerId) {
        return $query->whereHas('customer', function($query) use($customerId){
            $query->where('client_id', $customerId);
        });
     }
     public function scopeType($query) {
        return $query->with(['type']);
     }
}
