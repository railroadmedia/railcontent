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

    <div class="container jordan-message mx-auto lg:max-w-6xl flex flex-wrap items-center">
        <div class="w-full md:w-1/4 lg:w-1/5 text-center px-4">
            <img class="mx-auto" src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lisa-witt.jpg" alt="lisa-witt">
        </div>
        <div class="w-full md:w-3/4 lg:w-4/5 px-4">
            <div class="medium-heading mt-4 mb-2 lg:mt-6">Start Reading Music On The Piano In Minutes!</div>
            <p class="small-body">
                Reading music can be daunting, but it doesn't have to be! In these beginner focused lessons you'll learn how to start reading music in just a few minutes. By the end, you'll be able to pay songs by reading notes on the page.
            </p>
        </div>
        <div class="w-full px-4 mt-3 text-center">
            <a class="join smaller mb-2 sm:mb-0 sm:mr-4" href="https://d1923uyy6spedc.cloudfront.net/234984-resource-1571407196.pdf">DOWNLOAD NOTE VALUE SHEET</a>
            <a class="join smaller" href="https://d1923uyy6spedc.cloudfront.net/Symbols%20Glossary%20v2-1656630668.pdf">DOWNLOAD MUSIC SYMBOLS GLOSSARY</a>
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

    @include('pianote.lead-gen.learn-to-play.elements.red-signup')
@stop
