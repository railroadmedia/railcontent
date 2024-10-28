@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp
@extends('pianote.sales.subscription', [
    "promoVersion" => true,
    "hideHeader" => true,
])

@section('global-head')
    <title>Learn Piano with Step by Step Online Lessons | Pianote</title>
    <meta property="og:title" content="Pianote - The Better Way To Learn Piano">
    <meta property="og:url" content="https://www.pianote.com/welcome-offer">
    @parent
@endsection

@section('promo-banner')
    @php
        $bubbles =  [
             [
                 'src' => $bubble1,
                 'classes' => 'h-10 sm:h-14 lg:h-16 top-[53%] sm:top-[53%] left-[4%] sm:left-[4%]',
             ],
             [
                 'src' => $bubble2,
                 'classes' => 'h-24 sm:h-28 lg:h-44 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]',
             ],
             [
                 'src' => $bubble3,
                 'classes' => 'h-32 sm:h-40 lg:h-52 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]',
             ],
             [
                 'src' => $bubble4,
                 'classes' => 'h-10 sm:h-12 lg:h-16 top-[13%] sm:top-[13%] left-[31%] sm:left-[31%]',
             ],
             [
                 'src' => $bubble5,
                 'classes' => 'h-10 sm:h-12 lg:h-16 top-[8%] sm:top-[8%] left-[58%] sm:left-[58%]',
             ],
             [
                 'src' => $bubble6,
                 'classes' => 'h-28 sm:h-32 lg:h-48 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]',
             ],
             [
                 'src' => $bubble7,
                 'classes' => 'h-28 sm:h-36 lg:h-52 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]',
             ],
             [
                 'src' => $bubble8,
                 'classes' => 'h-12 sm:h-14 lg:h-16 top-[63%] sm:top-[63%] left-[99%] sm:left-[99%]',
             ]
         ];
          $features = $pianote['features'];
          $slides = $pianote['slides'];
    @endphp
    @include('musora.sales.components.header-section', [
        'header' => 'NEED MORE TIME?<br class="hidden lg:inline"> TRY  PIANOTE <br class="hidden lg:inline"><span class="relative inline-block">FREE FOR 30 DAYS.<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>
        ',
        'boldText' => 'Life is busy, and we get it. <br> That’s why we’re giving you a whole month<br> to try Pianote—completely risk-free.',
        'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
        'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/header-thumb2.webp',
        'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb2.webp',
        'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb-m2.webp',
        'pointOne' => 'GREAT TEACHERS',
        'pointTwo' => 'VIDEO LESSONS',
        'pointThree' => 'FUN PRACTICE',
        'pointFour' => 'POPULAR SONGS',
        'noTrailer' => true,
    ])
@endsection
@section('final')
    @include('musora.sales.components.order-section-collage', [
    'headerLight' => true,
    'logo' => 'marketing/pianote/membership/homepage/2024/pianote-logo-red.webp',
    'header' => '<strong>Unlimited piano lessons.<br>Guided practice sessions. <br> Direct access to real teachers.</strong>',
    'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Online piano lessons on every topic.</li>
    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Personalized feedback from real teachers.</li>
    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',
    'image' => 'marketing/pianote/membership/homepage/2024/collage.webp',
    ])
@endsection
