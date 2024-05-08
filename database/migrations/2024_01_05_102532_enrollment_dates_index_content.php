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
        Schema::table('railcontent_content', function (Blueprint $table) {
            $table->index(['type', 'status', 'brand','enrollment_end_time'], 't_s_b_e');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('railcontent_content', function (Blueprint $table) {
            $table->dropIndex('t_s_b_e');
        });
    }
};
