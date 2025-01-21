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
            $table->date('quarter_removed')->nullable();
            $table->date('quarter_published')->nullable();
            $table->index('quarter_removed');
            $table->index('quarter_published');
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
            $table->dropColumn(['quarter_published', 'quarter_removed']);
        });
    }
};
