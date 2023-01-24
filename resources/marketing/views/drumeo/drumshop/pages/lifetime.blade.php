@extends('drumeo.drumshop.shop-page-layout')

@section('meta')
    @parent
    <title>The Lifetime Bundle</title>
    <meta name="description" content="Get A Lifetime Drumeo Membership + FREE In-Ear Headphones, An Exclusive Masterclass, And More!">
    <meta property="og:description" content="Get A Lifetime Drumeo Membership + FREE In-Ear Headphones, An Exclusive Masterclass, And More!">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/promos/november/lifetime-fb-share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@php
    $bonuses = [
        [
            'name' => 'Drumeo EarDrums',
            'price' => 'Normally $149',
            'desc' => 'Drumeo EarDrums reduce external volume by up to -29dB. That means you can play hard while protecting your ears.',
            'freeBonus' => true,
            'freeShipping' => true,
            'lineBreak' => true,
            'img' => 'https://cdn.musora.com/image/fetch/c_fill,w_300,q_auto:good/https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/eardrums.jpg'
        ],
        [
            'name' => '12 Pairs of Drumeo Drumsticks',
            'price' => 'Normally $155.40',
            'desc' => 'The Drumeo 5A Drumsticks by Vater -- made of hickory for strength and durability, featuring up to 2X the moisture content than most manufacturers for longer-lasting sticks, and personally hand-rolled by Alan Vater to ensure they’re weighted and tone-matched to perfection.',
            'freeBonus' => true,
            'freeShipping' => true,
            'lineBreak' => true,
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/drumsticks.jpg'
        ],
        [
            'name' => 'Drum Technique Made Easy',
            'price' => 'Normally $197',
            'desc' => 'Technique guru Bruce Becker delivers an intimate 26-week course where you’ll get his proven process for improving your hand technique and foot technique so you can develop more speed and control around the kit -- all while preventing injuries & enjoying the music.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/dtme.jpg'
        ],
        [
            'name' => 'Better Drum Fills',
            'price' => 'Normally $97',
            'desc' => 'The ultimate crash course to playing more creative and more musical drum fills your audience will love. Rather than memorizing and playing the same fills over and over again, you’ll gain the skills you need to create effective drum fills on the fly and adapt them to any musical setting.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/fwtbdf.jpg'
        ],
        [
            'name' => 'Rock Drumming Masterclass',
            'price' => 'Normally $197',
            'desc' => 'Rock icon Todd Sucherman is your personal drum coach with a 26-week online course to rapidly improve your rock drumming. You’ll get weekly video lessons and exercises to improve your beats, fills, creativity, solos, bass drum combinations, hand technique, shuffles & variations, musicality, and more.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/rdm.jpg'
        ],
        [
            'name' => 'Independence Made Easy',
            'price' => 'Normally $197',
            'desc' => 'Freedom starts here. Jared Falk’s 26-week course was built to unlock all four limbs so you can play more musical grooves, better sounding fills, and finally achieve the musical freedom that allows you to play whatever you want, whenever you want.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/ime.jpg'
        ],
        [
            'name' => 'Electrify Your Drumming',
            'price' => 'Normally $197',
            'desc' => 'Electrify Your Drumming will teach you the tools and styles of electronic dance music -- so you can build energy with risers, lock in with the vocals, add power to your beats and fills, create a climax in the music, and ultimately fuel any song with your playing -- giving you valuable skills that will apply to every style of music.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/eyd.jpg'
        ],
        [
            'name' => 'Successful Drumming',
            'price' => 'Normally $247',
            'desc' => 'Jared Falk’s step-by-step curriculum for building a rock-solid foundation on the drums. This digital training pack includes 18 hours of video lessons and a 274-page workbook -- helping you lock in with other musicians, prepare for gigs, and set yourself up for a successful experience on the drums.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/sd.jpg'
        ],
        [
            'name' => 'Learn Songs Faster',
            'price' => 'Normally $19',
            'desc' => 'A 75-minute masterclass with Jared Falk & Dave Atkinson to help you learn MORE songs in less time -- from active listening that’ll help you hear phrasing and understand song structure, to building effective grooves and fills, and keeping time so your playing always matches the music.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/lsf.jpg'
        ],
        [
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/language-of-drumming.jpg",
        "name" => "The Language Of Drumming",
        "desc" => "Benny Greb’s system for musical expression -- featuring 3 hours of online video lessons to help you express your ideas on the drums.",
        "price" => "Normally $29.99",
        'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
        ],
        [
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/anatomy-of-a-drum-solo.jpg",
        "name" => "Anatomy Of A Drum Solo",
        "desc" => "Neil Peart breaks down his approach to drum soloing -- with 3 hours of online video to improve your rhythm and improvisation.",
        "price" => "Normally $29.99",
        'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
        ],
        [
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/creative-control.jpg",
        "name" => "Creative Control",
        "desc" => "Thomas Lang’s innovative system for developing technique so you can play more effectively in any style of music.",
        "price" => "Normally $29.99",
        'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
        ],
        [
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/the-grid.jpg",
        "name" => "The Grid",
        "desc" => "Mike Mangini’s system for creative drumming and improvisation -- including 3 hours of video for expanding your skills.",
        "price" => "Normally $29.99",
        'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
        ],
        [
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/great-hands-for-a-lifetime.jpg",
        "name" => "Great Hands For A Lifetime",
        "desc" => "Tommy Igoe helps you improve your hand strength, speed, stamina, comfort, and control in the drums. ",
        "price" => "Normally $29.99",
        'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
        ],
        [
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/beyond-the-chops.jpg",
        "name" => "Beyond The Chops",
        "desc" => "A 3-hour experience showcasing Aaron Spears’ phenomenal drumming through performances, educational segments, and interviews.",
        "price" => "Normally $29.99",
        'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
        ],
        [
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/in-constant-motion.jpg",
        "name" => "In Constant Motion",
        "desc" => "7 hours of instruction, live and studio performances, and insights into Mike Portnoy’s various drumming projects.",
        "price" => "Normally $29.99",
        'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
        ],
        [
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/hands-grooves-fills.jpg",
        "name" => "Hands Grooves & Fills",
        "desc" => "Pat Petrillo’s curriculum for developing technique, groove ideas, and a drum fill vocabulary.",
        "price" => "Normally $29.99",
        'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
        ],
        [
        "img" => "https://dzryyo1we6bm3.cloudfront.net/card-thumbnails/packs/550/methods-and-mechanics.jpg",
        "name" => "Methods & Mechanics",
        "desc" => "Todd Sucherman’s award-winning lessons, delivering solos and playing examples in an array of styles as well as technical lessons to enhance your rhythmic and musical vocabulary.",
        "price" => "Normally $29.99",
        'freeBonus' => true,
            'lifetimeAccess' => true,
            'lineBreak' => true,
        ],
    ];
