<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::table('cohorts', function (Blueprint $table) {
            $table->dropColumn('course_url');
            $table->integer('content_id');
            $table->integer('conversation_thread_id');
        });

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
};
