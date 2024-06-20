<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WeeklyUserStatistic
 * 
 * @property int $id
 * @property Carbon $week
 * @property int $user_id
 * @property string $last_used_brand
 * @property string $most_content_starts_brand
 * @property int $count_of_content_starts_drumeo
 * @property int $count_of_content_starts_pianote
 * @property int $count_of_content_starts_guitareo
 * @property int $count_of_content_starts_singeo
 * @property int $count_of_content_starts_basseo
 * @property int $count_of_content_starts_musora
 * @property string $access_type
 * @property string $access_frequency
 * @property bool $in_trial_period
 * @property bool $active
 * @property bool $expired
 * @property Carbon $generated_at
 *
 * @package App\Models
 */
class WeeklyUserStatistic extends Model
{
	protected $table = 'weekly_user_statistics';
	public $timestamps = false;

	protected $casts = [
		'week' => 'datetime',
		'user_id' => 'int',
		'count_of_content_starts_drumeo' => 'int',
		'count_of_content_starts_pianote' => 'int',
		'count_of_content_starts_guitareo' => 'int',
		'count_of_content_starts_singeo' => 'int',
		'count_of_content_starts_basseo' => 'int',
		'count_of_content_starts_musora' => 'int',
		'in_trial_period' => 'bool',
		'active' => 'bool',
		'expired' => 'bool',
		'generated_at' => 'datetime'
	];

	protected $fillable = [
		'week',
		'user_id',
		'last_used_brand',
		'most_content_starts_brand',
		'count_of_content_starts_drumeo',
		'count_of_content_starts_pianote',
		'count_of_content_starts_guitareo',
		'count_of_content_starts_singeo',
		'count_of_content_starts_basseo',
		'count_of_content_starts_musora',
		'access_type',
		'access_frequency',
		'in_trial_period',
		'active',
		'expired',
		'generated_at'
	];
}
