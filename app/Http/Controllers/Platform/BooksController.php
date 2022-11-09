<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Mailora\Services\MailService;
use Railroad\Ecommerce\Repositories\ProductRepository;
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

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(

        ProductRepository $productRepository,
        MailService $mailService,
        ContentService $contentService
    ) {
        $this->mailService = $mailService;
        $this->contentService = $contentService;
        $this->productRepository = $productRepository;
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
                    ],
                    [
                        "title" => "Getting Started on the Piano Lesson 1",
                        "external_link" => '/getting-started/lessons/now-what',
                    ],
                    [
                        "title" => "Getting Started on the Piano Lesson 2",
                        "external_link" => '/getting-started/lessons/scales',
                    ],
                    [
                        "title" => "Proper Hand Posture at the Piano",
                        "youtube_id" => "rZznie6UU_o",
                        "content_id" => "212650",
                    ],
                    [
                        "title" => "Proper Posture at the Piano",
                        "youtube_id" => "E8Do4oxTJ1k",
                        "content_id" => "212649",
                    ],
                    [
                        "title" => "How to Play Piano Scales Hands Together",
                        "youtube_id" => "gfEeGlHsjaY",
                        "content_id" => "218415",
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
                    ],
                    [
                        "title" => "Basic Time Signatures",
                        "youtube_id" => "ixm4R7hG-pk",
                        "content_id" => "221014",
                    ],
                    [
                        "title" => "Understanding Rhythm",
                        "youtube_id" => "yFAcDynQdeQ",
                        "content_id" => "220813",
                    ],
                    [
                        "title" => "Suspended Piano Chords 101",
                        "youtube_id" => "XfSdJiXqCCY",
                        "content_id" => "202599",
                    ],
                    [
                        "title" => "Understanding Intervals On The Piano",
                        "youtube_id" => "Hi9bUcnHLBo",
                        "content_id" => "219623",
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
                        "external_link" => '/getting-started/lessons/minor-scale',
                    ],
                    [
                        "title" => "How To Play Minor Scales On The Piano",
                        "youtube_id" => "AZw3dQ53lEY",
                        "content_id" => "209921",
                    ],
                    [
                        "title" => "How To Read Music Faster",
                        "youtube_id" => "qP53j8CxDdg",
                        "content_id" => "231439",
                    ],
                    [
                        "title" => "What Is An Arpeggio",
                        "youtube_id" => "i4Zsvtvm_g0",
                    ],
                    [
                        "title" => "What Are Dynamics",
                        "youtube_id" => "szLVM-KghlY",
                        "content_id" => "209918",
                    ],
                    [
                        "title" => "Crescendos & Decrescendos",
                        "youtube_id" => "mnjgPKTSuCI",
                        "content_id" => "201890",
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
                    ],
                    [
                        "title" => "How To Find The Root Note & Identify Chord Inversions",
                        "youtube_id" => "zrn86vyjcX8",
                        "content_id" => "221921",
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
                        "external_link" => '/chord-hacks/lessons/chord-hacking',
                        "youtube_id" => "PpV1nffIPFc",
                    ],
                    [
                        "title" => "Chord Hacks - Inversions Basics",
                        "external_link" => '/chord-hacks/lessons/inversions',
                        "youtube_id" => "l5BYWY6ZJJs",
                    ],
                    [
                        "title" => "Chord Hacks - Left Hand Magic",
                        "external_link" => '/chord-hacks/lessons/adding-rhythm',
                        "youtube_id" => "pQnDDgA73tc",
                    ],
                    [
                        "title" => "Chord Hacks - Putting It Together",
                        "external_link" => '/chord-hacks/lessons/two-hands',
                        "youtube_id" => "A_dwTWUjAs0",
                    ],
                    [
                        "title" => "Chord Hacks -  Making It Fancy",
                        "external_link" => '/chord-hacks/lessons/chord-progressions',
                        "youtube_id" => "FxWWLCxcQ-g",
                    ],
                    [
                        "title" => "Chord Hacks - Pave The Way",
                        "external_link" => '/chord-hacks/lessons/popular-songs',
                        "youtube_id" => "AK8bJwqZFHg",
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
                    ],
                    [
                        "title" => "The 1-5-6-4 Chord Progression",
                        "youtube_id" => "8n7LsgFfFC4",
                        "content_id" => "209922",
                    ],
                    [
                        "title" => "Understanding Rhythm",
                        "youtube_id" => "yFAcDynQdeQ",
                        "content_id" => "220813",
                    ],
                    [
                        "title" => "Basic Time Signatures",
                        "youtube_id" => "ixm4R7hG-pk",
                        "content_id" => "221014",
                    ],
                    [
                        "title" => "How To Use The Pedal",
                        "youtube_id" => "EkE7tlmuAlc",
                        "content_id" => "234326",
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
                    ],
                    [
                        "title" => "Make Your Piano Playing Instantly More Dramatic",
                        "youtube_id" => "sWSxHBn7uus",
                        "content_id" => "223641",
                    ],
                    [
                        "title" => "The Perfect Beginner Piano Fill",
                        "youtube_id" => "4sJIW1d1NVA",
                        "content_id" => "229420",
                    ],
                    [
                        "title" => "Right Hand Fills And Tricks On The Piano",
                        "youtube_id" => "ALNKC4zIK04",
                        "content_id" => "222781",
                    ],
                    [
                        "title" => "Improvising Beautiful Melodies On The Piano",
                        "youtube_id" => "sWSxHBn7uus",
                        "content_id" => "223644",
                    ],
                    [
                        "title" => "How To Fake Being Awesome At The Piano",
                        "youtube_id" => "BXqGi1QuA5w",
                        "content_id" => "227474",
                    ],
                    [
                        "title" => "The Most Important Piano Interval",
                        "youtube_id" => "L34fjAdTqxs",
                        "content_id" => "220533",
                    ],
                    [
                        "title" => "How To Unwind At The Piano",
                        "youtube_id" => "9QyaeFAyg1A",
                        "content_id" => "224470",
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
                    ],
                    [
                        "title" => "12 Bar Blues Piano Lesson",
                        "youtube_id" => "kLFkT3LBWzA",
                        "content_id" => "219628",
                    ],
                    [
                        "title" => "Improvise With These Beautiful Scale Patterns",
                        "youtube_id" => "W164rUS0LVA",
                        "content_id" => "231441",
                    ],
                    [
                        "title" => "The Pentatonic Scale",
                        "youtube_id" => "9negqvipGuc",
                        "content_id" => "227482",
                    ],
                    [
                        "title" => "The Blues Scale Formula",
                        "youtube_id" => "Eosor-ncv7Y",
                        "content_id" => "212652",
                    ],
                    [
                        "title" => "What Is Swing Feel",
                        "youtube_id" => "sDfZRdBmT5E",
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
                    ],
                    [
                        "title" => "Understanding 7th Chords On The Piano",
                        "youtube_id" => "AKSMzmjCTN8",
                        "content_id" => "224463",
                    ],
                    [
                        "title" => "Minor 7 Flat 5 Piano Chord",
                        "youtube_id" => "wlDqq41ZsKA",
                        "content_id" => "212416",
                    ],
                    [
                        "title" => "The Most Villainous Piano Chord (Diminished 7th)",
                        "youtube_id" => "Pdou5KtHhkI",
                        "content_id" => "215029",
                    ],
                    [
                        "title" => "The Major 9th Chord: “The Chord Of Morning Light”",
                        "youtube_id" => "nApVvrvLoaI",
                        "content_id" => "215033",
                    ],
                    [
                        "title" => "The 2-5-1 Chord Progression (Jazz Piano 101)",
                        "youtube_id" => "EZsHfvzPxuI",
                    ],
                    [
                        "title" => "The 2-5-1 Chord Progression (Jazz Piano 101)",
                        "youtube_id" => "9XIVncmKdng",
                        "content_id" => "217310",
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
        $foundations = $this->contentService->getById('215952');

        return $foundations['units'][$levelNumber - 1]['lessons'] ?? abort(404);
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
                                "contentLink" => url()->route('books.best-beginner-drum-book.play-alongs'),

            ],
            [
                "thumbnail" => 'https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/chapter-10.jpg',
                "chapterTitle" => "Playing To Music",
                "title" => "Drumless Play-Along Tracks",
                "description" => "Here you’ll find all of the resources for Chapter 10. You can turn the drums or
                click on and off. You can also download a PDF version of a “Cheat Sheet” at the bottom of this page!",
                                "contentLink" => url()->route('books.best-beginner-drum-book.play-alongs'),

            ],
        ];

        return view('books.best-beginner-drum-book.index', [
            "hasAccess" => $hasAccess,
            "chapters" => $chapters,
            "isDigital" => $isDigital,
            "user" => $user,
        ]);
    }
        public function bestBeginnerPlayAlongs(){
            ContentRepository::$bypassPermissions = true;

            $user = user();

            $hasAccess = $user && ($user->isAMember() || $user->isPackOnlyOwner());

            $idsToPull = ['28360', '20657', '23989', '23625', '8431', '24431', '14295', '11689', '23024', '24580'];

            $listLessons = new ContentFilterResultsEntity(['results' => $this->contentService->getByIds($idsToPull)]);
            $listLessons['total_results'] = 10;

            return view(
                'books.best-beginner-drum-book.play-alongs',
                [
                    "hasAccess" => $hasAccess,
                    "listLessons" => $listLessons->toResponseRawJson(),
                ]
            );
    }

}
