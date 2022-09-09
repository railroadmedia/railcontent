<?php

namespace App\Modules\Mentor\Commands;

use App\Modules\HelpScout\Services\HelpScoutUserService;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\HelpScoutMentorService;
use App\Modules\Mentor\Services\MentorService;
use App\Services\DatabaseService;
use App\Services\DatabaseServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Ecommerce\Services\DateTimeService;

class InitializeMentors extends Command
{
    protected $signature = 'mentors:init';

    /**
     * The console command description.
     *
     * @var string
     */
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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $this->assignMentors($databaseManager);

        if (app()->isProduction()) {
            $this->info("\nRegister Web Hook");
            $this->helpScoutMentorService->registerHelpScoutWebHook();
        }

        $this->info("\nPopulate Help Scout User Data");
        $this->helpScoutUserService->populateHelpScoutUserData();

        return true;
    }

    private function assignMentors(DatabaseManager $databaseManager)
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

        $active_users = collect(
            $connection->select(
                "select u.id FROM usora_users u
            inner join (
                select user_id, max(paid_until) as paid_until
                from ecommerce_subscriptions where brand in ('guitareo', 'singeo') group by user_id) s on s.user_id = u.id
            where NOT EXISTS(select * FROM user_roles
                                      WHERE role = 'administrator'
                                        and user_id = u.id)
                AND s.paid_until >= DATE_ADD(NOW(), INTERVAL -30 DAY)
                AND NOT EXISTS(select * FROM mentor_students where user_id = u.id);"
            )
        );
        $this->info("\nFound {$active_users->count()} active subscription unassigned users (guitareo, singeo)");
        $this->info("Assigning Users (guitareo, singeo)...");
        $this->withProgressBar($active_users, function ($user) {
            try {
                $this->mentorService->assignMentor($user->id);
            } catch (Exception $exception) {
                $this->info("Unable to assign assign mentor to user {$user->id}");
            }
        });



        $active_users = collect(
            $connection->select(
                "select u.id FROM usora_users u
            inner join (
                select user_id, max(paid_until) as paid_until
                from ecommerce_subscriptions group by user_id) s on s.user_id = u.id
            where NOT EXISTS(select * FROM user_roles
                                      WHERE role = 'administrator'
                                        and user_id = u.id)
                AND s.paid_until >= DATE_ADD(NOW(), INTERVAL -30 DAY)
                AND NOT EXISTS(select * FROM mentor_students where user_id = u.id);"
            )
        );
        $this->info("\nFound {$active_users->count()} active subscription unassigned users (drumeo, pianote)");
        $this->info("Assigning Users (drumeo, pianote)...");
        $this->withProgressBar($active_users, function ($user) {
            try {
                $this->mentorService->assignMentor($user->id);
            } catch (Exception $exception) {
                $this->info("Unable to assign assign mentor to user {$user->id}");
            }
        });


        $active_users = collect(
            $connection->select(
                "SELECT u.id FROM usora_users u
            inner join (
                select user_id, max(expiration_date) as expiration_date from ecommerce_user_products group by user_id
            ) up on up.user_id = u.id
            where NOT EXISTS(select * FROM user_roles
                                      WHERE role = 'administrator'
                                        and user_id = u.id)
                AND up.expiration_date >= DATE_ADD(NOW(), INTERVAL -30 DAY)
                AND NOT EXISTS(select * FROM mentor_students where user_id = u.id);"
            )
        );
        $this->info("\nFound {$active_users->count()} unassigned users with active user products");
        $this->info("Assigning Users...");
        $this->withProgressBar($active_users, function ($user) {
            try {
                $this->mentorService->assignMentor($user->id);
            } catch (Exception $exception) {
                $this->info("Unable to assign assign mentor to user {$user->id}");
            }
        });
    }
}
