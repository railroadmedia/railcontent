<?php

namespace App\Modules\Content\Console\Commands;

use App\Decorators\Content\VimeoTrailerDecorator;
use App\Models\Cohort;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Console\Commands\Data\OnboardingCards;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentHierarchy;
use App\Modules\Content\Models\ContentInstructor;
use App\Modules\Content\Models\ContentPermissions;
use App\Modules\Content\Models\ContentStyle;
use App\Modules\Content\Models\Permission;
use App\Modules\Content\Models\Sanity\Enums\FilterType;
use App\Modules\Content\Models\Vimeo;
use App\Modules\UserManagementSystem\Enums\OnboardingSkillLevelEnum;
use Carbon\Carbon;
use Modules\Content\Models\ContentCreativity;
use Modules\Content\Models\ContentEssentials;
use Modules\Content\Models\ContentFocus;
use Modules\Content\Models\ContentGears;
use Modules\Content\Models\ContentLifestyle;
use Modules\Content\Models\ContentTheory;
use Modules\Content\Models\ContentTopic;
use Modules\Content\Services\ChallengesService;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Providers\RailcontentURLProviderInterface;

class ImportContentsInSanity extends \Illuminate\Console\Command
{
    protected $signature = 'sanity:import-content {destination=development} {clean=false} {brand=drumeo} {type=all} {delete=false} {--id=} {--vimeoRefresh}  {--deleteSanityDocumentId=}';

    protected $description = 'Import Contents from DB in Sanity';

    protected $difficultyMapping = ['All', 'Novice', 'Beginner', 'Beginner', 'Intermediate', 'Intermediate', 'Advanced', 'Advanced', 'Expert', 'Expert', 'Expert'];

    protected $contentTypeToSanityTypeMapping = [
        'boot-camps'             => 'boot-camp',
        'backstage-secrets'      => 'backstage-secret',
        'student-collaborations' => 'student-collaboration',
        'podcasts'               => 'podcast',
        'solos'                  => 'solo',
        'gear-guides'            => 'gear-guide',
        'performances'           => 'performance',
        'diy-drum-experiments'   => 'diy-drum-experiment',
        'tama-drums'             => 'tama',
        'sonor-drums'            => 'sonor',
    ];

    protected $specficContentTypesPerBrand = [
        'drumeo' => [
            'semester-pack-lesson',
            'semester-pack',
            'student-focus',
            'play-along',
            'rudiment',
            'coach-stream',
        ],
        'pianote' => [
            'song-tutorial-children',
            'song-tutorial',
            'unit-part',
            'unit'
        ],
        'guitareo' => [
            'song-part',
            'play-along-part',
            'play-along',
        ],
        'singeo' => [
            'routine'
        ]
    ];

    public function handle(): int
    {
        $contentType        = $this->argument('type');
        $deleteOldDocuments = $this->argument('delete');
        $destination        = $this->argument('destination');
        $deleteSanityDocumentId = $this->hasOption('deleteSanityDocumentId') ? $this->option('deleteSanityDocumentId') : null;
        if ($deleteSanityDocumentId) {
            $directory = resource_path() . '/sanitystudio';
            $this->runCliCommand("cd $directory && yarn sanity documents delete --dataset=".$destination." " . $deleteSanityDocumentId);
            return true;
        }

        $extraModels = [
            'lifestyle'  => ContentLifestyle::class,
            'essential'  => ContentEssentials::class,
            'creativity' => ContentCreativity::class,
            'theory'     => ContentTheory::class,
            'topic'      => ContentTopic::class,
            'genre'      => ContentStyle::class,
            'gear'       => ContentGears::class,
            'focus'      => ContentFocus::class
        ];
        $permissions = $this->getPermissions();

        $artists = $this->getArtists();

        $extraData = $this->getExtraData($extraModels);

        $instructors = $this->getInstructors($extraData);


        if ($contentType == "all") {
            $contentTypes = array_merge(
                $this->specficContentTypesPerBrand[$this->argument('brand')] ?? [],
                [
                    'pack-bundle-lesson',
                    'pack-bundle',
                    'pack',
                    'course-part',
                    'course',
                    'workout',
                    'quick-tips',
                    'challenge-part',
                    'challenge',
                    'song',
                    'learning-path-lesson',
                    'learning-path-course',
                    'learning-path-level',
                    'learning-path',
                    'onboarding-card',
                ],
                config('railcontent.showTypes')[$this->argument('brand')]
            );
        } elseif ($contentType == "shows") {
            $contentTypes = config('railcontent.showTypes')[$this->argument('brand')];
        } else {
            $contentTypes = [$contentType];
        }

        //import  related models
        if ($this->argument('clean') == 'true') {
            $directory = resource_path() . '/sanitystudio';
            $related   = ['permissions.ndjson',  'artists.ndjson'];
            foreach ($extraModels as $index => $extraModel) {
                $related[] = $index . '.ndjson';
            }
            $related[] = 'instructors.ndjson';
            foreach ($related as $filename) {
                $this->info(" ---- Start $filename migration. ----");
                $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset import $filename $destination --replace");
                if ($resultCode !== self::SUCCESS) {
                    $this->error("Failed to import $filename to $destination. Have you built Sanity Studio using the README instructions?");
                } else {
                    $this->info("Dataset import $filename to $destination complete.");
                }
            }
        }
        $vimeoVideoSourcesDecorator = app()->make(VimeoTrailerDecorator::class);
        $railcontentURLProvider = app()->make(RailcontentURLProviderInterface::class);

        foreach ($contentTypes as $cType) {
            $this->info(" ---- Start $cType migration. ----");
            $railcontentId = $this->hasOption('id') ? $this->option('id') : null;
            $this->importData($cType, $extraModels, $permissions, $extraData, $instructors, $deleteOldDocuments, $destination, $artists, $railcontentId, $vimeoVideoSourcesDecorator, $railcontentURLProvider);
        }

        return 1;
    }

    /**
     * @return array
     */
    private function getPermissions(): array
    {
        $permissionsRailcontent = Permission::query()->get();
        $permissions            = [];
        foreach ($permissionsRailcontent as $permission) {
            $name             = preg_replace('/[^a-zA-Z0-9_.]/', '', $permission->name);
            $id               = 'permission_' . strtolower($name);
            $permissions[$id] = [
                '_id'            => $id,
                'name'           => $permission->name,
                '_type'          => 'permission',
                'brand'          => $permission->brand,
                'railcontent_id' => $permission->id,
            ];
        }
        $filename = resource_path() . '/sanitystudio/permissions.ndjson';
        foreach ($permissions as $result) {
            $newline = json_encode($result) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }

        return $permissions;
    }

