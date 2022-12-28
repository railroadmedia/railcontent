<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;


class CreateSongsDecember2022 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CreateSongsDecember2022';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CreateSongsDecember2022';


    /**
     * Create a new command instance.
     *
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
    public function handle(
        ContentRepository $contentRepository,
    )
    {
        $this->info('Starting CreateSongsDecember2022...');

        $csv = array_map(function($v){return str_getcsv($v, ";");}, file(base_path('december_28_songs_import.csv')));
//        $csv = array_map(function($v){return str_getcsv($v, ";");}, file(base_path('december_19_songs_import_semi.csv')));

        unset($csv[0]);

        // to be updated in case the csv has more than 2000 songs
        $csv = array_slice($csv, 0, 2000);

        foreach ($csv as $rowIndex => $row) {
            $brand = lcfirst($row[0]);

            $searchAttributes = array_key_exists(15, $row) ? ['id' => $row[15]] : [
                'slug' => ContentHelper::slugify($row[2]),
                'type' => 'song',
                'status' => 'published',
                'brand' => $brand,
                'album' => $row[3],
            ];

            $existingContent = $this->getFirst('railcontent_content', $searchAttributes);

            if ($existingContent) {
                $this->info("Song <" . $existingContent->slug . "> with id " . $existingContent->id . " exists and will be updated.");
            }

            if (!empty($existingContent) && !empty($existingContent->id) && $brand == 'drumeo') {

                // for drumeo, we only need to add update instrumentless flag to true, nothing else should be updated
                $this->info('Setting instrumentless flag for existing drumeo content ' . $existingContent->id);

                $this->musoraDB()->from('railcontent_content')
                    ->where('id', $existingContent->id)
                    ->update(['instrumentless' => boolval($row[13]),]);

                event(new ContentCreated($existingContent->id));

                continue;
            }

            if (!$existingContent && $brand == 'drumeo') {
                $this->info('Failed to find existing drumeo song for row, skipping: ');
                var_dump($searchAttributes);
                continue;
            }
            $content = $this->updateOrInsertAndGetFirst('railcontent_content', $searchAttributes,
                [
                    'slug' => $existingContent ? $existingContent->slug : ContentHelper::slugify($row[2]),
                    'type' => 'song',
                    'status' => 'published',
                    'album' => $row[3],
                    'language' => 'en-US',
                    'instrumentless' => boolval($row[13]),
                    'published_on' => $existingContent ? $existingContent->published_on : Carbon::now()->toDateTimeString(),
                    'created_on' => $existingContent ? $existingContent->created_on : Carbon::now()->toDateTimeString(),
                ]
            );

            // fields
            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $content->id,
                    'key' => 'title',
                    'type' => 'string',
                    'position' => 1,
                ],
                [
                    'value' => $row[2],
                ]
            );
            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $content->id,
                    'key' => 'artist',
                    'type' => 'string',
                    'position' => 1,
                ],
                [
                    'value' => $row[1],
                ]
            );
            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $content->id,
                    'key' => 'album',
                    'type' => 'string',
                    'position' => 1,
                ],
                [
                    'value' => $row[3],
                ]
            );
            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $content->id,
                    'key' => 'difficulty',
                    'position' => 1,
                ],
                [
                    'type' => 'integer',
                    'value' => $row[5],
                ]
            );
            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $content->id,
                    'key' => 'xp',
                    'position' => 1,
                ],
                [
                    'type' => 'integer',
                    'value' => $row[6],
                ]
            );
            foreach (explode(', ', $row[4]) as $styleIndex => $style) {
                // todo: make sure explode is working properly
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_fields',
                    [
                        'content_id' => $content->id,
                        'key' => 'style',
                        'type' => 'string',
                        'position' => $styleIndex + 1,
                    ],
                    [
                        'value' => $style,
                    ]
                );
            }

            // todo: uncomment once we have proper pdfs links
            // pdf download
            if ($brand == 'guitareo') {
                $pdfUrlPrefix = 'https://d1923uyy6spedc.cloudfront.net/songs-jan-2022/pdfs/guitareo/';
                $pdfResourceName1 = 'PDF Tabs';
                $pdfResourceName2 = 'PDF Tabs + Notation';
            } elseif ($brand == 'pianote') {
                $pdfUrlPrefix = 'https://d1923uyy6spedc.cloudfront.net/songs-jan-2022/pdfs/pianote/';
                $pdfResourceName1 = 'PDF Sheet Music';
                $pdfResourceName2 = 'PDF Sheet Music';
            }

            $pdfFileName = $row[8];
            $guitareoPdfFileName = ((array_key_exists(14, $row) && $brand == 'guitareo')) ? $row[14] : null;

            $this->info('-------------------------------');
            $this->info($row[0] . $row[1] . $row[2]);
            $this->info($pdfFileName);

            if (!empty($pdfFileName) && !empty($pdfUrlPrefix) && !empty($pdfResourceName1)) {
                // here it overrides resource_name and resource_url values, if it already finds something on this position and key name
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_data',
                    [
                        'content_id' => $content->id,
                        'key' => 'resource_url',
                        'position' => 1,
                    ],
                    [
                        'value' => $pdfUrlPrefix . $pdfFileName,
                    ]
                );
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_data',
                    [
                        'content_id' => $content->id,
                        'key' => 'resource_name',
                        'position' => 1,
                    ],
                    [
                        'value' => $pdfResourceName1,
                    ]
                );
            }

            // guitareo only has a second PDF
            if (!empty($guitareoPdfFileName)  && !empty($pdfUrlPrefix) && !empty($pdfResourceName2)) {
                // here it overrides resource_name and resource_url values, if it already finds something on this position and key name
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_data',
                    [
                        'content_id' => $content->id,
                        'key' => 'resource_url',
                        'position' => 2,
                    ],
                    [
                        'value' => $pdfUrlPrefix . $guitareoPdfFileName,
                    ]
                );
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_data',
                    [
                        'content_id' => $content->id,
                        'key' => 'resource_name',
                        'position' => 2,
                    ],
                    [
                        'value' => $pdfResourceName2,
                    ]
                );
            }

            // album art thumbnail
            $albumArtUrlPrefix = 'https://d1923uyy6spedc.cloudfront.net/songs-jan-2022/thumbnails/';
            $albumArtFileName = $row[7];

            //            $this->info('-------------------------------');
            //            $this->info($row[0] . $row[1] . $row[2]);
            //            $this->info($albumArtFileName);

            if (!empty($albumArtFileName)) {
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_data',
                    [
                        'content_id' => $content->id,
                        'key' => 'original_thumbnail_url',
                        'position' => 1,
                    ],
                    [
                        'value' => $albumArtUrlPrefix . $albumArtFileName,
                    ]
                );
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_data',
                    [
                        'content_id' => $content->id,
                        'key' => 'thumbnail_url',
                        'position' => 1,
                    ],
                    [
                        'value' => $albumArtUrlPrefix . $albumArtFileName,
                    ]
                );
            } else {
                $this->info('Album art not found for: ');
                var_dump($row);
            }

            // assignment
            $assignmentChildren = $contentRepository->getByParentIdWhereTypeIn($content->id, ['assignment']);
            $assignmentSearchAttributes = [
                'title' => $row[9],
                'type' => 'assignment',
                'sort' => 0,
                'status' => 'published',
                'brand' => $brand,
            ];

            $existingAssignment = (count($assignmentChildren) == 1) ? $assignmentChildren[0] :
                (array)$this->getFirst('railcontent_content', $assignmentSearchAttributes);

            $assignment = $this->updateOrInsertAndGetFirst(
                'railcontent_content',
                [
                    'slug' => $existingAssignment ? $existingAssignment['slug'] : ContentHelper::slugify($row[2]),
                    'title' => $row[9],
                    'type' => 'assignment',
                    'sort' => 0,
                    'status' => 'published',
                    'brand' => $brand,
                ],
                [
                    'published_on' => ($existingContent && $existingAssignment) ? $existingContent->published_on : Carbon::now()->toDateTimeString(),
                    'created_on' => ($existingContent && $existingAssignment) ? $existingContent->created_on : Carbon::now()->toDateTimeString(),
                    'language' => 'en-US'
                ]
            );

            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $assignment->id,
                    'key' => 'title',
                    'type' => 'string',
                    'position' => 1,
                ],
                [
                    'value' => $row[2],
                ]
            );

            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $assignment->id,
                    'key' => 'soundslice_slug',
                    'type' => 'string',
                    'position' => 1,
                ],
                [
                    'value' => $row[11],
                ]
            );

            $existingContentHierarchy = $this->getFirst('railcontent_content_hierarchy',
                [
                    'parent_id' => $content->id,
                    'child_id' => $assignment->id,
                    'child_position' => 1,
                ]);

            $this->updateOrInsertAndGetFirst(
                'railcontent_content_hierarchy',
                [
                    'parent_id' => $content->id,
                    'child_id' => $assignment->id,
                    'child_position' => 1,
                ],

                [
                    'created_on' => ($existingContent && $existingContentHierarchy) ?
                        $existingContentHierarchy->created_on : Carbon::now()->toDateTimeString(),
                ]
            );

            event(new ContentCreated($content->id));
            event(new ContentCreated($assignment->id));

            $this->info('Done ' . $rowIndex);
        }
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return object
     */
    private function updateOrInsertAndGetFirst($table, array $attributes, array $values = [])
    {
        $this->musoraDB()->from($table)->updateOrInsert($attributes, $values);
        return $this->getFirst($table, $attributes);
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return object
     */
    private function getFirst($table, array $attributes)
    {
        return $this->musoraDB()->from($table)->where($attributes)->get()->first();
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
    }
}
