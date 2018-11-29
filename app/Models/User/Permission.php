<?php
namespace App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $prospect_id
 * @property s tring $user_id
 */
class Permission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'lumen_permissions';
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
    protected $fillable = ['id','slug', 'name', 'created_at', 'updated_at'];
     public function roles() {
        return $this->belongsToMany(Permission::class,'lumen_roles_permissions', 'permission_id', 'role_id');
     }
}


