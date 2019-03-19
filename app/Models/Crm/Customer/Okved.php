<?php

namespace App\Models\Crm\Customer;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $okved_new
 * @property string $okved_old
 * @property string $okved_new_name
 * @property string $okved_old_name
 */
class Okved extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_kody_okved';
    protected $timestaps = false;
    /**
     * @var array
     */
    protected $fillable = ['okved_new', 'okved_old', 'okved_new_name', 'okved_old_name'];

}
