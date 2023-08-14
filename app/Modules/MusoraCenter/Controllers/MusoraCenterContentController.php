<?php

namespace App\Modules\MusoraCenter\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MusoraCenterContentController extends Controller
{
    public static $brandContentTypes = [
        'drumeo' => [
            'course',
            'shows' => [
                'gear-guides',
                'challenges',
                'boot-camps',
                'quick-tips',
                'podcasts',
                'on-the-road',
                'behind-the-scenes',
                'study-the-greats',
                'live',
                'solos',
                'performances',
                'exploring-beats',
                'sonor-drums',
                'paiste-cymbals',
                '25-days-of-christmas',
                'rhythms-from-another-planet',
                'the-history-of-electronic-drums',
                'backstage-secrets',
                'spotlight',
            ],
            'play-along',
            'song',
            'student-focus',
            'learning-path',
            'pack',
            'semester-pack',
            'rudiment',
            'instructor',
            'assignment'
        ],
        'guitareo' => [
            'course',
            'recording',
            'play-along',
            'song',
            'chord-and-scale',
            'learning-path',
            'pack',
            'semester-pack',
            'instructor',
            'assignment'
        ],
        'pianote' => [
            'course',
            'recording',
            'song',
            'chord-and-scale',
            'learning-path',
            'instructor',
            'exercise'
        ],
        'recordeo' => [
            'course',
            'recording',
            'learning-path',
            'instructor',
            'exercise',
            'student-review',
            'question-and-answer'
        ]
    ];

    public static $commentFromIdList = [
        'drumeo' => [
            5 => 5, // janado
            7 => 7, // jared
            8 => 8, // dave
            5814 => 5814, // aaron
            6885 => 6885, // jame
            40641 => 40641, // stephen
            63599 => 63599, // pat
            70324 => 70324, // michael
            87011 => 87011, // justin
            96326 => 96326, // caleb
            98085 => 98085, // adam
            102905 => 102905, // reuben
            128762 => 128762, // curtis
            136145 => 136145, // bruce
        ],
        'pianote' => [
            7 => 6, // jared
            8 => 7, // dave
            136 => 9, // jordan
            6885 => 2, // jame
            96326 => 1, // caleb
            128762 => 3, // curtis
            149630 => 10 // lisa
        ],
        'guitareo' => [
            7 => 1548, // jared
            8 => 1701, // dave
            99 => 99, // andrew
            145 => 7, // nate
            6885 => 1577, // jame
            96326 => 1550, // caleb
            128762 => 1640, // curtis
        ],
        'recordeo' => [
            96326 => 1550, // caleb
            6885 => 1577, // jame
            149631 => 149631, // victor
            149632 => 149632, // troy
        ],
    ];

    public function index()
    {
        return view('musora-center.content-management.index');
    }

    public function brand(Request $request, $brand)
    {
        $request->validate(['brand' => 'in:' . implode(',', array_keys(self::$brandContentTypes))]);

        return view(
            'musora-center.content-management.brand-index.index',
            [
                "brand" => $brand,
                "types" => self::$brandContentTypes[$brand]
            ]
        );
    }

    public function type(Request $request, $brand, $type)
    {
        $request->validate(
            [
                'brand' => 'in:' . implode(',', array_keys(self::$brandContentTypes)),
                'type' => 'in:' . implode(',', array_keys(self::$brandContentTypes[$brand]))
            ]
        );

        return view(
            'musora-center.content-management.content-category.index',
            [
                "brand" => $brand,
                "type" => $type,
                "types" => self::$brandContentTypes[$brand]
            ]
        );
    }

    public function comments(Request $request, $brand)
    {
        $user = auth()->user();

        $request->validate(
            [
                'brand' => 'in:' . implode(',', array_keys(self::$brandContentTypes)),
                'type' => 'in:' . implode(',', array_keys(self::$brandContentTypes[$brand]))
            ]
        );

        $userCommentsIdList = [];

        if ($brand == 'drumeo') {
            $userCommentsIdList = [
                0 => 'All',
                5814 => 'Aaron Edgar',
                98085 => 'Adam Tuminaro',
                136145 => 'Bruce Becker',
                8 => 'Dave Atkinson',
                5 => 'Janado',
                7 => 'Jared Falk',
                87011 => 'Justin MacAlpine',
                70324 => 'Michael Schack',
                63599 => 'Pat Petrillo',
                102905 => 'Reuben Spyker',
                40641 => 'Stephen Taylor',
            ];
        }

        if ($brand == 'pianote') {
            $userCommentsIdList = [
                0 => 'All',
                9 => 'Jordan Leibel',
                10 => 'Lisa Witt',
            ];
        }

        if ($brand == 'guitareo') {
            $userCommentsIdList = [
                0 => 'All',
                7 => 'Nate Savage',
            ];
        }

        return view(
            'musora-center.content-management.content-category.comments',
            [
                "brand" => $brand,
                "types" => self::$brandContentTypes[$brand],
                "user" => $user->id,
                "userCommentsIdList" => $userCommentsIdList,
                "commentFromIdList" => json_encode(self::$commentFromIdList[$brand]),
            ]
        );
    }

    public function store(Request $request, $brand, $type)
    {
        $request->validate(
            [
                'brand' => 'in:' . implode(',', array_keys(self::$brandContentTypes)),
                'type' => 'in:' . implode(',', array_keys(self::$brandContentTypes[$brand]))
            ]
        );

        return view(
            'musora-center.content-management.content-category.post-form',
            [
                "brand" => $brand,
                "type" => $type,
                "types" => self::$brandContentTypes[$brand]
            ]
        );
    }

    public function edit(Request $request, $brand, $type, $id)
    {
        $request->validate(
            [
                'brand' => 'in:' . implode(',', array_keys(self::$brandContentTypes)),
                'type' => 'in:' . implode(',', array_keys(self::$brandContentTypes[$brand]))
            ]
        );

        return view(
            'musora-center.content-management.content-category.post-form',
            [
                "brand" => $brand,
                "type" => $type,
                "types" => self::$brandContentTypes[$brand],
                "id" => $id
            ]
        );
    }

    public function videos()
    {
        return view('musora-center.content-management.videos');
    }
}
