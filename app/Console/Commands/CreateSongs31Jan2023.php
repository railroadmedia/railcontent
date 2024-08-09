<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;

class CreateSongs31Jan2023 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CreateSongs31Jan2023';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CreateSongs31Jan2023';


    /**
     * Create a new command instance.
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
    public function handle(ContentRepository $contentRepository): void
    {
        $this->info('Starting CreateSongs31Jan2023...');
        $csv = array_map(function ($v) {return str_getcsv($v, ",");}, file(base_path('csv_songs_imports/songs_import_jan_31_2023.csv')));
        unset($csv[0]);

        // to be updated in case the csv has more than 2000 songs
        //        $csv = array_slice($csv, 0, 4000);

        foreach ($csv as $rowIndex => $row) {
            $brand = lcfirst($row[0]);

            $searchAttributes = (array_key_exists(15, $row) && $row[15] !== "") ? ['id' => $row[15]] : [
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

            if (!empty($existingContent)) {
                $contentId = $existingContent->id;
                $this->musoraDB()->from('railcontent_content')->where('id', $existingContent->id)
                    ->update([
                        'slug' => $existingContent ? $existingContent->slug : ContentHelper::slugify($row[2]),
                        'brand' => $brand,
                        'type' => 'song',
                        'status' => 'published',
                        'album' => $row[3],
                        'language' => 'en-US',
                        'instrumentless' => $this->convertToBool($row[13]),
                        'published_on' => $existingContent ? $existingContent->published_on : Carbon::now(
                        )->toDateTimeString(),
                        'created_on' => $existingContent ? $existingContent->created_on : Carbon::now(
                        )->toDateTimeString(),
                    ]);
            } else {
                $contentId = $this->musoraDB()->from('railcontent_content')
                    ->insertGetId(
                        [
                        'slug' => $existingContent ? $existingContent->slug : ContentHelper::slugify($row[2]),
                        'brand' => $brand,
                        'type' => 'song',
                        'status' => 'published',
                        'album' => $row[3],
                        'language' => 'en-US',
                        'instrumentless' => $this->convertToBool($row[13]),
                        'published_on' => $existingContent ? $existingContent->published_on : Carbon::now(
                        )->toDateTimeString(),
                        'created_on' => $existingContent ? $existingContent->created_on : Carbon::now(
                        )->toDateTimeString(),
                    ]
                    );
            }

            $content = $this->musoraDB()->from('railcontent_content')->where('id', $contentId)
                ->first();

            // fields
            if ($this->convertToBool($row[13]) && $brand == 'drumeo') {
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_fields',
                    [
                        'content_id' => $content->id,
                        'key' => 'style',
                        'type' => 'string',
                        'position' => 5,
                    ],
                    [
                        'value' => 'Drums-Removed',
                    ]
                );
            }

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

            // pdf download
            if ($brand == 'guitareo') {
                $pdfUrlPrefix = 'https://d1923uyy6spedc.cloudfront.net/songs-jan-2022/pdfs/guitareo/';
                $pdfResourceName1 = 'PDF Tabs';
                $pdfResourceName2 = 'PDF Tabs + Notation';
            } elseif ($brand == 'pianote') {
                $pdfUrlPrefix = 'https://d1923uyy6spedc.cloudfront.net/songs-jan-2022/pdfs/pianote/';
                $pdfResourceName1 = 'PDF Sheet Music';
                $pdfResourceName2 = 'PDF Sheet Music';
            } elseif ($brand == 'drumeo') {
                $pdfUrlPrefix = 'https://d1923uyy6spedc.cloudfront.net/songs-jan-2022/pdfs/drumeo/';
                $pdfResourceName1 = 'PDF Sheet Music';
                $pdfResourceName2 = 'PDF Sheet Music';
            }

            $pdfFileName = $row[8];
            $guitareoPdfFileName = ((array_key_exists(14, $row) && $brand == 'guitareo')) ? $row[14] : null;

            //            $this->info('-------------------------------');
            //            $this->info($row[0] . $row[1] . $row[2]);
            //            $this->info($pdfFileName);

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

            $existingAssignment = null;
            if ($assignmentChildren) {
                $existingAssignment = $assignmentChildren[0];
                if (count($assignmentChildren) > 1) {
                    $this->info('For content id ' . $content->id . " more than 1 child has been found in railcontent_content_hierarchy. Please investigate.");
                }
            }

            /* if assignment already exists, update just title and published_on value;
                else create new assignment with all the necessary values */
            if ($existingAssignment) {
                $attributes = ['id' => $existingAssignment['id']];
                $values = [
                    'title' => $row[9],
                    'published_on' => Carbon::now()->toDateTimeString()
                ];
            } else {
                $attributes = [
                    'slug' => ContentHelper::slugify($row[2]),
                    'type' => 'assignment',
                    'published_on' => Carbon::now()->toDateTimeString(),
                    'created_on' => Carbon::now()->toDateTimeString(),
                ];
                $values =                 [
                    'title' => $row[9],
                    'sort' => 0,
                    'status' => 'published',
                    'brand' => $brand,
                    'language' => 'en-US'
                ];
            }

            $assignment = $this->updateOrInsertAndGetFirst('railcontent_content', $attributes, $values);

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

            $existingContentHierarchy = $this->getFirst(
                'railcontent_content_hierarchy',
                [
                    'parent_id' => $content->id,
                    'child_id' => $assignment->id,
                    'child_position' => 1,
                ]
            );

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

    private function convertToBool($instrumentlessValue)
    {
        if (is_numeric($instrumentlessValue)) {
            return boolval($instrumentlessValue);
        } elseif (strtolower($instrumentlessValue) === 'false' || $instrumentlessValue === "") {
            return 0;
        } elseif (strtolower($instrumentlessValue) === 'true') {
            return 1;
        } else {
            $this->info('Invalid value for instrumentless. Please check the data');
            return 0;
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
