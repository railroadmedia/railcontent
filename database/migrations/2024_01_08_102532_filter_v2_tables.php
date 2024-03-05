<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'content_essentials',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->string('essentials')->index();
                $table->integer('position')->index();

                $table->index(['essentials', 'content_id'], 'essc');
            }
        );
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'content_theory',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->string('theory')->index();
                $table->integer('position')->index();

                $table->index(['theory', 'content_id'], 'thec');
            }
        );
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'content_creativity',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->string('creativity')->index();
                $table->integer('position')->index();

                $table->index(['creativity', 'content_id'], 'cc');
            }
        );
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'content_lifestyle',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->string('lifestyle')->index();
                $table->integer('position')->index();

                $table->index(['lifestyle', 'content_id'], 'lc');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('railcontent.table_prefix') . 'content_essentials');
        Schema::dropIfExists(config('railcontent.table_prefix') . 'content_theory');
        Schema::dropIfExists(config('railcontent.table_prefix') . 'content_creativity');
        Schema::dropIfExists(config('railcontent.table_prefix') . 'content_lifestyle');

    }
};
