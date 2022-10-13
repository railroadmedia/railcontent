<?php

namespace App\Modules\Mentor\Console\Commands;


use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Services\EnsureMentorResult;
use App\Modules\Mentor\Services\MentorService;
use Artisan;
use Modules\UserManagementSystem\Models\User;

class VerifyMentors extends Command
{
    protected $signature = 'mentors:verify';
    protected $description = 'Ensures all active students have mentors and recalculates mentor totals';

    public function handle(MentorService $mentorService): bool
    {
        $this->EnsureActiveUsersHaveMentors($mentorService);
        Artisan::call('mentors:recalculateTotals', outputBuffer: $this->output);
        return true;
    }

    public function EnsureActiveUsersHaveMentors(MentorService $mentorService): void
    {
        $this->info("Ensure Active Users have Mentors");
        $query = User::query()->with('mentorStudent')->with('mentorStudent.mentor');

        $n = 0;
        $this->withProgressBarChunked($query, function (User $user) use ($mentorService, &$n, &$updated) {
            $result = $mentorService->ensureMentorState($user);
            if ($result == EnsureMentorResult::MentorAssigned) {
                $n++;
            }
        });
        $this->info("$n student mentors assigned.");
    }
}
