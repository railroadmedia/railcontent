<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('user_explore_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('task_id')->index();
            $table->boolean('is_completed')->default(false);
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on("usora_users")->cascadeOnDelete();
            $table->foreign('task_id')->references('id')->on("explore_tasks")->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_explore_tasks');
    }
};
