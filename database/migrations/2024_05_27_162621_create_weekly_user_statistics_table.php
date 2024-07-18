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
        Schema::create('weekly_user_statistics', function (Blueprint $table) {
            $table->id();
            $table->date('week')->index();
            $table->integer('user_id')->index();
            $table->enum('last_used_brand', ['drumeo','pianote','guitareo','singeo','musora', 'basseo', 'none'])->index();
            $table->enum('most_content_starts_brand', ['drumeo','pianote','guitareo','singeo','musora', 'basseo', 'none'])->index();
            $table->integer('count_of_content_starts_drumeo')->index();
            $table->integer('count_of_content_starts_pianote')->index();
            $table->integer('count_of_content_starts_guitareo')->index();
            $table->integer('count_of_content_starts_singeo')->index();
            $table->integer('count_of_content_starts_basseo')->index();
            $table->integer('count_of_content_starts_musora')->index();
            $table->enum('access_type', ['plus', 'basic'])->index();
            $table->enum('access_frequency', ['monthly', 'yearly', 'lifetime', 'other', 'trial'])->index();
            $table->boolean('in_trial_period')->index();
            $table->boolean('active')->index();
            $table->boolean('expired')->index();
            $table->dateTime('generated_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weekly_user_statistics');
    }
};
