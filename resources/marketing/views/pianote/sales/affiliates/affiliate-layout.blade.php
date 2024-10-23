@extends('pianote.sales.subscription')

@section('global-head')
    <title>@yield('name') | Pianote Trial</title>
    <meta property="og:title" content="@yield('name') | Pianote Trial">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}/">
    @parent
@endsection

@section('share-image')
    @hasSection('url')
        <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=540,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/trials/@yield('url').jpg" style="display: none;">
    @else
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/share-image-pianote2.webp ">
    @endif
@endsection

@section('top-bar')
    @include('drumeo.sales.affiliate._affiliate-banner', [
        'slug' => 'd2vyvo0tyx8ig5',
        'theme' => 'pianote'
    ])
@endsection
