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
        if (!Schema::hasTable('usora_blocked_users')) {
            Schema::create('usora_blocked_users', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->integer('blocker_id')->index();

                $table->dateTime('created_on')->index();

                $table->index(['user_id', 'blocker_id'], 'ub');
            });
        }

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usora_blocked_users');
    }
};
