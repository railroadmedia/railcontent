<?php

namespace Modules\UserManagementSystem\Models;

use App\Models\Traits\CanSaveWithoutUpdatedAt;
use App\Modules\Content\Models\Content;
use App\Modules\CustomerIO\Models\Customer;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Models\Address;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\Traits\HasShopifyMetafields;
use App\Modules\Mentor\Models\MentorStudent;
use App\Modules\Notifications\Models\NotificationSetting;
use App\Modules\Notifications\Models\NotificationSettings;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Exception;
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
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Modules\UserManagementSystem\Factories\UserFactory;
use Modules\UserManagementSystem\Notifications\ResetPassword;
use Spatie\Permission\Traits\HasRoles;

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
 * @property bool $is_coach
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
 * @property boolean|false $drumeo_onboarding_skip_setup
 * @property boolean|false $pianote_onboarding_skip_setup
 * @property boolean|false $guitareo_onboarding_skip_setup
 * @property boolean|false $singeo_onboarding_skip_setup
 * @property int|null $singing_since_year
 * @property int|null $singing_gear_mic_brands
 * @property int|null $singing_gear_photo
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
 * @property string|null $revenuecat_origin_app_user_id
 * @property string|null $biography
 * @property string|null $support_note
 * @property int|null $shopify_id
 * @property bool|false $has_recharge_subscription
 * @property bool|false $has_apple_subscription
 * @property bool|false $has_google_subscription
 * @property int $cio_synced_workspaces
 * @property bool|false $requires_password_update
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
 * @method static Builder|User whereSingingSinceYear($value)
 * @method static Builder|User whereSingingGearMicBrands($value)
 * @method static Builder|User whereSingingGearPhoto($value)
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
 * @property string|null $membership_expiration_date
 * @property int $is_lifetime_member
 * @property int $is_drumeo_lifetime_member
 * @method static Builder|User whereIsLifetimeMember($value)
 * @method static Builder|User whereMembershipExpirationDate($value)
 * @property int $is_pack_owner
 * @property int $send_mobile_app_push_notifications
 * @property int $send_email_notifications
 * @method static Builder|User whereSendEmailNotifications($value)
 * @method static Builder|User whereSendMobileAppPushNotifications($value)
 * @property-read Collection|\Modules\UserManagementSystem\Models\OnboardingExperience[] $onboardingExperience
 * @property-read int|null $onboarding_experience_count
 * @property-read Collection|\Modules\UserManagementSystem\Models\OnboardingGoals[] $onboardingGoals
 * @property-read int|null $onboarding_goals_count
 * @property-read Collection|\Modules\UserManagementSystem\Models\OnboardingGear[] $onboardingGear
 * @property-read int|null $onboarding_gear_count
 * @property-read Collection|\Modules\UserManagementSystem\Models\OnboardingGenre[] $onboardingGenres
 * @property-read int|null $onboarding_genres_count
 * @property-read Collection|\Modules\UserManagementSystem\Models\OnboardingTopic[] $onboardingTopics
 * @property-read int|null $onboarding_topics_count
 * @method static Builder|User whereDrumeoOnboardingSkipSetup($value)
 * @method static Builder|User whereGuitareoOnboardingSkipSetup($value)
 * @method static Builder|User whereIsPackOwner($value)
 * @method static Builder|User wherePianoteOnboardingSkipSetup($value)
 * @method static Builder|User whereSingeoOnboardingSkipSetup($value)
 * @property ?MentorStudent $mentorStudent
 * @property mixed|null $brand_total_xp
 * @property Collection $subscriptions
 * @property mixed|null $brand_minutes_practiced
 * @property Collection $notificationSettings
 * @property string|null $membership_level // can be 'basic' or 'plus'
 * @property-read int|null $notification_settings_count
 * @property-read int|null $subscriptions_count
 * @method static Builder|User whereBrandMinutesPracticed($value)
 * @method static Builder|User whereBrandTotalXp($value)
 * @method static Builder|User whereMembershipLevel($value)
 */
class User extends Model implements Authenticatable, CanResetPassword, AuthorizableContract
{
    use HasFactory;
    use HasApiTokens;
    use HasShopifyMetafields;
    use HasRoles;
    use Authorizable;
    use CanSaveWithoutUpdatedAt;


    const FLAG_CUSTOMERIO_SYNCED_WORKSPACES_DRUMEO = 1;
    const FLAG_CUSTOMERIO_SYNCED_WORKSPACES_PIANOTE = 2;
    const FLAG_CUSTOMERIO_SYNCED_WORKSPACES_GUITAREO = 4;
    const FLAG_CUSTOMERIO_SYNCED_WORKSPACES_SINGEO = 8;

