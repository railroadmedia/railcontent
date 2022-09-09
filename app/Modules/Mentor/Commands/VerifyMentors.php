<?php

namespace App\Modules\Mentor\Commands;


use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Models\MentorStudent;
use App\Modules\Mentor\Services\MentorService;
use Modules\UserManagementSystem\Models\User;

class VerifyMentors extends Command
{
    protected $signature = 'mentors:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run to initialize mentor system';
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
        $this->VerifyStudentMentors();
        $this->VerifyMentorCounts();
        return true;
    }

    public function EnsureActiveUsersHaveMentors(): void
    {
        $this->info("Ensure Active Users have Mentors");
        $query = User::query()->with('mentorStudent');

        $n = 0;
        $this->withProgressBarChunked($query, function (User $user) use (&$n) {
            $result = $this->mentorService->ensureMentorState($user);
            if ($result > 0) {
                $n++;
            }
        });
        $this->info("$n students updated.");
    }

    public function VerifyStudentMentors()
    {
        $query = MentorStudent::query()->with('user');

        $n = 0;
        $this->withProgressBarChunked($query, function (User $user) use (&$n) {
            $result = $this->mentorService->ensureMentorState($user);
            if ($result > 0) {
                $n++;
            }
        });
        $this->info("$n students updated.");
    }

    private function VerifyMentorCounts()
    {
        $count = Mentor::query()->count();
        $this->info("\nVerifying $count Mentors");

        $flagged = [];
        $bar = $this->output->createProgressBar($count);
        Mentor::query()->chunk(100, function ($mentors) use (&$flagged, $bar) {
            /* @var Mentor $mentor */
            foreach ($mentors as $mentor) {
                $total = MentorStudent::query()->where('mentor_user_id', '=', $mentor->user_id)->count();
                $totalActive = MentorStudent::query()->where('mentor_user_id', '=', $mentor->user_id)
                    ->where('active', '=', 1)->count();

                if ($total != $mentor->total_student_count) {
                    $flagged[$mentor->user_id] = $mentor->user_id;
                    $this->info(
                        "Updating mentor $mentor->user_id total count from $mentor->total_student_count to $total"
                    );
                    $mentor->total_student_count = $total;
                    $mentor->save();
                }
                if ($totalActive != $mentor->active_student_count) {
                    $flagged[$mentor->user_id] = $mentor->user_id;
                    $this->info(
                        "Updating mentor $mentor->user_id total count from $mentor->active_student_count to $totalActive"
                    );
                    $mentor->active_student_count = $totalActive;
                    $mentor->save();
                }
                $bar->advance();
            }
        });

        $countFlagged = count($flagged);
        $this->info("$countFlagged records flagged.");
    }
}
