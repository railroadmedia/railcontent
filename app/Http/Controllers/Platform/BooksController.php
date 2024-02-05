<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Mailora\Services\MailService;
use Illuminate\Routing\Controller;

class BooksController extends Controller
{
    /**
     * @var MailService
     */
    private $mailService;

    /**
     * @var ContentService
     */
    private $contentService;

    public function __construct(
        MailService $mailService,
        ContentService $contentService
    ) {
        $this->mailService = $mailService;
        $this->contentService = $contentService;
    }

    public function resources()
    {
        $chapterThumbs = [
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/level-1.jpg',
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/level-2.jpg',
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/level-3.jpg',
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/level-4.jpg',
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/level-5.jpg',
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/level-6.jpg',
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/level-7.jpg',
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/level-8.jpg',
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/level-9.jpg',
            'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/level-10.jpg',
        ];

        return view('books.foundations.index', [
            "hasAccess" => !empty(user()),
            "chapterThumbs" => $chapterThumbs,
            "user" => user(),
        ]);
    }

    public function chapter($domain, $brand, $chapterNumber)
    {
        $thisChapter = $this->getChapterData($chapterNumber);

        $foundationsLessons = $this->getFoundationsLessons($chapterNumber);

        return view('books.foundations.chapter', [
            "hasAccess" => !empty(user()),
            "chapterNumber" => $chapterNumber,
            "thisChapter" => $thisChapter,
            "foundationsLessons" => $foundationsLessons,
            "user" => user(),
            "brand" => "pianote"
        ]);
    }

    public function askQuestion(Request $request)
    {
        $emailSubject =
            '[Foundations Book Resource Area] Question on - "'.
            $request->get('level').
            '" - from: '.
            $request->get('email');

        $input = [
            "type" => "layouts/inline/alert",
            "logo" => "https://dmmior4id2ysr.cloudfront.net/logos/pianote-logo-red.png",
            "sender-address" => 'system@pianote.com',
            "reply-to" => $request->get('email'),
            "lines" => [$request->get('question')],
            "recipient" => config('mail-recipients.books-resources-ask-questions') ?? 'brett@musora.com',
            "subject" => $emailSubject,
            "alert" => $emailSubject,
        ];

        try {
            $this->mailService->sendSecure($input);
        } catch (\Exception $e) {
            error_log($e);
        }

        return back()->with([
            'emailSuccess' => true,
        ]);
    }

    private function getChapterData($chapterNumber)
    {
        $chapterData = [
            1 => [
                'title' => 'Welcome to the Keyboard',
                'description' => 'In this level you will learn how to get around on a piano or keyboard. You will be
                introduced to basic rhythm concepts, learn to play your first scale and lay the foundation for
                technique and hand independence',
                "related_lessons" => [
                    [
                        "title" => "How to Choose a Piano or Keyboard",
                        "youtube_id" => 'l_hI0_8pbLU',
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Getting Started on the Piano Lesson 1",
                        "external_link" => 'https://www.pianote.com/getting-started/lessons/now-what',
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Getting Started on the Piano Lesson 2",
                        "external_link" => 'https://www.pianote.com/getting-started/lessons/scales',
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Proper Hand Posture at the Piano",
                        "youtube_id" => "rZznie6UU_o",
                        "content_id" => "212650",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Proper Posture at the Piano",
                        "youtube_id" => "E8Do4oxTJ1k",
                        "content_id" => "212649",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "How to Play Piano Scales Hands Together",
                        "youtube_id" => "gfEeGlHsjaY",
                        "content_id" => "218415",
                        "brand" => "pianote",
                    ],
                ],
                "backing_track_title" => 'Chill Walk',
                "backing_tracks" => 'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/mp3s/Unit+01.zip',
            ],
            2 => [
                'title' => 'The Staff and Sight Reading',
                'description' => 'Sight Reading here we come! This level will introduce you to the grand staff and
                have you reading notation in a way that makes sense. By the end of this level you will be able to
                read and play simple notation in both hands as well as play notated music hands together.',
                "related_lessons" => [
                    [
                        "title" => "How To Read Notes",
                        "youtube_id" => "gEI7uYOCQXo&",
                        "content_id" => "221020",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Basic Time Signatures",
                        "youtube_id" => "ixm4R7hG-pk",
                        "content_id" => "221014",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Understanding Rhythm",
                        "youtube_id" => "yFAcDynQdeQ",
                        "content_id" => "220813",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Suspended Piano Chords 101",
                        "youtube_id" => "XfSdJiXqCCY",
                        "content_id" => "202599",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Understanding Intervals On The Piano",
                        "youtube_id" => "Hi9bUcnHLBo",
                        "content_id" => "219623",
                        "brand" => "pianote",
                    ],
                ],
                "backing_track_title" => 'Fishing in the Sea',
                "backing_tracks" => 'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/mp3s/Unit+02.zip',
            ],
            3 => [
                'title' => 'Diving Deeper Into Core Skills',
                'description' => 'This level will take you even further into core skills in technique,
                theory and chording.',
                "related_lessons" => [
                    [
                        "title" => "Getting Started On The Piano Lesson 3",
                        "external_link" => 'https://www.pianote.com/getting-started/lessons/minor-scale',
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "How To Play Minor Scales On The Piano",
                        "youtube_id" => "AZw3dQ53lEY",
                        "content_id" => "209921",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "How To Read Music Faster",
                        "youtube_id" => "qP53j8CxDdg",
                        "content_id" => "231439",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "What Is An Arpeggio",
                        "youtube_id" => "i4Zsvtvm_g0",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "What Are Dynamics",
                        "youtube_id" => "szLVM-KghlY",
                        "content_id" => "209918",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Crescendos & Decrescendos",
                        "youtube_id" => "mnjgPKTSuCI",
                        "content_id" => "201890",
                        "brand" => "pianote",
                    ],
                ],
                "backing_track_title" => 'The Cheshire Cat',
                "backing_tracks" => 'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/mp3s/Unit+03.zip',
            ],
            4 => [
                'title' => 'Key Signatures And Inversions',
                'description' => 'This level is all about expanding your skills. You will learn how to play
                in a new key, learn about sharps and naturals, improve your sight reading skills and begin to
                learn about chord inversions. This level has it all, sight reading, ear training, chording,
                dexterity and more.',
                "related_lessons" => [
                    [
                        "title" => "Piano Chord Inversions",
                        "youtube_id" => "Xuuq8DtUy_g",
                        "content_id" => "215944",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "How To Find The Root Note & Identify Chord Inversions",
                        "youtube_id" => "zrn86vyjcX8",
                        "content_id" => "221921",
                        "brand" => "pianote",
                    ],
                ],
                "backing_track_title" => 'Reaching in the Dark',
                "backing_tracks" => 'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/mp3s/Unit+04.zip',
            ],
            5 => [
                'title' => 'Flats and Chord Shortcuts',
                'description' => 'This level will introduce you to the flat symbol, the key of F major, chord
                shortcuts to help you expand your chording abilities as well as dynamics to help your playing
                make an impact on the listener.',
                "related_lessons" => [
                    [
                        "title" => "Chord Hacks - Intro To Chord Hacking",
                        "external_link" => 'https://www.pianote.com/chord-hacks/lessons/chord-hacking',
                        "youtube_id" => "PpV1nffIPFc",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Chord Hacks - Inversions Basics",
                        "external_link" => 'https://www.pianote.com/chord-hacks/lessons/inversions',
                        "youtube_id" => "l5BYWY6ZJJs",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Chord Hacks - Left Hand Magic",
                        "external_link" => 'https://www.pianote.com/chord-hacks/lessons/adding-rhythm',
                        "youtube_id" => "pQnDDgA73tc",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Chord Hacks - Putting It Together",
                        "external_link" => 'https://www.pianote.com/chord-hacks/lessons/two-hands',
                        "youtube_id" => "A_dwTWUjAs0",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Chord Hacks -  Making It Fancy",
                        "external_link" => 'https://www.pianote.com/chord-hacks/lessons/chord-progressions',
                        "youtube_id" => "FxWWLCxcQ-g",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Chord Hacks - Pave The Way",
                        "external_link" => 'https://www.pianote.com/chord-hacks/lessons/popular-songs',
                        "youtube_id" => "AK8bJwqZFHg",
                        "brand" => "pianote",
                    ],
                ],
                "backing_track_title" => 'Gumboot',
                "backing_tracks" => 'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/mp3s/Unit+05.zip',
            ],
            6 => [
                'title' => 'Understanding the Minor Keys',
                'description' => 'This level will take you further into the world of minor sounds. We will look at
                two new types of minor scales as well as introduce to you 3/4 time and the dotted half note.',
                "related_lessons" => [
                    [
                        "title" => "Why Are There Three Minor Scales",
                        "youtube_id" => "BhVlf6mdXJk",
                        "content_id" => "233582",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "The 1-5-6-4 Chord Progression",
                        "youtube_id" => "8n7LsgFfFC4",
                        "content_id" => "209922",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Understanding Rhythm",
                        "youtube_id" => "yFAcDynQdeQ",
                        "content_id" => "220813",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Basic Time Signatures",
                        "youtube_id" => "ixm4R7hG-pk",
                        "content_id" => "221014",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "How To Use The Pedal",
                        "youtube_id" => "EkE7tlmuAlc",
                        "content_id" => "234326",
                        "brand" => "pianote",
                    ],
                ],
            ],
            7 => [
                'title' => 'The Circle of 5ths',
                'description' => 'Think of the circle of 5ths as a key to understanding not only how key
                signatures work but the relationships between minor and major sounds. This level will take
                you deeper into understanding how music works while giving you practical ways to explore
                creating a mood in music.',
                "related_lessons" => [
                    [
                        "title" => "How To Use the Circle Of 5ths To Build Piano Chords",
                        "youtube_id" => "cxYVXCK1t_M",
                        "brand" => "pianote",
                    ],
                ],
            ],
            8 => [
                'title' => 'Learning to Improvise',
                'description' => 'Improvisation might just be the most fun you can have at the piano. We take
                the fear out of the equation by giving you a safe place and clear guidelines to use while
                getting used to improvising so that you can feel confident in your skillset as it develops.',
                "related_lessons" => [
                    [
                        "title" => "Left Hand Arpeggio Patterns",
                        "youtube_id" => "q97ZyiBh_pw",
                        "content_id" => "221922",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Make Your Piano Playing Instantly More Dramatic",
                        "youtube_id" => "sWSxHBn7uus",
                        "content_id" => "223641",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "The Perfect Beginner Piano Fill",
                        "youtube_id" => "4sJIW1d1NVA",
                        "content_id" => "229420",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Right Hand Fills And Tricks On The Piano",
                        "youtube_id" => "ALNKC4zIK04",
                        "content_id" => "222781",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Improvising Beautiful Melodies On The Piano",
                        "youtube_id" => "sWSxHBn7uus",
                        "content_id" => "223644",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "How To Fake Being Awesome At The Piano",
                        "youtube_id" => "BXqGi1QuA5w",
                        "content_id" => "227474",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "The Most Important Piano Interval",
                        "youtube_id" => "L34fjAdTqxs",
                        "content_id" => "220533",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "How To Unwind At The Piano",
                        "youtube_id" => "9QyaeFAyg1A",
                        "content_id" => "224470",
                        "brand" => "pianote",
                    ],
                ],
                "backing_tracks" => 'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/mp3s/Unit+08.zip',
            ],
            9 => [
                'title' => '7th Chords and the Blues',
                'description' => '7th chords, the pentatonic scale, blues riffs and rhythms, stylized improv
                skills the list goes on and on. This level will not only teach you how to play a blues song,
                but it will also give you the skills you need to create your own blues songs and improvisations.',
                "related_lessons" => [
                    [
                        "title" => "Understanding 7th Chords On The Piano",
                        "youtube_id" => "AKSMzmjCTN8",
                        "content_id" => "224463",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "12 Bar Blues Piano Lesson",
                        "youtube_id" => "kLFkT3LBWzA",
                        "content_id" => "219628",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Improvise With These Beautiful Scale Patterns",
                        "youtube_id" => "W164rUS0LVA",
                        "content_id" => "231441",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "The Pentatonic Scale",
                        "youtube_id" => "9negqvipGuc",
                        "content_id" => "227482",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "The Blues Scale Formula",
                        "youtube_id" => "Eosor-ncv7Y",
                        "content_id" => "212652",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "What Is Swing Feel",
                        "youtube_id" => "sDfZRdBmT5E",
                        "brand" => "pianote",
                    ],
                ],
                "backing_tracks" => 'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/mp3s/Unit+09.zip',
            ],
            10 => [
                'title' => 'Intro to Jazz',
                'description' => 'The final lessons of this unit are going to walk you through Autumn leaves.
                This song pulls in so many important jazz concepts and is a delight to play!',
                "related_lessons" => [
                    [
                        "title" => "Create Beautiful Chord Voicings On The Piano (7th Chords for Small Hands)",
                        "youtube_id" => "Mo8KtTaNNes",
                        "content_id" => "224469",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Understanding 7th Chords On The Piano",
                        "youtube_id" => "AKSMzmjCTN8",
                        "content_id" => "224463",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "Minor 7 Flat 5 Piano Chord",
                        "youtube_id" => "wlDqq41ZsKA",
                        "content_id" => "212416",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "The Most Villainous Piano Chord (Diminished 7th)",
                        "youtube_id" => "Pdou5KtHhkI",
                        "content_id" => "215029",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "The Major 9th Chord: “The Chord Of Morning Light”",
                        "youtube_id" => "nApVvrvLoaI",
                        "content_id" => "215033",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "The 2-5-1 Chord Progression (Jazz Piano 101)",
                        "youtube_id" => "EZsHfvzPxuI",
                        "brand" => "pianote",
                    ],
                    [
                        "title" => "The 2-5-1 Chord Progression (Jazz Piano 101)",
                        "youtube_id" => "9XIVncmKdng",
                        "content_id" => "217310",
                        "brand" => "pianote",
                    ],
                ],
                "backing_tracks" => 'https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/mp3s/Unit+10.zip',
            ],
        ];

        $thisChapter = $chapterData[$chapterNumber] ?? null;

        if (empty($thisChapter)) {
            abort(404);
        }

        return $thisChapter;
    }

