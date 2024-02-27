<?php

namespace Modules\UserManagementSystem\Factories;

use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Modules\UserManagementSystem\Models\User;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'password' => Hash::make($this->faker->words(3, true)),
            'session_salt' => $this->faker->text,
            'display_name' => $this->faker->userName . rand(),
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'country' => $this->faker->country,
            'region' => $this->faker->randomElement(['British Columbia', 'Alberta', 'Washington', 'California']),
            'city' => $this->faker->city,
            'birthday' => $this->faker->date,
            'phone_number' => $this->faker->numberBetween(1000000, 19999999999),
            'profile_picture_url' => $this->faker->imageUrl,
            'timezone' => $this->faker->timezone,
            'last_used_brand' => $this->faker->randomElement(['drumeo', 'pianote', 'singeo', 'guitareo']),
            'access_level' => $this->faker->randomElement([null, 'lifetime', 'edge', 'team']),
            'total_xp' => $this->faker->randomElement([null, rand(0, 1000000)]),
            'brand_method_levels' => json_encode(['drumeo' => '2.3', 'pianote' => '1.9']),
            'permission_level' => null,
            'legacy_drumeo_id' => null,
            'legacy_pianote_id' => null,
            'legacy_guitareo_id' => null,
            'legacy_drumeo_wordpress_id' => null,
            'legacy_drumeo_ipb_id' => null,
            'piano_gear_keyboard_brands' => $this->faker->words(3, true),
            'piano_gear_piano_brands' => $this->faker->words(3, true),
            'piano_gear_photo' => $this->faker->imageUrl,
            'piano_playing_since_year' => rand(1950, 2020),
            'guitar_gear_string_brands' => $this->faker->words(3, true),
            'guitar_gear_pedal_brands' => $this->faker->words(3, true),
            'guitar_gear_amp_brands' => $this->faker->words(3, true),
            'guitar_gear_guitar_brands' => $this->faker->words(3, true),
            'guitar_gear_photo' => $this->faker->imageUrl,
            'guitar_playing_since_year' => rand(1950, 2020),
            'drums_gear_stick_brands' => $this->faker->words(3, true),
            'drums_gear_hardware_brands' => $this->faker->words(3, true),
            'drums_gear_set_brands' => $this->faker->words(3, true),
            'drums_gear_cymbal_brands' => $this->faker->words(3, true),
            'drums_gear_photo' => $this->faker->imageUrl,
            'drums_playing_since_year' => rand(1950, 2020),
            'notify_on_lesson_comment_like' => 1,
            'notifications_summary_frequency_minutes' => 5000,
            'notify_on_forum_post_reply' => 1,
            'notify_on_forum_followed_thread_reply' => 1,
            'notify_on_forum_post_like' => 1,
            'notify_weekly_update' => 1,
            'notify_on_lesson_comment_reply' => 1,
            'use_legacy_video_player' => 0,
            'drums_skill_level' => $this->faker->randomElement([100, 150, 200, null]),
            'guitar_skill_level' => $this->faker->randomElement([100, 150, 200, null]),
            'piano_skill_level' => $this->faker->randomElement([100, 150, 200, null]),
            'drumeo_ship_magazine' => null,
            'magazine_shipping_address_id' => null,
            'ios_latest_review_display_date' => null,
            'ios_count_review_display' => 0,
            'google_latest_review_display_date' => null,
            'google_count_review_display' => 0,
            'biography' => $this->faker->sentences(3, true),
            'support_note' => $this->faker->sentences(3, true),
            'created_at' => $this->faker->dateTime,
            'membership_expiration_date' => null,
            'is_lifetime_member' => rand(0, 1),
            'singing_since_year' => strval(rand(1950, 2022)),
            'singing_gear_mic_brands' => $this->faker->words(3, true),
            'singing_gear_photo' => $this->faker->imageUrl,
            'is_pack_owner' => rand(0, 1),
            'singeo_onboarding_skip_setup' => 0,
            'guitareo_onboarding_skip_setup' => 0,
            'pianote_onboarding_skip_setup' => 0,
            'drumeo_onboarding_skip_setup' => 0,
            'brand_total_xp' => null,
            'brand_minutes_practiced' => null,
            'membership_level' => null,
            'is_drumeo_lifetime_member' => 0,
            'needs_logout' => false,
        ];
    }

    public function hasActiveMembership(int $days = 60): UserFactory
    {
        return $this->state(function (array $attributes) use ($days) {
            return [
                'membership_expiration_date' => Carbon::now()->addDays($days)
            ];
        });
    }

    public function hasSubscription(array $array = []): UserFactory
    {
        return $this->afterCreating(function (User $user) use ($array) {
            $array['user_id'] = $user->id;
            Subscription::factory()->create($array);
        });
    }

    public function hasUserProduct(array $array = []): UserFactory
    {
        return $this->afterCreating(function (User $user) use ($array) {
            $array['user_id'] = $user->id;
            UserProduct::factory()->create($array);
        });
    }
}
