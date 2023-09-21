<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('user_access_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger("permission_id");
            $table->enum("source", ["manual", "shopify"]);
            $table->string("source_hash", 40);
            $table->dateTime("start_time");
            $table->integer("time_days");
            $table->integer("time_months");
            $table->boolean("time_lifetime")->default(false);
            $table->enum("status", ["active", "revoked"]);
            $table->timestamps();

            $table->foreign("user_id")->references('id')->on("usora_users");
            $table->foreign("permission_id")->references('id')->on("railcontent_permissions");
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_access_permissions');
    }
};
