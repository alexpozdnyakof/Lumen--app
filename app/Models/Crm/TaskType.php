<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $act_id
 * @property string $act_allowed_roles
 * @property int $act_type
 * @property string $act_type_text
 * @property int $act_result
 * @property string $act_result_text
 * @property string $act_result_reason
 * @property int $act_ask_next_meet
 * @property int $act_next_meet_type
 * @property string $act_sub_status
 * @property string $act_sub_status_comment
 * @property int $act_ask_datu_sdelki
 * @property string $act_trigger
 * @property string $act_comment_html
 * @property string $act_sub_status_type
 */
class TaskType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'crm_activity_types';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'act_id';

    /**
     * @var array
     */
    protected $fillable = [
        'act_allowed_roles',
        'act_type',
        'act_type_text',
        'act_result',
        'act_result_text',
        'act_result_reason',
        'act_ask_next_meet',
        'act_next_meet_type',
        'act_sub_status',
        'act_sub_status_comment',
        'act_ask_datu_sdelki',
        'act_trigger',
        'act_comment_html',
        'act_sub_status_type'
    ];

    public function activity() {
        return $this->belongsTo(Task::class, 'act_id', 'act_id');
    }
}
