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
            $table->boolean('visible')->default(true);
            $table->boolean('is_featured');
            $table->integer('product_id')->nullable();
            $table->string('product_url')->nullable();
            $table->string('endpoint')->nullable();
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
            $table->dropColumn('visible');
            $table->dropColumn('is_featured');
            $table->dropColumn('product_id')->nullable();
            $table->dropColumn('product_url')->nullable();
            $table->dropColumn('endpoint')->nullable();
        });
    }
};
