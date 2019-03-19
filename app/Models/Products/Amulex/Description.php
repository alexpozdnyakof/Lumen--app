<?php

namespace App\Models\Products\Amulex;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $prospect_id
 * @property string $user_id
 */
class Description extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'amulex_certs';
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
    protected $fillable = ['id','name', 'description', 'price', 'royalty_min', 'royalty_max', 'invoice_template', 'template'];

    public function amulex(){
        return $this->hasMany(Amulex::class, 'id', 'activated');
    }



}


