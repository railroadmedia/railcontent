@extends('guitareo.sales.subscription')

@section('global-head')
    <title>@yield('name') | Guitareo Trial</title>
    <meta property="og:title" content="@yield('name') | Guitareo Trial">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}/">
    @parent
@endsection

@section('share-image')
    @hasSection('url')
        <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=540,quality=95/https://d122ay5chh2hr5.cloudfront.net/sales/trials/@yield('url').jpg" style="display: none;">
    @else
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/guitareo/membership/homepage/2024/share-image-guitareo.webp"/>
    @endif
@endsection

@section('top-bar')
    @include('drumeo.sales.affiliate._affiliate-banner', [
        'slug' => 'd122ay5chh2hr5',
        'theme' => 'guitareo',
    ])
@endsection

@section('scripts')
    @include("guitareo.lead-gen.partials.impact-email-sign-up-tracker")
    @include("_partials.layout.everflow-product-tracker", ['advertiserId' => config('railanalytics.drumeo.production.providers.everflow.brand_id')])
@endsection
