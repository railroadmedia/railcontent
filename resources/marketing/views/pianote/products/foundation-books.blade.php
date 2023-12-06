@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Pianote Foundations | Pianote</title>
    <meta name="description" content="The Complete Pianote Curriculum At Your Fingertips">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/og-image.jpg"
          style="display: none;">
    <meta property="og:title" content="Pianote Foundations">
    <meta property="og:description" content="The Complete Pianote Curriculum At Your Fingertips">
    <meta property="og:url" content="https://www.pianote.com/foundations">

    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <style>
        body.modal-open {
            overflow-y:hidden;
        }

        .modal-bg {
            z-index:100;
        }

        .modal-bg.active {
            visibility:visible;
            opacity:1;
        }

        .modal-bg:after {
            font-family:"Font Awesome 6 Pro";
            font-weight:900;
            font-style:normal;
            font-variant:normal;
            text-rendering:auto;
            content:"\f00d";
            color:#fff;
            z-index:1;
            opacity:0.8;
            position:fixed;
            margin:0;
            line-height:1em;
            text-align:center;
            display:inline-block;
            outline:none;
            top:0;
            right:0;
            font-size:35px;
            width:35px;

        }


        .modal-content {
            z-index:98;
            width:85%;
            max-width:750px;
        }

        .modal-content.active {
            display:block;
            opacity:1;
        }

        .tab-content.active {
            opacity:1;
            visibility:visible;
            height:100%;
        }

        .tab-switcher.active {
            background:#fff;
            border-color:#fff;
            color:#000C17;
        }

        .tab-switcher .bottom-arrow {
            border-width:10px 8px 0 8px;
            bottom:-10px;
            border-color:#ffffff transparent transparent transparent;
        }

        .tab-switcher.active .bottom-arrow {
            bottom:-12px;
            opacity:1;
        }

        .join {
            display:inline-block;
            font-weight:700;
            font-family:"Roboto Condensed", sans-serif;
            line-height:1em;
            text-transform:uppercase;
            background:#F61A30;
            border-radius:50px;
            color:#FFF;
            padding:17px 7%;
            cursor:pointer;
            text-align:center;
            user-select:none;
            transition:all .3s;
        }

        .join.sold-out {
            background:#665c5c;
        }

        .book {
            width:240px;
        }

        .header-text {
            margin-top:260px;
        }

        .dropdown .description {
            height:0;
            max-height:0;
            visibility:hidden;
            opacity:0;
            overflow:hidden;
        }

        .dropdown.active .description {
            visibility:visible;
            opacity:1;
            height:auto;
            max-height:400px;
        }

        @media (min-width:640px) {
            .modal-content {
                width:90%;
            }

            .book {
                width:290px;
            }

            .header-text {
                margin-top:430px;
            }
        }


        @media (min-width:768px) {
            .book {
                width:450px;
            }
        }

        @media (min-width:1024px) {
            .modal-bg:after {
                right:15px;
                font-size:50px;
                width:50px;
            }

            .modal-content {
                width:98%;
            }

            .book {
                width:570px;
            }

            .header-text {
                margin-top:530px;
            }

            .see-inside {
                right:10%;
            }
        }
        @media (min-width:1280px) {
            .see-inside {
                right:18%;
            }

        }
        .bg-navy-800 {
            background:#001429;
        }

        .border-navy-700 {
            border-color:#04203C;
        }
        .rotate-20 {
            --transform-rotate:20deg;
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner', [
                    "name" => "Pianote Foundations Books",
                    "fullPrice" => 149,
                    "price" => 149,
                    "noBreadcrumb" => true
                ])
    <header class="bg-navy-800 text-white relative text-center overflow-hidden">
        <div class="pt-12" style="background-image: url(data:image/png;base64,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);">
            <div class="container mx-auto overflow-hidden">
                <img class="inline-block w-2/5 sm:w-1/3 lg:w-1/4" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/pianote-foundations-logo.png">
                <h1 class="font-bold mt-5 mb-10 leading-tight text-lg sm:text-2xl md:text-3xl lg:text-4xl"><strong>The Complete Pianote<br> Curriculum At Your Fingertips</strong></h1>
                <div class="see-inside absolute z-10 right-0 font-extrabold transform rotate-20 font-bebas p-2 text-xs sm:text-base">
                    CLICK TO<br>
                    SEE INSIDE
                    <img class="w-5 sm:w-8" style="filter: saturate(0) brightness(5);" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/click-here-to-see-inside-arrow.png">
                </div>
                <span class="sticky-trigger"></span>
                <img class="book absolute z-0 transform -translate-x-1/2 left-1/2 modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/pianote-foundations-box-set.png">
                <div class="relative z-20 pb-12 header-text px-6">
                    <h4 class="font-bold text-base md:text-lg"><strong>BUY NOW: $149 USD</strong></h4>

                    @if($products['pianote-foundation']->getStockAvailability() < 1)
                        <a class="join sold-out mt-3 mb-5 sm:mb-10 w-full max-w-2xl text-lg sm:text-xl md:text-2xl lg:text-3xl">SOLD OUT!</a>
                    @else

                        <a
                            class="join vue-add-to-cart mt-3 mb-5 sm:mb-10 w-full max-w-2xl text-lg sm:text-xl md:text-2xl lg:text-3xl"
                            href="/ecommerce/add-to-cart?products[pianote-foundation]=1"
                            data-product-json='{"pianote-foundation": 1}'
                        >CLICK HERE TO ORDER &raquo;</a>
                    @endif
                    <p class=" mx-auto max-w-2xl text-xs sm:text-sm"><strong>Get ready to open up the only piano books you’ll ever need.</strong>
                        <br><br>
                        These 10 hardcover books cover the ENTIRE Pianote Foundations curriculum and will take you from never having touched a piano before, to improvising over jazz and creating your own beautiful chord progressions and melodies.
                        <br><br>
                        The stunning designs and color images help provide a clarity in your learning that’s hard to find anywhere else. When you can see and understand a concept better, you can remember it faster and start applying it to your own playing.
                        <br><br>
                        Plus you’ll get support and help from real teachers every step of the way to make sure you’re seeing the results you want.</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 z-10 h-1/2" style="background: linear-gradient(0, #000C17 60%, transparent);"></div>
        </div>
    </header>

    <div class="modal-bg fixed inset-0 w-full invisible opacity-0 transition-all duration-100 overflow-y-auto" style="background:rgba(0, 0, 0, .7);">
        <div class="modal-content h-auto min-h-0 overflow-visible outline-none mx-auto hidden opacity-0 transition-all duration-300 relative rounded-md">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/page-1.png">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/page-2.png">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/page-3.png">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/page-4.png">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/page-5.png">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/page-6.png">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/page-7.png">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/page-8.png">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/page-9.png">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/page-10.png">
        </div>
    </div>

    <section class="bg-musora-black text-white py-8 sm:py-12 relative z-20 text-center">
        <div class="container mx-auto">
            <h1 class="font-bold leading-tight text-lg sm:text-2xl md:text-3xl lg:text-4xl"><strong>Everything you need to get inspired,<br class="hidden sm:inline">
                    focused, and better at the piano.</strong></h1>
            <div class="px-6">
                <div class="relative border-4 border-pianote rounded-lg overflow-hidden mt-8 sm:mt-12 mx-auto w-full max-w-2xl">
                    <div class="aspect-16:9 w-full relative">
                        <iframe src="//player.vimeo.com/video/381240248" class="absolute w-full h-full"></iframe>
                    </div>
                </div>

                <p class="w-full max-w-2xl mt-6 mb-12 mx-auto text-xs md:text-sm">Along with your beautiful books, you’ll also get access to a special online resource center full of bonus video lessons, exercises, and downloadable worksheets.
                    <br><br>
                    There, you’ll also have access to REAL teachers who can answer your questions about anything you come across in the books. You’ll never be left alone.
                    <br><br>
                    Click on any of the books to see a preview from Book 2 to see what they’re like inside!</p>
            </div>

            <div class="flex flex-wrap justify-center">
                <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 md:p-8">
                    <img class="mx-auto mb-5 w-1/2 border-4 border-navy-700 rounded-lg modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/level-1-x2.jpg">
                    <p class="text-xs leading-relaxed"><span class="font-extrabold text-pianote text-sm leading-snug inline-block">Welcome To The Keyboard</span><br>
                        Get to know the keyboard and learn all the notes. You’ll be playing your first scale in no time.</p>
                </div>
                <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 md:p-8">
                    <img class="mx-auto mb-5 w-1/2 border-4 border-navy-700 rounded-lg modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/level-2-x2.jpg">
                    <p class="text-xs leading-relaxed"><span class="font-extrabold text-pianote text-sm leading-snug inline-block">The Staff & Sight-Reading</span><br>
                        Read music so you can play music. You’ll find loads of tips and practice resources to help you remember the notes.</p>
                </div>
                <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 md:p-8">
                    <img class="mx-auto mb-5 w-1/2 border-4 border-navy-700 rounded-lg modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/level-3-x2.jpg">
                    <p class="text-xs leading-relaxed"><span class="font-extrabold text-pianote text-sm leading-snug inline-block">Diving Deeper Into Core Skills</span><br>
                        Take your skills up a notch with more advanced chording, chord progressions, and dynamics.</p>
                </div>
                <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 md:p-8">
                    <img class="mx-auto mb-5 w-1/2 border-4 border-navy-700 rounded-lg modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/level-4-x2.jpg">
                    <p class="text-xs leading-relaxed"><span class="font-extrabold text-pianote text-sm leading-snug inline-block">Key Signatures & Inversions</span><br>
                        Start making your songs sound more musical with chord inversions. You’ll also learn new key signatures and ‘accidentals’.</p>
                </div>
                <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 md:p-8">
                    <img class="mx-auto mb-5 w-1/2 border-4 border-navy-700 rounded-lg modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/level-5-x2.jpg">
                    <p class="text-xs leading-relaxed"><span class="font-extrabold text-pianote text-sm leading-snug inline-block">Flats & Chord Shortcuts</span><br>
                        Take those chords from bland to impressive with shortcuts to boost your chord transitions.</p>
                </div>
                <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 md:p-8">
                    <img class="mx-auto mb-5 w-1/2 border-4 border-navy-700 rounded-lg modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/level-6-x2.jpg">
                    <p class="text-xs leading-relaxed"><span class="font-extrabold text-pianote text-sm leading-snug inline-block">Understanding Minor Keys</span><br>
                        Take the step towards becoming an intermediate pianist. You’ll learn the minor scales and some new rhythmic patterns.</p>
                </div>
                <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 md:p-8">
                    <img class="mx-auto mb-5 w-1/2 border-4 border-navy-700 rounded-lg modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/level-7-x2.jpg">
                    <p class="text-xs leading-relaxed"><span class="font-extrabold text-pianote text-sm leading-snug inline-block">The Circle Of 5ths</span><br>
                        Unlock the secrets of the circle of 5ths to be able to figure out EVERY major and minor scale that there is.</p>
                </div>
                <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 md:p-8">
                    <img class="mx-auto mb-5 w-1/2 border-4 border-navy-700 rounded-lg modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/level-8-x2.jpg">
                    <p class="text-xs leading-relaxed"><span class="font-extrabold text-pianote text-sm leading-snug inline-block">Learning To Improvise</span><br>
                        Learn how to take the fear and guessing out of improvisation and feel confident in your skills.</p>
                </div>
                <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 md:p-8">
                    <img class="mx-auto mb-5 w-1/2 border-4 border-navy-700 rounded-lg modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/level-9-x2.jpg">
                    <p class="text-xs leading-relaxed"><span class="font-extrabold text-pianote text-sm leading-snug inline-block">7th Chords & The Blues</span><br>
                        The doorway to true musical freedom. Express yourself with the blues and learn how to improvise using the blues scale.</p>
                </div>
                <div class="w-1/2 md:w-1/3 lg:w-1/4 p-4 md:p-8">
                    <img class="mx-auto mb-5 w-1/2 border-4 border-navy-700 rounded-lg modal-trigger cursor-pointer" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/level-10-x2.jpg">
                    <p class="text-xs leading-relaxed"><span class="font-extrabold text-pianote text-sm leading-snug inline-block">Intro To Jazz</span><br>
                        Explore the world of Jazz with a popular jazz standard, and find out how to use jazz chords and modes to play your first solo.</p>
                </div>
            </div>

        </div>
    </section>
    <section class="bg-musora-black text-white py-8 sm:py-12 relative z-20 text-center">
        <div class="container mx-auto">
            <div class="flex text-center">
                <div class="w-1/3 font-extrabold px-1 sm:px-3">
                    <div class="tab-switcher active border-2 border-sky-900 text-sky-900 rounded-full p-2 cursor-pointer relative mb-10 sm:mb-20 select-none text-sm md:text-base lg:text-lg">AUTHOR
                        <div class="bottom-arrow absolute transition-all duration-300 border-solid transform -translate-x-1/2 translate-y-0 opacity-0 left-1/2"></div></div>
                </div>
                <div class="w-1/3 font-extrabold px-1 sm:px-3">
                    <div class="tab-switcher border-2 border-sky-900 text-sky-900 rounded-full p-2 cursor-pointer relative mb-10 sm:mb-20 select-none text-sm md:text-base lg:text-lg">INTRO<span class="hidden sm:inline">DUCTION</span>
                        <div class="bottom-arrow absolute transition-all duration-300 border-solid transform -translate-x-1/2 translate-y-0 opacity-0 left-1/2"></div></div>
                </div>
                <div class="w-1/3 font-extrabold px-1 sm:px-3">
                    <div class="tab-switcher border-2 border-sky-900 text-sky-900 rounded-full p-2 cursor-pointer relative mb-10 sm:mb-20 select-none text-sm md:text-base lg:text-lg"><span class="hidden sm:inline">TABLE OF </span>CONTENTS
                        <div class="bottom-arrow absolute transition-all duration-300 border-solid transform -translate-x-1/2 translate-y-0 opacity-0 left-1/2"></div></div>
                </div>
            </div>

            <div class="tab-content active opacity-0 invisible transition-opacity duration-1000 h-0">
                <div class="sm:flex items-start md:items-center justify-center px-6">
                    <img class="rounded-full border-4 sm:border-8 border-pianote w-1/3 order-2" src="https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/lisa.jpg">
                    <div class="text-left sm:pr-8 lg:pr-20">
                        <div class="w-32 bg-pianote rounded-full h-2 hidden sm:block mb-4"></div>
                        <h1 class="font-bold font-roboto text-3xl sm:text-4xl md:text-5xl lg:text-6xl">LISA WITT</h1>
                        <p class="leading-loose max-w-2xl text-xs sm:text-sm">Lisa Witt has taught in a variety of settings from beginners just getting started to recording artists preparing their songs for the road.
                            <br><br>
                            She is committed to making sure students actually ENJOY learning the piano and see results while playing the songs they love.
                            <br><br>
                            Trained in classical piano through the Royal Conservatory, Lisa now finds the most joy in playing by ear and helping students learn how to express themselves through improvisation.</p>
                    </div>
                </div>
            </div>
            <div class="tab-content opacity-0 invisible transition-opacity duration-1000 h-0 text-left">
                <div class="sm:flex items-start justify-center px-6">
                    <img class="bg-white border-4 sm:border-8 rounded-lg border-pianote w-1/3 p-2 md:p-4 pb-0 md:pb-0 mb-4 sm:mb-0" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/lisa-cutout.jpg">
                    <div class="text-left sm:pl-8 lg:pl-20 max-w-2xl">
                        <p class="leading-loose text-xs sm:text-sm">Nat King Cole, one of the most beloved popular pianists of the twentieth century, said that when he performed, it was “like sitting down at my piano and telling fairy stories.” Maybe you’d like to tell musical stories too. Or maybe you’ve wanted to learn a song like Beethoven’s “Moonlight Sonata” or “Bohemian Rhapsody” by Queen since they first gave you goosebumps. Maybe you’d love to accom- pany yourself while you sing, or even hope to write your own songs on the piano, just like Elton John, Tori Amos, and Billy Joel. Whatever your piano goals, you need to start at the beginning—right here!
                            <br><br> Welcome to Level 1 in the Pianote Foundations. You can think of this book as the perfect combination of having a private teacher to guide you and a workbook that allows you to take your time and learn at your own pace. With a carefully designed curriculum that corresponds to the Pianote Foundations video lessons, this book contains everything you need to keep you engaged, inspired, and focused on the first steps of your journey towards playing the music you love. With the Pianote Foundations, you have ALL the information you need to be successful in reaching your musical goals. These books allow you to learn in the comfort of your own home, at your own pace.
                            <br><br> In Level 1, you’ll find lesson material that presents each concept, plus some exercises that you’ll be asked to write out with a pencil on paper (yes, paper and pencil!), and others that will help you apply each concept at the piano. In this book, you will learn:
                        </p>
                        <ol class="leading-loose list-decimal pl-8 my-4 text-xs sm:text-sm">
                            <li>The layout and geography of the piano</li>
                            <li>The musical alphabet</li>
                            <li>How to develop dexterity and independence in your fingers</li>
                            <li>How to play your first scale</li>
                            <li>How to play chords</li>
                            <li>How to play your first chord progression</li>
                        </ol>
                        <p class="leading-loose text-xs sm:text-sm">
                            These first steps will present unique challenges as you develop brand new pathways in your brain and work to get your mind and your fingers cooperating with one another. Consistent practice, determi- nation, and a little sense of humor will help you achieve your goals. Have fun and enjoy the process! Like so much about learning, making it fun is individual—and unique to you. For example, in my life I’ve had to learn how to make practicing “fun” while my toddler joins in with his vocal and piano based contributions. While this can be really annoying, I’ve learned to view it as a great way to develop my focus in times of distraction. For you, fun might look like learning to laugh at your mistakes, getting up at the crack of dawn to practice in a quiet house, or serenading your loved ones with countless repetitions of piano scales.
                            <br><br>
                            Besides being fun, learning something new can also overwhelm you. But when approached in the step-by-step manner outlined here, your musical goals are achievable—and they might be much closer than you think. By following the material presented here, you’ll be well on your way to learning how to play the music you love on the piano.
                            <br><br> As you make your way through the Pianote Foundations levels, you’ll start playing, understanding, and loving the piano faster than you dreamed possible. It’s no surprise that playing the piano is a lifelong pursuit for many people—after all, piano players are known for their dexterity, perseverance, and good looks, so who wouldn’t want to play piano? (Okay, I made up that last one, but you’re looking great!) You’re in good company, taking your first steps on an exciting, rewarding journey. Thank you for giving me and everyone here at Pianote the opportunity to guide you into your piano journey. Have fun!
                        </p>
                    </div>
                </div>
            </div>
            <div class="tab-content opacity-0 invisible transition-opacity duration-1000 h-0">
                <div class="lesson-descriptions mx-auto max-w-4xl px-6">
                    @include('_partials.components.question-dropdown', [
                    "num" => "1",
                    "title" => "Welcome To The Keyboard",
                    "desc" => 'Everything You Need To Know To Get Started <span class="float-right">1</span><br> Welcome to the keyboard <span class="float-right">19</span><br> The Five Finger Scale <span class="float-right">25</span><br> Rhythm 101 <span class="float-right">31</span><br> Scales <span class="float-right">43</span><br> Chords <span class="float-right">49</span><br> Your First Chord Progression <span class="float-right">53</span><br> Your First Song <span class="float-right">57</span><br> Conclusion <span class="float-right">63</span>',
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "2",
                    "title" => "The Staff & Sight-Reading",
                    "desc" => 'Introduction <span class="float-right">1</span><br> Invervals - Your Color Palatte <span class="float-right">3</span><br> The Treble Clef <span class="float-right">13</span><br> The Bass Clef <span class="float-right">23</span><br> Intervals On The Staff <span class="float-right">29</span><br> The Grand Staff <span class="float-right">37</span><br> Suspended Chords <span class="float-right">43</span><br> Rhythmic 5ths <span class="float-right">51</span><br> Bringing It All Together In Song <span class="float-right">55</span><br> Conclusion <span class="float-right">63</span>',
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "3",
                    "title" => "Diving Deeper Into Core Skills",
                    "desc" => 'Introduction <span class="float-right">1</span><br> Your First Minor Scale <span class="float-right">3</span><br> Sight Reading In A Minor <span class="float-right">9</span><br> The Most Important Chord Progression <span class="float-right">13</span><br> The Minor i-iv-v <span class="float-right">17</span><br> Eighth Notes Expanded <span class="float-right">21</span><br> Arpeggios <span class="float-right">25</span><br> Dynamics <span class="float-right">29</span><br> Bringing It All Together In Song <span class="float-right">35</span><br> Conclusion <span class="float-right">43</span>',
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "4",
                    "title" => "Key Signatures & Inversions",
                    "desc" => 'Introduction <span class="float-right">1</span><br> Chromatic Scales <span class="float-right">3</span><br> G Major Scale <span class="float-right">9</span><br> Accidentals <span class="float-right">13</span><br> Inversions <span class="float-right">17</span><br> Broken Inversions <span class="float-right">23</span><br> The Big Chords Of G <span class="float-right">27</span><br> The Spider Walk <span class="float-right">31</span><br> Bringing It All Together In Song <span class="float-right">35</span><br> Conclusion <span class="float-right">41</span>',
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "5",
                    "title" => "Flats & Chord Shortcuts",
                    "desc" => 'Introduction <span class="float-right">1</span><br> Flat Notes <span class="float-right">3</span><br> Flat Obstacle Course <span class="float-right">7</span><br> Intro To Chord Shortcuts <span class="float-right">11</span><br> Classic Chord Progression In F Major <span class="float-right">17</span><br> Rhythmioc Rests <span class="float-right">21</span><br> Staccato Vs. Legato Playing <span class="float-right">27</span><br> Contrary Motion <span class="float-right">31</span><br> Bringing It All Together In Song <span class="float-right">35</span><br> Conclusion <span class="float-right">43</span>',
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "6",
                    "title" => "Understanding Minor Keys",
                    "desc" => 'Introduction <span class="float-right">1</span><br> Harmonic Minor Scales <span class="float-right">3</span><br> Your First Minor Chord Progression <span class="float-right">7</span><br> Harmonic Minor Song <span class="float-right">13</span><br> Dotted Half Note Dance <span class="float-right">17</span><br> Melodic Minor Scales <span class="float-right">21</span><br> First Waltz <span class="float-right">25</span><br> The Sustain Pedal <span class="float-right">29</span><br> Bringing It All Together In Song <span class="float-right">33</span><br> Conclusion <span class="float-right">37</span>',
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "7",
                    "title" => "The Circle Of 5ths",
                    "desc" => 'Introduction <span class="float-right">1</span><br> What Is The Circle Of 5ths? <span class="float-right">3</span><br> The Symmetry Of 4ths And 5ths <span class="float-right">7</span><br> The Sharped Circle: The Right Side <span class="float-right">11</span><br> The Flattened Circle: The Left Side <span class="float-right">15</span><br> The Major Chords Of The Circle <span class="float-right">19</span><br> The Minor Chords Of The Circle <span class="float-right">25</span><br> Working With The Circle In Major Keys <span class="float-right">29</span><br> Bringing It All Together In Song <span class="float-right">35</span><br> Conclusion <span class="float-right">43</span>',
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "8",
                    "title" => "Learning To Improvise",
                    "desc" => 'Introduction <span class="float-right">1</span><br> Broken Chord Inversion Patterns <span class="float-right">3</span><br> Arpeggio Melodies <span class="float-right">7</span><br> Chord Embellishments <span class="float-right">11</span><br> Left Hand Rhythm Engine <span class="float-right">15</span><br> The Safe Notes <span class="float-right">21</span><br> The Two Moods Of The Perfect 5th <span class="float-right">25</span><br> Improv Flow State <span class="float-right">29</span><br> Bringing It All Together In Song <span class="float-right">31</span><br> Conclusion <span class="float-right">39</span>',
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "9",
                    "title" => "7th Chords & The Blues",
                    "desc" => 'Introduction <span class="float-right">1</span><br> 7th Chords <span class="float-right">3</span><br> 12-Bar Blues <span class="float-right">13</span><br> The Minor Pentatonic Scale <span class="float-right">17</span><br> The Blues Scale <span class="float-right">23</span><br> Blues Basslines <span class="float-right">27</span><br> Blues Rhythm Pattern <span class="float-right">31</span><br> Blues Fills And Tricks <span class="float-right">35</span><br> Bringing It All Together In Song <span class="float-right">41</span><br> Conclusion <span class="float-right">49</span>',
                    ])

                    @include('_partials.components.question-dropdown', [
                    "num" => "10",
                    "title" => "Intro To Jazz",
                    "desc" => 'Introduction <span class="float-right">1</span><br> Applying 7th Chords <span class="float-right">3</span><br> Chord Modifiers <span class="float-right">11</span><br> A Jazz Chord Progression <span class="float-right">19</span><br> Walking Basslines <span class="float-right">23</span><br> Piano Modes - A New Way To See Scales <span class="float-right">27</span><br> “Autumn Leaves” - The A Section <span class="float-right">33</span><br> “Autumn Leaves” - The B & C Sections <span class="float-right">37</span><br> Bringing It All Together In Song <span class="float-right">41</span><br> Conclusion <span class="float-right">51</span>',
                    ])
                </div>
            </div>

        </div>
    </section>
    <section class="bg-musora-black text-white py-8 sm:py-12 relative z-20 text-center">
        <div class="container mx-auto">
            <h1 class="font-bold mb-10 sm:mb-16 leading-tight text-lg sm:text-2xl md:text-3xl lg:text-4xl"><strong>What students are saying about Lisa &<br class="hidden sm:inline"> the Pianote Foundations book set.</strong></h1>
            <div class="testimonials px-6">
                <div class="sm:flex items-start justify-center mb-10 sm:mb-16">
                    <img class="rounded-full border-4 bg-pianote border-pianote w-24 sm:w-32 md:w-40 mb-3 sm:mb-0" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/testimonials/dominic.jpg">
                    <div class="text-left sm:pl-4 md:pl-6">
                        <h3 class="text-sm sm:text-lg md:text-xl font-extrabold">"I've felt motivated to learn because of them."</h3>
                        <p class="text-xs sm:text-sm mt-3 mb-5 max-w-2xl">The idea of having tangible course material to accompany the online lessons was such an appealing prospect; especially as I love to learn from books.<br><br>I have noticed a considerable improvement in both my practical skills and theoretical knowledge.<br><br>I cannot recommend them highly enough; they've brought structure and understanding to the whole process of learning the foundations of the piano. Most importantly though, they're a joy to follow. I've felt motivated to learn because of them.</p>
                        <p class="text-xs sm:text-sm font-extrabold text-pianote">Dominic Morgan</p>
                        <p class="text-xs sm:text-sm">United Kingdom</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-navy-800 text-white relative z-20 text-center">
        <div class="py-8 sm:py-12" style="background-image: url(data:image/png;base64,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);">
            <div class="container mx-auto relative z-20">
                <img class="inline-block w-1/2 sm:w-2/5 md:w-1/3 mb-10 sm:mb-12 md:mb-20" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/pianote-foundations-logo.png">

                <div class="sm:flex items-center justify-center px-6">
                    <img class="w-1/3 sm:w-1/4 lg:w-1/5 mx-auto sm:mx-0 mb-4 sm:mb-0" src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/sales/pianote-foundations-box-set.png">
                    <div class="sm:pl-12 lg:pl-20">
                        <h1 class="font-extrabold leading-tight text-lg sm:text-2xl md:text-3xl lg:text-4xl"><strong>The Complete Pianote<br> Curriculum At Your Fingertips</strong></h1>
                        <h4 class="mt-4 sm:mt-6 mb-5 sm:mb-8 text-base md:text-lg">GET THE ENTIRE SET TODAY.<br><strong class="font-bold">JUST $149 USD</strong></h4>


                        @if($products['pianote-foundation']->getStockAvailability() < 1)
                            <a class="join sold-out mt-3 mb-5 sm:mb-10 w-full max-w-2xl text-lg sm:text-xl md:text-2xl lg:text-3xl">SOLD OUT!</a>
                        @else
                            <a
                                class="join vue-add-to-cart w-full text-lg sm:text-xl md:text-2xl lg:text-3xl"
                                href="/ecommerce/add-to-cart?products[pianote-foundation]=1"
                                data-product-json='{"pianote-foundation": 1}'
                            >CLICK HERE TO ORDER »</a>
                        @endif


                    </div>
                </div>
            </div>
            <div class="absolute top-0 left-0 right-0 z-10 h-1/2" style="background: linear-gradient(180deg, #000C17 60%, transparent);"></div>
        </div>
    </section>
    <section class="bg-musora-black text-white py-8 sm:py-12 relative z-20 text-center border-t-4 border-pianote">
        <div class="container mx-auto">
            <h1 class="font-bold mb-8 sm:mb-10 leading-tight text-lg sm:text-2xl md:text-3xl lg:text-4xl"><strong>Still have questions?</strong></h1>
            <div class="px-6 mx-auto max-w-4xl">
                @include('_partials.components.question-dropdown', [
                "num" => '?',
                "title" => "Are these books for me?",
                "desc" => "Yes! Ok, we can’t say for sure. But if you’ve made it this far we’re going to assume you want to learn the piano, and play it beautifully. That’s what these books are designed to help you do."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => '?',
                "title" => "Do I need to be a Pianote member to buy the books?",
                "desc" => "No! You can buy and learn from these books on their own. BUT they were designed to work hand-in-hand with a Pianote membership."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => '?',
                "title" => "How long will it take me to go through all 10 books?",
                "desc" => "How long is a piece of string? Joking aside, that really depends on how much practice and time you’re able to put in!<br>But if you were able to commit to daily practice and took advantage of all the extra resources you could reasonably expect to go through all books within a year. That means you’re only 12 months (or less) away from playing beautifully the way that you want.<br>Learning the piano is a lifelong process, so you’ll probably want to return to these books, again and again, to keep your skills sharp!<br>"
                ])
                @include('_partials.components.question-dropdown', [
                "num" => '?',
                "title" => "Are the books sold separately or together?",
                "desc" => "These books are presented in a beautiful box-set. The curriculum is designed to be followed from the first page to the last, so all 10 books are included."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => '?',
                "title" => "How much does shipping cost?",
                "desc" => "Shipping rates will vary depending on the shipping location. Check to see your location:<br>US - $9<br>Canada, UK, Germany $15<br>Everywhere else $40<br>Unfortunately, international shipping is much higher than we’d like and there’s no quick way for us to lower the cost. We’ll be looking at finding local distribution centers in the future"
                ])
                @include('_partials.components.question-dropdown', [
                "num" => '?',
                "title" => "How long will it take for the books to arrive?",
                "desc" => "Here are the general shipping guidelines:<br>US 2-10 Business Days<br>Everywhere Else: 7-20 Business Days"
                ])
            </div>
        </div>
    </section>



    @include('pianote.sales.partials._footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var stickyBook = $("header .book");
            $(window).scroll(function () {
                var logo = $(".sticky-trigger").offset().top;
                if ($(this).scrollTop() > (logo)) {
                    stickyBook.removeClass('absolute');
                    stickyBook.addClass('fixed top-0');
                } else {
                    stickyBook.addClass('absolute');
                    stickyBook.removeClass('fixed top-0');
                }
            });

            // featured post header slider
            var $dayAgenda = $('.tab-content'),
                $toggleButton = $('.tab-switcher');

            var current = 0;

            // $dayAgenda.first().addClass('active');
            // $toggleButton.first().addClass('active');

            var updateIndex = function (current) {
                $dayAgenda.removeClass('active');
                $toggleButton.removeClass('active');

                $dayAgenda.eq(current).addClass('active');
                $toggleButton.eq(current).addClass('active');
            };

            $toggleButton.on('click', function (e) {
                e.stopPropagation();
                e.preventDefault();
                updateIndex($toggleButton.index($(this)));
                current = $toggleButton.index($(this));
            });

            $('.dropdown').on('click', function(){
                $(this).toggleClass('active');
                $(this).find('i').toggleClass('rotate-180');
            });
        });

        document.addEventListener('click', function (event) {
            if (!event.target.closest('.modal-trigger')) return;

            document.querySelector('body').classList.add("modal-open");
            document.querySelector('.modal-content').classList.add("active");
            document.querySelector('.modal-bg').classList.add("active");

        }, false);
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.modal-bg')) return;

            document.querySelector('body').classList.remove("modal-open");
            document.querySelector('.modal-content').classList.remove("active");
            document.querySelector('.modal-bg').classList.remove("active");

        }, false);
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
@stop
