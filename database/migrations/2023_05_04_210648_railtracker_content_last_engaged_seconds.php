<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('railtracker_content_last_engaged_seconds', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('content_id');
            $table->integer('resume_time_seconds');
            $table->timestamps();
            $table->unique(['user_id', 'content_id'], 'railtracker_content_last_engaged_seconds_user_content_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('railtracker_content_last_engaged_seconds');
    }
};
