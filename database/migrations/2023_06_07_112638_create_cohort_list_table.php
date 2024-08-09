<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('cohort_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('cohort_id');
            $table->longText('description');
            $table->timestamps();
        });

        $lists = [
            [
                'cohort_id' => 4,
                'description' => 'Master your chord changes & inversions.',
            ],
            [
                'cohort_id' => 4,
                'description' => 'Join 9381 pianote players who have already registered.',
            ]
        ];

        foreach ($lists as $item) {
            \App\Models\CohortList::create([
                'cohort_id' => $item['cohort_id'],
                'description' => $item['description'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cohorts');

        Schema::dropIfExists('cohort_list');
    }
};
