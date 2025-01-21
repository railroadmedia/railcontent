<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('explore_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('hook')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('expires_in_days')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('explore_tasks');
    }
};
