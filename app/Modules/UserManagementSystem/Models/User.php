<?php

namespace App\Modules\UserManagementSystem\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Modules\UserManagementSystem\Models\User
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string|null $session_salt
 * @property string $display_name
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $gender
 * @property string|null $country
 * @property string|null $region
 * @property string|null $city
 * @property string|null $birthday
 * @property int|null $phone_number
 * @property string|null $profile_picture_url
 * @property string|null $timezone
 * @property string|null $permission_level
 * @property int|null $legacy_drumeo_id
 * @property int|null $legacy_pianote_id
 * @property int|null $legacy_guitareo_id
 * @property int|null $legacy_drumeo_wordpress_id
 * @property int|null $legacy_drumeo_ipb_id
 * @property string|null $piano_gear_keyboard_brands
 * @property string|null $piano_gear_piano_brands
 * @property string|null $piano_gear_photo
 * @property int|null $piano_playing_since_year
 * @property string|null $guitar_gear_string_brands
 * @property string|null $guitar_gear_pedal_brands
 * @property string|null $guitar_gear_amp_brands
 * @property string|null $guitar_gear_guitar_brands
 * @property string|null $guitar_gear_photo
 * @property int|null $guitar_playing_since_year
 * @property string|null $drums_gear_stick_brands
 * @property string|null $drums_gear_hardware_brands
 * @property string|null $drums_gear_set_brands
 * @property string|null $drums_gear_cymbal_brands
 * @property string|null $drums_gear_photo
 * @property int|null $drums_playing_since_year
 * @property int $notify_on_lesson_comment_like
 * @property int|null $notifications_summary_frequency_minutes
 * @property int $notify_on_forum_post_reply
 * @property int $notify_on_forum_followed_thread_reply
 * @property int $notify_on_forum_post_like
 * @property int $notify_weekly_update
 * @property int $notify_on_lesson_comment_reply
 * @property int $use_legacy_video_player
 * @property int|null $drums_skill_level
 * @property int|null $guitar_skill_level
 * @property int|null $piano_skill_level
 * @property int|null $drumeo_ship_magazine
 * @property int|null $magazine_shipping_address_id
 * @property string|null $ios_latest_review_display_date
 * @property int $ios_count_review_display
 * @property string|null $google_latest_review_display_date
 * @property int $google_count_review_display
 * @property string|null $biography
 * @property string|null $support_note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereBiography($value)
 * @method static Builder|User whereBirthday($value)
 * @method static Builder|User whereCity($value)
 * @method static Builder|User whereCountry($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDisplayName($value)
 * @method static Builder|User whereDrumeoShipMagazine($value)
 * @method static Builder|User whereDrumsGearCymbalBrands($value)
 * @method static Builder|User whereDrumsGearHardwareBrands($value)
 * @method static Builder|User whereDrumsGearPhoto($value)
 * @method static Builder|User whereDrumsGearSetBrands($value)
 * @method static Builder|User whereDrumsGearStickBrands($value)
 * @method static Builder|User whereDrumsPlayingSinceYear($value)
 * @method static Builder|User whereDrumsSkillLevel($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereGender($value)
 * @method static Builder|User whereGoogleCountReviewDisplay($value)
 * @method static Builder|User whereGoogleLatestReviewDisplayDate($value)
 * @method static Builder|User whereGuitarGearAmpBrands($value)
 * @method static Builder|User whereGuitarGearGuitarBrands($value)
 * @method static Builder|User whereGuitarGearPedalBrands($value)
 * @method static Builder|User whereGuitarGearPhoto($value)
 * @method static Builder|User whereGuitarGearStringBrands($value)
 * @method static Builder|User whereGuitarPlayingSinceYear($value)
 * @method static Builder|User whereGuitarSkillLevel($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIosCountReviewDisplay($value)
 * @method static Builder|User whereIosLatestReviewDisplayDate($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User whereLegacyDrumeoId($value)
 * @method static Builder|User whereLegacyDrumeoIpbId($value)
 * @method static Builder|User whereLegacyDrumeoWordpressId($value)
 * @method static Builder|User whereLegacyGuitareoId($value)
 * @method static Builder|User whereLegacyPianoteId($value)
 * @method static Builder|User whereMagazineShippingAddressId($value)
 * @method static Builder|User whereNotificationsSummaryFrequencyMinutes($value)
 * @method static Builder|User whereNotifyOnForumFollowedThreadReply($value)
 * @method static Builder|User whereNotifyOnForumPostLike($value)
 * @method static Builder|User whereNotifyOnForumPostReply($value)
 * @method static Builder|User whereNotifyOnLessonCommentLike($value)
 * @method static Builder|User whereNotifyOnLessonCommentReply($value)
 * @method static Builder|User whereNotifyWeeklyUpdate($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePermissionLevel($value)
 * @method static Builder|User wherePhoneNumber($value)
 * @method static Builder|User wherePianoGearKeyboardBrands($value)
 * @method static Builder|User wherePianoGearPhoto($value)
 * @method static Builder|User wherePianoGearPianoBrands($value)
 * @method static Builder|User wherePianoPlayingSinceYear($value)
 * @method static Builder|User wherePianoSkillLevel($value)
 * @method static Builder|User whereProfilePictureUrl($value)
 * @method static Builder|User whereRegion($value)
 * @method static Builder|User whereSessionSalt($value)
 * @method static Builder|User whereSupportNote($value)
 * @method static Builder|User whereTimezone($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUseLegacyVideoPlayer($value)
 * @mixin Eloquent
 * @property-read Collection|EmailChange[] $emailChanges
 * @property-read int|null $email_changes_count
 * @property-read Collection|FirebaseToken[] $firebaseTokens
 * @property-read int|null $firebase_tokens_count
 * @property-read Collection|PasswordReset[] $passwordResets
 * @property-read int|null $password_resets_count
 * @property-read Collection|RememberToken[] $rememberTokens
 * @property-read int|null $remember_tokens_count
 */
class User extends Model
{
    protected $table = 'usora_users';

    use HasFactory;

    public function rememberTokens()
    {
        return $this->hasMany(RememberToken::class);
    }

    public function firebaseTokens()
    {
        return $this->hasMany(FirebaseToken::class);
    }

    public function emailChanges()
    {
        return $this->hasMany(EmailChange::class);
    }

    public function passwordResets()
    {
        return $this->hasMany(PasswordReset::class);
    }
}
