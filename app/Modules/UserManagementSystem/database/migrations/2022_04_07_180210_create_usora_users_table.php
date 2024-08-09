<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('usora_users')) {
            return;
        }

        Schema::create('usora_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->index();
            $table->string('password');
            $table->string('session_salt')->nullable();
            $table->string('display_name')->index();
            $table->string('first_name')->nullable()->index();
            $table->string('last_name')->nullable()->index();
            $table->string('gender')->nullable()->index();
            $table->string('country')->nullable()->index();
            $table->string('region')->nullable()->index();
            $table->string('city')->nullable()->index();
            $table->date('birthday')->nullable()->index();
            $table->bigInteger('phone_number')->nullable()->index();
            $table->text('profile_picture_url')->nullable();
            $table->string('timezone')->nullable()->index();
            $table->string('permission_level')->nullable()->index();
            $table->integer('legacy_drumeo_id')->nullable()->index();
            $table->integer('legacy_pianote_id')->nullable()->index();
            $table->integer('legacy_guitareo_id')->nullable()->index();
            $table->integer('legacy_drumeo_wordpress_id')->nullable()->index();
            $table->integer('legacy_drumeo_ipb_id')->nullable()->index();
            $table->string('piano_gear_keyboard_brands')->nullable()->index();
            $table->string('piano_gear_piano_brands')->nullable()->index();
            $table->string('piano_gear_photo')->nullable()->index();
            $table->integer('piano_playing_since_year')->nullable()->index();
            $table->string('guitar_gear_string_brands')->nullable()->index();
            $table->string('guitar_gear_pedal_brands')->nullable()->index();
            $table->string('guitar_gear_amp_brands')->nullable()->index();
            $table->string('guitar_gear_guitar_brands')->nullable()->index();
            $table->string('guitar_gear_photo')->nullable()->index();
            $table->integer('guitar_playing_since_year')->nullable()->index();
            $table->string('drums_gear_stick_brands')->nullable()->index();
            $table->string('drums_gear_hardware_brands')->nullable()->index();
            $table->string('drums_gear_set_brands')->nullable()->index();
            $table->string('drums_gear_cymbal_brands')->nullable()->index();
            $table->string('drums_gear_photo')->nullable()->index();
            $table->integer('drums_playing_since_year')->nullable()->index();
            $table->boolean('notify_on_lesson_comment_like')->default(true)->index();
            $table->integer('notifications_summary_frequency_minutes')->nullable()->index();
            $table->boolean('notify_on_forum_post_reply')->default(true)->index();
            $table->boolean('notify_on_forum_followed_thread_reply')->default(true)->index();
            $table->boolean('notify_on_forum_post_like')->default(true)->index();
            $table->boolean('notify_weekly_update')->default(true)->index();
            $table->boolean('notify_on_lesson_comment_reply')->default(true)->index();
            $table->boolean('use_legacy_video_player')->default(false);
            $table->integer('drums_skill_level')->nullable();
            $table->integer('guitar_skill_level')->nullable();
            $table->integer('piano_skill_level')->nullable();
            $table->boolean('drumeo_ship_magazine')->nullable()->index();
            $table->integer('magazine_shipping_address_id')->nullable()->index();
            $table->timestamp('ios_latest_review_display_date')->nullable();
            $table->integer('ios_count_review_display')->default(0);
            $table->timestamp('google_latest_review_display_date')->nullable();
            $table->integer('google_count_review_display')->default(0);
            $table->text('biography')->nullable();
            $table->text('support_note')->nullable();
            $table->timestamp('created_at')->nullable()->index();
            $table->timestamp('updated_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usora_users');
    }
};
