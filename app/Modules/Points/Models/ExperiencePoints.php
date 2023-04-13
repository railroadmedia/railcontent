<?php

namespace App\Modules\Points\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExperiencePoints
 *
 * @package App\Modules\Points\Models
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $trigger_hash
 * @property string $trigger_name
 * @property string $trigger_hash_data
 * @property integer $points
 * @property string $points_description
 * @property string $brand
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ExperiencePoints extends Model
{
    protected $table = 'points_user_points';
    protected $primaryKey = 'id';


}
