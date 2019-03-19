<?php

namespace App\Models\Products\Loans;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $prospect_id
 * @property string $user_id
 */
class LoanCalculatorScore extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'loans_calculator';
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
    protected $fillable = ['id', 'period_start', 'period_end', 'segment', 'collateral', 'amount', 'score', 'created_at', 'updated_at'];
}


