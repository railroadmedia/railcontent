@php
  require_once(resource_path('marketing/views/pianote/lead-gen/sight-reading-made-simple/lessons.php'))
@endphp

@extends('pianote.lead-gen.sight-reading-made-simple.layout')

@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>Sight Reading Made Simple | Pianote</title>
@stop()

@section('page-body')
    <div class="promo-heading-background container-fluid no-padding" style="background: url(https://d2vyvo0tyx8ig5.cloudfront.net/sales/customize-bg.jpg) 50%/cover no-repeat;">
        <div class="container promo-heading series mx-auto py-10 md:py-12 lg:max-w-6xl lg:py-16">
            <img class="learn-to-play-logo" style="margin-bottom: 0;" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/logo.png" alt="learn-to-play-logo">
        </div>
    </div>

    @include('pianote.lead-gen.partials.series1',[
        "customSize" => "w-full md:w-1/2",
        "lessons" => [
            [
                "boxImage" => "https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb1.jpg",
                "boxAlt" => "thumb1",
                "watchLink" => "/sight-reading-made-simple/lessons/1",
                "title" => "Getting Started With Sight-Reading",
                "badge" => "Lesson #1",
            ],
            [
                "boxImage" => "https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb2.jpg",
                "boxAlt" => "thumb2",
                "watchLink" => "/sight-reading-made-simple/lessons/2",
                "title" => "The Treble Clef",
                "badge" => "Lesson #2",
            ],
            [
                "boxImage" => "https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb3.jpg",
                "boxAlt" => "thumb3",
                "watchLink" => "/sight-reading-made-simple/lessons/3",
                "title" => "The Bass Clef",
                "badge" => "Lesson #3"
            ],
            [
                "boxImage" => "https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb4.jpg",
                "boxAlt" => "thumb4",
                "watchLink" => "/sight-reading-made-simple/lessons/4",
                "title" => "The Grand Staff",
                "badge" => "Lesson #4"
            ],
        ],
    ])

    @include('pianote.lead-gen.partials._7-day-trial-offer')
@stop
