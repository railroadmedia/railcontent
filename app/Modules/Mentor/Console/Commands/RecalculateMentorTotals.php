<?php

namespace App\Modules\Mentor\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\MentorService;

class RecalculateMentorTotals extends Command
{
    protected $signature = 'mentors:recalculateTotals';

    protected $description = 'Recalculates each mentor totals';

    public function handle(MentorService $mentorService): void
    {
        $this->info("Recalculate Mentor Totals");

        $this->withProgressBarChunked(Mentor::query(), function (Mentor $mentor) use ($mentorService) {
            $currentTotal = $mentor->total_student_count;
            $currentActiveTotal = $mentor->active_student_count;
            $mentorService->recalculateMentorTotals($mentor);

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
