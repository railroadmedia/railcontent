<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;


class AssignSongsPermissionsToContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AssignSongsPermissionsToContent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AssignSongsPermissionsToContent';


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
        $this->info('Starting AssignSongsPermissionsToContent...');

        $this->musoraDB()->from('railcontent_permissions')
            ->updateOrInsert([
                'name' => 'Musora Basic Membership',
                'brand' => 'musora',
            ]);

        $musoraBasicMembershipPermissionId =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Musora Basic Membership',
                    'brand' => 'musora',
                ])
                ->first()
                ->id;

        $this->musoraDB()->from('railcontent_permissions')
            ->updateOrInsert([
                'name' => 'Musora Plus Membership',
                'brand' => 'musora',
            ]);

        $musoraPlusMembershipPermissionId =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Musora Plus Membership',
                    'brand' => 'musora',
                ])
                ->first()
                ->id;

        $this->musoraDB()->from('railcontent_permissions')
            ->updateOrInsert([
                'name' => 'Drumeo Songs Access',
                'brand' => 'drumeo',
            ]);

        $drumeoSongsMembershipPermissionId =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Drumeo Songs Access',
                    'brand' => 'drumeo',
                ])
                ->first()
                ->id;

        $this->info("musoraBasicMembershipPermissionId: $musoraBasicMembershipPermissionId");
        $this->info("musoraPlusMembershipPermissionId: $musoraPlusMembershipPermissionId");
        $this->info("drumeoSongsMembershipPermissionId: $drumeoSongsMembershipPermissionId");

        $this->info('Permissions created successfully. Adding to content...');
        $createdCount = 0;

        // drumeo
        $this->musoraDB()->from('railcontent_content')
            ->select(['id'])
            ->where('type', 'song')
            ->where('brand', 'drumeo')
            ->orderBy('id', 'asc')
            ->chunk(250, function(Collection $drumeoSongContentIds) use ($musoraPlusMembershipPermissionId, &$createdCount, $drumeoSongsMembershipPermissionId) {
                $drumeoSongContentIds = $drumeoSongContentIds->pluck('id')->toArray();

                $drumeoSongsContentPermissions = $this->musoraDB()->from('railcontent_content_permissions')
                    ->whereIn('content_id', $drumeoSongContentIds)
                    ->get()
                    ->groupBy('content_id');

                foreach ($drumeoSongContentIds as $drumeoSongContentId) {
                    $drumeoSongContentPermissions = $drumeoSongsContentPermissions[$drumeoSongContentId] ?? [];

                    // drumeo specific songs permission first
                    $hasDrumeoSongsPermission = false;

                    foreach ($drumeoSongContentPermissions as $drumeoSongContentPermission) {
                        if ($drumeoSongContentPermission->permission_id == $drumeoSongsMembershipPermissionId) {
                            $hasDrumeoSongsPermission = true;
                        }
                    }

                    if (!$hasDrumeoSongsPermission) {
                        $this->musoraDB()->from('railcontent_content_permissions')
                            ->updateOrInsert([
                                'content_id' => $drumeoSongContentId,
                                'content_type' => null,
                                'permission_id' => $drumeoSongsMembershipPermissionId,
                                'brand' => 'drumeo',
                            ]);
                    }

                    // musora songs permission first
                    $hasMusoraPlusPermission = false;

                    foreach ($drumeoSongContentPermissions as $drumeoSongContentPermission) {
                        if ($drumeoSongContentPermission->permission_id == $musoraPlusMembershipPermissionId) {
                            $hasMusoraPlusPermission = true;
                        }
                    }

                    if (!$hasMusoraPlusPermission) {
                        $this->musoraDB()->from('railcontent_content_permissions')
                            ->updateOrInsert([
                                'content_id' => $drumeoSongContentId,
                                'content_type' => null,
                                'permission_id' => $musoraPlusMembershipPermissionId,
                                'brand' => 'musora',
                            ]);
                    }
                }

                $createdCount += 250;
                $this->info($createdCount . ' done drumeo');
            });

        $this->info('Drumeo songs permissions done.');

        $this->info('Starting pianote, guitareo, singeo...');
        $createdCount = 0;

        // pianote, guitareo, singeo
        $this->musoraDB()->from('railcontent_content')
            ->select(['id'])
            ->where('type', 'song')
            ->whereIn('brand', ['pianote', 'guitareo', 'singeo'])
            ->orderBy('id', 'asc')
            ->chunk(250, function(Collection $songContentIds) use ($musoraPlusMembershipPermissionId, &$createdCount, $drumeoSongsMembershipPermissionId) {
                $songContentIds = $songContentIds->pluck('id')->toArray();

                $songsContentPermissions = $this->musoraDB()->from('railcontent_content_permissions')
                    ->whereIn('content_id', $songContentIds)
                    ->get()
                    ->groupBy('content_id');

                foreach ($songContentIds as $drumeoSongContentId) {
                    $songContentPermissions = $songsContentPermissions[$drumeoSongContentId] ?? [];

                    // musora songs permission first
                    $hasMusoraPlusPermission = false;

                    foreach ($songContentPermissions as $drumeoSongContentPermission) {
                        if ($drumeoSongContentPermission->permission_id == $musoraPlusMembershipPermissionId) {
                            $hasMusoraPlusPermission = true;
                        }
                    }

                    if (!$hasMusoraPlusPermission) {
                        $this->musoraDB()->from('railcontent_content_permissions')
                            ->updateOrInsert([
                                'content_id' => $drumeoSongContentId,
                                'content_type' => null,
                                'permission_id' => $musoraPlusMembershipPermissionId,
                                'brand' => 'musora',
                            ]);
                    }
                }

                $createdCount += 250;
                $this->info($createdCount . ' done pianote, guitareo, singeo');
            });


        $this->info('Done AssignSongsPermissionsToContent!');

        return 0;
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
    }
}
