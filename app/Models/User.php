<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Traits\HasPermissionsTrait;

/**
 * @property int $id
 * @property string $username
 * @property int $v_shtate
 * @property int $glavn iy
 * @property string $email
 * @property string $user_role
 */
class User extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasPermissionsTrait;
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
    protected $primaryKey = 'counter';

    protected $aliases = [
      'counter' => 'id',
      'ФИО' => 'name',
      'phone' => 'telefon'
   ];
    /**
     * @var array
     */
    protected $fillable = ['counter', 'ФИО', 'email', 'rb', 'glavnyi', 'branch', 'telefon', 'v_shtate', 'nas_punkt', 'avatar', 'working_since', 'cisco_phone_call_prefix', 'filial', 'birthday', 'business_territory'];
    //protected $maps = ['counter' => 'id', 'ФИО' => 'name'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getChiefAttribute($value)
    {
       return $this->attributes['glavnyi'];
    }
    /*   
    public function getIdAttribute($value)
    {
       return $this->attributes['counter'];
    }
    */
    public function getNameAttribute($value)
    {
       return $this->attributes['ФИО'];
    }
    public function getStateAttribute($value)
    {
       return $this->attributes['v_shtate'];
    }
    public function getCityAttribute($value)
    {
       return $this->attributes['nas_punkt'];
    }
    public function getPhoneAttribute($value)
    {
       return $this->attributes['telefon'];
    }
    public function getPhotoAttribute($value)
    {
       return $this->attributes['photo'];
    }
    public function getEmploymentAttribute($value)
    {
       return $this->attributes['working_since'];
    }
    public function getCiscoAttribute($value)
    {
       return $this->attributes['cisco_phone_call_prefix'];
    }
    public function getBranchcodeAttribute($value)
    {
       return $this->attributes['filial'];
    }
    public function getOfficeAttribute($value)
    {
       return $this->attributes['business_territory'];
    }
    public function clients()
    {
        return $this->hasMany(Client::class, 'user_id', 'id');
      //  return Client::whereIn('user_id', $id)->get();
    }


}

