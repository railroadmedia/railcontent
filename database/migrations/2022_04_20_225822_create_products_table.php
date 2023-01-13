<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('product_type_id');
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->longText('sku');
            $table->string('promo_code')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('header_text')->nullable();
            $table->string('subheader_text')->nullable();
            $table->string('short_desc')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_img')->nullable();
            $table->string('special_text')->nullable();
            $table->string('thumbnail_logo')->nullable();
            $table->string('page_logo')->nullable();
            $table->decimal('price',8,2);
            $table->decimal('discounted_price',8,2)->nullable();
            $table->string('spread_img')->nullable();
            $table->longText('overview')->nullable();
            $table->string('study_text')->nullable();
            $table->string('video_src')->nullable();
            $table->string('product_img')->nullable();
            $table->string('instructor_name')->nullable();
            $table->longText('instructor_desc')->nullable();
            $table->integer('size_chart_id')->nullable();
            $table->boolean('sold_out')->default(false);
            $table->boolean('guaranteed')->default(false);
            $table->boolean('visible')->default(true);
            $table->boolean('free_shipping')->default(false);
            $table->boolean('included_edge')->default(false);
            $table->boolean('size_case_sensitive')->default(false);
            $table->boolean('bundle_free_shipping')->default(false);
            $table->string('bundle_img')->nullable();
            $table->longText('bundle_desc')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
