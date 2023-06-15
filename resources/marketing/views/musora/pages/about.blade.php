@extends('musora._partials.layout')

@section('head-includes')
    <title>About | Musora</title>
    <meta property="og:title" content="About | Musora">

    <meta name="description" content="We have two simple goals: create more musicians and keep them playing longer.">
    <meta property="og:description" content="We have two simple goals: create more musicians and keep them playing longer.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image.jpg">
@endsection

@section('body-data')
    x-data = '{
        modal: false,
        jared: false,
        james: false,
        dave: false,
        pam: false,
        mary: false,
        caleb: false,
        victor: false,
        chad: false,
        amy: false,
        jordan: false,
    }'
@endsection

<!-- Main -->
@section('layout-body')

    <section class="py-24 md:py-40 text-white text-center relative">
        <img
            src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/header-about.jpg"
            class="absolute w-full h-full object-cover top-0 left-0 z-[-2]"
            alt="header about"
            fetchpriority="high"
        />
        <div class="container mx-auto relative z-0">
            <h1><strong>Making the world a better<br> place through music!</strong></h1>
        </div>
    </section>
    <section class="content-section relative overflow-hidden text-white py-10 md:py-16 lg:py-20" style="background:linear-gradient(to bottom, #000c17, #000f2e);">
        <div class="container mx-auto max-w-3xl relative z-0 px-5">
            <p class="text-[#a1afc9]">
                You’ve likely seen the health benefits of playing music.
                <br><br>
                It can <a target="_blank" href="https://www.drumeo.com/beat/play-music-to-improve-memory/"><u>improve your memory</u></a>, <a target="_blank" href="https://www.drumeo.com/beat/8-health-benefits/"><u>reduce anxiety</u></a>, <a target="_blank" href="https://www.telegraph.co.uk/news/science/science-news/6447588/Playing-a-musical-instrument-makes-you-brainier.html"><u>make you smarter</u></a>, <a target="_blank" href="https://www.rcm.ac.uk/about/news/all/2016-03-16rcmfindsdrumminghaspositiveimpactonmentalhealth.aspx"><u>make you happier</u></a>, and <a target="_blank" href="https://www.drumeo.com/beat/8-health-benefits/"><u>support your physical health</u></a>. And, well, it’s just fun! There’s a magical feeling when you’ve developed your skills to the point of achieving musical freedom -- where you’re not <em>thinking</em> about what you’re playing, you’re just creating.
                    <br><br>
                So at Musora Media, we have two simple goals: create more musicians and keep them playing longer.
                    <br><br>
                For us, that starts by making the beginner’s journey an enjoyable one -- where they see progress, overcome the early obstacles, and fall in love with their instrument.
                    <br><br>
                And then later, it’s about supporting any musical goals -- from jamming with a band, writing and recording songs, or becoming a touring professional. It’s about inspiring students with new ideas, connecting them with a group of peers and mentors, and helping them share their passion with others.
                    <br><br>
                We believe the world’s a better place when it’s filled with music. And if you agree, we’d love to connect!
            </p>
            <div class="flex items-center mt-8">
                <img
                    class="h-32 rounded-full"
                    src="https://www.musora.com/musora-cdn/image/width=250,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/jared-falk.jpg"
                    alt="jared falk"
                >
                <div class="pl-5">
                    <img
                        class="h-14 mb-1"
                        src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/signature.png"
                        alt="jared falk signature"
                    >
                    <p class="text-[#a1afc9]">Jared Falk</p>
                </div>
            </div>
        </div>
    </section>
    <section class="content-section relative overflow-hidden text-white text-center py-10 md:py-16 lg:py-20 bg-musora-black">
        <div class="container mx-auto relative z-0 max-w-5xl">
            <h3><strong>Meet Musora</strong></h3>
            <p class="text-[#a1afc9] leading-normal mt-2 md:mt-5 mb-8 md:mb-12">
                Musora Media has provided world-class music education to<br class="hidden md:inline">
                millions of students around the globe for the past 15 years.
            </p>
            <img
                class="timeline px-3 md:px-0"
                src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d21xeg6s76swyd.cloudfront.net/sales/2021/meet-musora.png"
                alt="meet musora diagram"
            >

        </div>
    </section>
    <section class="content-section relative overflow-hidden text-white text-center py-10 md:py-16 lg:py-20 bg-musora-black">
        <div class="container mx-auto relative z-0 max-w-6xl">
            <h3 class="mb-8 md:mb-14"><strong>Our Leadership Team</strong></h3>
            <div class="flex flex-wrap items-start justify-center mx-auto" style="max-width:1060px">
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" x-on:click="jared = true; modal = true">
                        <img
                            class="w-full rounded-lg overflow-hidden standard-pic"
                            src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/team/jared-falk.jpg"
                            alt="jared falk"
                        >
                    </div>
                    <h5 class="mt-3"><strong>Jared Falk</strong></h5>
                    <p class="text-[#a1afc9]">Chief Executive Officer</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" x-on:click="james = true; modal = true">
                        <img
                            class="w-full rounded-lg overflow-hidden standard-pic"
                            src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/jame-falk.jpg"
                            alt="jame falk"
                        >
                    </div>
                    <h5 class="mt-3"><strong>James Falk</strong></h5>
                    <p class="text-[#a1afc9]">Chief Operating Officer</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" x-on:click="dave = true; modal = true">
                        <img
                            class="w-full rounded-lg overflow-hidden standard-pic"
                            src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/dave-atkinson.jpg"
                            alt="dave atkinson"
                        >
                    </div>
                    <h5 class="mt-3"><strong>Dave Atkinson</strong></h5>
                    <p class="text-[#a1afc9]">Chief Content Officer</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" x-on:click="pam = true; modal = true">
                        <img
                            class="w-full rounded-lg overflow-hidden standard-pic"
                            src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/team/pam-black.jpg"
                            alt="pam black"
                        >
                    </div>
                    <h5 class="mt-3"><strong>Pam Black</strong></h5>
                    <p class="text-[#a1afc9]">Controller</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" x-on:click="mary = true; modal = true">
                        <img
                            class="w-full rounded-lg overflow-hidden standard-pic"
                            src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/mary-liz-borseth.jpg"
                            alt="mary liz borseth"
                        >
                    </div>
                    <h5 class="mt-3"><strong>Mary-Liz Borseth</strong></h5>
                    <p class="text-[#a1afc9]">HR Manager</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" x-on:click="caleb = true; modal = true">
                        <img
                            class="w-full rounded-lg overflow-hidden standard-pic"
                            src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/caleb-favo.jpg"
                            alt="caleb favo"
                        >
                    </div>
                    <h5 class="mt-3"><strong>Caleb Favor</strong></h5>
                    <p class="text-[#a1afc9]">Chief Product Officer</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" x-on:click="victor = true; modal = true">
                        <img
                            class="w-full rounded-lg overflow-hidden standard-pic"
                            src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/victor-guidera.jpg"
                            alt="victor guidera"
                        >
                    </div>
                    <h5 class="mt-3"><strong>Victor Guidera</strong></h5>
                    <p class="text-[#a1afc9]">IT Director</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" x-on:click="chad = true; modal = true">
                        <img
                            class="w-full rounded-lg overflow-hidden standard-pic"
                            src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/team/chad-kettner.jpg"
                            alt="chad kettner"
                        >
                    </div>
                    <h5 class="mt-3"><strong>Chad Kettner</strong></h5>
                    <p class="text-[#a1afc9]">Chief Marketing Officer</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" x-on:click="amy = true; modal = true">
                        <img
                            class="w-full rounded-lg overflow-hidden standard-pic"
                            src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/amy-malcomson.jpg"
                            alt="amy malcomson"
                        >
                    </div>
                    <h5 class="mt-3"><strong>Amy Malcolmson</strong></h5>
                    <p class="text-[#a1afc9]">Student Experience Director</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" x-on:click="jordan = true; modal = true">
                        <img
                            class="w-full rounded-lg overflow-hidden standard-pic"
                            src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/team/jord-paul.jpg"
                            alt="jord paul"
                        >
                    </div>
                    <h5 class="mt-3"><strong>Jordan Paul</strong></h5>
                    <p class="text-[#a1afc9]">Creative Director</p>
                </div>
                @component('_partials.components.modal',[
                    'name' => 'modal',
                    'additionalOnClose' => 'jared = false; james = false; dave = false; pam = false; mary = false; caleb = false; victor = false; chad = false; amy = false; jordan = false;',
                ])
                    @slot('content')
                        <div x-show="jared" class="relative overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12 text-black bg-white mx-auto rounded-xl shadow-lg">
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-50px] opacity-30"></i>
                            <img
                                class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full mx-auto inline-block"
                                src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/team/jared-falk.jpg"
                                alt="Jared Falk"
                            >
                            <h5><strong>Jared Falk</strong></h5>
                            <p>Chief Executive Officer</p>
                            <p class="text-left mt-4 select-none">
                                For over 18 years, Jared has been a leader in the online music education industry, publishing his first online video lessons in 2003 and founding Musora in 2005. He currently resides in Chilliwack, B.C. with his wife (Shanna), and two sons (Greyson & Sawyer).
                            </p>
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-50px]" x-on:click="jared = false; james = true"></i>
                        </div>

                        <div x-show="james" class="relative overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12 text-black bg-white mx-auto rounded-xl shadow-lg">
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-50px]" x-on:click="jared = true; james = false"></i>
                            <img
                                class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full mx-auto inline-block"
                                src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/jame-falk.jpg"
                                alt="James Falk"
                            >
                            <h5><strong>James Falk</strong></h5>
                            <p>Chief Operating Officer</p>
                            <p class="text-left mt-4 select-none">
                                Jame joined Musora in 2007 where he has continually reinvented himself to push Musora forward, working in nearly every department over his 13-year career. He stepped into the COO/Integrator role in late 2019 and helped lead Musora to a record year in 2020. He and his wife(Cassi) live in Chilliwack, B.C. with their two children (Colbie and Otis).
                            </p>
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-50px]" x-on:click="james = false; dave = true"></i>
                        </div>

                        <div x-show="dave" class="relative overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12 text-black bg-white mx-auto rounded-xl shadow-lg">
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-50px]" x-on:click="james = true; dave = false"></i>
                            <img
                                class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full mx-auto inline-block"
                                src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/dave-atkinson.jpg"
                                alt="Dave Atkinson"
                            >
                            <h5><strong>Dave Atkinson</strong></h5>
                            <p>Chief Content Officer</p>
                            <p class="text-left mt-4 select-none">
                                With over 24 years of playing and studying music as a multi-instrumentalist, Dave is passionate about inspiring positive change through music. He has helped thousands of musicians reach their goals through developing Musora’s core curriculum and engaging content for the modern musician. He currently resides in Chilliwack, B.C. with his fiancee (Alyssa), and his 2 step daughters (Brook and April).
                            </p>
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-50px]" x-on:click="dave = false; pam = true "></i>
                        </div>

                        <div x-show="pam" class="relative overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12 text-black bg-white mx-auto rounded-xl shadow-lg">
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-50px]" x-on:click="dave = true; pam = false "></i>
                            <img
                                class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full mx-auto inline-block"
                                src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/team/pam-black.jpg"
                                alt="Pam Black"
                            >
                            <h5><strong>Pam Black</strong></h5>
                            <p>Controller</p>
                            <p class="text-left mt-4 select-none">
                                With a background in corporate accounting, Pam has been the financial controller for Musora since 2006 and has enjoyed growing and managing the finance department. She lives in Abbotsford with her husband Chris and son Tyson. She loves to spend her spare time with family, friends, and Salsa, her dressage horse.
                            </p>
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-50px]" x-on:click="pam = false; mary = true "></i>
                        </div>

                        <div x-show="mary" class="relative overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12 text-black bg-white mx-auto rounded-xl shadow-lg">
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-50px]" x-on:click="pam = true; mary = false "></i>
                            <img
                                class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full mx-auto inline-block"
                                src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/mary-liz-borseth.jpg"
                                alt="Mary-Liz Borseth"
                            >
                            <h5><strong>Mary-Liz Borseth</strong></h5>
                            <p>HR Manager</p>
                            <p class="text-left mt-4 select-none">
                                Mary-Liz is a trained paralegal with 20 years of experience. She joined the Musora team in 2018 and her caring nature and helpful manner made her the perfect fit for her current role as Human Resources Manager. Mary-Liz lives in Chilliwack with her husband Jason, three children (Max, Alexia, and Lily). Mary-Liz enjoys playing the piano when she isn’t chasing around her beloved dog, Charlie.
                            </p>
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-50px]" x-on:click="mary = false; caleb = true "></i>
                        </div>

                        <div x-show="caleb" class="relative overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12 text-black bg-white mx-auto rounded-xl shadow-lg">
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-50px]" x-on:click="mary = true; caleb = false "></i>
                            <img
                                class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full mx-auto inline-block"
                                src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/caleb-favo.jpg"
                                alt="Caleb Favor"
                            >
                            <h5><strong>Caleb Favor</strong></h5>
                            <p>Chief Product Officer</p>
                            <p class="text-left mt-4 select-none">
                                With over 10 years of experience in tech and small business, Caleb has been helping Musora build toward becoming the best music education platform in the world for the last 7+ years. Caleb became the CTO in 2017 and shifted to CPO in 2020. His main passions are tech, product development, data science, finance, and all things outdoors.
                            </p>
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-50px]" x-on:click="caleb = false; victor = true "></i>
                        </div>

                        <div x-show="victor" class="relative overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12 text-black bg-white mx-auto rounded-xl shadow-lg">
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-50px]" x-on:click="caleb = true; victor = false "></i>
                            <img
                                class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full mx-auto inline-block"
                                src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/victor-guidera.jpg"
                                alt="Victor Guidera"
                            >
                            <h5><strong>Victor Guidera</strong></h5>
                            <p>IT Director</p>
                            <p class="text-left mt-4 select-none">
                                Victor’s mission is to make a profound impact on humanity through art and technology — he’s aligned with Musora for the last 12+ years to do just that. He has designed the studios and systems to create the company’s industry-leading video content to reach a global audience while building the IT department to support the fast-growing team at Musora.
                            </p>
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-50px]" x-on:click="victor = false; chad = true "></i>
                        </div>

                        <div x-show="chad" class="relative overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12 text-black bg-white mx-auto rounded-xl shadow-lg">
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-50px]" x-on:click="victor = true; chad = false "></i>
                            <img
                                class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full mx-auto inline-block"
                                src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/team/chad-kettner.jpg"
                                alt="Chad Kettner"
                            >
                            <h5><strong>Chad Kettner</strong></h5>
                            <p>Chief Marketing Officer</p>
                            <p class="text-left mt-4 select-none">
                                Chad Kettner is passionate about strategy, copywriting, and brand positioning -- with 15 years of marketing experience. Since joining the team in 2012, Chad has helped grow the Drumeo brand into a marketplace leader and launched the Pianote, Guitareo, and Singeo brands. He loves going on adventures with his wife (Rachel) and two young kids (Everett and Evelyn).
                            </p>
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-50px]" x-on:click="chad = false; amy = true "></i>
                        </div>

                        <div x-show="amy" class="relative overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12 text-black bg-white mx-auto rounded-xl shadow-lg">
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-50px]" x-on:click="chad = true; amy = false "></i>
                            <img
                                class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full mx-auto inline-block"
                                src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/amy-malcomson.jpg"
                                alt="Amy Malcomson"
                            >
                            <h5><strong>Amy Malcolmson</strong></h5>
                            <p>Student Experience Director</p>
                            <p class="text-left mt-4 select-none">
                                Amy joined Musora in 2020 with 10 years of experience in marketing paired with a marketing diploma from Sauder School of Business. Amy’s knowledge in data analysis, strategy development, collaboration, and change management are top strengths for a growing team. Amy and her husband love to travel, hike, try new foods, and enjoy time with family and friends.
                            </p>
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-50px]" x-on:click="amy = false; jordan = true "></i>
                        </div>

                        <div x-show="jordan" class="relative overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12 text-black bg-white mx-auto rounded-xl shadow-lg">
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-50px]" x-on:click="amy = true; jordan = false "></i>
                            <img
                                class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full mx-auto inline-block"
                                src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/team/jord-paul.jpg"
                                alt="Jordan Paul"
                            >
                            <h5><strong>Jordan Paul</strong></h5>
                            <p>Creative Director</p>
                            <p class="text-left mt-4 select-none">
                                Jordan Paul joined Musora Media in 2008 and became the Creative Director in 2017. Jordan has been the lead designer for every brand and major launch since joining the team. Outside of the office, Jordan loves spending time with his wife (Katie) and 3 children (Addie, Ellie & Maycie) and playing baseball, golf and hockey.
                            </p>
                            <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-50px] opacity-30"></i>
                        </div>
                    @endslot
                @endcomponent
            </div>
        </div>
    </section>

    @include('musora._partials._lets-chat')

@stop
