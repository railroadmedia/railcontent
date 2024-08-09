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
        Schema::table('cohorts', function (Blueprint $table) {
            $table->boolean('is_product')->default(false);
            $table->string('product_description_header')->nullable();
            $table->longText('product_description_body')->nullable();
            $table->float('product_original_price')->nullable();
            $table->float('product_sale_price')->nullable();
            $table->string('product_image')->nullable();
            $table->longText('course_description')->nullable();
            $table->longText('course_product_description')->nullable();
            $table->string('get_product_badge')->nullable();
            $table->string('product_cart_link')->nullable();
            $table->string('product_name')->nullable();
            $table->longText('product_cart_link_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('cohorts', function (Blueprint $table) {
            $table->dropColumn('is_product');
            $table->dropColumn('product_description_header');
            $table->dropColumn('product_description_body');
            $table->dropColumn('product_original_price');
            $table->dropColumn('product_sale_price');
            $table->dropColumn('product_image');
            $table->dropColumn('course_description');
            $table->dropColumn('course_product_description');
            $table->dropColumn('get_product_badge');
            $table->dropColumn('product_cart_link');
            $table->dropColumn('product_name');
            $table->dropColumn('product_cart_link_description');
        });
    }
};
