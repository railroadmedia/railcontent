<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Events\ContentCreated;

class RepairBrokenAssignmentsJan2023 extends Command
{
    protected $signature = 'RepairBrokenAssignmentsJan2023';

    protected $description = 'Fix overwritten assignments from last 2 song imports from 24.01.23 and 30.12.22';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $this->info('###### Starting RepairBrokenAssignmentsJan2023...  ######');

        $dbConnection = DB::connection(config('railcontent.database_connection_name'));

        $brokenAssignmentIds = [222506, 222507, 222508, 222509, 206459, 369941,
            365278, 363344, 366180, 203055, 365282, 276861, 366917];

        $nrOfHierarchyRows = $dbConnection->table('railcontent_content_hierarchy')
            ->whereIn('child_id', $brokenAssignmentIds)
            ->where('created_on', '>', '2022-12-30 00:00:00')
            ->count()
        ;

        if ($nrOfHierarchyRows != count($brokenAssignmentIds)) {
            die("Number of hierarchy rows is " . $nrOfHierarchyRows . " and it is wrong. Check the data");
        }

        /* Unset the old assignments from the new added songs */
        $dbConnection->table('railcontent_content_hierarchy')
            ->whereIn('child_id', $brokenAssignmentIds)
            ->where('created_on', '>', '2022-12-30 00:00:00')
            ->delete();

        //289426  -> was already modified by a publisher
        $correctSoundSlices = [
            222506 => '203234',
            222507 => '222507',
            222508 => '203238',
            222509 => '203239',
            206459 => '163650',
            369941 => null,
            365278 => null,
            363344 => '2JXkc',
            366180 => null,
            203055 => '159419',
            365282 => null,
            276861 => null,
            366917 => null,
        ];


        foreach($correctSoundSlices as $contentId => $correctSoundSlice) {

            if ($correctSoundSlice === null) {
                $dbConnection->table('railcontent_content_fields')
                    ->where('content_id', $contentId)
                    ->where('key', 'soundslice_slug')
                    ->delete();
            } else {
                $dbConnection->table('railcontent_content_fields')
                    ->where('content_id', $contentId)
                    ->where('key', 'soundslice_slug')
                    ->update(['value' => $correctSoundSlice]);
            }

            event(new ContentCreated($contentId));
        }

        $this->info('###### Command RepairBrokenAssignmentsJan2023 has finished ###### ');

    }

}
