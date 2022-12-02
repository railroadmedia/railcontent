@extends('products.product-layout')

@section('meta')
    @parent
    <title>Drumeo Gift Card</title>
    <meta name="description" content="Give the gift of drum lessons with a gift card to Drumeo -- with your choice between a one-month, 6-month, or 1-year membership pass.">
    <meta property="og:image" content="https://s3.amazonaws.com/drumeo-packs/Merch/pass.jpg" style="display: none;">
    <meta property="og:description" content="Give the gift of drum lessons with a gift card to Drumeo -- with your choice between a one-month, 6-month, or 1-year membership pass.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <?php
    \App\Analytics\Tracker::trackProductImpression('PASS-1');
    \App\Analytics\Tracker::trackProductImpression('PASS-6');
    \App\Analytics\Tracker::trackProductImpression('PASS-12');
    ?>
@stop()

@section('banner')
    @include('products.partials.promo-banner', [
        "name" => "Drumeo Gift Card",
        "fullPrice" => Prices::$cardMonth,
        "price" => Prices::$cardMonth,
        "videos" => true
    ])
@endsection

@section('top')
    @include('products.partials.slider', [
        "headerText" => "<strong>The perfect gift for ANY drummer!</strong>",
        "videoSrc" => "//player.vimeo.com/video/495414119",
        "videoThumb" => "https://s3.amazonaws.com/drumeo-packs/Merch/pass.jpg",
    ])

    @include('products.partials.sidebar', [
        "options" => true,
        "optionText" => "Pick Duration",
        "price" => Prices::$cardMonth,
        "variations" => [
            (object)[
                "name" => "30 Days",
                "fullPrice" => Prices::$cardMonthFull,
                "price" => Prices::$cardMonth,
                "sku" => "PASS-1"
            ],
            (object)[
                "name" => "6 Months",
                "fullPrice" => Prices::$cardSix,
                "price" => Prices::$cardSix,
                "sku" => "PASS-6"
            ],
            (object)[
                "name" => "1 Year",
                "fullPrice" => Prices::$cardYear,
                "price" => Prices::$cardYear,
                "sku" => "PASS-12"
            ]
        ],
    ])
@endsection

@section('bottom')
    <p>The Drumeo Gift Card is a physical access pass that you can use for yourself, or to send as a gift to another drummer.
        Simply choose a membership card with 1, 6, or 12 months of access.
        We’ll ship it to you, and once it arrives it can be <a href="https://drumeo.com/redeem" target="_blank">redeemed by anybody, anytime</a>.
        <br><br>
        <strong>Drumeo offers ongoing access to:</strong></p>
    <ul>
        <li><strong>The Drumeo Method:</strong> Our 10-level step-by-step curriculum so you always know exactly what to practice next.</li>
        <li><strong>Artist Courses:</strong> {{ Prices::$courses }}+ mini-courses by the best drummers and teachers in the world, always teaching the specific topics that made them famous!</li>
        <li><strong>Famous Songs:</strong> {{ Prices::$songs }}+ play-along songs featuring our on-screen practice tools so you can play with or without the metronome, create loops, and learn your favorite songs faster.</li>
        <li><strong>Entertaining Shows:</strong> We’ll take you beyond the classroom with entertaining shows for drummers including DIY Drum Experiments, Exploring Beats, In Rhythm, and Study The Greats.</li>
        <li><strong>Personal Support:</strong> You’ll have unlimited access to our community forums, student plans, weekly live streams, video reviews, and more!</li>
    </ul>
@endsection