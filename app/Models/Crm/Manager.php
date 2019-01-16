<?php
namespace App\Models\Crm;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $prospect_id
 * @property string $user_id
 */
class Manager extends Model
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
   protected $fillable = ['counter', 'ФИО', 'email', 'rb', 'glavnyi', 'branch', 'v_shtate', 'nas_punkt', 'avatar', 'filial',  'business_territory'];

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

   public function getPhotoAttribute($value)
   {
      return $this->attributes['avatar'];
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

    public function customers(){
      return $this->belongsToMany(Customer::class, 'crm_client_managers', 'uid', 'client_id')->whereIs_active(1);
    }
    public function groups(){
      return $this->belongsToMany(CustomerGroupPivot::class, 'crm_client_managers', 'uid', 'client_id', 'counter')->whereNull('otrabotan_a_id');
   }
   public function roles() {
      return $this->hasMany(Role::class,'lumen_users_roles', 'user_id', 'role_id');
   }
   public function tasks() {
      return $this->hasMany(Task::class, 'creator_uid',  'counter');
   }
   public function tasksDone() {
      return $this->hasMany(Task::class, 'executor_uid',  'counter');
   }
}


