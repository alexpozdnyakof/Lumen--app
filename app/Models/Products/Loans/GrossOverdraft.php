<?php

namespace App\Models\Products\Loans;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $segment
 * @property float $100-75
 * @property float $75-50
 * @property float $50-0
 * @property float $0
 */
class GrossOverdraft extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'scorecalculator_grossmargin_overdraft';

    /**
     * @var array
     */
    protected $fillable = ['segment', '100-75', '75-50', '50-0', '0'];

}
