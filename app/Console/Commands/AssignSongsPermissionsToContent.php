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
                'name' => 'Musora Only Songs Membership',
                'brand' => 'musora',
            ]);

        $musoraOnlySongsMembershipPermissionId =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Musora Only Songs Membership',
                    'brand' => 'musora',
                ])
                ->first()
                ->id;

        $this->musoraDB()->from('railcontent_permissions')
            ->updateOrInsert([
                'name' => 'Drumeo Lifetime Member',
                'brand' => 'drumeo',
            ]);

        $drumeoLifetimeMembershipPermissionId =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Drumeo Lifetime Member',
                    'brand' => 'drumeo',
                ])
                ->first()
                ->id;

        $legacyDrumeoBrandPermission =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Drumeo Edge',
                    'brand' => 'drumeo',
                ])
                ->first()
                ->id;

        $legacyPianoteBrandPermission =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Pianote Membership',
                    'brand' => 'pianote',
                ])
                ->first()
                ->id;

        $legacyGuitareoBrandPermission =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Guitareo Membership',
                    'brand' => 'guitareo',
                ])
                ->first()
                ->id;

        $legacySingeoBrandPermission =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Singeo Membership',
                    'brand' => 'singeo',
                ])
                ->first()
                ->id;

        $this->info("musoraBasicMembershipPermissionId: $musoraBasicMembershipPermissionId");
        $this->info("musoraPlusMembershipPermissionId: $musoraPlusMembershipPermissionId");
        $this->info("musoraOnlySongsMembershipPermissionId: $musoraOnlySongsMembershipPermissionId");
        $this->info("drumeoLifetimeMembershipPermissionId: $drumeoLifetimeMembershipPermissionId");
        $this->info("legacyDrumeoBrandPermission: $legacyDrumeoBrandPermission");
        $this->info("legacyPianoteBrandPermission: $legacyPianoteBrandPermission");
        $this->info("legacyGuitareoBrandPermission: $legacyGuitareoBrandPermission");
        $this->info("legacySingeoBrandPermission: $legacySingeoBrandPermission");

        $this->info('Permissions created successfully. Adding to content...');
        $this->info('Starting to add permissions to content...');

        $createdCount = 0;

        // pianote, guitareo, singeo- plus, song only
        $this->musoraDB()->from('railcontent_content')
            ->select(['id', 'brand'])
            ->where('type', 'song')
            ->whereIn('brand', ['pianote', 'guitareo', 'singeo', 'drumeo'])
            ->orderBy('id', 'asc')
            ->chunk(
                250,
                function (Collection $songContentIdRows) use (
                    $legacySingeoBrandPermission,
                    $legacyGuitareoBrandPermission,
                    $legacyPianoteBrandPermission,
                    $legacyDrumeoBrandPermission,
                    $musoraOnlySongsMembershipPermissionId,
                    $musoraPlusMembershipPermissionId,
                    &$createdCount,
                    $drumeoLifetimeMembershipPermissionId
                ) {
                    $songContentIds = $songContentIdRows->pluck('id')->toArray();

                    $songsContentPermissions = $this->musoraDB()->from('railcontent_content_permissions')
                        ->whereIn('content_id', $songContentIds)
                        ->get()
                        ->groupBy('content_id');

                    foreach ($songContentIdRows as $songContentIdRow) {
                        $songContentId = $songContentIdRow->id;
                        $songContentPermissions = $songsContentPermissions[$songContentId] ?? [];

                        // musora plus permission
                        $hasMusoraPlusPermission = false;

                        foreach ($songContentPermissions as $songContentPermission) {
                            if ($songContentPermission->permission_id == $musoraPlusMembershipPermissionId) {
                                $hasMusoraPlusPermission = true;
                            }
                        }

                        if (!$hasMusoraPlusPermission) {
                            $this->musoraDB()->from('railcontent_content_permissions')
                                ->updateOrInsert([
                                    'content_id' => $songContentId,
                                    'content_type' => null,
                                    'permission_id' => $musoraPlusMembershipPermissionId,
                                    'brand' => 'musora',
                                ]);
                        }

                        // musora songs only permission
                        $hasMusoraSongsOnlyPermission = false;

                        foreach ($songContentPermissions as $songContentPermission) {
                            if ($songContentPermission->permission_id == $musoraOnlySongsMembershipPermissionId) {
                                $hasMusoraSongsOnlyPermission = true;
                            }
                        }

                        if (!$hasMusoraSongsOnlyPermission) {
                            $this->musoraDB()->from('railcontent_content_permissions')
                                ->updateOrInsert([
                                    'content_id' => $songContentId,
                                    'content_type' => null,
                                    'permission_id' => $musoraOnlySongsMembershipPermissionId,
                                    'brand' => 'musora',
                                ]);
                        }

                        // if drumeo, add drumeo lifetime permission
                        if ($songContentIdRow->brand == 'drumeo') {
                            $hasDrumeoLifetimePermission = false;

                            foreach ($songContentPermissions as $songContentPermission) {
                                if ($songContentPermission->permission_id == $drumeoLifetimeMembershipPermissionId) {
                                    $hasDrumeoLifetimePermission = true;
                                }
                            }

                            if (!$hasDrumeoLifetimePermission) {
                                $this->musoraDB()->from('railcontent_content_permissions')
                                    ->updateOrInsert([
                                        'content_id' => $songContentId,
                                        'content_type' => null,
                                        'permission_id' => $drumeoLifetimeMembershipPermissionId,
                                        'brand' => 'drumeo',
                                    ]);
                            }
                        }

                        // add legacy brand permission for free 30 days of access (todo: remove for next run)
                        $legacyBrandPermissionToAdd = 'drumeo';

                        if ($songContentIdRow->brand == 'drumeo') {
                            $legacyBrandPermissionToAdd = $legacyDrumeoBrandPermission;
                        } elseif ($songContentIdRow->brand == 'pianote') {
                            $legacyBrandPermissionToAdd = $legacyPianoteBrandPermission;
                        } elseif ($songContentIdRow->brand == 'guitareo') {
                            $legacyBrandPermissionToAdd = $legacyGuitareoBrandPermission;
                        } elseif ($songContentIdRow->brand == 'singeo') {
                            $legacyBrandPermissionToAdd = $legacySingeoBrandPermission;
                        }

                        $this->musoraDB()->from('railcontent_content_permissions')
                            ->updateOrInsert([
                                'content_id' => $songContentId,
                                'content_type' => null,
                                'permission_id' => $legacyBrandPermissionToAdd,
                                'brand' => $songContentIdRow->brand,
                            ]);
                    }

                    $createdCount += 250;
                    $this->info($createdCount . ' done pianote, guitareo, singeo');
                }
            );


        $this->info('Done AssignSongsPermissionsToContent!');
        $createdCount = 0;

        return 0;
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
    }
}
