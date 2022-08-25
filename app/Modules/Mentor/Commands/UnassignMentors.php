<?php

namespace App\Modules\Mentor\Commands;

use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Models\MentorStudent;
use App\Modules\Mentor\Services\MentorService;
use App\Services\DatabaseServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Ecommerce\Services\DateTimeService;

class UnassignMentors extends Command
{

    protected $name = 'UnassignMentors';

    protected $signature = 'UnassignMentors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns a mentor to each active user without one';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager)
    {

        MentorStudent::query()->delete();
        Mentor::query()->delete();

//        foreach(Mentor::all() as $mentor){
//            $mentor->active_student_count = 0;
//            $mentor->save();
//        }

        $this->info("Unassigned all Mentors.");
    }
}
