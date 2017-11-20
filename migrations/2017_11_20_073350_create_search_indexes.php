<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
        Schema::create(
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
                    $table->timestamps();
                }
            );

        DB::statement('ALTER TABLE '.ConfigService::$tableSearchIndexes.' ADD FULLTEXT high_full_text(high_value)');
        DB::statement('ALTER TABLE '.ConfigService::$tableSearchIndexes.' ADD FULLTEXT medium_full_text(medium_value)');
        DB::statement('ALTER TABLE '.ConfigService::$tableSearchIndexes.' ADD FULLTEXT low_full_text(low_value)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ConfigService::$tableSearchIndexes);
    }
}
