<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
/**
 * @property int $id
 * @property string $username
 * @property int $v_shtate
 * @property int $glavniy
 * @property string $email
 * @property string $user_role
 */
class User extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pro_users';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'v_shtate', 'glavniy', 'email', 'user_role'];
    protected $hidden = [
        'password',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'user_id', 'id');
      //  return Client::whereIn('user_id', $id)->get();
    }


}

