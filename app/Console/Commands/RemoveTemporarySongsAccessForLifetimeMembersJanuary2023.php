<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class RemoveTemporarySongsAccessForLifetimeMembersJanuary2023 extends Command
{
    # remove-temporary-songs-access-for-lifetime-members
    protected $name = 'RemoveTemporarySongsAccessForLifetimeMembersJanuary2023';

    protected $signature = 'RTSAFLM {revert?}';
    protected $description = 'Remove temporary songs access for lifetime members, to run a single time in January 2023';

    private $connection;

    public function handle(
        DatabaseManager $databaseManager,
    ) {
        $this->info('Starting');

        $connection = $databaseManager->connection('musora_laravel_mysql');
        $this->connection = $connection;

        if($this->argument('revert') === 'revert') {
            $this->revert();
            return true;
        }

        $permissionIdsToRemoveFromSongs = $this->permissionIdsToRemoveFromSongs();

        foreach (['drumeo', 'pianote', 'guitareo', 'singeo'] as $brand) {

            $songContentIdsForBrand = $connection->table('railcontent_content')
                ->where('type', 'song')
                ->where('brand', $brand)
                ->get('id')
                ->pluck('id')
                ->toArray();

            try {
                $connection->table('railcontent_content_permissions')
                    ->whereIn('content_id', $songContentIdsForBrand)
                    ->whereIn('permission_id', $permissionIdsToRemoveFromSongs)
                    ->delete();
                $this->info($this->name . ' successfully completed delete action for ' . $brand);
            } catch (\Throwable $t) {
                $this->info('error when attempting to delete railcontent_content_permissions rows for brand ' . $brand . '.  message is "' . $t->getMessage() . '"');
                dump($t);
            }
        }
    }

    private function revert()
    {

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         select id from pre_production_musora_laravel.railcontent_content where `type` = 'song' and id NOT IN (
            SELECT content_id FROM pre_production_musora_laravel.railcontent_content_permissions where 1
            and permission_id in (select id from pre_production_musora_laravel.railcontent_permissions where name in ('Drumeo Edge','Pianote Membership','Guitareo Membership','Singeo Membership'))
            and content_id in (
            select id from pre_production_musora_laravel.railcontent_content where `type` = 'song'
            )
        )
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

        $brandToPermissionName = [
            'drumeo' => 1, #drumeo
            'pianote' => 77, #pianote
            'guitareo' => 52, #guitareo
            'singeo' => 73, #singeo
        ];

        foreach ($brandToPermissionName as $brand => $permissionId) {
            try {
                $songContentIdsForBrand = $this->connection->table('railcontent_content')
                    ->where('type', 'song')
                    ->where('brand', $brand)
                    ->get('id')
                    ->pluck('id')
                    ->toArray();

                foreach($songContentIdsForBrand as $songId) {
                    $this->connection->table('railcontent_content_permissions')->insert([
                        'content_id'=> $songId,
                        'permission_id' => $permissionId
                    ]);
                }
            } catch (\Throwable $t) {
                $this->info('error when attempting to delete railcontent_content_permissions rows for brand ' . $brand . '.  message is "' . $t->getMessage() . '"');
                dump($t);
            }
        }
    }

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        query:
            SELECT id, name FROM `railcontent_permissions` where id in (1, 52, 77, 73);

        returns:
            id	|   name
            ----|------------------
            1	|   Drumeo Edge
            52	|   Guitareo Membership
            73	|   Singeo Membership
            77	|   Pianote Membership
    * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
    private function permissionIdsToRemoveFromSongs()
    {
        return $this->connection->table('railcontent_permissions')
            ->whereIn('name', [
                'Drumeo Edge',
                'Pianote Membership',
                'Guitareo Membership',
                'Singeo Membership',
            ])
            ->get('id')
            ->pluck('id')
            ->toArray();
    }

    /*
     * Debugging aid
     */
    private function squish($array)
    {
        $string = '';
        foreach($array as $value){
            $string = $string . $value . ',';
        }
        return '   ' . substr($string, 0, -1) . '   ';
    }
}