    /**
     * @return array
     */
    private function getArtists(): array
    {
        $artistsData = Content::query()
            ->leftJoin('artists', 'artists.name', '=', 'railcontent_content.artist')
            ->where('railcontent_content.type', '=', 'song')
            ->selectRaw(
                'distinct(railcontent_content.artist) as name, "artist" as type,
            COALESCE(artists.head_shot_picture_url, "https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/bf73168e-0d5f-476c-e819-d5c6ebb29900/public")
            AS thumbnail_url'
            )->get();
        $artists     = [];
        foreach ($artistsData as $artistsDatum) {
            $name         = preg_replace('/[^a-zA-Z0-9_]/', '', $artistsDatum->name);
            $id           = 'artist_' . strtolower($name);
            $cleaned_name = preg_replace('/[é]/u', 'e', $artistsDatum->name);
            $artists[$id] = [
                '_id'           => $id,
                'name'          => preg_replace('/[^a-zA-Z0-9_ \-&.\'()\/ +!,]/', '', $cleaned_name),
                '_type'         => $artistsDatum->type,
                'thumbnail_url' => [
                    '_type'        => 'image',
                    '_sanityAsset' => 'image@' . $artistsDatum->thumbnail_url
                ],
            ];
        }

        $filename = resource_path() . '/sanitystudio/artists.ndjson';

        foreach ($artists as $result) {
            $newline = json_encode($result) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }

        return $artists;
    }

    /**
     * @return array
     */
    private function getInstructors($extraData): array
    {
        $instructorsData = Content::with('data', 'fields')
            ->where('type', '=', 'instructor')
            ->where('railcontent_content.status', '=', 'published')
            ->whereNotIn('id', [404505, 389348, 395073, 31935])
            ->get();

        $instructors = [];
        foreach ($instructorsData as $instructorDatum) {
            $name = preg_replace('/[^a-zA-Z0-9_]/', '', $instructorDatum->name);

            $id = 'instructor_' . strtolower($name) . '_' . $instructorDatum->id;

            $instructors[$id] = [
                '_id'            => $id,
                'name'           => $instructorDatum->name,
                '_type'          => $instructorDatum->type,
                'brand'          => $instructorDatum->brand,
                'railcontent_id' => $instructorDatum->id,
                'web_url_path'   => $instructorDatum->web_url_path
            ];

            $thumb = '';
            foreach ($instructorDatum['data'] as $info) {
                if ($info['key'] == 'head_shot_picture_url') {
                    $thumb = $info['value'];
                }
                if (in_array($info['key'], ['coach_card_image', 'coach_featured_image', 'coach_top_banner_image', 'coach_bottom_banner_image']) && $info['value'] != '') {
                    $instructors[$id][$info['key']] = [
                        '_type'        => 'image',
                        '_sanityAsset' => 'image@' . $info['value']
                    ];
                }
                if (in_array($info['key'], ['short_bio', 'long_bio'])) {
                    $instructors[$id][$info['key']][] = [
                        '_type'    => 'block',
                        'style'    => 'normal',
                        'markDefs' => [],
                        'children' => [
                            [
                                '_type' => 'span',
                                "marks" => [],
                                'text'  => $info['value']
                            ]
                        ]
                    ];
                }
                if ($info['key'] == 'focus_text') {
                    $instructors[$id]['focus_text'] = $info['value'];
                }
            }
            if ($thumb != '') {
                $instructors[$id]['thumbnail_url'] = [
                    '_type'        => 'image',
                    '_sanityAsset' => 'image@' . $thumb
                ];
            }
            $contentExtraData = [];
            foreach ($instructorDatum['fields'] as $info) {
                if (in_array($info['key'], ['is_coach', 'is_active', 'is_house_coach', 'is_featured', 'is_coach_of_the_month'])) {
                    $instructors[$id][$info['key']] = ($info['value'] == 1);
                }
                if (in_array($info['key'], ['bands', 'endorsements'])) {
                    $instructors[$id][$info['key']] = $info['value'];
                }
                if (in_array($info['key'], ['associated_user_id', 'forum_thread_id'])) {
                    $instructors[$id][$info['key']] = (int)$info['value'];
                }
                if (in_array($info['key'], ['focus'])) {
                    $contentExtraData[$info['key']][] = $info['value'];
                }
                if (in_array($info['key'], ['style'])) {
                    $contentExtraData['genre'][] = $info['value'];
                }
            }
            if ($thumb != '') {
                $instructors[$id]['thumbnail_url'] = [
                    '_type'        => 'image',
                    '_sanityAsset' => 'image@' . $thumb
                ];
            }
            $this->handleExtraData($contentExtraData, $extraData, $instructors[$id], $id);
            $this->handleGenre($extraData, $instructors[$id], $id);
        }

        $filename = resource_path() . '/sanitystudio/instructors.ndjson';
        foreach ($instructors as $result) {
            $newline = json_encode($result) . "\n";
            file_put_contents($filename, $newline, FILE_APPEND);
        }

        return $instructors;
    }

    /**
     * @param array $extraModels
     * @return array
     */
    private function getExtraData(array $extraModels): array
    {
        $extraData = [];
        foreach ($extraModels as $index => $extraModel) {
            $model = new $extraModel();

            $allData = $model::query();
            if ($index == 'genre') {
                $allData = $allData->leftJoin('genre', 'genre.name', '=', 'railcontent_content_styles.style')->selectRaw(
                    'railcontent_content_styles.*,
            COALESCE(genre.head_shot_picture_url, "https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/bf73168e-0d5f-476c-e819-d5c6ebb29900/public")
            AS thumbnail_url'
                );
            }
            $allData           = $allData->get();
            $extraData[$index] = [];
            foreach ($allData as $datum) {
                $columnName = $model->getName();
                $name       = preg_replace('/[^a-zA-Z0-9_]/', '', $datum->$columnName);
                $id         = $index . '_' . strtolower($name);

                $extraData[$index][$id] = [
                    '_id'          => $id,
                    'name'         => $datum->$columnName,
                    '_type'        => $index,
                    'filter_types' => FilterType::from($index)->filterOptions()
                ];
                if ($index == 'genre') {
                    $extraData[$index][$id]['thumbnail_url'] = [
                        '_type'        => 'image',
                        '_sanityAsset' => 'image@' . $datum->thumbnail_url
                    ];
                }
            }
            $filename = resource_path() . '/sanitystudio/' . $index . '.ndjson';
            foreach ($extraData[$index] as $result) {
                $newline = json_encode($result) . "\n";
                file_put_contents($filename, $newline, FILE_APPEND);
            }
        }

        return $extraData;
    }

