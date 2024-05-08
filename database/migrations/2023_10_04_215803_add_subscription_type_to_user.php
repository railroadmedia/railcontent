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
            $table->boolean('has_recharge_subscription')
                ->default(false);
            $table->boolean('has_apple_subscription')
                ->default(false);
            $table->boolean('has_google_subscription')
                ->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('has_recharge_subscription');
            $table->dropColumn('has_apple_subscription');
            $table->dropColumn('has_google_subscription');
        });
    }
};
