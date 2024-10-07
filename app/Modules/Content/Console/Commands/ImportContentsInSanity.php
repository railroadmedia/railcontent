<?php

namespace App\Modules\Content\Console\Commands;

use App\Decorators\Content\VimeoTrailerDecorator;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentHierarchy;
use App\Modules\Content\Models\ContentInstructor;
use App\Modules\Content\Models\ContentPermissions;
use App\Modules\Content\Models\ContentStyle;
use App\Modules\Content\Models\Permission;
use App\Modules\Content\Models\Sanity\Enums\FilterType;
use App\Modules\Content\Models\Vimeo;
use Modules\Content\Models\ContentCreativity;
use Modules\Content\Models\ContentEssentials;
use Modules\Content\Models\ContentFocus;
use Modules\Content\Models\ContentGears;
use Modules\Content\Models\ContentLifestyle;
use Modules\Content\Models\ContentTheory;
use Modules\Content\Models\ContentTopic;
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
                [
                    'pack-bundle-lesson',
                    'pack-bundle',
                    'pack',
                    'course-part',
                    'course',
                    'workout',
                    'student-focus',
                    'play-along-part',
                    'play-along',
                    'rudiment',
                    'challenge-part',
                    'challenge',
                    'rhythms-from-another-planet',
                    'song-tutorial-children',
                    'song-tutorial',
                    'semester-pack-lesson',
                    'semester-pack'
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
            $related   = ['permissions.ndjson', 'instructors.ndjson', 'artists.ndjson'];
            foreach ($extraModels as $index => $extraModel) {
                $related[] = $index . '.ndjson';
            }
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
            ->whereNotIn('id', [404505, 389348, 395073])
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
        $results = $this->getContentResults($contentType, $railcontentId);

        $vimeoVideos = [];
        $sanityDocuments = $this->mapContentToSanityFormat($results, $extraModels, $extraData, $artists, $permissions, $instructors, $railcontentURLProvider, $vimeoVideos);

        $directory = resource_path() . '/sanitystudio';
        if ($deleteOldDocuments == "true") {
            $ids        = implode(' ', array_keys($sanityDocuments));
            $resultCode = $this->runCliCommand("cd $directory && yarn sanity documents delete --dataset=development " . $ids);
        }

        if ($this->option('vimeoRefresh')) {
            $this->syncVimeoData($vimeoVideos, $vimeoVideoSourcesDecorator, $sanityDocuments);
        }

        $filename2 = $directory . '/contents.ndjson';
        foreach ($sanityDocuments as $result) {
            $newline = json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
            file_put_contents($filename2, $newline, FILE_APPEND);
        }

        $filename = "contents.ndjson";
        // import into the destination
        $resultCode = $this->runCliCommand("cd $directory && yarn sanity dataset import $filename $destination --replace");
        if ($resultCode !== self::SUCCESS) {
            $this->error("Failed to import $contentType to $destination. Have you built Sanity Studio using the README instructions?");
        } else {
            $this->info("Dataset import $contentType to $destination complete.");

            // clean up the export file
            $resultCode = $this->runCliCommand("rm $directory/$filename");
            if ($resultCode !== self::SUCCESS) {
                $this->error("Failed to delete $filename");
            } else {
                $this->info('Generated file deleted from local storage.');
            }
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

        $contentGenres = ContentStyle::query()->where('content_id', '=', $id)->get();

        foreach ($contentGenres as $contentGenre) {
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
        $contentPermissions = ContentPermissions::with('permissions')->where('content_id', '=', $result->id)->get();
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
        $duration = 0;
        foreach ($contentHierarchy as $hierarchy) {
            if ($hierarchy->child) {
                if ($hierarchy->child->type != 'assignment' && $hierarchy->child->status != 'deleted') {
                    $duration += (int)$hierarchy->child->length_in_seconds;
                    $songs["child"][] = [
                        "_type" => "reference",
                        "_ref"  => $hierarchy->child->type . '_' . $hierarchy->child->id,
                        "_weak" => false
                    ];
                } elseif ($hierarchy->child->type == 'assignment' && $type == 'song') {
                    $songs["soundslice"][] = [
                        'soundslice_title'            => $hierarchy->child->title,
                        'soundslice_slug'             => $hierarchy->child->soundslice_slug,
                        'soundslice_length_in_second' => (isset($songs['length_in_seconds'])) ? (int)$songs['length_in_seconds'] : 0,

                    ];
                } elseif ($hierarchy->child->type == 'assignment') {
                    unset($songs['child_count']);
                    $songs["assignment"][] = [
                        'assignment_title'             => $hierarchy->child->title,
                        'assignment_soundslice'        => $hierarchy->child->soundslice_slug,
                        'assignment_description'       => $hierarchy->child->data->where('key', '=', 'description')->first()['value'] ?? '',
                        'assignment_sheet_music_image' => $hierarchy->child->data->where('key', '=', 'sheet_music_image_url')->first()['value'] ?? '',
                        'railcontent_id'               => $hierarchy->child->id,
                    ];
                }
            }
        }

        $songs['length_in_seconds'] = $duration;

        return $songs;
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

        return $query->whereNotIn('railcontent_content.id', [402037, 30437, 206255, 375281, 30435, 203875,   268094,
            23313, 23393, 23395, 29663,
            410145, 331419, 350720, 331265, 268090, 325246, 324389, 310413, 347097, 373123, 374076,213076, 213078, 264279])
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
            'published_on'     => $result->published_on,
            'show_in_new_feed' => $result->show_in_new_feed == 1,
            "web_url_path"     => $result->web_url_path,
            "popularity"       => $result->popularity
        ];
        if (!$result->web_url_path) {
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
        $resources       = [];
        $chapters        = [];
        $notImportedData = [];
        $contentWithWrongImage = [268071, 268097, 268122, 378258,382515,382827,391008,382879,391160,
            399638,                404279, 404299, 401415, 270443,
            318625, 382515, 382827, 382765, 382767, 391008, 396548, 399638, 404279, 404299,
            382879, 391008, 391160, 401415, 378258, 381186];
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
                        'enrollment_start_time',
                        'enrollment_end_time',
                        'live_event_start_time',
                        'live_event_end_time',
                        'live_event_youtube_id',
                        'soundslice_slug',
                    ]
            ) && $field['value'] != '') {
                $sanityDocuments[$field['key']] = $field['value'];
                $imported                  = true;
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
            if ($field['key'] == 'length_in_seconds' && $type != 'song') {
                $sanityDocuments['length_in_seconds'] = $field['value'];
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
                                $sanityDocuments['length_in_seconds'] = $videoField['value'];
                            }
                        }
                    }

                    if ($video['type'] == 'vimeo-video' && ($sanityDocuments['video']['external_id'] != null)) {
                        $vimeoData = Vimeo::query()->where('external_id', '=', $sanityDocuments['video']['external_id'])->first();
                        if ($vimeoData) {
                            $sanityDocuments['video']['hlsManifestUrl'] = $vimeoData['hlsManifestUrl'];
                            $sanityDocuments['video']['video_playback_endpoints'] = json_decode($vimeoData['video_playback_endpoints']);
                            $sanityDocuments['length_in_seconds'] = $vimeoData['length_in_seconds'] ?? $sanityDocuments['length_in_seconds'];
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
                $sanityDocuments[$contentIndex]['length_in_seconds']                 = $video['length_in_seconds'] ?? $sanityDocuments[$contentIndex]['length_in_seconds'];
            }
        }
        $this->info('Finish vimeo data pull');

        return $sanityDocuments;
    }
}
