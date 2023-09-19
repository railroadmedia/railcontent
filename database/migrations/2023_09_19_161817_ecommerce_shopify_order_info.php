<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('ecommerce_user_product_membership_times', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->bigInteger("shopify_order_id");
            $table->bigInteger("shopify_variant_id");
            $table->dateTime("order_created_at");
            $table->integer("membership_time_days");
            $table->integer("membership_time_months");
            $table->enum("status", ["open", "archived", "cancelled"]);
            $table->timestamps();

            $table->index("user_id");
        });
    }


    public function down()
    {
        Schema::dropIfExists('ecommerce_user_product_membership_times');
    }
};
