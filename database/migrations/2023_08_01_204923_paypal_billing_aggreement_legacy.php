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
    public function up(): void
    {
        Schema::table('ecommerce_paypal_billing_agreements', function (Blueprint $table) {
            $table->string('legacy_payment_gateway_name')->nullable()->after('payment_gateway_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('ecommerce_paypal_billing_agreements', function (Blueprint $table) {
            $table->dropColumn('legacy_payment_gateway_name');
        });
    }
};