    /**
     * Execute the given command in the CLI.
     */
    private function runCliCommand(string $command): int
    {
        $output     = null;
        $resultCode = null;

        exec($command, $output, $resultCode);

        foreach ($output as $line) {
            $this->info($line);
        }

        return $resultCode;
    }

    /**
     * @param bool|array|string|null $contentType
     * @param array                  $extraModels
     * @param array                  $permissions
     * @param array                  $extraData
     * @param array                  $instructors
     * @param bool|array|string|null $deleteOldDocuments
     * @param string                 $destination
     */
    private function importData(
        bool|array|string|null $contentType,
        array $extraModels,
        array $permissions,
        array $extraData,
        array $instructors,
        bool|array|string|null $deleteOldDocuments,
        $destination,
        array $artists,
        int|null $railcontentId,
        $vimeoVideoSourcesDecorator,
        $railcontentURLProvider
    ): void {
        if ($contentType == 'onboarding-card') {
            $sanityDocuments = $this->importOnboardingCards();
        } else {
            $results = $this->getContentResults($contentType, $railcontentId);


            $sanityDocuments = $this->mapContentToSanityFormat($results, $extraModels, $extraData, $artists, $permissions, $instructors, $railcontentURLProvider, $vimeoVideos);
        }
        if (!$sanityDocuments) {
            $this->info("No data to import for $contentType");
            return;
        }
        $vimeoVideos = [];


        $directory = resource_path() . '/sanitystudio';
        if ($deleteOldDocuments == "true") {
            $ids        = implode(' ', array_keys($sanityDocuments));
            $resultCode = $this->runCliCommand("cd $directory && yarn sanity documents delete --dataset=development " . $ids);
        }

        if ($this->option('vimeoRefresh')) {
            $this->syncVimeoData($vimeoVideos, $vimeoVideoSourcesDecorator, $sanityDocuments);
        }

        $contentsFileName = "contents.ndjson";
        $contentsFilePath = $directory . '/' . $contentsFileName;
        // Remove existing file before importing
        $_ = $this->runCliCommand("rm -f $contentsFilePath");

        foreach ($sanityDocuments as $result) {
            $newline = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
            file_put_contents($contentsFilePath, $newline, FILE_APPEND);
        }

        // import into the destination
        $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset import $contentsFileName $destination --replace");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to import $contentType to $destination. Have you built Sanity Studio using the README instructions?");
        } else {
            $this->info("Dataset import $contentType to $destination complete.");
        }
        // clean up the export file
        $resultCode = $this->runCliCommand("rm $contentsFilePath");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to delete $contentsFileName");
        } else {
            $this->info('Generated file deleted from local storage.');
        }
    }

    /**
     * @param array  $extraData
     * @param array  $songs
     * @param string $id
     * @return array
     */
    private function handleGenre(array $extraData, array &$songs, string $id): array
    {
        $contentGenres = ContentStyle::query()->where('content_id', '=', $songs['railcontent_id'])->get();
        foreach ($contentGenres->unique('style')->all() as $contentGenre) {
            $name = preg_replace('/[^a-zA-Z0-9_.]/', '', $contentGenre->style);
            if (isset($extraData['genre']['genre_' . strtolower($name)])) {
                $songs["genre"][] = [
                    "_type" => "reference",
                    "_ref"  => 'genre_' . strtolower($name),
                    "_weak" => false
                ];
            }
        }

        return $songs;
    }

    /**
     * @param mixed  $result
     * @param array  $instructors
     * @param array  $songs
     * @param string $id
     * @return array
     */
    private function handleInstructors(mixed $result, array $instructors, array &$songs, string $id): array
    {
        $contentInstructors = ContentInstructor::with('instructor')->select('instructor_id')->where('content_id', '=', $result->id)->groupBy('instructor_id')->get();
        foreach ($contentInstructors as $contentInstructor) {
            if ($contentInstructor->instructor) {
                $name = preg_replace('/[^a-zA-Z0-9_]/', '', $contentInstructor->instructor->name);
                if (isset($instructors['instructor_' . strtolower($name) . '_' . $contentInstructor->instructor->id])) {
                    $songs["instructor"][] = [
                        "_type" => "reference",
                        "_ref"  => 'instructor_' . strtolower($name) . '_' . $contentInstructor->instructor->id,
                        "_weak" => false
                    ];
                }
            }
        }

        return $songs;
    }

    /**
     * @param mixed  $result
     * @param array  $permissions
     * @param array  $songs
     * @param string $id
     * @return array
     */
    private function handlePermissions(mixed $result, array $permissions, array &$songs, string $id): array
    {
        $forcePermissions =
            [
                '367385' => 81,
                '383627' => 96,
                '394326' => 101,
                '412811' => 115
            ];
        $contentPermissions = ContentPermissions::with('permissions')->where('content_id', '=', $result->id);
        if(isset($forcePermissions[$result->id])){
            $contentPermissions = $contentPermissions->where('permission_id', '=', $forcePermissions[$result->id]);
        }
        $contentPermissions = $contentPermissions->get();
        foreach ($contentPermissions as $contentPermission) {
            $name = preg_replace('/[^a-zA-Z0-9_.]/', '', $contentPermission->permissions->name);
            if (isset($permissions['permission_' . strtolower($name)])) {
                $songs["permission"][] = [
                    "_type" => "reference",
                    "_ref"  => 'permission_' . strtolower($name),
                    "_weak" => false
                ];
            }
        }

        return $songs;
    }

    /**
     * @param array  $contentExtraData
     * @param array  $extraData
     * @param array  $songs
     * @param string $id
     * @return array[]
     */
    private function handleExtraData(array $contentExtraData, array $extraData, array &$songs, string $id): array
    {
        if (!empty($contentExtraData)) {
            foreach ($contentExtraData as $index => $contentExtra) {
                if (strtolower($index) != 'gear') {
                    foreach ($contentExtra as $contentExtraDatum) {
                        $name = preg_replace('/[^a-zA-Z0-9_]/', '', $contentExtraDatum);
                        if (isset($extraData[$index][$index . '_' . strtolower($name)])) {
                            $songs["$index"][] = [
                                "_type" => "reference",
                                "_ref"  => $index . '_' . strtolower($name),
                                "_weak" => false
                            ];
                        }
                    }
                }
            }
        }

        return $songs;
    }

    /**
     * @param array  $chapters
     * @param array  $songs
     * @param string $id
     * @return array
     */
    private function handleContentChapters(array $chapters, array &$songs, string $id): array
    {
        foreach ($chapters as $chapter) {
            if (isset($chapter['chapter_thumbnail_url']) && $chapter['chapter_thumbnail_url'] != '') {
                $songs["chapter"][] =
                    [
                        'chapter_timecode'      => (int)($chapter['chapter_timecode'] ?? 0),
                        'chapter_description'   => $chapter['chapter_description'],
                        'chapter_thumbnail_url' => [
                            '_type'        => 'image',
                            '_sanityAsset' => 'image@' . $chapter['chapter_thumbnail_url']
                        ]
                    ];
            } else {
                $songs["chapter"][] = [
                    'chapter_timecode'    => (int)($chapter['chapter_timecode'] ?? 0),
                    'chapter_description' => $chapter['chapter_description'] ?? '',
                ];
            }
        }

        return $songs;
    }

    /**
     * @param mixed  $result
     * @param array  $songs
     * @param string $id
     * @param mixed  $type
     * @return array
     */
    private function handleChildren(mixed $result, array &$songs, string $id, mixed $type): array
    {
        $contentHierarchy = ContentHierarchy::with('child')->where('parent_id', '=', $result->id)->orderBy('child_position', 'asc')->get();
        if ($contentHierarchy->isEmpty()) {
            return $songs;
        }
        $duration = 0;
        $songs['assignments_total_xp'] = 0;
        $songs['children_total_xp'] = 0;
        foreach ($contentHierarchy as $hierarchy) {
            if ($hierarchy->child) {
                if ($hierarchy->child->type != 'assignment' && $hierarchy->child->status != 'deleted') {
                    $duration += (int)$hierarchy->child->length_in_seconds;
                    $songs['children_total_xp'] = $songs['children_total_xp'] + (int)$hierarchy->child->total_xp;
                    $songs["child"][] = [
                        "_type" => "reference",
                        "_ref"  => $hierarchy->child->type . '_' . $hierarchy->child->id,
                        "_weak" => false
                    ];
                } elseif ($hierarchy->child->type == 'assignment' && $type == 'song') {
                    $songs['assignments_total_xp'] = $songs['assignments_total_xp'] + 25;
                    $songs["soundslice"][] = [
                        'soundslice_title'            => $hierarchy->child->title,
                        'soundslice_slug'             => $hierarchy->child->soundslice_slug,
                        'soundslice_length_in_second' => (isset($songs['length_in_seconds'])) ? (int)$songs['length_in_seconds'] : 0,

                    ];
                } elseif ($hierarchy->child->type == 'assignment') {
                    unset($songs['child_count']);
                    $songs['assignments_total_xp'] = $songs['assignments_total_xp'] + 25;
                    $assignmentSheetMusicImage = $hierarchy->child->data->where('key', '=', 'sheet_music_image_url')->pluck('value')->toArray();
                    $songs["assignment"][] = [
                        'assignment_title'             => $hierarchy->child->title,
                        'assignment_soundslice'        => $hierarchy->child->soundslice_slug,
                        'assignment_description'       => $hierarchy->child->data->where('key', '=', 'description')->first()['value'] ?? '',
                        'assignment_timecode'          => $hierarchy->child->data->where('key', '=', 'timecode')->first()['value'] ?? null,
                        'assignment_sheet_music_image' => $assignmentSheetMusicImage,
                        'railcontent_id'               => $hierarchy->child->id,
                    ];
                }
            }
        }

        if ($duration != 0) {
            $songs['length_in_seconds'] = $duration;
        }

        return $songs;
    }

    /**
     * @param mixed  $railcontentChallenge
     * @param array  $sanityChallenge
     * @return array
     */
    private function handleCohortImport(mixed $railcontentChallenge, array &$sanityChallenge): array
    {
        $cohort = Cohort::query()
            ->where('content_id', $railcontentChallenge->id)
        ->first();
        if (!$cohort) {
            return $sanityChallenge;
        }
        $fieldsToCopy = [
            'headline' => 'string',
            'subheadline' => 'string',
            'header_description' => 'string',
            'cohort_trailer' => 'string',
            'icon1_title' => 'string',
            'icon1_copy' => 'string',
            'icon2_title' => 'string',
            'icon2_copy' => 'string',
            'icon3_title' => 'string',
            'icon3_copy' => 'string',
            'body_title' => 'string',
            'body_top_description' => 'string',
            'body_bottom_description' => 'string',
            'dropdown_title' => 'string',
            'bottom_title' => 'string',
            'bottom_description' => 'string',
            'product_id' => 'string',
            'cohort_start_date' => 'datetime',
            'cohort_end_date' => 'datetime',
            'conversation_thread_id' => 'int',
            'description_trailer_1' => 'string',
            'description_trailer_2' => 'string',
            'demo_title_text' => 'string',
            'demo_description_text' => 'string',
            'demo_label_text' => 'string',
            'demo_trailer' => 'string',
            'first_day_text' => 'string',
            'last_day_text' => 'string',
            'benefit_1' => 'string',
            'benefit_2' => 'string',
            'benefit_3' => 'string',
            'is_product' => 'bool',
            'product_description_header' => 'string',
            'product_description_body' => 'string',
            'product_original_price' => 'float',
            'product_sale_price' => 'float',
            'course_description' => 'string',
            'course_product_description' => 'string',
            'get_product_badge' => 'string',
            'product_cart_link' => 'string',
            'product_name' => 'string',
            'product_cart_link_description' => 'string',
            'custom_cohort' => 'bool',
            // These are already saved under X_url
            //'light_mode_logo'=> 'image',
            //'dark_mode_logo'=> 'image',
            //'body_logo'=> 'image',
            'header_image_url'=> 'image',
            'body_image_url'=> 'image',
            'icon1_url'=> 'image',
            'icon2_url'=> 'image',
            'icon3_url'=> 'image',
            'description_trailer_1_thumb_url'=> 'image',
            'description_trailer_2_thumb_url'=> 'image',
            'demo_background_image_url'=> 'image',
            'demo_desktop_center_image_url'=> 'image',
            'demo_mobile_center_image_url'=> 'image',
            'product_image'=> 'image',
        ];

        foreach($fieldsToCopy as $field => $type) {
            if ($type == 'bool') {
                $sanityChallenge[$field] = ($cohort[$field] == 1);
            } elseif ($type == 'float') {
                $sanityChallenge[$field] = floatval($cohort[$field] ?? 0.0);
            } elseif ($type == 'int') {
                $sanityChallenge[$field] = intval($cohort[$field] ?? 0);
            } elseif ($type == 'image') {
                if (!isset($sanityChallenge[$field]) && isset($cohort[$field])) {
                    $sanityChallenge[$field] = [
                        '_type' => 'image',
                        '_sanityAsset' => 'image@' . $cohort[$field]
                    ];
                }
            } elseif ($type == 'string') {
                $sanityChallenge[$field] = $cohort[$field];
            } elseif ($type == 'datetime' && !is_null($cohort[$field])) {
                $sanityChallenge[$field] =  $this->formatDateForImport($cohort[$field]);
            }
        }
        $lists = $cohort->dropdowns()->get();
        $sanityChallenge['dropdown'] = [];
        foreach($lists as $list) {
            $sanityChallenge['dropdown'][] = [
                'title' => $list->title,
                'description' => $list->description,
            ];
        }
        return $sanityChallenge;
    }

    private function getContentResults($contentType, $railcontentId)
    {
        $query = Content::with('data', 'fields')
            ->where('railcontent_content.type', '=', $contentType)
            ->where('railcontent_content.status', '!=', 'deleted')
            ->where('railcontent_content.brand', '=', $this->argument('brand'));

        if ($railcontentId) {
            $query->where('railcontent_content.id', '=', $railcontentId);
        }

        return $query->whereNotIn('railcontent_content.id', [      410145,        213076,  213078])
            ->orderBy('id', 'asc')
            ->get();
    }

    private function mapContentToSanityFormat($results, $extraModels, $extraData, $artists, $permissions, $instructors, $railcontentURLProvider, &$vimeoVideos)
    {
        $contents = [];
        foreach ($results as $result) {
            $type       = isset($this->contentTypeToSanityTypeMapping[$result->type]) ? $this->contentTypeToSanityTypeMapping[$result->type] : $result->type;

            $id         = $type . '_' . $result->id;
            if ($result->id == 215952) {
                $id = 'foundation';
                $type = 'foundation';
            }
            $contents[$id] = $this->transformContent($result, $extraModels, $extraData, $artists, $railcontentURLProvider, $id, $type, $permissions, $instructors, $vimeoVideos);
        }

        return $contents;
    }

    private function transformContent($result, $extraModels, $extraData, $artists, $railcontentURLProvider, $id, $type, $permissions, $instructors, &$vimeoVideos)
    {
        $difficulty = (int)$result->difficulty;
        $parentType = [
            'course-part'          => 'course',
            'challenge-part'       => 'challenge',
            'semester-pack-lesson' => 'semester-pack',
            'learning-path-lesson' => 'learning-path-course',
            'learning-path-course' => 'learning-path-level',
            'learning-path-level'  => 'learning-path',
            'unit-part' => 'unit',
            'unit' => 'learning-path',
            'pack-bundle-lesson' => 'pack-bundle',
            'pack-bundle' => 'pack',
            'song-tutorial-children' => 'song-tutorial',
            'play-along-part' => 'play-along'
        ];

        $sanityDocuments = [
            '_id'              => $id,
            '_type'            => $type,
            'title'            => $result->title,
            'status'            => $result->status,
            'slug'             => [
                '_type'   => 'slug',
                'current' => $result->slug
            ],
            'brand'            => $result->brand,
            'difficulty'       => $difficulty,
            'railcontent_id'   => $result->id,
            'language'         => 'en-US',
            'xp'               => (int)$result->xp,
            'total_xp'         => (int)$result->total_xp,
            'show_in_new_feed' => $result->show_in_new_feed == 1,
            "web_url_path"     => $result->web_url_path,
            "popularity"       => $result->popularity
        ];
        if ($type == 'song') {
            $sanityDocuments['instrumentless'] = $result->instrumentless == 1;
        }
        if($result->quarter_removed){
            $sanityDocuments['quarter_removed'] = $result->quarter_removed;
        }
        if($result->quarter_published){
            $sanityDocuments['quarter_published'] = $result->quarter_published;
        }
        if ($result->published_on) {
            $sanityDocuments['published_on'] = Carbon::parse($result->published_on)->toISOString();
        }
        if($result->type == 'coach-stream'){

            $instructorField = $result->fields->where('key','=','instructor')->first();
            if($instructorField) {
                $instructorId                    = $instructorField->value;
                $instructor                      = Content::find($instructorId);
                $sanityDocuments['web_url_path'] = '/'.$result->brand . '/coaches/' . $instructor->slug . '/' . $result->slug . '/' . $result->id;
            }
        }elseif (!$result->web_url_path) {
                $contentURLs =
                    $railcontentURLProvider->getContentURLs(
                        $result->id,
                        $result->slug,
                        $result->type,
                        new ContentEntity($result->toArray())
                    );

                if (!empty($contentURLs)) {
                    $sanityDocuments['web_url_path'] = $contentURLs->getWebURLPath();
                }
        }
        if ($result->sort != 0) {
            $sanityDocuments['sort'] = $result->sort;
        }
        if ($result->child_count != 0) {
            $sanityDocuments['child_count'] = $result->child_count;
        }
        if (isset($parentType[$type])) {
            $sanityDocuments['parent_type'] = $parentType[$type];
        }
        if (isset($this->difficultyMapping[$difficulty])) {
            $sanityDocuments["difficulty_string"] = $this->difficultyMapping[$difficulty];
        }
        if ($result->parent_content_data) {
            $parents = (json_decode($result->parent_content_data));
            foreach ($parents as $parent) {
                if ($parent->type != 'edge-pack' && $parent->type != 'user-playlist' && !in_array($parent->slug, ['lead-guitar-101', 'electric-rhythm-guitar-101',
                        'acoustic-rhythm-guitar-101', 'lead-guitar-quick-start', 'beginner-electric-quick-start', 'beginner-acoustic-quick-start',
                        'no-guitar-needed','reading-music','lead-guitar-102','electric-rhythm-guitar-102','acoustic-rhythm-guitar-102'])) {
                    $sanityDocuments['parent_content_data'][] = [
                        'type'     => $parent->type,
                        'id'       => $parent->id,
                        'slug'     => $parent->slug,
                        'position' => $parent->position ?? 1
                    ];
                }
            }
        }
        $resources       = [];
        $chapters        = [];
        $notImportedData = [];
        $contentWithWrongImage = [268071, 268097, 268122, 378258,382515,391008,382879,391160, 399638,404279, 404299, 401415, 270443,  318625, 30437, 206255, 375281, 268094, 23313, 23393, 23395, 331419, 414974];
        foreach ($result->data as $datum) {
            $imported = false;
            if ($datum['key'] == 'thumbnail_url' && $datum['value'] != '' && !in_array($datum['content_id'], $contentWithWrongImage)) {
                $sanityDocuments['thumbnail'] = [
                    '_type'        => 'image',
                    '_sanityAsset' => 'image@' . $datum['value']
                ];
                $imported                = true;
            } elseif (in_array($datum['content_id'], $contentWithWrongImage)) {
                $imported                = true;
            }
            if (in_array($datum['key'], ['logo_image_url', 'dark_mode_logo_url', 'light_mode_logo_url']) && $datum['value'] != '') {
                $sanityDocuments[$datum['key']] = [
                    '_type'        => 'image',
                    '_sanityAsset' => 'image@' . $datum['value']
                ];
                $imported                  = true;
            }
            if ($datum['key'] == 'resource_name') {
                $resources[$datum['position']]['resource_name'] = $datum['value'];
                $imported                                       = true;
            }
            if ($datum['key'] == 'resource_url') {
                $resources[$datum['position']]['resource_url'] = $datum['value'];
                $imported                                      = true;
            }
            if ($datum['key'] == 'chapter_timecode') {
                $chapters[$datum['position']]['chapter_timecode'] = $datum['value'];
                $imported                                         = true;
            }
            if ($datum['key'] == 'chapter_description') {
                $chapters[$datum['position']]['chapter_description'] = $datum['value'];
                $imported                                            = true;
            }
            if ($datum['key'] == 'chapter_thumbnail_url') {
                $chapters[$datum['position']]['chapter_thumbnail_url'] = $datum['value'];
                $imported                                              = true;
            }
            if ($datum['key'] == 'mp3_yes_drums_yes_click_url') {
                $sanityDocuments['mp3_yes_drums_yes_click_url'] = $datum['value'];
                $imported                                  = true;
            }
            if ($datum['key'] == 'mp3_yes_drums_no_click_url') {
                $sanityDocuments['mp3_yes_drums_no_click_url'] = $datum['value'];
                $imported                                 = true;
            }
            if ($datum['key'] == 'mp3_no_drums_yes_click_url') {
                $sanityDocuments['mp3_no_drums_yes_click_url'] = $datum['value'];
                $imported                                 = true;
            }
            if ($datum['key'] == 'mp3_no_drums_no_click_url') {
                $sanityDocuments['mp3_no_drums_no_click_url'] = $datum['value'];
                $imported                                = true;
            }
            if ($datum['key'] == 'sheet_music_thumbnail_url') {
                $sanityDocuments['sheet_music_thumbnail_url'] = $datum['value'];
                $imported                                = true;
            }

            if ($datum['key'] == 'description' && $type != 'song') {
                $imported                    = true;
                $sanityDocuments['description'][] = [
                    '_type'    => 'block',
                    'style'    => 'normal',
                    'markDefs' => [],
                    'children' => [
                        [
                            '_type' => 'span',
                            "marks" => [],
                            'text'  => $datum['value']
                        ]
                    ]
                ];
            }
            //TODO: Check with Chris if all the data should be ignored
            if (!$imported && (!in_array($datum['key'], [
                    'original_thumbnail_url',
                    'header_image_url',
                    'learning_path_description',
                    'sbt_video_url',
                    'sbt_image_url',
                    'sheet_music_image_url',
                    'mp3_click_url',
                    'mp3_non_click_url',
                    'gear',
                    'captions',
                    'sales_url',
                    'registration_url',
                    'smart_beat_slow_bpm_mp3_url',
                    'smart_beat_sheet_music_image_url',
                    'smart_beat_fast_bpm_mp3_url',
                    'sbt_fast_mp3_url',
                    'sbt_slow_mp3_url',
                    'pack_resources',
                    'mp3_url',
                    'mp3_name',
                    'pdf_url',
                    'pdf_name',
                    'zip_url',
                    'zip_name',
                    'extended_description',
                    'summary',
                    'extended_description_subtitle',
                    'gs_legacy_vimeo',
                    'rev_caption_order_uri',
                    'mobile_banner_url',
                    'tablet_banner_url',
                    'web_banner_url',
                    'background_image_url',
                    //foundation unit-part
                    'song_title',
                    'song_slow_bpm',
                    'song_fast_bpm',
                    'mp3_no_piano_no_click_slow_bpm_url',
                    'mp3_no_piano_no_click_fast_bpm_url',
                    'mp3_no_piano_yes_click_slow_bpm_url',
                    'mp3_no_piano_yes_click_fast_bpm_url',
                    'mp3_yes_piano_no_click_slow_bpm_url',
                    'mp3_yes_piano_no_click_fast_bpm_url',
                    'mp3_yes_piano_yes_click_slow_bpm_url',
                    'mp3_yes_piano_yes_click_fast_bpm_url',
                    //unit
                    'header_background_image_url',
                    'description'
                ]))) {
                $notImportedData[] = $datum['key'];
            }
        }
        if (!empty($notImportedData)) {
            dd($notImportedData);
        }

        $sanityDocuments['show_in_new_feed'] = false;
        $sanityDocuments['is_featured']      = false;
        $sanityDocuments['hide_from_recsys'] = false;

        $contentExtraData  = [];
        $notImportedFields = [];

        foreach ($result->fields as $field) {
            $imported = false;
            if (in_array(
                $field['key'],
                [
                        'soundslice_slug',
                        'name',
                        'gear',
                        'low_soundslice_slug',
                        'high_soundslice_slug',
                        'registration_url',
                        'song_name',
                        'live_event_youtube_id',
                        'soundslice_slug',
                    ]
            ) && $field['value'] != '') {
                $sanityDocuments[$field['key']] = $field['value'];
                $imported                  = true;
            }
            if (in_array(
                $field['key'],
                [  'enrollment_start_time',
                        'enrollment_end_time',
                        'live_event_start_time',
                        'live_event_end_time',
                    ]
            ) && $field['value'] != '') {
                try {
                    // Attempt to parse and format the date
                    $sanityDocuments[$field['key']] = $this->formatDateForImport($field['value']);
                    $imported = true;
                } catch (\Exception $e) {
                    $imported = true;
                }
            }
            if ($field['key'] == 'artist') {
                $artistName = preg_replace('/[^a-zA-Z0-9_]/', '', $field['value']);
                if (isset($artists['artist_' . strtolower($artistName)])) {
                    $sanityDocuments["artist"] = [
                        "_type" => "reference",
                        "_ref"  => 'artist_' . strtolower($artistName),
                        "_weak" => false
                    ];
                }
                $imported = true;
            }

            if ($field['key'] == 'show_in_new_feed') {
                $sanityDocuments['show_in_new_feed'] = ($field['value'] == 1);
                $imported                       = true;
            }
            if ($field['key'] == 'is_featured') {
                $sanityDocuments['is_featured'] = ($field['value'] == 1);
                $imported                  = true;
            }
            if ($field['key'] == 'hide_from_recsys') {
                $sanityDocuments['hide_from_recsys'] = ($field['value'] == 1);
                $imported                       = true;
            }

            if (array_key_exists($field['key'], $extraModels)) {
                $contentExtraData[$field['key']][] = $field['value'];
                $imported                          = true;
            }
            if (($field['key'] == 'essentials')) {
                $contentExtraData['essential'][] = $field['value'];
                $imported                        = true;
            }
            if (($field['key'] == 'style')) {
                $contentExtraData['genre'][] = $field['value'];
                $imported                        = true;
            }
            if ($field['key'] == 'gear') {
                $sanityDocuments['gear'] = $field['value'];
                $imported           = true;
            }
            if ($field['key'] == 'length_in_seconds') {
                $sanityDocuments['length_in_seconds'] = (int) $field['value'];
                $imported           = true;
            }
            if ($field['key'] == 'transcriber_name') {
                $transcriber =  preg_replace('/[^a-zA-Z0-9_]/', ' ', $field['value']);
                $sanityDocuments['transcriber_name'] = $transcriber;
                $imported           = true;
            }
            if ($field['key'] == 'released' || $field['key'] == 'bpm') {
                $sanityDocuments[$field['key']] = (int) $field['value'];
                $imported           = true;
            }
            if ($field['key'] == 'album') {
                $sanityDocuments['album'] = preg_replace('/[^a-zA-Z0-9_]/', ' ', $field['value']);
                $imported           = true;
            }

            if ($field['key'] == 'video') {
                $video = Content::with('fields')->where('railcontent_content.id', '=', $field['value'])->first();
                if ($video) {
                    $sanityDocuments['video']['type']        = $video['type'];
                    $sanityDocuments['video']['external_id'] = ($video['type'] == 'vimeo-video') ? $video['vimeo_video_id'] : $video['youtube_video_id'];
                    if ($sanityDocuments['video']['external_id'] == null) {
                        $this->info('vimeo_external_id is missing');
                        foreach ($video['fields'] as $videoField) {
                            if ($videoField['key'] == 'vimeo_video_id') {
                                $sanityDocuments['video']['external_id'] = $videoField['value'];
                            }
                        }
                    }
                    $sanityDocuments['length_in_seconds']    = (int)$video['length_in_seconds'];
                    if (($video['type'] != 'vimeo-video') && $sanityDocuments['length_in_seconds'] == 0) {
                        foreach ($video['fields'] as $videoField) {
                            if ($videoField['key'] == 'length_in_seconds') {
                                $sanityDocuments['length_in_seconds'] = (int) $videoField['value'];
                            }
                        }
                    }

                    if ($video['type'] == 'vimeo-video' && ($sanityDocuments['video']['external_id'] != null)) {
                        $vimeoData = Vimeo::query()->where('external_id', '=', $sanityDocuments['video']['external_id'])->first();
                        if ($vimeoData) {
                            $sanityDocuments['video']['hlsManifestUrl'] = $vimeoData['hlsManifestUrl'];
                            $sanityDocuments['video']['video_playback_endpoints'] = json_decode($vimeoData['video_playback_endpoints']);
                            $length = $vimeoData['length_in_seconds'] ?? $sanityDocuments['length_in_seconds'];
                            $sanityDocuments['length_in_seconds'] = (int) $length;
                        }
                        $vimeoVideos[$id] =  $sanityDocuments['video']['external_id'];
                    }
                }
                $imported = true;
            }

            //TODO: Check with Chris if all the fields should be ignored
            if (!$imported && (!in_array($field['key'], [
                    'title',
                    'instructor',
                    'difficulty',
                    'tag',
                    'style',
                    'legacy_wordpress_post_id',
                    'xp',
                    'total_xp',
                    'staff_pick_rating',
                    'home_staff_pick_rating',
                    'sbt_exercise_number',
                    'sbt_bpm',
                    'exercise_id',
                    'slow_bpm',
                    'fast_bpm',
                    'live_stream_feed_type',
                    'qna_video',
                    'playlist',
                    'instructors',
                    'week',
                    //  'released',
                    //  'album',
                    'legacy_id',
                    'exercise-book-pages',
                    'cd-tracks',
                    'student_id',
                    'soundslice_slug',
                    'related_lesson',
                    'difficulty_range',
                    //Foundation unit part
                    'includes_song',
                    'length_in_seconds'
                ]))) {
                $notImportedFields[] = $field['key'];
            }
        }
        if (!empty($notImportedFields)) {

            dd($notImportedFields);
        }
        foreach ($resources as $resource) {
            if (isset($resource['resource_name']) && isset($resource['resource_url'])) {
                $sanityDocuments["resource"][] = [
                    'resource_name' => $resource['resource_name'],
                    'resource_url'  => $resource['resource_url']
                ];
            }
        }

        $this->handleContentChapters($chapters, $sanityDocuments, $id);
        $this->handlePermissions($result, $permissions, $sanityDocuments, $id);
        $this->handleExtraData($contentExtraData, $extraData, $sanityDocuments, $id);
        $this->handleGenre($extraData, $sanityDocuments, $id);
        $this->handleInstructors($result, $instructors, $sanityDocuments, $id);
        $this->handleChildren($result, $sanityDocuments, $id, $type);
        if ($result->type == 'challenge') {
            $sanityDocuments = $this->handleCohortImport($result, $sanityDocuments);
        }
        if (!$result->total_xp || $result->total_xp == 0) {
            $default = $this->getDefaultTotalXp($result->type, $result->difficulty);
            $sanityDocuments['total_xp'] = (($sanityDocuments['xp'] != 0) ? $sanityDocuments['xp'] : $default) + ($sanityDocuments['assignments_total_xp'] ?? 0) + ($sanityDocuments['children_total_xp'] ?? 0);
        }
        unset($sanityDocuments['assignments_total_xp']);
        unset($sanityDocuments['children_total_xp']);

        if(isset($sanityDocuments["genre"])) {
            $sanityDocuments["genre"] = array_values(
                array_reduce($sanityDocuments["genre"], function ($carry, $item) {
                    $refs = array_column($carry, '_ref');
                    if (!in_array($item['_ref'], $refs)) {
                        $carry[] = $item;
                    }

                    return $carry;
                },           [])
            );
        }

        return $sanityDocuments;
    }

    /**
     * @param array $vimeoVideos
     * @param       $vimeoVideoSourcesDecorator
     * @param array $sanityDocuments
     * @return array
     */
    private function syncVimeoData(array $vimeoVideos, $vimeoVideoSourcesDecorator, array &$sanityDocuments): array
    {
        $this->info('Start vimeo data pull for ' . count($vimeoVideos) . ' videos');
        foreach ($vimeoVideos as $contentIndex => $externalId) {
            $video = $vimeoVideoSourcesDecorator->decorate($externalId);
            if ($video) {
                Vimeo::updateOrInsert(
                    ['external_id' => $externalId],
                    [
                        'video_poster_image_url'   => $video['video_poster_image_url'],
                        'video_playback_endpoints' => json_encode($video['video_playback_endpoints']),
                        'hlsManifestUrl'           => $video['hlsManifestUrl'],
                        'length_in_seconds'        => $video['length_in_seconds']
                    ]
                );
                $sanityDocuments[$contentIndex]['video']['hlsManifestUrl']           = $video['hlsManifestUrl'];
                $sanityDocuments[$contentIndex]['video']['video_playback_endpoints'] = $video['video_playback_endpoints'];
                $length = $video['length_in_seconds'] ?? $sanityDocuments[$contentIndex]['length_in_seconds'];
                $sanityDocuments[$contentIndex]['length_in_seconds']                 = (int) $length ;
            }
        }
        $this->info('Finish vimeo data pull');

        return $sanityDocuments;
    }

    private function getDefaultTotalXp($type, $difficulty)
    {
        $specialTypeXP = ['pack' => 5000, 'pack-bundle' => 500,
                          'unit' => 1000, 'learning-path' => 5000, 'learning-path-level' => 1000, 'learning-path-course' => 150, 'course' => 500, 'song' => 150];
        $difficultyXp = ['1' => 100,'2' => 100,'3' => 100,
                         'Beginner' => 100, 'Intermediate' => 150,'All' => 150,'Al' => 150, 'All Skill Levels' => 150,'Advanced' => 200,  '4' => 150,'5' => 150,'6' => 150,'7' => 200,'8' => 200,'9' => 200,'10' => 200,'500' => 150, '05' => 150, '02' => 100, '01' => 100];
        $defaultXPperType = $specialTypeXP[$type] ?? 0;
        $difficultyDefaultXP = $difficultyXp[$difficulty] ?? 0;

        return ($defaultXPperType != 0) ? $defaultXPperType : $difficultyDefaultXP;

    }

    private function  importOnboardingCards()
    {
        $structuredCards = [];
        $contentIds = [];
        $cards = config('learning.v2');
        foreach($cards as $brand => $accessLevels) {
            foreach($accessLevels as $accessLevel => $difficulties) {
                foreach($difficulties as $difficulty => $contentTuple) {
                    $contentIds[] = $contentTuple[0]['id'];
                    $contentIds[] = $contentTuple[1]['id'];
                }
            }
        }
        $idsString = implode(',', $contentIds);
        $query = "*[railcontent_id in [{$idsString}] ]{
          _id,
          railcontent_id,
          web_url_path,
          _type,
        }";
        $sanityGateway = app()->make(SanityGateway::class);
        $documents = $sanityGateway->sanity->fetch($query);
        foreach($cards as $brand => $accessLevels) {
            foreach($accessLevels as $accessLevel => $difficulties) {
                foreach($difficulties as $difficulty => $contentTuple) {
                    $difficultyString = OnboardingSkillLevelEnum::tryFrom($difficulty)->name;
                    $content1Document = null;
                    $content2Document = null;
                    foreach($documents as $document) {
                        if (!is_null($content1Document) && !is_null($content2Document)) {
                            break;
                        } elseif ($document['railcontent_id'] == $contentTuple[0]['id']) {
                            $content1Document = $document;
                        } elseif ($document['railcontent_id'] == $contentTuple[1]['id']) {
                            $content2Document = $document;
                        }
                    }
                    if (!$content1Document && !$content2Document) {
                        continue;
                    }

                    $structuredCards[] = [
                        '_type' => 'onboarding-content-card',
                        '_id' => strtolower('onboarding_content_card_' . $brand . '_' . $accessLevel . '_' . $difficultyString),
                        'description' => ucfirst($brand) . ' - ' . ucfirst($accessLevel) . ' - ' . $difficultyString,
                        'brand' => $brand,
                        'access_level' => $accessLevel,
                        'experience_level' => $difficultyString,
                        'first_content' => [
                            ...$this->getOnboardingCardContentFields($contentTuple[0]),
                            'content' => [
                                "_type" => "reference",
                                "_ref"  => $content1Document['_id'],
                                "_weak" => false
                            ],
                        ],
                        'second_content' => [
                            ...$this->getOnboardingCardContentFields($contentTuple[1]),
                            'content' => [
                                "_type" => "reference",
                                "_ref"  => $content2Document['_id'],
                                "_weak" => false
                            ],
                        ],
                    ];
                }
            }
        }
        return $structuredCards;
    }

    private function getOnboardingCardContentFields($cardContent)
    {
        $fields = ['header', 'subheader'];
        $imageFields = ['logo', 'bgImg', 'wideImg', 'squareImg'];
        $output = [];
        foreach($fields as $field) {
            $output[$field] = $cardContent[$field] ?? null;
        }
        foreach($imageFields as $imageField) {
            if (isset($cardContent[$imageField])) {
                $output[$imageField] = [
                    '_type' => 'image',
                    '_sanityAsset' => 'image@' . $cardContent[$imageField]
                ];
            }
        }
        return $output;
    }

    private function formatDateForImport($date) : string
    {
        return Carbon::parse($date)->toISOString();
    }
}
