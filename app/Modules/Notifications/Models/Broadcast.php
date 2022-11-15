<?php

namespace App\Modules\Notifications\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $channel
 * @property string $type
 * @property string $status
 * @property string $report
 * @property integer $notification_id
 * @property string $aggregation_group_id
 * @property Carbon $broadcast_on
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Broadcast extends Model
{
    const TYPE_SINGLE = 'single';
    const TYPE_AGGREGATED = 'aggregated';

    const STATUS_IN_TRANSIT = 'in transit';
    const STATUS_SENT = 'sent';
    const STATUS_FAILED = 'failed';

    protected $table = 'notification_broadcasts';

}
