<?php

namespace App\Console\Commands;

use App\Modules\Brand\Enums\Brand;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;

class SeedUserContentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SeedUserContentData {userEmail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates content progress, list additions, coach follows, etc, for the user for testing.';

    protected $contentIdMap = [
        'drumeo' => [
            351402,
            350629,
            351885,
            350060,
            351876,
            350627,
            350628,
            349936,
            349916,
            350603,
            342015,
            349476,
            350226,
            350695,
            348765,
            349937,
            349930,
            350694,
            350694,
            349935,
            349725,
            349864,
            349862,
            349758,
            349755,
            349752,
            349749,
            349747,
            349744,
            349741,
            349739,
            349737,
            349735,
            349732,
            349730,
            349728,
            349866,
            349868,
            349870,
            349872,
            349874,
            349876,
            349878,
            349880,
            349882,
            349884,
            349887,
            349889,
            349891,
            349893,
            349929,
            349721,
            349668,
            349673,
            349675,
            349677,
            349680,
            349682,
            349684,
            349686,
            349688,
            349690,
            349694,
            349696,
            349710,
            349712,
            349715,
            349717,
            349719,
            349723,
            349692,
            349927,
            349334,
            349920,
            336478,
            336477,
            336479,
            336476,
            349923,
            336475,
            349224,
            348776,
            348748,
            349476,
            350060,
            348759,
            348731,
            348741,
            350043,
            349350,
            348730,
            348724,
            322049,
            348751,
            348753,
            348761,
            348774,
            337711,
            348770,
            349347,
            348763,
            348766,
            348768,
        ],
        'pianote' => [
            351708,
            353236,
            352634,
            352651,
            351659,
            352963,
            352650,
            352648,
            349999,
            353249,
            351016,
            351659,
            347389,
            347390,
            347388,
            347387,
            347383,
            350243,
            349995,
            349007,
            350239,
            349792,
            347386,
            347385,
            347381,
            349008,
            348995,
            348212,
            348211,
            347379,
            338780,
            338776,
            348208,
            348213,
            347377,
            345862,
            338775,
            346331,
            347751,
            347744,
            347745,
            347748,
            347750,
            347747,
            347752,
            347753,
            347754,
            347755,
            343632,
            346329,
            343643,
            343631,
            343641,
            338774,
            338771,
            346321,
            345864,
            345708,
            345707,
            338769,
            343627,
            343616,
            343623,
            338766,
            338762,
            340736,
            342819,
            340217,
            338759,
            340215,
            336988,
            340723,
            340247,
            340675,
            340219,
            340232,
            340233,
            340234,
            340235,
            340236,
            340237,
            340239,
            340248,
            340238,
            340246,
            340245,
            340244,
            340243,
            340242,
            340241,
            340240,
            340689,
            338754,
            339917,
            338752,
            337575,
            337578,
            339425,
            336987,
            337571,
            336986,
            337574,
            336985,
            338950,
            336968,
            338095,
            338179,
            336967,
            337559,
        ],
        'guitareo' => [
            331406,
            351856,
            350122,
            354007,
            313472,
            339020,
            314660,
            352437,
            322813,
            339026,
            353343,
            339025,
            339024,
            339023,
            339022,
            339021,
            348912,
            349059,
            331405,
            350843,
            341947,
            331404,
            348975,
            326456,
            350036,
            348223,
            331403,
            345030,
            345031,
            348222,
            345816,
            341948,
            345029,
            331402,
            345027,
            325389,
            341694,
            341695,
            341696,
            341697,
            341693,
            341692,
            341691,
            341690,
            341689,
            345817,
            345818,
            345819,
            345820,
            345821,
            345822,
            345823,
            345824,
            345825,
            345826,
            346385,
            346735,
            339028,
            338914,
            331401,
            341946,
            331400,
            331272,
            338346,
            338152,
            341512,
            341944,
            331399,
            331271,
            338149,
            337910,
            338345,
            338150,
            342307,
            331270,
            331398,
            337660,
            337661,
            337659,
            337665,
            337662,
            337663,
            337664,
            337667,
            337666,
            336335,
            331269,
            331397,
            332407,
            336337,
            331268,
            331267,
            331395,
            331265,
            332406,
            338644,
            338638,
            337835,
            337656,
            332405,
            328138,
            328137,
            328136,
            328139,
            328135,
            331528,
            331530,
        ],
        'singeo' => [
            350329,
            345462,
            351578,
            349380,
            351165,
            350715,
            349380,
            350793,
            351165,
            350792,
            348473,
            350791,
            338652,
            350790,
            341305,
            349361,
            343384,
            348473,
            349793,
            345460,
            345462,
            349242,
            343342,
            343400,
            345459,
            345457,
            343390,
            343384,
            346769,
            346790,
            346787,
            346786,
            346781,
            346776,
            346773,
            346771,
            346770,
            347155,
            346768,
            346766,
            332045,
            331993,
            331816,
            331667,
            346792,
            332046,
            332048,
            347137,
            347134,
            347128,
            347107,
            347100,
            347098,
            347097,
            339099,
            346803,
            346799,
            346798,
            346793,
            346791,
            346932,
            347694,
            342068,
            341308,
            341305,
            341303,
            338656,
            338652,
            339879,
            338655,
            338651,
            339878,
            338648,
            338649,
            331996,
            331635,
            331634,
            331664,
            331665,
            332047,
            331999,
            331997,
            331668,
            331994,
            331992,
            331961,
            331960,
            331814,
            331666,
            331669,
            339248,
            340191,
            340190,
            340188,
            340176,
            340173,
            340171,
            339256,
            339251,
            339095,
            339244,
            339241,
            339238,
            339233,
            339231,
            339230,
            339100,
        ],
    ];
    protected $coachIdMap = [
        'drumeo' => [311690, 31888, 236681, 273806, 234095, 265267, 189973],
        'pianote' => [323470, 320027, 197087, 197077, 196999],
        'guitareo' => [354026, 350843, 342307, 313460, 278722, 211443],
        'singeo' => [347694, 322496, 309845, 305432],
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        ContentRepository $contentRepository,
        ContentService $contentService,
        ContentHierarchyService $contentHierarchyService,
        UserPlaylistsService $userPlaylistsService
    ) {
        $user = User::query()->where('email', $this->argument('userEmail'))->firstOrFail();
        $dbConnection = DB::connection(config('railcontent.database_connection_name'));

        foreach (Brand::cases() as $brandEnum) {
            $brandString = $brandEnum->value;

            // user content progress starts
            for ($i = 0; $i < 10; $i++) {
                $date = Carbon::now()->subDays(rand(1, 100))->subHours(rand(1, 100))->subMinutes(rand(1, 100));

                $dbConnection->table('railcontent_user_content_progress')
                    ->updateOrInsert([
                        'content_id' => $this->contentIdMap[$brandString][$i],
                        'user_id' => $user->id,
                        'state' => 'started',
                        'progress_percent' => rand(1, 100),
                        'higher_key_progress' => null,
                        'updated_on' => $date->toDateTimeString(),
                        'started_on' => $date->toDateTimeString(),
                        'completed_on' => null,
                    ]);
            }
            $this->info('Done adding started content.');

            // user content progress completes
            for ($i = 50; $i < 55; $i++) {
                $date = Carbon::now()->subDays(rand(1, 100))->subHours(rand(1, 100))->subMinutes(rand(1, 100));

                $dbConnection->table('railcontent_user_content_progress')
                    ->updateOrInsert([
                        'content_id' => $this->contentIdMap[$brandString][$i],
                        'user_id' => $user->id,
                        'state' => 'completed',
                        'progress_percent' => 100,
                        'higher_key_progress' => null,
                        'updated_on' => $date->toDateTimeString(),
                        'started_on' => $date->copy()->subDays(rand(1, 100))->toDateTimeString(),
                        'completed_on' => $date->toDateTimeString(),
                    ]);
            }
            $this->info('Done adding completed content.');

            // user my-list additions
            for ($i = 60; $i < 68; $i++) {
                $this->addToPrimaryPlaylist(
                    $contentRepository,
                    $contentService,
                    $contentHierarchyService,
                    $userPlaylistsService,
                    $brandString,
                    $this->contentIdMap[$brandString][$i],
                    $user->id
                );
            }
            $this->info('Done adding my list content.');

            // subscribe to coaches
            foreach ($this->coachIdMap as $brandName => $coachIds) {
                foreach ($coachIds as $coachId) {
                    $dbConnection->table('railcontent_content_follows')
                        ->updateOrInsert([
                            'content_id' => $coachId,
                            'user_id' => $user->id,
                            'created_on' => $date->toDateTimeString(),
                        ]);
                }
            }
            $this->info('Done subscribing to coaches.');

            // set users profile data
            if(empty($user->first_name)) $user->first_name = fake()->name;
            if(empty($user->last_name)) $user->last_name = fake()->name;
            if(empty($user->gender)) $user->gender = fake()->randomElement(['male', 'female']);
            if(empty($user->country)) $user->country = fake()->country;
            if(empty($user->region)) $user->region = 'British Columbia';
            if(empty($user->city)) $user->city = fake()->city;
            if(empty($user->birthday)) $user->birthday = fake()->date;
            if(empty($user->profile_picture_url)) $user->profile_picture_url = fake()->imageUrl(300, 300);
            if(empty($user->piano_gear_keyboard_brands)) $user->piano_gear_keyboard_brands = 'Roland, Casio';
            if(empty($user->piano_gear_piano_brands)) $user->piano_gear_piano_brands = 'Korg, Yamaha';
            if(empty($user->piano_gear_photo)) $user->piano_gear_photo = fake()->imageUrl(300, 600);
            if(empty($user->piano_playing_since_year)) $user->piano_playing_since_year = rand(1990, 2022);
            if(empty($user->guitar_gear_string_brands)) $user->guitar_gear_string_brands = 'Gibson, Fender';
            if(empty($user->guitar_gear_pedal_brands)) $user->guitar_gear_pedal_brands = 'Rickenbacker';
            if(empty($user->guitar_gear_amp_brands)) $user->guitar_gear_amp_brands = 'Ibanez';
            if(empty($user->guitar_gear_guitar_brands)) $user->guitar_gear_guitar_brands = 'Jackson';
            if(empty($user->guitar_gear_photo)) $user->guitar_gear_photo = fake()->imageUrl(300, 600);
            if(empty($user->guitar_playing_since_year)) $user->guitar_playing_since_year = rand(1990, 2022);
            if(empty($user->drums_gear_stick_brands)) $user->drums_gear_stick_brands = 'Tama, Yamaha';
            if(empty($user->drums_gear_hardware_brands)) $user->drums_gear_hardware_brands = 'Sonor';
            if(empty($user->drums_gear_set_brands)) $user->drums_gear_set_brands = 'Pearl';
            if(empty($user->drums_gear_cymbal_brands)) $user->drums_gear_cymbal_brands = 'Ludwig';
            if(empty($user->drums_gear_photo)) $user->drums_gear_photo = fake()->imageUrl(300, 600);
            if(empty($user->drums_playing_since_year)) $user->drums_playing_since_year = rand(1990, 2022);
            if(empty($user->singing_since_year)) $user->singing_since_year = rand(1990, 2022);
            if(empty($user->singing_gear_mic_brands)) $user->singing_gear_mic_brands = 'Sony';
            if(empty($user->singing_gear_photo)) $user->singing_gear_photo = fake()->imageUrl(300, 600);
            if(empty($user->biography)) $user->biography = fake()->sentences(2, true);

            $user->save();
        }

        return 0;
    }

    /**
     */
    public function addToPrimaryPlaylist(
        ContentRepository $contentRepository,
        ContentService $contentService,
        ContentHierarchyService $contentHierarchyService,
        UserPlaylistsService $userPlaylistsService,
        $brand,
        $contentId,
        $userId
    ) {
        $userPrimaryPlaylists =
            $userPlaylistsService->getUserPlaylist($userId, 'primary-playlist', $brand);

        if (empty($userPrimaryPlaylists)) {
            $userPrimaryPlaylist = $userPlaylistsService->updateOrCeate([
                'user_id' => $userId,
                'type' => 'primary-playlist',
                'brand' => $brand
                    ??
                    config('railcontent.brand'),
            ], [
                'user_id' => $userId,
                'type' => 'primary-playlist',
                'brand' => $brand
                    ??
                    config('railcontent.brand'),
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
            ]);
        } else {
            $userPrimaryPlaylist = Arr::first($userPrimaryPlaylists);
        }

        $userPlaylistsService->addContentToUserPlaylist($userPrimaryPlaylist['id'], $contentId);

        return response()->json(['success']);
    }
}
