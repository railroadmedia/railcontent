<?php

namespace App\Modules\Content\Console\Commands;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentHierarchy;
use App\Modules\Content\Models\ContentInstructor;
use App\Modules\Content\Models\ContentPermissions;
use App\Modules\Content\Models\ContentStyle;
use App\Modules\Content\Models\Permission;
use App\Modules\Content\Models\Sanity\Enums\FilterType;
use Illuminate\Database\Eloquent\Collection;
use Modules\Content\Models\ContentCreativity;
use Modules\Content\Models\ContentEssentials;
use Modules\Content\Models\ContentGears;
use Modules\Content\Models\ContentLifestyle;
use Modules\Content\Models\ContentTheory;
use Modules\Content\Models\ContentTopic;
use Railroad\Railcontent\Helpers\ContentHelper;

class ImportContentsInSanity extends \Illuminate\Console\Command
{
    protected $signature = 'sanity:import-content {destination=development} {clean=false} {brand=drumeo} {type=all} {delete=false}';

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

        $extraModels = [
            'lifestyle'  => ContentLifestyle::class,
            'essential'  => ContentEssentials::class,
            'creativity' => ContentCreativity::class,
            'theory'     => ContentTheory::class,
            'topic'      => ContentTopic::class,
            'genre'      => ContentStyle::class,
            'gear'       => ContentGears::class,
        ];
        $permissions = $this->getPermissions();

        $artists = $this->getArtists();

        $instructors = $this->getInstructors();

        $extraData = $this->getExtraData($extraModels);

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
                    //'routine',
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

