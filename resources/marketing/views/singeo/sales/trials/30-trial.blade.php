@extends('singeo.sales.standard-layout', [
"trialVersion" => true
])

@section('global-head')
    <title>Your start-to-finish guide to confident singing | Singeo.com</title>
    <meta property="og:url" content="https://www.singeo.com/trial"/>
    <meta property="og:title" content="Singeo.com: Your start-to-finish guide to confident singing"/>
    @parent
@endsection

@section('final')
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include("sales.partials._final-trial", [ "url" => "/choose-your-trial-month" ])
@endsection
