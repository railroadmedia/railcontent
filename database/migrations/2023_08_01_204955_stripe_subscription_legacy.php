<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecommerce_subscriptions', function (Blueprint $table) {
            $table->string('legacy_payment_method_id')->nullable()->after('payment_method_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecommerce_subscriptions', function (Blueprint $table) {
            $table->dropColumn('legacy_payment_method_id');
        });
    }
};
