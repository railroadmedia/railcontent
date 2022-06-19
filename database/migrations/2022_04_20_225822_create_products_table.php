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
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('thumbnail')->unique();
            $table->string('header_text');
            $table->string('short_desc')->nullable();
            $table->string('meta_desc');
            $table->string('meta_img')->unique();
            $table->string('special_text')->nullable();
            $table->string('study_text')->nullable();
            $table->string('logo')->nullable()->unique();
            $table->decimal('price',8,2);
            $table->decimal('discounted_price',8,2)->nullable();
            $table->string('video_src')->nullable();
            $table->longText('overview')->nullable();
            $table->string('instructor_name')->nullable();
            $table->string('instructor_img')->nullable()->unique();
            $table->longText('instructor_desc')->nullable();
            $table->boolean('sold_out')->default(false);
            $table->boolean('free_shipping')->default(false);
            $table->boolean('guaranteed')->default(false);
            $table->boolean('visible')->default(true);
            $table->boolean('free_bonus')->default(false);
            $table->boolean('membership_discount')->default(false);
            $table->boolean('lifetime_access')->default(false);
            $table->integer()->nullable();
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
