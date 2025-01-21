<?php

namespace App\Modules\Mentor\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Services\EnsureMentorResult;
use App\Modules\Mentor\Services\MentorService;
use App\Modules\UserManagementSystem\Services\UserService;
use Artisan;
use Modules\UserManagementSystem\Models\User;

class VerifyMentors extends Command
{
    protected $signature = 'mentors:verify {userId=0}';
    protected $description = 'Ensures all active students have mentors and recalculates mentor totals';

    public function handle(UserService $userService, MentorService $mentorService): void
    {
        $this->info("Processing $this->name");
        $timeStart = microtime(true);

        $userId = $this->argument('userId');
        if (!$userId) {
            $this->EnsureActiveUsersHaveMentors($mentorService);
            Artisan::call('mentors:recalculateTotals', outputBuffer: $this->output);
        } else {
            $this->info("Ensure Active User has Mentor");
            $user = $userService->getByIdOrNull($userId);
            if ($user) {
                $mentorService->ensureMentorState($user);
            }
        }
        $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        $this->info("Finished $this->name ($sec s)");
    }

    public function EnsureActiveUsersHaveMentors(MentorService $mentorService): void
    {
        $this->info("Ensure All Active Users have Mentors");
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
