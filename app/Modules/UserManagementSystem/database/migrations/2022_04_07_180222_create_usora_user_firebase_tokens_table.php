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
        if (Schema::hasTable('usora_user_firebase_tokens')) {
            return;
        }

        Schema::create('usora_user_firebase_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('type', 250);
            $table->text('token')->nullable();
            $table->string('brand');
            $table->timestamp('created_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usora_user_firebase_tokens');
    }
};
