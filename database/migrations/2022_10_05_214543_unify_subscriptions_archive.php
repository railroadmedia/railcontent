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
        Schema::create('ecommerce_unify_subscriptions_archive', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('subscription_id');
            $table->string('action');
            $table->float('price_adjustment_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecommerce_unify_subscriptions_archive');
    }
};
