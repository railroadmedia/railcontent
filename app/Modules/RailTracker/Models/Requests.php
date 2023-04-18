<?php

namespace App\Modules\RailTracker\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Requests
 *
 * @package App\Modules\RailTracker\Models
 *
 * @property integer $id
 * @property integer $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Requests extends Model
{
    protected $table = 'railtracker4_requests';
    protected $primaryKey = 'id';

}
