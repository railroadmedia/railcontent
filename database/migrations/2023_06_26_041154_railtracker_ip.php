<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('railtracker4_ip_data', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 128)->unique();
            $table->decimal('ip_latitude', 11, 8)->nullable();
            $table->decimal('ip_longitude', 11, 8)->nullable();
            $table->string('ip_country_code', 6)->nullable();
            $table->string('ip_country_name', 128)->nullable();
            $table->string('ip_region', 128)->nullable();
            $table->string('ip_city', 128)->nullable();
            $table->string('ip_postal_zip_code', 16)->nullable();
            $table->string('ip_timezone', 64)->nullable();
            $table->string('ip_currency', 16)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('railtracker4_ip_data');
    }
};
