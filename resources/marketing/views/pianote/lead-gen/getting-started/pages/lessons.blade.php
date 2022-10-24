@extends('pianote.lead-gen.getting-started.layout')

@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>Getting Started On The Piano | Pianote</title>
@stop()

@section('page-body')
    @include('pianote.lead-gen.partials.header2',[
        "bg" => 'url("https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/bg.jpg") center center/cover no-repeat',
        "imgSrc" => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/logo-2.svg',
        "text" => '<div class="medium-body mt-4"><em>Go from absolute beginner to playing your first song in four easy lessons!</em></div>'
    ])

    <div class="container jordan-message mx-auto lg:max-w-6xl flex flex-wrap items-center">
        <div class="w-full md:w-1/4 lg:w-1/5 text-center px-4">
            <img class="mx-auto" src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lisa-witt.jpg" alt="lisa-witt">
        </div>
        <div class="w-full md:w-3/4 lg:w-4/5 px-4">
            <div class="medium-heading mt-4 mb-2 lg:mt-6">Start your piano journey today!</div>
            <p class="small-body">Want to learn how to play the piano but have absolutely no idea where to start? You’ve come to the right place! By the end of this series, you will know how to find notes on the piano, how to play scales, and even popular songs!</p>
        </div>
    </div>

    @include('pianote.lead-gen.partials.series1',[
        "customSize" => "w-full md:w-1/2",
        "lessons" => [
            [
                "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/sit-down-now-what.png',
                "boxAlt" => "sit-down-now-what",
                "watchLink" => "/getting-started/lessons/now-what",
            ],
            [
                "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/scales.png',
                "boxAlt" => "scales",
                "watchLink" => "/getting-started/lessons/scales",
            ],
            [
                "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/minor-scale.png',
                "boxAlt" => "minor-scale",
                "watchLink" => "/getting-started/lessons/minor-scale",
            ],
            [
                "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/your-first-song.png',
                "boxAlt" => "your-first-song",
                "watchLink" => "/getting-started/lessons/first-song",
            ],
        ],
    ])
    @include('pianote.lead-gen.learn-to-play.elements.red-signup')
@stop
