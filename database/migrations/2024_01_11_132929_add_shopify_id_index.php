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
        Schema::table('ecommerce_customers', function (Blueprint $table) {
            $table->index('shopify_id');
        });

        Schema::table('ecommerce_order_item_fulfillment', function (Blueprint $table) {
            $table->index('shopify_id');
        });

        Schema::table('ecommerce_orders', function (Blueprint $table) {
            $table->index('shopify_id');
        });

        Schema::table('ecommerce_payments', function (Blueprint $table) {
            $table->index('shopify_id');
        });

        Schema::table('ecommerce_refunds', function (Blueprint $table) {
            $table->index('shopify_id');
        });

        Schema::table('ecommerce_subscription_payments', function (Blueprint $table) {
            $table->index('shopify_id');
        });

        Schema::table('usora_users', function (Blueprint $table) {
            $table->index('shopify_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecommerce_customers', function (Blueprint $table) {
            $table->dropIndex(['shopify_id']);
        });

        Schema::table('ecommerce_order_item_fulfillment', function (Blueprint $table) {
            $table->dropIndex(['shopify_id']);
        });

        Schema::table('ecommerce_orders', function (Blueprint $table) {
            $table->dropIndex(['shopify_id']);
        });

        Schema::table('ecommerce_payments', function (Blueprint $table) {
            $table->dropIndex(['shopify_id']);
        });

        Schema::table('ecommerce_refunds', function (Blueprint $table) {
            $table->dropIndex(['shopify_id']);
        });

        Schema::table('ecommerce_subscription_payments', function (Blueprint $table) {
            $table->dropIndex(['shopify_id']);
        });

        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropIndex(['shopify_id']);
        });
    }
};
