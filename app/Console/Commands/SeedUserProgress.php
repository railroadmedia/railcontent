<?php

namespace App\Console\Commands;

use App\Maps\ContentTypes;
use App\Modules\Brand\Enums\Brand;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;

class SeedUserProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SeedUserProgress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates user content progress for workouts testing.';


    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $userID = $this->ask('What is the user ID?');
        $workoutID = $this->ask('What is the workout ID?');

        $dbConnection = DB::connection(config('railcontent.database_connection_name'));
        $dbConnection->table('railcontent_user_content_progress')
            ->updateOrInsert([
                                 'content_id' => $workoutID,
                                 'user_id' => $userID,
                                 'state' => 'started',
                                 'progress_percent' => rand(1, 90),
                                 'higher_key_progress' => null,
                                 'updated_on' => Carbon::now()->toDateTimeString(),
                                 'started_on' => Carbon::now()->toDateTimeString(),
                                 'completed_on' => null,
                             ]);
        $this->info('User progress seeded successfully.');
        return true;
    }


}
