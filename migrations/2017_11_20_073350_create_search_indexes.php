<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class CreateSearchIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config()->get('database.default') != 'testbench') {
            Schema::connection(ConfigService::$databaseConnectionName)->create(
                ConfigService::$tableSearchIndexes,
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */
                    $table->engine = 'InnoDB';
                    $table->integer('content_id')->primary();
                    $table->text('high_value');
                    $table->text('medium_value');
                    $table->text('low_value');
                    $table->string('brand', 64)->index();
                    $table->string('content_type', 128)->index();
                    $table->dateTime('content_published_on')->index();
                    $table->timestamps();
                }
            );
            if (app()->environment() != 'testing') {
                Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                    'ALTER TABLE ' .
                    ConfigService::$tableSearchIndexes .
                    ' ADD FULLTEXT high_full_text(high_value)'
                );
                Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                    'ALTER TABLE ' .
                    ConfigService::$tableSearchIndexes .
                    ' ADD FULLTEXT medium_full_text(medium_value)'
                );
                Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                    'ALTER TABLE ' . ConfigService::$tableSearchIndexes . ' ADD FULLTEXT low_full_text(low_value)'
                );
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->dropIfExists(
            ConfigService::$tableSearchIndexes
        );
    }
}
