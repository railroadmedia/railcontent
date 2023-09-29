@extends('pianote.lead-gen.lead-gen-layout-tw',[ 'appTailwind' => true, ])

@section('meta')
    <title>Song Secrets | Pianote</title>
    <meta property="og:title" content="Song Secrets | Pianote">

    <meta name="description" content="The Fastest Way to Play Popular Songs on the Piano">
    <meta property="og:description" content="The Fastest Way to Play Popular Songs on the Piano">

    <meta property="og:image" content="TODO" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/song-secrets-webinar">
@stop

@section('head')
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
@stop

@section('page-body')
    <div class="overflow-hidden px-3 py-5 sm:py-10 lg:py-14 text-white bg-cover bg-center text-center" style="background:#ac1179 url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/order-bg.jpg');">
        <div class="container mx-auto max-w-3xl clearfix">
            <h5 class="leading-tight mb-4"><strong>Ready to get started?</strong> Click this button to start your Song Secrets Webinar.</h5>
            <a href="" class="join white smaller">go to the webinar</a>
        </div>
    </div>
    <div class="overflow-hidden px-3 py-5 sm:py-10 lg:py-14">
        <div class="container mx-auto max-w-4xl clearfix">
            <div class="text-center sm:px-3">
                <h3 class="font-bebas tracking-widest my-4 text-pianote">SONG SECRETS</h3>
                <h3 class="mt-4 leading-tight"><strong>Congratulations! Your seat is secure!</strong></h3>
                <p class="leading-normal mt-2 mb-12">Here’s what you need to do now…</p>
                <div class="flex flex-wrap sm:text-left">
                    <div class="w-full sm:w-5/12 mx-auto px-10 max-w-xs sm:max-w-full sm:pl-0 sm:pr-5 relative">
{{--                        <img class="absolute top-0 right-0 -mx-14 -my-3 h-14" src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png" style="filter: sepia()saturate(20)brightness(.8)hue-rotate(-17deg);">--}}
{{--                        <div class="w-full relative rounded-xl overflow-hidden shadow-lg" style="padding-bottom: 177%;">--}}
{{--                            <iframe class="fixed inset-0 h-full w-full absolute" src="//player.vimeo.com/video/TODO" frameborder="0" allowfullscreen title="intro-video"></iframe>--}}
{{--                        </div>--}}
                        <img class="w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/lisa-witt-profile-m.png">
                    </div>
                    <p class="w-full sm:w-7/12 mt-8 sm:mt-0 flex-shrink sm:pl-4">
                        <strong><i class="fas fa-check text-pianote"></i> Check your email.</strong><br>
                        You’ll have a confirmation email landing in your inbox in the next few minutes. It has a link to your Webinar plus a free gift just for you! If you don’t see it, check your spam or junk folder. And if you still can’t find it, please email <a href="mailto=support@pianote.com"><u>support@pianote.com</u></a> and we’ll be able to help you.
                        <br><br>
                        <strong><i class="fas fa-check text-pianote"></i> Bookmark this page.</strong><br>
                        This page is your gateway to the Webinar. Along with the email, it’s the easiest way to find and rewatch the lesson. So save this page!
                        <br><br>
                        <strong><i class="fas fa-check text-pianote"></i> Invite some friends!</strong><br>
                        Music is better when it’s shared. So if you have a friend or family member who might like this Webinar, please forward this link to them: <a href="/song-secrets-webinar"><u>https://www.pianote.com/song-secrets-webinar</u></a>
                        <br><br>
                        <strong><i class="fas fa-check text-pianote"></i> Enjoy!</strong><br>
                        You’re about to learn some amazing tips that will change the way you think about learning the piano. So remember to have fun - because that’s what it’s all about!
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
