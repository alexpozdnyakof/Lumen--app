<?php

namespace App\Models\Products\Loans;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $period
 * @property float $100
 * @property float $100-75
 * @property float $75-50
 * @property float $50-0
 * @property string $collateral
 * @property string $segment
 */
class GrossCredit extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'scorecalculator_grossmargin_credit';

    /**
     * @var array
     */
    protected $fillable = ['period', '100', '100-75', '75-50', '50-0', 'amount', 'segment'];

}
