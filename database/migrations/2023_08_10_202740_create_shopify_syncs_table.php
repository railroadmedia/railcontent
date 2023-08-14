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
        Schema::create('shopify_syncs', function (Blueprint $table) {
            $table->id();
            // using a string instead of enum to make life easier if we ever need to add more resources
            $table->string("resource");
            $table->timestamp("started_at");
            $table->timestamp("finished_at")->nullable();
            $table->json("shopify_ids")->nullable();
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
        Schema::dropIfExists('shopify_syncs');
    }
};
