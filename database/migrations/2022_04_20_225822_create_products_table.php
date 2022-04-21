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
            $table->string('slug');
            $table->string('header_text');
            $table->string('logo')->nullable();
            $table->string('features')->nullable();
            $table->decimal('price',8,2);
            $table->decimal('discounted_price',8,2)->nullable();
            $table->string('video_src')->nullable();
            $table->string('overview')->nullable();
            $table->string('about_text')->nullable();
            $table->string('about_img')->nullable();
            $table->string('interactive_banner')->nullable();
            $table->string('instructor_name')->nullable();
            $table->string('instructor_photo')->nullable();
            $table->string('instructor_desc')->nullable();
            $table->string('topics')->nullable();
            $table->boolean('sold_out')->default(false);
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
