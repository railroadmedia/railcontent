<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class MigrateTypeBasedContentPermissionsToIdBased extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'MigrateTypeBasedContentPermissionsToIdBased';

    protected $signature = 'MigrateTypeBasedContentPermissionsToIdBased';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MigrateTypeBasedContentPermissionsToIdBased';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager): int
    {
        $connection = $databaseManager->connection(config('railcontent.database_connection_name'));

        // for each content type that is member only, ensure a membership permission is set (per brand as well)
        $railcontentMembershipPermissionIdsPerBrand = [
            'drumeo' => 1,
            'pianote' => 77,
            'singeo' => 73,
            'guitareo' => 52,
            'musora' => 85,
        ];

        $membershipContentTypes = [
            '25-days-of-christmas',
            'backstage-secrets',
            'behind-the-scenes',
            'boot-camps',
            'camp-drumeo-ah',
            'challenges',
            'chord-and-scale',
            'coach',
            'coach-stream',
            'course',
            'course-part',
            'diy-drum-experiments',
            'edge-pack',
            'exercise',
            'exploring-beats',
            'gear-guides',
            'ha-oemurd-pmac',
            'in-rhythm',
            'instructor',
            'learning-path',
            'learning-path-course',
            'learning-path-lesson',
            'learning-path-level',
            'live',
            'namm-2019',
            'on-the-road',
            'paiste-cymbals',
            'performances',
            'play-along',
            'play-along-part',
            'podcasts',
            'question-and-answer',
            'quick-tips',
            'recording',
            'rhythmic-adventures-of-captain-carson',
            'rhythms-from-another-planet',
            'routine',
            'rudiment',
            'semester-pack',
            'semester-pack-lesson',
            'solos',
            'song',
            'song-part',
            'song-pdf',
            'sonor-drums',
            'spotlight',
            'student-collaborations',
            'student-focus',
            'student-review',
            'study-the-greats',
            'tama-drums',
            'the-history-of-electronic-drums',
            'unit',
            'unit-part',
            'videos',
        ];

        $connection->table('railcontent_content')
            ->whereIn('type', $membershipContentTypes)
            ->orderBy('id', 'desc')
            ->chunk(500, function (Collection $contentRows) use (
                $railcontentMembershipPermissionIdsPerBrand,
                $connection
            ) {
                $contentsPermissionsByContentId = $connection->table('railcontent_content_permissions')
                    ->whereIn('content_id', $contentRows->pluck('id')->toArray())
                    ->get()
                    ->groupBy('content_id');

                foreach ($contentRows as $contentRow) {
                    $contentPermissions = $contentsPermissionsByContentId[$contentRow->id] ?? [];
                    $hasAMembershipPermission = false;

                    if (empty($railcontentMembershipPermissionIdsPerBrand[$contentRow->brand])) {
                        $this->info('Invalid brand for content id, skipping: ' . $contentRow->id);
                        continue;
                    }

                    foreach ($contentPermissions as $contentPermission) {
                        if ($contentPermission->permission_id ==
                            $railcontentMembershipPermissionIdsPerBrand[$contentRow->brand]) {
                            $hasAMembershipPermission = true;
                        }
                    }

                    if (!$hasAMembershipPermission) {
                        // create the membership permission on the content
                        $this->info('Adding membership permission to content ID: ' . $contentRow->id);

                        $connection->table('railcontent_content_permissions')
                            ->updateOrInsert([
                                'content_id' => $contentRow->id,
                                'content_type' => null,
                                'permission_id' => $railcontentMembershipPermissionIdsPerBrand[$contentRow->brand],
                                'brand' => $contentRow->brand,
                            ]);
                    } else {
                        $this->info('HAS membership permission to content ID: ' . $contentRow->id);
                    }
                }
            });

        // for all pack content, make sure the right permissions are set (per brand as well)
        // all brands are 'pack' type except singeo which is 'course'
        $packPermissionsMap = [
            367385 => [1, 81],
            257242 => [1, 65],
            228534 => [77, 51],
            233940 => [52, 55],
            233612 => [52, 55],
            217320 => [46],
            224874 => [52, 49],
            213054 => [36, 78],
            25812 => [1, 2],
            239415 => [52, 59],
            356185 => [1, 79],
            213463 => [39, 78],
            239292 => [52, 58],
            25814 => [1, 5],
            212899 => [34, 78],
            270990 => [77, 70],
            25815 => [1, 4],
            25822 => [1, 13],
            25818 => [1, 9],
            25813 => [1, 6],
            190255 => [29],
            223166 => [48],
            248762 => [1, 61],
            25819 => [1, 11],
            265300 => [1, 67],
            265344 => [1, 67],
            265351 => [1, 67],
            265354 => [1, 67],
            29663 => [1, 19],
            26555 => [1, 3],
            25810 => [1, 15],
            268039 => [1, 68],
            235981 => [77, 56],
            213165 => [42, 78],
            280599 => [52, 71],
            237579 => [52, 57],
            190312 => [30],
            208488 => [32],
            214542 => [52, 45],
            213652 => [41, 78],
            354975 => [77, 84],
            213580 => [40, 78],
            28436 => [27],
            30223 => [28],
            208663 => [31],
            234577 => [1, 53],
            25816 => [1, 7],
            25817 => [1, 8],
            248276 => [1, 60],
            250063 => [1, 60],
            353337 => [78],
            25811 => [1, 18],
            212924 => [35, 78],
            25820 => [1, 12],
            299812 => [1, 72],
            254040 => [77, 64],
            251493 => [77, 63],
            361886 => [77, 87],
            366444 => [52, 83],
            217074 => [47],
            227748 => [50],
            249140 => [1, 62],
            25821 => [1, 10],
            234982 => [77, 54],
            25809 => [1, 16],
            313494 => [77, 74],
            213297 => [37, 78],
            213341 => [38, 78],
            346331 => [77, 82],
            206302 => [1, 43],
            206357 => [52, 44],
            25808 => [1, 20],
            335223 => [77, 76],
            262874 => [77, 66],
        ];

        $packContentRows = $connection->table('railcontent_content')
            ->whereIn('type', ['pack', 'semester-pack'])
            ->orderBy('id', 'desc')
            ->get();

        foreach ($packContentRows as $packContentRow) {
            $connection->table('railcontent_content_permissions')
                ->where('content_id', $packContentRow->id)
                ->delete();

            foreach ($packPermissionsMap[$packContentRow->id] ?? [] as $packPermissionId) {
                $this->info('Adding permission ' . $packPermissionId . ' to content id ' . $packContentRow->id);

                $connection->table('railcontent_content_permissions')
                    ->insert([
                        'content_id' => $packContentRow->id,
                        'content_type' => null,
                        'permission_id' => $packPermissionId,
                        'brand' => $packContentRow->brand,
                    ]);
            }

            $packBundleHierarchyChildIds = $connection->table('railcontent_content_hierarchy')
                ->where('parent_id', $packContentRow->id)
                ->get()
                ->pluck('child_id')
                ->toArray();

            $packBundleLessonHierarchyChildIds = $connection->table('railcontent_content_hierarchy')
                ->whereIn('parent_id', $packBundleHierarchyChildIds)
                ->get()
                ->pluck('child_id')
                ->toArray();

            foreach (array_merge($packBundleHierarchyChildIds, $packBundleLessonHierarchyChildIds) as $childId) {
                if (empty($packPermissionsMap[$packContentRow->id])) {
                    $this->info('Skipping content ID ' . $packContentRow->id . ' due to missing permission in map.');
                    continue;
                }

                $connection->table('railcontent_content_permissions')
                    ->where('content_id', $childId)
                    ->delete();

                foreach ($packPermissionsMap[$packContentRow->id] as $packPermissionId) {
                    $this->info('Adding permission ' . $packPermissionId . ' to content id ' . $childId);

                    $connection->table('railcontent_content_permissions')
                        ->insert([
                            'content_id' => $childId,
                            'content_type' => null,
                            'permission_id' => $packPermissionId,
                            'brand' => $packContentRow->brand,
                        ]);
                }
            }
        }

        // courses
        $coursePermissionsMap = [
            354346 => [73],
            347097 => [73],
            373883 => [73],
            350790 => [73],
            310413 => [73],
            369621 => [73],
            310414 => [73, 75],
            363172 => [73],
            373610 => [73, 86],
            332707 => [73],
        ];

        $courseContentRows = $connection->table('railcontent_content')
            ->where('type', 'course')
            ->where('brand', 'singeo')
            ->orderBy('id', 'desc')
            ->get();

        foreach ($courseContentRows as $courseContentRow) {
            $courseLessonChildIds = $connection->table('railcontent_content_hierarchy')
                ->where('parent_id', $courseContentRow->id)
                ->get()
                ->pluck('child_id')
                ->toArray();

            foreach ($courseLessonChildIds as $childId) {
                if (empty($coursePermissionsMap[$courseContentRow->id])) {
                    $this->info('Skipping content ID ' . $courseContentRow->id . ' due to missing permission in map.');
                    continue;
                }

                $connection->table('railcontent_content_permissions')
                    ->where('content_id', $childId)
                    ->delete();

                foreach ($coursePermissionsMap[$courseContentRow->id] as $coursePermissionId) {
                    $this->info('Adding permission ' . $coursePermissionId . ' to content id ' . $childId);

                    $connection->table('railcontent_content_permissions')
                        ->insert([
                            'content_id' => $childId,
                            'content_type' => null,
                            'permission_id' => $coursePermissionId,
                            'brand' => $courseContentRow->brand,
                        ]);
                }
            }
        }

        return 0;
    }
}
