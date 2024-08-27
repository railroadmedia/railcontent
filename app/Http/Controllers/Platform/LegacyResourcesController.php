<?php

namespace App\Http\Controllers\Platform;

use Illuminate\View\View;
use App\Maps\ContentTypes;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\FullTextSearchService;

class LegacyResourcesController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService;
    /**
     * @var FullTextSearchService
     */
    private $fullTextSearchService;

    public function __construct(
        ContentService $contentService,
        FullTextSearchService $fullTextSearchService
    ) {
        $this->contentService = $contentService;
        $this->fullTextSearchService = $fullTextSearchService;
    }

    public function show(): View
    {
        $sections = [
            [
                "url" => url()->route('platform.legacy-resources.archive'),
                "icon" => "icon-archive",
                "title" => "Archives",
                "download" => false,
            ],
            [
                "url" => 'http://drumeosecure.s3.amazonaws.com/tools-resources/00-drum-notation-resources/the-drumeo-notation-key.pdf',
                "icon" => "icon-notation-key",
                "title" => "Notation Key",
                "download" => true,
            ],
            [
                "url" => 'http://drumeosecure.s3.amazonaws.com/tools-resources/00-drum-notation-resources/blank-notation.pdf',
                "icon" => "icon-blank-staff",
                "title" => "Blank Staff",
                "download" => true,
            ],
            [
                "url" => url()->route('platform.legacy-resources.dictionary'),
                "icon" => "icon-dictionary-drum-terms",
                "title" => "Dictionary of Terms",
                "download" => false,
            ],
            [
                "url" => 'http://drumeosecure.s3.amazonaws.com/tools-resources/00-drum-notation-resources/blank-chart.pdf',
                "icon" => "icon-blank-song",
                "title" => "Blank Song Chart",
                "download" => true,
            ],
            [
                "url" => url()->route('platform.legacy-resources.loops'),
                "icon" => "icon-loops",
                "title" => "Loops",
                "download" => false,
            ],
        ];

        return view('legacy.resources', [
            'sections' => $sections,
        ]);
    }

    /*
        * Pass search string as value of "term" query string param to get search instead.
        */
    public function archive(Request $request): View
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 20);

        ContentRepository::$availableContentStatues = [ContentService::STATUS_ARCHIVED];

        $contents = $this->contentService->getFiltered($page, $limit);
        $lessons = (new ContentFilterResultsEntity($contents))->toResponseRawJson();

        if ($request->get('term')) {
            $results = $this->searchArchive($request->get('term'), $page, $limit);
            $lessons = (new ContentFilterResultsEntity($results))->toResponseRawJson();
        }

        $includedTypes = ContentTypes::searchableContentTypes();

        return view('legacy.archives', [
            "lessons" => $lessons,
            "totalResults" => $contents['total_results'],
            "includedTypes" => json_encode($includedTypes),
        ]);
    }

    private function searchArchive($search, $page, $limit)
    {
        $results = $this->fullTextSearchService->search($search, $page, $limit, [], [ContentService::STATUS_ARCHIVED]);

        return $results;
    }

    public function loops(): View
    {
        $bassLoops = [
            "3/4 Jazz" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/3-4-jazz/3-4-jazz-',
                "tempos" => [70, 80, 90, 100, 110],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/3-4-jazz.zip',
            ],
            "5/4 Jazz" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/5-4-jazz/5-4-jazz-',
                "tempos" => [80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/5-4-jazz.zip',
            ],
            "5/4 Rock" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/5-4-rock/5-4-rock-',
                "tempos" => [80, 90, 100, 110, 120, 130, 140, 150, 160, 170],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/5-4-rock.zip',
            ],
            "6/8 Nanigo" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/6-8-nanigo/6-8-nanigo-',
                "tempos" => [70, 80, 90, 100, 110, 120, 130],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/6-8-nanigo.zip',
            ],
            "7/4 Rock" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/7-4-rock/7-4-rock-',
                "tempos" => [70, 80, 90, 100, 110],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/7-4-rock.zip',
            ],
            "7/8 Rock" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/7-8-rock/7-8-rock-',
                "tempos" => [100, 110, 120, 130, 140, 150],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/7-8-rock.zip',
            ],
            "9/8 Rock" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/9-8-rock/9-8-rock-',
                "tempos" => [80, 90, 100, 110, 120, 130, 140],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/9-8-rock.zip',
            ],
            "Alternative Rock" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/alternative-rock/alternative-rock-',
                "tempos" => [90, 100, 110, 120, 130, 140, 150, 160],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/alternative-rock.zip',
            ],
            "Baiao" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/baiao/baiao-',
                "tempos" => [70, 80, 90, 100, 110, 120, 130, 140],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/baiao.zip',
            ],
            "Blues" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/blues/blues-',
                "tempos" => [60, 70, 80, 90, 100, 110, 120, 130, 140],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/blues.zip',
            ],
            "Bossa" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/bossa/bossa-',
                "tempos" => [100, 110, 120, 130, 140, 150],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/bossa.zip',
            ],
            "Country" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/country/country-',
                "tempos" => [90, 100, 110, 120, 130, 140, 150],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/country.zip',
            ],
            "Dubstep" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/dubstep/dubstep-',
                "tempos" => [110, 120, 130, 140],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/dubstep.zip',
            ],
            "Electronica" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/electronica/electronica-',
                "tempos" => [100, 110, 120, 130, 140, 150],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/electronica.zip',
            ],
            "Funk" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/funk/funk-',
                "tempos" => [90, 100, 110, 120, 130, 140],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/funk.zip',
            ],
            "Jazz Walking Bass" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/jazz-walking-bass/jazz-walking-bass-',
                "tempos" => [80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/jazz-walking-bass.zip',
            ],
            "Jazz" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/jazz/jazz-',
                "tempos" => [80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180, 190],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/jazz.zip',
            ],
            "Metal" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/metal/metal-',
                "tempos" => [90, 100, 110, 120, 130, 140, 150, 160],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/metal.zip',
            ],
            "Punk" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/punk/punk-',
                "tempos" => [140, 150, 160, 170, 180, 190, 200, 210, 220, 230, 240, 250, 260, 270],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/punk.zip',
            ],
            "R & B" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/r-and-b/r-and-b-',
                "tempos" => [70, 80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/r-and-b.zip',
            ],
            "Reggae" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/reggae/world-reggae-',
                "tempos" => [70, 80, 90, 100, 110],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/reggae.zip',
            ],
            "Samba" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/samba/samba-',
                "tempos" => [80, 90, 100, 110, 120, 130],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/samba.zip',
            ],
            "Ska" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/ska/ska-',
                "tempos" => [150, 160, 170, 180, 190, 200, 210, 220, 230, 240, 250],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/ska.zip',
            ],
            "Tumbao" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/tumbao/tumbao-',
                "tempos" => [80, 90, 100, 110, 120, 130],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/tumbao.zip',
            ],
        ];

        $speedTrainers = [
            "60 BPM" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-60/click-track-60-',
                "tempos" => ['60-100', '60-120', '60-160', '60-220'],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-60.zip',
            ],
            "80 BPM" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-80/click-track-80-',
                "tempos" => ['80-120', '80-180'],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-80.zip',
            ],
            "100 BPM" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-100/click-track-100-',
                "tempos" => ['100-140', '100-160', '100-200'],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-100.zip',
            ],
            "120 BPM" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-120/click-track-120-',
                "tempos" => ['120-160', '120-220'],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-120.zip',
            ],
            "140 BPM" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-140/click-track-140-',
                "tempos" => ['140-180', '140-200'],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-140.zip',
            ],
            "160 BPM" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-160/click-track-160-',
                "tempos" => ['160-200'],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-160.zip',
            ],
            "180 BPM" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-180/click-track-180-',
                "tempos" => ['180-220', '180-240'],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/click-track-180.zip',
            ],
        ];

        $clickTrackTrainers = [
            "2-2" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/2-2/2-2-',
                "tempos" => [60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/2-2.zip',
            ],
            "3-1" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/3-1/3-1-',
                "tempos" => [60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/3-1.zip',
            ],
            "4-4" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/4-4/4-4-',
                "tempos" => [60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/4-4.zip',
            ],
            "6-2" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/6-2/6-2-',
                "tempos" => [60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/6-2.zip',
            ],
            "8-8" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/8-8/8-8-',
                "tempos" => [60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/8-8.zip',
            ],
        ];

        $percussionLoops = [
            "Batajon 1" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/batajon-1/batajon-1-',
                "tempos" => [80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/batajon-1.zip',
            ],
            "Batajon 2" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/batajon-2/batajon-2-',
                "tempos" => [80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/batajon-2.zip',
            ],
            "Bongos" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/bongos-1/bongos-1-',
                "tempos" => [80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/bongos-1.zip',
            ],
            "Ceramic Drum" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/ceramic-drum-1/ceramic-drum-1-',
                "tempos" => [80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/ceramic-drum-1.zip',
            ],
            "Conga 1" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/conga-1/conga-1-',
                "tempos" => [80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/conga-1.zip',
            ],
            "Conga 2" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/conga-2/conga-2-',
                "tempos" => [80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/conga-2.zip',
            ],
            "Conga 3" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/conga-3/conga-3-',
                "tempos" => [80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/conga-3.zip',
            ],
            "Conga 4" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/conga-4/conga-4-',
                "tempos" => [80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/conga-4.zip',
            ],
            "Djembe" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/djembe-1/djembe-1-',
                "tempos" => [80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/djembe-1.zip',
            ],
            "Tabla" => [
                "base_url" => 'https://dz5i3s4prcfun.cloudfront.net/loops/tabla-1/tabla-1-',
                "tempos" => [80, 90, 100, 110, 120],
                "download" => 'https://dz5i3s4prcfun.cloudfront.net/loops/tabla-1.zip',
            ],
        ];

        return view('legacy.loops', [
            "bassLoops" => $bassLoops,
            "speedTrainers" => $speedTrainers,
            "clickTrackTrainers" => $clickTrackTrainers,
            "percussionLoops" => $percussionLoops,
        ]);
    }

    public function dictionary()
    {
        $terms = [
            "A" => [
                "Accent" => "A note that is significantly louder than neighbouring
     notes. Accents are important in the development of rhythm, syncopation and articulation. Also
     see Ghosting.",
                "Acrylic" => "A type of strong plastic that, since the late 1960s, has
     been used for drum shells. (John Bonham loved his Ludwig “Vistalite” plastic-shelled drums.)
    ",
                "Ad Lib" => "Literally ‘at liberty’, the musician is allowed a free
     hand for what may be played during this passage. Sometimes denotes a feature for a soloist or
     simply a vamp to help set the mood for what is to come next.",
                "Afro-Latin/Afro-Cuban/Afro-Caribbean" => "The songs, rhythms and
     dances that originated in Latin and South America as a result of an African influence on
     native musics. E.g. Rumba, conga, tango, salsa, mambo, and also Latin-Jazz and even hip-hop.
    ",
                "Air Lock" => "The tendency for hi-hat cymbals to stick together
     resulting in a ‘pfft’ sound or even silence. Cymbal manufacturers have devised a number of
     solutions to air lock including rippled edges, scalloped edges and drilling air holes or
     putting rivets in the bottom cymbal.",
                "Alloy" => "A metal that is made by combining two other metals. E.g.
     bronze is the product of combining copper and tin.",
                "Anticipation" => "Striking an up beat in such a way that it seems to
     be a part of the next beat. E.g. in jazz it’s very common to ‘replace’ 1 with 4-uh. (Bill
     Bruford uses a lot of anticipation of the down beat.)",
                "Articulation" => "The manner in which strokes are played and sounds
     are produced. Ideally every stroke should be clean and well defined.",
                "Ashtray Hand" => "See Traditional Grip.",
                "Attack" => "Sounds have a beginning, a middle and an end. The initial
     spike of sound is called the attack and is usually sharp and short lived. Cymbals have a
     somewhat longer attack than drums. Also see Decay, Envelope.",
            ],
            "B" => [
                "B8" => "A type of bronze that is 8% tin and 92% copper. The metal does
 not have the quality of bell bronze, but can produce a decent cymbal at a moderate price. The
 sound such cymbals produce might be described as hard or brittle, which makes them ideal for
 rock. For the beginner or someone on a tight budget, they can be a good option. Also see Sheet
 Metal Cymbal.",
                "B12" => "A type of bronze made from 12% tin and 88% copper. Not as
 common as B8 or B20.",
                "B20" => "The alloy known as bell bronze is made of 20% tin and 80%
 copper. This is the highest quality of musical bronze and is the standard for professional
 quality cymbals and gongs.",
                "Back Beat" => "In 4/4 or common time, striking the snare (usually) on
 counts 2 and 4. This sets up the rhythm and adds tension and momentum.",
                "Back Phrasing" => "Playing well ‘behind the beat’, a common technique
 used by soloists. As an accompanist, a drummer must be aware that the lead instrument may
 virtually cast aside the time while back phrasing. Some soloists will back-phrase constantly.
",
                "Backstick/Back Sticking" => "A visually entertaining way of playing
 using both ends of the stick by quickly flipping the stick from tip-first to butt-first. A
 frequent highlight of rudimental drumming.",
                "Bar" => "The basic unit of music. One bar contains the full complement
 of the time signature. Thus a bar of 6/8 would contain 6 eighth notes (or equivalent).",
                "Basel Drumming" => "A rudimental/drum corps tradition established in
 Basel, Switzerland, in the early 1600s and still going strong. Many of today’s rudiments were
 adapted from the so-called Swiss rudiments of Basel.",
                "Bass Drum" => "Sometimes called a ‘kick’ drum, a bass drum is a large,
 low-pitched drum that usually lies on its side on the floor or in a rack, and is played with a
 foot-operated pedal. Range from 16″ to 28″, with 18″ to 24″ the most common. Also see Port,
 Wet.",
                "Bass Drum Pedal" => "For years drummers experimented with gadgets that
 would allow them to play a bass drum with a pedal. Then in 1909, the Ludwig brothers of
 Chicago introduced a pedal that actually worked. The device revolutionized drumming and was
 the missing piece that enabled the drum set to blossom. Many early pedal models were made of
 wood, sometimes heel activated, and occasionally hung from the top of the drum. Also see
 Double Pedal, Overhang Pedal.",
                "Batter Head" => "The top head of a drum, the one that gets ‘battered’.
",
                "Battery" => "The drum section of a marching band or drum corps.
 Consists of snare drums, tenor drums, bass drums, and cymbals. Also see Front Line.",
                "Bead" => "The small round, acorn- or barrel-shaped tip of a drum
 stick.",
                "Beam" => "In written music, a curved line that is placed over a group
 of notes to denote an irregular note division. E.g. triplets would be shown with a beam over
 the notes with the number 3 above the beam.",
                "Bearing Edge" => "The top and bottom edges of a drum where the drum
 head meets the shell. It’s important that the bearing edges are smooth and even, to allow the
 head to sit properly on the drum with no dips, wrinkles or dead spots. A drum with uneven
 bearing edges will be difficult to tune. There are different philosophies regarding the
 positioning, angle and profile of bearing edges, which may or may not have a scientific basis
 or measurable effect. Also see Snare Bed.",
                "Beat" => "The basic unit of rhythm or pulse. E.g. the time signature
 4/4 specifies four quarter notes per bar, which means four beats to each bar.",
                "Beater" => "The striker of a bass drum pedal. Also see Mallets.",
                "Beats Per Minute/BPM" => "The standard method of specifying tempo.
 Metronomes are typically calibrated from 40 bpm to 208 bpm, although in practice music tempos
 can be slower or faster (the upper limit being around 400 bpm).",
                "Behind The Beat" => "Normally an ensemble — and a rhythm section in
 particular — will play time so that it falls in the ‘middle’ of the beat. Some musicians will
 play slightly behind the mid-point of the beat, but not to the point of sounding slower (see
 Dragging). The result is a solid, relaxed feel that still conveys energy. Not the same as back
 phrasing. Also see On Top of the Beat, Pocket.",
                "Bell (of a Cymbal)" => "The rounded dome shape at the centre of a
 cymbal. Often used to produce a bell-like sound. The size, shape and height of the bell help
 to define the cymbal’s pitch and overall character, e.g. crash cymbals tend to have larger
 bells than ride cymbals.",
                "Bell Bronze" => "See B20, Bronze.",
                "Bell Cymbal" => "A cymbal that is mostly bell. Usually small — 8″ to
 12″ — and heavy, with a very small bow. Sometimes created by cutting most of the bow off of a
 damaged cymbal.",
                "Bell Tree" => "A stack of small graduated cup-shaped bells. Played by
 dragging a small stick from top to bottom producing a glissando.",
                "Black Dot" => "A copyrighted name for a Remo drum head that has a
 reinforcing ‘dot’ of Mylar in the centre of the head. Originally created to withstand the
 heavy pounding of rock drummers, the heads produce a distinctive tone that is desirable in its
 own right. (Tony Williams used black dot heads on all his drums, including the snare.)",
                "Blade" => "Another name for the bow of a cymbal, in particular a
 smaller cymbal with an upturned edge.",
                "Blast Beat" => "A somewhat frantic playing style that relies on long
 bursts of eighth notes on the snare and cymbals, accompanied by double bass drum beats.",
                "Blues" => "See 12-bar Blues",
                "Bodhran" => "A frame drum rooted in Irish and Celtic music.",
                "Bols" => "In East Indian drumming, bols are the various strokes. Each
 bol has a unique sound and its own spoken syllable, e.g., ‘Na’ is an open sound on the high
 drum (tabla); ‘Ga’ is an open sound on the low drum (bayan). See Tala.",
                "Bomb" => "When not referring to a lick that didn’t work, it’s a form a
 bass drum shot popular in some styles of jazz. Joe Morello was fond of dropping bass drum
 bombs.",
                "Bongos" => "A joined pair of small, slightly tapered, open-ended hand
 drums popular in Latin music and among beatniks. Usually tuned quite high.",
                "Boogaloo" => "A style of Latin music that evolved in the US in the
 1960s. A fusion of Latin and soul music, it gave birth to music such as Herbie Hancock’s
 “Watermelon Man”.",
                "Boogie-woogie" => "A type of fast-tempo dance music that emerged in
 the 1930s, usually featuring piano. Sometimes called fast blues or eight-to-the-bar.",
                "Book" => "A band or orchestra’s repertoire. Their ‘song book’.",
                "Boomwhackers" => "Lightweight plastic tubes of different lengths and
 different colours. Each colour is tuned to a specific note, and melodies can be played by
 striking the tubes in the desired order. Often used for educational and group exercises.",
                "Boomy" => "Low pitched, having a lot of volume and perhaps a bit too
 much resonance and sustain, with controlled overtones. Also see Damping.",
                "Bossed Gong" => "A gong that has a raised dome in the centre of the
 playing area. The gong can be played by striking the boss or the area to the side of the boss.
 A boss tends to produce a well-defined note.",
                "Bounce" => "1. The response of a percussion instrument. Some
 techniques require a certain amount of bounce in order to play them cleanly and/or at speed
 (e.g. double-stroke roll); 2. A lively rhythm.",
                "Bow (of a Cymbal)" => "The ‘flat’ part and main playing area of a
 cymbal. The shape, depth, taper and thickness of the bow determine how the cymbal will sound,
 which in turn will determine — or at least suggest — how the cymbal should be used. See
 Profile.",
                "Brass" => "Though at first glance brass would seem to be the same as
 bronze, this alloy of copper and zinc is too weak and malleable for serious cymbal use.",
                "Break" => "1. A momentary period of silence; 2. A section where the
 band plays short, staccato figures (see Ensemble Notes); 3. A short passage where the drummer
 provides a conspicuous fill.",
                "Break Beat" => "The term applies to both a genre of music and a
 rhythmic style. Break beats originated when DJs programmed distinctive drum breaks into
 sequencers, and then ran them non-stop. As a drumming style, break beats are typically fast
 and syncopated, with a strong emphasis on the down beat. In a live situation, a drummer would
 play a comparable rhythm, almost always in 4/4, with a strong down beat and syncopation
 interpolated with doubles and buzzes on the snare. A favourite of break dancers and Jo Jo
 Meyer.",
                "Breathe" => "Keeping strict time is a valuable skill, but sometimes
 the music benefits from minor increases and decreases in tempo as the energy of the music
 waxes and wanes. When the playing gets exciting, the tempo may creep up a bit, and then slow
 down when the energy ebbs. Such shifts are tolerable only if they are very slight.",
                "Bridge" => "In a 32-bar tune with AABA construction, the bridge is the
 ‘B’ section. Also see Middle Eight, Pop Tune.",
                "Bridge (of a Cymbal)" => "The region of a cymbal where the bell
 evolves into the bow. Research shows that the shape of the bridge can have an effect on a
 cymbal’s tone and response.",
                "Bright" => "A cymbal (but can be applied to a drum) that has a lot of
 high frequencies. May be a light cymbal with high overtones/partials and few low frequencies,
 or a heavy cymbal with high-pitched fundamentals. Bright sounds are better able to project and
 cut through. Also see Envelope, Metal Shell, Timbre.",
                "Brilliant Finish" => "A cymbal that has been polished to a high
 lustre, usually by applying an abrasive. This removes some of the metal and may obliterate
 tone grooves. The cymbals are often brilliant in sound as well as appearance.",
                "Brittle" => "See Glassy, Trash.",
                "Bronze" => "An alloy made by combining copper and tin. Bronze is the
 preferred metal for making cymbals due to its strength and tonal qualities. The two main types
 of bronze used for cymbals are B20 (bell bronze) and B8. Cymbal companies often have their own
 formulas for creating bronze, sometimes adding a small percentage of other metals (e.g.
 silver, gold, phosphorus), and may have closely guarded processes.",
                "Brushes" => "When a softer sound is required, a drummer might opt to
 use brushes made of wire or plastic. Drum brushes resemble whisk brooms, which is what
 drummers used before wire brushes became available. Playing with brushes is considered a bit
 of a specialized art form.",
                "Build" => "The tendency for a cymbal to develop a ‘swell’ of sound as
 it’s being played. Similar to wash, though usually with a lower pitch. See Undertone.",
                "Bushing" => "A spacer that is positioned inside one hardware part to
 facilitate attaching another part. Most modern stands have nylon bushings within the clamps
 that hold the various pieces. Provides a firm grip and prevents rattles while protecting the
 parts from damage. Also found on drum racks.",
                "Butt" => "The end of a drumstick opposite the bead. Typically a
 drummer will hold the stick near the butt end, but reversing that is quite acceptable. See
 Back Sticking, Rock Knockers.",
                "Butt Plate" => "A metal plate to which snare wires are attached and
 that has holes to provide a means of attaching the snares to a drum. A set of snares has a
 butt plate at each end. Also see Snare Bed, Snare Head, Snare Strainer.",
                "Buzz" => "A sound made by pressing the bead of a drum stick into the
 head and dragging it slightly. The technique causes the stick to bounce off the head a number
 of times, producing a buzzing sound. See Buzz Roll, Scratch Roll.",
                "Buzz Roll" => "A type of smooth, clean, continuous roll usually played
 on the snare drum. See Buzz, Double-stroke Roll, Scratch Roll, Whipped Cream Roll",
            ],
            "C" => [
                "Cadence" => "A rhythmic cadence is a distinctive pattern that
     indicates the end of a phrase. See Resolution, Turn-around.",
                "Cajon" => "A ‘drum’ that consists of a rectangular wooden box with a
     sound hole in the back. The player sits atop and plays on the front surface, hitting different
     spots for different sounds. Also see Idiophone, Membranophone.",
                "Calf Skin" => "A piece of leather taken from the back of a 1 to 3
     year-old calf — at one time the only option for drum heads. Although almost entirely replaced
     by plastic heads, calf skin heads have a cult following and some drummers consider them far
     superior to plastic. On the down side, leather heads are easily affected by temperature and
     moisture, and cost 2-3 times as much as plastic heads. See FibreSkyn, Goat Skin, Polyester,
     Slunk.",
                "Cannon Toms" => "Extreme power toms.",
                "Carbon Fiber" => "One of several types of material used in resin
     shells. The drums are manufactured in the same way as a fibreglass shell, substituting a sheet
     of carbon fiber fabric for fibreglass.",
                "Carnatic" => "The classical music of Southern India, famed for its
     highly evolved rhythms and tala system.",
                "Cascara" => "A standard rhythm that is often played against the clave
     rhythm. For example, the right hand might play the cascara while the left hand plays the
     clave.",
                "Cast Cymbal" => "The best cymbals start out as a single cast ingot of
     bell bronze. After smelting, the metal is poured into small moulds about the size of a soup
     bowl. When the metal cools, it is machine-rolled repeatedly to create a large disk. Rolling
     also compresses the metal and ‘aligns’ its structure. The cymbal is then pressed and/or
     hammered into its final shape, and most are lathed. Also see Hammering, Roto-casting.",
                "Cast Hoop" => "A counter hoop that is made of cast metal rather than
     bent or spun metal. Tend to make a drum sound somewhat ‘boxy’. Can be easier to tune than
     flanged hoops.",
                "Chain Drive" => "At one time bass drum pedals relied on strips of
     leather to connect the foot plate to the beater assembly. In the late 1960s, drum companies
     began to substitute lengths of chain. A chain link is smoother, immune to stretching, nearly
     indestructible, and is now almost universal.",
                "Cheese" => "A double stroke preceded by a grace note. Often found in
     hybrid rudiments. (So-named possibly because it sounds a bit like ‘cheese’.)",
                "Chick/Chup" => "The sort of sound that a hi-hat makes when played by
     quickly depressing the pedal. Thicker cymbals make a ‘chick’ sound whereas lighter cymbals
     sound more like ‘chup’.",
                "Chimes/Tubular Bells" => "A set of tuned metal tubes hung in a frame
     and usually forming an octave. Played by striking the top of a tube with a soft hammer.",
                "China (Type) Cymbal" => "A cymbal that has its outer edge turned up,
     pagoda style, and occasionally with a square bell. Produces a short, trashy tone. Sometimes
     mounted upside down, they are used as both ride and crash cymbals. Available in most sizes,
     including splash cymbals. Also see Swish Knocker.",
                "China Boy" => "See China Cymbal.",
                "China Splash" => "A confusing category that includes a number of
     styles of small splash cymbals. Authentic Chinese cymbals produce a distinctive glissando
     effect.",
                "Chinese Drum/Tom" => "To add tonal variety, early drum set players
     added Chinese toms to their set-ups. These drums had heavy wood shells and two animal hide
     heads that were tacked in place. The drums were tuned by wetting or heating the heads. See
     Tunable Tom.",
                "Chops" => "A colloquialism denoting technique, usually in reference to
     someone who has a lot of it coupled with notable speed.",
                "Chow/Chau Gong" => "The classic gong, mostly flat with turned over
     edges. Often have a ‘bulls-eye’ pattern on the playing surface.",
                "Clash Cymbals" => "See Hand Cymbals.",
                "Clave" => "1. An instrument of Latin American origin that consists of
     two short, thick dowels of tone wood such as rosewood. The dowels are struck together making a
     sharp, clear tone; 2. A standard rhythm that is played on claves. The bossa nova rhythm is a
     type of clave pattern. Also see Ostinato.",
                "Click Track" => "To help the band stay in time during a recording
     session, the tune’s tempo is sometimes played through the monitor headphones.",
                "Coarse" => "A bit raunchier than trashy.",
                "Cocktail Drum" => "A space-saving configuration that consists of a
     tall tom, 14″ to 16″ in diameter and 20″ or so deep, often with a small snare drum, a cymbal,
     and perhaps a tom attached. A modified bass drum pedal can be rigged to strike the bottom head
     of the main drum.",
                "Collar" => "The ‘vertical’ part of a drum head, between the retaining
     ring and the playing surface. The collar must be suitable to the size and shape of the drum
     shell and the collar depth must suit the depth of the counter hoop. The rim may sit too low or
     too high if the collar is not right for the drum.",
                "Colouration" => "General term for the tone and timbre of a cymbal.",
                "Common Time" => "Another name for the 4/4 time signature. The
     signature is so pervasive in all music forms that is it now thought of as the default
     signature, and is sometimes denoted by a large ‘C’ in the music staff.",
                "Comping" => "To accompany or complement a soloist. In a jazz context,
     it is common to play a jazz ride while adding accents and figures on the snare drum and/or
     bass drum. The goal is to enhance the music while impelling the soloist to greater heights.
    ",
                "Complex" => "Having plenty of overtones and perhaps undertones as
     well. Thin cymbals tend to be more complex then thicker ones (see Ping) and hand hammered ones
     even more so.",
                "Concert Toms" => "A set of single-headed drums in graduated sizes. May
     be tuned to a scale. Also see Octoban, Tenor Drum.",
                "Configuration" => "Drum catalogs refer to standard drum set offerings
     as configurations. The basic configuration is the 4-piece: snare drum, bass drum and 2 toms.
     While cymbal stands are often included, cymbals are not figured into the count — e.g., a
     seven-drum kit would be a ‘7 piece’ regardless of how many cymbals were illustrated in the
     catalog.",
                "Conga" => "A large, single-headed hand drum ranging from 10″ to 12″ in
     diameter and approximately waist height. The body is amphora-shaped and may be made from wood
     or fiberglass. Usually played in pairs, they are almost required in Latin music.",
                "Console" => "The original drum rack, consoles were a standard part of
     early drum sets. They consisted of a large stand with a hoop that encircled the bass drum, to
     which the drummer could attach various holders. A trap tray was a common accessory for holding
     bells, whistles and other gadgets. Some consoles were mounted on wheels, with the bass drum
     resting inside. Others were stripped down models that were attached directly to the bass drum
     — predecessors to the consolette.",
                "Consolette/Rail Consolette" => "A type of tom mount that consists of a
     short, curved rail attached to the bass drum plus an adjustable arm to hold a tom. De rigeur
     up until the late sixties, they are making a comeback.",
                "Control Unit/Brain/Drum Module" => "A computer that accepts input from
     drum triggers and converts it into sounds. Sounds are often samples from live drums and
     cymbals, augmented by various synthesized sounds. Sampled sounds need not be only from
     percussion instruments. Some control units can be programmed with new sounds.",
                "Controlled Sound/CS" => "See Black Dot.",
                "Cosmetically Hammered" => "A cymbal that has conspicuous hammer marks
     on its surface. The cymbal may have been hammered for tone but visible marks are mainly
     cosmetic and may contribute little to the sound.",
                "Count" => "See Beat, Time Signature.",
                "Counter Hoop" => "A hoop, usually made of metal, that holds the drum
     head against the drum and is held in place with tension bolts. At one time the hoops were made
     of wood, and there has been renewed interest in wood hoops on snares and toms. Also see Cast
     Hoop, Triple-Flanged, Rim, Rope Tension, S-hoop.",
                "Cover Tune/Cover Band" => "Originally a reference to a band that
     played currently popular tunes, usually making an effort to sound true to the original. Now
     used broadly to refer to any performance of a previously recorded work regardless of any
     creativity or originality inherent in the new version. (It’s hard to think of someone like
     Miles Davis doing ‘covers’.)",
                "Cow Bell" => "Originally borrowed from inattentive cows, these
     instruments have undergone dramatic changes over the years. Now available in an astounding
     array of sizes, shapes, colours and materials, they are often heard in funk and Latin music.
     Some drummers even have their own signature cowbells.",
                "Cradle Position" => "See Traditional Grip.",
                "Crash (Cymbal)" => "A cymbal that produces a distinctive crash sound
     and is used as an accent. Crash cymbals are typically smaller and thinner than ride cymbals,
     and usually have a larger bell, which allows the bow of the cymbal to vibrate more. Also see
     China Cymbal, Crash-Ride, Splash Cymbal, Trash.",
                "Crash-Ride" => "A cymbal that is deemed suitable for both ride and
     crash work.",
                "Crisp" => "Usually a reference to a snare drum that has a short,
     sharp, high-pitched attack.",
                "Cross Matching" => "Creating a set of hi-hat cymbals by pairing
     cymbals from different lines and even different manufacturers.",
                "Cross Rhythm/Cross Beats" => "A type of polyrhythm where a second
     rhythm or time signature is played within the original. A standard pattern is to play two bars
     of 3 and a bar of 2 rather than two bars of 4. The result is a rhythm that appears to weave in
     and out of the underlying rhythm. See Polymeter.",
                "Cross/Criss-Cross Tuning" => "Tuning a drum by adjusting one tension
     bolt and then the bolt directly opposite, and proceeding around the drum. On an 8-lug drum,
     the pattern would be: 1, 5, 2, 6, 3, 7, 4, 8.",
                "Cross-Stick" => "The technique of holding the drum stick bead against
     the drum head near the rim and striking the rim with the other end of the stick, producing a
     satisfying ‘click’ or ‘clock’ sound. Sometimes erroneously called a rim shot, the cross-stick
     is useful for creating a subtle effect. Very common in jazz, country and Latin music. Also see
     Stick Shot.",
                "Cubop" => "See Latin Jazz.",
                "Cup" => "Another name for a cymbal’s bell.",
                "Custom Drums" => "A somewhat misleading term applied to limited
     production, often high-end instruments. A truly custom-made drum would not be fabricated until
     after the buyer had signed off on all specifications.",
                "Cut" => "1. The quality of a sound that enables it to penetrate
     through surrounding sounds. I.e. having good projection, often due to higher pitch and bright
     overtones; 2. To ‘defeat’ another player, as in “I can cut him any day!” which means “I can
     play much better than him.”",
                "Cut Time" => "See Half Time.",
                "Cymbal" => "These disks of bronze have been prized as musical
     instruments for thousands of years (from about 1200 BCE). To produce a cymbal, a bronze ingot
     is rolled many times to reduce it to a thin, flat disk. This process also changes the nature
     of the metal, giving it the beginnings of its strength and distinctive musical tones. The
     disks are then pressed or ‘hammered’ into a specific shape, according to anticipated use. The
     majority of cymbals are then lathed to remove the oxidized surface, creating tone grooves. See
     B8, Bell Bronze, Hammering, Hand Hammered, Lathing, Roto-casting, Spun Formed.",
                "Cymbal Choke" => "1. To produce a short, quick accent on a crash
     cymbal by striking it and then choking it with a hand or arm. Can be very dramatic visually;
     2. To clamp a cymbal too tightly to a stand, preventing it from moving and vibrating freely.
     While this produces a choked sound, it also dramatically shortens the cymbal’s life
     expectancy.",
                "Cymbal Cleaner" => "Over time, cymbals accumulate dirt, fingerprint
     grease and corrosion (see Patina). Philosophies on what to do about this differ. Some drummers
     would never mess with this gift of time. Some want to remove the grunge while others want to
     return the cymbal to its original lustre. Many cymbal makers offer a cymbal cleaner designed
     to clean the cymbal of grime without attacking the metal. Removing ‘age’ requires that the
     surface of the cymbal be stripped away via a ‘chemical peel’. Aggressive cleaning will, over
     time, permanently affect the sound of a cymbal.",
                "Cymbal Weight" => "It’s tempting to classify cymbals purely by weight
     and diameter, but there are various design elements that can affect a cymbal’s sound as much
     as weight. For example, the height of the bell can make one cymbal sound higher (heavier) or
     lower (lighter) than a comparable cymbal with a different bell profile. In general, cymbals
     are classed from paper thin through to heavy. Cymbals are also classified by intended use and
     tonal character: ‘Ping Ride’, ‘Explosive Crash’, etc. Each cymbal type will have a fairly
     standard range of weights, e.g. a 20″ medium ride can range from just over 2000 grams to
     nearly 3000 grams.",
                "Cymbal Clutch" => "A device that holds the top cymbal of a hi-hat
     assembly. Also see Drop Clutch.",
                "Cymbal Pack" => "A prepackaged set of cymbals matched at the factory
     for tone and compatibility. Basic sets include hi-hat, ride and crash; larger sets add another
     crash cymbal or two. Often a good bargain and an excellent starting point for beginning
     players. Some makers also offer extension packs, which may include china type and splash
     cymbals.",
                "Cymbal Smith" => "A craftsperson who specializes in making cymbals. It
     takes many years of training and apprenticeship to attain the rank of cymbal smith.",
            ],
            "D" => [
                "Damping" => "General term for any technique that seeks to reduce the
 ring and resonance of a drum. Includes adding tape, pads, plastic or foam rings, felt strips,
 pillows, blankets, and mechanical dampers. Also see EMAD, EQ Ring.",
                "Dark" => "A cymbal with low pitch, few overtones and a dry stick
 sound.",
                "Dark vs. Bright" => "A reference to a lack or abundance of high
 frequencies and overtones. Drums and cymbals rich in high frequencies are often described as
 bright; those with few highs are interpreted as dark.",
                "Deadsticking" => "Allowing the tip of the stick to remain on the
 surface of the drum or cymbal after striking to muffle the sound.",
                "Decay" => "The final moments of a sound, when it fades to nothing. The
 conclusion of the sound envelope.",
                "Direct Drive" => "A bass drum pedal that has a solid link between the
 pedal and beater unit rather than a flexible one (see Chain Drive). The second foot board of a
 double pedal is usually linked through direct drive to the primary pedal.",
                "Disco Beat" => "A common rhythm pattern that appeared during the disco
 era of the 1970s. Derived from funk, it emphasized four-to-the-bar on the bass drum, a strong
 back beat and an off-beat pattern on the hi-hat (see Pea Soup). The rhythm can still be found
 in break beats.",
                "Djembe" => "A single-headed, hourglass shaped hand drum of African
 (Mali) origin. Rope-tuned, skin-covered, 9″ to 18″ in diameter, the djembe is valued for its
 tonal range and its volume. The name derives from the African term for ‘peace gathering’.",
                "Donut" => "For want of a better term, denotes any sort of
 tone-enhancing ring that is added to a drum head during manufacture.",
                "Double Bass" => "1. A two bass drum set-up; 2. Double bass drum pedal
 set-up; 3. Another name for an upright acoustic bass.",
                "Double Bummer" => "See Rock Knockers.",
                "Double Headed" => "A drum that has both top and bottom heads. See
 Resonance, Resonant Head.",
                "Double Pedal" => "A pedal that has two foot plates and two beaters
 attached to a single foot pedal assembly, allowing the drummer to play double bass drum
 patterns on a single drum. The gadget is highly popular as, along with eliminating the added
 expense and real estate requirement of a second bass drum, it allows the hi-hat to remain in
 its original area (typically it had to be moved away from the player to make room for a second
 drum). There now appears to be a cult following for players who over-play double bass pedals.
 (The double bass pedal is not a new invention. Sonor produced a commercial model in 1927.)
 Also see Blast Beat.",
                "Double Time" => "A shift in both time signature and feel to suggest a
 doubling of the tempo without a change in the song structure. E.g. A song in 4/4 might shift
 to 8/8. While the song would seem to be moving along at twice the speed, the bars would have
 twice as many beats and therefore remain the same length over time. Also see Half Time, Cut
 Time.",
                "Double-stroke Roll" => "A type of roll in which the player allows the
 sticks to bounce, producing a second stroke. This Rr-Ll-Rr-Ll pattern is sometimes called the
 long roll or ‘mama-dada’ roll. See Opened/Closed.",
                "Doumbek" => "A single-headed hour-glass shaped hand drum. Available in
 a number of diameters and about 2 ½ times as tall as its diameter, it is a favourite of
 drumming circles.",
                "Down Beat" => "1. The first count in a bar or measure; 2. The first
 beat of a new phrase (see Resolution).",
                "Drag" => "A rudiment similar to the flam except that the grace note is
 a double stroke (i.e.rrL llR). See Rudiment Family.",
                "Dragging" => "A tendency to slow down rather than keeping steady time.
 As with rushing, considered a major flaw. Not the same as playing behind the beat.",
                "Drop Clutch" => "A two-piece hi-hat cymbal clutch that incorporates a
 quick-release mechanism. This allows the drummer to easily drop the top cymbal onto the bottom
 one. The device is often used by double-bass drummers. The clutch can also pick up the cymbal
 by simply depressing the hi-hat pedal.",
                "Drum" => "Usually taken to refer to membranophones, although certain
 instruments that lack a ‘skin’ are often called drums, e.g. log drum, tongue drum.",
                "Drum Break" => "A break in the music to give the drummer a bit of a
 feature. Neither a fill nor a solo, the drummer would simply play time, albeit in a more
 attention-getting manner. Also see Break Beat.",
                "Drum Corps/Drum & Bugle Corps" => "A marching band consisting of drum
 section, brass section and colour guard (flag bearers). These bands are a regular feature in
 parades and stadiums and often hone their skills by entering competitions.",
                "Drum Fill" => "See Fill.",
                "Drum Head/Skin" => "A circular membrane made from plastic (Mylar,
 PET), leather (calf skin, goat skin) or nylon (Kevlar) attached to a solid hoop to form the
 striking surface of a drum. The styles and properties of drum heads available today are far
 too numerous to describe here. Suffice it to say that each style is designed to produce a
 unique sound, and for every drummer and every style of playing there is a suitable type of
 head. Also see Black Dot, FiberSkyn, Hydraulic, Membranophone, Two-Ply.",
                "Drum Mat" => "Whether a commercial or custom-made mat or a cast off
 rug, a soft surface for drums to sit on has a number of advantages. It provides a consistent
 surface, it keeps the drums from moving around, and the texture can improve drum tone.",
                "Drum ‘n’ Bass" => "An electronic music style born of the rave scene in
 the 1990s. Consists of a repetitive, driving rhythm and break beats, accompanied by syncopated
 bass lines.",
                "Drum Rack" => "An infinitely expandable frame — positioned in front of
 or slightly over the bass drum(s) — that provides a means for attaching all manner of drums,
 cymbals and other objects to the set. As the size of drum sets expanded during the 1970s, the
 setup became cluttered with stands and attachments. The rack evolved as the most practical
 method for managing all of the extra hardware. (The drum rack is not a new invention as a look
 at photos from the 1920s and 1930s will show. See Console.)",
                "Drum Screen/Booth" => "A screen or small room where the drummer sets
 up and plays to restrict sound from interfering with other instruments. Booths are very common
 in studios. Portable screens are useful for live situations.",
                "Drum Set Rudiments" => "A somewhat confusing reference that suggests
 (a) the standard rudiments applied to the drum set, or (b) a set of rudiments standardized for
 the drum set. In reality, few drum set players use more than a few of the rudiments, nor is
 there a standard set of anything for the drum set. Many teachers and authors use the term to
 describe what might more correctly be called ‘drum set essentials’.",
                "Drum Set/Kit" => "Hailed as an American invention, the drum set began
 as a make-shift assemblage of instruments. Traditionally drums and cymbals were played by
 several people. The invention of the bass pedal, lo-boy and snare stand enabled one drummer to
 play two, three or more instruments at once. Early drum sets were augmented with suspended
 cymbals, Chinese toms and ‘traps’. The rest of the story is the gradual refinement and
 addition of various tools. The term ‘drum kit’ is more commonly used in Europe. Also see
 Console, Consolette, Drum Rack.",
                "Drum Stick Sizing" => "In a field overrun with signature models,
 today’s drummer may be hard pressed to understand drum stick sizes. Originally, different
 models were given a number to signify the stick’s thickness and a letter to represent its
 application: A = orchestra, B = band, S = street. Sizing ran from large to small, so a 1A
 stick is much thicker than a 7A. There is little correlation between classes of stick; e.g. a
 5A and a 5B are different in length and thickness and have different profiles.",
                "Drum Sticks /Drumsticks" => "These timeless tools are a virtual
 encyclopaedia of creativity and ingenuity. Though simple devices, drum sticks are made from
 all manner of materials, and in an incredible range of sizes and styles. Most sticks are made
 from wood, with hickory, maple and oak the most popular. Sticks can also be made from
 aluminum, plastic, carbon fibre, and other synthetics. Styles range from dowel-like timbale
 sticks to industrial strength parade sticks. See Drum Stick Sizing, Nylon Tip, Rock Knockers.
",
                "Drumistic" => "A term coined to describe a style of playing that
 focuses entirely on the drums with little or no reference to music. In some contexts this is
 appropriate, as in the drum ensemble features of marching bands and drum corps. However, a
 drumistic approach is rarely welcome at other times.",
                "Drumming Circle" => "A group of people — not necessarily musicians —
 who participate in a somewhat ritualized session of creating rhythms using mainly hand drums.
 A popular pastime for a variety of reasons: It’s fun, it’s highly entertaining, it builds
 social cohesion, and it can be therapeutic.",
                "Dry" => "A colloquial term that refers to a tone that is rich, with
 low resonance or ring, and quick decay.",
                "Dual Tone /Dual Zone" => "A cymbal that has two (or more) apparent
 playing areas, one lathed and one unlathed. See Hybrid Cymbal, Lathing.",
                "Duple Time" => "A time signature that has two beats to the bar.",
            ],
            "E" => [
                "Earth Cymbal" => "A cymbal that is unlathed and therefore covered in a
 layer of oxide. So-called possibly because the surface looks like a plot of ground.",
                "Effects Cymbal" => "Any cymbal that departs from the standard crash or
 ride cymbals. Includes china cymbals, cymbals with jingles, cymbal stacks, trash cymbals,
 sizzle cymbals, etc.",
                "Eight to The Bar" => "In the 1940s, eight-to-the-bar was a common
 reference to up-tempo music, especially boogie woogie, (which is actually a four-to-the-bar
 shuffle). The expression means, simply, ‘play something fast’.",
                "Electronic Drums/E-Drums" => "A drum or drum set that consists of
 percussion triggers connected to a control unit. The control unit receives input from the
 triggers and assigns them sounds based on its programming. Modern e-drums rival acoustic drums
 in quality of sound and stick response, and have the advantage of being almost infinitely
 adjustable by turning a dial or pushing a button. Most have a selection of sampled drum sounds
 enabling the player to completely switch the sound of the instrument instantly. The units can
 produce any sound that has been programmed into the controller giving the player nearly
 unlimited potential. And if that weren’t enough, the sets are usually very light and compact
 and work with a sound system and headphones.",
                "EMAD" => "A system developed by Evans that adds a channel to the
 outside of a bass drum head. Different sized damping rings can be fitted into the channel to
 provide quick, easy and effective control of damping level.",
                "Endorser/Endorsee" => "A drummer who plays a certain brand by
 arrangement with the manufacturer (the endorsee) is said to endorse that product. The
 endorser/endorsee relationship provides credibility and a number of other advantages for both
 parties.",
                "Ensemble Notes" => "Passages that the band members play in unison:
 e.g. the breaks in traditional jazz where all or most of the band plays the same sequence of
 notes and beats.",
                "Envelope" => "Sounds have a beginning, a middle and an end. The
 initial spike is called the attack, which is immediately followed by sustain. When the sound
 energy begins to dissipate, it is called the decay. Drums typically have a short envelope
 consisting mainly of attack; cymbals have a somewhat longer envelope.",
                "EQ Ring/O-ring" => "A plastic ring made of drumhead material (e.g.
 Mylar). Usually about 1″ wide and cut to the diameter of the drum, it sits just inside the
 drum’s tension hoop providing an agreeable amount of damping. EQ rings are sometimes
 incorporated into the inside of a drum head (see Donut). Also see EMAD.",
                "Essential Rudiments" => "While there are various sets of ‘essential’
 rudiments, there is a core group of seven from which all others are derived: double stroke
 roll, single stroke roll, five-stroke roll, flam, drag ruff, multiple bounce (buzz) roll, and
 single paradiddle. See Rudiment Families.",
                "Evans" => "A drum head company started in 1957 by drummer Chick Evens
 in Santa Fe, New Mexico. Evans beat the Remo company to the Mylar head market by a full year,
 and has spent much of the last 50+ years marching in lock-step with the other company. Evans
 is now a major provider of OEM heads and has recruited an impressive roster of endorsers. Also
 see Hydraulic, EMAD.",
                "Extended Kit/Set" => "A drum set-up that goes beyond the standard 4-5
 drum, 3-4 cymbal kit. Since the advent of drum racks, some drummers have been progressively
 adding to their ‘instrument’. (Were it a competition, Terry Bozzio would NOT walk away with
 it, despite sometimes using a set with more than 100 drums and cymbals!)",
            ],
            "F" => [

                "Fast" => "A reference to the attack and decay of a crash cymbal.
 Thinner cymbals usually speak more quickly than thicker cymbals. Some companies designate such
 cymbals as ‘fast crash’.",
                "Fat" => "A sound that is full, with good attack and resonance, usually
 with ample low and mid frequencies.",
                "Fat Back" => "A style of eighth-note rhythm in 4/4 where the snare
 drum plays a dominant back beat and syncopated figures in between. For example, the drummer
 might play a strong ‘2’ but accent ‘4-&’ to finish the bar. “Sex Machine” by James Brown is a
 good example of fat back.",
                "Feathering" => "Playing the bass drum very lightly on every beat.
 Common in some forms of jazz. Also see Ghosting.",
                "Fiberskyn/Skyntone" => "A hybrid drum head from Remo that bonds a
 Tyvek film to a Mylar drum head. The result is a head that looks and feels like calf skin. The
 tone is warmer than plastic and the surface is excellent for brush work.",
                "Fibreglass" => "A type of drum shell made from polymer resin and
 fibreglass or similar cloth. The shells are made in a mould from the outside in, often
 starting with the finish. Fibreglass drums have been around since the late ’60s, and have an
 on-and-off popularity. The shells offer a number of advantages over wood, and generally
 provide excellent sound. Some medium-range drums are made of wood and lined with fibreglass.
",
                "Field drum" => "See Parade Drum.",
                "Fill/Drum Fill" => "A short passage — usually a bar or less — when the
 drummer departs from playing straight time and plays a complementary figure on the drum set.
 To goal is to contribute interest and impetus to the music or punctuate a transition.
 Different music styles have different latitude for fills. For example, some rock styles
 feature a fill every other bar, while country music calls for a more Spartan approach.",
                "Finger Control" => "Controlling the drum stick using mostly the
 fingers. Not practical at high volumes, but at low to medium volumes it allows exceptional
 execution, speed and articulation… See Fulcrum, Traditional Grip.",
                "Firecracker" => "A snare drum that has a small diameter and is fairly
 deep (e.g. 12″ x 6″) that produces a high-pitched ‘crack’. Usually mounted off to the side as
 an alternative to the main snare drum.",
                "Flam" => "A note played by striking the drum with two sticks, one
 slightly before the other (e.g. rL, lR). The first note (see Grace Note) is not as loud as the
 second. Can be very dramatic.",
                "Flange" => "A bend in a piece of metal. Can refer to the bends in a
 counter hoop, the flat section of a pang cymbal or the up-or down-turned edge of a china type
 cymbal. Also see Blade.",
                "Flanged Hoops" => "A style of metal counter hoop that has a number of
 bends. The first such hoops had a single bend (flange) that sat against the flesh hoop and
 held the drum head in place. The next generation had a second flange that wrapped around the
 flesh hoop. Triple flanged hoops provide a more generous striking area for rim shots. Also see
 Cast Hoop, S-hoop, Spun Metal.",
                "Flat Ride" => "A type of cymbal that has no bell. While the cymbal may
 appear flat, it will have a low bow with a flat portion where the bell ought to be. The lack
 of a bell reduces overtones — sometimes to almost nothing — and minimizes build, wash and
 sustain. The result is a dry sound with pronounced stick articulation, and perhaps some
 splashing or crashing potential.",
                "Flea Bite" => "A small nick in the edge of a cymbal caused by dropping
 it or bumping it into something hard. Although it may seem like a minor problem, a small ding
 can provide an opening for a crack to develop. Also see Sound Bite.",
                "Flesh Hoop" => "Usually made of wood, these rings hold and give shape
 to calfskin drumheads. The heads are soaked in water to soften the leather, which is then
 tucked into the ring to secure it. (Modern polyester drum heads are attached to an aluminum
 ring that is still sometimes called a flesh hoop.)",
                "Flight Case" => "Heavy-duty shipping case built to withstand the
 rigours of air travel and extensive touring.",
                "Floating Shell" => "A drum built in such a manner that it has no
 tension lugs attached to the shell. Most common design is a shell that sits in a metal frame.
 The frame holds one of the heads and the tension rods for both heads, enabling the heads to be
 tensioned individually, with one head pressing against the shell and the other head pressing
 against the frame.",
                "Floating Snares" => "Some companies have experimented with snare
 tensioning systems that keep the snares at constant tension even while disengaged (e.g. Rogers
 Dynasonic).These allow the snare tension and the snare pressure against the snare head to be
 adjusted independently. Also see Parallel Snares.",
                "Floor Tom" => "A large diameter drum — 14″ to 18″ — that rests on the
 floor and is held up by steel legs attached to the shell. Floor toms are usually louder than
 mounted toms, and their large diameter can make them somewhat difficult to play. Shell depth
 is quite often the same as the diameter. See Low Tom, Side Tom.",
                "Fly Swatter" => "See Brushes.",
                "Foam Ring" => "A damping device made of light foam that is attached to
 the underside of a drum’s batter head. Results in a deep round tone with few overtones.",
                "Focused" => "A sound that is well defined with few or well-controlled
 overtones, firm attack and limited sustain.",
                "Foot Plate" => "The business end of a foot pedal. Foot plates come in
 two configurations: solid and hinged. The solid plate has a rocker unit mounted below the heel
 of a single solid foot board. The hinged variety has a small heel plate attached to the foot
 plate by a hinge. Each type has a specific feel and responsiveness, and neither is superior to
 the other, so it’s a good idea to try both.",
                "Foot-Sock" => "See Lo-Boy.",
                "Found Objects" => "Most objects can be coaxed into making a sound.
 Many drummers capitalize on this by adding interesting sounding objects to their set-ups.
 Brake drums, hubcaps and kitchen bowls are particularly popular.",
                "Four-On-The-Floor" => "Playing steady four beats to the bar on the
 bass drum, a common practice in disco, jazz, boogie-woogie and a few other genres. Very
 effective for driving things along. Also a good stand-by when volume or tempo are challenging.
 Also see Feathering, Disco Beat, Eight-To-The-Bar.",
                "Four-To-The-Bar" => "See Four-On-The-Floor.",
                "Frame Drum" => "A small, single-headed drum found in many older
 cultures. Consists of a shallow shell with a diameter ranging from 12″ to 15″ or more. The
 head is usually tacked on and there is often a single rod or X-shaped reinforcement in the
 centre of the drum. Played with a short two-ended stick. Most early cultures had some form of
 frame drum.",
                "Free Strike/Gladstone Technique" => "A stroke that begins with a
 whipping motion. The stick is allowed to rebound to its original position while the hand stays
 in a down position. The hand then grabs and lifts the stick and is ready for the next stroke.
 The stoke delivers excellent power.",
                "French Roll" => "A roll executed by playing exactly three strokes per
 strike with each hand.",
                "Front Line" => "In a rudimental drum ensemble, the snare drummers will
 sometimes form a straight, stationary line. Makes for an interesting display, with the drum
 line playing out front and the remaining percussionists playing and marching in formation in
 the background.",
                "Fulcrum" => "Assumed to be the point at which a drum stick connects
 with the fingers to create a pivoting point. In practice, a drummer works with a number of
 fulcrums: shoulder, elbow, wrist, and various parts of the hand. In the ‘grip zone’, the
 fulcrum is typically between the thumb and first finger in matched grip, and the crotch of the
 thumb and first finger for traditional grip. In matched grip the fulcrum often switches from
 one finger to another depending on volume, speed, and technical background. Also see Finger
 Control.",
                "Fundamental" => "The basic pitch or note of an instrument, and usually
 its dominant sound. See Overtones, Perceived Pitch, Timbre.",
                "Fusion kit" => "An industry term for a 5-piece configuration: bass,
 snare, two mounted toms and one floor tom.",
            ],
            "G" => [

                "Ghost Note/Ghosting" => "A note, usually played on the snare or bass
 drum, that is light to the point that it can barely be heard. Also see Feathering.",
                "Gig" => "A term commonly used by musicians to refer to a playing job.
",
                "Gladstone System" => "Billy Gladstone is responsible for many of the
 innovations we see on snare drums today. His unique tuning system introduced tension casings
 and tension rods that let the drummer tune either drum head by using different sockets of a
 special drum key on the top tuning rod. One socket tuned the top head and another adjusted the
 bottom. A third socket adjusts both heads at once.",
                "Glassy" => "A cymbal sound in which complex, high-pitched overtones
 dominate, producing a shimmering sound similar to breaking glass.",
                "Glissando" => "A single note that rises or falls in pitch. See
 Roto-Tom, Twang.",
                "Glue Ring" => "Some drum shells have a reinforcing ring on the inside
 of the shell edge. Usually 1 to 1 ½ inches wide and applied to both the top and bottom of the
 shell. May be solid wood or layers of thin veneer, and appears to have a positive effect on
 tone.",
                "Goat Skin" => "Goat skin is considered inferior to calf skin and
 therefore of interest mainly to modest budgets, although it is a common head material on hand
 drums.",
                "Gock Shot" => "A type of rim shot where the stick hits firmly in the
 middle of the drum to produce a rich, powerful sound.",
                "Gong" => "Members of the cymbal family, gongs are disks of bell bronze
 ranging in size from a few inches to as much as 8-10 feet. Gongs are typically flat with a
 rolled edge, although there is much latitude for shape. Gongs are valued for their power, rich
 tone and unmatched sustain.",
                "Gong Cymbal" => "A traditional Korean gong (jing gong), about the size
 of small crash cymbal, that rests in a frame so it can be played horizontally. Also a
 redundant name for a gong.",
                "Gong Drum" => "A single-headed drum with a head that is significantly
 larger than the shell, e.g. a 24″ head on a 20″ drum. The result is a drum with a gong-like
 envelope. Usually mounted like a tom tom.",
                "Grace Note" => "A note that is played slightly before and softer than
 the next note. See Cheese, Flam.",
                "Gravity Blast" => "A gravity roll used as part of a blast beat.",
                "Gravity Roll" => "A roll executed by placing the stick flat against
 the head and rim and quickly rocking the stick to alternately strike the rim and the head to
 produce a very rapid and visually interesting roll.",
                "Groove" => "A rhythm that is more than a rhythm — one that compels one
 to move with it. See Pocket.",
                "Gut/Catgut Snares" => "In olden times, snare ‘wires’ were made from
 leather cords made from animal intestines. Modern ‘gut’ snares are mainly made from synthetics
 (e.g. Nylon) or silk wrapped with fine wire. Now, mostly replaced by metal wires.",
                "Guts" => "A term for snares sometimes used by field drummers.",
            ],
            "H" => [

                "Half Time/Cut Time" => "A shift from one rhythm to one that moves at
 half the speed but without changing the song structure. E.g. A tune in 4/4 might shift to 2/2
 to imply a slowing down, although a bar would take the same length of time to play as before.
 See Double Time.",
                "Hammering" => "A technique of forming and tempering metal by hammering
 it against a hard surface or anvil. At one time the only way to create a cymbal, hammering is
 still an integral part of the process. Although some cymbals are made without any hammering,
 better quality cymbals usually have been treated to some form of hammering. Hammering expands,
 thins and compresses the metal, and refines the cymbal’s shape and tone. The most highly
 regarded method is hand hammered, where an artisan uses hammer and anvil to coax the metal
 into its final form. Some cymbals go under an automated hammer, guided by a skilled set of
 hands. Computer-controlled hammering delivers much of hammering’s benefits faster, cheaper and
 more consistently. Also see Bell Bronze, Sheet Metal Cymbals, Roto-casting.",
                "Hand Cymbals" => "A pair of matched cymbals attached to handles or
 straps and played by slapping the cymbals together. Used mainly in orchestras and marching
 bands.",
                "Hand Drum" => "Any drum that is played with the hands rather than with
 sticks. (The heads on hand drums, often made from animal skin, can be too fragile to be hit
 with sticks.)",
                "Hand Hammered" => "Hand hammering is an expensive technique, but the
 result is a high quality, more individual and more personal instrument. The highest quality
 cymbals are often finished with hand hammering. Some companies make hand-hammered metal snare
 drums. Also see Cosmetic Hammering, Machine Hammering, Turkish Style Cymbals.",
                "Hand Hammered vs. Hand Hammering" => "Before the invention of machines to do the work, all cymbals were created by hand hammering a
 slab of bronze until it took on the shape of a cymbal. The process took many hours and
 thousands of hammer strokes. The majority of modern cymbals are rough shaped by rolling and
 stamping. The cymbals are then hammered using a variety of techniques. Good quality cymbals
 can be made by automated hammering, where a computer-controlled hammering machine does all the
 work.",
                "Hang (Drum)" => "Pronounced ‘hung’, this instrument consists of two
 steel bowls attached at the rim giving it the appearance of a UFO. The top of the drum has a
 number of tuned playing areas similar to a steel drum; the lower bowl has a large sound hole.
 The sound is reminiscent of a steel drum but mellower and with an almost haunting resonance.
",
                "Hanging Tom" => "Another name for a mounted tom or rack tom.",
                "Hardware" => "All of the stands, clamps, rods, and wing nuts that hold
 a drum set together. Over the years hardware has evolved in terms of strength, weight and
 versatility. Modern hardware tends to be heavy duty to withstand the pounding of the most
 physical drummers while providing the maximum in adjustability. Most drum companies offer
 several lines of hardware, from medium-duty on up. Also see Bass drum Pedal, Console, Drum
 Rack, Hi-Hat.",
                "Harmonics" => "The sounds musical instruments produce consist of the
 fundamental — i.e. the note or pitch — plus a number of related pitches called harmonics. The
 harmonics and their complexity make up the recognizable character of an instrument. Taken
 together, these sounds form the instrument’s timbre. Because percussion instruments tend to
 have a large vibrating area, their harmonics are more complex and irregular than those of
 melodic instruments. See Odd Order Harmonics.",
                "Head" => "A term used mainly in jazz to denote playing the tune with
 little or no embellishment. Playing the head once or twice establishes the tune before turning
 things over to soloists. It’s traditional to repeat the head to finish the tune. See Rhythm
 Changes.",
                "Heel-toe" => "An older hi-hat technique that involves rocking the foot
 on the pedal. The heel stomps down on ‘1’, lifting the toe and opening the cymbals. Then the
 toe is pressed down in ‘2’ to close the cymbals producing the chick sound. Heel-toe has been
 mostly supplanted by toe-only play.",
                "Heavy Metal" => "A term coined around 1970 to describe an emerging
 style of hard-driving rock. (The term was first used to describe Humble Pie.) Metal has since
 evolved into a number of sub-genres including death metal, thrash and many others.",
                "Hemiola" => "A specific type of polyrhythm where two dotted quarter
 notes are played in 3/4 time. The technique originated in the Middle Ages when composers
 sought some creative relief from the church-mandated 3-beats per bar, in honour of the holy
 trinity. In recent times, musicians have adapted the technique by playing a cross-rhythm of
 3/4 time within 4/4 time and then adding the hemiola as well. Also see Metric Modulation.",
                "Hemp" => "A type of cloth that can be used to create resin shells. See
 Fibreglass.",
                "High Tin Bronze" => "See B20, Bell Bronze.",
                "Hi-Hat" => "A foot-operated stand that holds two cymbals, with the top
 cymbal movable via a vertical rod. The player can produce a chick or chup sound by stomping on
 the pedal and can also ride on the cymbals. Opening and closing the cymbals produces a wide
 variety of sounds. Also see Clutch, Drop Clutch, Pea Soup, Remote Hi-Hat.",
                "Hip-Hop" => "A music style that evolved from rap, break beats and drum
 samples. Similar to rap, it is less stylized and with more latitude for subject matter. The
 music is almost always tied to hip-hop dance.",
                "Hybrid Cymbal" => "A cymbal that has both lathed and unlathed areas.
 Each area would have a subtly different sound and stick feel. See Dual-tone, Lathing.",
                "Hybrid Rudiments" => "A rudiment created by combining elements of, or
 adding new elements to, existing rudiments. The list of such sticking patterns is
 ever-growing, with one source documenting more than 500 of them. Their existence demonstrates
 the desire of drummers to go beyond the traditional.",
                "Hydraulic" => "The Evans drum head company revolutionized the sound of
 the drum set in the mid-1970s with their hydraulic drum head, so called because the head is
 two-plies of Mylar with a thin layer of oil in between. The oil helps to mellow the sound
 while preventing premature failure due to friction between the layers. Also see Pinstripe.",
            ],
            "I" => [

                "Idiophone" => "An instrument that is a single component rather than an
 assembly of parts, e.g. cymbals, claves, vibraphone, etc. vs. a drum, which requires both a
 shell and a membrane.",
                "Indefinite Pitch" => "Unlike melodic instruments, most percussion
 instruments do not produce a recognisable note but an indistinct tone that sounds generally
 high or low. See Mallet/Keyboard Instruments, Perceived Pitch.",
                "Independence" => "The accepted term for getting two or more limbs
 moving at once. It is virtually impossible to move arms and legs independently, but with
 sufficient practice one, two or even three limbs can be conditioned to repeat a basic pattern
 while other limbs play in a freer manner. A better term would be ‘co-ordinated dependence’.
",
                "Indie Music" => "A reference to recorded and commercially available
 music from a small, usually independent producer rather than one of the established big
 labels. May be produced and marketed by the artist(s).",
                "Inharmonic Partials" => "In melodic instruments, the partials or
 harmonics of a note follow an orderly pattern based on regular multiples of the note’s
 frequency. Because percussion instruments produce complex fundamentals, their partials do not
 follow a neat logical pattern. Although the results are called ‘inharmonic’, the result can be
 very musical and pleasing. Also see Odd Order Harmonics.",
                "Introduction" => "A passage in a song, usually 8 or 16 bars, that
 precedes the head. Many well-known tunes have an introduction that is virtually unknown
 despite the remainder of the tune being a standard, e.g. “Lush Life”.",
                "Inverted Chinese Cymbal" => "A Chinese style cymbal that has an
 inverted profile, with a normal bell and a down-turned edge. Allows the cymbal to be mounted
 normally on a stand, reducing stress on the bell.",
                "Irrational/Irregular Rhythm" => "Note divisions that deviate from the
 natural multiples for that rhythm. E.g. Playing triplets when the music has an eighth-note
 feel, or eighth-notes over a triplet feel. Also see Polyrhythm, Tuplets.",
            ],
            "J" => [

                "Jazz Ride" => "In the 1930s, jazz drummer Kenny ‘Klook’ Clarke
 experimented with playing the standard jazz rhythm on a ride cymbal rather than on the snare
 and/or hi-hat as was the style of the time. This approach soon became the standard. In strict
 written notation, the rhythm is: [quarter note – dotted eighth & sixteenth] [quarter note –
 dotted eighth & sixteenth] etc. In practice, the rhythm is almost always played with a triplet
 feel and almost never a dotted-eighth and sixteenth feel.",
            ],
            "K" => [

                "Kettle Drum" => "Large drums with bowl-shaped bodies originated in the
 middle east and have been around for more than 3000 years. Usually made of metal, they were
 often mounted on horses or camels, and played the army into battle. Also see Tympani.",
                "Kevlar®/Aramid" => "Best known as the material used to make
 bullet-proof vests, Kevlar is a type of nylon invented by DuPont in the early 1960s. The
 fibres, called aramid, can be woven into an extremely tough, heat- and moisture-resistant
 cloth that has five times the strength of steel. The material is ideal for rudimental drum
 heads, which call for very high tensioning, ruggedness and a dry sound, and it is also used
 for drum shells (see Fibreglass.)",
                "Keyboard Percussion" => "See Mallet Instruments.",
                "Kick Drum" => "Misnomer for bass drum.",
                "Klunker" => "A cymbal that is too heavy for the intended use.",
                "Konnakol" => "In Carnatic music, the practice of singing or reciting
 the rhythm using standardized syllables, e.g. Ta-ki-ta, Ta-ka-dim-mi. Tabla bols are a subset
 of Konnakol.",
            ],
            "L" => [

                "Lathing" => "The final process in cymbal making is removing the outer
 layers by mounting the cymbal on a special lathe and making one or more passes with a chisel.
 Up to 2/3 of the cymbal’s metal is removed along with the oxydized exterior coating. This
 leaves the cymbal covered with tone grooves. Some specialized cymbals undergo partial lathing
 (see Dual Tone) and some are not lathed at all. Lathing is an important step in a cymbal’s
 sound development. See Hybrid Cymbal, Taper, Unlathed.",
                "Latin-Jazz" => "A style of Latin-influenced jazz that emerged in the
 early 1940s and then popularized by Dizzy Gillespie’s Latin jazz band throughout the decade.
 Now a standard part of the jazz tradition.",
                "Layered Drumming" => "The ‘conventional’ approach to playing (vs.
 linear drumming), where patterns are played in layers, e. g. a ride pattern on top, bass pulse
 below and snare patterns in the middle. The vast majority of contemporary drumming is of the
 layered variety.",
                "Linear Drumming" => "Defined as a drumming style where hands and feet
 never (or at least rarely) strike at the same time. (Steve Gadd and Mike Clarke are known for
 their linear playing.) Also see Layered Drumming.",
                "Lion Cymbal" => "Another name for china-type cymbals.",
                "Lion Gong" => "See Wind Gong.",
                "Lithophone" => "Melodic percussion instrument with tone bars made from
 stone. See Mallet Instruments.",
                "Lo-Boy" => "The progenitor of the hi-hat, the first pedal-operated
 devices held a pair of cymbals just a few inches from the floor. Eventually the stands were
 made taller to allow playing the cymbals with sticks.",
                "Long drum" => "Antiquated name for a bass drum. See Side Drum.",
                "Long Roll" => "See Double-stroke Roll, Open/Closed.",
                "Loop" => "A continuously repeated pattern. In certain music styles,
 drum patterns are sampled and then programmed into a unit that plays the pattern in a
 continuous ‘loop’. Also the hip-hop term for vamp or riff.",
                "Low Tin Bronze" => "See B8.",
                "Low Tom" => "A floor tom, or a rack tom positioned like a floor tom.
