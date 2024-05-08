<?php

namespace App\Modules\Notifications\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\UserManagementSystem\Models\User;

/**
 * App\Modules\Notifications\Models\NotificationSetting
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $setting_name
 * @property integer $setting_value
 * @property string $brand
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereSettingName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereSettingValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUserId($value)
 * @mixin \Eloquent
 */
class NotificationSetting extends Model
{
    protected $table = 'notification_settings';

    public const NOTIFICATION_SETTINGS_NAME_NOTIFICATION_TYPE = [
        Notification::TYPE_LESSON_COMMENT_REPLY => 'notify_on_lesson_comment_reply',
        Notification::TYPE_LESSON_COMMENT_LIKED => 'notify_on_lesson_comment_like',
        Notification::TYPE_FORUM_POST_REPLY => 'notify_on_post_in_followed_forum_thread',
        Notification::TYPE_FORUM_POST_LIKED => 'notify_on_forum_post_like',
        Notification::TYPE_FORUM_POST_IN_FOLLOWED_THREAD => 'notify_on_forum_followed_thread_reply',
        Notification::TYPE_NEW_CONTENT_RELEASES => 'notify_on_new_content_releases',
    ];

    public const SEND_EMAIL_NOTIF = 'send_email';
    public const SEND_PUSH_NOTIF = 'send_in_app_push_notification';
    public const SEND_WEEKLY = 'notify_weekly_update';
    public const NOTIFICATIONS_FREQUENCY = 'notifications_summary_frequency_minutes';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