    private function getFoundationsLessons($levelNumber)
    {
        ContentRepository::$bypassPermissions = true;

        $foundations = $this->contentService->getById('215952');

        return $foundations['units'][$levelNumber - 1]['lessons'] ?? [];
    }

    public function bestBeginner(Request $request)
    {
        $isDigital = strpos($request->getPathInfo(), 'digital') !== false;

        $user = user();

        $hasAccess = $user && ($user->isAMember() || $user->isPackOnlyOwner());

        $chapters = [
            [
                "thumbnail" => 'https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/chapter-1.jpg',
                "chapterTitle" => "Getting Started",
                "title" => "Getting Started On Drums ",
                "description" => "In this course, you’ll be able to see exactly how Jared sets up his drum-set.
                If you’re having trouble setting up your drum-set, you can use this course as a reference!",
                "contentLink" => url()->route('platform.content.first-level', [
                    'brand' => 'drumeo',
                    'courses',
                    'getting-started-on-drums',
                    '20977',
                ]),
            ],
            [
                "thumbnail" => 'https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/chapter-2.jpg',
                "chapterTitle" => "Practicing",
                "title" => "How To Practice Effectively",
                "description" => "This course is all about effective practicing. Stephen Taylor will walk you through
                his approach to practicing and discuss topics like scheduling, warming up, creative triggers, and much
                more. You can also download a PDF version of a “Practice Routine Generator” at the bottom of this page!",
                "contentLink" => url()->route('platform.content.first-level', [
                    'brand' => 'drumeo',
                    'courses',
                    'how-to-practice-effectively',
                    '27406',
                ]),
            ],
            [
                "thumbnail" => 'https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/chapter-3.jpg',
                "chapterTitle" => "Learning Grips",
                "title" => "How To Hold Your Drumsticks",
                "description" => "Bruce Becker is a master of drum-set technique. If you want to learn more about any
                of the grips discussed in Chapter 3, you can check out this course with Bruce Becker!",
                "contentLink" => url()->route('platform.content.first-level', [
                    'brand' => 'drumeo',
                    'courses',
                    'how-to-hold-your-drumsticks',
                    '27764',
                ]),
            ],
            [
                "thumbnail" => 'https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/chapter-4.jpg',
                "chapterTitle" => "Learning Notation",
                "title" => "Note Value Courses",
                "description" => "Here you’ll find a number of different courses that will dive deeper into note values
                and music theory. You can also download a PDF version of the notation legend at the bottom of this page!",
                "contentLink" => url()->route('platform.content-type-catalog', [
                        "contentTypeName" => "courses",
                        'brand' => 'drumeo',
                    ]).'?required_fields[]=topic%2CTheory',
            ],
            [
                "thumbnail" => 'https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/chapter-5.jpg',
                "chapterTitle" => "Learning Rudiments",
                "title" => "All 40 Rudiments",
                "description" => "In Chapter 5, you were introduced to five essential rudiments. If you’re looking to
                develop even more drum-set vocabulary, you can learn 35 other drum rudiments here!",
                "contentLink" => "https://www.drumeo.com/beat/rudiments/",
            ],
            [
                "thumbnail" => 'https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/chapter-7.jpg',
                "chapterTitle" => "Applying Techniques",
                "title" => "Developing Dynamics",
                "description" => "In this course, Dave Atkinson will explain how he incorporates the techniques
                explained in Chapter 7 into a musical context!",
                "contentLink" => url()->route('platform.content.first-level', [
                    'brand' => 'drumeo',
                    'courses',
                    'developing-dynamics',
                    '21290',
                ]),
            ],
            [
                "thumbnail" => 'https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/chapter-9.jpg',
                "chapterTitle" => "Learning Musical Styles",
                "title" => "Drumless Play-Along Tracks",
                "description" => "Here you’ll find play-along tracks that go with each style of music you’ve learned in
                this chapter. Once you’ve completed Chapter 10, go back and practice the drum beats from Chapter 9
                along with their corresponding play-along track!",
                "contentLink" => url()->route('books.best-beginner-drum-book.play-alongs', ['brand' => 'drumeo']),
            ],
            [
                "thumbnail" => 'https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/chapter-10.jpg',
                "chapterTitle" => "Playing To Music",
                "title" => "Drumless Play-Along Tracks",
                "description" => "Here you’ll find all of the resources for Chapter 10. You can turn the drums or
                click on and off. You can also download a PDF version of a “Cheat Sheet” at the bottom of this page!",
                "contentLink" => url()->route('books.best-beginner-drum-book.play-alongs', ['brand' => 'drumeo']),

            ],
        ];

        $redirectUrl =
            ($isDigital) ? url()->route('books.best-beginner-drum-book-digital') :
                url()->route('books.best-beginner-drum-book');

        return view('books.best-beginner-drum-book.index', [
            "hasAccess" => $hasAccess,
            "chapters" => $chapters,
            "isDigital" => $isDigital,
            "user" => $user,
            "redirectUrl" => $redirectUrl,
        ]);
    }