@endphp

@section('top')
    @include('_partials.components.shop.slider', [
        "headerText" => "<strong>Get A Lifetime Drumeo Membership + FREE In-Ear Headphones, An Exclusive Masterclass, And More!</strong>",
        "videoSrc" => "//player.vimeo.com/video/774477396",
        "videoThumb" => "https://drumeo-assets.s3.amazonaws.com/promos/november/practice-anywhere-thumb.jpg",
        "noSlider" => true
    ])

        @include('_partials.components.shop.sidebar', [
            "bundle" => true,
            "logo" => "https://drumeo-assets.s3.amazonaws.com/promos/november/lifetime-bundle-white.png",
            "sku" => "products[DLM-Lifetime]=1&products[drumeo-eardrums]=1&products[Drumeo-VaterSticks]=12&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&products[TLOD-DIGI]=1&products[MAM-DIGI]=1&products[GHFAL-DIGI]=1&products[HGAF-DIGI]=1&products[AOADS-DIGI]=1&products[ICM-DIGI]=1&products[BTC-DIGI]=1&products[CC-DIGI]=1&products[TG-DIGI]=1&locked=true",
            "fullPrice" => 1200,
            "price" => 1200,
            "specialText" => "+$1725.31 In FREE Bonuses",
            "freeShipping" => true,
            "invert" => true,
            "soldOut" => true
        ])
@endsection

@section('bottom')
    <h3 class="text-center" style="margin-bottom: 15px;"><strong>What's included:</strong></h3>
    <img src="https://cdn.musora.com/image/fetch/c_fill,w_800,q_auto:good/https://drumeo-assets.s3.amazonaws.com/promos/november/lifetime-bundle-spread2.png">
    <br><br>
    <p>“My soul is that of a drummer. I didn’t do it to become rich and famous. I did it because it was the love of my life.” – Ringo Starr
        <br><br>
        If you feel like Ringo, we want to invite you to make a lifelong commitment to your drumming. Drumeo Lifetime Memberships are back – for Cyber Monday ONLY!
        <br><br>
        This is your chance to make one final payment for your Drumeo Membership and then enjoy unlimited drum lessons, song breakdowns, and LIVE events with your favorite drummers for years to come.
        <br><br>
        And heads up: You can split the payment for 1, 2, or 5 installments. (You’ll see that option upon checkout.)
        <br><br>
        You’ll also get FREE bonuses with your membership – including a NEW pair of Drumeo EarDrums + an exclusive masterclass with award-winning Drumeo Coach, Todd Sucherman.
        <br><br>
        Scroll down to see everything included with your Drumeo Lifetime Membership and we’ll see you with your little infinity badge around your name very soon!
    </p>
    <hr class="tw-my-5">

    <p>
        <strong>Say hello to your free bonuses:</strong><br>
        <em style="opacity: 0.5;">All digital bonuses are added to your account instantly with your membership to Drumeo, and they’re yours forever.</em>
    </p>
    <br>
    @include('drumeo.drumshop._partials.bonuses')

    <a href="#order" class="anchor-slide join tw-inline lg:tw-hidden">Jump To Top <i class="fas fa-angle-up"></i></a>
@endsection
