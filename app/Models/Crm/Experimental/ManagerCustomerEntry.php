<?php

namespace App\Models\Crm\Experimental;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $client_id
 * @property int $uid
 * @property int $allowed_id
 * @property string $branch
 * @property string $date_from
 * @property string $date_to
 * @property int $is_active
 */
class ManagerCustomerEntry extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_client_managers';
    public $timestamps = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['client_id', 'uid', 'allowed_id', 'branch', 'date_from', 'date_to', 'is_active'];

}
