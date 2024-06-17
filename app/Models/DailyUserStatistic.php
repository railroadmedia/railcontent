<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DailyUserStatistic
 * 
 * @property int $id
 * @property Carbon $day
 * @property string $brand_allocation_type
 * @property string $brand
 * @property int $total_members_with_full_access
 * @property int $total_members_with_basic_access
 * @property int $total_monthly_members
 * @property int $total_annual_members
 * @property int $total_members_in_trial_period
 * @property int $total_lifetime_members
 * @property int $total_active_members
 * @property int $total_expired_members
 * @property Carbon $generated_at
 *
 * @package App\Models
 */
class DailyUserStatistic extends Model
{
	protected $table = 'daily_user_statistics';
	public $timestamps = false;

	protected $casts = [
		'day' => 'datetime',
		'total_members_with_full_access' => 'int',
		'total_members_with_basic_access' => 'int',
		'total_monthly_members' => 'int',
		'total_annual_members' => 'int',
		'total_members_in_trial_period' => 'int',
		'total_lifetime_members' => 'int',
		'total_active_members' => 'int',
		'total_expired_members' => 'int',
		'generated_at' => 'datetime'
	];

	protected $fillable = [
		'day',
		'brand_allocation_type',
		'brand',
		'total_members_with_full_access',
		'total_members_with_basic_access',
		'total_monthly_members',
		'total_annual_members',
		'total_members_in_trial_period',
		'total_lifetime_members',
		'total_active_members',
		'total_expired_members',
		'generated_at'
	];
}
