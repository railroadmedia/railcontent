@extends('musora._partials.layout')

@section('head-includes')
    @parent

    <title>Careers | Musora</title>
    <meta property="og:title" content="Careers | Musora">

    <meta name="description" content="We are looking for exceptional people who believe in the power of music and can contribute on a daily basis to the growth of our brands">
    <meta property="og:description" content="We are looking for exceptional people who believe in the power of music and can contribute on a daily basis to the growth of our brands">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://musora-center.s3.amazonaws.com/homepage/2021/share-image.jpg">

    <style>
         .join.gradient-outline.fill-white {
            /*background: white;*/
            /*background-clip: padding-box;*/
            color: #0b76db!important;
        }
         .join.gradient-outline.fill-white:hover {
            color: #fff!important;
        }
        /*.join.gradient-outline:before {*/
        /*    content:' ';*/
        /*    position: absolute;*/
        /*    top: 0;*/
        /*    right: 0;*/
        /*    bottom: 0;*/
        /*    left: 0;*/
        /*    z-index: -1;*/
        /*    border-radius: inherit;*/
        /*    background: linear-gradient(90deg,#03c8ac, #0976db, #9a01ee, #f61a30) no-repeat;*/
        /*    margin: -2px;*/
        /*}*/
    </style>
@endsection

