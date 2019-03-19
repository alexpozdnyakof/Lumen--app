<?php

namespace App\Models\Products\Amulex;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $amulex_memorder_id
 * @property string $dtprov
 * @property string $reason
 * @property string $comment
 * @property float $summ
 * @property string $purpose
 * @property string $payer_personalacc
 * @property string $payer_bank_bic
 * @property string $payer_inn
 * @property string $payer_name
 * @property string $status
 * @property int $cert_id
 */
class Pay extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'amulex_memorder';

    //protected $append = ['date'];
    public $timestamps = false;
    protected $with = [
    ];

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'amulex_memorder_id';

    /**
     * @var array
     */
    protected $fillable = ['dtprov', 'reason', 'comment', 'summ', 'purpose', 'payer_personalacc', 'payer_bank_bic', 'payer_inn', 'payer_name', 'status', 'cert_id'];
    public function scopeList($query) {
        return $query->select(
            'amulex_memorder_id',
            'dtprov',
            'reason',
            'payer_inn',
            'payer_name',
            'cert_id'
        );
    }
    public function activated(){
        return $this->hasOne(Activated::class, 'id', 'cert_id');
    }
    public function Code(){
        return $this->hasOne(Activated::class, 'id', 'cert_id');
    }
    public function serial(){
        return $this->hasOne(Activated::class, 'id', 'cert_id');
    }

   /* public function managers() {
        return $this->hasManyThrough(Manager::class, ManagerCustomerEntry::class, 'client_id', 'counter', 'client_id', 'uid');
      }*/
}