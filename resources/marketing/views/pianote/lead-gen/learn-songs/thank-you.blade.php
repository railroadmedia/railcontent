@extends('pianote.lead-gen.learn-songs.learn-songs-layout')

@section('page-body')
    <div class="overflow-hidden text-white px-3 py-5 sm:py-7" style="background-color:#030317;">
        <div class="container mx-auto clearfix" style="max-width:940px">
            <div class="text-center sm:px-3">
                <img class="logo mx-auto inline-block w-40 sm:w-56" src="https://www.musora.com/musora-cdn/image/width=448,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/logo-horizontal.png">
                <div class="video-row relative my-4 sm:my-7">
                    <div class="aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/556324794" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="title-header-interaction text-center">
                <div class="px-2 md:px-3">
                    <h3><strong><span class="text-pianote">CONGRATULATIONS!</span> YOU’RE IN!</strong></h3>
                    <p class="mt-2 sm:mt-4 max-w-xl"><strong>YOUR SONGS WILL BE LANDING IN YOUR INBOX IN JUST A SECOND!</strong><br>
                        You should receive an email in just a few minutes. If you don’t see it, check your spam folder in case it got lost along the way.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
