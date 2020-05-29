<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class AddShowInNewFeedToContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection(config('railcontent.database_connection_name'))->table(
            config('railcontent.table_prefix'). 'content',
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->boolean('show_in_new_feed')->after('total_xp')->index()->nullable();
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
        Schema::connection(config('railcontent.database_connection_name'))->table(
            config('railcontent.table_prefix'). 'content',
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->dropColumn('show_in_new_feed');
            }
        );
    }
}
