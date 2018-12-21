<?php

namespace App\Models\Crm;

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
class CustomerGroup extends Model
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
    protected $with = [
        //'CustomersCount'
    ];
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

    public function customers() {
        return $this->belongsToMany(Customer::class,'crm_spiski_clientov', 'spisok_id', 'client_id');
     }

     
}
