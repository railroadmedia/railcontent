<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dateTime('first_access_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('first_access_at');
        });
    }
};
