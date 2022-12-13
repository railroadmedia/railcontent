<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;

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
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * Create a new command instance.
     *
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        parent::__construct();

        $this->databaseManager = $databaseManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $songFile = file(base_path('DrumlessTestBatch.csv'));
        $csv = array_map('str_getcsv', $songFile);

        unset($csv[0]);

        // todo: treat situation when song has multiple styles
        // todo: treat instrumentless column when value is a string (TRUE)
        $csv = array_slice($csv, 0, 250);

        foreach ($csv as $rowIndex => $row) {
            $existingContent = $this->getFirst(
                'railcontent_content',
//                [
//                    'slug' => ContentHelper::slugify($row[2]),
//                    'type' => 'song',
//                    'status' => 'published',
//                    'brand' => lcfirst($row[0]),
//                    'album' => $row[3],
//                ]
                ['id' => $row[14]]  // todo: if row[14] : else, search for these parameters
            );

            if ($existingContent) {
                $this->info("Song <" . $existingContent->slug . "> with id " . $existingContent->id . " exists and will be updated.");
            }
            $content = $this->updateOrInsertAndGetFirst(
                'railcontent_content',
//                [
//                    'slug' => ContentHelper::slugify($row[2]),
//                    'type' => 'song',
//                    'status' => 'published',
//                    'brand' => lcfirst($row[0]),
//                    'album' => $row[3],
//                ],
                ['id' => $row[14]],  //todo: if row[14] : else, search for these parameters
                [
                    'slug' => $existingContent ? $existingContent->slug :ContentHelper::slugify($row[2]),
                    'type' => 'song',
                    'status' => 'published',
                    'album' => $row[3],
                    'language' => 'en-US',
                    'instrumentless' => $row[13],
                    // todo: set published_on to now!
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

            // todo: uncomment once we have proper pdfs and jpgs links
            // pdf download
            //            $pdfUrlPrefix = '';
            //            $pdfFileName = $row[8];

            //            $this->info('-------------------------------');
            //            $this->info($row[0] . $row[1] . $row[2]);
            //            $this->info($pdfFileName);

            //            if (!empty($pdfFileName)) {
            //                $this->updateOrInsertAndGetFirst(
            //                    'railcontent_content_data',
            //                    [
            //                        'content_id' => $content->id,
            //                        'key' => 'resource_url',
            //                        'position' => 1,
            //                    ],
            //                    [
            //                        'value' => $pdfUrlPrefix . $pdfFileName,
            //                    ]
            //                );
            //                $this->updateOrInsertAndGetFirst(
            //                    'railcontent_content_data',
            //                    [
            //                        'content_id' => $content->id,
            //                        'key' => 'resource_name',
            //                        'position' => 1,
            //                    ],
            //                    [
            //                        'value' => 'PDF Sheet Music',
            //                    ]
            //                );
            //            } else {
            //                $this->info('PDF not found for: ');
            //                var_dump($row);
            //            }

            //            // album art thumbnail
            //            $albumArtUrlPrefix = '';
            //            $albumArtFileName = $row[7];
            //
            ////            $this->info('-------------------------------');
            ////            $this->info($row[0] . $row[1] . $row[2]);
            ////            $this->info($albumArtFileName);
            //
            //            if (!empty($albumArtFileName)) {
            //                $this->updateOrInsertAndGetFirst(
            //                    'railcontent_content_data',
            //                    [
            //                        'content_id' => $content->id,
            //                        'key' => 'original_thumbnail_url',
            //                        'position' => 1,
            //                    ],
            //                    [
            //                        'value' => $albumArtUrlPrefix . $albumArtFileName,
            //                    ]
            //                );
            //                $this->updateOrInsertAndGetFirst(
            //                    'railcontent_content_data',
            //                    [
            //                        'content_id' => $content->id,
            //                        'key' => 'thumbnail_url',
            //                        'position' => 1,
            //                    ],
            //                    [
            //                        'value' => $albumArtUrlPrefix . $albumArtFileName,
            //                    ]
            //                );
            //            } else {
            //                $this->info('Album art not found for: ');
            //                var_dump($row);
            //            }

            // assignment
            $existingAssignment = $this->getFirst('railcontent_content',
                [
//                    'slug' => ContentHelper::slugify($row[2]),
                    'slug' => $content->slug,
                    'type' => 'assignment',
                    'sort' => 0,
                    'status' => 'published',
                    'brand' => lcfirst($row[0]),
                    'language' => 'en-US'
                ]
            );


            //todo: update
            $assignment = $this->updateOrInsertAndGetFirst(
                'railcontent_content',
                [
//                    'slug' => ContentHelper::slugify($row[2]),
                    'slug' => $content->slug,
                    'type' => 'assignment',
                    'sort' => 0,
                    'status' => 'published',
                    'brand' => lcfirst($row[0]),
                    'language' => 'en-US',
                ],
                [
                    // todo: set published_on to now!
                    'published_on' => ($existingContent && $existingAssignment) ? $existingContent->published_on : Carbon::now()->toDateTimeString(),
                    'created_on' => ($existingContent && $existingAssignment) ? $existingContent->created_on : Carbon::now()->toDateTimeString(),
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

        return $this->getFirst($table, $attributes, $values);
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
