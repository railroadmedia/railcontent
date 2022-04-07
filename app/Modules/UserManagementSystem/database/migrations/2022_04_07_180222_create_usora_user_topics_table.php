<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsoraUserTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('usora_user_topics')) {
            return;
        }

        Schema::create('usora_user_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('topic', 250);
            $table->string('brand');
            $table->timestamp('created_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usora_user_topics');
    }
}
