<?php

namespace App\Modules\Referral\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 *
 * @package App\Modules\Referral\Models
 *
 * @property integer $user_id
 * @property string $brand
 * @property string $referral_program_id
 * @property string $referral_link
 * @property string $referral_code
 * @property integer $referrals_performed
 * @property integer $claimed_user_ids
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 */
class Referrer extends Model
{
    use SoftDeletes;

    protected $table = 'referral_referrers';
    protected $primaryKey = 'id';

    protected $casts = [
        'claimed_user_ids' => 'array'
    ];
}
