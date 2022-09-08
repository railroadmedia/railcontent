<?php

namespace App\Modules\Mentor\Console\Commands;


use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Services\MentorService;
use Artisan;
use Modules\UserManagementSystem\Models\User;

class VerifyMentors extends Command
{
    protected $signature = 'mentors:verify';
    protected $description = 'Ensures all active students have mentors and recalculates mentor totals';
    private MentorService $mentorService;

    public function __construct(
        MentorService $mentorService,
    ) {
        parent::__construct();
        $this->mentorService = $mentorService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->EnsureActiveUsersHaveMentors();
        Artisan::call('mentors:recalculateTotals', outputBuffer: $this->output);
        return true;
    }

    public function EnsureActiveUsersHaveMentors(): void
    {
        $this->info("Ensure Active Users have Mentors");
        $query = User::query()->with('mentorStudent')->with('mentorStudent.mentor')->where('id', '=', '158525');

        $n = 0;
        $updated = [];
        $this->withProgressBarChunked($query, function (User $user) use (&$n, &$updated) {
            $result = $this->mentorService->ensureMentorState($user);
            if ($result > 0) {
                $n++;
                $updated[$user->id]->$user->id;
            }
        });
        $this->info("$n student mentors assigned.");
        var_dump($updated);
    }
}
