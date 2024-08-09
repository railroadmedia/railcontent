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
        if (Schema::hasTable('usora_email_changes')) {
            return;
        }

        Schema::create('usora_email_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique();
            $table->string('email')->index();
            $table->string('token');
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
        Schema::dropIfExists('usora_email_changes');
    }
};
