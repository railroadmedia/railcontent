<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('carousels', function (Blueprint $table) {
            $table->string('cta_text')->nullable()->change();
            $table->string('cta_url')->nullable()->change();
            $table->string('cta_text')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->string('logo')->nullable();
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
            $table->string('cta_url')->change();
            $table->string('cta_text')->change();
            $table->string('description')->change();
            $table->dropColumn('logo');
        });
    }
};
