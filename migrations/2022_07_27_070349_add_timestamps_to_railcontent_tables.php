<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToRailcontentTables extends Migration
{
    private $tablesToUpdate = [
        'content_focus',
        'content_bpm',
        'content_keys',
        'content_key_pitch_types',
        'content_topics',
        'content_styles',
        'content_playlists',
        'content_instructors',
        'content_exercises',
        'content_tags',
        'content_fields',
        'content_data'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        foreach ($this->tablesToUpdate as $table) {
            Schema::connection(config('railcontent.database_connection_name'))
                ->table(config('railcontent.table_prefix') . $table, function (Blueprint $table) {
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tablesToUpdate as $table) {
            Schema::table('railcontent_' . $table, function (Blueprint $table) {
                $table->dropTimestamps();
            });
        }
    }
}

;
