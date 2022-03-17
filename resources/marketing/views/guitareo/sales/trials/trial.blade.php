@extends('guitareo.sales.standard-layout', [
    "trialVersion" => true
])

@section('head-includes')
    @parent

    <title>Online Beginner Guitar Lessons | Guitareo.com</title>
    <meta property="og:url" content="https://www.guitareo.com/trial"/>
    <meta property="og:title" content="Guitareo.com: Online Beginner Guitar Lessons"/>
@endsection

@section('final')
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include("guitareo.sales.partials._final-trial", [ "sevenDay" => true, "url" => "/choose-your-trial/" ])
@endsection