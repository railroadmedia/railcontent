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
        Schema::table('usora_users', function (Blueprint $table) {
            $table->string('revenuecat_origin_app_user_id')->after('is_lifetime_member')->nullable()->index();
        });

        \DB::statement("update usora_users SET revenuecat_origin_app_user_id = id where id in ( SELECT user_id FROM `ecommerce_subscriptions`
where type in ('apple_subscription','google_subscriptions')
ORDER BY `ecommerce_subscriptions`.`id` DESC);");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('revenuecat_origin_app_user_id');
        });
    }

};
