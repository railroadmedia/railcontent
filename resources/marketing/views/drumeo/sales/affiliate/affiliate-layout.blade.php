@extends('drumeo.sales.subscription')

@section('global-head')
    <title>@yield('name') | Drumeo Trial</title>
    <meta property="og:title" content="@yield('name') | Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}/">
    @parent
@endsection

@section('share-image')
    @hasSection('url')
        <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=540,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/trials/@yield('url').jpg" style="display: none;">
    @else
        <meta property="twitter:image" content="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2024/twitter-image.webp">
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/share-image-drumeo.webp">
    @endif
@endsection

@section('top-bar')
    @include('drumeo.sales.affiliate._affiliate-banner', [
        'slug' => 'dpwjbsxqtam5n',
        'theme' => 'drumeo'
    ])
@endsection
