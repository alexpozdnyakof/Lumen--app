<?php
namespace App\Models\Crm\Experimental;
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


   // ---- deprecated -----//
   /*
   public function lists(){
      return $this->belongsToMany(CustomerGroup::class)
      ->using(CustomerGroupPivot::class);
      return $this->belongsToMany(CustomerGroupPivot::class, 'crm_client_managers', 'uid', 'client_id', 'counter')->whereNull('otrabotan_a_id');
   }
   */