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

        $songsCSV =
            "brand,artist,title,album,style,difficulty,total_xp,artwork_filename,pdf_filename,assignment_title,assignment_xp,soundslice_slug,publishing_status,instrument_removed
pianote,Adele,When We Were Young,25,Soul,6,150,adele-25.jpg,adele-when-we-were-young.pdf,When We Were Young,25,WMV4c,Published,0
pianote,Bill Haley and His Comets,Shake Rattle and Roll,,Rock,8,200,bill-haley-and-his-comets-shake-rattle-and-roll-single.jpg,bill-haley-and-his-comets-shake-rattle-and-roll.pdf,Shake Rattle And Roll,25,BMV4c,Published,0
pianote,Billie Eilish,No Time To Die,No Time to Die: Original Motion Picture Soundtrack,Pop,6,150,billie-eilish-no-time-to-die-original-motion-picture-soundtrack.jpg,billie-eilish-no-time-to-die.pdf,No Time To Die,25,ZMV4c,Published,0
pianote,Billie Eilish and Khalid,lovely,13 Reasons Why: Season 2 (A Netflix Original Series Soundtrack),Pop,7,200,billie-eilish-and-khalid-13-reasons-why-season-2-a-netflix-original-series-soundtrack.jpg,billie-eilish-and-khalid-lovely.pdf,lovely,25,LMV4c,Published,0
pianote,Billy Joel,Just The Way You Are,The Stranger,Pop,7,200,billy-joel-the-stranger.jpg,billy-joel-just-the-way-you-are.pdf,Just The Way You Are,25,jMV4c,Published,0
pianote,Billy Joel,My Life,52nd Street,Pop,7,200,billy-joel-52nd-street.jpg,billy-joel-my-life.pdf,My Life,25,PMV4c,Published,0
pianote,Billy Joel,'She''s Got A Way',Songs in the Attic,Pop,7,200,billy-joel-songs-in-the-attic.jpg,billy-joel-shes-got-a-way.pdf,'She''s Got A Way',25,9MV4c,Published,0
pianote,Bonnie Raitt,'I Can''t Make You Love Me',Luck of the Draw,Pop,7,200,bonnie-raitt-luck-of-the-draw.jpg,bonnie-raitt-i-cant-make-you-love-me.pdf,'I Can''t Make You Love Me',25,KMV4c,Published,0
pianote,Brian McKnight,Back At One,Back At One,R&B,7,200,brian-mcknight-back-at-one.jpg,brian-mcknight-back-at-one.pdf,Back At One,25,xMV4c,Published,0
pianote,Alicia Keys,'If I Ain''t Got You',The Diary of Alicia Keys,R&B,7,200,alicia-keys-the-diary-of-alicia-keys.jpg,alicia-keys-if-i-aint-got-you.pdf,'If I Ain''t Got You',25,-MV4c,Published,0
guitareo,B.B. King,Paying The Cost To Be The Boss,Blues On Top Of Blues,Blues,7,200,bb-king-blues-on-top-of-blues.jpg,,Paying The Cost To Be The Boss,25,JN5kc,Published,0
guitareo,Beyoncé,Halo,I Am... Sasha Fierce,PopRock,5,150,beyonce-i-am-sasha-fierce.jpg,,Halo,25,zDf4c,Published,0
guitareo,Billie Eilish,Bad Guy,When We All Fall Asleep Where Do We Go?,PopRock,5,150,billie-eilish-when-we-all-fall-asleep-where-do-we-go.jpg,,Bad Guy,25,dff4c,Published,0
guitareo,Bobby McFerrin,'Don''t Worry Be Happy',Simple Pleasures,PopRock,5,150,bobby-mcferrin-simple-pleasures.jpg,,'Don''t Worry Be Happy',25,P4c4c,Published,0
guitareo,'Booker T. & The M.G.''s',Green Onions,Green Onions,Blues,7,200,booker-t-and-the-mgs-green-onions.jpg,,Green Onions,25,M-mkc,Published,0
guitareo,Buddy Holly,'That''ll Be The Day',The Chirping Crickets,PopRock,8,200,buddy-holly-the-chirping-crickets.jpg,,'That''ll Be The Day',25,zzN4c,Published,0
guitareo,Maroon 5 feat. Christina Aguilera,Moves Like Jagger,Hands All Over,PopRock,7,200,maroon-5-feat-christina-aguilera-hands-all-over.jpg,,Moves Like Jagger,25,vpgkc,Published,0
guitareo,The Beatles,Blackbird,The Beatles (White Album),PopRock,8,200,the-beatles-the-beatles-white-album.jpg,,Blackbird,25,Mnmkc,Published,0
guitareo,The Black Keys,Lonely Boy,El Camino,PopRock,8,200,the-black-keys-el-camino.jpg,,Lonely Boy,25,NGc4c,Published,0
singeo,Norah Jones,'Don''t Know Why',Come Away with Me,PopRock,5,150,norah-jones-come-away-with-me.jpg,norah-jones-dont-know-why.pdf,'Don''t Know Why',25,R8D4c,Published,0
singeo,Carpenters,Hurting Each Other,A Song For You,PopRock,4,150,carpenters-a-song-for-you.jpg,carpenters-hurting-each-other.pdf,Hurting Each Other,25,f8D4c,Published,0
singeo,Elvis Presley,Blue Suede Shoes,Elvis Presley,PopRock,6,150,elvis-presley-elvis-presley.jpg,elvis-presley-blue-suede-shoes.pdf,Blue Suede Shoes,25,V8D4c,Published,0
singeo,Elvis Presley,Hound Dog,Hound Dog - Single,PopRock,6,150,elvis-presley-hound-dog-single.jpg,elvis-presley-hound-dog.pdf,Hound Dog,25,c8D4c,Published,0
singeo,Janis Joplin,Piece Of My Heart,Cheap Thrills (With Big Brother And The Holding Company),PopRock,5,150,janis-joplin-cheap-thrills-with-big-brother-and-the-holding-company.jpg,janis-joplin-piece-of-my-heart.pdf,Piece Of My Heart,25,N8D4c,Published,0
singeo,Katy Perry,I Kissed A Girl,One of the Boys,PopRock,6,150,katy-perry-one-of-the-boys.jpg,katy-perry-i-kissed-a-girl.pdf,I Kissed A Girl,25,p1D4c,Published,0
singeo,Katy Perry,Teenage Dream,Katy Perry,PopRock,6,150,katy-perry-katy-perry.jpg,katy-perry-teenage-dream.pdf,Teenage Dream,25,S1D4c,Published,0
singeo,Kelly Clarkson,Because Of You,Breakaway,PopRock,3,100,kelly-clarkson-breakaway.jpg,kelly-clarkson-because-of-you.pdf,Because Of You,25,v1D4c,Published,0
singeo,Lady Gaga,Bad Romance,The Fame Monster,PopRock,5,150,lady-gaga-the-fame-monster.jpg,lady-gaga-bad-romance.pdf,Bad Romance,25,m1D4c,Published,0
singeo,Lady Gaga,'I''ll Never Love Again',A Star Is Born: Original Motion Picture Soundtrack,Soundtrack,4,150,lady-gaga-a-star-is-born-original-motion-picture-soundtrack.jpg,lady-gaga-ill-never-love-again-.pdf,'I''ll Never Love Again',25,h1D4c,Published,0
";

        $array = explode("\n", $songsCSV);
        array_pop($array);
        $csv = array_map('str_getcsv', $array);
