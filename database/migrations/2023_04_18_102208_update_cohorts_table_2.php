<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        // SQLite won't allow you to add a not null column without a default value, to an existing table
        if (Schema::getConnection()->getDriverName() === "sqlite") {
            $this->upSqlite();
        } else {
            Schema::table('cohorts', function (Blueprint $table) {
                $table->dropColumn('course_url');
                $table->integer('content_id');
                $table->integer('conversation_thread_id');
            });

            $this->seed();
        }
    }

    private function seed()
    {
        $cohorts = [
            [
                'id' => 1,
                'content_id' => 383627,
            ],
            [
                'id' => 2,
                'content_id' => 383674,
            ],
        ];

        foreach ($cohorts as $cohort) {
            $values = collect($cohort)->filter(function ($value, $key) {
                return $key != 'id';
            })->toArray();
            \App\Models\Cohort::query()->where('id', '=', $cohort['id'])->update($values);
        }
    }

    public function down()
    {
        Schema::table('cohorts', function (Blueprint $table) {
            $table->dropColumn('content_id');
            $table->string('course_url')
                ->nullable();
            $table->dropColumn('conversation_thread_id');
        });
    }

    /**
     * Run the migrations (separated out for SQLite support)
     *
     * @return void
     */
    private function upSqlite(): void
    {
        Schema::table('cohorts', function (Blueprint $table) {
            $table->dropColumn('course_url');
        });

        // SQLite won't allow you to add a not null column without a default value, to an
        // existing table, so make it nullable and remove that after, as a workaround hack
        Schema::table('cohorts', function (Blueprint $table) {
            $table->integer('content_id')->nullable();
            $table->integer('conversation_thread_id')->nullable();
        });

        // update the existing values before making content_id not nullable, so it doesn't fail integrity validation
        $this->seed();

        Schema::table('cohorts', function (Blueprint $table) {
            $table->integer('content_id')->nullable(false)->change();
            // it would be impossible to make the conversation_thread_id not nullable, because there's no value on
            // the existing entries in the table. Thankfully, 2023_05_17_152502_cohort_thread_id_nullable.php makes it nullable,
            // so we'll sort of cheat things and just keep it nullable here and now
        });
    }
};
