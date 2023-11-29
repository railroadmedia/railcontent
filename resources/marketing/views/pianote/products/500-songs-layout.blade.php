@extends('pianote._partials.global-layout')

@section('global-head')
    <title>500 Songs In 5 Days | Pianote</title>
    <meta name="description" content="Develop The Skills To Play 500+ Songs On The Piano In 5 Days">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/og-image.jpg" style="display: none;">
    <meta property="og:title" content="500 Songs In 5 Days">
    <meta property="og:description" content="Develop The Skills To Play 500+ Songs On The Piano In 5 Days">
    <meta property="og:url" content="https://www.pianote.com/500-songs">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/500-songs-pianote.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
@stop

@section('global-body')
    @include('pianote.sales.partials._nav',[
         "cartVersion" => true
    ])

    {{--check blog sidebar--}}
    @hasSection('topbar')
        @yield('topbar')
    @endif

    <header class="header text-center">
        <div class="container">
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg" alt="500 songs logo">

            <br>
            <i class="fas fa-play play-vimeo autoplay-video" data-toggle="modal" data-target="#trailer"></i>
            {{--<h2>Develop The Skills To Play--}}
                {{--@hasSection('name')--}}
                   {{--songs by<br class="hidden-sm hidden-md hidden-lg"> <strong>@yield('name')</strong>--}}
                {{--@else--}}
                    {{--<strong>500+<br class="hidden-sm hidden-md hidden-lg"> Songs On The Piano</strong>--}}
                {{--@endif--}}
                {{--<em>In 5 Days</em></h2>--}}
            <h2>
                @hasSection('header-text')
                    @yield('header-text')
                @else
                    Play <strong>real songs</strong> from your very first lesson.<br class="hidden-xs">
                    Achieve your goals with <strong>500 Songs in 5 Days</strong>.
                @endif
            </h2>
            <a @hasSection('product-json')
                    class="join vue-add-to-cart" @yield('product-json')
                @else
                    class="join"
                @endif href="@yield('order-link')">Get Started &raquo;</a>
            <p class="breakdown">
                @hasSection('badge')
                    @yield('badge')
                @endif
                @if(floatval($productPrices['500-songs-in-5-days']->price) > $productPrice)
                        <s>NORMALLY ${{ floatval($productPrices['500-songs-in-5-days']->price) }}.</s> &nbsp;<strong><u>ONLY ${{ $productPrice }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * ($productPrice / floatval($productPrices['500-songs-in-5-days']->price)))) }}%)
                @else
                    <strong><u>ONLY ${{ $productPrice }}</u></strong>
                @endif
                    <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br>
                <strong class="yellow">** 90-DAY GUARANTEE **</strong></p>
            @yield('badge-2')
        </div>
    </header>

    <div class="modal fade text-center" id="trailer" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    @hasSection('video')
                        @yield('video')
                    @else
                        <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/347561373?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                    @endif
                </div>
                <a @hasSection('product-json')
                    class="join stop-play vue-add-to-cart" @yield('product-json')
                @else
                    class="join stop-play"
                @endif href="@yield('order-link')" data-dismiss="modal" aria-label="Close">Get Started</a>
            </div>
        </div>
    </div>


    @hasSection('banner')
        @yield('banner')
    @endif


    <section class="day-breakdown text-center">
        <div class="container">
            <h1>
                @hasSection('name')
                    The Fastest Way To Learn How To <br class="hidden-xs">
                    Play Songs By @yield('name') — And Tons <br class="hidden-xs">
                    Of Popular Artists — <u>For Just ${{ $productPrice }}
                    </u>
                @else
                    The Fastest Way To Learn How<br class="hidden-xs"> To Play Songs — <u>For Just ${{ $productPrice }}</u>
                @endif
            </h1>
            @if(floatval($productPrices['500-songs-in-5-days']->price) > $productPrice)
                <h3><em><s>NORMALLY ${{ floatval($productPrices['500-songs-in-5-days']->price) }}</s></em></h3>
                @else

                <h3>&nbsp;</h3>
            @endif
            <div class="day-slice">
                <div class="day-thumbnail @hasSection('lesson-watched') watched @endif">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/the-songs.jpg" alt="Day 1 thumbnail">
                    @hasSection('lesson-watched')
                        <div class="badge-watched">WATCHED</div>
                    @endif
                    <div class="top-badge">DAY 1</div>
                    <div class="bottom-badge hide">14:48</div>
                </div>
                <p><strong>The Song Chords</strong><br>
                    Learn the basic chords used in hundreds of popular songs and how to order them to instantly play dozens of songs in just a few minutes.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/the-order.jpg" alt="Day 2 thumbnail">
                    <div class="top-badge">DAY 2</div>
                    <div class="bottom-badge hide">13:43</div>
                </div>
                <p><strong>The Order</strong><br>
                    How to order (and re-order) chords in progressions that you KNOW will sound good. You’ll learn how this is done in popular music, and just how common it is.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/adding-style-flair.jpg" alt="Day 3 thumbnail">
                    <div class="top-badge">DAY 3</div>
                    <div class="bottom-badge hide">11:37</div>
                </div>
                <p><strong>Adding Style & Flair</strong><br>
                    Tips to make you instantly sound better - by adding complexity and fills to your chording. This includes walking basslines, chord fills, and a look at new rhythms.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/inversions.jpg" alt="Day 4 thumbnail">
                    <div class="top-badge">DAY 4</div>
                    <div class="bottom-badge hide">15:09</div>
                </div>
                <p><strong>The Inversions</strong><br>
                    Learn big concepts that will have a HUGE impact on your playing. Get a deep understanding of inversions and how to build them. And more importantly how to use them in songs.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/the-key.jpg" alt="Day  thumbnail">
                    <div class="top-badge">DAY 5</div>
                    <div class="bottom-badge hide">11:22</div>
                </div>
                <p><strong>The Keys</strong><br>
                    How to transpose and play chords in any key. How to know what notes are in each key, thanks to the Circle of 5ths.
                </p>
            </div>
            <hr>
            <div class="day-slice bonus">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/complex-chords.jpg" alt="Bonus 1 thumbnail">
                    <div class="top-badge">BONUS #1</div>
                    <div class="bottom-badge hide">15:13</div>
                </div>
                <p><strong>Complex Chords</strong><br>
                    How to build more complicated and bigger chords. How to also play any chords that are NOT in the original key. How to build a chord on ANY key of the piano.
                </p>
            </div>
            <div class="day-slice bonus">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/the-melody.jpg" alt="Bonus 2 thumbnail">
                    <div class="top-badge">BONUS #2</div>
                    <div class="bottom-badge hide">9:08</div>
                </div>
                <p><strong>The Melody</strong><br>
                    Find and play the melody to any song by basing it on the chord progression we are using. Develop ear training to improve your ability to ‘hear’ and then play melodies.
                </p>
            </div>
        </div>
    </section>

    <div id="moreSongs" class="anchor"></div>
    <section class="more-songs">
        <div class="container">
            <img class="yellow-red-icons" src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/more-songs-icons.png" alt="More songs icon">
            <h1>More Songs Than<br class="hidden-sm hidden-md hidden-lg"> You'll Ever Need</h1>
            <h4>This training pack will teach you the skills to <em>play nearly any popular song on the piano</em> using chord charts. We won’t take up hours of your time to do this — because we know you’d rather be playing songs than watching videos.
                <br><br>
                But here at Pianote, we do believe in over-delivering. So beyond the five lessons that will teach you how to play 500 songs AND the two bonus lessons, you’ll also get:
                <br><br>
                <strong>Downloadable chord charts for 500 SONGS that are yours to keep FOREVER!</strong>
                <br><br>
                Here's an example: <a target="_blank" href="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-let-it-be-the-beatles.pdf"><u>Open PDF &raquo;</u></a>
                <br><br>
                Don’t believe us? Here is every song that’s included:
            </h4>
            @hasSection('albums-url')
                <img class="album-banner" src="@yield('albums-url')">
            @endif
            <div class="song-list">
                <div class="song"><span class="artist">ABBA</span><br><strong>Dancing Queen</strong></div>
                <div class="song"><span class="artist">ABBA</span><br><strong>Waterloo</strong></div>
                <div class="song"><span class="artist">ABBA</span><br><strong>Thank You For The Music</strong></div>
                <div class="song"><span class="artist">Ace of Base</span><br><strong>Beautiful Life</strong></div>
                <div class="song"><span class="artist">Ace of Base</span><br><strong>The Sign</strong></div>
                <div class="song"><span class="artist">Adele</span><br><strong>Hello</strong></div>
                <div class="song"><span class="artist">Adele</span><br><strong>Make You Feel My Love</strong></div>
                <div class="song"><span class="artist">Adele</span><br><strong>Remedy</strong></div>
                <div class="song"><span class="artist">Adele</span><br><strong>Rolling In The Deep</strong></div>
                <div class="song"><span class="artist">Adele</span><br><strong>Set Fire To The Rain</strong></div>
                <div class="song"><span class="artist">Adele</span><br><strong>Skyfall</strong></div>
                <div class="song"><span class="artist">Adele</span><br><strong>Someone Like You</strong></div>
                <div class="song"><span class="artist">Aerosmith</span><br><strong>I Don’t Want To Miss A Thing</strong></div>
                <div class="song"><span class="artist">Air Supply</span><br><strong>All Out Of Love</strong></div>
                <div class="song"><span class="artist">Alan Walker</span><br><strong>All Falls Down</strong></div>
                <div class="song"><span class="artist">Alan Walker</span><br><strong>Faded</strong></div>
                <div class="song"><span class="artist">Alanis Morissette</span><br><strong>Ironic</strong></div>
                <div class="song"><span class="artist">Alessia Cara</span><br><strong>How Far I’ll Go</strong></div>
                <div class="song"><span class="artist">Alessia Cara</span><br><strong>Scars To Your Beautiful</strong></div>
                <div class="song"><span class="artist">Alessia Cara</span><br><strong>Wild Things</strong></div>
                <div class="song"><span class="artist">Alicia Keys</span><br><strong>Empire State Of Mind</strong></div>
                <div class="song"><span class="artist">Alicia Keys</span><br><strong>Fallin’</strong></div>
                <div class="song"><span class="artist">Alicia Keys</span><br><strong>No One</strong></div>
                <div class="song"><span class="artist">All-4-One</span><br><strong>I Swear</strong></div>
                <div class="song"><span class="artist">Amy Winehouse</span><br><strong>Rehab</strong></div>
                <div class="song"><span class="artist">Ana Nalick</span><br><strong>Breathe</strong></div>
                <div class="song"><span class="artist">Andra Day</span><br><strong>Rise Up</strong></div>
                <div class="song"><span class="artist">Anna Kendrick</span><br><strong>When I’m Gone</strong></div>
                <div class="song"><span class="artist">The Archies</span><br><strong>Sugar, Sugar</strong></div>
                <div class="song"><span class="artist">Aretha Franklin</span><br><strong>I Say A Little Prayer</strong></div>
                <div class="song"><span class="artist">Aretha Franklin</span><br><strong>Respect</strong></div>
                <div class="song"><span class="artist">Ariana Grande</span><br><strong>Breathin</strong></div>
                <div class="song"><span class="artist">Ariana Grande</span><br><strong>Thank U, Next</strong></div>
                <div class="song"><span class="artist">Ariana Grande</span><br><strong>No Tears Left To Cry</strong></div>
                <div class="song"><span class="artist">Audioslave</span><br><strong>Like A Stone</strong></div>
                <div class="song"><span class="artist">Ava Max</span><br><strong>Sweet But Psycho</strong></div>
                <div class="song"><span class="artist">Avicii</span><br><strong>Hey Brother</strong></div>
                <div class="song"><span class="artist">Avicii</span><br><strong>Wake Me Up</strong></div>
                <div class="song"><span class="artist">Avril Lavigne</span><br><strong>Complicated</strong></div>
                <div class="song"><span class="artist">Avril Lavigne</span><br><strong>Girlfriend</strong></div>
                <div class="song"><span class="artist">Avril Lavigne</span><br><strong>I’m With You</strong></div>
                <div class="song"><span class="artist">Avril Lavigne</span><br><strong>Keep Holding On</strong></div>
                <div class="song"><span class="artist">Avril Lavigne</span><br><strong>My Happy Ending</strong></div>
                <div class="song"><span class="artist">Backstreet Boys</span><br><strong>I Want It That Way</strong></div>
                <div class="song"><span class="artist">The Bangles</span><br><strong>Eternal Flame</strong></div>
                <div class="song"><span class="artist">The Bangles</span><br><strong>Manic Monday</strong></div>
                <div class="song"><span class="artist">Bastille</span><br><strong>Pompeii</strong></div>
                <div class="song"><span class="artist">The Beatles</span><br><strong>All You Need Is Love</strong></div>
                <div class="song"><span class="artist">The Beatles</span><br><strong>Come Together</strong></div>
                <div class="song"><span class="artist">The Beatles</span><br><strong>Here Comes The Sun</strong></div>
                <div class="song"><span class="artist">The Beatles</span><br><strong>Hey Jude</strong></div>
                <div class="song"><span class="artist">The Beatles</span><br><strong>Let It Be</strong></div>
                <div class="song"><span class="artist">The Beatles</span><br><strong>Penny Lane</strong></div>
                <div class="song"><span class="artist">The Beatles</span><br><strong>Yellow Submarine</strong></div>
                <div class="song"><span class="artist">Bebe Rexha</span><br><strong>Meant To Be</strong></div>
                <div class="song"><span class="artist">Belinda Carlisle</span><br><strong>Heaven Is A Place On Earth</strong></div>
                <div class="song"><span class="artist">Belinda Carlisle</span><br><strong>Mad About You</strong></div>
                <div class="song"><span class="artist">Benny Blanco, Halsey, & Khalid</span><br><strong>Eastside</strong></div>
                <div class="song"><span class="artist">Berlin</span><br><strong>Take My Breath Away</strong></div>
                <div class="song"><span class="artist">Bette Midler</span><br><strong>From A Distance</strong></div>
                <div class="song"><span class="artist">Bette Midler</span><br><strong>The Rose</strong></div>
                <div class="song"><span class="artist">Bette Midler</span><br><strong>Wind Beneath My Wings</strong></div>
                <div class="song"><span class="artist">Beyoncé</span><br><strong>Halo</strong></div>
                <div class="song"><span class="artist">Beyoncé</span><br><strong>If I Were A Boy</strong></div>
                <div class="song"><span class="artist">Beyoncé</span><br><strong>Irreplaceable</strong></div>
                <div class="song"><span class="artist">Beyoncé</span><br><strong>I Was Here</strong></div>
                <div class="song"><span class="artist">Billie Eilish</span><br><strong>Bad Guy</strong></div>
                <div class="song"><span class="artist">Billie Eilish</span><br><strong>Bury A Friend</strong></div>
                <div class="song"><span class="artist">Billie Eilish</span><br><strong>Ocean Eyes</strong></div>
                <div class="song"><span class="artist">Billy Joel</span><br><strong>Piano Man</strong></div>
                <div class="song"><span class="artist">Billy Joel</span><br><strong>Uptown Girl</strong></div>
                <div class="song"><span class="artist">Bill Withers</span><br><strong>Ain’t No Sunshine</strong></div>
                <div class="song"><span class="artist">Blue Rodeo</span><br><strong>5 Days In May</strong></div>
                <div class="song"><span class="artist">Blake Shelton</span><br><strong>God Gave Me You</strong></div>
                <div class="song"><span class="artist">Blake Shelton</span><br><strong>Sangria</strong></div>
                <div class="song"><span class="artist">Bob Dylan</span><br><strong>Knockin’ On Heaven’s Door</strong></div>
                <div class="song"><span class="artist">Bob Dylan</span><br><strong>Lay, Lady, Lay</strong></div>
                <div class="song"><span class="artist">Bob Dylan</span><br><strong>Like A Rolling Stone</strong></div>
                <div class="song"><span class="artist">Bobby McFerrin</span><br><strong>Don’t Worry Be Happy</strong></div>
                <div class="song"><span class="artist">Bon Iver</span><br><strong>Skinny Love</strong></div>
                <div class="song"><span class="artist">Bon Jovi</span><br><strong>Livin’ On A Prayer</strong></div>
                <div class="song"><span class="artist">Bonnie Raitt</span><br><strong>I Can’t Make You Love Me</strong></div>
                <div class="song"><span class="artist">Bonnie Tyler</span><br><strong>Total Eclipse Of The Heart</strong></div>
                <div class="song"><span class="artist">Brandi Carlile</span><br><strong>The Story</strong></div>
                <div class="song"><span class="artist">Brett Young</span><br><strong>Mercy</strong></div>
                <div class="song"><span class="artist">Britney Spears</span><br><strong>Toxic</strong></div>
                <div class="song"><span class="artist">Bruce Springsteen</span><br><strong>Dancing In The Dark</strong></div>
                <div class="song"><span class="artist">Bruno Mars</span><br><strong>Count On Me</strong></div>
                <div class="song"><span class="artist">Bruno Mars</span><br><strong>Grenade</strong></div>
                <div class="song"><span class="artist">Bruno Mars</span><br><strong>Just The Way You Are</strong></div>
                <div class="song"><span class="artist">Bruno Mars</span><br><strong>When I Was Your Man</strong></div>
                <div class="song"><span class="artist">Bryan Adams</span><br><strong>(Everything I Do) I Do It For You</strong></div>
                <div class="song"><span class="artist">Bryan Adams</span><br><strong>Heaven</strong></div>
                <div class="song"><span class="artist">Bryan Adams</span><br><strong>Summer of ‘69</strong></div>
                <div class="song"><span class="artist">Bush</span><br><strong>Glycerine</strong></div>
                <div class="song"><span class="artist">The Calling</span><br><strong>Wherever You Will Go</strong></div>
                <div class="song"><span class="artist">Camila Cabello</span><br><strong>Havana</strong></div>
                <div class="song"><span class="artist">Carly Rae Jepsen</span><br><strong>Call Me Maybe</strong></div>
                <div class="song"><span class="artist">Carly Rae Jepsen</span><br><strong>I Really Like You</strong></div>
                <div class="song"><span class="artist">Carly Simon</span><br><strong>You’re So Vain</strong></div>
                <div class="song"><span class="artist">Carrie Underwood</span><br><strong>Jesus, Take The Wheel</strong></div>
                <div class="song"><span class="artist">Cat Stevens</span><br><strong>Morning Has Broken</strong></div>
                <div class="song"><span class="artist">Cat Stevens</span><br><strong>Wild World</strong></div>
                <div class="song"><span class="artist">Celine Dion</span><br><strong>All By Myself</strong></div>
                <div class="song"><span class="artist">Celine Dion</span><br><strong>Beauty And The Beast</strong></div>
                <div class="song"><span class="artist">Celine Dion</span><br><strong>Because You Loved Me</strong></div>
                <div class="song"><span class="artist">Celine Dion</span><br><strong>My Heart Will Go On</strong></div>
                <div class="song"><span class="artist">Celine Dion</span><br><strong>A New Day Has Come</strong></div>
                <div class="song"><span class="artist">Celine Dion</span><br><strong>The Power Of Love</strong></div>
                <div class="song"><span class="artist">The Chainsmokers</span><br><strong>Closer</strong></div>
                <div class="song"><span class="artist">The Chainsmokers</span><br><strong>Paris</strong></div>
                <div class="song"><span class="artist">The Chainsmokers</span><br><strong>This Feeling</strong></div>
                <div class="song"><span class="artist">The Chainsmokers & Coldplay</span><br><strong>Something Just Like This</strong></div>
                <div class="song"><span class="artist">Chantal Kreviazuk</span><br><strong>Feels Like Home</strong></div>
                <div class="song"><span class="artist">Charlie Puth</span><br><strong>Attention</strong></div>
                <div class="song"><span class="artist">Cheat Codes</span><br><strong>No Promises</strong></div>
                <div class="song"><span class="artist">Cher</span><br><strong>Believe</strong></div>
                <div class="song"><span class="artist">Chicago</span><br><strong>Hard To Say I’m Sorry</strong></div>
                <div class="song"><span class="artist">Chris Isaak</span><br><strong>Wicked Game</strong></div>
                <div class="song"><span class="artist">Christina Aguilera</span><br><strong>Beautiful</strong></div>
                <div class="song"><span class="artist">Christina Aguilera</span><br><strong>Reflection</strong></div>
                <div class="song"><span class="artist">Christina Perri</span><br><strong>Jar Of Hearts</strong></div>
                <div class="song"><span class="artist">Christina Perri</span><br><strong>A Thousand Years</strong></div>
                <div class="song"><span class="artist">Colbie Caillat</span><br><strong>Bubbly</strong></div>
                <div class="song"><span class="artist">Colbie Caillat</span><br><strong>Realize</strong></div>
                <div class="song"><span class="artist">Colbie Caillat</span><br><strong>Try</strong></div>
                <div class="song"><span class="artist">Coldplay</span><br><strong>Clocks</strong></div>
                <div class="song"><span class="artist">Coldplay</span><br><strong>Fix You</strong></div>
                <div class="song"><span class="artist">Coldplay</span><br><strong>The Scientist</strong></div>
                <div class="song"><span class="artist">Coldplay</span><br><strong>Speed Of Sound</strong></div>
                <div class="song"><span class="artist">The Cranberries</span><br><strong>Zombie</strong></div>
                <div class="song"><span class="artist">Creed</span><br><strong>With Arms Wide Open</strong></div>
                <div class="song"><span class="artist">Creedence Clearwater Revival</span><br><strong>Bad Moon Rising</strong></div>
                <div class="song"><span class="artist">Creedence Clearwater Revival</span><br><strong>Have You Ever Seen The Rain?</strong></div>
                <div class="song"><span class="artist">Cutting Crew</span><br><strong>(I Just) Died In Your Arms</strong></div>
                <div class="song"><span class="artist">Cyndi Lauper</span><br><strong>All Through The Night</strong></div>
                <div class="song"><span class="artist">Cyndi Lauper</span><br><strong>Girls Just Want To Have Fun</strong></div>
                <div class="song"><span class="artist">Cyndi Lauper</span><br><strong>Time After Time</strong></div>
                <div class="song"><span class="artist">Cyndi Lauper</span><br><strong>True Colors</strong></div>
                <div class="song"><span class="artist">Dan + Shay</span><br><strong>Tequila</strong></div>
                <div class="song"><span class="artist">Daniel Powter</span><br><strong>Bad Day</strong></div>
                <div class="song"><span class="artist">David Guetta</span><br><strong>Titanium</strong></div>
                <div class="song"><span class="artist">Demi Lovato</span><br><strong>Skyscraper</strong></div>
                <div class="song"><span class="artist">Demi Lovato</span><br><strong>Stone Cold</strong></div>
                <div class="song"><span class="artist">Diana Ross & Lionel Richie</span><br><strong>Endless Love</strong></div>
                <div class="song"><span class="artist">Dido</span><br><strong>Here With Me</strong></div>
                <div class="song"><span class="artist">Dido</span><br><strong>Thank You</strong></div>
                <div class="song"><span class="artist">Dido</span><br><strong>White Flag</strong></div>
                <div class="song"><span class="artist">Dobie Gray</span><br><strong>Drift Away</strong></div>
                <div class="song"><span class="artist">Dolly Parton</span><br><strong>Jolene</strong></div>
                <div class="song"><span class="artist">The Doors</span><br><strong>Riders On The Storm</strong></div>
                <div class="song"><span class="artist">Dua Lipa</span><br><strong>New Rules</strong></div>
                <div class="song"><span class="artist">Duffy</span><br><strong>Mercy</strong></div>
                <div class="song"><span class="artist">Dusty Springfield</span><br><strong>Son Of A Preacher Man</strong></div>
                <div class="song"><span class="artist">Eagle-Eye Cherry</span><br><strong>Save Tonight</strong></div>
                <div class="song"><span class="artist">Eagles</span><br><strong>Desperado</strong></div>
                <div class="song"><span class="artist">Eagles</span><br><strong>Hotel California</strong></div>
                <div class="song"><span class="artist">Ed Sheeran</span><br><strong>Perfect</strong></div>
                <div class="song"><span class="artist">Ed Sheeran</span><br><strong>Photograph</strong></div>
                <div class="song"><span class="artist">Ed Sheeran</span><br><strong>Shape Of You</strong></div>
                <div class="song"><span class="artist">Ed Sheeran</span><br><strong>Thinking Out Loud</strong></div>
                <div class="song"><span class="artist">Edwin Hawkins Singers</span><br><strong>Oh Happy Day</strong></div>
                <div class="song"><span class="artist">Edwin McCain</span><br><strong>I’ll Be</strong></div>
                <div class="song"><span class="artist">Ella Fitzgerald</span><br><strong>Dream A Little Dream</strong></div>
                <div class="song"><span class="artist">Ellie Goulding</span><br><strong>Lights</strong></div>
                <div class="song"><span class="artist">Ellie Goulding</span><br><strong>Love Me Like You Do</strong></div>
                <div class="song"><span class="artist">Ellie Goulding, Diplo, & Swae Lee</span><br><strong>Close To Me</strong></div>
                <div class="song"><span class="artist">Elton John</span><br><strong>Candle In The Wind</strong></div>
                <div class="song"><span class="artist">Elton John</span><br><strong>Can You Feel The Love Tonight</strong></div>
                <div class="song"><span class="artist">Elton John</span><br><strong>Don’t Let The Sun Go Down On Me</strong></div>
                <div class="song"><span class="artist">Elton John</span><br><strong>Goodbye Yellow Brick Road</strong></div>
                <div class="song"><span class="artist">Elton John</span><br><strong>Rocket Man</strong></div>
                <div class="song"><span class="artist">Elton John</span><br><strong>Your Song</strong></div>
                <div class="song"><span class="artist">Elvis Presley</span><br><strong>Can’t Help Falling In Love</strong></div>
                <div class="song"><span class="artist">Eminem</span><br><strong>Love The Way You Lie</strong></div>
                <div class="song"><span class="artist">Enrique Iglesias</span><br><strong>Hero</strong></div>
                <div class="song"><span class="artist">Enya</span><br><strong>May It Be</strong></div>
                <div class="song"><span class="artist">Eric Carmen</span><br><strong>Hungry Eyes</strong></div>
                <div class="song"><span class="artist">Eurythmics</span><br><strong>Here Comes The Rain Again</strong></div>
                <div class="song"><span class="artist">Evanescence</span><br><strong>Bring Me To Life</strong></div>
                <div class="song"><span class="artist">Evanescence</span><br><strong>My Immortal</strong></div>
                <div class="song"><span class="artist">Feist</span><br><strong>My Moon My Man</strong></div>
                <div class="song"><span class="artist">Feist</span><br><strong>1234</strong></div>
                <div class="song"><span class="artist">Fergie</span><br><strong>Big Girls Don’t Cry</strong></div>
                <div class="song"><span class="artist">Five For Fighting</span><br><strong>Superman (It’s Not Easy)</strong></div>
                <div class="song"><span class="artist">Fleetwood Mac</span><br><strong>Little Lies</strong></div>
                <div class="song"><span class="artist">Florida Georgia Line</span><br><strong>Cruise</strong></div>
                <div class="song"><span class="artist">Foster The People</span><br><strong>Pumped Up Kicks</strong></div>
                <div class="song"><span class="artist">The Foundations</span><br><strong>Build Me Up Buttercup</strong></div>
                <div class="song"><span class="artist">Frank Sinatra</span><br><strong>I Fly Me To The Moon</strong></div>
                <div class="song"><span class="artist">Frank Sinatra</span><br><strong>The Way You Look Tonight</strong></div>
                <div class="song"><span class="artist">The Fray</span><br><strong>How To Save A Life</strong></div>
                <div class="song"><span class="artist">The Fray</span><br><strong>Over My Head (Cable Car)</strong></div>
                <div class="song"><span class="artist">Fun.</span><br><strong>Some Nights</strong></div>
                <div class="song"><span class="artist">Fun.</span><br><strong>We Are Young</strong></div>
                <div class="song"><span class="artist">Gavin DeGraw</span><br><strong>Not Over You</strong></div>
                <div class="song"><span class="artist">George Michael</span><br><strong>Faith</strong></div>
                <div class="song"><span class="artist">Gloria Gaynor</span><br><strong>I Will Survive</strong></div>
                <div class="song"><span class="artist">Gnarles Barkley</span><br><strong>Crazy</strong></div>
                <div class="song"><span class="artist">Goo Goo Dolls</span><br><strong>Iris</strong></div>
                <div class="song"><span class="artist">Goo Goo Dolls</span><br><strong>Slide</strong></div>
                <div class="song"><span class="artist">Gordon Lightfoot</span><br><strong>If You Could Read My Mind</strong></div>
                <div class="song"><span class="artist">Gotye</span><br><strong>Somebody That I Used To Know</strong></div>
                <div class="song"><span class="artist">A Great Big World & Christina Aguilera</span><br><strong>Say Something</strong></div>
                <div class="song"><span class="artist">Green Day</span><br><strong>Wake Me Up When September Ends</strong></div>
                <div class="song"><span class="artist">Guns N’ Roses</span><br><strong>Sweet Child O’ Mine</strong></div>
                <div class="song"><span class="artist">Gwen Stefani</span><br><strong>The Sweet Escape</strong></div>
                <div class="song"><span class="artist">Hailee Steinfield</span><br><strong>Starving</strong></div>
                <div class="song"><span class="artist">Hailee Steinfeld & Alesso</span><br><strong>Let Me Go</strong></div>
                <div class="song"><span class="artist">Halsey</span><br><strong>Without Me</strong></div>
                <div class="song"><span class="artist">Hank Williams</span><br><strong>I Saw The Light</strong></div>
                <div class="song"><span class="artist">Harry Styles</span><br><strong>Sign Of The Times</strong></div>
                <div class="song"><span class="artist">Heart</span><br><strong>Alone</strong></div>
                <div class="song"><span class="artist">Hillsong</span><br><strong>Mighty To Save</strong></div>
                <div class="song"><span class="artist">Holiday</span><br><strong>Deck The Halls</strong></div>
                <div class="song"><span class="artist">Holiday</span><br><strong>Jingle Bells</strong></div>
                <div class="song"><span class="artist">Holiday</span><br><strong>Joy To The World</strong></div>
                <div class="song"><span class="artist">Holiday</span><br><strong>Let It Snow</strong></div>
                <div class="song"><span class="artist">Holiday</span><br><strong>O Holy Night</strong></div>
                <div class="song"><span class="artist">Holiday</span><br><strong>Silent Night</strong></div>
                <div class="song"><span class="artist">Holiday</span><br><strong>Winter Wonderland</strong></div>
                <div class="song"><span class="artist">Hoobastank</span><br><strong>The Reason</strong></div>
                <div class="song"><span class="artist">Hootie & The Blowfish</span><br><strong>Only Wanna Be With You</strong></div>
                <div class="song"><span class="artist">Howie Day</span><br><strong>Collide</strong></div>
                <div class="song"><span class="artist">Hozier</span><br><strong>Take Me To Church</strong></div>
                <div class="song"><span class="artist">Hymn</span><br><strong>Amazing Grace</strong></div>
                <div class="song"><span class="artist">Hymn</span><br><strong>How Great Thou Art</strong></div>
                <div class="song"><span class="artist">Idina Menzel</span><br><strong>Let It Go</strong></div>
                <div class="song"><span class="artist">Ike & Tina Turner</span><br><strong>Proud Mary</strong></div>
                <div class="song"><span class="artist">Imagine Dragons</span><br><strong>Bad Liar</strong></div>
                <div class="song"><span class="artist">Imagine Dragons</span><br><strong>Believer</strong></div>
                <div class="song"><span class="artist">Imagine Dragons</span><br><strong>Whatever It Takes</strong></div>
                <div class="song"><span class="artist">Ingrid Michaelson</span><br><strong>The Way I Am</strong></div>
                <div class="song"><span class="artist">James Arthur</span><br><strong>Say You Won’t Let Go</strong></div>
                <div class="song"><span class="artist">James Blunt</span><br><strong>You’re Beautiful</strong></div>
                <div class="song"><span class="artist">James Taylor</span><br><strong>Fire and Rain</strong></div>
                <div class="song"><span class="artist">Jann Arden</span><br><strong>Good Mother</strong></div>
                <div class="song"><span class="artist">Jann Arden</span><br><strong>Insensitive</strong></div>
                <div class="song"><span class="artist">Janis Joplin</span><br><strong>Me And Bobby McGee</strong></div>
                <div class="song"><span class="artist">Jason Derulo</span><br><strong>Whatcha Say</strong></div>
                <div class="song"><span class="artist">Jason Mraz</span><br><strong>I’m Yours</strong></div>
                <div class="song"><span class="artist">Jason Mraz</span><br><strong>I Won’t Give Up</strong></div>
                <div class="song"><span class="artist">Jennifer Lopez</span><br><strong>If You Had My Love</strong></div>
                <div class="song"><span class="artist">Jesse J</span><br><strong>Flashlight</strong></div>
                <div class="song"><span class="artist">Jewel</span><br><strong>Foolish Games</strong></div>
                <div class="song"><span class="artist">Jewel</span><br><strong>Hands</strong></div>
                <div class="song"><span class="artist">Jim Cuddy</span><br><strong>Pull Me Through</strong></div>
                <div class="song"><span class="artist">Jimmy Eat World</span><br><strong>The Middle</strong></div>
                <div class="song"><span class="artist">Joan Osborne</span><br><strong>One Of Us</strong></div>
                <div class="song"><span class="artist">John Mellencamp</span><br><strong>Jack & Diane</strong></div>
                <div class="song"><span class="artist">John Mellencamp</span><br><strong>Pink Houses</strong></div>
                <div class="song"><span class="artist">John Denver</span><br><strong>Take Me Home, Country Roads</strong></div>
                <div class="song"><span class="artist">John Denver</span><br><strong>Leaving On A Jet Plane</strong></div>
                <div class="song"><span class="artist">John Legend</span><br><strong>All Of Me</strong></div>
                <div class="song"><span class="artist">John Mayer</span><br><strong>Waiting On The World To Change</strong></div>
                <div class="song"><span class="artist">Johnny Cash</span><br><strong>Hurt</strong></div>
                <div class="song"><span class="artist">Johnny Cash</span><br><strong>Ring Of Fire</strong></div>
                <div class="song"><span class="artist">Johnny Nash</span><br><strong>I Can See Clearly Now</strong></div>
                <div class="song"><span class="artist">Jonas Brothers</span><br><strong>Sucker</strong></div>
                <div class="song"><span class="artist">Joni Mitchell</span><br><strong>Big Yellow Taxi</strong></div>
                <div class="song"><span class="artist">Joni Mitchell</span><br><strong>River</strong></div>
                <div class="song"><span class="artist">Jordin Sparks</span><br><strong>Battlefield</strong></div>
                <div class="song"><span class="artist">Jordin Sparks</span><br><strong>Tattoo</strong></div>
                <div class="song"><span class="artist">Joseph Vincent</span><br><strong>Can’t Take My Eyes Off You</strong></div>
                <div class="song"><span class="artist">Josh Groban</span><br><strong>You Raise Me Up</strong></div>
                <div class="song"><span class="artist">Journey</span><br><strong>Don’t Stop Believin’</strong></div>
                <div class="song"><span class="artist">Journey</span><br><strong>Faithfully</strong></div>
                <div class="song"><span class="artist">Journey</span><br><strong>Open Arms</strong></div>
                <div class="song"><span class="artist">Judy Garland</span><br><strong>Over The Rainbow</strong></div>
                <div class="song"><span class="artist">Judy Kuhn</span><br><strong>Colors Of The Wind</strong></div>
                <div class="song"><span class="artist">Juice Newton</span><br><strong>Queen Of Hearts</strong></div>
                <div class="song"><span class="artist">Juice Newton</span><br><strong>Angel Of The Morning</strong></div>
                <div class="song"><span class="artist">Justin Bieber</span><br><strong>Baby</strong></div>
                <div class="song"><span class="artist">Justin Bieber</span><br><strong>Love Yourself</strong></div>
                <div class="song"><span class="artist">Justin Bieber & BloodPop</span><br><strong>Friends</strong></div>
                <div class="song"><span class="artist">Justin Timberlake</span><br><strong>Cry Me A River</strong></div>
                <div class="song"><span class="artist">Kansas</span><br><strong>Dust In The Wind</strong></div>
                <div class="song"><span class="artist">Katy Perry</span><br><strong>Firework</strong></div>
                <div class="song"><span class="artist">Katy Perry</span><br><strong>Hot N Cold</strong></div>
                <div class="song"><span class="artist">Katy Perry</span><br><strong>Last Friday Night (T.G.I.F.)</strong></div>
                <div class="song"><span class="artist">Katy Perry</span><br><strong>Roar</strong></div>
                <div class="song"><span class="artist">Katy Perry</span><br><strong>Unconditionally</strong></div>
                <div class="song"><span class="artist">Kelly Clarkson</span><br><strong>Already Gone</strong></div>
                <div class="song"><span class="artist">Kelly Clarkson</span><br><strong>Behind These Hazel Eyes</strong></div>
                <div class="song"><span class="artist">Kelly Clarkson</span><br><strong>Breakaway</strong></div>
                <div class="song"><span class="artist">Kelly Clarkson</span><br><strong>Catch My Breath</strong></div>
                <div class="song"><span class="artist">Kelly Clarkson</span><br><strong>Since U Been Gone</strong></div>
                <div class="song"><span class="artist">Kelly Clarkson</span><br><strong>Stronger</strong></div>
                <div class="song"><span class="artist">Kenny Loggins</span><br><strong>Footloose</strong></div>
                <div class="song"><span class="artist">Kenny Rogers</span><br><strong>The Gambler</strong></div>
                <div class="song"><span class="artist">Kid Rock & Sheryl Crow</span><br><strong>Picture</strong></div>
                <div class="song"><span class="artist">The Killers</span><br><strong>Mr. Brightside</strong></div>
                <div class="song"><span class="artist">Kodaline</span><br><strong>All I Want</strong></div>
                <div class="song"><span class="artist">Lady Antebellum</span><br><strong>Need You Now</strong></div>
                <div class="song"><span class="artist">Lady Gaga</span><br><strong>The Edge Of Glory</strong></div>
                <div class="song"><span class="artist">Lady Gaga</span><br><strong>A Million Reasons</strong></div>
                <div class="song"><span class="artist">Lady Gaga</span><br><strong>Paparazzi</strong></div>
                <div class="song"><span class="artist">Lady Gaga</span><br><strong>Poker Face</strong></div>
                <div class="song"><span class="artist">Lady Gaga & Bradley Cooper</span><br><strong>Shallow</strong></div>
                <div class="song"><span class="artist">Lauren Daigle</span><br><strong>You Say</strong></div>
                <div class="song"><span class="artist">Lenka</span><br><strong>The Show</strong></div>
                <div class="song"><span class="artist">LeAnn Rimes</span><br><strong>How Do I Live?</strong></div>
                <div class="song"><span class="artist">Leona Lewis</span><br><strong>Bleeding Love</strong></div>
                <div class="song"><span class="artist">Lifehouse</span><br><strong>You And Me</strong></div>
                <div class="song"><span class="artist">Lifehouse</span><br><strong>Hanging By A Moment</strong></div>
                <div class="song"><span class="artist">Linkin Park</span><br><strong>Heavy</strong></div>
                <div class="song"><span class="artist">Linkin Park</span><br><strong>Numb</strong></div>
                <div class="song"><span class="artist">Linkin Park</span><br><strong>One More Light</strong></div>
                <div class="song"><span class="artist">Lionel Richie</span><br><strong>Hello</strong></div>
                <div class="song"><span class="artist">Lisa Loeb</span><br><strong>I Do</strong></div>
                <div class="song"><span class="artist">Little Big Town</span><br><strong>Girl Crush</strong></div>
                <div class="song"><span class="artist">Live</span><br><strong>Lightning Crashes</strong></div>
                <div class="song"><span class="artist">Lonestar</span><br><strong>Amazed</strong></div>
                <div class="song"><span class="artist">Lonestar</span><br><strong>I’m Already There</strong></div>
                <div class="song"><span class="artist">Lorde</span><br><strong>Green Light</strong></div>
                <div class="song"><span class="artist">Lorde</span><br><strong>Royals</strong></div>
                <div class="song"><span class="artist">Louis Armstrong</span><br><strong>What A Wonderful World</strong></div>
                <div class="song"><span class="artist">Luke Bryan</span><br><strong>Play It Again</strong></div>
                <div class="song"><span class="artist">The Lumineers</span><br><strong>Ho Hey</strong></div>
                <div class="song"><span class="artist">The Lumineers</span><br><strong>Ophelia</strong></div>
                <div class="song"><span class="artist">Madonna</span><br><strong>Take A Bow</strong></div>
                <div class="song"><span class="artist">The Mama’s And The Papa’s</span><br><strong>California Dreamin’</strong></div>
                <div class="song"><span class="artist">Marc Cohn</span><br><strong>Walking In Memphis</strong></div>
                <div class="song"><span class="artist">The Marcels</span><br><strong>Blue Moon</strong></div>
                <div class="song"><span class="artist">Maren Morris</span><br><strong>Girl</strong></div>
                <div class="song"><span class="artist">Mariah Carey</span><br><strong>Hero</strong></div>
                <div class="song"><span class="artist">Mariah Carey</span><br><strong>I’ll Be There</strong></div>
                <div class="song"><span class="artist">Mariah Carey</span><br><strong>My All</strong></div>
                <div class="song"><span class="artist">Mariah Carey</span><br><strong>We Belong Together</strong></div>
                <div class="song"><span class="artist">Mario</span><br><strong>Let Me Love You</strong></div>
                <div class="song"><span class="artist">Maroon 5</span><br><strong>Girls Like You</strong></div>
                <div class="song"><span class="artist">Maroon 5</span><br><strong>She Will Be Loved</strong></div>
                <div class="song"><span class="artist">Maroon 5</span><br><strong>This Love</strong></div>
                <div class="song"><span class="artist">Marshmello & Anne-Marie</span><br><strong>Friends</strong></div>
                <div class="song"><span class="artist">Marvin Gaye & Tammi Terrell</span><br><strong>Ain’t No Mountain High Enough</strong></div>
                <div class="song"><span class="artist">Matchbox Twenty</span><br><strong>Push</strong></div>
                <div class="song"><span class="artist">Matt Redman</span><br><strong>10,000 Reasons (Bless The Lord)</strong></div>
                <div class="song"><span class="artist">Meghan Trainor</span><br><strong>Better When I’m Dancin’</strong></div>
                <div class="song"><span class="artist">Melissa Etheridge</span><br><strong>Come To My Window</strong></div>
                <div class="song"><span class="artist">Metallica</span><br><strong>Nothing Else Matters</strong></div>
                <div class="song"><span class="artist">Miley Cyrus</span><br><strong>The Climb</strong></div>
                <div class="song"><span class="artist">Miley Cyrus</span><br><strong>Party In The U.S.A</strong></div>
                <div class="song"><span class="artist">Miley Cyrus</span><br><strong>Wrecking Ball</strong></div>
                <div class="song"><span class="artist">Milli Vanilli</span><br><strong>Blame It On The Rain</strong></div>
                <div class="song"><span class="artist">Miranda Lambert</span><br><strong>Automatic</strong></div>
                <div class="song"><span class="artist">Miranda Lambert</span><br><strong>The House That Built Me</strong></div>
                <div class="song"><span class="artist">Missy Higgins</span><br><strong>Scar</strong></div>
                <div class="song"><span class="artist">The Monkees</span><br><strong>Daydream Believer</strong></div>
                <div class="song"><span class="artist">The Monkees</span><br><strong>I’m A Believer</strong></div>
                <div class="song"><span class="artist">Mötley Crüe</span><br><strong>Home Sweet Home</strong></div>
                <div class="song"><span class="artist">Mr. Mister</span><br><strong>Broken Wings</strong></div>
                <div class="song"><span class="artist">Mumford & Sons</span><br><strong>Little Lion Man</strong></div>
                <div class="song"><span class="artist">Natalie Imbruglia</span><br><strong>Torn</strong></div>
                <div class="song"><span class="artist">Natasha Bedingfield</span><br><strong>Unwritten</strong></div>
                <div class="song"><span class="artist">Neil Diamond</span><br><strong>Sweet Caroline</strong></div>
                <div class="song"><span class="artist">Neil Young</span><br><strong>Heart Of Gold</strong></div>
                <div class="song"><span class="artist">Neil Young</span><br><strong>Rockin’ In The Free World</strong></div>
                <div class="song"><span class="artist">Nelly</span><br><strong>Just A Dream</strong></div>
                <div class="song"><span class="artist">Nickelback</span><br><strong>Far Away</strong></div>
                <div class="song"><span class="artist">Nine Days</span><br><strong>Absolutely</strong></div>
                <div class="song"><span class="artist">Nirvana</span><br><strong>Heart-Shaped Box</strong></div>
                <div class="song"><span class="artist">Nitty Gritty Dirt Band</span><br><strong>The Broken Road</strong></div>
                <div class="song"><span class="artist">No Doubt</span><br><strong>Don’t Speak</strong></div>
                <div class="song"><span class="artist">Norah Jones</span><br><strong>Come Away With Me</strong></div>
                <div class="song"><span class="artist">Oasis</span><br><strong>Don’t Look Back In Anger</strong></div>
                <div class="song"><span class="artist">Oasis</span><br><strong>Wonderwall</strong></div>
                <div class="song"><span class="artist">The Offspring</span><br><strong>Gone Away</strong></div>
                <div class="song"><span class="artist">One Direction</span><br><strong>What Makes You Beautiful</strong></div>
                <div class="song"><span class="artist">OneRepublic</span><br><strong>Apologize</strong></div>
                <div class="song"><span class="artist">OneRepublic</span><br><strong>Stop And Stare</strong></div>
                <div class="song"><span class="artist">Otis Redding</span><br><strong>(Sittin’ On) The Dock Of The Bay</strong></div>
                <div class="song"><span class="artist">Owl City</span><br><strong>Fireflies</strong></div>
                <div class="song"><span class="artist">Passenger</span><br><strong>Let Her Go</strong></div>
                <div class="song"><span class="artist">Patsy Cline</span><br><strong>I Fall To Pieces</strong></div>
                <div class="song"><span class="artist">Patsy Cline</span><br><strong>Walkin’ After Midnight</strong></div>
                <div class="song"><span class="artist">Peter Cetera</span><br><strong>Glory Of Love</strong></div>
                <div class="song"><span class="artist">Pharrell Williams</span><br><strong>Happy</strong></div>
                <div class="song"><span class="artist">Phil Collins</span><br><strong>Against All Odds</strong></div>
                <div class="song"><span class="artist">Phil Collins</span><br><strong>A Groovy Kind Of Love</strong></div>
                <div class="song"><span class="artist">P!nk</span><br><strong>Just Give Me A Reason</strong></div>
                <div class="song"><span class="artist">P!nk</span><br><strong>F**kin' Perfect</strong></div>
                <div class="song"><span class="artist">P!nk</span><br><strong>Try</strong></div>
                <div class="song"><span class="artist">P!nk</span><br><strong>Walk Me Home</strong></div>
                <div class="song"><span class="artist">P!nk</span><br><strong>What About Us</strong></div>
                <div class="song"><span class="artist">Plain White T’s</span><br><strong>Hey There Delilah</strong></div>
                <div class="song"><span class="artist">Prince</span><br><strong>Little Red Corvette</strong></div>
                <div class="song"><span class="artist">Prince</span><br><strong>When Doves Cry</strong></div>
                <div class="song"><span class="artist">R. Kelly</span><br><strong>I Believe I Can Fly</strong></div>
                <div class="song"><span class="artist">Rachel Platten</span><br><strong>Fight Song</strong></div>
                <div class="song"><span class="artist">Radiohead</span><br><strong>Creep</strong></div>
                <div class="song"><span class="artist">Rascal Flatts</span><br><strong>Life Is A Highway</strong></div>
                <div class="song"><span class="artist">Ray Charles</span><br><strong>Hit The Road Jack</strong></div>
                <div class="song"><span class="artist">The Rembrandts</span><br><strong>I’ll Be There For You</strong></div>
                <div class="song"><span class="artist">REO Speedwagon</span><br><strong>Keep On Loving You</strong></div>
                <div class="song"><span class="artist">REO Speedwagon</span><br><strong>Take It On The Run</strong></div>
                <div class="song"><span class="artist">Richard Marx</span><br><strong>Right Here Waiting</strong></div>
                <div class="song"><span class="artist">Rihanna</span><br><strong>Don’t Stop The Music</strong></div>
                <div class="song"><span class="artist">Rihanna</span><br><strong>Stay</strong></div>
                <div class="song"><span class="artist">Rihanna</span><br><strong>Take A Bow</strong></div>
                <div class="song"><span class="artist">Rihanna</span><br><strong>Umbrella</strong></div>
                <div class="song"><span class="artist">Rihanna</span><br><strong>We Found Love</strong></div>
                <div class="song"><span class="artist">Robert John</span><br><strong>The Lion Sleeps Tonight</strong></div>
                <div class="song"><span class="artist">Roberta Flack</span><br><strong>Killing Me Softly</strong></div>
                <div class="song"><span class="artist">The Rolling Stones</span><br><strong>Beast Of Burden</strong></div>
                <div class="song"><span class="artist">The Rolling Stones</span><br><strong>Honky Tonk Women</strong></div>
                <div class="song"><span class="artist">Roxette</span><br><strong>Listen To Your Heart</strong></div>
                <div class="song"><span class="artist">Ruth B.</span><br><strong>Lost Boy</strong></div>
                <div class="song"><span class="artist">Sam Smith</span><br><strong>Dancing With A Stranger</strong></div>
                <div class="song"><span class="artist">Sam Smith</span><br><strong>Not The Only One</strong></div>
                <div class="song"><span class="artist">Sam Smith</span><br><strong>Stay With Me</strong></div>
                <div class="song"><span class="artist">Sam Smith</span><br><strong>Too Good At Goodbyes</strong></div>
                <div class="song"><span class="artist">Sam Smith</span><br><strong>Writing’s On The Wall</strong></div>
                <div class="song"><span class="artist">Sara Bareilles</span><br><strong>Brave</strong></div>
                <div class="song"><span class="artist">Sara Bareilles</span><br><strong>Gravity</strong></div>
                <div class="song"><span class="artist">Sara Bareilles</span><br><strong>Love Song</strong></div>
                <div class="song"><span class="artist">Sarah McLachlan</span><br><strong>Angel</strong></div>
                <div class="song"><span class="artist">Sarah McLachlan</span><br><strong>Building A Mystery</strong></div>
                <div class="song"><span class="artist">Sarah McLachlan</span><br><strong>Good Enough</strong></div>
                <div class="song"><span class="artist">Sarah McLachlan</span><br><strong>Ice Cream</strong></div>
                <div class="song"><span class="artist">Sarah McLachlan</span><br><strong>I Will Remember You</strong></div>
                <div class="song"><span class="artist">The Script</span><br><strong>Breakeven</strong></div>
                <div class="song"><span class="artist">Seal</span><br><strong>Kiss From A Rose</strong></div>
                <div class="song"><span class="artist">Seether</span><br><strong>Broken</strong></div>
                <div class="song"><span class="artist">Shania Twain</span><br><strong>From This Moment On</strong></div>
                <div class="song"><span class="artist">Shania Twain</span><br><strong>You’re Still The One</strong></div>
                <div class="song"><span class="artist">Shawn Colvin</span><br><strong>Sunny Came Home</strong></div>
                <div class="song"><span class="artist">Shawn Mendes</span><br><strong>In My Blood</strong></div>
                <div class="song"><span class="artist">Shawn Mendes</span><br><strong>Mercy</strong></div>
                <div class="song"><span class="artist">Shawn Mendes</span><br><strong>Never Be Alone</strong></div>
                <div class="song"><span class="artist">Shawn Mendes</span><br><strong>Stitches</strong></div>
                <div class="song"><span class="artist">Sheryl Crow</span><br><strong>The First Cut Is The Deepest</strong></div>
                <div class="song"><span class="artist">Sia</span><br><strong>Cheap Thrills</strong></div>
                <div class="song"><span class="artist">Simon & Garfunkel</span><br><strong>Bridge Over Troubled Water</strong></div>
                <div class="song"><span class="artist">Simon & Garfunkel</span><br><strong>Cecilia</strong></div>
                <div class="song"><span class="artist">Simon & Garfunkel</span><br><strong>The Sound Of Silence</strong></div>
                <div class="song"><span class="artist">Sinéad O’Connor</span><br><strong>Nothing Compare</strong></div>
                <div class="song"><span class="artist">Sixpence None The Richer</span><br><strong>Kiss Me</strong></div>
                <div class="song"><span class="artist">Snow Patrol</span><br><strong>Chasing Cars</strong></div>
                <div class="song"><span class="artist">Steppenwolf</span><br><strong>Born To Be Wild</strong></div>
                <div class="song"><span class="artist">Steve Winwood</span><br><strong>Higher Love</strong></div>
                <div class="song"><span class="artist">Stevie Nicks</span><br><strong>Landslide</strong></div>
                <div class="song"><span class="artist">Sting</span><br><strong>Every Breath You Take</strong></div>
                <div class="song"><span class="artist">Sting</span><br><strong>Fields Of Gold</strong></div>
                <div class="song"><span class="artist">Supertramp</span><br><strong>Give A Little Bit</strong></div>
                <div class="song"><span class="artist">Survivor</span><br><strong>Eye Of The Tiger</strong></div>
                <div class="song"><span class="artist">Taio Cruz</span><br><strong>Dynamite</strong></div>
                <div class="song"><span class="artist">Tal Bachman</span><br><strong>She’s So High</strong></div>
                <div class="song"><span class="artist">Taylor Swift</span><br><strong>Bad Blood</strong></div>
                <div class="song"><span class="artist">Taylor Swift</span><br><strong>Blank Space</strong></div>
                <div class="song"><span class="artist">Taylor Swift</span><br><strong>Delicate</strong></div>
                <div class="song"><span class="artist">Taylor Swift</span><br><strong>Love Story</strong></div>
                <div class="song"><span class="artist">Taylor Swift</span><br><strong>Mean</strong></div>
                <div class="song"><span class="artist">Taylor Swift</span><br><strong>Our Song</strong></div>
                <div class="song"><span class="artist">Taylor Swift</span><br><strong>Shake It Off</strong></div>
                <div class="song"><span class="artist">Taylor Swift</span><br><strong>You Belong With Me</strong></div>
                <div class="song"><span class="artist">Taylor Swift</span><br><strong>22</strong></div>
                <div class="song"><span class="artist">Tears For Fears</span><br><strong>Mad World</strong></div>
                <div class="song"><span class="artist">Third Eye Blind</span><br><strong>Semi-Charmed Life</strong></div>
                <div class="song"><span class="artist">Thirsty Merc</span><br><strong>20 Good Reasons</strong></div>
                <div class="song"><span class="artist">Thomas Rhett</span><br><strong>Marry Me</strong></div>
                <div class="song"><span class="artist">Three Days Grace</span><br><strong>Never Too Late</strong></div>
                <div class="song"><span class="artist">Tina Turner</span><br><strong>What’s Love Got To Do With It</strong></div>
                <div class="song"><span class="artist">TLC</span><br><strong>No Scrubs</strong></div>
                <div class="song"><span class="artist">Tom Petty</span><br><strong>Free Fallin’</strong></div>
                <div class="song"><span class="artist">Tom Petty</span><br><strong>I Won’t Back Down</strong></div>
                <div class="song"><span class="artist">Tom Petty And The Heartbreakers</span><br><strong>American Girl</strong></div>
                <div class="song"><span class="artist">Tommy James & The Shondells</span><br><strong>Crimson And Clover</strong></div>
                <div class="song"><span class="artist">Tommy James & The Shondells</span><br><strong>I Think We’re Alone Now</strong></div>
                <div class="song"><span class="artist">Toto</span><br><strong>Africa</strong></div>
                <div class="song"><span class="artist">Tracy Chapman</span><br><strong>Fast Car</strong></div>
                <div class="song"><span class="artist">Tracy Chapman</span><br><strong>Give Me One Reason</strong></div>
                <div class="song"><span class="artist">Train</span><br><strong>Calling All Angels</strong></div>
                <div class="song"><span class="artist">Train</span><br><strong>Drops Of Jupiter (Tell Me)</strong></div>
                <div class="song"><span class="artist">Train</span><br><strong>Hey, Soul Sister</strong></div>
                <div class="song"><span class="artist">Twenty One Pilots</span><br><strong>House Of Gold</strong></div>
                <div class="song"><span class="artist">U2</span><br><strong>I Still Haven’t Found What I’m Looking For</strong></div>
                <div class="song"><span class="artist">U2</span><br><strong>One</strong></div>
                <div class="song"><span class="artist">U2</span><br><strong>With Or Without You</strong></div>
                <div class="song"><span class="artist">UB40</span><br><strong>Red Red Wine</strong></div>
                <div class="song"><span class="artist">Uncle Kracker</span><br><strong>Follow Me</strong></div>
                <div class="song"><span class="artist">Van Morrison</span><br><strong>Brown Eyed Girl</strong></div>
                <div class="song"><span class="artist">Van Morrison</span><br><strong>Into The Mystic</strong></div>
                <div class="song"><span class="artist">Vance Joy</span><br><strong>Mess Is Mine</strong></div>
                <div class="song"><span class="artist">Vance Joy</span><br><strong>Riptide</strong></div>
                <div class="song"><span class="artist">Vanessa Carlton</span><br><strong>A Thousand Miles</strong></div>
                <div class="song"><span class="artist">The Wallflowers</span><br><strong>One Headlight</strong></div>
                <div class="song"><span class="artist">Waylon Jennings</span><br><strong>Mamma's Don’t Let Your Babies Grow Up To Be Cowboys</strong></div>
                <div class="song"><span class="artist">Wayne King</span><br><strong>You Are My Sunshine</strong></div>
                <div class="song"><span class="artist">Whitney Houston</span><br><strong>Greatest Love Of All</strong></div>
                <div class="song"><span class="artist">Whitney Houston</span><br><strong>I Will Always Love You</strong></div>
                <div class="song"><span class="artist">Whitney Houston</span><br><strong>My Love Is Your Love</strong></div>
                <div class="song"><span class="artist">Whitney Houston</span><br><strong>Where Do Broken Hearts Go</strong></div>
                <div class="song"><span class="artist">Whitney Houston & Mariah Carey</span><br><strong>When You Believe</strong></div>
                <div class="song"><span class="artist">Willie Nelson</span><br><strong>Always On My Mind</strong></div>
                <div class="song"><span class="artist">Willie Nelson</span><br><strong>On The Road Again</strong></div>
                <div class="song"><span class="artist">Wiz Khalifa</span><br><strong>See You Again</strong></div>
                <div class="song"><span class="artist">ZAYN & Taylor Swift</span><br><strong>I Don’t Wanna Live Forever</strong></div>
                <div class="song"><span class="artist">Zedd & Alessia Cara</span><br><strong>Stay</strong></div>
                <div class="song"><span class="artist">Zedd, Maren Morris, & Grey</span><br><strong>The Middle</strong></div>
                <div class="song"><span class="artist">3 Doors Down</span><br><strong>Here Without You</strong></div>
            </div>
            <div class="text-center">
                <span id="uncoverAll" class="join outline white">Show All</span>
            </div>
        </div>
    </section>

    <section class="play-songs text-center">
        <div class="container">
            <h1>Your Clear Path<br class="hidden-sm hidden-md hidden-lg"> To Playing Songs</h1>
            <h4>Get Lisa’s personalized training pack that will teach you songs faster, and give you the skills to<br class="hidden-xs">
                play 500 songs (and many more). You won’t be left alone either, as you will have direct access to<br class="hidden-xs">
                Lisa and other teachers to answer your questions and provide support when you need it.</h4>
            <div class="four-benefits">
                <div class="benefit-tile col-xs-12 col-sm-6">
                    <i class="fas fa-list-ol"></i>
                    <p><strong>GUIDED LESSONS</strong><br>
                        You’ll know exactly what to play and practice next with our carefully designed step-by-step lessons.
                    </p>
                </div>
                <div class="benefit-tile col-xs-12 col-sm-6">
                    <i class="fas fa-music"></i>
                    <p><strong>PLAY POPULAR SONGS</strong><br>
                        You’ll have the skills to play literally hundreds of songs, and an immediate library of songs to choose from.
                    </p>
                </div>
                <div class="benefit-tile col-xs-12 col-sm-6">
                    <i class="fas fa-piano-keyboard"></i>
                    <p><strong>KEYBOARD FLUIDITY</strong><br>
                        The bonus lessons will elevate your playing by teaching you fast runs and fancy fills.
                    </p>
                </div>
                <div class="benefit-tile col-xs-12 col-sm-6">
                    <i class="fas fa-question"></i>
                    <p><strong>YOUR BIGGEST QUESTIONS</strong><br>
                        Ask your biggest questions and get personalized feedback from teachers and connect with other students.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="personal-teacher">
        <div class="background">
            <div class="container">
                <h1>Lisa Witt: Your Personal<br class="hidden-xs">
                Piano Teacher</h1>
                <p><em>"This was my first attempt at the piano and I learned songs on the first day. 500 Songs in 5 Days cut through to the fun parts early on. The lessons are concise with clear goals showing where I currently am and what it takes to be where I want to be, it provides small victories along the way that keep me interested - I have never seen lessons on any instrument as good as 500 Songs in 5 Days."</em></p>
                <div class="avatar-name"><img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/connor.jpg" alt="Connor Beckett"> <p><strong>CONNOR BECKETT</strong><br><em>UNITED KINGDOM</em></p></div>
            </div>
        </div>
    </section>

    <section class="teacher-bio">
        <div class="container">
            <p><span class="first-letter"><img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/big-l.png" alt="Bold L"></span>isa Witt has been teaching the piano for 18 years and in that time has helped hundreds of students realize their musical dreams. Now she’s here to help you.
                <br><br>
                Lisa’s contagious enthusiasm will have you excited to practice and return to the keys for your next lesson. Her teaching style makes lessons fun and focused on you and your learning.
                <br><br>
                “I love witnessing the moments when the student catches on to a new concept. The confidence that comes from working hard for something and achieving it makes teaching the best job in the world,” she says.
                <br><br>
                She has now taken that teaching to Pianote, helping thousands of students all around the world. Her latest project is 500 Songs in 5 days. Five lessons that WILL have you playing hundreds of songs on the piano, even if you cannot read music.
                <br><br class="hidden-sm hidden-md hidden-lg">
                “New students often don’t realize that they can play the music they want to play within a short period of time,” she says.
                <br><br>
                “Yes it takes work and effort to learn but the payoffs begin way faster than you’d think!”
                <br><br>
                500 Songs in 5 days is Lisa’s personally designed, step-by-step curriculum to teach you the chords and concepts behind hundreds of popular songs. Aside from the five lessons, you’ll get two BONUS lessons that introduce more advanced concepts around transposition and melody.
                <br><br>
                If you want to play songs on the piano, there is no better way to learn them than 500 Songs in 5 Days.
                <br><br>
                “I can’t wait for you to realize just what’s possible for you on the piano.”
            </p>
        </div>
    </section>

    <div id="testimonials" class="anchor"></div>
    <section class="testimonial-vids text-center">
        <div class="container">
            <h1>Real Students. <br class="hidden-sm hidden-md hidden-lg"><strong>Real Success Stories.</strong></h1>
            <h4>See how 500 Songs in 5 Days has helped students discover new <br class="hidden-xs">
                passions, reach new goals, and in some cases, draw families closer.</h4>

            <div class="testimonial col-xs-12 col-sm-4">
                <div class="thumb hover-scale autoplay-video" style="background-image:url(https://i.vimeocdn.com/video/923770586-9e9947501c113bc7aa2cc198a9b11ef1bbbc46bedaa6d7d62fb0061cb3e513c4-d_320);" data-toggle="modal" data-target="#testimonial1">
                    <div class="text">JIMI'S<br>STORY</div>
                    <i class="fas fa-play"></i>
                </div>
                <p><strong>He’s learning songs in minutes, not months.</strong><br>
                    It used to take Jimi 6 months to learn a new song. With 500 Songs in 5 Days he’s playing songs on the first try, minutes after reading the chord chart. He’s also learned to improvise and express himself through music.</p>
            </div>
            <div class="testimonial col-xs-12 col-sm-4">
                <div class="thumb hover-scale autoplay-video" style="background-image:url(https://i.vimeocdn.com/video/923771461-a0666803c1cedd86442f49ef4e9b766325747dd3d65f93962e13d03e96c17f5a-d_320);" data-toggle="modal" data-target="#testimonial2">
                    <div class="text">KELLY'S<br>STORY</div>
                    <i class="fas fa-play"></i>
                </div>
                <p><strong>She’s connecting with her daughter through music.</strong><br>
                    When Kelly started 500 Songs in 5 Days, she didn’t realize it would bring her and her daughter closer together. Now, they’re playing and singing their favorite songs. Something she never thought would happen.</p>
            </div>
            <div class="testimonial col-xs-12 col-sm-4">
                <div class="thumb hover-scale autoplay-video" style="background-image:url(https://i.vimeocdn.com/video/923772154-3cc5d0d0a3dc45eb8d8f74b217001c1c0593549e21431f5bbb06faa6c101de4f-d_320);" data-toggle="modal" data-target="#testimonial3">
                    <div class="text">HEIDI'S<br>STORY</div>
                    <i class="fas fa-play"></i>
                </div>
                <p><strong>She’s achieving a life-long goal.</strong><br>
                    Heidi knew she always wanted to play the piano. But she didn’t know where to start. YouTube videos could show her songs, but she never understood what she was playing, or why. Now, she’s playing (and understanding) her favorite songs on the piano.</p>
            </div>
        </div>
    </section>

    <div class="modal fade text-center" id="testimonial1" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/436936047?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center" id="testimonial2" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/436936072?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center" id="testimonial3" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/436936032?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>

    <section class="guarantee">
        <div class="container">
            <div class="col-md-4 col-sm-5 col-xs-12 pull-right guarantee-icon">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/90-day.png" alt="90-Day Money-Back Guarantee">
            </div>
            <div class="col-md-8 col-sm-7 col-xs-12 guarantee-text">
                <h1>90-Day Money-Back Guarantee.</h1>
                <p>We love our students. More than anything, we want you to enjoy a super-positive experience playing piano. And that means we only want you to pay if you actually LOVE your Pianote experience! So join below to try it out totally risk-free. If it’s not for you, simply cancel your membership within 90 days and contact support for a full refund.</p>
            </div>
        </div>
    </section>

    <section class="final text-center">
        <div class="container">
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg" alt="500 songs logo">
            <h2>Develop the skills to play
                @hasSection('name')
                     songs by <br class="hidden-sm hidden-md hidden-lg"> <strong>@yield('name')</strong> for a one-time <br class="hidden-sm hidden-md hidden-lg">
                @else
                    500 songs <br> for a one-time
                @endif
                    payment of just

                @if(floatval($productPrices['500-songs-in-5-days']->price) > $productPrice)
                    <s>${{ floatval($productPrices['500-songs-in-5-days']->price) }}</s> <strong>${{ $productPrice }}</strong>
                @else
                    <strong>${{ $productPrice }}</strong>
                @endif
            </h2>
            <a @hasSection('product-json')
                class="join vue-add-to-cart" @yield('product-json')
            @else
                class="join"
            @endif href="@yield('order-link')" >LEARN 500 SONGS NOW &raquo;</a>
            <p class="breakdown">
                @hasSection('badge')
                    @yield('badge')
                @endif
                @if(floatval($productPrices['500-songs-in-5-days']->price) > $productPrice)
                    <s>NORMALLY ${{ floatval($productPrices['500-songs-in-5-days']->price) }}.</s> &nbsp;<strong><u>ONLY ${{ $productPrice }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * ($productPrice / floatval($productPrices['500-songs-in-5-days']->price)))) }}%)
                @else
                    <strong><u>ONLY ${{ $productPrice }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br>
                <strong class="yellow">** 90-DAY GUARANTEE **</strong></p>

            <div class="credit-cards col-xs-12">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-discover"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
            </div>
            <div class="col-xs-12 questions">
                <p><strong>Any questions?</strong><br class="hidden-lg hidden-md hidden-sm">
                    Call us toll-free at <a href="tel:+18004398921">1-800-439-8921</a> <br class="hidden-lg hidden-md hidden-sm">
                    or directly at <a href="tel:+16048557605">1-604-855-7605</a>.<br>
                    All prices listed in USD. </p>
            </div>
        </div>
    </section>

    @include('pianote.sales.partials._footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#uncoverAll').on('click', function (e) {
                e.stopPropagation();
                e.preventDefault();
                $('.song-list').addClass('show-all');
                $(this).addClass('hide');
            });
            //open jimi testimonial on url
            var showModal = location.search.substr(1).includes('jimi');
            if (showModal) {
                $("#testimonial1").modal();
                $("#testimonial1").find('[data-lazy-load-url]').each(function () {
                    var lazyLoadIframeElement = $(this);
                    $(this).attr('src', lazyLoadIframeElement.data('lazy-load-url'));
                });
            }
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay-bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
    <script>
        $(function() {

            // sticky topbar before orderSection
            var stickyBar = $('.promo-banner');
            $(window).scroll(function () {
                var orderSection = $('.final').offset().top;
                var spreadSection = $('.day-breakdown').offset().top;
                if ($(this).scrollTop() > (orderSection - 115)) {
                    stickyBar.removeClass('fixed');
                }
                if ($(this).scrollTop() < spreadSection - 115) {
                    stickyBar.removeClass('fixed');
                }
                if ($(this).scrollTop() < orderSection - 115 && $(this).scrollTop() > spreadSection - 115) {
                    stickyBar.addClass('fixed');
                }
            });

            $('.count').each(function () {
                var thisCountElement = $(this);
                var options = {
                    useEasing: true,
                    useGrouping: true,
                    separator: ','
                };
                var countup = new CountUp(
                    thisCountElement.attr('id'), 0, thisCountElement.data('total-count'), 0, 4, options
                );

                $(window).scroll(function () {
                    if ($(window).scrollTop() + $(window).height() > (thisCountElement.offset().top)) {
                        countup.start();
                    }
                });
            });

            $(window).trigger('scroll');
        });
    </script>
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    @yield('scripts')


@stop
