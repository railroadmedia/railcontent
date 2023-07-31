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
        Schema::table('cohorts', function (Blueprint $table) {
            $table->string('demo_background_image_url')
                ->nullable();
            $table->string('demo_desktop_center_image_url')
                ->nullable();
            $table->string('demo_mobile_center_image_url')
                ->nullable();
            $table->string('demo_title_text')
                ->nullable();
            $table->string('demo_description_text')
                ->nullable();
            $table->string('demo_label_text')
                ->nullable();
            $table->string('demo_trailer')
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
            $table->dropColumn('demo_background_image_url');
            $table->dropColumn('demo_desktop_center_image_url');
            $table->dropColumn('demo_mobile_center_image_url');
            $table->dropColumn('demo_title_text');
            $table->dropColumn('demo_description_text');
            $table->dropColumn('demo_label_text');
            $table->dropColumn('demo_trailer');
        });
    }
};
