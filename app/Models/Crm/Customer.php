<?php
namespace App\Models\Crm;
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
        'channel'
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
        'client_id', // client id
        'name',  // client name
        'inn',
        'ogrn', 
        'fclient', // ?!
        'terofis',  // client TO
        'gruppa_kompaniy', 
        'opf', // opf code
        'date_reg_yyyymmdd', 
        'date_update_unixtime', 
        'date_liquidation_yyyymmdd', 
        'data_posledniy_contact_unixtime', 
        'date_client_otkryt_yyyymmdd', 
        'date_client_zakryt_yyyymmdd', 
        'management_name', 
        'management_post', 
        'management_inn', 
        'contact_phones_array', 
        'contact_email', 
        'contact_website', 
        'okved_main', 
        'okved_all', 
        'okved_vid_deyatelnosti', 
        'otrasl', 
        'adres_reg', 
        'adres_fact', 
        'adres_pocht', 
        'adres_region', 
        'code_spark', 
        'code_kpp', 
        'code_okpo', 
        'code_okopf', 
        'code_oktmo', 
        'code_okfs', 
        'code_okogu', 
        'code_okato', 
        'spark_vazhnaya_informaciya', 
        'spark_data_rozhdeniya_ip', 
        'dadata_update_time', 
        'dadata_status', 
        'dadata_tax_office', 
        'dadata_geo_lat', 
        'dadata_geo_lon', 
        'dadata_city', 
        'dadata_city_area', 
        'dadata_city_district_with_type', 
        'dadata_area_with_type', 
        'vyruchka_period', 
        'vyruchka_za_god', 
        'razmer_predpriyatiya', 
        'NumberOfEmployeesRange', 
        //'created_uid', 
        //'created_unixtime', 
        //'created_ip', 
        'kanal_privlecheniya', 
        'user_input_json', 
        'analytics', 
        'svobodnyi_status', 
        //'new_client_id', 
        'data_pervyi_zvonok', 
        'data_pervaya_vstrecha', 
        //'counter_vsego_resultativnyh_zvonkov', 
        //'counter_vsego_resultativnyh_vstrech', 
        'priority', 
        'current_bank', 
        'posledniy_resultat_text', 
        'interes_k', 
        //'zaplanirovannaya_data_sdelki', 
        //'zaplanirovannaya_data_sdelki_kogda_vveli', 
        'birthdate', 
        'BirthPlace', 
        'chistaya_pribil', 
        'CharterCapital', 
        //'akcia', 
        'full_with_opf', 
        'kpp', 
        'okpo', 
        'payroll_fot', 
        'current_payroll_bank', 
        'opf_full', 
        'RegAuthority',
        'RegAuthorityAddress', 
        //'is_in_blacklist', 
        //'user_input_json_secret', 
        //'utm_rosbank_ru', 
        //'utm_rosbank_ru_phone', 
        'kanal_privlecheniya_changed_by', 
        'kanal_privlecheniya_change_time', 
        'siebelid'
    ];

    public function entrys() {
        return $this->hasMany(CustomerGroupEntry::class, 'client_id', 'client_id');
    }
    public function managers() {
      return $this->hasManyThrough(Manager::class, ManagerCustomerEntry::class, 'client_id', 'counter', 'client_id', 'uid');
    }
    public function groups() {
        return $this->belongsToMany(Group::class,'crm_spiski_clientov', 'client_id', 'spisok_id');
    }

    public function channel() {
        return $this->hasOne(Channel::class, 'kanal_id', 'kanal_privlecheniya');
    }
    /*
    public function groups() {
        return $this->belongsToMany(CustomerGroup::class,'crm_spiski_clientov', 'client_id', 'spisok_id')->where('crm_spiski.business_id', '=', '1');
    }
    */
    public function tasks() {
        return $this->belongsTo(Task::class, 'client_id',  'client_id');
    }

    public function scopeGetAnalytics($query) {
        return $query->select(
            'client_id',
            'current_bank',
            'analytics',
            'user_input_json',
            'spark_vazhnaya_informaciya',
            'spark_data_rozhdeniya_ip'
        );
    }
    public function scopeOwner($query, int $user) {
        return $query->whereHas('managers', function($q) use ($user) {
            $q->whereCounter($user);
        });
    }
    public function scopeList($query) {
        return $query->select(
            'client_id',
            'priority',
            'name',
            'okved_vid_deyatelnosti',
            'data_posledniy_contact_unixtime',
            'vyruchka_period',
            'vyruchka_za_god',
            'posledniy_resultat_text'
        );
    }
    public function scopeOpened($query, $userId) {
        return $query->whereHas('managers', function($q) use($userId){
            $q->whereCounter($userId)->where('is_active', 1);
        });
    }

    public function scopeEntryGroup($query, int $group) {
        return $query->whereHas('groups', function($q) use ($group) {
            $q->where('crm_spiski_clientov.spisok_id', $group);
        });
    }
    public function scopeClosed($query, $userId) {
        return $query->whereHas('managers', function($q) use($userId){
            $q->whereCounter($userId)->where('is_active', 0);
        });
    }
    public function scopeTaskByStatus($query, string $status, int $user) {
        return $query->whereHas('tasks', function($query) use($status, $user){
            $query->owner($user)->status($status);
        });
    }
    public function scopeLastTask($query) {
        return $query->with(['tasks' => function($query){
            $query->latest('a_id');
        }]);
    }
    public function scopeWithoutTasks($query, int $user) {
        return $query->whereDoesntHave('tasks', function($query) use($user){
            $query->owner($user);
        });
    }

    

}
