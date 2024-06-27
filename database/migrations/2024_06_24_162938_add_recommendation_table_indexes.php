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
        $brands = ['drumeo', 'singeo', 'guitareo', 'pianote'];

        $sections = ['quick_tips', 'course', 'song', 'workout'];
        foreach ($brands as $brand) {
            foreach ($sections as $section) {
                if (($brand == 'singeo' || $brand == 'pianote') && $section == 'course') {
                    continue;
                }
                $tableName = "recommendations_" . $brand . '_' . $section;
                $coldStartTableName = $tableName . '_beginner_items';

                if (Schema::hasTable($tableName)) {
                    // SQLite doesn't support multiple calls to dropColumn / renameColumn in a single modification
                    if (Schema::getConnection()->getDriverName() === "sqlite") {
                        $this->addIndexesSqlite($tableName, $coldStartTableName);
                    } else {
                        Schema::table($tableName, function (Blueprint $table) {
                            $table->index('user_id', 'user_id_index');
                            $table->index('content_id', 'content_id_index');
                            $table->index('recommendation_rank', 'recommendation_rank_index');
                            $table->index(['user_id', 'recommendation_rank'], 'user_id_rec_rank_index');
                        });

                        Schema::table($coldStartTableName, function (Blueprint $table) {
                            $table->index('content_id', 'content_id_index');
                            $table->index('rank', 'rank_index');
                            $table->index(['content_id', 'rank'], 'user_id_rec_rank_index');
                        });
                    }
                }
            }
        }
    }

    /**
     * Run the migrations (separated out for SQLite support)
     * SQLite fails for the index name already in use, so just use Laravel's generated name instead of
     * specifying one.
     */
    private function addIndexesSqlite(string $tableName, string $coldStartTableName): void
    {
        Schema::table($tableName, function (Blueprint $table) {
            $table->index('user_id');
            $table->index('content_id');
            $table->index('recommendation_rank');
            $table->index(['user_id', 'recommendation_rank']);
        });

        Schema::table($coldStartTableName, function (Blueprint $table) {
            $table->index('content_id');
            $table->index('rank');
            $table->index(['content_id', 'rank']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $brands = ['drumeo', 'singeo', 'guitareo', 'pianote'];
        $sections = ['quick_tips', 'course', 'song', 'workout'];
        foreach ($brands as $brand) {
            foreach ($sections as $section) {
                $tableName = "recommendations_" . $brand . '_' . $section;
                $coldStartTableName = $tableName . '_beginner_items';

                if (Schema::hasTable($tableName)) {
                    Schema::table($tableName, function (Blueprint $table) {
                        $table->dropIndex('user_id_index');
                        $table->dropIndex('content_id_index');
                        $table->dropIndex('recommendation_rank_index');
                        $table->dropIndex('user_id_rec_rank_index');
                    });
                }

                if (Schema::hasTable($coldStartTableName)) {
                    Schema::table($coldStartTableName, function (Blueprint $table) {
                        $table->dropIndex('content_id_index');
                        $table->dropIndex('rank_index');
                        $table->dropIndex('user_id_rec_rank_index');
                    });
                }
            }
        }
    }
};