//        $csv = array_map('str_getcsv', file('TestBatchSongs.csv'));

        unset($csv[0]);

        $csv = array_slice($csv, 0, 250);

        foreach ($csv as $rowIndex => $row) {
            $content = $this->updateOrInsertAndGetFirst(
                'railcontent_content',
                [
                    'slug' => ContentHelper::slugify($row[1] . ' ' . $row[2]),
                    'type' => 'song',
                    'status' => 'published',
                    'brand' => $row[0],
                    'published_on' => '2022-12-02 00:00:00',
                    'language' => 'en-US',
                    'instrumentless' => $row[13]
                ],
                [
                    'created_on' => Carbon::now()->toDateTimeString(),
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
            $assignment = $this->updateOrInsertAndGetFirst(
                'railcontent_content',
                [
                    'slug' => ContentHelper::slugify($row[1] . ' - ' . $row[2]),
                    'type' => 'assignment',
                    'sort' => 0,
                    'status' => 'published',
                    'brand' => $row[0],
                    'language' => 'en-US',
                ],
                [
                    'published_on' => Carbon::now()->toDateTimeString(),
                    'created_on' => Carbon::now()->toDateTimeString(),
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

            $this->updateOrInsertAndGetFirst(
                'railcontent_content_hierarchy',
                [
                    'parent_id' => $content->id,
                    'child_id' => $assignment->id,
                    'child_position' => 1,
                ],
                [
                    'created_on' => Carbon::now()->toDateTimeString(),
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

        return $this->musoraDB()->from($table)->where(array_merge($attributes, $values))->get()->first();
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
    }
}
