<?php

namespace App\Models\Products\Amulex;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $action
 * @property string $entityName
 * @property int $entityId
 * @property string $field
 * @property string $prevValue
 * @property string $newValue
 * @property int $user
 * @property string $created
 */
class Logger extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'amulex_log';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['action', 'entityName', 'entityId', 'field', 'prevValue', 'newValue', 'user', 'created'];
    public function user(){
        return $this->hasOne(Seller::class, 'counter', 'user')
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