        foreach ($contentTypes as $cType) {
            $this->info(" ---- Start $cType migration. ----");
            $this->importData($cType, $extraModels, $permissions, $extraData, $instructors, $deleteOldDocuments, $destination, $artists);
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
    private function getInstructors(): array
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
            foreach ($instructorDatum['fields'] as $info) {
                if (in_array($info['key'], ['is_coach', 'is_active', 'is_hose_coach', 'is_featured', 'is_coach_of_the_month'])) {
                    $instructors[$id][$info['key']] = ($info['value'] == 1);
                }
                if (in_array($info['key'], ['bands', 'endorsements'])) {
                    $instructors[$id][$info['key']] = $info['value'];
                }
                if (in_array($info['key'], ['associated_user_id', 'forum_thread_id'])) {
                    $instructors[$id][$info['key']] = (int)$info['value'];
                }
                if (in_array($info['key'], ['focus'])) {
                    $instructors[$id][$info['key']][] = $info['value'];
                }
            }
            if ($thumb != '') {
                $instructors[$id]['thumbnail_url'] = [
                    '_type'        => 'image',
                    '_sanityAsset' => 'image@' . $thumb
                ];
            }
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
        array $artists
    ): void {
        $results = Content::with('data', 'fields')->where('railcontent_content.type', '=', $contentType)
            ->where('railcontent_content.status', '!=', 'deleted')
            ->where('railcontent_content.brand', '=', $this->argument('brand'))
           // ->where('railcontent_content.id','=',18920)
            ->whereNotIn('railcontent_content.id', [402037, 30437, 206255, 375281, 30435, 203875, 257259, 268071, 268094, 268097,268122,
                23313, 23393, 23395, 29663,
                410145, 331419, 350720, 331265, 268090])->get();

        $songs = [];
        foreach ($results as $result) {
            $type       = isset($this->contentTypeToSanityTypeMapping[$result->type]) ? $this->contentTypeToSanityTypeMapping[$result->type] : $result->type;
            $id         = $type . '_' . $result->id;
            $difficulty = (int)$result->difficulty;
            $parentType = [
                'course-part'          => 'course',
                'challenge-part'       => 'challenge',
                'semester-pack-lesson' => 'semester-pack'
            ];

            $songs[$id] = [
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
                "web_url_path"     => $result->web_url_path ?? ('/' . $result->brand . '/' . $contentType . '/' . $result->slug . '/' . $result->id),
                "popularity"       => $result->popularity
            ];
            if ($result->sort != 0) {
                $songs[$id]['sort'] = $result->sort;
            }
            if ($result->child_count != 0) {
                $songs[$id]['child_count'] = $result->child_count;
            }
            if (isset($parentType[$type])) {
                $songs[$id]['parent_type'] = $parentType[$type];
            }
            if (isset($this->difficultyMapping[$difficulty])) {
                $songs[$id]["difficulty_string"] = $this->difficultyMapping[$difficulty];
            }
            $resources       = [];
            $chapters        = [];
            $notImportedData = [];
            foreach ($result->data as $datum) {
                $imported = false;
                if ($datum['key'] == 'thumbnail_url' && $datum['value'] != '') {
                    $songs[$id]['thumbnail'] = [
                        '_type'        => 'image',
                        '_sanityAsset' => 'image@' . $datum['value']
                    ];
                    $imported                = true;
                }
                if (in_array($datum['key'], ['logo_image_url', 'dark_mode_logo_url', 'light_mode_logo_url']) && $datum['value'] != '') {
                    $songs[$id][$datum['key']] = [
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
                    $songs[$id]['mp3_yes_drums_yes_click_url'] = $datum['value'];
                    $imported                                  = true;
                }
                if ($datum['key'] == 'mp3_yes_drums_no_click_url') {
                    $songs[$id]['mp3_yes_drums_no_click_url'] = $datum['value'];
                    $imported                                 = true;
                }
                if ($datum['key'] == 'mp3_no_drums_yes_click_url') {
                    $songs[$id]['mp3_no_drums_yes_click_url'] = $datum['value'];
                    $imported                                 = true;
                }
                if ($datum['key'] == 'mp3_no_drums_no_click_url') {
                    $songs[$id]['mp3_no_drums_no_click_url'] = $datum['value'];
                    $imported                                = true;
                }
                if ($datum['key'] == 'sheet_music_thumbnail_url') {
                    $songs[$id]['sheet_music_thumbnail_url'] = $datum['value'];
                    $imported                                = true;
                }

                if ($datum['key'] == 'description') {
                    $imported                    = true;
                    $songs[$id]['description'][] = [
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
                        'gs_legacy_vimeo'
                    ]))) {
                    $notImportedData[] = $datum['key'];
                }
            }
            if (!empty($notImportedData)) {
                dd($notImportedData);
            }

            $songs[$id]['show_in_new_feed'] = false;
            $songs[$id]['is_featured']      = false;
            $songs[$id]['hide_from_recsys'] = false;

            $contentExtraData  = [];
            $notImportedFields = [];

            foreach ($result->fields as $field) {
                $imported = false;
                if (in_array(
                    $field['key'],
                    [
                                 'soundslice_slug',
                                 'name',
                                 'bpm',
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
                        'soundslice_slug'
                             ]
                ) && $field['value'] != '') {
                    $songs[$id][$field['key']] = $field['value'];
                    $imported                  = true;
                }
                if ($field['key'] == 'artist') {
                    $artistName = preg_replace('/[^a-zA-Z0-9_]/', '', $field['value']);
                    if (isset($artists['artist_' . strtolower($artistName)])) {
                        $songs[$id]["artist"] = [
                            "_type" => "reference",
                            "_ref"  => 'artist_' . strtolower($artistName),
                            "_weak" => false
                        ];
                    }
                    $imported = true;
                }

                if ($field['key'] == 'show_in_new_feed') {
                    $songs[$id]['show_in_new_feed'] = ($field['value'] == 1);
                    $imported                       = true;
                }
                if ($field['key'] == 'is_featured') {
                    $songs[$id]['is_featured'] = ($field['value'] == 1);
                    $imported                  = true;
                }
                if ($field['key'] == 'hide_from_recsys') {
                    $songs[$id]['hide_from_recsys'] = ($field['value'] == 1);
                    $imported                       = true;
                }

                if (array_key_exists($field['key'], $extraModels) || ($field['key'] == 'essentials')) {
                    $contentExtraData[$field['key']][] = $field['value'];
                    $imported                          = true;
                }
                if (($field['key'] == 'essentials')) {
                    $contentExtraData['essential'][] = $field['value'];
                    $imported                        = true;
                }
                if ($field['key'] == 'gear') {
                    $songs[$id]['gear'] = $field['value'];
                    $imported           = true;
                }

                if ($field['key'] == 'video') {
                    $video = Content::query()->where('railcontent_content.id', '=', $field['value'])->first();
                    if ($video) {
                        $songs[$id]['video']['type']        = $video['type'];
                        $songs[$id]['video']['external_id'] = ($video['type'] == 'vimeo-video') ? $video['vimeo_video_id'] : $video['youtube_video_id'];
                        $songs[$id]['length_in_seconds']    = (int)$video['length_in_seconds'];
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
                        'released',
                        'album',
                        'legacy_id',
                        'exercise-book-pages',
                        'cd-tracks',
                        'student_id',
                        'soundslice_slug'
                        //'name'
                    ]))) {
                    $notImportedFields[] = $field['key'];
                }
            }
            if (!empty($notImportedFields)) {

                dd($notImportedFields);
            }
            foreach ($resources as $resource) {
                if (isset($resource['resource_name']) && isset($resource['resource_url'])) {
                    $songs[$id]["resource"][] = [
                        'resource_name' => $resource['resource_name'],
                        'resource_url'  => $resource['resource_url']
                    ];
                }
            }

            foreach ($chapters as $chapter) {
                if (isset($chapter['chapter_thumbnail_url']) && $chapter['chapter_thumbnail_url'] != '') {
                    $songs[$id]["chapter"][] =
                        [
                            'chapter_timecode'      => (int)($chapter['chapter_timecode'] ?? 0),
                            'chapter_description'   => $chapter['chapter_description'],
                            'chapter_thumbnail_url' => [
                                '_type'        => 'image',
                                '_sanityAsset' => 'image@' . $chapter['chapter_thumbnail_url']
                            ]
                        ];
                } else {
                    $songs[$id]["chapter"][] = [
                        'chapter_timecode'    => (int)($chapter['chapter_timecode'] ?? 0),
                        'chapter_description' => $chapter['chapter_description'],
                    ];
                }
            }

            $contentPermissions = ContentPermissions::with('permissions')->where('content_id', '=', $result->id)->get();
            foreach ($contentPermissions as $contentPermission) {
                $name = preg_replace('/[^a-zA-Z0-9_.]/', '', $contentPermission->permissions->name);
                if (isset($permissions['permission_' . strtolower($name)])) {
                    $songs[$id]["permission"][] = [
                        "_type" => "reference",
                        "_ref"  => 'permission_' . strtolower($name),
                        "_weak" => false
                    ];
                }
            }
            if (!empty($contentExtraData)) {
                foreach ($contentExtraData as $index => $contentExtra) {
                    if (strtolower($index) != 'gear') {
                        foreach ($contentExtra as $contentExtraDatum) {
                            $name = preg_replace('/[^a-zA-Z0-9_]/', '', $contentExtraDatum);
                            if (isset($extraData[$index][$index . '_' . strtolower($name)])) {
                                $songs[$id]["$index"][] = [
                                    "_type" => "reference",
                                    "_ref"  => $index . '_' . strtolower($name),
                                    "_weak" => false
                                ];
                            }
                        }
                    }
                }
            }

            $contentGenres = ContentStyle::query()->where('content_id', '=', $result->id)->get();
            foreach ($contentGenres as $contentGenre) {
                $name = preg_replace('/[^a-zA-Z0-9_.]/', '', $contentGenre->style);
                if (isset($extraData['genre']['genre_' . strtolower($name)])) {
                    $songs[$id]["genre"][] = [
                        "_type" => "reference",
                        "_ref"  => 'genre_' . strtolower($name),
                        "_weak" => false
                    ];
                }
            }

            $contentInstructors = ContentInstructor::with('instructor')->select('instructor_id')->where('content_id', '=', $result->id)->groupBy('instructor_id')->get();
            foreach ($contentInstructors as $contentInstructor) {
                if ($contentInstructor->instructor) {
                    $name = preg_replace('/[^a-zA-Z0-9_]/', '', $contentInstructor->instructor->name);
                    if (isset($instructors['instructor_' . strtolower($name) . '_' . $contentInstructor->instructor->id])) {
                        $songs[$id]["instructor"][] = [
                            "_type" => "reference",
                            "_ref"  => 'instructor_' . strtolower($name) . '_' . $contentInstructor->instructor->id,
                            "_weak" => false
                        ];
                    }
                }
            }

            $contentHierarchy = ContentHierarchy::with('child')->where('parent_id', '=', $result->id)->orderBy('child_position','asc')->get();
            foreach ($contentHierarchy as $hierarchy) {
                if ($hierarchy->child) {
                    if ($hierarchy->child->type != 'assignment' && $hierarchy->child->status == 'published') {
                        $songs[$id]["child"][] = [
                            "_type" => "reference",
                            "_ref"  => $hierarchy->child->type . '_' . $hierarchy->child->id,
                            "_weak" => false
                        ];
                    } elseif ($hierarchy->child->type == 'assignment') {
                        unset($songs[$id]['child_count']);
                        $songs[$id]["assignment"][] = [
                            'assignment_title'             => $hierarchy->child->title,
                            'assignment_soundslice'        => $hierarchy->child->soundslice_slug,
                            'assignment_description'       => $hierarchy->child->data->where('key','=','description')->first()['value'] ?? '',
                            'assignment_sheet_music_image' => $hierarchy->child->data->where('key','=','sheet_music_image_url')->first()['value'] ?? '',
                            'railcontent_id'  => $hierarchy->child->id,
                        ];
                    }
                }
            }
        }
        $directory = resource_path() . '/sanitystudio';
        if ($deleteOldDocuments == "true") {
            $ids        = implode(' ', array_keys($songs));
            $resultCode = $this->runCliCommand("cd $directory && yarn sanity documents delete --dataset=development " . $ids);
        }
        $filename2 = $directory . '/contents.ndjson';

        foreach ($songs as $result) {
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
}
