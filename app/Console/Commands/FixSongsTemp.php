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


class FixSongsTemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FixSongsTemp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'FixSongsTemp';


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
        $this->info('Starting FixSongsTemp...');

        $drumeoMembershipId =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Drumeo Edge',
                    'brand' => 'drumeo',
                ])
                ->first()
                ->id;

        $pianoteMembershipId =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Pianote Membership',
                    'brand' => 'pianote',
                ])
                ->first()
                ->id;

        $singeoMembershipId =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Singeo Membership',
                    'brand' => 'singeo',
                ])
                ->first()
                ->id;

        $guitareoMembershipId =
            $this->musoraDB()->from('railcontent_permissions')
                ->where([
                    'name' => 'Guitareo Membership',
                    'brand' => 'guitareo',
                ])
                ->first()
                ->id;

        $this->info("drumeoMembershipId: $drumeoMembershipId");
        $this->info("pianoteMembershipId: $pianoteMembershipId");
        $this->info("singeoMembershipId: $singeoMembershipId");
        $this->info("guitareoMembershipId: $guitareoMembershipId");

        $this->info('Permissions created successfully. Adding to content...');
        $this->info('Starting to add permissions to content...');

        $createdCount = 0;

        // assign old brand membership perm to all brand content
        $this->musoraDB()->from('railcontent_content')
            ->select(['id', 'brand'])
            ->where('type', 'song')
            ->whereIn('brand', ['pianote', 'guitareo', 'singeo', 'drumeo'])
            ->orderBy('id', 'asc')
            ->chunk(
                250,
                function (Collection $songContentIdRows) use (
                    &$createdCount,
                    $drumeoMembershipId,
                    $pianoteMembershipId,
                    $singeoMembershipId,
                    $guitareoMembershipId
                ) {
                    $songContentIds = $songContentIdRows->pluck('id')->toArray();

                    $songsContentPermissions = $this->musoraDB()->from('railcontent_content_permissions')
                        ->whereIn('content_id', $songContentIds)
                        ->get()
                        ->groupBy('content_id');

                    foreach ($songContentIdRows as $songContentIdRow) {
                        $songContentId = $songContentIdRow->id;
                        $songContentBrand = $songContentIdRow->brand;
                        $songContentPermissions = $songsContentPermissions[$songContentId] ?? [];

                        $permissionIdToAssign = null;

                        if ($songContentBrand == 'drumeo') {
                            $permissionIdToAssign = $drumeoMembershipId;
                        } elseif ($songContentBrand == 'pianote') {
                            $permissionIdToAssign = $pianoteMembershipId;
                        } elseif ($songContentBrand == 'guitareo') {
                            $permissionIdToAssign = $guitareoMembershipId;
                        } elseif ($songContentBrand == 'singeo') {
                            $permissionIdToAssign = $singeoMembershipId;
                        } else {
                            $this->info('BAD: ' . $songContentBrand);
                            continue;
                        }

                        // musora plus permission
                        $hasBrandPermission = false;

                        foreach ($songContentPermissions as $songContentPermission) {
                            if ($songContentPermission->permission_id == $permissionIdToAssign) {
                                $hasBrandPermission = true;
                            }
                        }

                        if (!$hasBrandPermission) {
                            $this->musoraDB()->from('railcontent_content_permissions')
                                ->updateOrInsert([
                                    'content_id' => $songContentId,
                                    'content_type' => null,
                                    'permission_id' => $permissionIdToAssign,
                                    'brand' => $permissionIdToAssign,
                                ]);
                        }
                    }

                    $createdCount += 250;
                    $this->info($createdCount . ' done.');
                }
            );


        $this->info('Done FixSongsTemp!');

        return 0;
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
    }
}
