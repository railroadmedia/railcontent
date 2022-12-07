@php
  require_once(resource_path('marketing/views/pianote/lead-gen/sight-reading-made-simple/lessons.php'))
@endphp

@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    @parent
@stop()

@section('title', 'Sight Reading Made Simple')

@section('meta-description', 'If you’ve ever struggled through a music class or felt daunted by the notes on the page -- let us show you how easy reading music can be.')

@section('meta-img', 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/og-image.jpg')

@section('meta-url', 'https://www.pianote.com/sight-reading-made-simple')

@section('lesson-logo', 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/logo.png')

@section('lesson-index-url', '/sight-reading-made-simple/lessons')

@section('lesson-total-number', 4)

@section('series')
    @include('pianote.lead-gen.partials._lesson-tiles',[
        'width' => 'w-1/2 md:w-1/4',
    ])
@endsection

@section('assets')
    <div class="flex flex-col sm:justify-between sm:flex-row">
        <a class="join smaller w-full sm:w-1/2 mr-10 mb-2 sm:mb-0" href="https://d1923uyy6spedc.cloudfront.net/234984-resource-1571407196.pdf">DOWNLOAD NOTE VALUE SHEET</a>
        <a class="join smaller w-full sm:w-1/2" href="https://d1923uyy6spedc.cloudfront.net/Symbols%20Glossary%20v2-1656630668.pdf">DOWNLOAD MUSIC SYMBOLS GLOSSARY</a>
    </div>
@stop

@section('offers')
    @include('pianote.lead-gen.learn-to-play.elements.red-signup')
@endsection
