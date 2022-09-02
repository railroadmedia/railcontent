<?php

namespace App\Modules\Mentor\Commands;


use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Models\MentorStudent;
use App\Modules\Mentor\Services\MentorService;
use App\Services\DatabaseServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
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
    public function handle(DatabaseManager $databaseManager)
    {
        $this->EnsureActiveUsersHaveMentors();
        $this->VerifyStudentMentors();
        $this->VerifyMentorCounts();
        return true;
    }

    public function EnsureActiveUsersHaveMentors()
    {
        $count = User::query()->count();
        $this->info("\nEnsure Active Users have Mentors");
        $this->info("Processing $count Users ");
        $flagged = [];
        $bar = $this->output->createProgressBar($count);
        $bar->setFormat('debug');

        User::query()->chunk(100, function ($users) use (&$flagged, $bar) {
            foreach ($users as $user) {
                if (!$this->mentorService->validateMentorState($user->id)) {
                    $this->info($user->id);
                    $flagged[$user->id] = $user->id;
                }
                $bar->advance();
            }
        });

        $countFlagged = count($flagged);
        $this->info("$countFlagged records flagged.");

        if ($countFlagged > 0) {
            $this->info("Fixing flagged records.");
            $this->withProgressBar($flagged, function($userId){
                $this->mentorService->ensureMentorState($userId);
            });
        }

        $this->info("Finished processing");
    }

    public function VerifyStudentMentors()
    {
        $count = MentorStudent::query()->count();
        $this->info("\nVerifying $count Active Students");
        $flagged = [];
        $bar = $this->output->createProgressBar($count);
        MentorStudent::query()->chunk(100, function ($students) use (&$flagged, $bar) {
            foreach ($students as $student) {
                if (!$this->mentorService->validateMentorState($student->user_id)) {
                    $flagged[$student->user_id] = $student->user_id;
                };
                $bar->advance();
            }
        });

        $countFlagged = count($flagged);
        $this->info("$countFlagged records flagged.");

        if ($countFlagged > 0) {
            $this->info("Fixing flagged records.");
            $this->withProgressBar($flagged, function($userId){
                $this->mentorService->ensureMentorState($userId);
            });
        }
        return $flagged;
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
