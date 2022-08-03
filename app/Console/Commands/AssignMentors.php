<?php

namespace App\Console\Commands;

use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\MentorService;
use App\Services\DatabaseService;
use App\Services\DatabaseServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Ecommerce\Services\DateTimeService;

class AssignMentors extends Command
{

    protected $name = 'AssignMentors';

    protected $signature = 'AssignMentors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns a mentor to each active user without one';
    private MentorService $mentorService;

    public function __construct(MentorService $mentorService)
    {
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
                451393 => ["name" => "Carlos Borges", "supported_brands" => "pianote", "maxStudents" => 5000],
                451394 => ["name" => "Carlos Borges2", "supported_brands" => "pianote", "maxStudents" => 2500],
                360053 => ["name" => "Job Byers", "supported_brands" => "guitareo", "maxStudents" => 5000],
                154064 => ["name" => "Celina Kathler", "supported_brands" => "pianote, drumeo", "maxStudents" => 5000],
                154065 => ["name" => "Celina Kathler2", "supported_brands" => "singeo", "maxStudents" => 5000]
            ]);
            $mentorData->each(function ($mentor, $userId) {
                $this->mentorService->store($userId, $mentor["supported_brands"], $mentor["maxStudents"]);
            });
        }

        $active_users = collect($connection->select(
            "select u.id FROM usora_users u
            inner join (
                select user_id, max(paid_until) as paid_until
                from ecommerce_subscriptions group by user_id) s on s.user_id = u.id
            where NOT EXISTS(select * FROM user_roles WHERE role = 'administrator' and user_id = u.id) AND
                  s.paid_until >= DATE_ADD(NOW(), INTERVAL -30 DAY) AND
                  NOT EXISTS(select * FROM mentor_students where user_id = u.id);"));
        $this->info("Found {$active_users->count()} active unassigned users");
        $this->info("Assigning Users...");
        $this->withProgressBar($active_users, function ($user) {
            $this->mentorService->assignMentor($user->id);
        });
        return true;
    }
}
