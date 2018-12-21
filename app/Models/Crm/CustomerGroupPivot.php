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
class CustomerGroupPivot extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_spiski_clientov';
    protected $primaryKey = 'client_id';
    public $timestamps = false;
    protected $with = [
        'group'
    ];
    /**
     * @var array
     */
    protected $fillable = ['spisok_id', 'client_id', 'add_uid', 'add_time', 'otrabotan_a_id'];

    public function group(){
        return $this->hasOne(CustomerGroup::class, 'spisok_id', 'spisok_id');
    }

}
