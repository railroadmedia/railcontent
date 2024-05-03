<?php

namespace App\Modules\Mentor\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Services\EnsureMentorResult;
use App\Modules\Mentor\Services\MentorService;
use Artisan;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;

class AssignMentors extends Command
{
    protected $signature = 'mentors:assign';
    protected $description = 'Checks new users and assigns mentors if required';

    public function handle(MentorService $mentorService)
    {
        $this->info("Processing $this->name");
        $timeStart = microtime(true);

        $this->info("Ensure Active Users have Mentors");
        $query = User::query()->with('mentorStudent')->with('mentorStudent.mentor')->where(
            'created_at',
            '>',
            Carbon::now()->addHours(-2)
        );

        $n = 0;
        $this->withProgressBarChunked($query, function (User $user) use ($mentorService, &$n, &$updated) {
            $result = $mentorService->ensureMentorState($user);
            if ($result == EnsureMentorResult::MentorAssigned) {
                $n++;
            }
        });
        $this->info("$n student mentors assigned.");

        $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        $this->info("Finished $this->name ($sec s)");
    }

}
