<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunMWPPhaseOneLaunchMigrations extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'RunMWPPhaseOneLaunchMigrations';

    protected $signature = 'RunMWPPhaseOneLaunchMigrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RunMWPPhaseOneLaunchMigrations';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting RunMWPPhaseOneLaunchMigrations.');
        $this->info('This will take 15-30 minutes...');

        $this->info('Starting command:migrateUserPlaylists...');
        $this->call('command:migrateUserPlaylists');

        $this->info('Starting command:deleteOldContentForPlaylist...');
        $this->call('command:deleteOldContentForPlaylist');

        $this->info('Starting command:migrateFields...');
        $this->call('command:migrateFields');

        $this->info('Starting command:migrateContentColumns...');
        $this->call('command:migrateContentColumns');

        $this->info('Starting command:migrateVideos...');
        $this->call('command:migrateVideos');

//        $this->info('Starting command:MigrateContentToElasticsearch...');
//        $this->call('command:MigrateContentToElasticsearch');

        $this->info('Starting CleanMetadata...');
        $this->call('CleanMetadata');

        $this->info('Starting CleanContentTopicsAndStyles...');
        $this->call('CleanContentTopicsAndStyles');

        $this->info('Starting FillContentParentContentDataColumnFromHierarchy...');
        $this->call('FillContentParentContentDataColumnFromHierarchy');

        $this->info('Starting SyncContentRowFromRelatedTables...');
        $this->call('SyncContentRowFromRelatedTables', ['contentId' => 'all']);

        $this->info('---------------------------------------------------');
        $this->info('Finished RunMWPPhaseOneLaunchMigrations!');

        return true;
    }
}
