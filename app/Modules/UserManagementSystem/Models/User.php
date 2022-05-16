<?php

namespace Modules\UserManagementSystem\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Modules\UserManagementSystem\Factories\UserFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

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
 * @property-read Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Modules\UserManagementSystem\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User permission($permissions)
 * @method static Builder|User role($roles, $guard = null)
 * @property string|null $last_used_brand
 * @method static Builder|User whereLastUsedBrand($value)
 * @property string|null $access_level
 * @property int|null $total_xp
 * @property mixed|null $brand_method_levels
 * @method static Builder|User whereAccessLevel($value)
 * @method static Builder|User whereBrandMethodLevels($value)
 * @method static Builder|User whereTotalXp($value)
 */
class User extends Model implements Authenticatable, CanResetPassword, AuthorizableContract
{
    use HasFactory;
    use HasApiTokens;
    use HasRoles;
    use Authorizable;

    protected $hidden = ['password', 'session_salt'];
    protected $table = 'usora_users';
    protected $guard_name = 'user-management-system';
    protected $casts = [
        'brand_method_levels' => 'json',
    ];

    /**
     * @var string
     */
    protected $currentRememberToken;

    /**
     * @var string
     */
    protected $sessionSalt;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'first_name', 'last_name', 'location', 'birthday', 'biography', 'profile_picture_url', 'display_name'];

    /**
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->connection = config('user_management_system.database_connection_name');

        parent::__construct($attributes);
    }

    /**
     * @return string
     */
    public function getMethodLevel()
    {
        $brand = brand();

        if (isset($this->brand_method_levels->$brand)) {
            return $this->brand_method_levels->$brand;
        }

        return '1.0';
    }

    /**
     * @return Attribute
     */
    public function profilePictureUrl($usingCDN = true)
    {
        return Attribute::make(
            get: function ($value) use ($usingCDN) {
                $imageUrl = 'https://s3.amazonaws.com/pianote/defaults/avatar.png';

                if (!empty($this->profile_picture_url)) {
                    $imageUrl = $this->profile_picture_url;
                }

                if ($usingCDN) {
                    $imageUrl = cf_img($imageUrl, ["quality" => 75, "width" => 50, "height" => 50]);
                }

                return $imageUrl;
            },
        );
    }

    /**
     * @return string
     */
    public function getDashboardUrl()
    {
        return url()->route('platform.profile.dashboard', [$this->id]);
    }

    /**
     * @return Attribute
     */
    public function totalXp(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return !empty($this->total_xp) ? $this->total_xp : 0;
            },
        );
    }

    /**
     * @return string
     */
    public function getXpRank()
    {
        switch ($this->total_xp) {
            case $this->total_xp < 250:
                return 'Casual';
            case $this->total_xp >= 250 && $this->total_xp < 1000:
                return 'Enthusiast I';
            case $this->total_xp >= 1000 && $this->total_xp < 2500:
                return 'Enthusiast II';
            case $this->total_xp >= 2500 && $this->total_xp < 5000:
                return 'Pro I';
            case $this->total_xp >= 5000 && $this->total_xp < 10000:
                return 'Pro II';
            case $this->total_xp >= 10000 && $this->total_xp < 20000:
                return 'Pro III';
            case $this->total_xp >= 20000 && $this->total_xp < 50000:
                return 'Master I';
            case $this->total_xp >= 50000 && $this->total_xp < 100000:
                return 'Master II';
            case $this->total_xp >= 100000 && $this->total_xp < 250000:
                return 'Master III';
            case $this->total_xp >= 250000 && $this->total_xp < 500000:
                return 'Drumeo Legend';
            case $this->total_xp >= 500000 && $this->total_xp < 1000000:
                return 'Legends: Star';
            case $this->total_xp >= 1000000 && $this->total_xp < 1500000:
                return 'Legends: Erskine';
            case $this->total_xp >= 1500000 && $this->total_xp < 2000000:
                return 'Legends: Cobham';
            case $this->total_xp >= 2000000 && $this->total_xp < 2500000:
                return 'Legends: Garibaldi';
            case $this->total_xp >= 2500000 && $this->total_xp < 3000000:
                return 'Legends: Peart';
            case $this->total_xp >= 3000000 && $this->total_xp < 4000000:
                return 'Legends: Bonham';
            case $this->total_xp >= 4000000 && $this->total_xp < 5000000:
                return 'Legends: Colaiuta';
            case $this->total_xp >= 5000000 && $this->total_xp < 7500000:
                return 'Legends: Gadd';
            case $this->total_xp >= 75000000 && $this->total_xp < 10000000:
                return 'Legends: Porcaro';
            case $this->total_xp >= 10000000:
                return 'Legends: Rich';
            default:
                return 'Member';
        }
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->permission_level == 'administrator';
    }

    /**
     * @return bool
     */
    public function isSubscriber()
    {
        return true; // todo: connect
    }

    /**
     * @return Collection|RememberToken[]|HasMany
     */
    public function rememberTokens()
    {
        return $this->hasMany(RememberToken::class, 'user_id');
    }

    /**
     * @return Collection|FirebaseToken[]|HasMany
     */
    public function firebaseTokens()
    {
        return $this->hasMany(FirebaseToken::class, 'user_id');
    }

    /**
     * @return Collection|EmailChange[]|HasMany
     */
    public function emailChanges()
    {
        return $this->hasMany(EmailChange::class, 'user_id');
    }

    /**
     * @return Collection|PasswordReset[]|HasMany
     */
    public function passwordResets()
    {
        return $this->hasMany(PasswordReset::class, 'user_id');
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * @return string
     */
    public function getRememberToken()
    {
        return $this->currentRememberToken;
    }

    /**
     * @param string $value
     */
    public function setRememberToken($value)
    {
        $this->currentRememberToken = $value;
    }

    /**
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        //todo: to be configured
//        $class = config('usora.password_reset_notification_class');
//
//        (new AnonymousNotifiable())->route(
//            config('usora.password_reset_notification_channel'),
//            $this->getEmailForPasswordReset()
//        )
//            ->notify(new $class($token));
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getSessionSalt()
    {
        return $this->sessionSalt;
    }

    /**
     * @param string $sessionSalt
     */
    public function setSessionSalt($sessionSalt)
    {
        $this->sessionSalt = $sessionSalt;
    }

    /**
     * @return Factory|UserFactory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * @param string $password
     * @param bool $hash
     */
    public function setPassword($password, $hash = true)
    {
        $this->password = $hash ? Hash::make($password) : $password;
    }
}
