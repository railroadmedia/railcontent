<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ContentService;

class UpdateRoutines extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'UpdateRoutines';

    protected $signature = 'UpdateRoutines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update routines - December 2022';

    private $newRoutineData = [
        [
            'title' => 'Transition Routine For Chest Pullers',
            'description' => 'This routine is from level 8 of the Method. If you are a chest puller, this routine will help you navigate your transition with ease.',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/c81f77e7-7356-428b-6f4e-de8b45d0ae00/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => 'XDGMc',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => 'JDGMc',
            ],
        ],
        [
            'title' => 'Transition Routine For No Chest Voice',
            'description' => 'This routine is from level 8 of the Method. If you have no chest voice, this routine will help you navigate your transition with ease.',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/90025621-3e15-478e-7c17-78156bce5400/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => '8DGMc',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => 'WDGMc',
            ],
        ],
        [
            'title' => 'Transition Routine For Flippers',
            'description' => 'This routine is from level 8 of the Method. If you are a flipper, this routine will help you navigate your transition with ease.',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/f18dfede-44e8-4910-c775-1e392a20a100/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => 'BDGMc',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => 'LDGMc',
            ],
        ],
        [
            'title' => 'Transition Routine For Blenders',
            'description' => 'This routine is from level 8 of the Method. If you are a blender, this routine will help you navigate your transition with ease.',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/e6923ba0-7404-414c-92d6-d558da8f7d00/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => 'jDGMc',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => 'PDGMc',
            ],
        ],
        [
            'title' => 'Routine for Chest Pullers',
            'description' => 'This is the routine for Chest Pullers from Method Level 2. If you find that you have a very strong voice in your lower register, but it feels tense, or you lose power the higher you sing, then this routine is for you!',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/4733239c-b9d9-424a-d24c-e3c08b333600/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => 'Lk5kc',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => '4y5kc',
            ],
        ],
        [
            'title' => 'Routine For No Chest Voice',
            'description' => 'This is the routine for No Chest Voice from Method Level 2. If you find that you struggle to sing with strength and clarity, then this is the routine for you!',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/6cb01357-0e5b-4724-6cf0-35f136719d00/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => 'ny5kc',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => 'bY5kc',
            ],
        ],
        [
            'title' => 'Routine For Flippers',
            'description' => 'This is the routine for Flippers from Method Level 2. If you experience “flips,” “cracks,” or sudden losses of power as you sing from your lower to higher register, then you’ve found your vocal routine!',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/632fdcac-375e-4675-41cd-470c16fd3100/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => 'Ml5kc',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => 'Zl5kc',
            ],
        ],
        [
            'title' => 'Routine For Blenders',
            'description' => 'This is the routine for Blenders from Method Level 2. This routine is for singers that don’t experience any major “issues” but want to develop more strength, freedom, and balance in their singing voice.',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/43942b26-aeb4-497a-89c0-eaf242399100/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => 'yJ5kc',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => 'nb5kc',
            ],
        ],
        [
            'title' => 'Routine For A Morning Vocal Warm-Up',
            'description' => 'Doing a warm-up first thing in the morning is a great healthy habit for singers. This routine will prepare you for both speaking and singing!',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/28c62113-364d-4ce8-a304-ff6e1b279400/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => 'pwD4c',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => 'NYD4c',
            ],
        ],
        [
            'title' => 'Routine For Improving Your Voice',
            'description' => '9 Minutes are all you need to balance and strengthen your voice! Be sure to add this to your daily routine!',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/403d6dd5-90ec-40c9-de17-05efa8cc1b00/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => 'f1D4c',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => 'D1D4c',
            ],
        ],
        [
            'title' => 'Routine For A Complete Warm-Up',
            'description' => 'This routine will leave you feeling energized, grounded, and connected to your instrument.',
            'thumbnail_url' => 'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/b5ae3a02-ca00-474c-2b85-43a6dc3c8100/public',
            'sound_slice_high' => [
                'title' => 'High Voices',
                'slice_slug' => 'mwD4c',
            ],
            'sound_slice_low' => [
                'title' => 'Low Voices',
                'slice_slug' => 'vwD4c',
            ],
        ],
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): int
    {
        $this->info('Starting UpdateRoutines.');
        Log::info('Starting UpdateRoutines.');

        //update existing routines
        $routineContentRows =
            $this->musoraDB()
                ->from('railcontent_content')
                ->where('type', 'routine')
                ->where('brand', 'singeo')
                ->get();

        foreach ($routineContentRows as $routineContentRow) {
            $this->info('Updating '.$routineContentRow->title);
            Log::info('Updating '.$routineContentRow->title);

            switch ($routineContentRow->slug) {
                case '5-minute-pitch-training-routine':
                    $newTitle = 'Routine For Pitch Training';
                    $newDescription =
                        'This quick routine will allow you to build accuracy and  help you access your high and low notes without strain.';
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/552cd74e-8793-4f13-619c-3b85a8b8ec00/public';
                    break;
                case 'range-building-routine':
                    $newTitle = 'Routine To Build Range';
                    $newDescription =
                        'If you want to build strength and expand your range, this routine is for you! Warning: this routine involves some crazy sounds and lots of volume!';
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/a2584ab9-78d2-4622-4460-8f37f8d25700/public';
                    break;
                case 'building-balance':
                    $newTitle = 'Routine To Build Balance';
                    $newDescription =
                        'This routine focuses on neutral vowel shapes, which are great for building up both head and chest voice. If you are looking for a routine that will help you gain balance and control of your voice, this is a great place to start!';
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/5d0caacb-d491-41bb-e583-ed00c5037c00/public';
                    break;
                case 'the-free-voice':
                    $newTitle = 'Routine For A Free Voice';
                    $newDescription =
                        'This routine focuses on narrow vowel shapes, which will help you develop your head voice and gain access to the very highest notes of your vocal range.';
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/a64f0d70-a087-4156-8d4f-f787d27aa300/public';
                    break;
                case 'full-warm-up-or-cooldown-routine':
                    $newTitle = 'Routine For Full Warm-Up Or Cool-Down';
                    $newDescription =
                        ' Need a quick and easy routine to help warm-up or cool-down your voice? Focus on your vocal health with this 6-minute routine.';
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/dc3910cf-a0b6-4f9c-be97-cc8a36ceb900/public';
                    break;
                case '10-minute-warm-up':
                    $newTitle = 'Routine For A Quick Warm-Up';
                    $newDescription =
                        'If you need a quick warm-up to start your day or prepare for your vocal work, this 7-minute warm-up is for you. It is short, sweet, and to the point!';
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/03fb200a-f172-444e-ec89-ad9e56493600/public';
                    break;
            }

            if ($newTitle && $newDescription) {
                // set new title
                $this->updateOrInsertAndGetFirst('railcontent_content_fields', [
                    'content_id' => $routineContentRow->id,
                    'key' => 'title',
                    'type' => 'string',
                    'position' => 1,
                ], [
                                                     'value' => $newTitle,
                                                 ]);

                //set new description
                $this->updateOrInsertAndGetFirst('railcontent_content_data', [
                    'content_id' => $routineContentRow->id,
                    'key' => 'description',
                    'position' => 1,
                ], [
                                                     'value' => $newDescription,
                                                 ]);
                //set new thumbnail_url
                $this->updateOrInsertAndGetFirst('railcontent_content_data', [
                    'content_id' => $routineContentRow->id,
                    'key' => 'thumbnail_url',
                    'position' => 1,
                ], [
                                                     'value' => $newThumb,
                                                 ]);
                event(new ContentCreated($routineContentRow->id));
            }
        }

        foreach ($this->newRoutineData as $routine) {
            $this->info('Inserting '.$routine['title']);
            Log::info('Inserting '.$routine['title']);

            $lesson = $this->updateOrInsertAndGetFirst('railcontent_content', [
                'slug' => ContentHelper::slugify(
                    $routine['title']
                ),
                'type' => 'routine',
                'sort' => 0,
                'status' => ContentService::STATUS_PUBLISHED,
                'brand' => 'singeo',
                'language' => config(
                    'railcontent.default_language'
                ),
                'published_on' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]);

            // permissions
            $this->updateOrInsertAndGetFirst('railcontent_content_permissions', [
                'content_id' => $lesson->id,
                'content_type' => null,
                'brand' => 'singeo',
                'permission_id' => 73,
            ]);

            // fields
            $this->updateOrInsertAndGetFirst('railcontent_content_fields', [
                'content_id' => $lesson->id,
                'key' => 'title',
                'value' => $routine['title'],
                'position' => 1,
                'type' => 'string',
            ]);
            $this->updateOrInsertAndGetFirst('railcontent_content_fields', [
                'content_id' => $lesson->id,
                'key' => 'low_soundslice_slug',
                'value' => $routine['sound_slice_low']['slice_slug'],
                'position' => 1,
                'type' => 'string',
            ]);
            $this->updateOrInsertAndGetFirst('railcontent_content_fields', [
                'content_id' => $lesson->id,
                'key' => 'high_soundslice_slug',
                'value' => $routine['sound_slice_high']['slice_slug'],
                'position' => 1,
                'type' => 'string',
            ]);

            //datum
            $this->updateOrInsertAndGetFirst('railcontent_content_data', [
                'content_id' => $lesson->id,
                'key' => 'description',
                'position' => 1,
            ], [
                                                 'value' => $routine['description'],
                                             ]);
            $this->updateOrInsertAndGetFirst('railcontent_content_data', [
                'content_id' => $lesson->id,
                'key' => 'thumbnail_url',
                'position' => 1,
            ], [
                                                 'value' => $routine['thumbnail_url'],
                                             ]);

            event(new ContentCreated($lesson->id));
        }

        $this->info('---------------------------------------------------');
        $this->info('Finished UpdateRoutines!');
        Log::info('Finished UpdateRoutines!');

        return true;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return object
     */
    private function updateOrInsertAndGetFirst($table, array $attributes, array $values = []): object
    {
        $this->musoraDB()
            ->from($table)
            ->updateOrInsert($attributes, $values);

        return $this->getFirst($table, $attributes, $values);
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return object
     */
    private function getFirst($table, array $attributes): object
    {
        return $this->musoraDB()
            ->from($table)
            ->where($attributes)
            ->get()
            ->first();
    }

    private function musoraDB()
    {
        return \DB::connection(config('railcontent.database_connection_name'))
            ->query();
    }
}