    private ?NotificationSettings $notificationSettingsLookup = null;

    protected $hidden = ['password', 'session_salt'];
    protected $table = 'usora_users';
    protected $guard_name = 'user-management-system';
    protected $casts = [
        'brand_method_levels' => 'json',
        'brand_total_xp' => 'json',
        'brand_minutes_practiced' => 'json'
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
    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'birthday',
        'biography',
        'profile_picture_url',
        'display_name',
        'drums_gear_stick_brands',
        'drums_gear_hardware_brands',
        'drums_gear_cymbal_brands',
        'drums_gear_set_brands',
        'drums_gear_photo',
        'drums_playing_since_year',
        'piano_gear_keyboard_brands',
        'piano_gear_piano_brands',
        'piano_gear_photo',
        'piano_playing_since_year',
        'guitar_gear_string_brands',
        'guitar_gear_pedal_brands',
        'guitar_gear_amp_brands',
        'guitar_gear_guitar_brands',
        'guitar_gear_photo',
        'guitar_playing_since_year',
        'singing_since_year',
        'singing_gear_mic_brands',
        'singing_gear_photo',
        'drumeo_onboarding_skip_setup',
        'pianote_onboarding_skip_setup',
        'guitareo_onboarding_skip_setup',
        'singeo_onboarding_skip_setup',
        'use_legacy_video_player',
    ];


    /**
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->connection = config('user_management_system.database_connection_name');

        parent::__construct($attributes);
    }

    public function mentorStudent(): HasOne
    {
        return $this->hasOne(MentorStudent::class, 'user_id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    public function notificationSettings(): HasMany
    {
        return $this->hasMany(NotificationSetting::class, 'user_id');
    }

    public function customerIO(): HasMany
    {
        return $this->hasMany(Customer::class, 'user_id');
    }


    public function getNotificationSetting(string $brand, string $settingName): bool
    {
        if (!$this->notificationSettingsLookup) {
            $this->notificationSettingsLookup = new NotificationSettings($this->notificationSettings);
        }
        return $this->notificationSettingsLookup->getSetting($brand, $settingName);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getMethodLevel()
    {
        $brand = brand();

        if (isset($this->brand_method_levels[$brand])) {
            return $this->brand_method_levels[$brand];
        }

        return '1.1';
    }

    /**
     * @return integer
     */
    public function getBrandTotalXp()
    {
        $brand = brand();

        if (isset($this->brand_total_xp[$brand])) {
            return $this->brand_total_xp[$brand];
        }

        return 0;
    }

    /**
     * @return integer
     */
    public function getBrandMinutesPracticed()
    {
        $brand = brand();

        if (isset($this->brand_minutes_practiced[$brand])) {
            return $this->brand_minutes_practiced[$brand];
        }

        return 0;
    }

    /**
     * @return Attribute
     */
    public function profilePictureUrl($usingCDN = true): Attribute
    {
        return Attribute::make(
            get: function ($value) use ($usingCDN) {
                $imageUrl = 'https://s3.amazonaws.com/pianote/defaults/avatar.png';

                if (!empty($value)) {
                    $imageUrl = $value;
                }

                if ($usingCDN) {
                    $imageUrl = cf_img($imageUrl, ["quality" => 75, "width" => 250, "height" => 250]);
                }

                return $imageUrl;
            },
        );
    }

