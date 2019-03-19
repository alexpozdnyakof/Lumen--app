<?php

namespace App\Models\Products\Amulex;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $prospect_id
 * @property string $user_id
 */
class Activated extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'amulex_activated';
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
    protected $fillable = ['id', 'company', 'tax', 'created', 'updated', 'type', 'status', 'ceo', 'phone', 'email', 'seller'];

    public function amulexcode(){
        return $this->hasOne(AmulexSerial::class, 'activated', 'id');
    }

    public function payment() {
        return $this->hasOne(Pay::class, 'cert_id', 'id');
    }

    public function sellerprofile(){
        return $this->hasOne(Seller::class, 'counter', 'seller')
        ->select(
            'counter',
            'ФИО',
            'email',
            'rb',
            'glavnyi',
            'telefon',
            'business_territory');
    }
}




// 1. activated - include data about activated
// has amulex serial + type + id
// has seller
// has payment
// 2. payment - include data about payment
// has amulex serial + id
// has activated