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
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('visible')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('product_id')->nullable();
            $table->string('product_url')->nullable();
            $table->string('endpoint')->nullable();
            $table->string('video_src')->nullable();
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
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('visible');
            $table->dropColumn('is_featured');
            $table->dropColumn('product_id');
            $table->dropColumn('product_url');
            $table->dropColumn('endpoint');
            $table->dropColumn('video_src');
        });
    }
};