",
                "Lug Clearing" => "Tuning a drum so that the tone at each tension lug
 is identical. See Tap-tuning, Voicing.",
                "Machine Hammered" => "A cymbal that has been worked with a
 machine-powered hammer. Provides a hammered character more economically and with better
 consistency than hand hammering. The process may be fully automated, but is often under the
 control of an artisan who decides how the cymbal is to be worked. For this reason ‘made by
 hand’ can apply to a great number of cymbals.",
            ],
            "M" => [

                "Mallet Instruments/Melodic Percussion" => "Percussion instruments
 capable of playing melodies. Includes xylophone, marimba, vibraphone, and tubular bells. (Note
 that a celeste is neither a mallet instrument nor keyboard percussion.)",
                "Mallets" => "A type of drum stick that has a round or oval beater ball
 usually made of felt. Mainly used to produce a softer, rounder sound. Especially effective on
 tom toms. Also see Beater.",
                "Mama Dada" => "A user-friendly term for the long or double-stroke
 roll.",
                "Marching Drum" => "See Parade Drum.",
                "Matched Grip" => "The technique of holding both drum sticks ‘like a
 hammer’. The lead hand is held the same as in traditional grip, and the other hand simply does
 the same. The technique appears to be just as adaptable as traditional grip, delivers more
 power, and is much easier for the new student to learn. There are three recognized styles of
 matched grip — French, German and American — determined by degree of rotation of the forearms.
 For mallet players, the differences may be important, but for the average drum set player, all
 three positions emerge quite naturally.",
                "Measure" => "Same as a bar.",
                "Melodic Toms" => "A set of toms, usually single-headed, tuned to a
 scale or subset of a scale. See Concert Toms, Octobans.",
                "Membranophone" => "An instrument that consists of a membrane (i.e. a
 drum head) stretched across a resonating chamber and played by striking the membrane by hand
 or with sticks. The basic designs are single-headed, double-headed, and bowl-shaped.
 Single-headed drums are cylinders with a head on one end and open at the other. Double-headed
 drums are cylinders with a head at both ends. The diameter of the cylinders is usually
 constant, but there are exceptions (e.g. congas, derbaki, doumbek, pakwaj, mrdangam, etc.).
 Bowl-shaped or kettle drums have a single head and a roundish body, and include such drums as
 tympani, tabla/bayan, etc. Not all drums are membranophones.",
                "Mercatto Stroke" => "A stroke that is controlled so that the tip of
 the stick remains close to the playing surface after striking. This is also the basis of the
 Moeller stroke. Also see Dead Sticking.",
                "Metal Shell" => "A variety of metals are used to produce drum shells
 including steel, brass, bronze, copper, titanium, aluminum, and stainless steel. Metal drums
 tend to project better than wood drums, are louder, and usually have an abundance of resonance
 and high overtones. For these reasons, metal shells are typically reserved for snare drums,
 although there are exceptions.",
                "Metric Modulation" => "A method of switching tempo by substituting
 note values (see Polyrhythm) and then switching to the implied time signature. E.g. In 4/4
 time, playing quarter note triplets and then switching to straight 6/4 time.",
                "Metronome" => "A device, either mechanical or electronic, that marks
 out a tempo in beats per minute. Most provide a range of 40 bpm to 208 bpm. Some electronic
 versions offer a broader range of tempos and may count out various time signatures.",
                "Middle Eight" => "In 32-bar tunes and many ‘pop’ structure tunes,
 there is usually an 8-bar passage that is melodically and harmonically different from the main
 tune. Sometimes called the bridge.",
                "Military Drum" => "see Drum Corps, Parade Drum.",
                "Mini-Cup" => "A cymbal — usually a ride cymbal — that has a very small
 bell, about 1/4 the size of a normal bell. Mid-way between a regular cymbal and a flat ride,
 it provides a very precise stick sound with little wash or build.",
                "Moeller Method" => "In 1925, Stanford A. “Gus” Moeller, an American
 rudimental drummer and teacher, documented and advocated a technique that he saw commonly used
 by military drummers. The stroke, now named after Moeller, consists of striking the drum with
 a whipping motion. Then, rather than letting the stick rebound, both hand and stick are kept
 in the down position. The final step is to tap the head a second time just as the stick is
 being returned to the start position. This ‘snap-tap’ technique can be found in a number of
 playing styles.",
                "Montuno" => "Similar to a vamp, a montuno is a Latin-derived device
 where the band plays a simple, recurring, highly rhythmic pattern, often on just two chords.
 This can provide an exciting backdrop for a soloist and especially a drummer. (Carlos Santana
 is a big fan of montunos.)",
                "Mounted Tom" => "A smaller tom that is mounted on a holder and
 positioned above the base drum. At one time, tom holders were routinely attached to the bass
 drum shell, and might be required to support up to 3 drums. These days many drummers opt for a
 rack or simply clamp the drum to a cymbal stand, sometimes forgoing altogether.",
                "Mounting Hoop" => "The outer hoop of a drum head. Sometimes called a
 flesh hoop or crimp hoop.",
                "Muffled" => "An instrument that has been damped to the point that its
 sound has been substantially quashed, i.e. lacking the high frequencies needed for projection
 and articulation. Some drummers will put a piece of cloth over the entire head or put another
 drumhead loosely on top to produce a muffled sound. These techniques also produce a fatter
 sound. See Damping, Fat.",
                "Muffling Rings" => "Same as EQ-rings or foam rings.",
                "Music Therapy" => "“Music hath charms” to the point that listening to
 and playing music can be therapeutic to mind, body and spirit. See Drumming Circle.",
                "Mute" => "An extreme form of damping device that eliminates much of
 the noise of drums. The drums are still audible, which makes muted drums ideal for discreet
 practice.",
                "Mylar" => "A strong plastic film invented by Dupont during World War
 II and taken into service as drum head material in the late 1950s independently by two
 drummer-entrepreneurs, Remo Belli and Chick Evans. Mylar is superior to calf skin in many
 ways, not least of which is cost. Mylar heads are available in an astounding array of
 configurations, and sometimes mimic the appearance and texture of calf skin heads. See
 Polyester, Tyvek.",
            ],
            "N" => [

                "NARD" => "Formed in the early 1930s, the National Association of
 Rudimental Drummers established the first set of “13 Essential Rudiments” in the US. The list
 was expanded to “26 Standard American Rudiments” by 1936. These included the essentials —
 single-stroke roll, double-stoke roll, flams, paradiddles, short rolls — as well as some more
 complex patterns such as the flamacue and triple ratamacue. The organization was supplanted by
 the Percussive Arts Society in 1978. In 2008, surviving members of the N.A.R.D. reactivated
 the organization with the mandate to continue to champion the standard rudiments.",
                "Nickel Silver" => "See Stainless Steel.",
                "Nylon" => "A type of tough yet flexible plastic that is used for a
 variety of purposes including drum stick tips, drum heads (see Kevlar), snare wires, and
 brushes as well as bushings and bearings.",
                "Nylon Tip" => "In the mid-1950s, drummer Joe Calato (founder of Regal
 Tip) perfected the technique of attaching a nylon bead to a wooden drum stick. Catalo’s design
 resulted in tips that stayed on the stick. Nylon tips are very hard wearing and produce a
 sharper attack than wood tips. Nylon tipped sticks are now a standard product for all drum
 stick makers.",
            ],
            "O" => [

                "Ocean Drum" => "A North American two-headed frame drum that has gravel
 or beads inside. Rotating the drum creates an ocean-like sound as the beads move across the
 head. Also see Water Drum.",
                "Octave" => "A series of notes from tonic to tonic.",
                "Octoban/Tubetom/Deccabon" => "Originally introduced by Tama in the
 1970s, octobans are a set of eight 6″ toms of varying depths. Shorter drums are tuned higher
 than longer drums. The idea is to tune the drums to an 8-note scale (see Octave).",
                "Odd Meter" => "Any time signature that is not a multiple of 2 or 3.
 For example, 5/4, 7/8, 11/16, etc. would be odd metres whereas 9/8 would not as it’s divisible
 by 3.",
                "Odd Order Harmonics" => "Unlike a taut string or length of tubing, a
 drum’s resonating element is a broad disk. When struck, the disk produces an array of sounds
 that are unlike typical harmonics. It’s this complexity of harmonics that gives drums and
 cymbals their distinctive tone and enables them to blend with all manner of music. They can
 also make drums somewhat tricky to tune.",
                "OEM" => "Original equipment manufacturer. Usually refers to an add-on
 to another product. E.g. Gretsch contracted with Gibraltar to provide hardware for their drum
 sets. Such hardware would be classified as OEM and therefore considered a Gretsch product.",
                "Off Beat" => "Refers to notes placed between the main counts. In the
 case of eighth notes [1-&, 2-&, 3-&, 4-&], the ‘&’ would represent off beats. See Syncopation.
",
                "Oil-Filled" => "See Hydraulic.",
                "On Top of the Beat" => "Similar to behind the beat. In this case, the
 player interprets the time as slightly ahead of the beat, adding energy and a sense of urgency
 to the music. Not the same as rushing.",
                "Open" => "A reference to a sound that is clear and resonant, usually
 with a touch of natural ring.",
                "Open Hand(ed) Drumming" => "A style of playing that avoids crossing
 one hand over the other. For a right-handed drummer, this would mean playing the hi-hat mainly
 with the left hand to avoid crossing the right hand over the left. Necessitates the ability to
 play ride rhythms with the non-leading hand.",
                "Open/Closed" => "Many sticking patterns can be played in an open or
 loose manner, or closed with the strokes very close together. Rudiments such as the double
 stroke roll and the flam are commonly played both open and closed for different effects.
 Closed sticking is necessarily played faster than open. Buddy Rich was famous for including a
 single-stroke roll in his solos, starting out with a very slow open roll, gradually speeding
 up to a blistering closed roll, and then slowing down to the original open roll tempo.",
                "Open-Close/Drop-Snap Technique" => "A two-step stroke where the stick
 is allowed to bounce off of the head on rebound, with the hand relaxed and staying in the down
 position. On the next stroke, the hand snaps shut and pulls the stick back to the starting
 position. Also see Moeller.",
                "Ostinato" => "A rhythm or pattern that is steadily repeated without
 modification and serves as a background for other rhythms and other instruments. The jazz ride
 is a type of ostinato, as is the clave rhythm. Also see Montuno, Vamp.",
                "Overhang Pedal" => "An early bass drum pedal design where the beater
 was suspended from the top of the bass drum hoop and a pedal attached to the bottom of the
 hoop. Often included a metal cymbal beater that struck a small cymbal attached to the rear
 bass drum hoop.",
                "Overtones" => "Anything that vibrates has a fundamental tone — known
 as its pitch or note — and a series of overtones at various higher pitches. Overtones, their
 pitch and their intensity are the characteristics that determine an instrument’s timbre and
 distinctive sound. Can detract from as well as enhance the sound of an instrument. Also see
 Harmonics, Odd-order Harmonics, Undertone.",
                "Oxydation/Tarnish/Corrosion" => "Over time, cymbals will change colour
 due to interaction with oxygen and other elements in the environment. Commonly called a
 patina. Also see Cymbal Cleaner.",
                "Ozone" => "A crash cymbal, introduced by Sabian, that has a number of
 large holes drilled in the bow. The holes lighten the cymbal, giving it a quicker response and
 a trashy aspect without sacrificing power. Also visually quite impressive. Many cymbal
 companies now offer cymbals with all manner of holes in them.",
            ],
            "P" => [

                "Pang Cymbal" => "A cymbal that has a flat portion at the outer edge of
 the bow. Makes a distinctive ‘pang’ sound. Also see Chinese Cymbal, Flange, Trash.",
                "Paper Thin" => "An extremely thin crash cymbal. Tend to be higher
 pitched than a regular crash cymbal, with a very fast response. Such cymbals are delicate and
 cannot tolerate abuse. See Fast.",
                "Parade/Rudimental Sticks" => "Visually similar to regular drum sticks,
 rudimental sticks tend to be much thicker, with a heavier bead and are often made from lighter
 woods. Also see Stick Sizing.",
                "Parade/Marching Drum" => "General term for deep-shelled snare and
 tenor drums used by drum corps and pipe drummers. These days parade drums are very specialized
 instruments. To achieve the preferred sound, the drums are fitted with high-strength often
 Kevlar heads, and the shells and hardware are built to accommodate very high tension. Drums
 are typically 14″ to 16″ in diameter and 12″ or so deep. The snare drum may have a snare
 mechanism mounted under the top head.",
                "Paradiddle" => "One of the core rudiments, this simple sticking
 pattern — RLRR LRLL– is very versatile and has a wide impact. There are double, triple and per
 mutated paradiddles and a host of hybrids. It also serves as a useful model for rudiments and
 stickings in general. Its name is a reflection of the sound it makes, its flexibility makes it
 a useful and important technique, and it’s been the basis of many off-shoots and variations.
",
                "Parallel Strainer" => "A type of snare throw-off that has an
 activation mechanism extending through the drum that holds both ends of the snares (e.g.
 Ludwig SuperSensitive). When engaged or disengaged, the entire assembly moves parallel to the
 snare head. The theory is that snare response will be greatly improved and butt plates will
 not interfere with response. Also see Floating Snares.",
                "Partials" => "The sound of an instrument consists of its fundamental
 tone plus its partial tones. Partials are overtones and undertones that are generated by the
 instrument, and all three contribute to timbre. Partials can be harmonic or inharmonic.",
                "PAS/Percussive Arts Society" => "An international organization whose
 mandate is to promote education, research, performance, and appreciation of all types of
 percussion, and oversees the standard rudiments. Also see NARD.",
                "Patina" => "A colour change that occurs in cymbals over time — from
 bright gold to dull amber to olive green or green/brown. It is actually a form of tarnish and
 is a result of oxydation and other chemical changes to the metal. Patina is a prized quality
 in older cymbals, but it can be removed by aggressive cleaning. Also see Brilliant Finish,
 Cymbal Cleaner.",
                "Pea-Soup" => "Playing the off beats (‘and’) on the hi-hat while
 opening it and closing it on the beat. Results in the ubiquitous “pea soup – pea soup – pea
 soup” rhythm of the classic disco beat.",
                "Perceived Pitch" => "Percussion instruments produce complex sounds. A
 two headed drum, for example, produces sound through the interaction of the shell and the
 head(s). The drum heads themselves have a large vibrating area that typically cannot produce a
 simple note. As a result, a drum’s pitch is a product of how the ear and brain interpret the
 many subtle sonic components. For example, although tympani appear to produce a distinct note,
 what you hear is actually a by-product of the over- and undertones.",
                "Permutation" => "A variation on a sticking pattern. For example, a
 paradiddle is played RLRR LRLL. A permutated paradiddle is played RLLR LRRL.",
                "PET" => "Polyethylene terephthalate, a strong, light, recyclable
 polyester film similar to Mylar and used to make drum heads as well as plastic drink bottles.
",
                "Phrase" => "The basic unit of a musical statement. Singers and horn
 players have enough breath for about two bars, and this has generally been rounded up to four
 bars, providing a nice balance between musical statements. Phrases have been somewhat
 standardized at 4 bars.",
                "Piatti Musicali" => "Italian for ‘musical plates’, i.e. cymbals.",
                "Piccolo Snare" => "A snare drum that is a standard diameter but is
 fairly shallow, e.g. 4″ x 14″; 3″ x 13″. Also see Firecracker.",
                "Pick-up (Beat)" => "A beat or part of a beat that is added to the
 beginning of a tune, just before the first bar, to provide a lead-in.",
                "Piggy-Backing" => "Placing two cymbals on a single stand. A larger
 cymbal is mounted normally on the stand and a smaller cymbal is placed on top, sometimes
 inverted. The cymbals can be struck separately, and when struck together produce a trashy
 sound. Also see Stack Cymbals.",
                "Ping" => "The sound of a heavier cymbal that has a high-pitched
 fundamental, little low frequency energy, and good attack and definition. Tends to project
 very well. Also see Articulation, Ping Shot.",
                "Ping Shot" => "A type of rim shot that is played with the bead close
 to the rim to produce a crisp, bright sound. (Bill Bruford is known for playing ping shots
 much of the time.)",
                "Pinstripe" => "Partly in response to the popularity of the hydraulic
 head, the Remo company created a similar two-ply head. Instead of using oil to dampen the
 sound, Remo uses a ring of glue around the circumference of the head. The edge of the glue is
 then masked by a thin black stripe.",
                "Pipe Drum" => "A type of parade or marching drum that is preferred for
 use with a Scottish bagpipe band.",
                "Pitch" => "The relative ‘high-ness’ or ‘low-ness’ of a sound. Small
 instruments tend to be higher pitched than larger ones. A firecracker snare, for example, will
 always produce a higher pitch than a large tom.",
                "Playing Time" => "Refers to when the drummer plays a basic beat with
 little or no variation or embellishment. Playing time is what anchors the music, and when well
 done is often superior to a busier approach. See Rhythm Section.",
                "Plies" => "The number of layers of wood veneer that go into a plywood
 drum shell. The number of plies determines the thickness of the shell, which in turn affects
 tone and tessitura. Thicker shells generally have greater volume but a more limited tonal
 range. Can be as few as 3 plies or up to 30, although 6 to 10 plies are most common. Also see
 Tone Wood.",
                "Pocket" => "A reference to a drummer playing very closely with the
 bass player and is thus said to be ‘in the bass player’s back pocket’ – especially at slower
 tempos. Now taken to mean an exceptionally good groove. A ‘deep pocket’ is even more so.",
                "Polyester" => "A general term for plastic film. There are a number of
 types of polyester used to make drum heads, including Mylar and PET.",
                "Poly-Meter" => "Usually lumped in with polyrhythms (and it is one), a
 polymeter is somewhat different in that it alludes to an intermingling of time signatures. In
 4/4 for example, it’s possible to play in 3/4, where a quarter note still gets one beat. This
 creates a strong 3 pulse in apposition to the 4/4 pulse, and if not resolved naturally after
 12 bars, must be resolved at some other point. The classic example is the 3-3-2 pattern: 2
 bars of 3/4 and 1 bar of 2/4 played over two bars of 4/4 — a very common technique in modern
 jazz. Also see Cross-Rhythm.",
                "Polyrhythm" => "Two or more different rhythms played at the same time.
 To play a polyrhythm, you would play a basic rhythm and then overlay a second rhythm that has
 a different, contrasting structure, e.g. ‘2 against 3′, where one hand/instrument might play
 eighth notes while another plays triplets at the same time. Usually expressed as a ratio, e.
 g. 3:4 (3 over 4; 3 against 4) where 4 is the number of underlying beats and 3 is the number
 of notes played ‘over top’. May be the basis of the music or added as an embellishment to add
 interest. Many world music styles use polyrhythms liberally. Also see Poly-Meter, Hemiola.",
                "Polyrhythm vs. Poly Meter vs. Cross Rhythm vs. Hemiola." => "The art of combining two contrasting rhythms has a strong tradition in almost all music forms.
 It therefore makes sense to study the theories and techniques involved and at the same time
 not make a big deal out of it. Most drummers play simple polyrhythms quite regularly and
 easily, while the more complex rhythms are only occasionally heard.",
                "Pop Tune" => "A large percentage of popular music is based on a fairly
 loose song structure. Phrases can be 4 or 8 bars (and there is latitude for other lengths) and
 usually three types of phrase: verse, chorus and bridge (V, C, B). A common pop tune structure
 is V-C-V-C-B-V-C-C.",
                "Popeye Syndrome" => "A condition where the muscles in a drummer’s
 forearms are over developed in relation to the upper arms.",
                "Port" => "Common name for a small- to medium-sized hole cut into the
 front head of a bass drum. Serves a variety of functions: cuts down on ring, improves
 definition, increases projection, and allows access to the inside of the drum to adjust
 damping or to place a microphone. May be augmented with a plastic horn lining the hole.",
                "Power Tom" => "A drum with greater than average depth. For example, a
 12″ tom is traditionally 8″ deep whereas a 12″ power tom might be from 10″ to 12″ deep.",
                "Practice (Pad) Set" => "A frame and set of practice pads that mimic a
 drum set. May have practice cymbals as well. Most are portable enough to be easily taken on
 the road, allowing practice and warm-up before a gig. Also see E-Drum.",
                "Practice Pad/Drum Pad" => "The first practice pad was probably
 invented the same week the first humanoid began banging on objects. Drummers value practice
 pads not merely for sound reduction. They are highly portable, very cost effective and allow
 you to observe your technique close up. The majority of pads are made from live gum rubber
 although other materials are used as well, including adapted drum heads.",
                "Press Roll" => "See Buzz Roll.",
                "Pretensioned Head" => "A drum head that has been mounted on its hoop
 so that it is tensioned to a certain tone. Very useful on rope tension drums, which don’t have
 a lot of mechanical ability to apply tension.",
                "Profile" => "The side view of a cymbal. The amount of curvature of the
 cymbal’s bow affects pitch, sustain and relative ‘dryness’. Flatter cymbals tend to be dry
 with rich overtones; cymbals with a higher profile will be higher pitched and less complex.
",
                "Pulse" => "Another term for the underlying regular beats that set the
 time and the rhythm in music. See Time, Time Signature.",
                "Punchy" => "Short and loud, with penetrating mid-range sounds.",
            ],
            "Q" => [
                "Quaver" => "A uniquely British term for an eighth note; 16th notes and
 32nd notes are semi-quavers and hemi-semi-quavers respectively. Smaller note values are
 similarly interesting. The quarter note on the other hand, is called a crotchet.",
            ],
            "R" => [

                "Rack" => "See Drum Rack.",
                "Rack Tom" => "A tom that is mounted in a rack, attached to a bass drum
 mount, or hanging from a stand. See Mounted Tom.",
                "Remo" => "In 1957 Remo Beli created a Mylar drum head, and soon after
 began manufacturing them commercially. He also aggressively promoted the heads to the drummers
 of the day, easily convincing them of Mylar’s superiority to calf skin. Today Remo is one the
 world’s leading maker of drum heads and other percussion products, including world percussion
 instruments.",
                "Remote/Cable Hi-Hat" => "A hi-hat stand (or other pedal device) that
 has the pedal attached to the stand by a length of cable, allowing the stand to be placed at a
 distance from the player while keeping the pedal close by. Also see Double Bass Pedal.",
                "Resin Shells" => "Drum shells that are made in a mould from a polymer
 resin. Drums are made from the outside in, the finish often being the outer surface of the
 shell. The inner layer is usually a sheet of cloth, which can be fiberglass, Kevlar, carbon
 fibre, and even hemp.",
                "Resolution" => "The conclusion of a phrase. Typically, a phrase will
 introduce tension through rhythm, melody or harmony. The resolution resolves the tension and
 gives a satisfying conclusion to the phrase.",
                "Resonant/Reso Head" => "The bottom head of a two-headed drum. The
 resonant head plays an important role in a drum’s sound. It keeps the sound ‘inside’ the drum
 allowing it to bounce resulting in richer depth, tone and complexity, and increased sustain.
 Often a lighter weight than the batter head. Also see Snare Head, Voicing.",
                "Rhythm" => "One of the fundamental — and indeed indispensable —
 components of all music, rhythm is a regular pattern of beats and their variation. (Music
 consists or melody, harmony, rhythm, and timbre.)",
                "Rhythm & Blues/R&B" => "A style of performance that relies
 predominantly on two musical forms: the structure and chord changes of “I’ve Got Rhythm” and
 12-bar blues. See 32-bar, Rhythm Changes.",
                "Rhythm Changes" => "A tune that uses the structure and harmony — the
 chords changes — of George Gershwin’s “I’ve Got Rhythm”. See 32-bar, Rhythm & Blues.",
                "Rhythm Section" => "The section of a band made up of bass player,
 drummer and usually a chording instrument such as guitar or piano. The rhythm section’s job is
 to lay the foundation for both the tune and the soloists.",
                "Rhythmic Displacement" => "A technique of moving a rhythmic pattern
 off of the down beat, giving the illusion that the time has shifted. E.g. a simple rock
 pattern might be shifted so the bass drum falls on 1-&, 3-& while the back beat shifts to 2-&,
 4-&.",
                "Ride (Rhythm)" => "The notion of a ride rhythm is that it ‘rides
 along’ throughout a tune. In jazz, it is the ubiquitous ‘ding ding-a ding’ cymbal pattern. In
 rock, it is usually eighth notes on the hi-hat or ride cymbal.",
                "Ride Cymbal" => "A specialized cymbal that is geared toward playing a
 steady ride rhythm. Tend to be heavier than crash cymbals, but this is relative. Available in
 an impressive variety of sizes, weights and styles, they are a drummer’s mainstay. Also see
 Crash-Ride, Flat Ride, Mini-cup.",
                "Riff" => "A recurring melodic pattern, usually short and distinctive.
 (When Jimmy Page formed Led Zeppelin, his goal was to create riff-based music.)",
                "Rim" => "Another name for a counter hoop, and also a reference to the
 top edge of a counter hoop. Also see Rim Shot, Triple-Flanged.",
                "Rim Shot" => "A drum stroke where the stick strikes the drum head and
 the rim (counter hoop) at the same time. The effect is a loud, crisp and decisive sound. Rim
 shots can also be used to produce a ringing tone suited to Latin music. Also see Cross
 Sticking, Ping Shot.",
                "RIMS" => "Invented by Gary Gauger in the 1970s, the “resonant
 isolation mounting system” is a frame that holds a drum by its tension rods, eliminating the
 need to bolt a mounting attachment to the drum shell. The goal is to allow the drum to
 resonate freely rather than lose vibration through the mounting system. Similar systems are
 now standard issue on most quality drum sets.",
                "Ring" => "A type of high-pitched overtone that may or may not be
 desirable depending on context and fashion. Ring may clash with other instruments and can make
 a drum difficult to tune and to mic. See Boomy, Ping Shot, Resonance.",
                "Rock Knockers" => "A drum stick that has no taper and no bead.
 Essentially a stick with two butt ends, hence the alternate term double bummers.",
                "Roll" => "A general name for three common sticking patterns that
 produce a continuous, even sound. The main drum rolls are the single-stroke (R L R L R L R L),
 the double-stroke roll (RR LL RR LL) and the buzz roll. Rolls can also be short — the standard
 rudiments include a number of short rolls based on double strokes: 5-stroke, 7-stroke,
 11-stroke, etc.",
                "Rope Tension" => "Before the advent of metal parts, drums were
 assembled and tensioned with rope. A length of rope criss-crossed between top and bottom hoops
 and heads to secure them in place. Rough tuning was done by tightening or loosening the rope.
 Fine tuning was accomplished by moving leather ‘ears’ (buffs) along a rope pair to increase or
 decrease tension.",
                "Rotocasting" => "A method of creating cymbals by pouring molten bronze
 into a spinning mould. An expensive and little used method. Also see Cast Cymbal, Hammering,
 Lathing.",
                "Roto-Toms" => "A shell-less drum that consists of two circular racks
 mounted on a threaded rod. The drums are tuned by spinning the entire drum — clockwise to
 raise the pitch, counter clockwise to lower it. The toms can be quickly tuned and can also
 produce a glissando. Also see Spoxe.",
                "Round" => "A subjective description of a sound that is well balanced
 and mellow, without many high frequencies. See Warm.",
                "Roundhouse Fill" => "A fill the starts at one end of the kit and ends
 at the other end (in some cases a very long trip; see Extended Set). Usually straight-ahead
 16th notes or 16th note triplets.",
                "Rudiment Families" => "The standard rudiments are now grouped under
 five specific ‘families’ according to sticking type: single stroke, double stroke, paradiddle,
 flam, and drag.",
                "Rudimental Drumming" => "There is a strong tradition in western
 culture of marching bands, drum lines and drumming competitions featuring compositions built
 mainly on the rudiments. Also see Drum Corps, Drumistic, NARD, PAS.",
                "Rudimental Grip" => "See Traditional Grip.",
                "Rudiments" => "Standardized sticking patterns, some of which date back
 more than 1000 years. Originally used to communicate signals to different sections of an army.
 A list of ‘standard’ snare drum rudiments was first set down in the early 1300s and has been
 evolving ever since. The first modern interpretation was compiled by the NARD in 1933 as the
 “13 Essential Rudiments”, soon expanded to the “26 Standard American Rudiments” and then to
 the “40 Standard Rudiments”. Although most drummers will at least pay lip serve to the
 rudiments, it’s safe to say that a shocking number of superb drummers have never studied them.
 (Rather than include all, most or even many of the rudiments here, I recommend you check out a
 good book or website on the topic. They will do a far more useful job for you. ) Also see Drum
 Corps, Hybrid Rudiments, Rudimental Drumming, Swiss Rudiments.",
                "Rushing" => "A tendency to play faster than the set tempo — a serious
 fault. Can cause the time to get completely out of control. Not the same as playing on top of
 the beat.",
                "Rutes/Brooms" => "Bundles of small sticks that are mid-way between a
 drum stick and a brush. Range from pencil-sized dowels to spaghetti-sized strips of bamboo and
 also fine nylon rods. Often have a sliding ring or sheath of plastic that allows the bundles
 to be modified for different sounds.",
            ],
            "S" => [

                "Salsa" => "A general term that can refer to a variety of
 Afro-Cuban/Afro-Latin rhythms.",
                "Sample" => "A section of recorded music that has been captured and
 then programmed into a sequencer or synthesizer. Certain hip-hop styles frequently use samples
 of interesting rhythms. Also see Break Beat, Loop.",
                "Scratch Roll" => "An exaggerated buzz roll generated by pressing hard
 on the sticks in short bursts. Sometimes considered a technical flaw, but can be effective if
 used sparingly.",
                "Sculptured Gong" => "A gong that is not round. A number of artisanal
 makers have created interested shapes and sounds, such as Matt Nolan’s ‘Hand’ and ‘Bat-Wing’
 gongs.",
                "Seamless Shell" => "See Spun Metal.",
                "Second Line Shuffle" => "A rhythm unique to New Orleans music that
 combines a military-style syncopated snare drum roll atop a salsa bass drum rhythm. Also see
 Traditional Jazz.",
                "Secondary Beats" => "A note that is produced by allowing the stick to
 touch the head a second time immediately following a full stroke. The double-stroke roll
 relies on secondary beats or strokes, as does the Moeller stroke. Also see Opened/Closed.",
                "Shakers" => "Almost anything that can produce a rattling noise can be
 used as a shaker. Range from plastic ‘eggs’ and metal tubers filled with beads to woven
 baskets filled with seeds or pebbles to hollowed-out gourds with a netting of beads around the
 outside. Played by shaking, rolling and striking against the hand.",
                "Sheet Metal Cymbals" => "An economical way of making cymbals is to
 stamp them out of a roll of sheet bronze. Cymbal blanks then go through some or all of the
 same processes as cast cymbals but lack the strength and complexity of cast cymbals. Sheet
 bronze cymbals allow the drummer on a tight budget to own bronze cymbals without the
 associated cost. (Note: Bell bronze cannot be formed into large sheets. See B8.)",
                "Shed" => "To practice, usually a musical instrument. A person does not
 need to literally be in a shed to 'shed'. I need to work on my drumming, I'm gonna hit the
 shed.",
                "Shell, Drum" => "A large, hollow tube that is the main component of a
 drum. Virtually every facet of a drum shell has a range of design possibilities. Materials
 range from solid wood, plywood and metal (steel, aluminum, copper, brass, bronze) to plastic
 (acrylic), fiberglass and carbon fibre. Metal shells are usually reserved for snare drums as
 they tend to be too heavy and vibrant for other drums. Wood appears to offer the best balance
 of tone, volume, playability, and cost. Diameters range from 6″ to 18″ for toms, 16″ to 28″
 for bass drums, and 12″ to 15″ for snares. Depths range from 3″ at the low end to the same or
 greater depth than the shell’s diameter (see Floor Tom, Parade Drum, Power Tom).
 Interestingly, every diameter from 10″ to 16″ is available with the exception of an 11″ drum.
 Like the 2-dollar ‘greenback’, drummers have turned their backs on the 11″ drum. Also see
 Membranophone, Plies, Tone Wood.",
                "Shell Pack" => "1. A set of drum shells drilled and ready for
 finishing and assembly; 2. Modern term for a drum set minus stands and cymbals.",
                "Shell Sizing" => "Drum shells have a depth and a diameter. Both are
 somewhat standardized, but there are two ways to specify a size — diameter x depth or depth x
 diameter — and drum companies have yet to decide on one method. This can lead to confusion: Is
 a ’16 x 18′ drum sixteen inches wide and eighteen inches deep or the other way around? The
 standard for North American drums was depth x diameter and for Europe and Japan, diameter x
 depth. Fortunately, a company will use the same notation for all their drums. (Given that we
 talk about a drum as ’12’, ’14’, ’20’, etc., it makes sense that the diameter x depth system
 should emerge as the standard.)",
                "Shimmer" => "The bright, high partials of a cymbal. See Glassy.",
                "S-Hoop" => "A type of triple-flanged hoop that has the top flange
 curled inward and slightly over the drum head.",
                "Shot(s)" => "In big band music, the drummer will often punctuate horn
 figures by playing the figure or a subset of the figure (i.e. the accents). Shots can be
 played anywhere on the drum set, although the snare drum appears to be the favourite. Also see
 Bomb.",
                "Shoulder" => "The part of a drum stick where the shaft leaves off and
 the taper begins.",
                "Shuffle" => "A rhythm loosely based on a dotted eighth and sixteenth.
 One of the three core rhythms found in popular music, especially country and blues.",
                "Side Drum" => "A drum that is carried by a sling and hung to the left
 for use while marching. Side drums were most often snare drums and tenor drums, but could also
 be deep-shelled bass drums. See Long Drum, Parade Drum, Suspended Drum, Traditional Grip.",
                "Signature (Series)" => "A product that bears the signature of a drum
 celebrity. Many popular drummers have their own signature drum sticks. Lately drummers have
 had their names added to individual drums, cymbals and even cow bells. See Endorser.",
                "Silver Dot" => "The Ludwig Drum Company makes a drum head similar to
 the Remo Black Dot, with a reflective silver dot. The heads sound slightly mellower and with
 less ‘clack’ than a black dot head.",
                "Single Headed" => "A drum that has only a batter head. Such drums tend
 to project well and are easy to mic, but lack depth, tone and resonance. See Concert Toms,
 Melodic Toms, Octobans.",
                "Single Tension" => "A double-headed drum that has no tension casings.
 Instead, the tension rods connect one counter hoop to the other. When a tension rod is turned,
 it affects both heads equally. Such drums are perhaps somewhat easier to rough tune but are
 less flexible in terms of fine tuning and tonal range compared to double-tension drums.",
                "Sizzle Cymbal" => "A cymbal that has had rivets installed in it. Can
 be a ride or crash cymbal with as few as 2-3 rivets and up to a dozen or more. Adds a subtle
 wash element to the sound. Also see Effects Cymbal, Swish Knocker.",
                "Skip Beat" => "In a jazz ride pattern, a light stroke placed just
 before the 1 and 3. Assuming a dotted 8th & 16th notation, the 16th note would be the skip
 beat. Played with a triplet feel and counted as 1-trip-let, 2-trip-let, the skip beat would be
 the ‘let’.",
                "Slunk/Slink Skins" => "The skin of an unborn, stillborn or prematurely
 born calf. The hides are sometimes used to produce a fine grade of calf skin for snare heads.
",
                "Small Tom" => "See Mounted Tom.",
                "Snare (Drum)" => "A two-headed drum that has wire snares fitted to the
 bottom head by means of a snare release, which enables the drum to produce a crisp ‘crack’
 sound and also facilitates buzz rolls. At one time snare drums were about as deep as they were
 wide (see Military Drum). Modern snare drums tend to be shallower, although fashion brings
 back the deeper drums from time to time. Range from 12″ to 15″ in diameter and generally 4″ to
 8″ deep, and often have cute names such as black beauty, firecracker or piccolo. Snare drums
 typically cost more than other drums because of the extra hardware and machining required.
 There are also snare drums that have snares beneath the top head in addition to or instead of
 bottom-mounted snares. See Gut, Side Drum.",
                "Snare Bed" => "Snare drum shells typically have regions where the
 bottom bearing edge has been filed away to produce two shallow channels at the edges of the
 snare head. The width and depth of the snare bed — or its absence — can have a dramatic effect
 on snare response. Snare wires should be selected to match the profile of the snare bed and
 vice versa.",
                "Snare Gate" => "Openings in the bottom rim of a snare drum that allow
 the snare attachments to pass through. Also see Snare Bed.",
                "Snare Head" => "In order to facilitate response from the snare wires,
 the bottom or resonant head of snare drums is usually much thinner than the batter head. Even
 in the case of ultra-high tension rudimental or military tuning, the snare head will be
 thinner than the top head.",
                "Snare Plate" => "See Butt Plate.",
                "Snare Release/Throw-Off" => "A device that holds the snares onto a
 snare drum, allowing the snares to be tightened or loosened or disengaged entirely. Also see
 Butt Plate, Snare Bed, Snare Strainer.",
                "Snare Strainer" => "Another name for a snare throw-off. When snares
 were made from gut, the strainer actually ‘strained’ and aligned the individual strands.",
                "Snares/Snare Wires" => "In general, a set of fine helical wires set
 into metal plates and strung across the bottom of a snare drum. Snares give the drum its
 distinctive crack and crisp tone. Snare wires come in a wide variety of materials and
 configurations. Also see Butt Plate, Gut, Nylon, Snare Release.",
                "Snow Shoe Pedal" => "A primitive predecessor to the hi-hat consisting
 of two boards with a hinge at one end and two small cymbals at the other. A foot loop on the
 upper pedal enabled the drummer to ‘sock’ the cymbals together by tapping a foot.",
                "Sock Cymbal" => "The mid-point in the evolution from lo-boy to hi-hat,
 the sock cymbal pedal placed a pair of cymbals roughly at the drummer’s knees.",
                "Solid Wood" => "A drum shell that is made from one or more pieces of
 wood rather than plies. Many vintage drums were made from a single plank of wood, steam bent
 into a circle and joined. Stave drums are made from sticks of wood glued vertically and then
 machined to produce a round shell. Shells can be made from blocks of wood glued in a stack in
 a ‘butcher block’ design. Drums are also made from hollowed out logs, e.g. the tabla of India,
 Japanese Koto drums, Nigerian talking drums.",
                "Sound Bite" => "A crack or break in a cymbal that actually makes the
 cymbal sound better. A reference to damage that has been repaired by grinding out the affected
 area of the cymbal (my own offering). See Flea Bite.",
                "Spang-A-Lang/Splang-A-Lang" => "A mnemonic that attempts to mimic the
 classic jazz ride cymbal rhythm. Also ‘boom chick-a-boom’, ‘ding ding-a ding’.",
                "Speak" => "How quickly a cymbal responds after being struck. Thin
 cymbals speak more quickly than heavier cymbals.",
                "Splash Cymbal" => "A small, thin crash cymbal, usually 8 to 10 inches,
 that is used mainly for accents. Also see Toy Cymbal.",
                "Spoxe" => "Remo markets the rims of their Rototoms as a type of
 special effects tool that produce a jangling sound. Some drummers will mount two spokes on a
 hi-hat stand. (Pronounced ‘spokes’)",
                "Spun Formed" => "A method of forming entry-level cymbals by the spun
 metal technique. Such cymbals are not usually lathed; the lines in the cymbal’s surface are
 caused by pressure rollers.",
                "Spun Metal" => "A technique of forming metal by putting it into a type
 of lathe and then moulding it to a given shape through pressure. The result is a part or
 instrument that has no seam. Quality metal snare drums and tension hoops are often spun rather
 than bent and welded. Also see Rotocasting, Spun Formed.",
                "Spurs" => "Metal ‘stakes’ affixed to a bass drum to prevent it from
 creeping during play. Usually combine a moulded rubber ‘foot’ and a sharp tip to accommodate
 both hard and soft surfaces.",
                "Staccato" => "A type of articulation where the sounds are short and
 sharp. In percussion, most sounds are short — in fact, achieving a long sound is a bit of a
 challenge. Still, staccato sounds are possible using techniques like the stick shot and cymbal
 choke.",
                "Stack(ed) Cymbals" => "Two or more cymbals mounted on a single stand
 using a spacing unit. Allows cymbals to be played individually or simultaneously. Also see
 Effects Cymbal, Piggy Backing.",
                "Staff" => "A 5-line grid that is used for writing music. Drum music is
 traditionally written in the bass clef using the spaces to represent different instruments:
 bass drum on the bottom space, hi-hat one space below, snare on the third space, cymbal on the
 space above. As drum sets and playing became more complex, the lines were called into play and
 new symbols were adopted beyond the round note for drums and the ‘x note’ for cymbals.",
                "Stainless Steel" => "While bell bronze is the standard metal for
 cymbals and gongs, some makers have had success with other metals, principally stainless steel
 and nickel silver. Also see Steel Shell.",
                "Standard" => "A song or tune that is universally accepted and
 recognised as a classic. While the term is used most often in jazz circles, there are plenty
 of pop and rock standards, as a visit to any dance hall will show.",
                "Standard Rudiments" => "See NARD, PAS, Rudiments.",
                "Standard Time" => "See Common Time.",
                "Star Tuning" => "Tuning in a star shape, i.e. every other lug. On a
 10-lug drum the pattern would be: 1, 3, 5, 7, 9, 2, 4, 6, 8, 10.",
                "Stave Drum" => "Drum shell made of wood staves aligned vertically and
 glued, then machined. Also see Solid Wood, World Percussion.",
                "Stay Hoops" => "See Glue Rings.",
                "Steel Drum" => "Hailing from Jamaica, this drum is made from a
 repurposed metal drum such as an oil drum. The top Is painstakingly hammered into a deep dish
 with a number of raised areas tuned to specific notes. May be cut down to about 1 foot in
 depth for lead instruments and for parade use.",
                "Stencil Cymbal" => "A cymbal that has been purchased from a cymbal
 maker and then labelled and marketed under the buyer’s brand.",
                "Shot" => "An accent played by pressing the bead of the stick into the
 head and striking the stick with the other stick.",
                "Sticking Patterns" => "The nuts and bolts of drumming, sticking
 patterns are the drummer’s equivalent of scales and chords. Range from the basic single and
 double strokes to the 40 standard rudiments to the very complex patterns laid down by drummers
 like Steve Gadd, Gavin Harrison, et al.",
                "Structure" => "The way in which a tune is built. Tunes are built up of
 phrases, which in turn are built from bars. The structure of a tune is the number and length
 of the phrases and how they are arranged. It’s important to know the structure of the tune in
 order to know your place in its evolution. See 12-Bar Blues, 32-Bar, Pop Tune.",
                "Sub Kick" => "A special microphone optimized for bass drums and
 mounted in a drum-shaped enclosure about the size of a snare drum. Some drummers have
 replicated the device by mounting a 10″ or 12″ speaker inside a small drum shell.",
                "Subdivision" => "The divisions of the beat that make the basic rhythm.
 E.g. dividing the beat in half creates an 8th-note feel. Dividing it in thirds creates a
 triplet or ‘6/8′ feel. Dividing it into a dotted-eighth and sixteenth creates a shuffle feel.
 Also see Tuple.",
                "Suspended Cymbal" => "In the early days of the drum set, cymbals were
 often suspended from large hooks attached to the console. The term goes back much further,
 when 17th century composers asked for suspended cymbals rather than the customary hand
 cymbals.",
                "Suspended Drum" => "Usually a reference to a marching drum that is
 suspended from a shoulder strap or harness. See Long Drum, Side Drum, Tenor Drum.",
                "Sustain" => "The tendency of a note or sound to persist. Percussion
 instruments are usually short in sustain with the exception of bells, gongs and vibraphones.
 Cymbals have more sustain than drums but less than most other instruments. Also see Envelope,
 Staccato.",
                "Sweet Spot" => "An area of a drum or cymbal that has both the best
 sound and the best playability. Can vary depending on music style and desired outcome. For
 example, a general purpose cymbal might have one sweet spot for playing rock ride and another
 for jazz ride. A drum stick also has a sweet spot: see Fulcrum.",
                "Swell" => "The tendency of a ride cymbal to increase in volume in a
 certain part of its tonal range. Similar to build or wash.",
                "Swing" => "A style of music that appeared in the 1940s, championed by
 big bands. An outgrowth of jazz, it is based on the classic jazz ride rhythm.",
                "Swish Cymbal" => "A china-type cymbal with rivets.",
                "Swish Knocker" => "A large china-type cymbal, usually 22″, with many
 rivets installed in the ‘trough’. A favourite of Mel Lewis.",
                "Swiss Rudiments" => "See Basel Drumming.",
                "Syncopated/Syncopation" => "A rhythm that liberally places unexpected
 emphasis between the beats to create interest. Also see Off Beat.",
            ],
            "T" => [

                "Taber" => "A type of ‘folk’ snare drum carried in one hand and played
 with the other, with or without a stick. Dates from medieval Great Britain.",
                "Tabla" => "The word tabla is often used to refer to the traditional
 drum pair of northern India. The tabla itself, also called a dayan, is a small, single-headed
 wooden-shelled drum that is the lead voice of the pair. The bayan is a larger single-headed
 kettle drum with a metal bowl. The drums are renowned for the astounding number of sounds and
 rhythms they are capable of. Also see Bols, Carnatic, Tala.",
                "Tala" => "The Carnatic rhythm system. Rather than time signatures,
 Carnatic music is built on rhythmic cycles that have a theme, a number of variations, and a
 stylized ending. All musicians adhere to the tala’s 3-part structure. The ‘time keeper’, often
 the singer, uses distinctive hand motions to mark the tala. Also see Konnakol.",
                "Tambourine" => "A plastic or wooden frame drum or ring, with or
 without a head, that has metal jingles mounted into the frame. Can be played by shaking it and
 hitting it with the hand and fingers. Most cultures have some sort of tambourine.",
                "Tam-tam" => "Another name for a wind gong.",
                "Tap Tuning" => "A style of tuning that focuses on voicing rather than
 pitch. After being brought up to pitch, the drum is set on a flat surface to prevent
 resonance. The head is then tapped near each tuning lug and tuned until the pitch at every lug
 is the same.",
                "Taper" => "1. The section of a drum stick starting at the shoulder and
 ending at the bead. As expected, it is tapered; 2. Decreasing thickness, from bell to edge, in
 the bow of a cymbal. The taper – usually achieved by lathing — affects a cymbal’s attack and
 pitch.",
                "Technique" => "The accumulated sticking patterns, co-ordination and
 independence gained through extensive practice. A certain amount of technique is necessary to
 play competently. Although sometimes viewed as the holy grail of drumming, more is not always
 better. See Chops.",
                "Temple blocks" => "Of Chinese origin, these wooden blocks resemble
 large sleigh bells. Made of tone wood, they are hollowed out and have one or two sound slits
 in the front and make a sound something like ‘clock’.",
                "Tempo" => "The speed of a rhythm or piece of music, measured in beats
 per minute.",
                "Tenor Drum" => "The marching band equivalent of a tom tom.
 Traditionally a side drum, and big brother to the snare drum, modern tenor drums are often
 more like mounted toms, with 3, 4, and even 6 drums mounted in a carrying frame. May be double
 or single headed. The single headed variety are sometimes called timp-toms as they can be
 tuned to a specific pitch.",
                "Tension & Release" => "An important concept in music is to create
 excitement (tension) alternating with more relaxed passages. Tension adds interest and energy
 to the music, and the release provides a satisfying resolution, which in turn sets up the next
 bit of tension.",
                "Tension Casing" => "Metal fittings attached to the side of a drum
 shell to receive tension bolts. Much research has gone into the construction and mounting of
 tension casings, and there are theories and opinions on what works and what doesn’t. Modern
 casings tend to be light, and are often fitted with an isolation gasket between the casing and
 the drum shell.",
                "Tension Hoop" => "See Counter Hoop.",
                "Tension Rod/Bolt" => "A threaded bolt, usually with a square head,
 that holds the counter hoop and drum head against the drum shell. The bolts also serve as
 tuning rods: tightening raises the pitch and loosening lowers the pitch. Also see Gladstone
 System.",
                "Tessitura" => "The useful tonal range of an instrument. In the case of
 a drum, the tuning range, from lowest to highest, that the drum is most suited to.",
                "Thrash (Metal)" => "A sub-genre of heavy metal, this hyper-aggressive
 music style gets much of its impetus from frenetic 8th notes on double bass and on the rest of
 the drum set. Also see Blast Beat.",
                "Throne" => "An apt name for a drummer’s stool.",
                "Thumb Roll" => "A type of roll played by wetting a thumb or finger and
 dragging it across the drum head. With practice, can yield a well-controlled, fairly long roll
 sound that has an interesting ‘growl’ quality.",
                "Tiger Gong" => "A small gong, 8″ to 15″, that has a slight glissando.
 Also see China Splash.",
                "Timbale Sticks" => "Thin wooden sticks with a butt at both ends.",
                "Timbales" => "A pair of shallow single-headed metal drums peculiar to
 Latin music. A pair is usually a 13″ drum and a 14″ drum. Played with thin, un-beaded sticks,
 in the hands of a virtuoso they can be very exciting.",
                "Timbre" => "Instruments are identified by their timbre. Each
 instrument produces a signature set of overtones that combine to create the instrument’s
 character. While two instruments may play the same note, they will always sound different
 because of timbre.",
                "Time" => "A general reference to the flow of the music: the beats or
 pulse. Keeping good time means adhering to the tempo and not allowing it to fluctuate
 noticeably. Also see Behind The Beat, Dragging, On Top of The Beat, Rushing.",
                "Time Keeping" => "At one time, the drummer was considered the time
 keeper of the band. The modern interpretation is that everyone in the band is responsible for
 keeping time. In some contexts, notably jazz, the bass player is the main time-keeper and
 anchor. See Pocket.",
                "Time Signature" => "Except for certain ‘free’ styles, music is based
 on a regular repeated pattern of beats. The time signature is a statement of how may beats
 there are in a bar and which type of note gets one beat. Thus 11/8 would represent 11 beats to
 a bar with an eighth note accounting for one beat.",
                "Time, Playing" => "See Playing Time.",
                "Tom Tom" => "The term ‘tom’ comes from the middle east and refers to
 any drum that is not a snare drum, kettle drum or bass drum. Tom toms — or just toms — can
 range from as little as 6 inches in diameter to as large as or larger than a bass drum, and
 may have one or two heads. See Chinese Tom, Gong Drum, Power Tom, Rack Tom, RotoTom, Tenor
 Drum.",
                "Tone" => "Many of the terms here attempt to put sound into words.
 There is no standard terminology, so players are dependent on impressions paired with words
 meant for other uses. Thus the language for tone is filled with words like glassy, trashy,
 complex, raw, dry, explosive, fast, fuzzy, delicate, woody, breathy, throaty, clean, dirty,
 and many others. Fortunately, when listening to an instrument it’s fairly easy to agree that
 the terms appear to apply despite the vagaries.",
                "Tone Grooves" => "After a cymbal has been lathed, one or both surfaces
 will be covered in fine grooves, which enhance the tone of the cymbal. It takes many years for
 a cymbal smith to become expert at lathing cymbals to produce the right thickness, taper and
 tone grooves. Also see Hybrid, Spun Formed.",
                "Tone Wood" => "Any wood that will produce a quality instrument. Often
 thought of only as the woods used in xylophones, marimbas, stringed instruments, and
 woodwinds, the term is valid for drum shells as well. The list of shell woods is short,
 although there are almost unlimited possibilities and trials. Most drum makers will offer at
 least these standards:
 Mahogany – produces a warm sound with moderate volume and a somewhat limited pitch range;
 Birch – a very hard wood that results in loud, bright drums with lots of resonance;
 Beech – very similar to birch;
 Maple – midway between mahogany and birch.",
                "Tonic" => "The fundamental note in a key. In the key of ‘C’, C is the
 tonic.",
                "Top Dead Centre/TDC" => "Not a drum term, but worth mentioning.
 Cymbals tend to be somewhat uneven when mounted on a stand, and will gradually rotate and
 settle in a certain position. The current recommendation is to determine TDC before installing
 a cluster of rivets, which should go on the edge furthest away from the natural playing area.
",
                "Toy Cymbals" => "Very small splash cymbals, ranging from 7″ down to
 4″, mounted several on a stand. At one time, drummers purchased cymbals at toy stores and
 added them to their set-ups. Now a small number of cymbal makers offer these special-purpose
 cymbals.",
                "Trading Fours" => "A drum feature where the band plays four bars and
 the drummer ‘responds’ with a four-bar solo. This trading pattern is then repeated, usually
 for a full chorus. The band and drummer can also trade eights, twos and even ‘ones’.",
                "Traditional (Style) Jazz" => "Another name New Orleans or Dixieland
 jazz.",
                "Traditional Grip" => "Also called rudimental grip, the technique is
 derived from the realities of playing a drum slung from the shoulder and resting on the knee
 while marching along. All drummers would play ‘right handed’ with the drum suspended to the
 left side. To accommodate playing at this awkward angle, the player held the stick in the left
 hand in the crotch of the thumb and first finger, and struck the drum with a turn of the
 forearm. There are advantages and limitations to traditional grip when applied to the modern
 drum set and to modern music. It’s a good idea to try both matched grip and traditional grip
 to see which is better for you (although matched grip seems destined to stay in the lead).",
                "Traps" => "An early term for a drum set. Possibly derived from the
 word snare, suggesting a trap, or from the word contraption, a still-valid comparison. See
 Console, Drum Rack.",
                "Trash Can Lid" => "An expression that is testimony to how much
 drummers like trashy sounding cymbals.

",
                "Trash/Trashy" => "A distinctive cymbal sound produced by an abundance
 of midrange tones. Chinese cymbals and stacked cymbals are valued for their trashy tone.",
                "Trashformer" => "A line of small, very warped cymbals from Zildjian
 that are particularly trashy sounding. Designed for use in cymbal stacks or on their own.",
                "Tricky Sticks" => "A piece of showmanship where the player holds the
 sticks up where all can see and then plays patterns back and forth between the sticks. Also
 see Back Sticking.",
                "Trigger" => "1. In the world of electronic drums, triggers are the
 mechanisms that send signals to the control unit. A trigger is essentially a pressure
 sensitive plate that is embedded in a drum pad. Pads can have more than one trigger, and
 high-end triggers have stick response that better approximates real drums; 2. A small
 triggering device that attaches to a drum. The drum(s) can then be played acoustically while
 also triggering a control unit. One application is to send the triggered output to the sound
 system rather than using microphones on the drums.",
                "Triple-Flanged" => "A counter hoop that has been bent three times. The
 first two bends form a channel to accept the drum head. The third flange rolls the top of the
 rim over to present a thicker profile that is less damaging to sticks when doing rim shots.
 Also see Cast Hoop, S-hoop.",
                "Triplet" => "A rhythm that divides the beat into three equal parts,
 often counted ‘1-trip-let, 2-trip-let’ etc. Rhythms based on triplets have a gentle lilt. Jazz
 and shuffle rhythms are often played with a triplet feel. Also see Jazz Ride, Tuplet.",
                "Tuneable Tom" => "The toms first used on drum sets were not tunable
 (see Chinese toms). Celebrity drummer Gene Krupa was instrumental in promoting the development
 of tunable toms through the addition of tension rods and casings. Virtually all toms today are
 of the tunable variety. Also see Concert Tom, Tenor Drum.",
                "Tuned Percussion/Pitched Percussion" => "See Mallet Instruments.",
                "Tuning Lug" => "See Tension Casing.",
                "Tuning Rod" => "See Tension Rod.",
                "Tuplet" => "Any type of note division other than 2 and 4. Includes
 triplets, quintuples, septuplets, etc. Usually grouped by a beam and a number or ratio.",
                "Turkish Style Cymbal" => "1. A cymbal made in the ‘Turkish style’ may
 be hand hammered or not. When cymbals were completely hand-made, Turkish cymbals were known
 for their distinctive tones and qualities. Typically the bow is flatter than modern cymbals
 and the envelope will be complex with a hint of trashy-ness; 2. The style of cymbals that
 evolved in and around Turkey, with a pronounced rounded bell and a graceful bow, in contrast
 to the upturned profile of Chinese cymbals.",
                "Turn-Around" => "It’s common to add a variation or fill in the final 1
 or 2 bars of a phrase to wrap up the phrase and set up the next one. See Cadence, Resolution.
",
                "Twang" => "When a membrane is struck, it stretches, which raises the
 pitch slightly. Normally this is inaudible, but certain tuning techniques can accentuate this
 glissando effect. Mainly applies to toms.",
                "Two-Ply" => "A drum head that is made from two sheets of plastic fixed
 to a single metal hoop. These heads tend to be more rugged due to the extra thickness, but
 their main appeal is their warm tone and reduced over-tones or ring. See Hydraulic, Pinstripe,
 Polyester.",
                "Tympani" => "Modern day kettle drums are almost always called tympani.
 Usually made of metal, they are not often found outside a symphony orchestra.",
                "Tyvek" => "A paper-like plastic product that resembles calf skin. See
 Fiberskyn.",
            ],
            "U" => [

                "Undertone" => "A sound that emerges below the instrument’s
 fundamental. Cymbals and gongs often have rich undertones. Also see Perceived Pitch.",
                "Unison" => "When two or more musicians play the same part together.
 Also see Break, Ensemble Notes.",
                "Unlathed" => "Normally the last step in cymbal making is to lathe both
 sides of the cymbal. Leaving all or part of a cymbal unlathed gives it distinctive qualities.
 The unlathed metal will be thicker, giving the cymbal good articulation, higher pitch, and
 less tendency to build. Also see Earth Cymbal, Hybrid Cymbal, Lathing, Tone Grooves.",
                "Up Beat" => "The opposite of a down beat. In common time, 1 and 3 are
 down beats and 2 and 4 are up beats. In 3/4 time, 1 would be the down beat and 2 and 3 would
 be up beats.",
            ],
            "V" => [

                "Vamp" => "A simple repeating musical figure, often based on just one
 or two chords. Usually serves as a background for some other function (not necessarily music).
 Although similar to an ostinato or montuno, a vamp typically is more of a ‘place holder’,
 hence the instruction “Vamp until ready”.",
                "Vent/Air Vent" => "A small hole placed in the side of the drum shell
 of a two-headed drum to allow air to move in to and out of the shell. Research has shown that
 size and placement of the vent(s) can have a noticeable effect on a drum’s sound. A drum with
 a lot of venting will sound ‘dry’. A drum with no vent can lack depth and produce overtones
 that are difficult to control.",
                "Voicing" => "Fine tuning of a drum to bring it into tune with itself.
 Drum heads should be tensioned equally at each tension lug to voice properly. This is
 especially important with two-headed drums where the heads interact with each other. See Tap
 Tuning.",
            ],
            "W" => [
                "Wash" => "One of several sounds made by a ride cymbal. As the cymbal
 is played, an undertone may emerge that sounds a bit like ‘seashore’, ‘roar of the crowd’, or
 white or pink noise. Also see Build, Swell.",
                "Water Drum" => "A specialized two-headed frame drum found in eastern
 North American aboriginal cultures. The drum has a small amount of water in it, the theory
 being that sound travels better over water.",
                "Wet" => "A drum tone that is short and lacking in low and high
 frequencies as well as resonance. Usually the sign of a very slack head.",
                "Wet Paper Bag" => "An unattractive wet sound (e.g. ‘splat’) that
 results from having too little tension on the drum head. This also hampers projection and can
 make the drum difficult to play.",
                "Whipped Cream Roll" => "A buzz roll executed by rotating the wrists as
 if whipping cream in a bowl. Yields a smoother sounding roll, especially at slower tempos.",
                "Whipping Technique" => "See Moeller.",
                "White Man’s Blues" => "A term sometimes applied to county & western
 music. There are parallels in that county music was born of working class whites writing songs
 about their unique lot in life.",
                "Wind/Lion Gong" => "A flat gong, visually similar to a flat ride
 cymbal, that has complex overtones and long sustain.",
                "Wood block" => "A wooden block, not surprisingly. Not as popular as
 they once were, these blocks of tone wood have slots routed into them to improve tone and
 volume.",
                "Wood Hoops" => "At one time all drum counter hoops were wooden. In the
 second quarter of the 20th century, metal hoops took over. In the past decade or so, there’s
 been a renewed interest in wooden hoops. Unlike the tall, thin rims of historical drums,
 today’s wood hoops are generally made from hard woods and are about as thick as they are high.
 Tend to produce a warm, fat, well-controlled sound. Also see Rope Tension, Tunable Tom, Woody.
",
                "Woody" => "Resembling the tone of a wood instrument. Metal snare
 drums, for example, have a certain amount of high-pitched ring and overtones, whereas wooden
 snare drums have less of both and thus sound warmer, i.e. ‘woody’.",
                "Woofer" => "A secondary shallow-shelled bass drum mounted in front of
 the main bass drum. Can add more resonance, bottom end and ‘punch’ to a bass drum. May be
 fitted with an internal microphone. Also see Sub-Kick.",
                "World Beat" => "A fusion of western popular music and non-western
 styles. For example, a popular tune that includes African instruments and rhythms would
 classify as world beat music.",
                "World Music" => "A term that loosely refers to non-western music —
 i.e. anything that did not originate in Europe or North America. The definition is further
 obfuscated by the practice of blending music styles from different cultures.",
                "World Percussion" => "A general term to describe percussion
 instruments that are not from the western music tradition. The variety of instruments is
 extensive as most cultures have a number of traditional instruments: hand drums, gongs,
 cymbals, Gamelan-style gongs, Taiko drums, temple drums, talking drums, ceremonial drums,
 singing bowls, and all manner of shakers, clackers, and more. See World Music.",
            ],
            "Z" => [
                "Zildjian, A" => "One of the oldest companies in existence, Zildjian
 has been making fine cymbals for nearly 400 years. In 1618, the name Zildjian was given to
 Avedis, an alchemist, by Sultan Osman II in recognition for the unique bronze that Avedis
 created. The name means cymbal maker. Avedis Zildjian III moved the company to the US in 1928.
 (In 1982 the Zildjian brothers, Armand and Robert, went their separate ways. Armand took over
 Zildjian, and Robert opened the Sabian cymbal company in Canada.)",
                "Zildjian, K" => "In 1865, the Avedis Zildjian cymbal company passed to
 Kerope Zildjian, who began to label the company’s products ‘K Zildjian’. Shortly before
 Kerope’s death in 1910, his son, Aram Zildjian, opened a second factory, calling it Avedis
 Zildjian. K Zildjian continued to make cymbals until its works and artisans were reacquired by
 A Zildjian in 1968 and moved to North America.",
                "12-bar Blues" => "An old music form, dating from the early 19th
 century, that evolved from work songs and spirituals. The form has been standardized at 12
 bars in three 4-bar phrases, with the melody and harmony ranging from simple to complex. Blues
 has a number of distinct sub-styles including Chicago blues, Delta blues, West Coast blues,
 Boogie-woogie, and many others.",
            ],
            "#" => [
                "16-bar Blues" => "Less common than other song structures, the 16-bar
 blues is based on the 12-bar blues and incorporates an extra 4-bar phrase. There are no hard
 rules on how that 4-bar phrase is placed. Most common are a repeat of the first phrase, a
 repeat of the second phrase, or an added phrase between the second and third phrases.",
                "32-bar" => "A standard song structure that is made up of four 8-bar
 phrases. Each phrase is generally given a letter — A, B, C, etc. — which is then used to
 describe the tune’s structure. E.g., “I’ve Got Rhythm” (see Rhythm Changes) defines the
 standard and is AABA — verse, verse, bridge, verse. Other popular structures are: ABAB, ABBA,
 ABCA.",
            ],
        ];

        return view('legacy.dictionary', [
            "dictionaryTerms" => $terms,
        ]);
    }

}
