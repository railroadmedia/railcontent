<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        // SQLite doesn't support multiple calls to dropColumn / renameColumn in a single modification
        if (Schema::getConnection()->getDriverName() === "sqlite") {
            $this->upSqlite();
        } else {
            Schema::table('cohorts', function (Blueprint $table) {
                $table->renameColumn('start_date', 'enrollment_start_date');
                $table->renameColumn('end_date', 'enrollment_end_date');
                $table->timestamp('cohort_start_date')->nullable();
                $table->timestamp('cohort_end_date')->nullable();
            });
        }

        $cohorts = [
            [
                'id' => 1,
                'cohort_start_date' => '2023-03-01 00:00:00',
                'cohort_end_date' => '2023-03-31 00:00:00',
            ],
            [
                'id' => 2,
                'cohort_start_date' => '2023-03-01 00:00:00',
                'cohort_end_date' => '2023-03-31 00:00:00',
            ],
        ];

        foreach ($cohorts as $cohort) {
            $values = collect($cohort)->filter(function ($value, $key) {
                return $key != 'id';
            })->toArray();
            \App\Models\Cohort::query()->where('id', '=', $cohort['id'])->update($values);
        }
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === "sqlite") {
            $this->downSqlite();
        } else {
            Schema::table('cohorts', function (Blueprint $table) {
                $table->renameColumn('enrollment_start_date', 'start_date');
                $table->renameColumn('enrollment_end_date', 'end_date');
                $table->dropColumn('cohort_start_date');
                $table->dropColumn('cohort_end_date');
            });
        }
    }

    /**
     * Run the migrations (separated out for SQLite support)
     *
     * @return void
     */
    private function upSqlite(): void
    {
        Schema::table('cohorts', function (Blueprint $table) {
            $table->renameColumn('start_date', 'enrollment_start_date');
        });
        Schema::table('cohorts', function (Blueprint $table) {
            $table->renameColumn('end_date', 'enrollment_end_date');
        });
        Schema::table('cohorts', function (Blueprint $table) {
            $table->timestamp('cohort_start_date')->nullable();
            $table->timestamp('cohort_end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations (separated out for SQLite support)
     *
     * @return void
     */
    public function downSqlite(): void
    {
        Schema::table('cohorts', function (Blueprint $table) {
            $table->renameColumn('enrollment_start_date', 'start_date');
        });
        Schema::table('cohorts', function (Blueprint $table) {
            $table->renameColumn('enrollment_end_date', 'end_date');
        });
        Schema::table('cohorts', function (Blueprint $table) {
            $table->dropColumn('cohort_start_date');
        });
        Schema::table('cohorts', function (Blueprint $table) {
            $table->dropColumn('cohort_end_date');
        });
    }
};
