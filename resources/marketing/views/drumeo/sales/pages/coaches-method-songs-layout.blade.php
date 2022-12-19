@extends('_partials.layout.coaches-method-songs-layout')

@section('page-nav')
    @if(!empty($trialVersion))
        @if(!empty($joinUrl))
            @include("drumeo.sales.partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "joinUrl" => $joinUrl
            ])
        @else
            @include("drumeo.sales.partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "scrollToJoin" => true,
            ])
        @endif
    @else
        @include("drumeo.sales.partials._nav", [
            "edgeVersion" => true,
            "scrollToJoin" => true,
            "homepage" => true
        ])
    @endif
@endsection

@section('page-footer')
    @include('musora.sales.order-section-collage', [
        'header' => 'Unlimited drum lessons<br> The world’s best teachers<br> 5000+ popular songs',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by 30,000 students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches"><i class="fa-li fas fa-check"></i> <strong>*BONUS*</strong> includes free access to Musora’s lessons for piano, guitar, and voice.</li>',
        'buttonLink' => '/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[30-day-drummer]=1&products[practicepad]=1&products[Drumeo-VaterSticks]=2&products[BeginnerBook]=1&locked=true',
        'price' => '20',
        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/august/order_collage.png',
    ])

    @include('musora.sales.app-section', [
        'appleLink' => 'https://itunes.apple.com/us/app/musora/id1619053766?ls=1',
        'googleLink' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
        'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/devices.png',
    ])

    @php
        $faqs = [
            [
            "title" => "What is Drumeo?",
            "description" => 'Drumeo is an online platform that offers an organized drum curriculum, artist courses on popular topics, 5000+ songs transcribed note-for-note, and a supportive global community of students and teachers. ',
            ],
            [
            "title" => "Is Drumeo good for beginners?",
            "description" => 'Yes! You’ll always know what to practice with sequential step-by-step video lessons – plus have fun applying your new skills to your favorite songs, sorted by skill level. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community. ',
            ],
            [
            "title" => "Does Drumeo have anything for advanced drummers?",
            "description" => 'Drumeo is the perfect companion for advanced drummers, giving you access to artist courses so you can gain insights and inspiration from the legends – with 200+ artist courses on a variety of topics. Plus, you’ll get note-for-note transcriptions for thousands of songs and practical playback tools, so you can take on any new challenge with confidence. ',
            ],
            [
            "title" => "Am I too old to learn the drums?",
            "description" => 'You’re never too old to learn the drums. Drumeo has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with drummers just like you who are learning and applying their skills to music. ',
            ],
            [
            "title" => "Do I need to be tech-savvy to learn through your app?",
            "description" => 'Not at all! Technology is here to make your life easier, and Drumeo is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support. ',
            ],
        ]
    @endphp

    @include('musora.sales.faq-section')

    @include("drumeo.sales.partials._footer")
@endsection
