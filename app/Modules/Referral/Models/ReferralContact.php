<?php
namespace App\Modules\Referral\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class ReferralContact
 * 
 * @property string $email
 * @property Carbon $membership_expiration_date
 */
class ReferralContact extends Model
{
    protected $table = 'usora_users';
    
    protected $dates = [
        'membership_expiration_date'
    ];
    
    protected $fillable = [
        'email',
        'membership_expiration_date'
    ];
}