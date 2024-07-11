<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexesFound = $sm->listTableIndexes('usora_users');

            $toRemove = [
                'usora_users_access_level_index',
                'usora_users_birthday_index',
                'usora_users_city_index',
                'usora_users_country_index',
                'usora_users_drumeo_ship_magazine_index',
                'usora_users_drums_gear_cymbal_brands_index',
                'usora_users_drums_gear_hardware_brands_index',
                'usora_users_drums_gear_photo_index',
                'usora_users_drums_gear_set_brands_index',
                'usora_users_drums_gear_stick_brands_index',
                'usora_users_drums_playing_since_year_index',
                'usora_users_email_index',
                'usora_users_first_name_index',
                'usora_users_guitar_gear_amp_brands_index',
                'usora_users_guitar_gear_guitar_brands_index',
                'usora_users_guitar_gear_pedal_brands_index',
                'usora_users_guitar_gear_photo_index',
                'usora_users_guitar_gear_string_brands_index',
                'usora_users_guitar_playing_since_year_index',
                'usora_users_is_drumeo_lifetime_member_index',
                'usora_users_is_pack_owner_index',
                'usora_users_last_name_index',
                'usora_users_legacy_drumeo_id_index',
                'usora_users_legacy_drumeo_ipb_id_index',
                'usora_users_legacy_drumeo_wordpress_id_index',
                'usora_users_legacy_guitareo_id_index',
                'usora_users_legacy_pianote_id_index',
                'usora_users_magazine_shipping_address_id_index',
                'usora_users_notifications_summary_frequency_minutes_index',
                'usora_users_notify_on_forum_followed_thread_reply_index',
                'usora_users_notify_on_forum_post_like_index',
                'usora_users_notify_on_forum_post_reply_index',
                'usora_users_notify_on_lesson_comment_like_index',
                'usora_users_notify_weekly_update_index',
                'usora_users_permission_level_index',
                'usora_users_phone_number_index',
                'usora_users_piano_gear_keyboard_brands_index',
                'usora_users_piano_gear_photo_index',
                'usora_users_piano_gear_piano_brands_index',
                'usora_users_piano_playing_since_year_index',
                'usora_users_region_index',
                'usora_users_send_email_notifications_index',
                'usora_users_send_mobile_app_push_notifications_index',
                'usora_users_singing_gear_mic_brands_index',
                'usora_users_singing_gear_photo_index',
                'usora_users_singing_since_year_index',
                'usora_users_timezone_index',
                'usora_users_total_xp_index',
                'usora_users_updated_at_index',
            ];
            foreach ($toRemove as $index) {
                if (array_key_exists($index, $indexesFound)) {
                    $table->dropIndex($index);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
