<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class OptimizeContentIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->table(
            ConfigService::$tableContent,
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->dropIndex('railcontent_content_type_index');
                $table->dropIndex('railcontent_content_status_index');
                $table->dropIndex('railcontent_content_brand_index');
                $table->dropIndex('railcontent_content_created_on_index');
                $table->dropIndex('railcontent_content_published_on_index');

                $table->index(['type', 'status', 'brand'], 't_s_b');
                $table->index(['published_on', 'created_on'], 'co_po');
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
        Schema::connection(ConfigService::$databaseConnectionName)->table(
            ConfigService::$tableContent,
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->dropIndex('t_s_b');
                $table->dropIndex('co_po');

                $table->index('type', 'railcontent_content_type_index');
                $table->index('status', 'railcontent_content_status_index');
                $table->index('brand', 'railcontent_content_brand_index');
                $table->index('created_on', 'railcontent_content_created_on_index');
                $table->index('published_on', 'railcontent_content_published_on_index');
            }
        );
    }
}
