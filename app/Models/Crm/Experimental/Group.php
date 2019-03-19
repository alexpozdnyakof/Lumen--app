<?php

namespace App\Models\Crm\Experimental;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $spisok_id
 * @property string $spisok_name
 * @property string $spisok_opisanie
 * @property int $spisok_creator_uid
 * @property int $spisok_create_time
 * @property int $spisok_edit_uid
 * @property int $spisok_edit_time
 * @property int $spisok_ball
 * @property int $spisok_is_pro
 * @property int $spisok_is_payroll
 * @property int $business_id
 * @property int $is_visible
 */
class Group extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_spiski';
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'spisok_id';

    /**
     * @var array
     */
    protected $fillable = [
        'spisok_id',
        'spisok_name', 
        'spisok_opisanie', 
        'spisok_creator_uid', 
        'spisok_create_time', 
        'spisok_edit_uid', 
        'spisok_edit_time',
        'spisok_ball', 
        'spisok_is_pro', 
        'spisok_is_payroll', 
        'business_id', 
        'is_visible'
    ];


    public function entrys(){
        return $this->hasMany(CustomerGroupEntry::class, 'spisok_id', 'spisok_id');
    }

    public function customers()
    {
      return $this->hasManyThrough(Customer::class, CustomerGroupEntry::class, 'spisok_id', 'client_id');
    }
    public function scopeMyCustomers($query, string $status = 'active', int $user) {
        if($status === 'active'){
            return $query->whereHas('customers', function($query) use($user) {
                return $query->whereHas('managers', function($q) use($user){
                    $q->where('counter', $user);
                })->whereNull('otrabotan_a_id');
            });
        }
        if($status === 'complete'){
            return $query->whereHas('customers', function($query) use($user){
                return $query->whereHas('managers', function($q) use($user){
                    $q->where('counter', $user);
                })->whereNotNull('otrabotan_a_id');
            });
        }
    }

    public function scopeCountCustomers($query, string $status = 'active', int $user) {
        if($status === 'active'){
            return $query->withCount(['customers' => function($query) use($user){
                return $query->whereHas('managers', function($q) use($user){
                    $q->where('counter', $user);
                })->whereNull('otrabotan_a_id');
            }]);
        }
        if($status === 'complete'){
            return $query->withCount(['customers' => function($query) use($user){
                return $query->whereHas('managers', function($q) use($user){
                    $q->where('counter', $user);
                })->whereNotNull('otrabotan_a_id');
            }]);
        }
    }
}