<!-- Main -->
@section('layout-body')
    <div class="white-bar flex items-center justify-between w-full bg-white py-1 lg:py-2 px-2 sm:px-4 fixed shadow-md z-30">
        <div class="text-center flex justify-center w-full flex-grow">
            <a href="#values" class="anchor-slide"><h6 class="font-bebas mr-3 sm:mr-8 lg:mr-12">OUR CORE VALUES</h6></a>
            <a href="#mission" class="anchor-slide"><h6 class="font-bebas mr-3 sm:mr-8 lg:mr-12">OUR MISSION</h6></a>
            <a href="#process" class="anchor-slide"><h6 class="font-bebas mr-3 sm:mr-8 lg:mr-12">OUR HIRING PROCESS</h6></a>
            <a href="#perks" class="anchor-slide"><h6 class="font-bebas mr-3 sm:mr-0">OUR PERKS</h6></a>
        </div>
        {{-- <a class="join gradient-outline fill-white smaller whitespace-nowrap anchor-slide relative" href="#join">APPLY NOW</a> --}}
        <a class="join gradient-outline fill-white smaller whitespace-nowrap anchor-slide bg-white bg-clip-padding relative rounded-full text-drumeo hover:bg-musora hover:text-white py-2 px-3 md:py-3 md:px-5 text-sm tracking-widest font-medium border-musora" href="#join">APPLY NOW</a>
    </div>
    <div class="w-full h-10 sm:h-12 lg:h-14"></div>
    <header class="pb-24 sm:pb-32 pt-32 sm:pt-40 text-white text-center relative">
        <img src="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://musora-center.s3.amazonaws.com/careers/header-image.jpg"
             class="absolute object-cover transition-opacity opacity-0 top-0 left-0 w-full h-full z-[-2]"
             loading="lazy"
             onload="this.classList.remove('opacity-0')"
             alt="header image"
        />
        <div class="container mx-auto">
            <img
                class="h-5 md:h-6 mx-1 md:mx-2 inline-block transition-opacity opacity-0"
                src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                alt="logo blue"
            >
            <img
                class="h-5 md:h-6 mx-1 md:mx-2 inline-block transition-opacity opacity-0"
                src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                alt="logo red"
            >
            <img
                class="h-5 md:h-6 mx-1 md:mx-2 inline-block transition-opacity opacity-0"
                src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                alt="logo green"
            >
            <img
                class="h-5 md:h-6 mx-1 md:mx-2 inline-block transition-opacity opacity-0"
                src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                alt="singeo logo"
            >
            <h1 class="mt-2 mb-11"><strong>Careers at Musora</strong></h1>
            <a class="btn-primary btn-small bg-white text-drumeo rounded-full py-2 px-6 md:py-3 md:px-7 tracking-widest text-sm" href="#join">APPLY NOW</a>
        </div>
    </header>
    <div id="values" class="anchor block relative invisible"></div>
    <section class="pt-10 sm:pt-14 lg:pt-16 pb-40 relative text-center">
        <div class="container mx-auto max-w-5xl">
            <p class="uppercase text-gray-600 tracking-widest">Our Team is Built on</p>
            <h2 class="mb-10"><strong>3 CORE values</strong></h2>

            <div class="flex flex-wrap items-start max-w-xs md:max-w-none mx-auto px-6 md:px-0">
                <div class="w-full md:w-1/3 px-2 lg:px-5 mb-5 sm:mb-0">
                    <img
                        class="h-10 inline-block transition-opacity opacity-0"
                        src="https://musora-center.s3.amazonaws.com/careers/empathy--icon.svg"
                        alt="empathy icon"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h5 class="mt-3 mb-1"><strong>Empathy</strong></h5>
                    <p class="text-gray-500"><span class="text-black uppercase inline-block mt-1 mb-1 lg:mb-2 text-sm">caring, thoughtful,<br class="inline lg:hidden"> humble.</span><br>
                        We listen deeply, ask questions, and celebrate achievements. Students know that we care.</p>
                </div>
                <div class="w-full md:w-1/3 px-2 lg:px-5 mb-5 sm:mb-0">
                    <img
                        class="h-10 inline-block transition-opacity opacity-0"
                        src="https://musora-center.s3.amazonaws.com/careers/grit-icon.svg"
                        alt="grit icon"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h5 class="mt-3 mb-1"><strong>Grit</strong></h5>
                    <p class="text-gray-500"><span class="text-black uppercase inline-block mt-1 mb-1 lg:mb-2 text-sm">reliable, brave,<br class="inline lg:hidden"> resilient.</span><br>
                        We strive for excellence, overcome setbacks, and keep pushing. Students know that we’ll deliver.</p>
                </div>
                <div class="w-full md:w-1/3 px-2 lg:px-5">
                    <img
                        class="h-10 inline-block transition-opacity opacity-0"
                        src="https://musora-center.s3.amazonaws.com/careers/passion-icon.svg"
                        alt="passion icon"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h5 class="mt-3 mb-1"><strong>Passion</strong></h5>
                    <p class="text-gray-500"><span class="text-black uppercase inline-block mt-1 mb-1 lg:mb-2 text-sm">creative, innovative,<br class="inline lg:hidden"> problem-solver.</span><br>
                        We care more about the impact of our work than the output. Students smile when we help them.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-10 sm:pt-14 lg:pt-16 pb-96 px-5 relative text-white text-center" style="background-color:#000c17;">
        <div class="container mx-auto relative z-0 max-w-5xl">
            <img
                class="-mt-40 inline-block sm:hidden transition-opacity opacity-0"
                src="https://cdn.musora.com/image/fetch/w_750,q_auto:best/https://musora-center.s3.amazonaws.com/careers/collage-1-m.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                alt="collage 1"
            >
            <img
                class="-mt-40 hidden sm:inline-block transition-opacity opacity-0"
                src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/careers/collage-1.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                alt="collage 1"
            >
            <div id="mission" class="anchor block relative invisible"></div>
            <h2 class="mt-12 sm:mt-20 mb-5"><strong>Meaningful work matters</strong></h2>
            <p class="text-[#a1afc9] text-left max-w-2xl mx-auto">
                We believe music can change the world -- that an instrument provides a voice, and a voice empowers an individual to express themselves. So when we’re building our music lesson communities, we always put relationships before technology. It’s our job to make sure students reach their musical goals.
                <br><br>
                When you join our team, you’ll join our mission to create new musicians and keep them playing longer. That means caring about the details -- the messaging, the experience, and the impact. It also means that we’ll care about you, all humans are unique and we care about ensuring that our people feel welcome, heard and appreciated. We want to make sure you’re supported in the work you do -- with perks, benefits, opportunities for growth and more! We’d love to connect with you.
            </p>

            <img
                class="my-12 inline-block sm:hidden transition-opacity opacity-0"
                src="https://cdn.musora.com/image/fetch/w_750,q_auto:best/https://musora-center.s3.amazonaws.com/careers/quote-m.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                alt="quote"
            >
            <img
                class="my-24 hidden sm:inline-block transition-opacity opacity-0"
                src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/careers/quote.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                alt="quote"
            >

            <div id="join" class="anchor block relative invisible"></div>
            <h3 class="mb-5 sm:mb-10"><strong>Join our team:</strong></h3>
            <div class="max-w-4xl mx-auto mb-14 sm:mb-20">
                <div class="w-full relative" style="height:700px;">
                    <iframe style="filter: invert(1) hue-rotate(200deg);" class="absolute w-full h-full rounded-lg" src="https://musoramediainc.bamboohr.com/jobs/" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>

            <h3><strong>Not the right time or opportunity?</strong></h3>
            <p class="text-[#a1afc9] my-5">
                No problem! We’re always looking for good people -- so if now isn’t the <br class="hidden md:inline">
                right time, or there’s not an opening for what you do best -- just click the <br class="hidden md:inline">
                link below to join our talent pool for future opportunities.
            </p>
            <a class="join gradient-outline smaller rounded-full relative bg-[#000c17] py-2 px-5 md:py-3 md:px-7 hover:bg-musora border-musora" target="_blank" href="https://musoramediainc.bamboohr.com/jobs/view.php?id=58">JOIN TALENT POOL <i class="fal fa-smile-plus"></i></a>
        </div>
    </section>
    <section class="py-12 sm:py-16 lg:py-20 px-4 sm:px-5 relative">
        <div class="container mx-auto max-w-5xl">
            <img
                class="-mt-96 inline-block sm:hidden transition-opacity opacity-0"
                src="https://cdn.musora.com/image/fetch/w_750,q_auto:best/https://musora-center.s3.amazonaws.com/careers/collage-2-m.png"
                alt="collage 2"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
            <img
                class="-mt-96 hidden sm:inline-block"
                src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/careers/collage-2.png"
                alt="collage 2"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
            <div id="process" class="anchor block relative invisible"></div>
            <h2 class="mt-12 sm:mt-20 mb-5 text-center"><strong>Our hiring process</strong></h2>
            <div class="max-w-2xl mx-auto relative">
                <div class="flex items-start relative z-10 mb-5 sm:mb-7">
                    <h6 class="m-0 px-5 py-3 border-musora before:m-[-1px] relative bg-white rounded-full">1</h6>
                    <p class="pl-4 sm:pl-7 mt-4 m-0 text-gray-500">
                        Once you apply for a role, you will be automatically notified that we received your application.
                    </p>
                </div>
                <div class="flex items-start relative z-10 mb-5 sm:mb-7">
                    <h6 class="m-0 px-5 py-3 border-musora before:m-[-1px] relative bg-white rounded-full">2</h6>
                    <div class="pl-4 sm:pl-7 mt-4">
                        <p class="m-0 text-gray-500">
                            If you are selected from the application phase, our Talent Acquisition Team will set up a 30-minute phone or video interview. Here are a few things we might ask:
                        </p>
                        <ul class="list-disc list-outside pl-10 text-gray-500">
                            <li>How would you describe yourself in three words? How would others describe you? Provide an example of why for each.</li>
                            <li>Of our core values, what do you resonate with most and why?</li>
                            <li>What did you do to prepare for this interview?</li>
                        </ul>
                    </div>
                </div>
                <div class="flex items-start relative z-10 mb-5 sm:mb-7">
                    <h6 class="m-0 px-5 py-3 border-musora before:m-[-1px] relative bg-white rounded-full">3</h6>
                    <p class="pl-4 sm:pl-7 mt-4 m-0 text-gray-500">
                        At least one additional 30-60 minute Interview with the hiring manager. To prepare for this, we suggest reading through the job description to understand how your experience relates to the role.  We also want to know why you want to work here.
                    </p>
                </div>
                <div class="flex items-start relative z-10 mb-5 sm:mb-7">
                    <h6 class="m-0 px-5 py-3 border-musora before:m-[-1px] relative bg-white rounded-full">4</h6>
                    <p class="pl-4 sm:pl-7 mt-4 m-0 text-gray-500">
                        Reference checks (we ask for three professional references) - these are collected earlier on but are only used if the candidate is in the final stages of the hiring process.
                    </p>
                </div>
                <div class="flex items-start relative z-10 mb-5 sm:mb-7">
                    <h6 class="m-0 px-5 py-3 border-musora before:m-[-1px] relative bg-white rounded-full">5</h6>
                    <p class="pl-4 sm:pl-7 mt-4 m-0 text-gray-500">
                        Sometimes there’s a short assignment or test (role dependent).
                    </p>
                </div>
                <div class="flex items-start relative z-10 mb-5 sm:mb-7">
                    <h6 class="m-0 px-5 py-3 border-musora before:m-[-1px] relative bg-white rounded-full">6</h6>
                    <p class="pl-4 sm:pl-7 mt-4 m-0 text-gray-500">
                        Sometimes there’s an additional interview with the CEO/COO and/or another team member (role-dependent).
                    </p>
                </div>
                <div class="flex items-start relative z-10 mb-5 sm:mb-7">
                    <h6 class="m-0 px-5 py-3 border-musora before:m-[-1px] relative bg-white rounded-full">7</h6>
                    <p class="pl-4 sm:pl-7 mt-4 m-0 text-gray-500">
                        If you make it to the final stage, the Talent Acquisition Team will contact you and tell you a bit about a Granted program we’ve piloted to see if you’re eligible for a grant.
                    </p>
                </div>
                <div class="flex items-start relative z-10">
                    <h6 class="m-0 px-5 py-3 border-musora before:m-[-1px] relative bg-white rounded-full">8</h6>
                    <p class="pl-4 sm:pl-7 mt-4 m-0 text-gray-500">
                        A written offer will be sent for you to sign!
                    </p>
                </div>
                <div class="absolute h-full top-0 left-6 ml-0.5 z-0" style="width: 1px;background-color:#940fe6;"></div>
            </div>
        </div>
    </section>

    <div id="perks" class="anchor block relative invisible"></div>
    <section class="py-14 sm:py-20 lg:py-24 px-5 sm:px-5 relative text-white text-center" style="background-color:#000c17;">
        <div class="container mx-auto max-w-4xl">
            <p class="leading-tight uppercase text-gray-400 tracking-widest">Still not convinced<br class="inline sm:hidden"> you should join our team?</p>
            <h3 class="mt-1.5 mb-12"><strong>Working here has its perks</strong></h3>
            <div class="flex flex-wrap items-start mx-auto">
                @php
                    $points = [
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/health-icon.svg",
                        "title" => "Health Benefits",
                        "description" => "Our people matter -- so you’ll gain access to a benefits package including health, dental, and vision.",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/mental-icon.svg",
                        "title" => "Mental Health Support",
                        "description" => "We provide $2000/year/employee on services such as counselling and offer an Employee Assistance Program.",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/time-icon.svg",
                        "title" => "Time Freedom",
                        "description" => "Put in an honest days work and you’ll earn flexibility for what days and hours you do it.",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/snacks-icon.svg",
                        "title" => "Snacks & Refreshments",
                        "description" => "Fresh fruit, energy bars, espresso machine, and a fully stocked soda, kombucha and beer fridge.",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/strong-icon.svg",
                        "title" => "Stay Strong",
                        "description" => "You’ll have access to an onsite gym loaded with weights and cardio equipment to keep you going.",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/lessons-icon.svg",
                        "title" => "Music Lessons",
                        "description" => "We make the best online music education in the world. You and your friends & family get it free!",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/sharp-icon.svg",
                        "title" => "Stay Sharp",
                        "description" => "Stay up to date and improve your skills. We’ll support your journey to being the best you can be!",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/collaboration-icon.svg",
                        "title" => "Collaborative Team",
                        "description" => "Your ideas matter. We want to learn from one another and collaborate across all departments.",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/right-tools-icon.svg",
                        "title" => "The Right Tools",
                        "description" => "We’ll provide the right computer for your needs, with everything you need to get the job done!",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/events-icon.svg",
                        "title" => "FUN Company Events",
                        "description" => "Golf tournaments, warehouse jam nights, LEGENDARY Holiday party and more!",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/remote-icon.svg",
                        "title" => "Remote Choice",
                        "description" => "Depending on the role, you’ll have the freedom to work in-office or at home, whatever suits you best.",
                        ],
                        [
                        "icon" => "https://musora-center.s3.amazonaws.com/careers/growth-icon.svg",
                        "title" => "Room for Growth",
                        "description" => "Whether that means laterally, vertically or somewhere else, we want to support your growth!",
                        ],
                    ]
                @endphp
                @foreach($points as $point)
                    <div class="flex items-start w-full sm:w-1/2 m:px-2 lg:px-10 mb-6 sm:mb-9 text-left">
                        <div class="w-12 sm:w-14 lg:w-16 flex-shrink-0"><img class="h-6 sm:h-7" src="{!! $point['icon'] !!}"></div>
                        <div>
                            <h5 class="leading-tight mb-2"><strong>{!! $point['title'] !!}</strong></h5>
                            <p class="text-[#a1afc9]">{!! $point['description'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="relative -mt-4 sm:-mt-9"></div>
        </div>
    </section>

    @include('musora._partials._lets-chat', [
        'onJobs' => true
    ])
@stop
