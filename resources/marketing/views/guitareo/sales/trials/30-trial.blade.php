@extends('guitareo.sales.standard-layout', [
"trialVersion" => true
])

@section('meta')
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:url" content="https://www.guitareo.com/trial"/>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    @parent
@endsection

@section('start-button', '/choose-your-trial-month/')

@section('final')
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include("guitareo.sales.partials._final-trial", [ "url" => "/choose-your-trial-month" ])
@endsection
