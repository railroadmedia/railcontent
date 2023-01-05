<?php

namespace App\Modules\Notifications\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Notifications\Models\Broadcast
 *
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
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast query()
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast whereAggregationGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast whereBroadcastOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast whereReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Broadcast whereUpdatedAt($value)
 * @mixin \Eloquent
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
