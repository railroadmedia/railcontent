<?php

namespace App\Modules\Notifications\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\UserManagementSystem\Models\User;

/**
 * App\Modules\Notifications\Models\Notification
 *
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
 * @property-read User $user
 * @property string|null $author_display_name
 * @property string|null $content_title
 * @property string|null $created_on
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereAuthorAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereAuthorDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereContentMobileAppUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereContentTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereContentUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereRecipientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Notification extends Model
{
    protected $table = 'notifications';

    const TYPE_FORUM_POST_IN_FOLLOWED_THREAD = 'forum post in followed thread';
    const TYPE_FORUM_POST_REPLY = 'forum post reply';
    const TYPE_FORUM_POST_LIKED = 'forum post liked';
    const TYPE_LESSON_COMMENT_LIKED = 'lesson comment liked';
    const TYPE_LESSON_COMMENT_REPLY = 'lesson comment reply';
    const TYPE_NEW_CONTENT_RELEASES = 'new content releases';

    public function user()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function isNotificationSettingEnabled(): bool
    {
        return $this->user->getNotificationSetting(
            $this->brand,
            NotificationSetting::NOTIFICATION_SETTINGS_NAME_NOTIFICATION_TYPE[$this->type]
        );
    }

    public function getNotificationSetting(string $settingName): bool
    {
        return $this->user->getNotificationSetting($this->brand, $settingName);
    }
}
