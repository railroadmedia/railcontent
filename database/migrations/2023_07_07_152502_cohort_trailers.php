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
        Schema::table('cohorts', function (Blueprint $table) {
            $table->string('description_trailer_1')
                ->nullable();
            $table->string('description_trailer_1_thumb_url')
                ->nullable();
            $table->string('description_trailer_2')
                ->nullable();
            $table->string('description_trailer_2_thumb_url')
                ->nullable();
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
        Schema::table('cohorts', function (Blueprint $table) {
            $table->dropColumn('description_trailer_1');
            $table->dropColumn('description_trailer_2');
            $table->dropColumn('description_trailer_1_thumb_url');
            $table->dropColumn('description_trailer_2_thumb_url');
        });
    }
};
