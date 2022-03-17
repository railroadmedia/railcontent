@extends('guitareo._partials.layout')

@section('head-includes')
    @parent

    <meta name="robots" content="noindex">

    <title>STOP! | 1-Hour Challenge</title>
    <meta name="description" content="Rob Scallon will lead you on a guitar adventure with 9 free videos to gain the fundamentals, transition between chords, and play a full song from start to finish. Are you up for the challenge?"/>

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/og-image.jpg">
    <meta property="og:title" content="Play Your First Song On The Guitar | 1-Hour Challenge">
    <meta property="og:description" content="Play your first song on the guitar, start to finish, in an hour -- even if you’ve never played before.">
    <meta property="og:url" content="https://www.guitareo.com/song-in-an-hour/">

    <style>
        .hero-header:after {
            content:none;
        }
    </style>
@stop

@section('layout-body')
    <header class="hero-header text-center px-3 py-5 md:py-6 lg:py-16 relative text-white" style="background: linear-gradient(180deg, #010611, #10052b);">
        <div class="container mx-auto relative z-10">
            <h2 class="leading-none"><strong>🛑 <span class="leading-none text-3xl md:text-5xl lg:text-6xl align-middle">STOP</span> 🛑</strong></h2>
            <p class="mt-2 mb-4 leading-relaxed md:leading-loose" style="max-width: 590px;">Playing your first song is just the beginning…</p>
            <div class="mx-auto" style="max-width:590px;">
                <div class="aspect-16:9 w-full relative mt-5 mb-7">
                    <iframe class="absolute w-full h-full rounded-lg inset-0" src="//player.vimeo.com/video/522493783" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <h5 class="leading-tight"><strong>CONTINUE YOUR JOURNEY <i class="fas fa-long-arrow-right mx-1 text-purple"></i> <br class="inline sm:hidden"> SAVE {{ round(100 - (100 * (\App\Prices::$guitarQuestSpecial / \App\Prices::$guitarQuestFull))) }}% ON GUITARQUEST</strong></h5>
            <p class="mt-4 mb-8 leading-relaxed md:leading-loose text-left" style="max-width: 590px;">
                Congratulations on taking the <em>Song In An Hour Challenge</em>. We’re so excited that you’ve started your guitar journey and we’re here to support you the rest of the way.
                <br><br>
                <em>Song In An Hour</em> is actually the FIRST level of GuitarQuest. And because we hope you’ll keep learning with us, we’re giving you a {{ round(100 - (100 * (\App\Prices::$guitarQuestSpecial / \App\Prices::$guitarQuestFull))) }}% discount to make things a little easier. Just click any of the big buttons on this page to continue your journey.
            </p>
            <a class="join px-16 sm:px-16" href="/guitar-quest-discount">Get My Discount &raquo;</a>
        </div>
    </header>
    <section class="text-white text-center px-3 py-6 lg:py-16" style="background:#010611;">
        <div class="container mx-auto">
            <p class="mb-4 sm:mb-8">Or if you’d like to continue learning <br class="inline sm:hidden">for free, here are two bonus videos:</p>

            <a target="_blank" class="button outline inline-block white mb-1 sm:mb-0 px-5 sm:px-12 mx-1" href="/song-in-an-hour/writing-a-melody">WRITING A MELODY <i class="fad fa-external-link ml-1"></i></a>
            <a target="_blank" class="button outline inline-block white px-5 sm:px-12 mx-1" href="/song-in-an-hour/next-steps">NEXT STEPS ON GUITAR <i class="fad fa-external-link ml-1"></i></a>
        </div>
    </section>
@stop