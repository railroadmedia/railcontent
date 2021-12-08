<?php

namespace Railroad\Railcontent\Database\Seeds;

use App\Decorators\Content\Types\DrumeoMethodLearningPathDecorator;
use Carbon\Carbon;
use Exception;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class CoachV2Seeder extends Seeder
{
    /**
     * @var Generator
     */
    private $faker;

    private $databaseManager;

    /**
     * @param  Generator  $faker
     * @param  \Illuminate\Database\DatabaseManager  $databaseManager
     */
    public function __construct(
        Generator $faker,
        \Illuminate\Database\DatabaseManager $databaseManager
    ) {
        $this->faker = $faker;
        $this->databaseManager = $databaseManager;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // remove old seeded coaches and data first
        $this->musoraDB()->from('railcontent_content')
            ->where('type', 'coach')
            ->where('created_on', '>', '2021-10-01')
            ->where('brand', 'drumeo')
            ->delete();

        $this->musoraDB()->from('railcontent_content_fields')
            ->where('key', 'is_featured')
            ->delete();

        //r drumeo artisan db:seed
        $coachesFilePath = config('railcontent.coachesFilePath');

        $csv = array_map('str_getcsv', file($coachesFilePath));

        unset($csv[0]);

        foreach ($csv as $rowIndex => $row) {
            $content = $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContent,
                [
                    'slug' => ContentHelper::slugify($row[0]),
                    'type' => 'coach',
                    'sort' => 0,
                    'status' => ContentService::STATUS_PUBLISHED,
                    'brand' => ($row[1] != '') ? $row[1] : config('railcontent.brand'),
                ],
                [
                    'published_on' => Carbon::now()
                        ->toDateTimeString(),
                    'created_on' => Carbon::now()
                        ->toDateTimeString(),
                ]
            );

            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $content->id,
                    'key' => 'name',
                    'type' => 'string',
                    'position' => 1,
                ],
                [
                    'value' => $row[0],
                ]
            );

            if ($row[2] == '') {
                $genres =
                    $this->faker->randomElements(
                        ['Odd Time', 'Adult Contemporary', 'Ballad', 'CCM/Worship'],
                        rand(1, 3)
                    );
            } else {
                $genres = explode(', ', $row[2]);
            }

            foreach ($genres as $genreIndex => $genre) {
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_fields',
                    [
                        'content_id' => $content->id,
                        'key' => 'genre',
                        'type' => 'string',
                        'position' => $genreIndex + 1,
                    ],
                    [
                        'value' => $genre,
                    ]
                );
            }

            if ($row[3] == '') {
                $focuses =
                    $this->faker->randomElements(
                        [
                            'Performance',
                            'Rudiments',
                            'Musicianship',
                            'Technique',
                            'Motivation',
                            'Touring',
                            'Beginner Focused',
                        ],
                        rand(1, 3)
                    );
            } else {
                $focuses = explode(', ', $row[3]);
            }

            foreach ($focuses as $focusIndex => $focus) {
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_fields',
                    [
                        'content_id' => $content->id,
                        'key' => 'focus',
                        'type' => 'string',
                        'position' => $focusIndex + 1,
                    ],
                    [
                        'value' => $focus,
                    ]
                );
            }

            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $content->id,
                    'key' => 'is_active',
                    'type' => 'boolean',
                    'position' => 1,
                ],
                [
                    'value' => ($row[4] != '') ? $row[4] : false,
                ]
            );

            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $content->id,
                    'key' => 'is_featured',
                    'type' => 'boolean',
                    'position' => 1,
                ],
                [
                    'value' => ($row[5] != '') ? $row[5] : false,
                ]
            );

            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $content->id,
                    'key' => 'is_coach_of_the_month',
                    'type' => 'boolean',
                    'position' => 1,
                ],
                [
                    'value' => ($row[16] != '') ? $row[16] : false,
                ]
            );

            $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContentData,
                [
                    'content_id' => $content->id,
                    'key' => 'focus_text',
                    'position' => 1,
                ],
                [
                    'value' => ($row[6] != '') ? $row[6] : $this->faker->sentences(rand(1, 2), true),
                ]
            );

            $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContentData,
                [
                    'content_id' => $content->id,
                    'key' => 'short_bio',
                    'position' => 1,
                ],
                [
                    'value' => ($row[7] != '') ? $row[7] : $this->faker->sentences(rand(1, 2), true),
                ]
            );

            $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContentData,
                [
                    'content_id' => $content->id,
                    'key' => 'coach_card_image',
                    'position' => 1,
                ],
                [
                    'value' => ($row[8] != '') ? $row[8] : 'https://d1923uyy6spedc.cloudfront.net/coach-ai-influence-from-outside-fiels (1) 1-1637845344.png',
                ]
            );

            $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContentData,
                [
                    'content_id' => $content->id,
                    'key' => 'coach_bottom_banner_image',
                    'position' => 1,
                ],
                [
                    'value' => ($row[9] != '') ? $row[9] : 'https://d1923uyy6spedc.cloudfront.net/Ellipse 17577-1637846437.png',
                ]
            );

            $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContentFields,
                [
                    'content_id' => $content->id,
                    'key' => 'video',
                    'type' => 'content_id',
                    'position' => 1,
                ],
                [
                    'value' => ($row[10] != '') ? $row[10] : $this->randomVimeoVideoId(
                        ($row[1] != '') ? $row[1] : config('railcontent.brand')
                    ),
                ]
            );

            $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContentData,
                [
                    'content_id' => $content->id,
                    'key' => 'coach_top_banner_image',
                    'position' => 1,
                ],
                [
                    'value' => ($row[11] != '') ? $row[11] : 'https://drumeo-assets.s3.amazonaws.com/headers/ryan-van-poederooyen-action+1.png',
                ]
            );

            $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContentData,
                [
                    'content_id' => $content->id,
                    'key' => 'long_bio',
                    'position' => 1,
                ],
                [
                    'value' => ($row[12] != '') ? $row[12] : $this->faker->sentences(rand(1, 2), true),
                ]
            );

            $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContentData,
                [
                    'content_id' => $content->id,
                    'key' => 'forum_thread_url',
                    'position' => 1,
                ],
                [
                    'value' => ($row[13] != '') ? $row[13] : $this->faker->sentences(rand(1, 2), true),
                ]
            );

            $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContentData,
                [
                    'content_id' => $content->id,
                    'key' => 'coach_profile_image',
                    'position' => 1,
                ],
                [
                    'value' => ($row[14] != '') ? $row[14] : 'https://d1923uyy6spedc.cloudfront.net/layers (image)-1637846593.png',
                ]
            );

            $this->updateOrInsertAndGetFirst(
                ConfigService::$tableContentData,
                [
                    'content_id' => $content->id,
                    'key' => 'coach_featured_image',
                    'position' => 1,
                ],
                [
                    'value' => ($row[15] != '') ? $row[15] : 'https://d1923uyy6spedc.cloudfront.net/card_thumbnail-1637844287.png',
                ]
            );

            $bands = ['Lethargy', 'Today Is the Day', 'Mastodon', 'Arcadea'];
            foreach ($bands as $bandIndex => $band) {
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_fields',
                    [
                        'content_id' => $content->id,
                        'key' => 'bands',
                        'type' => 'string',
                        'position' => $bandIndex + 1,
                    ],
                    [
                        'value' => $band,
                    ]
                );
            }

            $endorsements = [
                'Dailor uses and endorses',
                'Tama drums and hardware',
                'Meinl cymbals',
                'Evans Drumheads, and Vater drumsticks.',
            ];
            foreach ($endorsements as $endorsementIndex => $endorsement) {
                $this->updateOrInsertAndGetFirst(
                    'railcontent_content_fields',
                    [
                        'content_id' => $content->id,
                        'key' => 'endorsements',
                        'type' => 'string',
                        'position' => $endorsementIndex + 1,
                    ],
                    [
                        'value' => $endorsement,
                    ]
                );
            }

            echo "Coach ".$row[0]." is created! \n";
        }

        //set featured on some lessons
        foreach ($this->featuredLessonsIds() as $lessonId) {
            $this->updateOrInsertAndGetFirst(
                'railcontent_content_fields',
                [
                    'content_id' => $lessonId,
                    'key' => 'is_featured',
                    'type' => 'boolean',
                    'position' => 1,
                ],
                [
                    'value' => true,
                ]
            );
        }

        // create dummy content that is scheduled to launch Jan 1st
        // Hannah Welton course, 'Writing The Perfect Drum Parts'
        $this->createHannahCourse();

    }

    private function createHannahCourse()
    {
        $content = $this->updateOrInsertAndGetFirst(
            'railcontent_content',
            [
                'slug' => 'writing-the-perfect-drum-parts',
                'type' => 'course',
                'sort' => 1,
                'status' => 'published',
                'brand' => 'drumeo',
                'language' => 'en-US',
                'user_id' => null,
                'total_xp' => 0,
            ],
            [
                'published_on' => '2021-12-31 20:00:00',
                'created_on' => '2021-12-07 20:00:00',
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
                'value' => 'Writing The Perfect Drum Parts',
            ]
        );

        // coach field
        $coachContent = $this->musoraDB()
            ->from('railcontent_content')
            ->where(
                [
                    'slug' => ContentHelper::slugify('Hannah Welton'),
                    'type' => 'coach',
                    'brand' => 'drumeo',
                ]
            )
            ->get()
            ->first();

        if (empty($coachContent)) {
            throw new Exception(
                'Could not find coach with name: '.'Hannah Welton'
            );
        }

        $this->updateOrInsertAndGetFirst(
            'railcontent_content_fields',
            [
                'content_id' => $content->id,
                'key' => 'coach',
                'type' => 'content_id',
                'position' => 1,
            ],
            [
                'value' => $coachContent->id,
            ]
        );

        // instructor field
        $instructorContent = $this->musoraDB()
            ->from('railcontent_content')
            ->where(
                [
                    'slug' => ContentHelper::slugify('Hannah Welton'),
                    'type' => 'instructor',
                    'brand' => 'drumeo',
                ]
            )
            ->get()
            ->first();

        if (empty($instructorContent)) {
            throw new Exception(
                'Could not find instructor with name: '.'Hannah Welton'
            );
        }

        $this->updateOrInsertAndGetFirst(
            'railcontent_content_fields',
            [
                'content_id' => $content->id,
                'key' => 'instructor',
                'type' => 'content_id',
                'position' => 1,
            ],
            [
                'value' => $instructorContent->id,
            ]
        );

        // thumbs
        $this->updateOrInsertAndGetFirst(
            'railcontent_content_data',
            [
                'content_id' => $content->id,
                'key' => 'original_thumbnail_url',
                'position' => 1,
            ],
            [
                'value' => 'https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/e264cf7d-49ad-4432-f07e-fe341bf2cc00/public',
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
                'value' => 'https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/e264cf7d-49ad-4432-f07e-fe341bf2cc00/public',
            ]
        );

        $this->updateOrInsertAndGetFirst(
            'railcontent_content_fields',
            [
                'content_id' => $content->id,
                'key' => 'is_featured',
                'type' => 'boolean',
                'position' => 1,
            ],
            [
                'value' => true,
            ]
        );
    }

    /**
     * @param  array  $attributes
     * @param  array  $values
     * @return object
     */
    private function updateOrInsertAndGetFirst($table, array $attributes, array $values = [])
    {
        $this->musoraDB()
            ->from($table)
            ->updateOrInsert($attributes, $values);
        $this->musoraDB()
            ->from($table)
            ->updateOrInsert($attributes, $values);

        return $this->musoraDB()
            ->from($table)
            ->where(array_merge($attributes, $values))
            ->get()
            ->first();
    }

    private function musoraDB()
    {
        return $this->databaseManager->connection('musora_mysql')
            ->query();
    }

    /**
     * @return mixed
     */
    private function randomThumbUrl()
    {
        return $this->faker->randomElement(
            [
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/domino-santantonio.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/john-wooton.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/dorothea-taylor.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/kaz-rodriguez.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/todd-sucherman.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/jared-falk.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/matt-mcguire.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/sarah-thawer.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/aric-importa.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/larnell-lewis.png',
                'https://drumeo-assets.s3.amazonaws.com/sales/2021/sub-pages/michael-schack.png',
            ]
        );
    }

    /**
     * @return mixed
     */
    private function randomVimeoVideoId($brand)
    {
        if ($brand = 'drumeo') {
            return $this->faker->randomElement(
                [
                    236547,
                    236543,
                    236538,
                    236536,
                    236501,
                    236458,
                    236448,
                    236447,
                    236446,
                    236445,
                    236430,
                    236426,
                    236421,
                    236413,
                    236408,
                    236326,
                    236325,
                    236320,
                    236319,
                    236318,
                    236317,
                    236307,
                    236299,
                    236291,
                    236275,
                    236262,
                    236261,
                    236260,
                    236259,
                    236258,
                    236257,
                    236255,
                    236252,
                    236250,
                    236248,
                    236246,
                    236244,
                    236241,
                    236239,
                    236237,
                    236235,
                    236232,
                    236230,
                    236228,
                    236226,
                    236224,
                    236222,
                    236219,
                    236217,
                    236215,
                    236213,
                    236211,
                    236203,
                    236179,
                    236173,
                    236171,
                    236158,
                    236157,
                    236103,
                    236099,
                    236098,
                    236087,
                    236082,
                    236041,
                    236040,
                    236039,
                    236028,
                    236027,
                    236026,
                    236025,
                    235992,
                    235979,
                    235898,
                    235894,
                    235890,
                    235889,
                    235888,
                    235887,
                    235886,
                    235885,
                    235884,
                    235882,
                    235880,
                    235878,
                    235856,
                    235842,
                    235834,
                    235833,
                    235724,
                    235713,
                    235712,
                    235642,
                    235631,
                    235627,
                    235626,
                    235615,
                    235599,
                    235598,
                    235597,
                ]
            );
        } elseif ($brand == 'pianote') {
            return $this->faker->randomElement(
                [
                    327276,
                    327236,
                ]
            );
        }
    }

    private function featuredLessonsIds()
    {
        return [
            312406,
            312395,
            299460,
            316856,
            319992,
            316834,
            196991,
            197006,
            197012,
            197016,
            197109,
            197117,
            197139,
            202597,
            203338,
            281001,
            272745,
            301772,
            280497,
            189972,
        ];
    }
}