    /**
     * Values: pack, member, lifetime, coach, house-coach, team
     *
     * @return Attribute
     */
    public function accessLevel(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($this->is_coach) {
                    return "coach";
                }

                if (!empty($value)) {
                    return $value;
                }

                return 'pack';
            },
        );
    }

    /**
     * @return Attribute
     */
    public function timezone(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!empty($value)) {
                    try {
                        // check to make sure its a valid timezone, otherwise reset it
                        Carbon::parse('2022', 'UTC')
                            ->timezone($value)
                            ->toDateTimeString();

                        return $value;
                    } catch (Exception $e) {
                        $this->timezone = null;
                        $this->save();
                    }
                }

                return 'America/Los_Angeles';
            },
        );
    }

    /**
     * @return string
     */
    public function getDashboardUrl()
    {
        return url()->route('platform.profile.dashboard', [$this->id, 'brand' => $this->last_used_brand]);
    }

    /**
     * @return int
     */
    public function totalXp(): int
    {
        return !empty($this->total_xp) ? $this->total_xp : 0;
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
                return 'Legends: Starr';
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
     * @return string
     */
    public function getBrandXpRank()
    {
        $brandXp = $this->getBrandTotalXp();
        switch ($brandXp) {
            case $brandXp < 250:
                return 'Casual';
            case $brandXp >= 250 && $this->total_xp < 1000:
                return 'Enthusiast I';
            case $brandXp >= 1000 && $this->total_xp < 2500:
                return 'Enthusiast II';
            case $brandXp >= 2500 && $this->total_xp < 5000:
                return 'Pro I';
            case $brandXp >= 5000 && $this->total_xp < 10000:
                return 'Pro II';
            case $brandXp >= 10000 && $this->total_xp < 20000:
                return 'Pro III';
            case $brandXp >= 20000 && $this->total_xp < 50000:
                return 'Master I';
            case $brandXp >= 50000 && $this->total_xp < 100000:
                return 'Master II';
            case $brandXp >= 100000 && $this->total_xp < 250000:
                return 'Master III';
            case $brandXp >= 250000 && $this->total_xp < 500000:
                return 'Drumeo Legend';
            case $brandXp >= 500000 && $this->total_xp < 1000000:
                return 'Legends: Starr';
            case $brandXp >= 1000000 && $this->total_xp < 1500000:
                return 'Legends: Erskine';
            case $brandXp >= 1500000 && $this->total_xp < 2000000:
                return 'Legends: Cobham';
            case $brandXp >= 2000000 && $this->total_xp < 2500000:
                return 'Legends: Garibaldi';
            case $brandXp >= 2500000 && $this->total_xp < 3000000:
                return 'Legends: Peart';
            case $brandXp >= 3000000 && $this->total_xp < 4000000:
                return 'Legends: Bonham';
            case $brandXp >= 4000000 && $this->total_xp < 5000000:
                return 'Legends: Colaiuta';
            case $brandXp >= 5000000 && $this->total_xp < 7500000:
                return 'Legends: Gadd';
            case $brandXp >= 75000000 && $this->total_xp < 10000000:
                return 'Legends: Porcaro';
            case $brandXp >= 10000000:
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
    public function isAMember()
    {
        return $this->isALifetimeMember() ||
            (!empty($this->membership_expiration_date) && $this->membership_expiration_date > Carbon::now());
    }

    /**
     * @return bool
     */
    public function isALifetimeMember($brand = null)
    {
        // todo: may need to account for brand here in the future

        return $this->is_lifetime_member ?? false;
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
        return $this->hasMany(PasswordReset::class, 'email', 'email');
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
        $class = ResetPassword::class;

        (new AnonymousNotifiable())->route(
            'mail',
            $this->getEmailForPasswordReset()
        )
            ->notify(new $class($token));
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
        $this->password = $hash ? $this->getHashedPassword($password) : $password;
    }

    private function getHashedPassword($password)
    {
        return Hash::make($password);
    }

    public function onboardingGear()
    {
        return $this->hasMany(OnboardingGear::class);
    }

    public function onboardingTopics()
    {
        return $this->hasMany(OnboardingTopic::class);
    }

    public function onboardingGenres()
    {
        return $this->hasMany(OnboardingGenre::class);
    }

    public function onboardingExperience()
    {
        return $this->hasMany(OnboardingExperience::class);
    }

    public function onboardingGoals()
    {
        return $this->hasMany(OnboardingGoals::class);
    }

    /**
     * @return bool
     */
    public function isPackOwner()
    {
        return $this->is_pack_owner;
    }

    /**
     * @return bool
     */
    public function isPackOnlyOwner()
    {
        return $this->isPackOwner() && !$this->isAMember();
    }

    /**
     * @return bool
     */
    public function isAnExpiredMember()
    {
        return
            !empty($this->membership_expiration_date) && $this->membership_expiration_date < Carbon::now();
    }

    public function isABasicMember()
    {
        return $this->isAMember() && $this->membership_level == 'basic';
    }

    public function isAPlusMember()
    {
        return ($this->isAMember() && $this->membership_level == 'plus') || $this->isAdmin();
    }

    public function getTotalXp()
    {
        return $this->total_xp ?? 0;
    }

    public function isActiveStudent(): bool
    {
        return !$this->isAdmin()
            && !empty($this->membership_expiration_date)
            && $this->membership_expiration_date >= Carbon::now()->addDays(
                -config('mentor.active_after_membership_expired_days')
            );
    }

    /**
     * @return bool
     */
    public function isNotLifetimeOrAnnualMember()
    {
        $annualSubscription = false;
        foreach ($this->subscriptions as $subscription) {
            $annualSubscription = in_array($subscription->product->sku, config('ecommerce.annual_product_skus'));
            if ($annualSubscription) {
                break;
            }
        }
        return (!$annualSubscription && !$this->is_lifetime_member && $this->isAMember());
    }


    public function hasSongsAccess(?string $brand = null): bool
    {
        if (!$brand) {
            $brand = brand();
        }
        return $this->isAPlusMember() ||
            ($brand == 'drumeo' && $this->is_drumeo_lifetime_member);
    }

    public function getMembershipExpirationDate(): ?Carbon
    {
        if ($this->membership_expiration_date == null) {
            return null;
        }
        return Carbon::parse($this->membership_expiration_date);
    }

    public function isDeleted(): bool
    {
        return preg_match("/musora\+deleted_[\d]+@musora\.com/", $this->email);
    }

    public function getCustomerIOId()
    {
        foreach ($this->customerIO as $customerIOData) {
            if ($customerIOData->workspace_name == 'musora') {
                return $customerIOData->uuid;
            }
        }
        return null;
    }

    public function shippingAddresses(): HasMany
    {
        return $this->hasMany(
            Address::class,
            "user_id"
        )->where("type", Address::SHIPPING_TYPE);
    }

    public function billingAddresses(): HasMany
    {
        return $this->hasMany(Address::class, "user_id")
            ->where("type", Address::BILLING_TYPE);
    }

    public function hasMobileMembership(): bool
    {
        return $this->has_apple_subscription || $this->has_google_subscription;
    }

    /**
     * @inheritDoc
     */
    public function getMetafieldsForShopify(): array
    {
        return [
            MetaField::getStructureForShopify(
                new MetaField(
                    ShopifyMetafieldKey::Id,
                    (string)$this->id,
                    ShopifyMetafieldTypes::integer,
                    ShopifyMetafieldNamespace::Model_Users
                )
            ),
            MetaField::getStructureForShopify(
                new MetaField(
                    ShopifyMetafieldKey::IsMusoraAccountSetUp,
                    "true",
                    ShopifyMetafieldTypes::boolean,
                    ShopifyMetafieldNamespace::Musora
                )
            )
        ];
    }

    public function setCustomerIOSyncedWorkspaces(array $workspaces): void
    {
        $this->setCustomerIOSyncedWorkspaceFlag(
            self::FLAG_CUSTOMERIO_SYNCED_WORKSPACES_DRUMEO,
            in_array('drumeo', $workspaces)
        );
        $this->setCustomerIOSyncedWorkspaceFlag(
            self::FLAG_CUSTOMERIO_SYNCED_WORKSPACES_PIANOTE,
            in_array('pianote', $workspaces)
        );
        $this->setCustomerIOSyncedWorkspaceFlag(
            self::FLAG_CUSTOMERIO_SYNCED_WORKSPACES_GUITAREO,
            in_array('guitareo', $workspaces)
        );
        $this->setCustomerIOSyncedWorkspaceFlag(
            self::FLAG_CUSTOMERIO_SYNCED_WORKSPACES_SINGEO,
            in_array('singeo', $workspaces)
        );
    }

    public function shouldSyncCustomerIoWorkspace(string $brand): bool
    {
        switch ($brand) {
            case 'drumeo':
                return $this->hasCustomerIOSyncedWorkspaceFlag(self::FLAG_CUSTOMERIO_SYNCED_WORKSPACES_DRUMEO);
            case 'pianote':
                return $this->hasCustomerIOSyncedWorkspaceFlag(self::FLAG_CUSTOMERIO_SYNCED_WORKSPACES_PIANOTE);
            case 'guitareo':
                return $this->hasCustomerIOSyncedWorkspaceFlag(self::FLAG_CUSTOMERIO_SYNCED_WORKSPACES_GUITAREO);
            case 'singeo':
                return $this->hasCustomerIOSyncedWorkspaceFlag(self::FLAG_CUSTOMERIO_SYNCED_WORKSPACES_SINGEO);
            case 'musora':
                return true;
            default:
                throw new Exception("shouldSyncCustomerIoWorkspace not implemented for brand: {$brand}");
        }
    }

    private function setCustomerIOSyncedWorkspaceFlag(int $flag, bool $set): void
    {
        if ($set) {
            $this->cio_synced_workspaces |= $flag;
        } else {
            $this->cio_synced_workspaces &= ~$flag;
        }
    }

    private function hasCustomerIOSyncedWorkspaceFlag(int $flag): bool
    {
        return ($this->cio_synced_workspaces & $flag) === $flag;
    }

    public function doesRequirePasswordUpdate(): bool
    {
        return $this->requires_password_update;
    }

    public function isAccountSetup(): bool
    {
        return !$this->requires_password_update;
    }

    public function associatedContent(): HasMany
    {
        return $this->hasMany(Content::class, 'associated_user_id');
    }

    /**
     * @return Attribute
     */
    public function isCoach(): Attribute
    {
        return Attribute::make(
            get: function () {
                return boolval(
                    $this->associatedContent()
                        ->where("is_coach", true)
                        ->where("status", "published")
                        ->count()
                );
            },
        );
    }
}
