<?php

namespace App\Modules\HelpScout\Models;

use App\Modules\HelpScout\database\factories\HelpScoutUserFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HelpScoutUser
 *
 * @internal
 * @package App\Modules\HelpScout\Models
 * @property integer $user_id
 * @property integer $helpscout_user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static \App\Modules\HelpScout\database\factories\HelpScoutUserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|HelpScoutUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutUser whereHelpscoutUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpScoutUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|HelpScoutUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HelpScoutUser withoutTrashed()
 * @mixin \Eloquent
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
