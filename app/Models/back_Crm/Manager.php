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
   public function customers() {
      return $this->belongsToMany(Customer::class,'crm_client_managers', 'uid', 'client_id');
   }
    public function customersFiltered() {
      return $this->belongsToMany(Customer::class,'crm_client_managers', 'uid', 'client_id')
        ->where('is_active', 1)
        ->select('first_name_on_load', 'id', 'crm_clients.client_id')
        ->with(['groups' => function($query){
                $query->select('spisok_name', 'spisok_opisanie', 'crm_spiski.spisok_id', 'crm_spiski.business_id')->withCount('customers');
            }, 'managers' => function($query){
                $query->select('counter');
            }])->take(2000);
    }
   // ->mapToGroups(function ($item, $key) {
        // return [$item['glavnyi'] => array('username' => $item['ФИО'], 'id' => $item['counter'], 'count' => $item['clients_count'])];
    public function nogroups(){
      return $this->hasManyThrough(
         CustomerGroupPivot::class, 
         ManagerCustomerPivot::class,
         'client_id',
         'spisok_id',
         'counter',  
         'uid'
      );
    }

    public function groups(){
      return $this->belongsToMany(CustomerGroupPivot::class, 'crm_client_managers', 'uid', 'client_id');
/*
      return $this->hasManyThrough(
         CustomerGroupPivot::class, 
         ManagerCustomerPivot::class,
         'client_id',
         'spisok_id',
         'counter',
         'uid'
      );
      */
    }

    public function roles() {
      return $this->hasMany(Role::class,'lumen_users_roles', 'user_id', 'role_id');
    }
    public function customergroups() {
        return $this->hasManyThrough(CustomerGroup::class, Customer::class)
        ->take(5);
    }
}

