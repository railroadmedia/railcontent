@php
    $buttonLink = '/ecommerce/add-to-cart?products[everyday-improv]=1'; 
    $fullPrice  = 97;
    $price = 97;
@endphp


<header class="text-white relative overflow-hidden z-10" style="height:700px;background-color:#000;">
    <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center py-80 md:py-48 lg:py-40">
        <div class="container mx-auto max-w-5xl capitalize">
            <img alt="Everyday Improv Logo" class="h-16 sm:h-20 lg:h-24 my-4"
                 src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/header-logo.svg">
            <br>
            <h1 class="leading-normal"><strong>Sing Freely With The Power<br class="hidden md:block"/>Of Vocal Improvisation</strong></h1>
            <h6 class="italic leading-relaxed">30 Days of Guided Workouts Led By Emma Nissen For <br/> Beginner &amp; Intermediate Singers</h6>
            <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                <div class="sm:w-5/12 join smaller outline hidden sm:inline-block bg-transparent hover:bg-white hover:text-black"
                     @click="trailer = true;">
                    &nbsp;Watch Trailer
                </div>
                <div class="w-full sm:w-5/12 join smaller outline sm:hidden inline-block bg-transparent hover:bg-white hover:text-black"
                     x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false" @click="trailer = true;">
                    &nbsp;Watch Trailer
                </div>
                <a class="w-full sm:w-5/12 join smaller text-white my-2 sm:m-2 anchor-slide" href="#customize-anchor">GET STARTED</a>
            </div>
            {{-- <h5>Only
                @if($price > $fullPrice)
                    <s class="opacity-50">${{ $price }}</s>
                    <strong>${{ $fullPrice }}</strong>
                    <em class="text-musora text-sm">(Save {{ round(100 - (100 * ($fullPrice / $price))) }}%)</em>
                @else
                    <strong>${{ $fullPrice }}</strong>
                @endif
            </h5> --}}
        </div>
    </div>
    <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(2, 11, 22, 0.6)"></div>
   <img class="hidden sm:inline object-cover w-full h-full relative z-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/singeo/products/everyday-improv/header.webp">
          <img class="sm:hidden object-cover w-full h-full relative z-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/singeo/products/everyday-improv/header.webp">
