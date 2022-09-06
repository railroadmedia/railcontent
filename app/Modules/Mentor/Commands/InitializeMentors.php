<?php

namespace App\Modules\Mentor\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\HelpScout\Services\HelpScoutUserService;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\EnsureMentorResult;
use App\Modules\Mentor\Services\HelpScoutMentorService;
use App\Modules\Mentor\Services\MentorService;
use App\Services\DatabaseService;
use App\Services\DatabaseServiceProvider;
use Illuminate\Database\DatabaseManager;
use Modules\UserManagementSystem\Models\User;

class InitializeMentors extends Command
{
    protected $signature = 'mentors:init';
    protected $description = 'Run to initialize mentor system';

    private MentorService $mentorService;
    private HelpScoutMentorService $helpScoutMentorService;
    private HelpScoutUserService $helpScoutUserService;

    public function __construct(
        MentorService $mentorService,
        HelpScoutMentorService $helpScoutMentorService,
        HelpScoutUserService $helpScoutUserService
    ) {
        parent::__construct();
        $this->mentorService = $mentorService;
        $this->helpScoutMentorService = $helpScoutMentorService;
        $this->helpScoutUserService = $helpScoutUserService;
    }

    public function handle(DatabaseManager $databaseManager): bool
    {
        $this->ensureMentorsCreated($databaseManager);
        $this->ensureGuitareoSingeoMentorsAssigned();
        $this->ensureOtherMentorsAssigned();

        if (app()->isProduction()) {
            $this->info("\nRegister Web Hook");
            $this->helpScoutMentorService->registerHelpScoutWebHook();
        }

        $this->info("\nPopulate Help Scout User Data");
        $this->helpScoutUserService->populateHelpScoutUserData();

        return true;
    }

    private function ensureMentorsCreated(DatabaseManager $databaseManager)
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
                    "name" => "sara",
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
            $mentorData->each(function ($mentor, $userId) {
                $this->mentorService->store($userId, $mentor["supported_brands"], $mentor["maxStudents"]);
            });
        }
    }

    public function ensureGuitareoSingeoMentorsAssigned(): void
    {
        $this->info("Assigning Mentors (guitareo, singeo)...");
        $query = User::query()->with('mentorStudent')
            ->join('ecommerce_subscriptions', 'ecommerce_subscriptions.user_id', '=', 'usora_users.id')
            ->whereIn('ecommerce_subscriptions.brand', ['guitareo', 'singeo'])
            ->select('usora_users.*');

        $n = 0;
        $this->withProgressBarChunked($query, function (User $user) use (&$n) {
            $result = $this->mentorService->ensureMentorState($user);
            if ($result == EnsureMentorResult::MentorAssigned) {
                $n++;
            }
        });
        $this->info("$n mentors assigned.");
    }

    public function ensureOtherMentorsAssigned(): void
    {
        $this->info("Assigning Users (guitareo, singeo)...");
        $query = User::query()->with('mentorStudent')
            ->join('ecommerce_subscriptions', 'ecommerce_subscriptions.user_id', '=', 'usora_users.id')
            ->whereNotIn('ecommerce_subscriptions.brand', ['guitareo', 'singeo'])
            ->select('usora_users.*');

        $n = 0;
        $this->withProgressBarChunked($query, function (User $user) use (&$n) {
            $result = $this->mentorService->ensureMentorState($user);
            if ($result == EnsureMentorResult::MentorAssigned) {
                $n++;
            }
        });
        $this->info("$n mentors assigned.");
    }
}
