<?php
namespace App\Models\User;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $prospect_id
 * @property string $user_id
 */
class User extends Model
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
   protected $fillable = ['counter', 'ФИО', 'email', 'rb', 'glavnyi', 'branch', 'telefon', 'v_shtate', 'nas_punkt', 'avatar', 'working_since', 'cisco_phone_call_prefix', 'filial', 'birthday', 'business_territory'];
   protected $aliases = [
      'counter' => 'id',
      'ФИО' => 'name',
      'phone' => 'telefon'
   ];

    // protected $fillable = ['id', 'name', 'v_shtate', 'glavnyi', 'email', 'user_role', 'rb'];

   public function getChiefAttribute($value)
   {
      //return $this->hasOne(User::class, 'glavnyi', 'ФИО');
       return $this->attributes['glavnyi'];
   }

   public function getIdAttribute($value)
   {
      return $this->attributes['counter'];
   }

   public function getId() {
      return $this->attributes['counter'];
   }
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
      return $this->attributes['avatar'];
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
/*
   public function chief() {
      return User::class->where( 'ФИО', 'glavnyi')->findOrFail();
      //return $this->hasOne(User::class, 'glavnyi', 'ФИО');
   }
*/
   public function permissions() {
      return $this->belongsToMany(Permission::class,'lumen_users_permissions', 'user_id', 'permission_id');
   }
   public function roles() {
      return $this->belongsToMany(Role::class,'lumen_users_roles', 'user_id', 'role_id');
   }
}