</header>

 <section class="relative text-center px-4 sm:px-6 md:pt-20 lg:pt-32 bg-cover bg-center" style="background-color:#EFF4FB;">
        <div class="pt-4 md:pt-0">
            <div class="container max-w-5xl mx-auto mb-20 -mt-20 md:-mt-28 lg:-mt-48 z-20 relative flex justify-center items-center">
                <div class="px-5 lg:px-0">
                    @php
                        $items = [
                            [
                                'text' => '1.',
                                'highlight' => 'Watch A Lesson a day <br class="inline sm:hidden">for 30 days.'
                            ],
                            [
                                'text' => '2.',
                                'highlight' => 'Practice Alongside Emma.'
                            ],
                            [
                                'text' => '3.',
                                'highlight' => 'Sing with a new found <br class="inline sm:hidden"> confidence'
                            ]
                        ];
                    @endphp
            
                    <div class="flex flex-wrap sm:flex-nowrap text-center shadow-xl rounded-xl relative" style="background:#DAB3F8">
                        <div class="z-10 flex flex-wrap items-center justify-center w-full sm:w-auto sm:flex-grow py-4 sm:py-6 lg:px-16 text-left sm:text-center">
                            @foreach ($items as $index => $item)
                                <div class="flex sm:block w-full sm:w-1/3 px-8 sm:px-0 mb-4 sm:mb-0">
                                    <div class="flex flex-row items-center sm:px-4 md:px-8">
                                        <h1 class="leading-tight font-bebas font-medium text-singeo mx-0 pb-1 text-5xl">{{ $item['text'] }}</h1>
                                        <p class="text-base sm:text-xs md:text-base font-black px-1 md:px-2 uppercase text-left font-bold">{!! $item['highlight'] !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="container max-w-5xl pb-12 mx-auto">
            <div class="mx-auto">
                <h2 class="text-center mb-4 capitalize leading-none">
                    <strong>Do You Struggle To Find <br class="hidden md:block"/>The "Right" Notes?</strong>
                </h2>
                <div class="text-center mb-4 md:mb-8 space-y-4">
                    <p>Most singers love to sing along with their favorite songs.</p>
                    <p>But what happens when you're asked to sing without a guide? Many singers struggle <br class="hidden md:block"/>to find the right notes or create melodies on the spot.</p>
                </div>
                <div class="grid sm:grid-cols-2 gap-6 md:gap-8">
                    <div class="p-6 sm:p-4 md:p-12 rounded-xl bg-[#DEE5EF]">
                        <h6 class="mb-4 lg:mb-6 tracking-tight text-left"><strong>Without vocal improvisation, singers often:</strong></h6>
                        <ul class="space-y-4">
                            @foreach ([
                                'Feel intimidated by the thought of creating melodies and rhythms without lyrics',
                                'Feel insecure about singing the "wrong" note or out of key',
                                'Struggle to find the right notes over a chord progression.'
                            ] as $item)
                                <li class="flex items-start pb-3">
                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/cross-icon.svg" class="w-4 h-4 mt-1 mr-2 flex-shrink-0" alt="Cross Icon">
                                    <p class="text-left m-0 leading-tight">{{ $item }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="p-4 sm:p-2 md:p-12 bg-white rounded-xl">
                        <h6 class="mb-4 lg:mb-6 tracking-tight text-left"><strong>With vocal improvisation, you will:</strong></h6>
                        <ul class="space-y-4">
                            @foreach ([
                                'Feel comfortable with making decision in the heat of the moment.',
                                'Sing with confidence knowing they can overcome any "wrong" note and make it right.',
                                'Identify notes, rhythms, and melodies over any given song or chord progression.'
                            ] as $item)
                                <li class="flex items-start pb-3">
                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/arrow-icon.svg" class="w-4 h-4 mt-1 mr-2 flex-shrink-0" alt="Arrow Icon">
                                    <p class="text-left m-0 leading-tight">{{ $item }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#EFF4FB;">
        <div class="container max-w-4xl mx-auto">
            <h2 class="capitalize leading-tight mb-7 sm:mb-12"><strong>Unlock Confidence With The <br>Tools Of Vocal Improvisation</strong></h2>
            @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/singeo/products/everyday-improv/timeline-01.webp',
                        'desc' => '<strong>Find your range</strong> so that you can comfortably improvise within it.',
                    ],
                    [
                        'position' => 'right',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/singeo/products/everyday-improv/timeline-02.webp',
                        'title' => 'Match pitch to single notes and chords',
                        'desc' => '<strong>Match pitch to single notes and chords</strong> to make finding the right note feel like second nature.',
                    ],
                    [
                        'position' => 'left',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/singeo/products/everyday-improv/timeline-03.webp',
                        'desc' => '<strong>Turn mistakes into music</strong> by learning to make a "wrong" note sound right.',
                    ],
                    [
                        'position' => 'right',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/singeo/products/everyday-improv/timeline-04.webp',
                        'desc' => '<strong>Master scat improv</strong> with fun syllables, rhythms, and dynamics to improve your ability to find melodies.',
                    ],
                    [
                        'position' => 'left',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/singeo/products/everyday-improv/timeline-05.webp',
                        'desc' => '<strong>Build confidence to sing with any song</strong>—even ones you’ve never heard!',
                    ]
                    ];
            @endphp
            <div class="timeline-container singeo max-w-4xl mx-auto relative px-4 pt-7">
                @foreach ($gettings as $key => $getting)
                        @if ($getting['position'] === 'right')
                            <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-24 mb-16 md:mb-20">
                                <div class="content relative text-left md:pr-10">
                                    <h6 class="leading-normal">{!! $getting['desc'] !!}</h6>                            
                                </div>
                                @if (!empty($getting['special']))
                                    <video class="-mt-7 rounded-lg" src="{{ $getting['special'] }}" type="video/mp4" autoplay muted loop>
                                    </video>
                                @else
                                    <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}" alt="{{ $getting['desc'] }}" />
                                @endif
                            </div>
                        @else
                            <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if ($key !== count($gettings) - 1) mb-16 md:mb-20 @else md:mb-10 @endif">
                                @if (!empty($getting['special']))
                                    <video class="-mt-7 rounded-lg" src="{{ $getting['special'] }}" type="video/mp4" autoplay muted loop>
                                    </video>
                                @else
                                    <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}" alt="{{ $getting['desc'] }}" />
                                @endif
                                <div class="content relative text-left md:mb-10 md:pl-10">
                                    <h6 class="leading-normal mb-2 md:mb-5 mt-1 md:mt-0">{!! $getting['desc'] !!}</h6>
                                </div>
                            </div>
                        @endif
                    @endforeach
            </div>
        </div>
        <h1 class="leading-none sm:-mt-14 md:-mt-16 hidden md:block"><i class="fal fa-angle-down text-singeo"></i></h1>
        <div>
            <a class="anchor-slide join smaller w-11/12 sm:max-w-[350px] mt-10 py-4" href="#customize-anchor">GET STARTED</a>
        </div>
    </section>


    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-24" style="background:#ffffff;">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-6 capitalize"><strong> The Ultimate Learning Experience</strong></h2>

            @php
                $learners = [
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/singeo/products/everyday-improv/learning-01.webp',
                        'title' => 'Learn All You Need To Know In Just <br/> 30-days',
                        'description' =>
                            '30 days is all you need to embrace the confidence that comes from the freedom of improvisation.',
                        'alt' => 'Calendar with 30 days'
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/singeo/products/everyday-improv/learning-02.webp',
                        'title' => 'Ditch The Homework & The Complex Theory',
                        'description' =>
                            'Every lesson is only 10 minutes long, and you practice alongside your instructor during the lesson.',
                        'alt' => 'Singeo Student Practicing Singing'
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/singeo/products/everyday-improv/learning-03.webp',
                        'title' => 'Learn From One Of The World\'s Best Vocalist',
                        'description' =>
                            'Learn from Emma Nissen, a jazz-pop phenom known for her ability to scat and improvise.',
                        'alt' => 'Emma Nissen Singing'
                    ],
                ];
            @endphp

            <div class="flex flex-col sm:flex-row text-left justify-center">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($learners as $learner)
                        <div class="w-full sn:w-2/3 md:w-full flex flex-col bg-white rounded-xl">
                            <div class="md:aspect-[4/3] relative rounded-xl overflow-hidden">
                                <img 
                                src="{{ $learner['image'] }}"
                                alt="{{ $learner['alt'] }}"
                                class="w-full h-full object-cover"
                                />
                            </div>
                            <div class="tracking-normal">
                                <h6 class="py-2 font-semibold leading-snug">{!! $learner['title'] !!}</h6>
                                <p class="pr-8 leading-normal">{!! $learner['description'] !!}<p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 bg-white">
        <div class="container sm:max-w-xl md:max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-center gap-8 lg:gap-12">
            <div class="w-full md:w-1/2 md:text-right">
                <img 
                class="h-24 sm:h-28 lg:h-48 transition-opacity opacity-0 mx-auto" 
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/header-logo.svg"
                alt="Everyday Improv Logo"
                />
            </div>
            
            <div class="w-full md:w-1/2 flex flex-col gap-4">
                <ul class="text-left space-y-4">
                @php
                    $features = [
                    'Learn to sing over any song or chord progression even if you\'re not familiar with it.',
                    'Develop confidence to explore singing freely & discover your style.',
                    'Confidently craft your melodies in the heat of the moment.',
                    ];
                @endphp
                
                @foreach ($features as $feature)
                <li class="flex items-start gap-4">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/arrow-icon.svg" class="w-4 h-4 mt-1 mr-2 flex-shrink-0" alt="Arrow Icon">
                    <h6 class="leading-normal m-0">{{ $feature }}</h6>
                </li>
                @endforeach
                </ul>
            </div>
            </div>
        </div>
        <a class="anchor-slide join smaller w-11/12 sm:max-w-[350px] mt-10 py-4" href="#customize-anchor">GET STARTED</a>
        <p class="text-lg font-semibold mt-4">Only $97</p>
    </section>


    <section class="text-center px-4 py-6 sm:py-10 lg:py-16" style="background: linear-gradient(90deg, #DAB3F8 0%, #8414E2 100%);">
        <div class="container mx-auto text-white flex flex-col items-center justify-center py-3">
            <h2 class="leading-tight text-center tracking-tight">
                <strong>
                    “One of the most incredible voices, and <br class="hidden sm:inline lg:hidden"/> an even better person”
                </strong>
            </h2>
            <h5 class="italic leading-normal">
                ~ <strong>Adam Blackstone,</strong> songwriter, producer &amp; <br class="hidden sm:inline lg:hidden"/>musical director for Nicki Minaj and Justin Timberlake.
            </h5>
        </div>
    </section>

    <section class="flex flex-col items-center text-white pb-28" style="background-color: #111729;">
        <div class="lg:mx-auto text-center">
            <picture>
                <source media="(min-width: 1200px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/singeo/products/everyday-improv/coach-2.webp">
                <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/singeo/products/everyday-improv/coach-2.webp">
                <img
                    class="w-full transition-opacity opacity-0 hidden md:inline"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/singeo/products/everyday-improv/coach-2.webp"
                    alt="Jordan Rudess Photo"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                >
            </picture>
            <img class="w-full inline md:hidden transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/singeo/products/everyday-improv/coach-m-2.webp" onload="this.classList.remove('opacity-0');" loading="lazy" alt="Jordan Rudess Photo">
        
            <div class="container mx-auto max-w-4xl p-4 md:p-6 -mt-96 md:-mt-52 lg:-mt-56 lg:-mt-72 text-left">
                <div class="flex flex-col justify-center items-center">
                    <p class="uppercase tracking-wider font-light text-xs md:text-sm">MEET YOUR INSTRUCTOR</p>
                    <h1 class="text-3xl md:text-4xl mb-4 text-[#F8F8F8]"><strong>Emma Nissen</strong></h1>
                </div>
               <div class="grid grid-cols-1 md:grid-cols-2 gap-3 lg:gap-4 md:pt-6">
            <div class="md:py-4">
                        <p class="mb-4"><strong>Emma Nissen</strong> is a jazz-pop phenom <strong>known for her ability to scat and improvise in a unique modern jazz style.</strong> Her videos of this on Instagram have amassed over <strong>100 million views,</strong> taking her Instagram to over 500k followers.</p>
                        <p class="mb-4">She has become recognized by the likes of Lauren Daigle, SZA, Meghan Trainor, Queen Latifah, and long-time Rihanna, Maroon 5, and Justin Timberlake collaborator, <strong>Emmy and Grammy winner Adam Blackstone.</strong></p>
            </div>
                <div class="md:py-4">
                        <p class="mb-4">Emma has gone on to perform with Adam & his world-class band at the famed NYC jazz club, The Blue Note. This led to the chance to work alongside Adam and other industry titans like Grammy, Dove, and Billboard award winner Seth Mosley, Grammy award nominee Nate Pyfer, and acclaimed producer Stephen Nelson in the recording studio.</p>
                </div>
            </div>
            </div>
            <a class="anchor-slide join smaller w-11/12 sm:max-w-[350px] py-4" href="#customize-anchor">GET STARTED</a>
        </div>
        
        <div class="container mx-auto max-w-5xl py-4 px-4 md:px-6 pb-10">
            <h5 class="uppercase text-center my-4 md:my-8 font-semibold color-[#E3E3E3]">See Emma in Action</h5>
            <div class="grid grid-cols-1 gap-4 sm:gap-6 mx-auto w-full md:w-1/2">
                <div class="relative">
                    <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative" x-on:click="blueNote = true;" role="button">
                        <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0" data-src="" type="video/mp4" autoplay loop playsinline muted></video>
                        <img class="absolute inset-0 overflow-hidden object-cover w-full h-full absolute z-0 opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/singeo/products/everyday-improv/thumb-01.webp" alt="Thumbnail for piano technique tutorial video"/>
                    </div>
                    <p class="pt-2 text-left tracking-tight"><strong>Emma Nissen at Blue Note New York with Adam Blackstone</strong></p>
                </div>
                {{-- <div class="relative">
                    <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative" x-on:click="danceOfEternity = true;" role="button">
                        <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-10"></i>
                        <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0" data-src="" type="video/mp4" autoplay loop playsinline muted></video>
                        <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/singeo/products/everyday-improv/placeholder.jpg" alt="Thumbnail for piano technique tutorial video "/>
                    </div>
                    <p class="pt-2 text-left traking-tight"><strong>Emma Nissen Uncovered Ep</strong></p>
                </div> --}}
            </div>
        </div>
        
        <div class="container mx-auto max-w-6xl px-6 md:px-10">
            <h2 class="leading-none text-center pb-4 md:py-8"><strong>Get in on the buzz.</strong></h2>
            <img class="w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/comments.webp" alt="Everyday Improv Logo">
        </div>

        <div class="container max-w-4xl mx-auto px-6 py-10 md:py-16 lg:-py-28">
            <h2 class="leading-normal pt-4 text-center capitalize"><strong>Vocal Improvisation Made Simple.</strong></h2>
            <div class="aspect-16:9 cursor-pointer rounded-xl my-7 autoplay-video overflow-hidden w-full relative" x-on:click="kickOff = true;" role="button">
                {{-- <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i> --}}
                <img class="absolute inset-0 overflow-hidden object-cover w-full h-full absolute z-0 opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')" 
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/course-kick.webp" alt="Thumbnail for tutorial video"/>
            </div>
                       @php
                $weeks = [
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/singeo/products/everyday-improv/week-01.webp',
                        'weekNum' => 'WEEK 1',
                        'title' => 'Before you improvise',
                        'excerpt' => 'todo',
                        'desc' => 'Build a strong foundation for improvisation by understanding its basics and preparing physically and mentally. Explore improvisation, warm-ups, vocal range, turning wrong notes into the right ones and pitch matching.',
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/singeo/products/everyday-improv/week-02.webp',
                        'weekNum' => 'WEEK 2',
                        'title' => 'Four Basics of Improvisation',
                        'excerpt' => 'todo',
                        'desc' => 'Develop key musical elements to increase your ability to improvise. We’ll explore the use of syllables, dive into rhythm, work on dynamics to add expression, practice creating melodies and experiment with scat improvisation to tie it all together.',
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/singeo/products/everyday-improv/week-03.webp',
                        'weekNum' => 'Week 3',
                        'title' => 'Your Voice As An Instrument!',
                        'excerpt' => 'todo',
                        'desc' => 'Find inspiration in your singing by instruments and learn how singing is instrumental! We’ll also practice call and response techniques, learn how to use Fishbowl FUNdamentals and develop confidence by getting comfortable with discomfort!',
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/singeo/products/everyday-improv/week-04.webp',
                        'weekNum' => 'Week 4',
                        'title' => 'Runs and Review',
                        'excerpt' => 'todo',
                        'desc' => 'Strengthen your vocal technique with a focus on vocal runs, progressing from easy to more challenging levels. After familiarizing yourself with these runs, we’ll review key lessons from Weeks 1, 2, and 3, followed by a guided practice session to reinforce your progress. Take time to rest and reflect on Day 28, then celebrate your journey with a special "Next Steps" video and Emma\'s performance of "Breathe" to close out the program!',
                    ],
                ];
            @endphp
            @foreach ($weeks as $week)
                <div class="dropdown text-center rounded-xl mb-4 select-none text-black border-2 border-[#EFF3F5] bg-white" x-data="{ open: false }">
                    <div class="flex">
                        <div class="hidden sm:block mr-auto py-3 sm:py-4 lg:py-6 pl-4 lg:pl-5 cursor-pointer flex-shrink-0" x-on:click="open = !open">
                            <img class="h-10 sm:h-16 lg:h-20 rounded-md opacity-0 transition-opacity" src="{{ $week['img'] }}" alt="Collage showing pianists" loading="lazy" onload="this.classList.remove('opacity-0')">
                        </div>
                        <div class="py-3 sm:py-4 lg:py-6 px-4 cursor-pointer text-left" x-on:click="open = !open;">
                            <p class="text-singeo uppercase text-left text-sm">{!! $week['weekNum'] !!}</p>
                            <h5 class="leading-normal"><strong>{!! $week['title'] !!}</strong></h5>
                            <p x-bind:class="open && 'mb-4'" class="leading-tight text-sm">{{--{!! $week['excerpt'] !!}--}} <span class="text-singeo inline-block" x-bind:class="open && 'hidden'">Read more...</span> </p>
                            <div x-cloak class="transition-all duration-100 leading-relaxed sm:leading-relaxed overflow-hidden" x-bind:class="{ 'max-h-0': !open, 'max-h-[2000px]': open }">
                                <p class="leading-tight mb-4">{!! $week['desc'] !!}</p>
                            </div>
                        </div>
                        <div class="ml-auto text-singeo py-3 sm:py-4 lg:py-6 pr-4 sm:pr-5 cursor-pointer" x-on:click="open = !open">
                            <i class="fas fa-plus transform transition-all duration-300 text-lg md:text-2xl lg:text-3xl" x-bind:class="{ 'rotate-45': open }" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>



     @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/singeo/membership/homepage/webp-format/singeo-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence to share your voice with the world.',
    ])