    public function bestBeginnerPlayAlongs()
    {
        ContentRepository::$bypassPermissions = true;

        $user = user();

        $hasAccess = $user && ($user->isAMember() || $user->isPackOnlyOwner());

        $idsToPull = ['28360', '20657', '23989', '23625', '8431', '24431', '14295', '11689', '23024', '24580'];

        $listLessons = new ContentFilterResultsEntity(['results' => $this->contentService->getByIds($idsToPull)]);
        $listLessons['total_results'] = 10;

        return view('books.best-beginner-drum-book.play-alongs', [
            "hasAccess" => $hasAccess,
            "listLessons" => $listLessons->toResponseRawJson(),
        ]);
    }

    public function drummersToolbox(Request $request)
    {
        $isDigital = strpos($request->getPathInfo(), 'digital') !== false;

        $user = user();

        $hasAccess = $user && ($user->isAMember() || $user->isPackOnlyOwner());

        $isEdge = $user && $user->isAMember();
        $isPackOwner = $user && $user->isPackOnlyOwner();

        $chapters = [
            [
                "chapter" => 1,
                "title" => "Rock",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/chapter-1-rock.png",
            ],
            [
                "chapter" => 2,
                "title" => "Jazz",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/chapter-2-jazz.png",
            ],
            [
                "chapter" => 3,
                "title" => "Blues",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/chapter-3-blues.png",
            ],
            [
                "chapter" => 4,
                "title" => "Country",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/chapter-4-country.png",
            ],
            [
                "chapter" => 5,
                "title" => "Soul & Funk",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/chapter-5-funk.png",
            ],
            [
                "chapter" => 6,
                "title" => "Metal",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/chapter-6-metal.png",
            ],
            [
                "chapter" => 7,
                "title" => "Electronic",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/chapter-7-electronic.png",
            ],
            [
                "chapter" => 8,
                "title" => "Afro-Cuban",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/chapter-8-afro-cuban.png",
            ],
            [
                "chapter" => 9,
                "title" => "Afro-Brazilian",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/chapter-9-afro-brazilian.png",
            ],
            [
                "chapter" => 10,
                "title" => "Afro-Caribbean",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/chapter-10-afro-caribbean.png",
            ],
        ];

        return view('books.the-drummers-toolbox.index', [
            "hasAccess" => $hasAccess,
            "chapters" => $chapters,
            "isDigital" => $isDigital,
            "user" => $user,
            "isEdge" => $isEdge,
            "isPackOwner" => $isPackOwner,
        ]);
    }

    public function drummersToolboxChapter($domain, $brand,  $chapterNumber, Request $request)
    {
        ContentRepository::$bypassPermissions = true;
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;

        $user = user();

        $hasAccess = $user && ($user->isAMember() || $user->isPackOnlyOwner());

        $isDigital = strpos($request->getPathInfo(), 'digital') !== false;
        $chapter = $this->drummersToolboxChapters($chapterNumber);

        $relatedLessons = [];

        foreach ($chapter['related_lessons'] as $related_lesson) {
            $related_lesson['data'] = $this->contentService->getById($related_lesson['id']);

            if (empty($related_lesson['data'])) {
                continue;
            }

            $relatedLessons[] = $related_lesson;
        }

        $playAlongs = new ContentFilterResultsEntity([
            'results' => $this->contentService->getByIds(
                $chapter['play_along_ids']
            ),
        ]);
        $playAlongs['total_results'] = count($chapter['play_along_ids']);

        return view('books.the-drummers-toolbox.chapter', [
            "hasAccess" => $hasAccess,
            "chapterData" => $chapter,
            "chapterNumber" => $chapterNumber,
            "isDigital" => $isDigital,
            "relatedLessons" => $relatedLessons,
            "playAlongs" => $playAlongs->toResponseRawJson(),
            "user" => $user,
        ]);
    }

