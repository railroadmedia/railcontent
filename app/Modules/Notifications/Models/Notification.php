<?php

namespace App\Modules\Notifications\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\UserManagementSystem\Models\User;

/**
 * @property integer $id
 * @property string $type
 * @property string $data
 * @property integer $subject_id
 * @property integer $recipient_id
 * @property string $author_avatar
 * @property string $content_url
 * @property string $content_mobile_app_url
 * @property string $comment
 * @property integer $author_id
 * @property Carbon $read_on
 * @property string $brand
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Notification extends Model
{
    protected $table = 'notifications';

    public function user()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

}