<div id="customize-anchor" class="anchor"></div>


    @php
        $courseDetails = [
            'title' => '32 Guided Play-Along Lessons.<br>Original & Simplified Arrangements.<br>Practice With Real Teachers.<br>Lifetime Access.',
            'features' => [
                'Start by choosing a plan that works for you.',
                'Practice alongside Emma Nissen for 10 minutes a day for 30 days.',
                'Watch your confidence grow through the tools of vocal improvisation!',
            ],
            'courseOnly' => [
                'title' => 'Everyday Improv',
                'description' => '<strong>30 days of lessons</strong> to unlock the skill of vocal improvisation.',
                'price' => 97,
                'discountedPrice' => 97,
                'keyFeatures' => [
                    '<strong>Lifetime access to Everyday Improv.</strong>',
                    '30 guided sing-along lessons.',
                    '90-day money-back guarantee.'
                ]
            ],
            'membershipSpecial' => [
                'title' => 'Everyday Improv + 1 Year of Lessons',
                'description' => '<strong>Unlimited Singeo courses for a year.</strong> Everything you need to become the singer you want to be.',
                'price' => 240,
                'discountedPrice' => 240,
                'keyFeatures' => [
                    '<strong>Lifetime access to Everyday Improve.</strong>',
                    '<strong>1 Year of unlimited Singeo lessons.</strong>',
                    '90-Day money back guarantee.',
                    'Cancel anytime.'
                ]
            ]
        ];
    @endphp
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-black" style="background-color:##FFFFFF;">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center">
                <div class="text-center lg:text-left w-full lg:w-1/3 mb-7 lg:mb-0 relative">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/header-logo.svg" alt="Improv Logo" class="w-1/2 sm:w-1/3 lg:w-full mb-1">
                    <div class="w-full mx-auto sm:mx-0 text-left sm:px-10 md:px-28 lg:px-0">
                        @foreach ($courseDetails['features'] as $index => $feature)
                            <div class="flex flex-row justify-start items-start space-x-2 sm:space-x-3 mt-2 sm:mt-5 lg:pr-8">
                                    @if ($index == 0)
                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/01-icon.svg" alt="Icon number 1" class="w-5">
                                    @elseif ($index == 1)
                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/02-icon.svg" alt="Icon number 2" class="w-5">
                                    @elseif ($index == 2)
                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/singeo/products/everyday-improv/03-icon.svg" alt="Icon number 3" class="w-5">
                                    @endif
                                <p class="leading-loose tracking-normal">
                                    {{ $feature }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-wrap sm:flex-nowrap max-w-xs sm:max-w-full items-center text-left w-full mx-auto lg:w-2/3 lg:pl-5 xl:pl-10">
                    <a href="/ecommerce/add-to-cart?products[everyday-improv]=1&locked=true"
                       class="z-10 relative px-5 sm:px-6 py-7 sm:py-9 mb-7 sm:mb-0 bg-white rounded-xl w-full sm:w-5/12 shadow-xl border-2 border-[##EFF4FB]" style="text-decoration:none;">
                        <p class="border border-black inline-block rounded-xl text-sm mb-2 px-4 tracking-wider text-black">COURSE ONLY</p>
                        <h3 class="text-black leading-tight mb-5 tracking-tight pt-4"><strong>{{ $courseDetails['courseOnly']['title'] }}</strong></h3>
                        <p class="text-sm mb-5 text-black">{!! $courseDetails['courseOnly']['description'] !!}</p>
                        @if ($courseDetails['courseOnly']['price'] == $courseDetails['courseOnly']['discountedPrice'])
                            <h2 class="inline-block text-black"><strong class="text-4xl">${{ $courseDetails['courseOnly']['price'] }}</strong></h2>
                        @else
                            <h2 class="inline-block text-black opacity-40 font-light text-4xl line-through">${{ $courseDetails['courseOnly']['discountedPrice'] }}</h2>
                            <h2 class="inline-block text-black"><strong class="text-4xl">${{ $courseDetails['courseOnly']['price'] }}</strong></h2>
                        @endif
                        <p class="inline-block text-sm text-black">One time payment.</p><br>
                        <div class="join bg-black smaller my-4 w-full max-w-[260px] text-white uppercase">GET STARTED</div>
                        <hr class="w-full my-5" style="border-color:#b2cae1">
                        <p class="lg:leading-normal text-sm text-black text-center">
                            @foreach ($courseDetails['courseOnly']['keyFeatures'] as $keyFeature)
                                {!! $keyFeature !!}<br>
                            @endforeach
                        </p>
                    </a>
                    <a href="/ecommerce/add-to-cart?products[singeo-annual-recurring-membership]=1&products[everyday-improv]=1&locked=true"
                       class="px-5 sm:px-9 py-5 sm:py-7 sm:-ml-5 rounded-xl shadow-xl w-full sm:w-6/12 bg-white border-2 border-{{$theme}}" style="text-decoration:none;">
                        <p class="border border-{{$theme}} text-{{$theme}} inline-block rounded-xl text-sm mb-2 px-4 tracking-wider text-black uppercase">1 Year of lessons</p>
                        <h3 class="text-black leading-tight mb-5 tracking-tight pt-4"><strong>{!! $courseDetails['membershipSpecial']['title'] !!}</strong></h3>
                        <p class="text-sm mb-5 text-black">{!! $courseDetails['membershipSpecial']['description'] !!}</p>
                        @if ($courseDetails['membershipSpecial']['price'] == $courseDetails['membershipSpecial']['discountedPrice'])
                            <h2 class="inline-block text-black"><strong class="text-4xl">${{ $courseDetails['membershipSpecial']['price'] }}</strong></h2>
                        @else
                            <h2 class="inline-block text-black opacity-40 font-light text-4xl line-through">${{ $courseDetails['membershipSpecial']['discountedPrice'] }}</h2>
                            <h2 class="inline-block text-black"><strong class="text-4xl">${{ $courseDetails['membershipSpecial']['price'] }}</strong></h2>
                        @endif
                        <p class="inline-block text-sm text-black">per year</p><br>
                        <div class="join bg-{{$theme}} smaller my-4 w-full max-w-[260px] text-white uppercase">JOIN TODAY</div>
                        <hr class="w-full my-5" style="border-color:#b2cae1">
                        <p class="lg:leading-normal text-sm text-black text-center">
                            @foreach ($courseDetails['membershipSpecial']['keyFeatures'] as $keyFeature)
                               {!! $keyFeature !!}<br>
                            @endforeach
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-4xl">
                       <h2 class="mb-4 sm:mb-6"><strong>Any Questions?</strong></h2>
            <div class="px-4">
                @php
                    $faqs = [
                        [
                            'title' => 'What skill level is required for this course?',
                            'desc' => 'This course is perfect for late beginners and early intermediate singers, but even if you’re brand new, you’ll find tips and tricks that will benefit you at every stage of your singing journey.',
                        ],
                        [
                            'title' => 'What do I need for this course?',
                            'desc' => 'You only need a computer, tablet, or phone to watch the lessons… and your voice!',
                        ],
                        [
                            'title' => 'How much time is required to complete this course?',
                            'desc' => 'This course requires 10 minutes daily for 30 days minus one rest day a week. Don’t worry if you fall behind. The lessons will always be there for you to catch up!',
                        ],
                        [
                            'title' => 'What is Singeo?',
                            'desc' => 'Singeo is an immersive online platform designed to help you unleash the full potential of your voice. It offers unlimited singing lessons, access to vocal coaches, and the support of a community. The method focuses on expression, technique, and performance, enabling you to find and refine your true voice. Whether you\'re starting out or already have experience, Singeo has the resources to elevate your singing.',
                        ],
                        [
                            'title' => 'What can I expect from Singeo’s lessons?',
                            'desc' => 'Singeo\'s lessons are designed to be practical and engaging. You\'ll find on-screen assignments, practice tools, and downloadable videos to guide your progress. With lessons crafted for every style, era, and skill level, you can develop your skills through guided practice sessions, song breakdowns, and techniques to improve your timing and note recognition.',
                        ],
                        [
                            'title' => 'Do I get free Guitareo, Drumeo & Pianote access with my Singeo Membership?',
                            'desc' => 'Absolutely! As a Singeo member, you\'ll also receive free access to Pianote, Drumeo, and Guitareo. Elevate your musical journey with us by exploring additional instruments and expanding your musical horizons!',
                        ],
                        [
                            'title' => 'Am I too old to start singing lessons?',
                            'desc' => 'You\'re never too old to start a musical journey. Singeo has a community of students of all ages from all around the world. Whether you\'re 40, 50, 60, 70, or beyond - you\'ll connect with singers just like you who are learning and applying their skills to the songs they love.',
                        ],
                    ];
                @endphp

                @foreach ($faqs as $faq)
                    @include('_partials.components.question-dropdown', [
                        'num' => '?',
                        'title' => $faq['title'],
                        'desc' => $faq['desc'],
                    ])
                @endforeach
            </div>
        </div>
    </section>
   
    @include('_partials.components.video-modal', [
    'name' => 'trailer',
    'video' => '1010405112',
    'vimeo' => true,
    ])

    @include('_partials.components.video-modal', [
        'name' => 'trailerM',
        'video' => '999638868',
        'vimeo' => true,
        'styles' => 'pb-[177%] bg-white',
    ])

    @include('_partials.components.video-modal', [
        'name' => 'blueNote',
        'video' => 's-HWmPJBFok',
        'youtubeEmbed' => true,
    ])

     @include('_partials.components.video-modal', [
        'name' => 'uncovered',
        'video' => 's-HWmPJBFok',
        'youtubeEmbed' => true,
    ])

     @include('_partials.components.video-modal', [
    'name' => 'kickOff',
    'video' => '1018701908',
    'vimeo' => true,
    ])


