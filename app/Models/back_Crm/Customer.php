<?php
namespace App\Models\Crm;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $client_id
 * @property string $name
 * @property string $first_name_on_load
 * @property string $inn
 * @property string $ogrn
 * @property int $km_uid
 * @property int $support_uid
 * @property string $fclient
 * @property string $terofis
 * @property int $gruppa_kompaniy
 * @property int $prospect_stadiya_privlecheniya
 * @property string $opf
 * @property int $date_reg_yyyymmdd
 * @property int $date_update_unixtime
 * @property int $date_liquidation_yyyymmdd
 * @property int $data_posledniy_contact_unixtime
 * @property int $date_client_otkryt_yyyymmdd
 * @property int $date_client_zakryt_yyyymmdd
 * @property string $management_name
 * @property string $management_post
 * @property string $management_inn
 * @property string $contact_phones_array
 * @property string $contact_email
 * @property string $contact_website
 * @property string $okved_main
 * @property string $okved_all
 * @property string $okved_vid_deyatelnosti
 * @property string $otrasl
 * @property string $adres_reg
 * @property string $adres_fact
 * @property string $adres_pocht
 * @property string $adres_region
 * @property string $code_spark
 * @property string $code_kpp
 * @property string $code_okpo
 * @property string $code_okopf
 * @property string $code_oktmo
 * @property string $code_okfs
 * @property string $code_okogu
 * @property string $code_okato
 * @property string $spark_vazhnaya_informaciya
 * @property string $spark_data_rozhdeniya_ip
 * @property int $dadata_update_time
 * @property string $dadata_status
 * @property string $dadata_tax_office
 * @property string $dadata_geo_lat
 * @property string $dadata_geo_lon
 * @property string $dadata_city
 * @property string $dadata_city_area
 * @property string $dadata_city_district_with_type
 * @property string $dadata_area_with_type
 * @property string $vyruchka_period
 * @property int $vyruchka_za_god
 * @property string $razmer_predpriyatiya
 * @property string $NumberOfEmployeesRange
 * @property string $holders_text
 * @property int $created_uid
 * @property int $created_unixtime
 * @property string $created_ip
 * @property string $kanal_privlecheniya
 * @property string $user_input_json
 * @property string $analytics
 * @property string $svobodnyi_status
 * @property integer $new_client_id
 * @property int $data_pervyi_zvonok
 * @property int $data_pervaya_vstrecha
 * @property int $counter_vsego_resultativnyh_zvonkov
 * @property int $counter_vsego_resultativnyh_vstrech
 * @property int $priority
 * @property string $current_bank
 * @property string $posledniy_resultat_text
 * @property string $interes_k
 * @property string $zaplanirovannaya_data_sdelki
 * @property string $zaplanirovannaya_data_sdelki_kogda_vveli
 * @property int $birthdate
 * @property string $BirthPlace
 * @property integer $chistaya_pribil
 * @property integer $CharterCapital
 * @property int $km_uid_payroll
 * @property int $akcia
 * @property string $full_with_opf
 * @property string $kpp
 * @property string $okpo
 * @property string $payroll_fot
 * @property string $current_payroll_bank
 * @property string $opf_full
 * @property string $RegAuthority
 * @property string $RegAuthorityAddress
 * @property integer $is_in_blacklist
 * @property string $user_input_json_secret
 * @property integer $utm_rosbank_ru
 * @property string $utm_rosbank_ru_phone
 * @property int $kanal_privlecheniya_changed_by
 * @property int $kanal_privlecheniya_change_time
 * @property string $siebelid
 */
class Customer extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_clients';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'client_id';
    protected $with = [
        'groups',
        'managers'
    ];

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    public $timestamps = false;
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
        'terofis', 
        'gruppa_kompaniy', 
        'prospect_stadiya_privlecheniya', 
        'opf', 'date_reg_yyyymmdd', 
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
        'holders_text', 
        'created_uid', 
        'created_unixtime', 
        'created_ip', 
        'kanal_privlecheniya', 
        'user_input_json', 
        'analytics', 
        'svobodnyi_status', 
        'new_client_id', 
        'data_pervyi_zvonok', 
        'data_pervaya_vstrecha', 
        'counter_vsego_resultativnyh_zvonkov', 
        'counter_vsego_resultativnyh_vstrech', 
        'priority', 
        'current_bank', 
        'posledniy_resultat_text', 
        'interes_k', 
        'zaplanirovannaya_data_sdelki', 
        'zaplanirovannaya_data_sdelki_kogda_vveli', 
        'birthdate', 
        'BirthPlace', 
        'chistaya_pribil', 
        'CharterCapital', 
        'km_uid_payroll', 
        'akcia', 
        'full_with_opf', 
        'kpp', 
        'okpo', 
        'payroll_fot', 
        'current_payroll_bank', 
        'opf_full', 
        'RegAuthority', 
        'RegAuthorityAddress', 
        'is_in_blacklist', 
        'user_input_json_secret', 
        'utm_rosbank_ru', 
        'utm_rosbank_ru_phone', 
        'kanal_privlecheniya_changed_by', 
        'kanal_privlecheniya_change_time', 
        'siebelid'
    ];
    public function managers() {
        return $this->belongsToMany(Manager::class,'crm_client_managers','client_id', 'uid')->wherePivot('is_active', 1);
    }
    public function groups() {
        return $this->belongsToMany(CustomerGroup::class,'crm_spiski_clientov', 'client_id', 'spisok_id')->where('crm_spiski.business_id', '=', '1');
    }
}
