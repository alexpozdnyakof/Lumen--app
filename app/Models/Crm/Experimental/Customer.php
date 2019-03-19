<?php
namespace App\Models\Crm\Experimental;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_clients';
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'client_id';
    protected $with = [
        //'groups',
        //'managers',
        //'managerPivot'
    ];

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'client_id',
        'name', 
        'first_name_on_load', 
        'inn', 
        'ogrn', 
        'km_uid', 
        'support_uid', 
        'fclient', 
    ];

    public function scopeOwner($query, int $user) {
        return $query->whereHas('managers', function($q) use ($user) {
            $q->whereCounter($user);
        });
    }

    public function scopeEntryGroup($query, int $group) {
        return $query->whereHas('groups', function($q) use ($group) {
            $q->where('crm_spiski_clientov.spisok_id', $group);
        });
    }

    public function entrys() {
        return $this->hasMany(CustomerGroupEntry::class, 'client_id', 'client_id');
    }

    public function managers() {
      return $this->hasManyThrough(Manager::class, ManagerCustomerEntry::class, 'client_id', 'counter', 'client_id', 'uid');
    }

    public function groups() {
        return $this->belongsToMany(Group::class,'crm_spiski_clientov', 'client_id', 'spisok_id');
    }
}

    //return $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'user_id');

