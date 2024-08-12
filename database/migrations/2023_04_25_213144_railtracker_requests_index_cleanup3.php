<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // when testing, we don't have these other connections
        if (!app()->environment('testing')) {
            $connections = [
                'drumeo_laravel_mysql_writer_only',
                'pianote_laravel_mysql_writer_only',
                'guitareo_laravel_mysql_writer_only',
                'singeo_laravel_mysql_writer_only'
            ];

            foreach ($connections as $connection) {
                Schema::connection($connection)->table('railtracker4_requests', function (Blueprint $table) {
                    $table->dropForeign('railtracker4_requests_url_query_hash_foreign');
                    $table->dropForeign('railtracker4_requests_referer_url_query_hash_foreign');
                    $table->dropForeign('railtracker4_requests_route_action_hash_foreign');
                    $table->dropForeign('railtracker4_requests_agent_string_hash_foreign');
                    $table->dropForeign('railtracker4_requests_exception_class_hash_foreign');
                    $table->dropForeign('railtracker4_requests_exception_file_hash_foreign');
                    $table->dropForeign('railtracker4_requests_exception_message_hash_foreign');
                    $table->dropForeign('railtracker4_requests_exception_trace_hash_foreign');


                    $table->dropIndex('railtracker4_requests_agent_string_hash_index');
                    $table->dropIndex('railtracker4_requests_route_action_hash_index');
                    $table->dropIndex('railtracker4_requests_url_query_hash_index');
                    $table->dropIndex('railtracker4_requests_referer_url_query_hash_index');
                    $table->dropIndex('railtracker4_requests_exception_message_hash_index');
                    $table->dropIndex('railtracker4_requests_exception_class_hash_index');
                    $table->dropIndex('railtracker4_requests_exception_file_hash_index');
                    $table->dropIndex('railtracker4_requests_exception_trace_hash_index');

                    $table->dropIndex('railtracker4_requests_ip_address_requested_on_index');
                    $table->dropIndex('railtracker4_requests_url_path_index');
                    $table->dropIndex('railtracker4_requests_ip_address_index');
                    $table->dropIndex('railtracker4_requests_cookie_id_index');
                    $table->dropIndex('railtracker4_requests_requested_on_index');
                    $table->dropIndex('railtracker4_requests_user_id_index');
                    $table->dropIndex('railtracker4_requests_uuid_unique');
                    $table->dropIndex('railtracker4_requests_user_id_cookie_id_index');
                });

                Schema::connection($connection)->table('railtracker4_url_queries', function (Blueprint $table) {
                    $table->dropIndex('url_query_hash_index');
                    $table->dropIndex('url_query_index');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
