<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    private const INDEX_NAME = 'challenges_user_progress_user_id_content_id_index';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $index = self::INDEX_NAME;
        Schema::connection(config('user_management_system.database_connection_name'))
            ->table(
                'challenges_user_progress',
                function ($table) use ($index) {
                    /** @var $table \Illuminate\Database\Schema\Blueprint */
                    $table->dropIndex($index);
                }
            );
        Schema::table('challenges_user_progress', function (Blueprint $table) {
            $table->unique(['user_id', 'content_id'], self::INDEX_NAME);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $index = self::INDEX_NAME;
        Schema::connection(config('user_management_system.database_connection_name'))
            ->table(
                'challenges_user_progress',
                function ($table) use ($index) {
                    /** @var $table \Illuminate\Database\Schema\Blueprint */
                    $table->dropIndex($index);
                }
            );
        Schema::table('challenges_user_progress', function (Blueprint $table) {
            $table->index(['user_id', 'content_id'], self::INDEX_NAME);
        });
    }
};
