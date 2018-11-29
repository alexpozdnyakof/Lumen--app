<?php
namespace App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $prospect_id
 * @property string $user_id
 */
class PermissionRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lumen_roles_permissions';
    public $timestamps = false;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    //public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['id','role_id', 'permission_id'];
}


