<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Routing\Controller;
use Railroad\Location\Services\CountryListService;

class STCController extends Controller
{
    public function memberSTC()
    {
        $ages = [
            ['value' => '18 or Below'],
            ['value' => '18-23'],
            ['value' => '24-29'],
            ['value' => '30-35'],
            ['value' => '36-41'],
            ['value' => '42-47'],
            ['value' => '48-53'],
            ['value' => '54-59'],
            ['value' => '60-65'],
            ['value' => '66-71'],
            ['value' => '72+']
        ];

        $genders = [
            ['value' => 'Man'],
            ['value' => 'Woman'],
            ['value' => 'Rather not say']
        ];

        $languages = require base_path('vendor/umpirsky/language-list/data/en/language.php');

        $levels = [
            ['value' => '1'],
            ['value' => '2-3'],
            ['value' => '4-6'],
            ['value' => '7-10'],
        ];

        $instruments = [
            ['value' => 'Drums'],
            ['value' => 'Guitar'],
            ['value' => 'Piano'],
            ['value' => 'Bass'],
            ['value' => 'Voice'],
            ['value' => 'Other'],
        ];

        $brands = [
            ['value' => 'Drumeo'],
            ['value' => 'Pianote'],
            ['value' => 'Guitareo'],
            ['value' => 'Singeo'],
        ];

        $goals = [
            ['value' => 'Learn as many songs as possible'],
            ['value' => 'Stick to a consistent practice routine'],
            ['value' => 'Learn music theory'],
            ['value' => 'Improve technique'],
            ['value' => 'Explore techniques, genres and styles'],
            ['value' => 'Get better with performing'],
            ['value' => 'Participate in a musician community'],
            ['value' => 'Other'],
        ];

        $experience = [
            ['value' => 'Less than a year'],
            ['value' => '2-3 Years'],
            ['value' => '4-6 Years'],
            ['value' => '7-10 Years'],
            ['value' => '10+ Years'],            
        ];

        $types = [
            ['value' => 'No Active Membership'],
            ['value' => 'Non-recurring Access'],
            ['value' => 'Monthly'],
            ['value' => 'Yearly'],
            ['value' => 'Lifetime'],
        ];

        return view('pages.student-experience-studies', [
            'ages' => $ages,
            'genders' => $genders,
            'countries' => array_values(CountryListService::allWithCommonDuplicatedAtTop()),
            'languages' => $languages,
            'levels' => $levels,
            'instruments' => $instruments,
            'brands' => $brands,
            'goals' => $goals,
            'experience' => $experience,
            'types' => $types,
        ]);
    }

}
