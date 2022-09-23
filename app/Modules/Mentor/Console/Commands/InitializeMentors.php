<?php

namespace App\Modules\Mentor\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\HelpScout\Services\HelpScoutUserService;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\EnsureMentorResult;
use App\Modules\Mentor\Services\HelpScoutMentorService;
use App\Modules\Mentor\Services\MentorService;
use App\Services\DatabaseService;
use Illuminate\Database\DatabaseManager;
use Modules\UserManagementSystem\Models\User;

class InitializeMentors extends Command
{
    protected $signature = 'mentors:init';
    protected $description = 'Run to initialize mentor system';

    public function handle(DatabaseManager        $databaseManager,
                           MentorService          $mentorService,
                           HelpScoutMentorService $helpScoutMentorService,
                           HelpScoutUserService   $helpScoutUserService
    ): bool
    {
        $this->ensureMentorsCreated($databaseManager, $mentorService);
        $success = $this->ensureGuitareoSingeoMentorsAssigned($mentorService);
        if (!$success) {
            return false;
        }
        $success = $this->ensureAllMentorsAssigned($mentorService);

        if (!$success) {
            return false;
        }

        if (app()->isProduction()) {
            $this->info("\nRegister Web Hook");
            $helpScoutMentorService->registerHelpScoutWebHook();
        }

        $this->info("\nPopulate Help Scout User Data");
        $helpScoutUserService->populateHelpScoutUserData();

        return true;
    }

    private function ensureMentorsCreated(DatabaseManager $databaseManager, MentorService $mentorService)
    {
        $connection = $databaseManager->connection('musora_laravel_mysql');
        $db = new DatabaseService($connection);

        if (!$db->tableExists('mentors')) {
            $this->info("Mentors table does not exist, run r mwp artisan migrate");
            $this->info("Failed AssignMentors!");
            return;
        }

        if (!Mentor::query()->first()) {
            $this->info("Mentors not populated.  Populate Mentor Table");

            $mentorData = collect([
                451393 => [
                    "name" => "carlos",
                    "supported_brands" => "guitareo, drumeo",
                    "maxStudents" => 6000
                ],
                451390 => [
                    "name" => "emily",
                    "supported_brands" => "singeo, pianote",
                    "maxStudents" => 6000
                ],
                403844 => [
                    "name" => "hannah",
                    "supported_brands" => "pianote, guitareo",
                    "maxStudents" => 6000
                ],
                155762 => [
                    "name" => "jenn",
                    "supported_brands" => "pianote, drumeo",
                    "maxStudents" => 4000
                ],
                361772 => [
                    "name" => "jennvo",
                    "supported_brands" => "pianote, drumeo",
                    "maxStudents" => 4000
                ],
                427608 => [
                    "name" => "jorge",
                    "supported_brands" => "drumeo, pianote",
                    "maxStudents" => 7000
                ],
                427720 => [
                    "name" => "joy",
                    "supported_brands" => "drumeo, pianote",
                    "maxStudents" => 7000
                ],
                150447 => [
                    "name" => "kaitlyn",
                    "supported_brands" => "drumeo, pianote",
                    "maxStudents" => 7000
                ],
                429774 => [
                    "name" => "veronica",
                    "supported_brands" => "drumeo, pianote",
                    "maxStudents" => 4000
                ],
                451392 => [
                    "name" => "sara",
                    "supported_brands" => "pianote, singeo",
                    "maxStudents" => 6000
                ],
            ]);
            $mentorData->each(function ($mentor, $userId) use ($mentorService) {
                $mentorService->store($userId, $mentor["supported_brands"], $mentor["maxStudents"]);
            });
        }
    }

    public function ensureGuitareoSingeoMentorsAssigned(MentorService $mentorService): bool
    {
        $this->info("Assigning Mentors (guitareo, singeo)...");
        $subQuery = Subscription::query()
            ->select('user_id')
            ->whereIn('ecommerce_subscriptions.brand', ['guitareo', 'singeo'])
            ->groupBy('user_id');
        $query = User::query()->with('mentorStudent')
            ->joinSub($subQuery, 's', function ($join) {
                $join->on('usora_users.id', '=', 's.user_id');
            });

        $n = 0;
        $success = $this->withProgressBarChunked($query, function (User $user) use ($mentorService, &$n) {
            $result = $mentorService->ensureMentorState($user);
            if ($result == EnsureMentorResult::MentorAssigned) {
                $n++;
            }
        }, timeout: 300);
        $this->info("$n mentors assigned.");
        return $success;
    }

    public function ensureAllMentorsAssigned(MentorService $mentorService): bool
    {
        $this->info("Assigning Users (guitareo, singeo)...");
        $query = User::query()->with('mentorStudent');

        $n = 0;
        $success = $this->withProgressBarChunked($query, function (User $user) use ($mentorService, &$n) {
            $result = $mentorService->ensureMentorState($user);
            if ($result == EnsureMentorResult::MentorAssigned) {
                $n++;
            }
        }, timeout: 300);
        $this->info("$n mentors assigned.");
        return $success;
    }
}
