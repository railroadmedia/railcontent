<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('artists')) {
            Schema::create('artists', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('head_shot_picture_url')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->timestamp('created_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
