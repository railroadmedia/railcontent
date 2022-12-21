@extends('_partials.layout.coaches-method-songs-layout')

@section('page-nav')
    @include('pianote._partials._nav')
@endsection

@section('page-footer')
    @include('musora.sales.components.order-section-collage', [
        'header' => '',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by 30,000 students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches"><i class="fa-li fas fa-check"></i> <strong>*BONUS*</strong> includes free access to Musora’s lessons for piano, guitar, and voice.</li>',
        'buttonLink' => '/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[30-day-drummer]=1&products[practicepad]=1&products[Drumeo-VaterSticks]=2&products[BeginnerBook]=1&locked=true',
        'price' => '20',
        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/august/order_collage.png',
    ])

    @include('musora.sales.components.app-section', [
        'appleLink' => 'https://itunes.apple.com/us/app/musora/id1619053766?ls=1',
        'googleLink' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
        'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/devices.png',
    ])

    @php
        $faqs = [
            [
                "title" => "What is Pianote?",
                "description" => 'Pianote is an online platform that offers an organized piano lesson curriculum, artist courses on popular topics, 1000+ songs transcribed note-for-note, and a supportive global community of students and teachers.',
            ],
            [
                "title" => "Is Pianote good for beginners?",
                "description" => 'Yes! You’ll always know what to practice with sequential step-by-step video lessons – plus have fun applying your new skills to your favorite songs, sorted by skill level. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community.',
            ],
            [
                "title" => "Does Pianote have anything for advanced pianists?",
                "description" => 'Pianote is the perfect companion for advanced pianists, giving you access to artist courses so you can gain insights and inspiration from professionals. Plus, you’ll get note-for-note sheet music for thousands of songs and practical playback tools, so you can take on any new challenge with confidence.',
            ],
            [
                "title" => "Am I too old to learn piano?",
                "description" => 'You’re never too old to learn piano. Pianote has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with aspiring pianists just like you who are learning and applying their skills to music.',
            ],
            [
                "title" => "Do I need to be tech-savvy to learn through your app?",
                "description" => 'Not at all! Technology is here to make your life easier, and Pianote is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support.',
            ],
        ]
    @endphp

    @include('musora.sales.components.faq-section')

    @include('pianote._partials._footer')
@endsection