    public function drummersToolboxChapters($chapter)
    {
        $chapters = [
            "1" => [
                "title" => "Rock",
                "description" => "Here you will find all the rock drumming resources that pair with the material
                    in The Drummer’s Toolbox including lessons, drumless play-along tracks, and recommended
                    listening playlists.",
                "related_lessons" => [
                    [
                        "id" => 211661,
                        "youtube_id" => '2Dqlo-vyFFE',
                    ],
                    [
                        "id" => 30670,
                        "youtube_id" => 'woI6t8dCQcQ',
                    ],
                ],
                "play_along_ids" => [22625, 202759, 28055, 19729, 225972, 11689, 10013, 14083, 209412, 212720],
                "playlists" => [
                    "Pop Rock" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLw3avsyjSWpT22ys6zdCuZ",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/7mREZ67NdxjlLGgHVVBY8k?si=HRGCd8u_TqGZug1uZSC4nA",
                        "apple_url" => "https://music.apple.com/ca/playlist/pop-rock-the-drummers-toolbox/pl.u-AkAmPlyU2v8kmj",
                    ],
                    "Bo Diddly" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJvZfXR5Syo61D2pXfmq_es",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/47Bvjlube581aEm6KYew4O?si=cCLYnDcrRx-LtEn_8xqQJQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/bo-diddley-the-drummers-toolbox/pl.u-b3b8VdeUyaJb9P",
                    ],
                    "Surf Rock" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKnp3UqTodXgnjUHgY0ekaZ",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/7fzCGFg1Tn9c6sNgKORECO?si=2SiSgGLaRIuDc7t9AII5MA",
                        "apple_url" => "https://music.apple.com/ca/playlist/surf-rock-the-drummers-toolbox/pl.u-RRbVvlxI34qBPD",
                    ],
                    "Latin Rock" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJtAKq0QRMzzFW4DAU25v1D",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/0FGRhx8Nw0aylWXalU5nsW?si=fkZ6PKe1TqerRPQ1rKitNQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/latin-rock-the-drummers-toolbox/pl.u-leyl0yeCj8ae2d",
                    ],
                    "Hard Rock" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLNHrHwXT4LtXHm7CAijgzy",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/3EdwDCtYD34WD5a0qDJVVr?si=Tiu_nj_hTCWkEo3qc5QY5w",
                        "apple_url" => "https://music.apple.com/ca/playlist/hard-rock-the-drummers-toolbox/pl.u-vxy693XCzrKXYv",
                    ],
                    "Progressive Rock" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLTdffqCrX1Bf-lGLbPTHoA",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6jfPxPS8q6eZW8ZDnDMLw8?si=G2uJMX3dTNCqTvl8GJmd4g",
                        "apple_url" => "https://music.apple.com/ca/playlist/progressive-rock-the-drummers-toolbox/pl.u-AkAmPNbF2v8kmj",
                    ],
                    "Rock Ballad" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvL1btMt2NDgsc2Hmq1qBNoP",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/0hwIBKmb7sUHvAHnzY8YAE?si=MJwcjjvkR9utzDjLQLVvBQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/rock-ballad-the-drummers-toolbox/pl.u-b3b8VGGCyaJb9P",
                    ],
                    "Punk Rock" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvI1qZEQLNLQZe_ivU2QZd_H",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1yhWLe3sx0bdi458url0N8?si=vW4d2qV_SkOYjjtu09muYQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/punk-rock-the-drummers-toolbox/pl.u-RRbVv1Wu34qBPD",
                    ],
                    "Grunge" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvI1_sv5Vw_0JyuHfQbewDHH",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/4M3ZC35LmYJAv0ALDAT0YP?si=hUjOrRaMSo6PDwm72dI7MQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/grunge-the-drummers-toolbox/pl.u-leyl0Y6tj8ae2d",
                    ],
                    "Pop Punk" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJ6LbGO5gQ7wzmdeORtdx-N",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/0KdkqaF1SIF3JzC7ZSLyXD?si=gKRorYSST562u81TPlSuNA",
                        "apple_url" => "https://music.apple.com/ca/playlist/pop-punk-the-drummers-toolbox/pl.u-RRbVvBVF34qBPD",
                    ],
                ],
            ],
            "2" => [
                "title" => "Jazz",
                "description" => "Here you will find all the jazz drumming resources that pair with the material
                    in The Drummer’s Toolbox including lessons, drumless play-along tracks, and recommended
                    listening playlists.",
                "related_lessons" => [
                    [
                        "id" => 21788,
                    ],
                    [
                        "id" => 30337,
                    ],
                    [
                        "id" => 22672,
                    ],
                    [
                        "id" => 27207,
                    ],
                    [
                        "id" => 27291,
                    ],
                    [
                        "id" => 24831,
                        "youtube_id" => 'Bs6q9unJaOU',
                    ],
                    [
                        "id" => 21270,
                        "youtube_id" => 'TD4LzfkTU5o',
                    ],
                    [
                        "id" => 29410,
                        "youtube_id" => '1hhLcwQUlMk',
                    ],
                    [
                        "id" => 27126,
                        "youtube_id" => '9uQKjpYuG-s',
                    ],
                    [
                        "id" => 195922,
                        "youtube_id" => '5A0fw7-HKYE',
                    ],
                    [
                        "id" => 205451,
                        "youtube_id" => 'hboXLUpo-PA',
                    ],
                    [
                        "id" => 212876,
                    ],
                    [
                        "id" => 207139,
                        "youtube_id" => '8Tp8ojx8W_w',
                    ],
                ],
                "play_along_ids" => [231914, 230225, 230147, 215236, 30191, 28360, 25503, 28354, 22844, 23247],
                "playlists" => [
                    "4/4 Swing" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJPnzu5tmhgGEGO6oKvVeCy",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5rKidnmutd0tMv6yDbvacu?si=jn6fxbbVTtKILNFgsMcp2g",
                        "apple_url" => "https://music.apple.com/ca/playlist/4-4-swing/pl.u-6mo4aVKUBdz5AR",
                    ],
                    "Up-Tempo Swing" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIdDbGoyIpQ7kmuG0x83SCx",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1RLj7priozaPE1LFqNdlWd?si=0tdR4i9OTGSwLPKWS_zxdg",
                        "apple_url" => "https://music.apple.com/ca/playlist/up-tempo-swing/pl.u-Ldbqe0rtx47lba",
                    ],
                    "Big Band" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLV0RCzRwAxhetziokk_HVX",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/4osh5wa8AoqGf2bJgNGVQN?si=SI_U6KEZTPK05FiKBJvzAA",
                        "apple_url" => "https://music.apple.com/ca/playlist/big-band/pl.u-RRbVvxDC34qBPD",
                    ],
                    "3/4 Waltz" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvI7aOmj404wcq7kNTXBNCbd",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/4iThiO5TfAZDFOtUusMiq8?si=8TGsDox2TkOaS1mTwevVcQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/3-4-waltz/pl.u-leyl0JLfj8ae2d",
                    ],
                    "Brushes" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKMLJyeiJtfRe-ShYyBJmpc",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/0U49QgUJ4QmWuP3wF7HiNu?si=8ttUWPX2Q2-US6tzmH_iSw",
                        "apple_url" => "https://music.apple.com/ca/playlist/brushes/pl.u-BNA6Yj6I17kMv6",
                    ],
                    "Jazz Shuffle" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIHUqNg4UI5ITXlel7VNV5-",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6DWFnW5k06WhTx044Fgm5B?si=qs0RLq3DTaKJVGujFZexuA",
                        "apple_url" => "https://music.apple.com/ca/playlist/jazz-shuffle/pl.u-6mo4aWZSBdz5AR",
                    ],
                    "Odd Time Swing" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIgJwK2kIx37uF_A6Jxp9iM",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1z8Xw4eSGpqbnAZA1JvGEZ?si=ILmtVMiBQ0aRedZYXquEVA",
                        "apple_url" => "https://music.apple.com/ca/playlist/odd-time-swing-the-drummers-toolbox/pl.u-Ldbqev4Ix47lba",
                    ],
                    "Jazz Fusion" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKkbOtzg1Z9O_oynCehgHxo",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6UIi80KZP2kpkbBYE5BH2t?si=gF-bNB9dRLCSMnPcJYUUlQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/jazz-fusion-the-drummers-toolbox/pl.u-6mo4lAWfBdz5AR",
                    ],
                    "ECM Feet" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvI2FvO5RbAnMsT06ZV5At3d",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1QMV4PKM4AOd0bZrearhIc?si=7XA44SIyT7ylV_0sIZZZ1Q",
                        "apple_url" => "https://music.apple.com/ca/playlist/ecm-feel-the-drummers-toolbox/pl.u-LdbqEpdtx47lba",
                    ],
                    "Contemporary Jazz" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKMSvoK7MgnyK3USE81nc9w",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/4rQi6vgVetLBnuMCqbIUYp?si=kF_76SV-SMiqPplpN5koHQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/contemporary-jazz-the-drummers-toolbox/pl.u-ZmblVPpi0Br4Yl",
                    ],
                ],
            ],
            "3" => [
                "title" => "Blues",
                "description" => "Here you will find all the blues drumming resources that pair with the
                    material in The Drummer’s Toolbox including lessons, drumless play-along tracks, and
                    recommended listening playlists.",
                "related_lessons" => [
                    [
                        "id" => 29135,
                    ],
                    [
                        "id" => 23661,
                        "youtube_id" => '8pFysHHLM08',
                    ],
                    [
                        "id" => 222618,
                        "youtube_id" => 'KmVJZf92RtE',
                    ],
                ],
                "play_along_ids" => [226222, 224255, 25743, 8478, 29540, 223907, 222612, 222599, 9667, 23769],
                "playlists" => [
                    "Blues Shuffle" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKo4I0Xid2Bj9-V9zgjDMMq",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/3PvfrSD7VqZXmhn1c1hI7S?si=t-Oo6kGpS7CHHBVym-rkZg",
                        "apple_url" => "https://music.apple.com/ca/playlist/blues-shuffle-the-drummers-toolbox/pl.u-Ymb09W0SPvrk2z",
                    ],
                    "Straight 12/8 Blues" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKbP5Gxn1nzMzsQIJCZoGtB",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/72k8E9YKQYpgWSnN2TIkeB?si=dmJZb3IuQ_GVv-ORGE1Ugg",
                        "apple_url" => "https://music.apple.com/ca/playlist/straight-12-8-blues-the-drummers-toolbox/pl.u-6mo4lG3cBdz5AR",
                    ],
                    "Swung 12/8 Blues" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKn8FmiWmon2PtMA1nhv-NH",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/26mCw4g3gOgaR5iwoelsIX?si=UX7qrs-BSSq98WaTazfOEg",
                        "apple_url" => "https://music.apple.com/ca/playlist/swung-12-8-blues-the-drummers-toolbox/pl.u-LdbqE75Ix47lba",
                    ],
                    "Memphis Blues" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLr30zw7F8S2weM3QsVIbgW",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2RkUAJ7NAB29QJkHtTW7qm?si=4tfObLpDRKWlgpUZBIFz9Q",
                        "apple_url" => "https://music.apple.com/ca/playlist/memphis-blues-the-drummers-toolbox/pl.u-ZmblV4oC0Br4Yl",
                    ],
                    "Texas Blues" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJZErlmqdz8ViEmQ_r5uNPR",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/4HZC7rYFgAiapQUjXPH9RX?si=rncuJi8lRq6X8IXAnd0H6w",
                        "apple_url" => "https://music.apple.com/ca/playlist/texas-blues-the-drummers-toolbox/pl.u-PDb40gDCLq0xKZ",
                    ],
                    "Jump Blues" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJ4_k3H2YHq5ixPqjZsthlo",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2jkZURHfQ5xo2t85Y7uy1Y?si=pWkCZFjCQIORYeMfSY0-Kw",
                        "apple_url" => "https://music.apple.com/ca/playlist/jump-blues-the-drummers-toolbox/pl.u-PDb40YptLq0xKZ",
                    ],
                    "Chicago Blues" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvI9b0MzTxNzlZqHIuRGZrST",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1u56GeYIVUHmU8fTT8us7w?si=NlGDKW86SlCrjVQIj1bRrg",
                        "apple_url" => "https://music.apple.com/ca/playlist/chicago-blues-the-drummers-toolbox/pl.u-PDb40YVCLq0xKZ",
                    ],
                    "Flat Tire Shuffle" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKZKrTEW4OkFO7UciZOMIgB",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/726U8C9YELgNoC1mWqaMpX?si=n5iwOoynQjO2-e2Lzg8Zaw",
                        "apple_url" => "https://music.apple.com/ca/playlist/flat-tire-shuffle-the-drummers-toolbox/pl.u-Ymb09EquPvrk2z",
                    ],
                    "Blues Rock" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLrmiM29ktW22sun6woDt9R",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/41xBHPZmxjHYD1xj0CsFnj?si=CWGqjkVIS66mcT19IH-VNg",
                        "apple_url" => "https://music.apple.com/ca/playlist/blues-rock-the-drummers-toolbox/pl.u-Ymb09MRsPvrk2z",
                    ],
                    "Half-Time Shuffle" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJMQDXaUCQl42NHt1b_1VP7",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/4NMvpRMDO5JRTAGCTt58gH?si=wZ18emOtRUa-5F8RlcHzJw",
                        "apple_url" => "https://music.apple.com/ca/playlist/half-time-shuffle-the-drummers-toolbox/pl.u-ZmblVDGI0Br4Yl",
                    ],
                ],
            ],
            "4" => [
                "title" => "Country",
                "description" => "Here you will find all the country drumming resources that pair with the
                    material in The Drummer’s Toolbox including lessons, drumless play-along tracks, and
                    recommended listening playlists.",
                "related_lessons" => [
                    [
                        "id" => 22180,
                        "youtube_id" => 'lSXciZElKsI',
                    ],
                    [
                        "id" => 26698,
                        "youtube_id" => 'HMIQG9heAXg',
                    ],
                    [
                        "id" => 24479,
                        "youtube_id" => '8-ZcEdr8WfA',
                    ],
                    [
                        "id" => 24804,
                    ],
                    [
                        "id" => 27627,
                    ],
                    [
                        "id" => 22701,
                    ],
                ],
                "play_along_ids" => [12069, 12357, 16822, 24580, 218562, 218915],
                "playlists" => [
                    "Train Beat" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIlkLdTGfMnBiuNlb6WGwjR",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2jT86fZgPLQbODkXVSfGKR?si=4K3oOoSkSTCAn-bYGkkBnQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/train-beat-the-drummers-toolbox/pl.u-PDb40o6tLq0xKZ",
                    ],
                    "Western Swing" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIJRvIViZXoAfS1xtJQivKQ",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5gckteUvgmAnkjPaqGTqR3?si=7j_W2fvwR3GFKYYVSU9WCA",
                        "apple_url" => "https://music.apple.com/ca/playlist/western-swing-the-drummers-toolbox/pl.u-Ymb09ogTPvrk2z",
                    ],
                    "Bluegrass" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvL-5lmKUS-9hTVu95LHrE99",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/64s1bkNNaOf1yeyIb0PNQs?si=RA0aR6ABRWm2BJ4uOYbOGg",
                        "apple_url" => "https://music.apple.com/ca/playlist/bluegrass-the-drummers-toolbox/pl.u-vxy6kLYtzrKXYv",
                    ],
                    "Country Waltz" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIcLoBIdDH12HBEX9A1fWXP",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5VuZBZoVEh3gVINelASp9y?si=c8002MmlQYCqMpvtpMTT_A",
                        "apple_url" => "https://music.apple.com/ca/playlist/country-waltz-the-drummers-toolbox/pl.u-AkAm8ENs2v8kmj",
                    ],
                    "Two-Step" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJv404QN8p7_8BiVTENNYFo",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1qdrI1rJf7KYtZPsJ9Ae3Z?si=A4PRcjT1TyOKxHLpFr_QYA",
                        "apple_url" => "https://music.apple.com/ca/playlist/country-waltz-the-drummers-toolbox/pl.u-AkAm8ENs2v8kmj",
                    ],
                    "Rockabilly" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvL2UniTuJSeZeMzb1o9xBVu",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/74wLysrtUVeKbCOsDRe4Sc?si=IgWrBmtPTTqBvrTVOSadPA",
                        "apple_url" => "https://music.apple.com/ca/playlist/rockabilly-the-drummers-toolbox/pl.u-PDb408gsLq0xKZ",
                    ],
                    "Country Pop" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJffGMIGCd6afD-6QPTdyW5",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1em7WFpdqAHv3MDMH6LIRi?si=P7c3S_4JRNeRcChl8onPLw",
                        "apple_url" => "https://music.apple.com/ca/playlist/country-pop-the-drummers-toolbox/pl.u-Ymb0980iPvrk2z",
                    ],
                    "Country 6/8" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJB5k2Me5pK-Xn23rjHL5es",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/3flbimBSh5v280OnB5G0Ha?si=39UyfDfITGuY8wTHlzK3lw",
                        "apple_url" => "https://music.apple.com/ca/playlist/country-6-8-the-drummers-toolbox/pl.u-vxy6k1DCzrKXYv",
                    ],
                    "Country Shuffle" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLe2gOF0rjaNQ-MM6l2m_Il",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/3CziFufdietwgVZ2ZonBFe?si=vCAZ5g5UTK6h768n354TFQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/country-shuffle-the-drummers-toolbox/pl.u-AkAm82eU2v8kmj",
                    ],
                    "Country Rock" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJz1jiyDmFYAoZJHLkReqan",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5G7rp6aSxBnsbxVxT1XdTx?si=jl5PrmG1RMWWveZQ-XB3Og",
                        "apple_url" => "https://music.apple.com/ca/playlist/country-shuffle-the-drummers-toolbox/pl.u-AkAm82eU2v8kmj",
                    ],
                ],
            ],
            "5" => [
                "title" => "Soul & Funk",
                "description" => "Here you will find all the soul and funk drumming resources that pair
                    with the material in The Drummer’s Toolbox including lessons, drumless play-along tracks,
                    and recommended listening playlists.",
                "related_lessons" => [
                    [
                        "id" => 21065,
                    ],
                    [
                        "id" => 28959,
                    ],
                    [
                        "id" => 203165,
                        "youtube_id" => 'OZhM3Q8XP8s',
                    ],
                    [
                        "id" => 27548,
                        "youtube_id" => 'TsiYKOTmv1I',
                    ],
                    [
                        "id" => 28570,
                    ],
                ],
                "play_along_ids" => [21779, 21181, 30622, 30628, 227060, 29758, 26222, 23024, 17437, 224270],
                "playlists" => [
                    "Gospel" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvL2uoNkEvJwhuiAEj29eaP4",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1c9zRDMJ0ydokzVapC83VD?si=-coIpykRQWmyGyPH892tOw",
                        "apple_url" => "https://music.apple.com/ca/playlist/gospel-the-drummers-toolbox/pl.u-b3b8RX9FyaJb9P",
                    ],
                    "Motown" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJMq4_hRE34QW8CvK5_7zOp",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/45nS87KwNGEGGGESoEi0S1?si=LrxyogQhQtewO2Bzuk_USA",
                        "apple_url" => "https://music.apple.com/ca/playlist/motown-the-drummers-toolbox/pl.u-RRbV0X2C34qBPD",
                    ],
                    "Boogaloo" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKJKlLCgPX8oHG6fwHqP2rG",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2eYpkNJ9N8nvo5hlfMYGKo?si=HHTsd-uvS3iMYsGoqcHnow",
                        "apple_url" => "https://music.apple.com/ca/playlist/boogaloo-the-drummers-toolbox/pl.u-leyl1Xlsj8ae2d",
                    ],
                    "Neo-Soul" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLlJSb776e7NKW2_Vtw9yLe",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5Lu5GYsIKXEX5TX3SWxqrt?si=sVBNeC54QmG_KeB8MoO_kA",
                        "apple_url" => "https://music.apple.com/ca/playlist/neo-soul-the-drummers-toolbox/pl.u-BNA6rgXs17kMv6",
                    ],
                    "Second Line" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJt0rbEWOqVt2lZRddYZcWI",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/4fsD1tdmY8p3uaBfvxnjBE?si=DVVB03IcRaOQPukTEKDGog",
                        "apple_url" => "https://music.apple.com/ca/playlist/second-line-the-drummers-toolbox/pl.u-leyl1qYcj8ae2d",
                    ],
                    "Funk" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKveb0JyCPP5_tXL6lV3ord",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2z3Oz9PGOaZVLTSUF3m7Ge?si=mf10i32_RCqNUb229UkDYw",
                        "apple_url" => "https://music.apple.com/ca/playlist/funk-the-drummers-toolbox/pl.u-b3b8Re4HyaJb9P",
                    ],
                    "New Orleans Funk" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJPgT9KIRkuP8m07OzZv990",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6pt2Kshn0lWJ1qesVZYVju?si=e7sIhoIHSvW1x7ql7j8M5g",
                        "apple_url" => "https://music.apple.com/ca/playlist/new-orleans-funk-the-drummers-toolbox/pl.u-BNA6rKWT17kMv6",
                    ],
                    "Latin Funk" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLhnd2f9mqs5ywcYd-IUPoD",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5nbbKZJa7ab1rRycmiNRs2?si=GGE3wMbjT0uGXhwxeZeTTw",
                        "apple_url" => "https://music.apple.com/ca/playlist/latin-funk-the-drummers-toolbox/pl.u-leyl1BRcj8ae2d",
                    ],
                    "Go-Go" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIn32suZC_FPqU1U_893-vE",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2IKXjzW7IqtJl7YBjk1xQo?si=1ORE9W9IS2iLMv89JWkVSA",
                        "apple_url" => "https://music.apple.com/ca/playlist/go-go-the-drummers-toolbox/pl.u-RRbV0ZRI34qBPD",
                    ],
                    "Disco" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvL2mX6JGSKpyHlgCyD-M7D8",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5Ud1e2vhd4hzYovUrNr05o?si=_Ty7B3KvRBumLfRZ4uMM9Q",
                        "apple_url" => "https://music.apple.com/ca/playlist/disco-the-drummers-toolbox/pl.u-AkAm833i2v8kmj",
                    ],
                ],
            ],
            "6" => [
                "title" => "Metal",
                "description" => "Here you will all the metal drumming resources that pair with the
                    material in The Drummer’s Toolbox including lessons, drumless play-along tracks,
                    and recommended listening playlists.",
                "related_lessons" => [
                    [
                        "id" => 212098,
                    ],
                    [
                        "id" => 212099,
                    ],
                    [
                        "id" => 30864,
                    ],
                    [
                        "id" => 21115,
                        "youtube_id" => 'wW0hp2HmXak',
                    ],
                    [
                        "id" => 29323,
                    ],
                    [
                        "id" => 207134,
                    ],
                    [
                        "id" => 196616,
                    ],
                    [
                        "id" => 198667,
                        "youtube_id" => 'Y2gQbk_8o8M',
                    ],
                    [
                        "id" => 29520,
                        "youtube_id" => 'gWA6QPBAxF0',
                    ],
                    [
                        "id" => 22886,
                        "youtube_id" => 'gbh7Up_Q4YU',
                    ],
                    [
                        "id" => 23398,
                    ],
                    [
                        "id" => 25335,
                    ],
                    [
                        "id" => 25221,
                    ],
                ],
                "play_along_ids" => [218220, 212719, 207129, 23625, 207391, 9175, 22623, 25314, 25574, 19650],
                "playlists" => [
                    "Doom Metal" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJCfTY48t6nadOeK-yUmCKb",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/0zl8Yncg2bjmE5mSMyiOjn?si=2J8xKVe8RTyCiv-o8UhTng",
                        "apple_url" => "https://music.apple.com/ca/playlist/doom-metal-the-drummers-toolbox/pl.u-6mo4l2vIBdz5AR",
                    ],
                    "Speed Metal" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLCBJaq_YHe89BldUSXlo-A",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5EFpFAQT2pHXn0chaax2yn?si=383BRduERJu_LPbde4xh3Q",
                        "apple_url" => "https://music.apple.com/ca/playlist/speed-metal-the-drummers-toolbox/pl.u-LdbqE1vtx47lba",
                    ],
                    "Thrash Metal" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLe9Yk2BAEgU5NdL4JQtgnX",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1Cv8uDDWYH3oZKM3cr8V8y?si=A3YtoNc2RWWWb8lcIUwS1w",
                        "apple_url" => "https://music.apple.com/ca/playlist/thrash-metal-the-drummers-toolbox/pl.u-ZmbllMmF0Br4Yl",
                    ],
                    "Death Metal" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIUhxI0HriV4xlsu9i1p-T1",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6EBNWRc1CLEMcGkyhw2qr6?si=k3Lq-VToSTuj_7bs8Ypl0Q",
                        "apple_url" => "https://music.apple.com/ca/playlist/thrash-metal-the-drummers-toolbox/pl.u-ZmbllMmF0Br4Yl",
                    ],
                    "Power Metal" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJGzArCqhKTc5QHLx955HVN",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6anpljx9CQCAaEwQ3XiBrJ?si=NyeR6tORT1er-3vZs_GYxg",
                        "apple_url" => "https://music.apple.com/ca/playlist/power-metal-the-drummers-toolbox/pl.u-BNA66Jbt17kMv6",
                    ],
                    "Progressive Metal" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJnRv0IOahg2wNp3GuUnalb",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6oHdeL1lsw8eKP33yMZPLa?si=HcK1WZcCR8iOA7fWdVMl_w",
                        "apple_url" => "https://music.apple.com/ca/playlist/progressive-metal-the-drummers-toolbox/pl.u-6mo448yuBdz5AR",
                    ],
                    "Groove Metal" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIdX_FM4RNXmLnmgf-gLDd5",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5oHZJfHae45TuBehNwVGF7?si=zvtF9GNAT6ilXoFI4o5bXg",
                        "apple_url" => "https://music.apple.com/ca/playlist/groove-metal-the-drummers-toolbox/pl.u-Ldbqqj3Ix47lba",
                    ],
                    "Nu Metal" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJqBe4eEXiFOIU4yzJUREnq",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/0jnqPXQewudf1PZhlwuJc3?si=J-VTdsUQQD6hoP-Bgq2RAg",
                        "apple_url" => "https://music.apple.com/ca/playlist/nu-metal-the-drummers-toolbox/pl.u-Zmbllp1C0Br4Yl",
                    ],
                    "Metalcore" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJSW3YcT7OPVJs-KltsyCY2",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/18BTNPaghDLFdgagg14p14?si=dJP1iholTV2xACh2g8vtFg",
                        "apple_url" => "https://music.apple.com/ca/playlist/metalcore-the-drummers-toolbox/pl.u-Ldbqqeqtx47lba",
                    ],
                    "Folk Metal" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvI5TcmW0StQrXf1SSV82k-O",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/7zLfxL5rRK0qThJpRewnp2?si=8N50n2jkTYOjFr8s2IGQEw",
                        "apple_url" => "https://music.apple.com/ca/playlist/folk-metal-the-drummers-toolbox/pl.u-Zmbllxjt0Br4Yl",
                    ],
                ],
            ],
            "7" => [
                "title" => "Electronic",
                "description" => "Here you will all the electronic drumming resources that pair with the
                    material in The Drummer’s Toolbox including lessons, drumless play-along tracks,
                    and recommended listening playlists.",
                "related_lessons" => [
                    [
                        "id" => 31028,
                    ],
                    [
                        "id" => 20804,
                    ],
                    [
                        "id" => 19876,
                    ],
                    [
                        "id" => 26292,
                        "youtube_id" => 'u4_WsgKCCnQ',
                    ],
                ],
                "play_along_ids" => [227316, 29074, 18472, 27729, 30342, 24753, 27375, 24431, 24394, 27557],
                "playlists" => [
                    "Hip-Hop" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLoR-1sx88XvqDW34JCqiUf",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2bN7BanvsSs6USrDxI4BAZ?si=N55LFlMzRsCBwNlkeRmkqw",
                        "apple_url" => "https://music.apple.com/ca/playlist/hip-hop-the-drummers-toolbox/pl.u-Ymb00vPuPvrk2z",
                    ],
                    "Breakbeat" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIeqaU6zqdBVyYvMVxteDDb",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2jcenRc9NQ5xAey99SJV5d?si=7SqxgFraSTeEpU6lQrIaTQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/breakbeat-the-drummers-toolbox/pl.u-ZmbllxWI0Br4Yl",
                    ],
                    "Electro" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIFG_iNnHAsA--EdDC6o9hz",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/0796UdF02VGvNv4fOrZnDg?si=f-zqHsZIRdiDqOxngnbMOQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/electro-the-drummers-toolbox/pl.u-LdbqqBjIx47lba",
                    ],
                    "House" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJcQclWFGMFBiSic7doxa-C",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1ZYQXmpsCNf7lNm913nsBa?si=MSuprTyITs-rORz57tlMaA",
                        "apple_url" => "https://music.apple.com/ca/playlist/house-the-drummers-toolbox/pl.u-ZmblljJh0Br4Yl",
                    ],
                    "Techno" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJzXlvgRweyukQ9TJ7ZoV1O",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5KCrPLveA7093Dq18JSMxU?si=tJiq5fDqQ62ABTQJg6IYdg",
                        "apple_url" => "https://music.apple.com/ca/playlist/techno-the-drummers-toolbox/pl.u-PDb4464TLq0xKZ",
                    ],
                    "Trance" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIRrrOmMybjhXdLvKH-oL6c",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1H8Evx6qMy92W7kHhCFsWk?si=L-hSMVzoQr6soxcK1XEcSw",
                        "apple_url" => "https://music.apple.com/ca/playlist/techno-the-drummers-toolbox/pl.u-PDb4464TLq0xKZ",
                    ],
                    "Jungle" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvL8KFMQpr5P0KShYDZO84oQ",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/232yb7U4xGKMwkLUSnRPcq?si=V3f7vY94SVG9lC_1FraMHw",
                        "apple_url" => "https://music.apple.com/ca/playlist/jungle-the-drummers-toolbox/pl.u-vxy66DXtzrKXYv",
                    ],
                    "Drum and Bass" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJPkpjGa1VhKYYaQowICBIJ",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2tNo9KorPKOsEsdf0w5qUF?si=VH4cfzuTSb6u0xJbNuxm4A",
                        "apple_url" => "https://music.apple.com/ca/playlist/drum-and-bass-the-drummers-toolbox/pl.u-Ymb00BycPvrk2z",
                    ],
                    "Dubstep" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKFi0sOW1-gt5W3Zh-ItnTt",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/4cuW1yTCWlqdsCiXp2gYYO?si=UQfoGkT-RpKsXDczsf3FkA",
                        "apple_url" => "https://music.apple.com/ca/playlist/dubstep-the-drummers-toolbox/pl.u-Zmblldmf0Br4Yl",
                    ],
                    "Trap" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJP9Jpl-eXCxDFBbHg4f1B1",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2kNawFprP0m4jfjfgISGSr?si=sQUzf-6DQ7WMmMPEIVAVbw",
                        "apple_url" => "https://music.apple.com/ca/playlist/trap-the-drummers-toolbox/pl.u-PDb44lZCLq0xKZ",
                    ],
                ],
            ],
            "8" => [
                "title" => "Afro-Cuban",
                "description" => "Here you will all the Afro-Cuban drumming resources that pair with the
                    material in The Drummer’s Toolbox including lessons, drumless play-along tracks,
                    and recommended listening playlists.",
                "related_lessons" => [
                    [
                        "id" => 29841,
                    ],
                    [
                        "id" => 29528,
                        "youtube_id" => 'c5hu3H2ElLE',
                    ],
                    [
                        "id" => 23232,
                        "youtube_id" => '769dD5caLmE',
                    ],
                    [
                        "id" => 28184,
                    ],
                    [
                        "id" => 28190,
                    ],
                    [
                        "id" => 22981,
                    ],
                    [
                        "id" => 21698,
                        "youtube_id" => '9WNXeNFVQ3c',
                    ],
                ],
                "play_along_ids" => [28190, 28184, 28188, 28749, 29302, 9504, 22225, 30193],
                "loops" => [
                    "Tumbao" => [
                        "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/tumbao/tumbao-',
                        "tempos" => [80, 90, 100, 110, 120, 130],
                        "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/tumbao.zip',
                    ],
                    "6/8 Nanigo" => [
                        "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/6-8-nanigo/6-8-nanigo-',
                        "tempos" => [70, 80, 90, 100, 110, 120, 130],
                        "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/6-8-nanigo.zip',
                    ],
                ],
                "playlists" => [
                    "Abakuá" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKJQck6q7Z8aknt-qPqNeql",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6tBQOH21nYypkcfKmujfXT?si=ehkyFsEFQmGlzpE7op2FKA",
                        "apple_url" => "https://music.apple.com/ca/playlist/abaku%C3%A1-the-drummers-toolbox/pl.u-vxy6676CzrKXYv",
                    ],
                    "Guajira" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLFmiGc6emW2bgfypQlZagU",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5Y8syLjlYuYFPRA7QE4FCr?si=RtermDVaSDOXW_Jt8nR5Bw",
                        "apple_url" => "https://music.apple.com/ca/playlist/guajira-the-drummers-toolbox/pl.u-Ymb0045UPvrk2z",
                    ],
                    "Bolero" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLx9B615UID9kxr8vwS4ESg",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5hmO0NRmYWOBSXx7yRYDtB?si=62OGuYuNSyOOGqWpWKFqvg",
                        "apple_url" => "https://music.apple.com/ca/playlist/bolero-the-drummers-toolbox/pl.u-vxy66ejFzrKXYv",
                    ],
                    "Guaguancó" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIf8mtn8T2r5eHmlDf6zbLW",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/33j1xmU9GSM1BVvU9fNHz1?si=H8aqqXO6QlGS1TLOEq3tYQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/guaguanc%C3%B3-the-drummers-toolbox/pl.u-RRbVV1DI34qBPD",
                    ],
                    "Conga" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvI_MHNkfTJR_PomW42LMOTQ",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/7MxjlpMn5fLNmfDHxZeDI8?si=2_DbgMT_QP-dUxpTu22uhg",
                        "apple_url" => "https://music.apple.com/ca/playlist/conga-the-drummers-toolbox/pl.u-b3b88G3HyaJb9P",
                    ],
                    "Mambo" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIjK1vHqieOwTKfYyFSreVi",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5oKk5dSZeuvPKwJg3ztqEh?si=-zWWBQZ8RAqUUtL-FkCTUw",
                        "apple_url" => "https://music.apple.com/ca/playlist/mambo-the-drummers-toolbox/pl.u-Ymb00XPtPvrk2z",
                    ],
                    "Cha-Cha-Chá" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKqLHvU-gpQA4BjTS1_HPvj",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/7owxGM5xUrpGNuAuTcbfCe?si=35lGZ-VpTfGuq56Av8brTg",
                        "apple_url" => "https://music.apple.com/ca/playlist/cha-cha-ch%C3%A1-the-drummers-toolbox/pl.u-AkAmmKpI2v8kmj",
                    ],
                    "Nanigo" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIs4P6SVg6cOypf6ZOzH-E4",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/7COmlbGCc7X8VPLOXUmgJZ?si=TS6oYwjSSteM3_2xRdqEKg",
                        "apple_url" => "https://music.apple.com/ca/playlist/nanigo-the-drummers-toolbox/pl.u-AkAmm5yI2v8kmj",
                    ],
                    "Mozambique" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKo3FPXwloMhsd9U6iT_Mr0",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1WJOaEOmOjdvZWhUMXsuZn?si=1MDs6z7fSEWgmbSkqFGFpA",
                        "apple_url" => "https://music.apple.com/ca/playlist/mozambique-the-drummers-toolbox/pl.u-vxy66A3uzrKXYv",
                    ],
                    "Songo" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIpiNzLqY2nZCsMfXmolVRo",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/50pSeaHdA98D4Whdjk5FZO?si=XxZ6pWelR_yrk-IVdWzv-Q",
                        "apple_url" => "https://music.apple.com/ca/playlist/songo-the-drummers-toolbox/pl.u-b3b88LeuyaJb9P",
                    ],
                ],
            ],
            "9" => [
                "title" => "Afro-Brazilian",
                "description" => "Here you will all the Afro-Brazilian drumming resources that pair with the
                    material in The Drummer’s Toolbox including lessons, drumless play-along tracks, and recommended
                    listening playlists.",
                "related_lessons" => [
                    [
                        "id" => 30368,
                    ],
                    [
                        "id" => 20657,
                    ],
                ],
                "play_along_ids" => [20657, 30368],
                "loops" => [
                    "Baiao" => [
                        "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/baiao/baiao-',
                        "tempos" => [70, 80, 90, 100, 110, 120, 130, 140],
                        "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/baiao.zip',
                    ],
                    "Bossa" => [
                        "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/bossa/bossa-',
                        "tempos" => [100, 110, 120, 130, 140, 150],
                        "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/bossa.zip',
                    ],
                    "Samba" => [
                        "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/samba/samba-',
                        "tempos" => [80, 90, 100, 110, 120, 130],
                        "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/samba.zip',
                    ],
                ],
                "playlists" => [
                    "Afoxê" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLf6v4mH3naOD8rUF9EWxro",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/0XTA1ZeEuMZijYJ1mHT6G9?si=ggXKDnwhQfKGV_1PRK2gZQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/afox%C3%AA-the-drummers-toolbox/pl.u-b3b88yDSyaJb9P",
                    ],
                    "Samba" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKa8Fg5p76fLuOox6UX72c_",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/3QbPzNND5q3Vtu9Ac3nbqQ?si=vVk7Va7ST3-Q8DkvhBSQUA",
                        "apple_url" => "https://music.apple.com/ca/playlist/samba-the-drummers-toolbox/pl.u-RRbVVE7F34qBPD",
                    ],
                    "Maracatu" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKIrUNRADhubd63fw6AnGCA",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/15vZ9SiuseC6pZbrMmXIdE?si=z6WujTN2QOuIU0A4Lavouw",
                        "apple_url" => "https://music.apple.com/ca/playlist/maracatu-the-drummers-toolbox/pl.u-leyllVGUj8ae2d",
                    ],
                    "Choro" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIyvaL7PlLsudQBK0LP7Q22",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6rJl8LG2vuOri71UxNVM1K?si=Z5f9Ff0iTum60YiZIVOo0Q",
                        "apple_url" => "https://music.apple.com/ca/playlist/choro-the-drummers-toolbox/pl.u-BNA664VF17kMv6",
                    ],
                    "Marcha" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvK-SiEXSEaHL9eRFfY2adZr",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2WneeFX5H4xqKhlgc0EC37?si=GfRGfJUISFyj-D19Z31rbg",
                        "apple_url" => "https://music.apple.com/ca/playlist/marcha-the-drummers-toolbox/pl.u-6mo44X3IBdz5AR",
                    ],
                    "Frevo" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJNMr7a82n7uCX3FTQVx1P7",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/7DWbFcEkAx3sp6mZbzw1mi?si=a5fVZj3KRJqs1gFim0Un4g",
                        "apple_url" => "https://music.apple.com/ca/playlist/frevo-the-drummers-toolbox/pl.u-b3b8M67IyaJb9P",
                    ],
                    "Partido Alto" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKVY4VvLYafdjex_YG6dTxF",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/3pRQTJ52XkMMyoDGOR7yAa?si=rjIDXAf9Q1mL0K-dgkI8UQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/partido-alto-the-drummers-toolbox/pl.u-RRbVYrVC34qBPD",
                    ],
                    "Baião" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJsjFmQVFxt2G41QA6AmRsp",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2KdsRz7YuHJ19xxcAr2GGJ?si=J0T_41PDQ3-dNpPetQwpOg",
                        "apple_url" => "https://music.apple.com/ca/playlist/bai%C3%A3o-the-drummers-toolbox/pl.u-leylMx8sj8ae2d",
                    ],
                    "Bossa Nova" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLTKxwJFBt9m7e8t9CxCIAE",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6Hz3W1dsY4gdFYmD0YiYm8?si=5mODdnETQOaBuNBqh2d0mQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/bossa-nova-the-drummers-toolbox/pl.u-BNA6vpeF17kMv6",
                    ],
                    "Samba Reggae" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKpKPJ7fJSH2kKMNBUp50bK",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/4temAo8rftz08kw40LHpRS?si=rvtYkn5CSNuEqbMAUnqMVQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/samba-reggae-the-drummers-toolbox/pl.u-6mo41AKuBdz5AR",
                    ],
                ],
            ],
            "10" => [
                "title" => "Afro-Caribbean",
                "description" => "Here you will all the Afro-Caribbean drumming resources that pair with the
                    material in The Drummer’s Toolbox including lessons, drumless play-along tracks,
                    and recommended listening playlists.",
                "related_lessons" => [
                    [
                        "id" => 31234,
                    ],
                    [
                        "id" => 30588,
                    ],
                ],
                "play_along_ids" => [234785, 28407, 27919, 16623, 11770, 12805],
                "loops" => [
                    "Reggae" => [
                        "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/reggae/world-reggae-',
                        "tempos" => [70, 80, 90, 100, 110],
                        "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/reggae.zip',
                    ],
                    "Ska" => [
                        "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/ska/ska-',
                        "tempos" => [150, 160, 170, 180, 190, 200, 210, 220, 230, 240, 250],
                        "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/ska.zip',
                    ],
                ],
                "playlists" => [
                    "Calypso" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJgumxs8O4vDF_0RrShNAEN",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/2Lc5wJQoAuZPqRIJJMlnsH?si=kO2dd27-QiyDkGO0e0IB3A",
                        "apple_url" => "https://music.apple.com/ca/playlist/calypso-the-drummers-toolbox/pl.u-6mo41G8fBdz5AR",
                    ],
                    "Biguine" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvLYRKeUp_TQ91IjoyRAlq4U",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5ZksYmKFspT4KdBoGqyalb?si=5580niZ4R42tn7FCDltbGQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/biguine-the-drummers-toolbox/pl.u-Ldbqz7gtx47lba",
                    ],
                    "Merengue" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvJfpuzT6TqsFBZMOEWAZCov",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/4kCva8z5NqvxwVDETjU8JA?si=JbyrNZHxQZiGBJ0xLauWhg",
                        "apple_url" => "https://music.apple.com/ca/playlist/merengue-the-drummers-toolbox/pl.u-ZmblD4li0Br4Yl",
                    ],
                    "Bachata" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvI5F5KajNwEorKgZaAYeYdj",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/3nSj6vSuMbw7UqKW3Zebsp?si=ybPdNT6lR7iDDmxrqkSFvw",
                        "apple_url" => "https://music.apple.com/ca/playlist/bachata-the-drummers-toolbox/pl.u-PDb4Ym6ILq0xKZ",
                    ],
                    "Ska" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIxX8ppDYUqupQDy-eOUCGs",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/7xLWjOL4Dv5bwCRKoHAXi3?si=-2qmvF8EStqfAvlRbqOv6g",
                        "apple_url" => "https://music.apple.com/ca/playlist/ska-the-drummers-toolbox/pl.u-BNA6v6Rs17kMv6",
                    ],
                    "Reggae" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvKs1FhXgGbTb9qBUuK-R0q-",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5cmqCZIAeLKM1P6iSdGp3s?si=5YTCjxpnSlOrUjYj8WnAuQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/reggae-the-drummers-toolbox/pl.u-6mo414WcBdz5AR",
                    ],
                    "Salsa" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvI8gZnmGI2z4kuk-tovno-5",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6TBpzgQGFU504PkSQs1ksy?si=tClfnEWPTOi1d_LzdBGMaQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/salsa-the-drummers-toolbox/pl.u-LdbqzzdIx47lba",
                    ],
                    "Soca" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvK_Q5FAVSn3ORkKrEvVi5m0",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/6KAbecDDwvADGR9rjSxUwF?si=NVxEhm5eTxSRlRzwyOesmA",
                        "apple_url" => "https://music.apple.com/ca/playlist/soca-the-drummers-toolbox/pl.u-ZmblDDph0Br4Yl",
                    ],
                    "Dancehall" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIhEUr6TN3lFhRFhkbDUg7O",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/1lKlovxOcYucCMgV5uXkP7?si=J7AuTzxBSyukpD6L0Aq05g",
                        "apple_url" => "https://music.apple.com/ca/playlist/dancehall-the-drummers-toolbox/pl.u-PDb4YYguLq0xKZ",
                    ],
                    "Zouk" => [
                        "youtube_url" => "https://www.youtube.com/playlist?list=PLD06Z31oxRvIHQtCOhTB8qPasKN8uDbjJ",
                        "spotify_url" => "https://open.spotify.com/user/iewchaoxlxuyjwguisn6nj63r/playlist/5qnhZVLOegTaaFxVoGZJjk?si=VvTWvhRhSY6kqvjECYgVhQ",
                        "apple_url" => "https://music.apple.com/ca/playlist/zouk-the-drummers-toolbox/pl.u-ZmblDZWS0Br4Yl",
                    ],
                ],
            ],
        ];

        if ($chapters[$chapter]) {
            return $chapters[$chapter];
        }

        // Send to 404 page if the chapter doesn't exist
        return abort(404);
    }
}
