<?php
namespace App\Models\Crm\Customer;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $kanal_id
 * @property string $kanal_name
 * @property integer $kanal_is_disabled
 */
class Channel extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_spravochnik_kanal_privlecheniya';
    protected $timestaps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'kanal_id';

    /**
     * @var array
     */
    protected $fillable = ['kanal_name', 'kanal_is_disabled'];

}
