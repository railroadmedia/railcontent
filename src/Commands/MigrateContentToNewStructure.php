<?php

namespace Railroad\Railcontent\Commands;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Console\Command;


class MigrateContentToNewStructure extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migrateContentToNewStructure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate contents from old structure to new structure';

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle()
    {
        $this->info('Starting MigrateContentToNewStructure.');
        $this->call('command:migrateUserPlaylists');
        $this->call('command:deleteOldContentForPlaylist');
        $this->call('command:migrateFields');
        $this->call('command:migrateContentColumns');
        $this->call('command:migrateInstructors');
        $this->call('command:migrateVideos');
        $this->call('command:migrateStyles');
        $this->call('command:deleteOrphanContent');
        $this->call('command:calculateTotalXP');
        $this->call('command:MigrateContentToElasticsearch');

        $this->info('Finished MigrateContentToNewStructure.');
    }
}