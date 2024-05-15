<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('add_event_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('uniquekey');
            $table->string('title');
        });
    }

    public function down()
    {
        Schema::dropIfExists('add_event_calendars');
    }
};
