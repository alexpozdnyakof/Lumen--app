<?php

namespace App\Models\Products\Loans;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float $ftp
 * @property float $gross
 * @property float $decent
 * @property float $result
 * @property string $date
 * @property int $managerID
 * @property string $type
 * @property string $note
 * @property string $managerName
 */
class CalculateHistory extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'loans_calculate_history';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['ftp', 'gross', 'decent', 'result', 'date', 'managerid', 'type', 'note', 'managername'];

}
