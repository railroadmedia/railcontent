<?php

namespace App\Modules\HelpScout\Models;

use App\Modules\HelpScout\database\factories\HelpScoutUserFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HelpScoutUser
 * @internal
 *
 * @package App\Modules\HelpScout\Models
 *
 * @property integer $user_id
 * @property integer $helpscout_user_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 */
class HelpScoutUser extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'helpscout_users';

    protected $primaryKey = 'user_id';

    protected static function newFactory(): HelpScoutUserFactory
    {
        return HelpScoutUserFactory::new();
    }
}
