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
    public function up()
    {
        Schema::create('user_data_versions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id'); // user_id column with foreign key constraint
            $table->unsignedTinyInteger('data_key'); // key to uniquely identify data
            $table->unsignedInteger('version')->default(1); // version starts at 1
            $table->timestamps(); // created_at and updated_at columns

            // Ensure user_id and key are unique together
            $table->unique(['user_id', 'data_key']);
            $table->foreign('user_id')->references('id')->on('usora_users');
            $table->index(['user_id']);
            $table->index(['updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data_versions');
    }
};
