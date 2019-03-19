<?php

namespace App\Models\Products\Amulex;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $prospect_id
 * @property string $user_id
 */
class AmulexSerial extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'amulex_codes';
    public $timestamps = false;
    
    protected $with = [
        'description',
    ];
    protected $casts = [
        'activated' => 'integer'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    //public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['id','serial_code', 'activated_code', 'type', 'activated'];
 /*
    public function activated(){
        return $this->belongsTo(Activated::class, 'activated', 'id');
    }
   
    public function activated(){
        return $this->belongsTo(Activated::class, 'activated', 'id');
    }
    */
    public function description(){
        return $this->hasOne(Description::class,'id', 'type');
    }

    public function pay(){
        //return $this->hasOne(Pay::class, 'cert_id', 'id'); 
    }

}


