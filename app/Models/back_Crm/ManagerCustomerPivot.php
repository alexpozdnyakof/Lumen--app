<?php

namespace App\Models\Crm;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $spisok_id
 * @property integer $client_id
 * @property int $add_uid
 * @property int $add_time
 * @property integer $otrabotan_a_id
 */
class ManagerCustomerPivot extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_client_managers';

    /**
     * @var array
     */
    protected $fillable = ['client_id', 'uid', 'is_active'];

}
