<?php

namespace App\Console\Commands;

use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\MentorService;
use App\Services\DatabaseService;
use App\Services\DatabaseServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Modules\Mentor\Controllers\MentorController;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\OrderRepository;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Services\DateTimeService;
use Railroad\Ecommerce\Services\UserProductService;
use Request;

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
private $mentorService;

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
        $this->info("Starting AssignMentors.");
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
//                451393 => ["name" => "Carlos Borges", "supported_brand" => "Pianote"],
//                360053 => ["name" => "Job Byers", "supported_brand" => "Guitareo"],
                154064 => ["name" => "Celina Kathler", "supported_brand" => "Pianote, Drumeo"]
            ]);
            $mentorData->each(function ($mentor, $userId) {
                $this->mentorService->store($userId);
            });
        }

        $active_users = collect($connection->select(
            "select u.id FROM usora_users u
            inner join (
                select user_id, max(paid_until) as paid_until
                from ecommerce_subscriptions group by user_id) s on s.user_id = u.id
            where s.paid_until >= DATE_ADD(NOW(), INTERVAL -30 DAY) and NOT EXISTS(select * FROM mentor_students where user_id = u.id);"));
        $this->info("Found {$active_users->count()} active unassigned users");

        $active_users->each(function ($user) {
            $this->mentorService->autoAssignMentor($user->id);
        });


        $this->info("---------------------------------------------------");
        $this->info("Finished AssignMentors!");

        return true;
    }
}
