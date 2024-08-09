<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('usora_remember_tokens')) {
            return;
        }

        Schema::create('usora_remember_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('token')->index();
            $table->text('device_information');
            $table->timestamp('expires_at')->index();
            $table->timestamp('created_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usora_remember_tokens');
    }
};
