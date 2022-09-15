<?php

namespace App\Modules\Mentor\Console\Commands;

use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Models\MentorStudent;
use App\Services\DatabaseServiceProvider;
use Illuminate\Console\Command;

class UnassignMentors extends Command
{

    protected $signature = 'mentors:unassign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns a mentor to each active user without one';

    public function handle()
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
