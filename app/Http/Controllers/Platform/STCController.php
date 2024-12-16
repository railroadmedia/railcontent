<?php

namespace App\Http\Controllers\Platform;

use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Railroad\Location\Services\CountryListService;

class STCController extends Controller
{
    public function memberSTC(): View
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
            ['value' => 'Non-binary'],
            ['value' => 'Rather not say'],
        ];

        $languages = [
            ['value' => 'Afrikaans'],
            ['value' => 'Albanian'],
            ['value' => 'Amharic'],
            ['value' => 'Arabic'],
            ['value' => 'Armenian'],
            ['value' => 'Azerbaijani'],
            ['value' => 'Belarusian'],
            ['value' => 'Bengali'],
            ['value' => 'Berber'],
            ['value' => 'Bosnian'],
            ['value' => 'Bulgarian'],
            ['value' => 'Burmese'],
            ['value' => 'Catalan'],
            ['value' => 'Croatian'],
            ['value' => 'Czech'],
            ['value' => 'Danish'],
            ['value' => 'Dutch'],
            ['value' => 'English (UK)'],
            ['value' => 'English (USA)'],
            ['value' => 'Estonian'],
            ['value' => 'Fijian'],
            ['value' => 'Filipino'],
            ['value' => 'Finnish'],
            ['value' => 'French'],
            ['value' => 'German'],
            ['value' => 'Greek'],
            ['value' => 'Haitian Creole'],
            ['value' => 'Hebrew'],
            ['value' => 'Hindi'],
            ['value' => 'Hungarian'],
            ['value' => 'Icelandic'],
            ['value' => 'Indonesian'],
            ['value' => 'Irish'],
            ['value' => 'Italian'],
            ['value' => 'Japanese'],
            ['value' => 'Korean'],
            ['value' => 'Kurdish'],
            ['value' => 'Lao'],
            ['value' => 'Latvian'],
            ['value' => 'Lithuanian'],
            ['value' => 'Macedonian'],
            ['value' => 'Malagasy'],
            ['value' => 'Malay'],
            ['value' => 'Maltese'],
            ['value' => 'Chinese (Mandarin)'],
            ['value' => 'Chinese (Cantonese)'],
            ['value' => 'Maori '],
            ['value' => 'Moldovan'],
            ['value' => 'Mongolian'],
            ['value' => 'Montenegrin'],
            ['value' => 'Nepali'],
            ['value' => 'Norwegian'],
            ['value' => 'Ossetian'],
            ['value' => 'Pashto'],
            ['value' => 'Persian '],
            ['value' => 'Polish'],
            ['value' => 'Portuguese'],
            ['value' => 'Romanian'],
            ['value' => 'Russian'],
            ['value' => 'Samoan'],
            ['value' => 'Serbian'],
            ['value' => 'Sinhala'],
            ['value' => 'Slovak'],
            ['value' => 'Slovene'],
            ['value' => 'Somali'],
            ['value' => 'Spanish'],
            ['value' => 'Swahili'],
            ['value' => 'Swedish'],
            ['value' => 'Tamil'],
            ['value' => 'Thai'],
            ['value' => 'Turkish'],
            ['value' => 'Ukrainian'],
            ['value' => 'Urdu'],
            ['value' => 'Vietnamese'],
            ['value' => 'Xhosa'],
            ['value' => 'Zulu'],
        ];

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

        $genres = [
            ['value' => 'Pop'],
            ['value' => 'Hip-hop '],
            ['value' => 'Rock'],
            ['value' => 'R’n’B'],
            ['value' => 'Soul'],
            ['value' => 'Reggae'],
            ['value' => 'Country'],
            ['value' => 'CCM / Worship'],
            ['value' => 'Funk'],
            ['value' => 'Folk'],
            ['value' => 'Jazz'],
            ['value' => 'Classical'],
            ['value' => 'Electronic'],
            ['value' => 'Blues'],
            ['value' => 'Metal'],
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
            'genres' => $genres,
        ]);
    }

}
