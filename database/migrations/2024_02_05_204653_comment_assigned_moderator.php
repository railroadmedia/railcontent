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
        Schema::table('railcontent_comments', function (Blueprint $table) {
            $table->integer('assigned_moderator_id')->after('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('railcontent_comments', function (Blueprint $table) {
            $table->dropColumn('assigned_moderator_id');
        });
    }
};
