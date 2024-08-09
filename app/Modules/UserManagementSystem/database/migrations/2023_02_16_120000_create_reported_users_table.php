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
    public function up(): void
    {
        if (!Schema::hasTable('usora_reported_users')) {
            Schema::create('usora_reported_users', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->integer('reporter_id')->index();

                $table->dateTime('created_on')->index();

                $table->index(['user_id', 'reporter_id'], 'ur');
            });
        }

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('usora_reported_users');
    }
};
