<?php

namespace App\Modules\Mentor\Console\Commands;

use App\Modules\Mentor\Services\MentorService;
use Illuminate\Console\Command;

class ReassignStudents extends Command
{
    protected $signature = 'mentors:reassignRandom {mentorUserId} {nStudents}';
    protected $description = 'Unassign n random students from the mentor provided. If you wish to reassign them to specific mentors adjust the max student capacities appropriately beforehand';

    public function handle(MentorService $mentorService)
    {
        $mentorUserId = $this->argument('mentorUserId');
        $nStudents = $this->argument('nStudents');
        $this->info("Reassigning $nStudents random students from mentor $mentorUserId");
        $mentorService->reassignRandomStudents($mentorUserId, $nStudents);
    }
}
