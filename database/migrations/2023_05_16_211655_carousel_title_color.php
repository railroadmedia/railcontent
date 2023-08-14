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
        //
        Schema::table('carousels', function (Blueprint $table) {
            $table->string('subtitle_color')->nullable();
            $table->string('title_color')->nullable();
            $table->boolean('btn_light_mode')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn('subtitle_color');
            $table->dropColumn('title_color');
            $table->dropColumn('btn_light_mode');
        });
    }
};
