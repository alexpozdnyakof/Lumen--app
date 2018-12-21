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
class Activity extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_activity';
    public $timestamps = false;
    protected $primaryKey = 'a_id';
    protected $with = [
        'group'
    ];
    /**
     * @var array
     */
    protected $fillable = ['a_id', 'client_id', 'creator_uid', 'act_type', 'act_start_time'];

    
    public function group(){
        return $this->hasOne(CustomerGroup::class, 'spisok_id', 'spisok_id');
    }

}
