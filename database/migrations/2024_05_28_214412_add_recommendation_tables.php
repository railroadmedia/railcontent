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
    public function up(): void
    {
        $brands = ['drumeo', 'singeo', 'guitareo', 'pianote'];

        $sections = ['quick_tips', 'course', 'song', 'workout'];
        foreach($brands as $brand) {
            foreach($sections as $section) {
                if(($brand == 'singeo' || $brand == 'pianote') && $section == 'course') {
                    continue;
                }
                $tableName = "recommendations_" . $brand . '_' . $section;
                $coldStartTableName = $tableName . '_beginner_items';
                if (!Schema::hasTable($tableName)) {
                    Schema::create($tableName, function (Blueprint $table) {
                        $table->increments('id');
                        $table->integer('user_id')->nullable();
                        $table->integer('content_id')->nullable();
                        $table->bigInteger('recommendation_rank')->nullable();
                        $table->string('source')->nullable();
                    });

                    Schema::create($coldStartTableName, function (Blueprint $table) {
                        $table->integer('id');
                        $table->integer('content_id');
                        $table->integer('rank');
                    });
                }

            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $brands = ['drumeo', 'singeo', 'guitareo', 'pianote'];
        $sections = ['quick_tips', 'course', 'song', 'workout'];
        foreach($brands as $brand) {
            foreach($sections as $section) {
                $tableName = "recommendations_" . $brand . '_' . $section;
                $coldStartTableName = $tableName . '_beginner_items';
                Schema::dropIfExists($tableName);
                Schema::dropIfExists($coldStartTableName);
            }
        }
    }
};
