@extends('partials.layout')

@section('meta')
    <title>Cohort Template | Musora</title>
@endsection

@section('styles')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
@endsection

@section('content')
    <header class="tw-bg-[#F1F7FE] tw-py-4 md:tw-py-7 tw-px-4">
        <div class="tw-max-w-5xl tw-mx-auto">
            <div class="md:tw-flex tw-items-center tw-gap-6 tw-mb-12 tw-text-center md:tw-text-left">
                <div class="md:tw-flex-1">
                    <img class="tw-h-14 sm:tw-h-18 lg:tw-h-20 tw-mb-2 tw-inline-block" alt="new piano players start here logo" src="https://www.musora.com/musora-cdn/image/width=440,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/new-piano-players-start-here-logo-2+1.png">
                    <h1 class="tw-font-extrabold tw-text-3xl lg:tw-text-4xl">Online piano lessons </h1>
                    <h2 class="tw-font-normal tw-text-2xl lg:tw-text-3xl">for all skill levels.</h2>
                    <p class="tw-font-bold tw-mt-4 lg:tw-mt-6 tw-mb-7 lg:tw-mb-9">Save your seat for season 2 starting May 1st.</p>
                    <img class="tw-rounded-xl md:tw-hidden tw-mb-6" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/header-thumb2.jpg" alt="header thumb" />
                    <div class="md:tw-flex md:tw-items-center">
                        <a class="tw-uppercase tw-bg-{{ $brand }} tw-rounded-full tw-py-2 tw-w-full md:tw-w-1/2 tw-text-white tw-text-center tw-font-bebas-neue tw-mr-2 tw-max-w-[415px] tw-inline-block tw-mb-5 md:tw-mb-0">Enroll Now</a>
                        <div class="md:tw-w-1/2 tw-flex tw-items-center tw-justify-center md:tw-justify-start">
                            <img class="tw-h-8 md:tw-h-6 tw-mr-1" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png" alt="joined student profiles">
                            <p class="tw-text-xs tw-align-middle tw-max-w-[180px] md:tw-max-w-full tw-text-left">Join 8,539 piano players who have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="md:tw-flex-1 tw-hidden md:tw-block">
                    <img class="tw-rounded-xl" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/header-thumb2.jpg" alt="header thumb" />
                </div>
            </div>
            <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-text-center tw-border tw-rounded-lg tw-border-gray-300 tw-mb-2 lg:tw-mb-4">
                <div class="tw-w-full sm:tw-w-auto tw-border-b sm:tw-border-b-0 sm:tw-border-r tw-border-gray-300 tw-py-4 sm:tw-py-3 lg:tw-py-4">
                    <p class="tw-tracking-wide tw-opacity-70 tw-text-sm">STARTS ON</p>
                    <h4 class="tw-px-3 lg:tw-px-5"><strong>February 27th</strong></h4>
                    <hr class="tw-border-gray-300 tw-my-4 sm:tw-my-2 lg:tw-my-4">
                    <p class="tw-text-sm tw-px-3 lg:tw-px-5">
                        Enrollment closed
                    </p>
                </div>
                <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-evenly tw-w-full sm:tw-w-auto sm:tw-flex-grow tw-py-4 sm:tw-py-3 lg:tw-py-4 tw-text-left sm:tw-text-center">
                    <div class="tw-flex sm:tw-block tw-w-full sm:tw-w-auto tw-px-4 sm:tw-px-3 tw-mb-4 sm:tw-mb-0">
                        <i class="far fa-fw tw-mr-3 sm:tw-mr-0 fa-calendar-day tw-text-{{ $brand }} tw-text-2xl" aria-hidden="true"></i>
                        <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">Course Dates</strong><br>
                            <span class="tw-text-sm"> February 27th to<br class="tw-hidden sm:tw-inline"> March 28th.</span></p>
                    </div>
                    <div class="tw-flex sm:tw-block tw-w-full sm:tw-w-auto tw-px-4 sm:tw-px-3 tw-mb-4 sm:tw-mb-0">
                        <i class="far fa-fw tw-mr-3 sm:tw-mr-0 fa-clock tw-text-{{ $brand }} tw-text-2xl" aria-hidden="true"></i>
                        <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">Commitment</strong><br>
                            <span class="tw-text-sm">10 minutes/day<br class="tw-hidden sm:tw-inline"> for 30 days.</span></p>
                    </div>
                    <div class="tw-flex sm:tw-block tw-w-full sm:tw-w-auto tw-px-4 sm:tw-px-3">
                        <i class="far fa-fw tw-mr-3 sm:tw-mr-0 fa-trophy tw-text-{{ $brand }} tw-text-2xl" aria-hidden="true"></i>
                        <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">Result</strong><br>
                            <span class="tw-text-sm">Play real songs on the <br> piano and sound beautiful.</span></p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="tw-bg-white tw-pt-7">
        <div class="tw-max-w-5xl tw-mx-auto tw-px-4 md:tw-px-10">
            <h3 class="tw-font-extrabold tw-text-center tw-mb-7">Learn the piano in 30 days.</h3>
            <p class="md:tw-px-10 tw-mb-52">
                You don’t learn by watching. You learn by doing. <br><br>

                Start the year off right and learn the piano by playing the piano. You’ll be playing a song from the very first lesson and you’ll follow along with 10-minute daily guided sessions that show you exactly what to play.<br><br>

                No complicated theory. No need to read music. No frustration.<br><br>

                All you have to do is press play and follow along. Plus, you’ll have a weekly live lesson with Lisa Witt to answer your questions, stay motivated, and make sure you’re on track and having FUN on the piano.<br><br>

                So if you’re a new piano player and you’re wondering where to start…<br><br>

                Start here.<br><br>

                Scroll down to save your seat.
            </p>

        </div>
    </section>
    <section class="tw-bg-[#F1F7FE] tw-pb-7">
        <div class="tw-max-w-5xl tw-mx-auto tw-px-4 md:tw-px-10 -tw-mt-40">
            <div class="tw-relative tw-cursor-pointer tw-mb-10">
                <img class="tw-rounded-xl" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/video-thumb.jpg" alt="video thumb" />
                <div class="tw-absolute tw-inset-0 tw-flex tw-justify-center tw-items-center">
                    <i class="fa-regular fa-play tw-z-10 tw-border-white tw-border-4 tw-text-white tw-py-3 md:tw-py-6 tw-pl-5 md:tw-pl-8 tw-pr-4 md:tw-pr-6 tw-rounded-full tw-text-3xl md:tw-text-5xl tw-bg-[rgba(0,0,0,0.2)]"></i>
                </div>
            </div>
            <img class="tw-h-10 sm:tw-h-16 tw-mb-8 tw-mx-auto" alt="just play logo" src="https://www.musora.com/musora-cdn/image/width=1220,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/Just_Press_Play_logo.png">
            <p class="tw-text-center tw-px-6">
                New Piano Players Start Here is unlike any other way to learn the piano. From day 1 you’ll be playing a REAL song by following guided play-along lessons with your instructor, Lisa Witt.<br><br>

                This isn’t a video game. You’ll be building your skills every single day. And the best part…<br><br>

                It only takes 10 minutes a day.<br><br>
            </p>
        </div>
    </section>

    @php
        $faqs = [
            [
                "title" => "What is Pianote?",
                "desc" => 'Pianote is an online platform that offers an organized piano lesson curriculum, artist courses on popular topics, 1000+ songs transcribed note-for-note, and a supportive global community of students and teachers.',
            ],
            [
                "title" => "Is Pianote good for beginners?",
                "desc" => 'Yes! You’ll always know what to practice with step-by-step video lessons – plus have fun applying your new skills to your favorite songs, sorted by skill level. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community. ',
            ],
            [
                "title" => "Does Pianote have anything for advanced pianists?",
                "desc" => 'Pianote is the perfect companion for advanced pianists, giving you access to artist courses so you can gain insights and inspiration from professionals. Plus, you’ll get note-for-note sheet music for thousands of songs and practical playback tools, so you can take on any new challenge with confidence.',
            ],
            [
                "title" => "Am I too old to learn piano?",
                "desc" => 'You’re never too old to learn piano. Pianote has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with aspiring pianists just like you who are learning and applying their skills to music.',
            ],
            [
                "title" => "Do I need to be tech-savvy to learn through your app?",
                "desc" => 'Not at all! Technology is here to make your life easier, and Pianote is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support.',
            ],
        ]
    @endphp

    <section class="tw-bg-white tw-py-7">
        <div class="tw-max-w-4xl tw-mx-auto tw-pl-6 tw-pr-4">
            <h3 class="tw-font-extrabold tw-text-center tw-mb-7">Still have questions?</h3>
            @foreach($faqs as $faq)
                @include('partials._question-dropdown', [
                    'num' => '?',
                    "title" => $faq['title'],
                    "desc" => $faq['desc'],
                ])
            @endforeach
            <h3 class="tw-font-extrabold tw-text-center tw-mt-10">Commit to Your Improvement</h3>
            <p class="tw-font-bold tw-text-center tw-mt-4 tw-mb-6">Classes start on {date}.</p>
            <div class="tw-max-w-[415px] md:tw-max-w-xl tw-mx-auto tw-flex tw-flex-col md:tw-flex-row md:tw-gap-2 tw-mb-4">
                <a class="tw-uppercase tw-bg-{{ $brand }} tw-rounded-full tw-py-2 tw-w-full md:tw-w-1/2 tw-text-white tw-text-center tw-font-bebas-neue tw-mb-2 md:tw-mb-0">Enroll Now</a>
                <a class="tw-uppercase tw-border-2 tw-border-black tw-rounded-full tw-py-2 tw-w-full md:tw-w-1/2 tw-text-center tw-font-bebas-neue tw-text-black">Join the conversation</a>
            </div>
            <div class="tw-max-w-[250px] tw-mx-auto tw-flex tw-justify-center tw-items-center">
                <img class="tw-h-7 sm:tw-mb-1 lg:tw-mb-0 tw-mr-1" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png" alt="joined student profiles">
                <p class="tw-text-xs tw-align-middle">Join 8,539 piano players who have already registered.</p>
            </div>
        </div>
    </section>
@endsection
