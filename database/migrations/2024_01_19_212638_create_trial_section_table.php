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
        Schema::create('trial_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->longText('description');
            $table->string('tagline')->nullable();
            $table->string('desktop_img');
            $table->string('tablet_img')->nullable();
            $table->string('mobile_img')->nullable();
            $table->integer('product_id');
            $table->string('trailer')->nullable();
            $table->integer('display_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('trial_sections');
    }
};
