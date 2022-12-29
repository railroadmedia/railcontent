<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;


class SeedNewSongsPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SeedNewSongsPermissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SeedNewSongsPermissions';


    /**
     * Create a new command instance.
     *
     * @param DatabaseManager $databaseManager
     * @param ContentRepository $contentRepository
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
    public function handle()
    {
        $this->info('Starting SeedNewSongsPermissions...');

        $this->musoraDB()->from('railcontent_permissions')
            ->updateOrInsert([
                'name' => 'Musora Basic Membership',
                'brand' => 'musora',
            ]);

        $this->musoraDB()->from('railcontent_permissions')
            ->updateOrInsert([
                'name' => 'Musora Plus Membership',
                'brand' => 'musora',
            ]);

        $this->musoraDB()->from('railcontent_permissions')
            ->updateOrInsert([
                'name' => 'Drumeo Songs Access',
                'brand' => 'drumeo',
            ]);

        $this->info('Done SeedNewSongsPermissions!');

        return 0;
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
    }
}
