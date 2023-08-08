<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('railtracker4_requests')) {
            Schema::table('railtracker4_requests', function (Blueprint $table) {
                $table->dropForeign('railtracker4_requests_url_protocol_foreign');
                $table->dropForeign('railtracker4_requests_referer_url_protocol_foreign');
                $table->dropForeign('railtracker4_requests_url_domain_foreign');
                $table->dropForeign('railtracker4_requests_referer_url_domain_foreign');
                $table->dropForeign('railtracker4_requests_url_path_foreign');
                $table->dropForeign('railtracker4_requests_referer_url_path_foreign');
                $table->dropForeign('railtracker4_requests_method_foreign');
                $table->dropForeign('railtracker4_requests_route_name_foreign');
                $table->dropForeign('railtracker4_requests_device_kind_foreign');
                $table->dropForeign('railtracker4_requests_device_model_foreign');
                $table->dropForeign('railtracker4_requests_device_platform_foreign');
                $table->dropForeign('railtracker4_requests_device_version_foreign');
                $table->dropForeign('railtracker4_requests_agent_browser_foreign');
                $table->dropForeign('railtracker4_requests_agent_browser_version_foreign');
                $table->dropForeign('railtracker4_requests_language_preference_foreign');
                $table->dropForeign('railtracker4_requests_language_range_foreign');
                $table->dropForeign('railtracker4_requests_ip_address_foreign');
                $table->dropForeign('railtracker4_requests_ip_latitude_foreign');
                $table->dropForeign('railtracker4_requests_ip_longitude_foreign');
                $table->dropForeign('railtracker4_requests_ip_country_code_foreign');
                $table->dropForeign('railtracker4_requests_ip_country_name_foreign');
                $table->dropForeign('railtracker4_requests_ip_region_foreign');
                $table->dropForeign('railtracker4_requests_ip_city_foreign');
                $table->dropForeign('railtracker4_requests_ip_postal_zip_code_foreign');
                $table->dropForeign('railtracker4_requests_ip_timezone_foreign');
                $table->dropForeign('railtracker4_requests_ip_currency_foreign');
                $table->dropForeign('railtracker4_requests_response_status_code_foreign');
                $table->dropForeign('railtracker4_requests_response_duration_ms_foreign');
                $table->dropForeign('railtracker4_requests_exception_code_foreign');
                $table->dropForeign('railtracker4_requests_exception_line_foreign');
    //            $table->dropForeign('railtracker4_requests_url_query_hash_foreign');
    //            $table->dropForeign('railtracker4_requests_referer_url_query_hash_foreign');
    //            $table->dropForeign('railtracker4_requests_route_action_hash_foreign');
    //            $table->dropForeign('railtracker4_requests_agent_string_hash_foreign');
    //            $table->dropForeign('railtracker4_requests_exception_class_hash_foreign');
    //            $table->dropForeign('railtracker4_requests_exception_file_hash_foreign');
    //            $table->dropForeign('railtracker4_requests_exception_message_hash_foreign');
    //            $table->dropForeign('railtracker4_requests_exception_trace_hash_foreign');



    //            $table->dropIndex('railtracker4_requests_agent_string_hash_index');
    //            $table->dropIndex('railtracker4_requests_route_action_hash_index');
    //            $table->dropIndex('railtracker4_requests_url_query_hash_index');
                $table->dropIndex('railtracker4_requests_route_name_index');
                $table->dropIndex('railtracker4_requests_responded_on_index');
                $table->dropIndex('railtracker4_requests_ip_timezone_index');
                $table->dropIndex('railtracker4_requests_url_domain_index');
                $table->dropIndex('railtracker4_requests_referer_url_path_index');
                $table->dropIndex('railtracker4_requests_ip_country_name_index');
                $table->dropIndex('railtracker4_requests_ip_city_index');
                $table->dropIndex('railtracker4_requests_ip_latitude_index');
                $table->dropIndex('railtracker4_requests_ip_longitude_index');
                $table->dropIndex('railtracker4_requests_language_range_index');
                $table->dropIndex('railtracker4_requests_response_duration_ms_index');
                $table->dropIndex('railtracker4_requests_ip_postal_zip_code_index');
                $table->dropIndex('railtracker4_requests_device_kind_index');
                $table->dropIndex('railtracker4_requests_referer_url_domain_index');
                $table->dropIndex('railtracker4_requests_language_preference_index');
                $table->dropIndex('railtracker4_requests_agent_browser_version_index');
                $table->dropIndex('railtracker4_requests_ip_currency_index');
    //            $table->dropIndex('railtracker4_requests_referer_url_query_hash_index');
                $table->dropIndex('railtracker4_requests_url_protocol_index');
                $table->dropIndex('railtracker4_requests_response_status_code_index');
                $table->dropIndex('railtracker4_requests_device_model_index');
                $table->dropIndex('railtracker4_requests_method_index');
                $table->dropIndex('railtracker4_requests_ip_country_code_index');
                $table->dropIndex('railtracker4_requests_agent_browser_index');
                $table->dropIndex('railtracker4_requests_ip_region_index');
                $table->dropIndex('railtracker4_requests_device_platform_index');
                $table->dropIndex('railtracker4_requests_device_version_index');
                $table->dropIndex('railtracker4_requests_referer_url_protocol_index');
                $table->dropIndex('railtracker4_requests_device_is_mobile_index');
    //            $table->dropIndex('railtracker4_requests_exception_message_hash_index');
    //            $table->dropIndex('railtracker4_requests_exception_class_hash_index');
    //            $table->dropIndex('railtracker4_requests_exception_file_hash_index');
    //            $table->dropIndex('railtracker4_requests_exception_trace_hash_index');
                $table->dropIndex('railtracker4_requests_exception_code_index');
                $table->dropIndex('railtracker4_requests_exception_line_index');
                $table->dropIndex('railtracker4_requests_is_robot_index');
            });
        }
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
