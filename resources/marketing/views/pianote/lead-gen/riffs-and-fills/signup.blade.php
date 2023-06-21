@extends('pianote.lead-gen.riffs-and-fills.riffs-and-fills-layout')

@section('page-body')
    <header class="header text-center">
        <div class="container mx-auto" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/header.jpg);">
            <img class="logo"
                    src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/piano-riffs-fills-logo.png"><br>
            <i class="fas fa-play play-vimeo autoplay-video" data-open="trailer"></i>
            <h2>The shortcuts to <br class="inline md:hidden"><strong>sounding great</strong> on the piano.</h2>
            <h3 class="my-5 text-pianote"><strong>Only <s class="opacity-80">${{ floatval($productPrices['piano-riffs-and-fills']->price) }}</s> FREE until Nov 15th!</strong></h3>

            <div class="form-wrap max-w-4xl mx-auto">
                @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                    "formId" => "Pianote - Engagement - Trigger - Riffs And Fills - Web Form",
                    "formName" => 'Riffs And Fills',
                ])
            </div>
        </div>
    </header>

    <section class="more-songs">
        <div class="container mx-auto">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/piano-music-icons.png">
            <p>Anyone can play a chord -- but what happens in the spaces <strong>between</strong> the chords distinguishes the great players from the mediocre ones.
                <br><br>
                Fill those spaces with piano riffs that will make you sound professional, polished ... and close to perfect. Learn the secrets and tips to play fills that <strong>sound</strong> complicated and advanced, but are actually very <strong>simple</strong> to learn and start adding to your repertoire.
            </p>
        </div>
    </section>

    <div class="reveal large text-center" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/423703341?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <div id="twoResults" class="anchor"></div>
    <section class="two-video-example text-center">
        <div class="container mx-auto clearfix">
            <h1><strong>One song. Two completely<br class="inline md:hidden"> different results.</strong></h1>
            <p>Compare these two performances. It’s the same song both times, but the result is VERY different. That’s what happens when you add simple riffs to level-up your playing.</p>
            <div class="thumb float-left px-3 md:px-4 w-full md:w-1/2">
                <div class="vid-wrap">
                    <video class="example-video" controls
                            src="https://player.vimeo.com/external/424916734.sd.mp4?s=e1fa392592f09e0fb1200d64a4f13394fd76743c&profile_id=164"
                            poster="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/without-the-magic-thumb.jpg">
                    </video>
                </div>
                <p><strong>Without The Magic</strong><br>
                    The performance is the song using only the chords. There are no riffs
                    or fills of any kind. It sounds … nice. But there’s something missing,
                    isn’t there? Your ears just know it.</p>
            </div>

            <div class="thumb float-left px-3 md:px-4 w-full md:w-1/2 active">
                <div class="vid-wrap">
                    <video class="example-video" controls
                            src="https://player.vimeo.com/external/424916715.sd.mp4?s=d14abee48e9ec12729b52458c00108e83f7c7044&profile_id=164"
                            poster="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/with-the-magic-thumb.jpg">
                    </video>
                </div>
                <p><strong>With The Magic</strong><br>
                    Here’s the same song using only riffs and fills that you’ll learn in
                    <em>Piano Riffs & Fills</em>. Just the simple addition of these tips
                    completely changes the way the song (and the player) sounds.</p>
            </div>

        </div>
    </section>

    <section class="thumb-grid text-center">
        <div class="container mx-auto clearfix">
            <h1><strong>It’s time to sound<br class="inline md:hidden"> like a professional.</strong></h1>
            <p>Each lesson is designed to build on the previous one, so you’ll be reinforcing what you’ve already learned while developing new skills. It WILL take practice -- but it won’t take months. Most students can expect to complete these lessons in less than two weeks (including practice time).</p>
            <div class="image-grid-item float-left px-3 md:px-4 w-full md:w-1/3">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-1.jpg">
                <p><span class="text-red"><strong>Chords and Inversions</strong></span><br>
                    The building blocks of piano riffs. You’ll learn how to play chord inversions and start using them to make your songs sound better.</p>
            </div>

            <div class="image-grid-item float-left px-3 md:px-4 w-full md:w-1/3">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-2.jpg">
                <p><span class="text-red"><strong>How to Use Inversions to Create Fills</strong></span><br>
                    Start filling in the spaces with simple riffs that sound amazing. You’ll see how easy piano riffs can be.</p>
            </div>

            <div class="image-grid-item float-left px-3 md:px-4 w-full md:w-1/3">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-3.jpg">
                <p><span class="text-red"><strong>The “Sus-Trill”</strong></span><br>
                    Learn one of the most beautiful and versatile fills in piano music. Add sparkle to your playing with this fill -- which sounds much more complicated than it is.</p>
            </div>

            <div class="image-grid-item float-left px-3 md:px-4 w-full md:w-1/3">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-4.jpg">
                <p><span class="text-red"><strong>Unlock The Secrets</strong></span><br>
                    Discover the magic behind Lisa’s favorite piano fills and how to actually USE them to in songs.</p>
            </div>

            <div class="image-grid-item float-left px-3 md:px-4 w-full md:w-1/3">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-5.jpg">
                <p><span class="text-red"><strong>Left-Hand Fills & Fancy Tricks</strong></span><br>
                    Because it’s not just the right hand. Find out how simple tricks can elevate your left-hand playing and fill out those songs.</p>
            </div>

            <div class="image-grid-item float-left px-3 md:px-4 w-full md:w-1/3">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-6.jpg">
                <p><span class="text-red"><strong>Advanced Riff & Fill Concepts</strong></span><br>
                    Connect every riff, fill and tip you’ve learned and see how to apply it to pretty much ANY song you’ll ever play. Warning - some practice required!</p>
            </div>
        </div>
    </section>

    <section class="play-songs text-center">
        <div class="container mx-auto clearfix">
            <h1><strong>Play the sounds you<br class="inline md:hidden"> hear in your head.</strong></h1>
            <div class="benefit-tile float-left px-3 md:px-4 w-full md:w-1/2">
                <i class="fas fa-stopwatch"></i>
                <p>
                    <strong>Short Lessons</strong><br> Spend more time playing, not practicing. Each lesson is around 5 to 7 minutes long.
                </p>
            </div>
            <div class="benefit-tile float-left px-3 md:px-4 w-full md:w-1/2">
                <i class="fas fa-list-ol"></i>
                <p>
                    <strong>Perfect For All Levels</strong><br> Structured step-by-step lessons you can take at your own pace.
                </p>
            </div>
            <hr style="opacity: 0;margin:0;" class="float-left w-full hidden md:inline-block">
            <div class="benefit-tile float-left px-3 md:px-4 w-full md:w-1/2">
                <i class="fas fa-piano-keyboard"></i>
                <p>
                    <strong>Practice-along Exercises</strong><br> Play-along exercises will help you master the fundamentals and build the foundation needed for success.
                </p>
            </div>
            <div class="benefit-tile float-left px-3 md:px-4 w-full md:w-1/2">
                <i class="fas fa-music"></i>
                <p>
                    <strong>Apply It To Any Song</strong><br> Add these fills to your repertoire. Perfect for pretty much any popular song!
                </p>
            </div>
            <hr style="opacity: 0;margin:0;" class="float-left w-full hidden md:inline-block">
            <div class="benefit-tile float-left px-3 md:px-4 w-full md:w-1/2">
                <i class="fas fa-file-download"></i>
                <p>
                    <strong>Downloadable Resources</strong><br> Helpful guides to download, print, and keep by the piano. Never forget what you’ve learned.
                </p>
            </div>
            <div class="benefit-tile float-left px-3 md:px-4 w-full md:w-1/2">
                <i class="fas fa-infinity"></i>
                <p>
                    <strong>Yours Forever</strong><br> These lessons NEVER expire. Watch them again, and again, and again… (you get the point).
                </p>
            </div>
        </div>
    </section>

    <section class="personal-teacher text-center" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lisa-witt-image.jpg);">
        <div class="container mx-auto clearfix">
            <div class="name-wrap float-right">
                <h1>LISA WITT</h1>
                <h3 class="text-red">Your Teacher & Practice Planner</h3>
            </div>
            <hr style="width:100%;opacity: 0;">
            <p>Hi, I’m Lisa Witt and I’m so excited to show you how to instantly improve your playing sound and style with Piano Riffs & Fills.
                <br><br>
                I’ve performed with and observed close up some world-class musicians and the biggest thing I learned from them is this…
                <br><br>
                Sounding amazing does NOT have to be complicated!
                <br><br>
                It’s incredible what a difference some basic riffs and fills can make.
                <br><br>
                These are the fills that are used on the world stage. It’s not rocket science, but it will take your playing to that next level.
                <br><br>
                I’ve also learned that being CONFIDENT with your playing and knowing HOW and WHEN to execute your skills is what will set you apart from other players.
                <br><br>
                That’s what this course is all about, and I can’t wait to help you.
                <br><br>
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lisa-witt-signature.png">
            </p>
        </div>
    </section>

    <section class="final text-center" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/order-background.jpg);">
        <div class="container mx-auto">
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/piano-riffs-fills-logo.png">
            <h2>The shortcuts to <strong>sounding great</strong> on the piano.</h2>
            <div class="form-wrap max-w-4xl mx-auto">
                @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                    "formId" => "Pianote - Engagement - Trigger - Riffs And Fills - Web Form",
                    "formName" => 'Riffs And Fills',
                ])
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script>
        $(document).ready(function ($) {
            $(".example-video").on('play', function () {
                $(".example-video").not(this).trigger('pause');
                $('.thumb').removeClass('active');
                $(this).parents('.thumb').addClass('active');
            });
        });
    </script>
@endsection
