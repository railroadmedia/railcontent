<?php

use App\Modules\Ecommerce\Models\Shopify\ShopifyOrderFix;
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
        Schema::create('shopify_order_fixes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('original_shopify_order_id')->index();
            $table->morphs('ecommerce_modelable', 'shopify_order_fixes_ecommerce_modelable_index');
            $table->decimal('shopify_order_price');
            $table->string('shopify_order_currency');
            $table->decimal('true_payment_amount');
            $table->bigInteger('replacement_shopify_order_id')->nullable();
            $table->enum('action_taken', ShopifyOrderFix::ACTIONS);
            $table->enum('status', ShopifyOrderFix::STATUSES)->default(ShopifyOrderFix::STATUS_PROCESSING);
            $table->text('notes')->nullable();
            $table->dateTime('processed_at');
            $table->boolean('is_fixed')->default(false);
            $table->decimal('order_total_usd');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('shopify_order_fixes');
    }
};
