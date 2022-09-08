<?php

namespace App\Modules\Mentor\Console\Commands;


use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\MentorService;

class RecalculateMentorTotals extends Command
{
    protected $signature = 'mentors:recalculateTotals';

    protected $description = 'Recalculates each mentor totals';
    private MentorService $mentorService;

    public function __construct(
        MentorService $mentorService,
    ) {
        parent::__construct();
        $this->mentorService = $mentorService;
    }

    public function handle()
    {
        $this->info("Recalulate Mentor Totals");

        $this->withProgressBarChunked(Mentor::query(), function (Mentor $mentor) {
            $currentTotal = $mentor->total_student_count;
            $currentActiveTotal = $mentor->active_student_count;
            $this->mentorService->recalculateMentorTotals($mentor);

            if ($currentTotal != $mentor->total_student_count) {
                $this->info(
                    "Updated mentor $mentor->user_id total count from $currentTotal to $mentor->total_student_count"
                );
            }
            if ($currentActiveTotal != $mentor->active_student_count) {
                $this->info(
                    "Updated mentor $mentor->user_id total count from $currentActiveTotal to $mentor->active_student_count"
                );
            }
        });
    }
}
