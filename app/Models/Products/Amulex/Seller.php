<?php
namespace App\Models\Products\Amulex;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $prospect_id
 * @property string $user_id
 */
class Seller extends Model
{


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pro_users';
    public $timestamps = false;
    protected $primaryKey = 'counter';
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    //public $incrementing = false;

    /**
     * @var array
     */
   protected $fillable = ['counter', 'ФИО', 'email', 'rb', 'glavnyi', 'branch', 'telefon', 'v_shtate', 'business_territory', 'avatar'];


}


