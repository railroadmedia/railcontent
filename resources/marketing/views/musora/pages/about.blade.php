@extends('musora._partials.layout')

<!-- Main -->
@section('layout-body')

    <section class="py-24 md:py-40 text-white text-center bg-center bg-cover" style="background-color:#1a1e58;background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/header-about.jpg);">
        <div class="container mx-auto relative z-0">
            <h1><strong>Making the world a better<br> place through music!</strong></h1>
        </div>
    </section>
    <section class="content-section relative overflow-hidden text-white" style="background:linear-gradient(to bottom, #000c17, #000f2e);">
        <div class="container mx-auto max-w-3xl relative z-0 px-5">
            <p class="text-navy">You’ve likely seen the health benefits of playing music.
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
                <img class="h-32 rounded-full lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/jared-falk.jpg">
                <div class="pl-5">
                    <img class="h-14 mb-1 lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/signature.png">
                    <p class="text-navy">Jared Falk</p>
                </div>
            </div>
        </div>
    </section>
    <section class="content-section relative overflow-hidden text-white text-center" style="background-color:#000c17;">
        <div class="container mx-auto relative z-0 max-w-5xl">
            <h3><strong>Meet Musora</strong></h3>
            <p class="text-navy leading-normal mt-2 md:mt-5 mb-8 md:mb-12">Musora Media has provided world-class music education to<br class="hidden md:inline">
                millions of students around the globe for the past 15 years. </p>
            <img class="timeline px-3 md:px-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/meet-musora.png">

        </div>
    </section>
    <section class="content-section relative overflow-hidden text-white text-center" style="background-color:#000c17;">
        <div class="container mx-auto relative z-0 max-w-6xl">
            <h3 class="mb-8 md:mb-14"><strong>Our Leadership Team</strong></h3>
            <div class="flex flex-wrap items-start justify-center mx-auto" style="max-width:1060px">
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" data-open="jared">
                        <img class="w-full rounded-lg overflow-hidden standard-pic lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/jared-falk.jpg">
                    {{--<img class="w-full rounded-lg overflow-hidden hover-pic absolute top-0 left-0 transition-opacity duration-100 opacity-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/jared-falk-fun.jpg">--}}
                    </div>
                    <h5 class="mt-3"><strong>Jared Falk</strong></h5>
                    <p class="text-navy">Chief Executive Officer</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" data-open="james">
                        <img class="w-full rounded-lg overflow-hidden standard-pic lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/jame-falk.jpg">
                        {{--<img class="w-full rounded-lg overflow-hidden hover-pic absolute top-0 left-0 transition-opacity duration-100 opacity-0 lazyload" data-src="https://ca.slack-edge.com/T010R4NSFQF-U010AHZLH7C-7cca209cc9ad-1024">--}}
                    </div>
                    <h5 class="mt-3"><strong>James Falk</strong></h5>
                    <p class="text-navy">Chief Operating Officer</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" data-open="dave">
                        <img class="w-full rounded-lg overflow-hidden standard-pic lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/dave-atkinson.jpg">
                        {{--<img class="w-full rounded-lg overflow-hidden hover-pic absolute top-0 left-0 transition-opacity duration-100 opacity-0 lazyload" data-src="https://ca.slack-edge.com/T010R4NSFQF-U013G6EGMMW-34d24df51e52-1024">--}}
                    </div>
                    <h5 class="mt-3"><strong>Dave Atkinson</strong></h5>
                    <p class="text-navy">Chief Content Officer</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" data-open="pam">
                        <img class="w-full rounded-lg overflow-hidden standard-pic lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/pam-black.jpg">
                    {{--<img class="w-full rounded-lg overflow-hidden hover-pic absolute top-0 left-0 transition-opacity duration-100 opacity-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/pam-black-fun.jpg">--}}
                    </div>
                    <h5 class="mt-3"><strong>Pam Black</strong></h5>
                    <p class="text-navy">Controller</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" data-open="maryliz">
                        <img class="w-full rounded-lg overflow-hidden standard-pic lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/mary-liz-borseth.jpg">
                        {{--<img class="w-full rounded-lg overflow-hidden hover-pic absolute top-0 left-0 transition-opacity duration-100 opacity-0 lazyload" data-src="https://ca.slack-edge.com/T010R4NSFQF-U010U6JMRB9-63e0b41df35f-1024">--}}
                    </div>
                    <h5 class="mt-3"><strong>Mary-Liz Borseth</strong></h5>
                    <p class="text-navy">HR Manager</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" data-open="caleb">
                        <img class="w-full rounded-lg overflow-hidden standard-pic lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/caleb-favo.jpg">
                        {{--<img class="w-full rounded-lg overflow-hidden hover-pic absolute top-0 left-0 transition-opacity duration-100 opacity-0 lazyload" data-src="https://ca.slack-edge.com/T010R4NSFQF-U011B2E3HRA-gda591899fd2-1024">--}}
                    </div>
                    <h5 class="mt-3"><strong>Caleb Favor</strong></h5>
                    <p class="text-navy">Chief Product Officer</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" data-open="victor">
                        <img class="w-full rounded-lg overflow-hidden standard-pic lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/victor-guidera.jpg">
                        {{--<img class="w-full rounded-lg overflow-hidden hover-pic absolute top-0 left-0 transition-opacity duration-100 opacity-0 lazyload" data-src="https://ca.slack-edge.com/T010R4NSFQF-U010JV9L5UZ-9625060b3ce4-1024">--}}
                    </div>
                    <h5 class="mt-3"><strong>Victor Guidera</strong></h5>
                    <p class="text-navy">IT Director</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" data-open="chad">
                        <img class="w-full rounded-lg overflow-hidden standard-pic lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/chad-kettner.jpg">
                        {{--<img class="w-full rounded-lg overflow-hidden hover-pic absolute top-0 left-0 transition-opacity duration-100 opacity-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/chad-kettner-fun.jpg">--}}
                    </div>
                    <h5 class="mt-3"><strong>Chad Kettner</strong></h5>
                    <p class="text-navy">Chief Marketing Officer</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" data-open="amy">
                        <img class="w-full rounded-lg overflow-hidden standard-pic lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/amy-malcomson.jpg">
                        {{--<img class="w-full rounded-lg overflow-hidden hover-pic absolute top-0 left-0 transition-opacity duration-100 opacity-0 lazyload" data-src="https://ca.slack-edge.com/T010R4NSFQF-U018JPK24KZ-76526a277b0e-1024">--}}
                    </div>
                    <h5 class="mt-3"><strong>Amy Malcolmson</strong></h5>
                    <p class="text-navy">Student Experience Director</p>
                </div>
                <div class="w-full md:w-1/3 lg:w-1/4 px-2.5 mb-5 md:mb-8 team-tile">
                    <div class="relative mx-auto max-w-xs cursor-pointer" data-open="jord">
                        <img class="w-full rounded-lg overflow-hidden standard-pic lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/jord-paul.jpg">
                        {{--<img class="w-full rounded-lg overflow-hidden hover-pic absolute top-0 left-0 transition-opacity duration-100 opacity-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/jord-paul-fun.jpg">--}}
                    </div>
                    <h5 class="mt-3"><strong>Jordan Paul</strong></h5>
                    <p class="text-navy">Creative Director</p>
                </div>
                <div class="reveal text-center overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12" id="jared" data-reveal data-reset-on-close="false">
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-37px] opacity-30"></i>
                    <img class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/jared-falk.jpg">
                    <h5><strong>Jared Falk</strong></h5>
                    <p>Chief Executive Officer</p>
                    <p class="text-left mt-4 select-none">For over 18 years, Jared has been a leader in the online music education industry, publishing his first online video lessons in 2003 and founding Musora in 2005. He currently resides in Chilliwack, B.C. with his wife (Shanna), and two sons (Greyson & Sawyer).</p>
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-37px]" data-open="james"></i>
                </div>
                <div class="reveal text-center overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12" id="james" data-reveal data-reset-on-close="false">
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-37px]" data-open="jared"></i>
                    <img class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/jame-falk.jpg">
                    <h5><strong>James Falk</strong></h5>
                    <p>Chief Operating Officer</p>
                    <p class="text-left mt-4 select-none">Jame joined Musora in 2007 where he has continually reinvented himself to push Musora forward, working in nearly every department over his 13-year career. He stepped into the COO/Integrator role in late 2019 and helped lead Musora to a record year in 2020. He and his wife(Cassi) live in Chilliwack, B.C. with their two children (Colbie and Otis).</p>
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-37px]" data-open="dave"></i>
                </div>
                <div class="reveal text-center overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12" id="dave" data-reveal data-reset-on-close="false">
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-37px]" data-open="james"></i>
                    <img class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/dave-atkinson.jpg">
                    <h5><strong>Dave Atkinson</strong></h5>
                    <p>Chief Content Officer</p>
                    <p class="text-left mt-4 select-none">With over 24 years of playing and studying music as a multi-instrumentalist, Dave is passionate about inspiring positive change through music. He has helped thousands of musicians reach their goals through developing Musora’s core curriculum and engaging content for the modern musician. He currently resides in Chilliwack, B.C. with his fiancee (Alyssa), and his 2 step daughters (Brook and April).</p>
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-37px]" data-open="pam"></i>
                </div>
                <div class="reveal text-center overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12" id="pam" data-reveal data-reset-on-close="false">
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-37px]" data-open="dave"></i>
                    <img class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/pam-black.jpg">
                    <h5><strong>Pam Black</strong></h5>
                    <p>Controller</p>
                    <p class="text-left mt-4 select-none">With a background in corporate accounting, Pam has been the financial controller for Musora since 2006 and has enjoyed growing and managing the finance department. She lives in Abbotsford with her husband Chris and son Tyson. She loves to spend her spare time with family, friends, and Salsa, her dressage horse.</p>
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-37px]" data-open="maryliz"></i>
                </div>
                <div class="reveal text-center overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12" id="maryliz" data-reveal data-reset-on-close="false">
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-37px]" data-open="pam"></i>
                    <img class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/mary-liz-borseth.jpg">
                    <h5><strong>Mary-Liz Borseth</strong></h5>
                    <p>HR Manager</p>
                    <p class="text-left mt-4 select-none">Mary-Liz is a trained paralegal with 20 years of experience. She joined the Musora team in 2018 and her caring nature and helpful manner made her the perfect fit for her current role as Human Resources Manager. Mary-Liz lives in Chilliwack with her husband Jason, three children (Max, Alexia, and Lily). Mary-Liz enjoys playing the piano when she isn’t chasing around her beloved dog, Charlie.</p>
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-37px]" data-open="caleb"></i>
                </div>
                <div class="reveal text-center overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12" id="caleb" data-reveal data-reset-on-close="false">
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-37px]" data-open="maryliz"></i>
                    <img class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/caleb-favo.jpg">
                    <h5><strong>Caleb Favor</strong></h5>
                    <p>Chief Product Officer</p>
                    <p class="text-left mt-4 select-none">With over 10 years of experience in tech and small business, Caleb has been helping Musora build toward becoming the best music education platform in the world for the last 7+ years. Caleb became the CTO in 2017 and shifted to CPO in 2020. His main passions are tech, product development, data science, finance, and all things outdoors.</p>
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-37px]" data-open="victor"></i>
                </div>
                <div class="reveal text-center overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12" id="victor" data-reveal data-reset-on-close="false">
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-37px]" data-open="caleb"></i>
                    <img class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/victor-guidera.jpg">
                    <h5><strong>Victor Guidera</strong></h5>
                    <p>IT Director</p>
                    <p class="text-left mt-4 select-none">Victor’s mission is to make a profound impact on humanity through art and technology — he’s aligned with Musora for the last 12+ years to do just that. He has designed the studios and systems to create the company’s industry-leading video content to reach a global audience while building the IT department to support the fast-growing team at Musora.</p>
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-37px]" data-open="chad"></i>
                </div>
                <div class="reveal text-center overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12" id="chad" data-reveal data-reset-on-close="false">
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-37px]" data-open="victor"></i>
                    <img class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/chad-kettner.jpg">
                    <h5><strong>Chad Kettner</strong></h5>
                    <p>Chief Marketing Officer</p>
                    <p class="text-left mt-4 select-none">Chad Kettner is passionate about strategy, copywriting, and brand positioning -- with 15 years of marketing experience. Since joining the team in 2012, Chad has helped grow the Drumeo brand into a marketplace leader and launched the Pianote, Guitareo, and Singeo brands. He loves going on adventures with his wife (Rachel) and two young kids (Everett and Evelyn).</p>
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-37px]" data-open="amy"></i>
                </div>
                <div class="reveal text-center overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12" id="amy" data-reveal data-reset-on-close="false">
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-37px]" data-open="chad"></i>
                    <img class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/amy-malcomson.jpg">
                    <h5><strong>Amy Malcolmson</strong></h5>
                    <p>Student Experience Director</p>
                    <p class="text-left mt-4 select-none">Amy joined Musora in 2020 with 10 years of experience in marketing paired with a marketing diploma from Sauder School of Business. Amy’s knowledge in data analysis, strategy development, collaboration, and change management are top strengths for a growing team. Amy and her husband love to travel, hike, try new foods, and enjoy time with family and friends.</p>
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-37px]" data-open="jord"></i>
                </div>
                <div class="reveal text-center overflow-y-visible max-w-xs md:max-w-lg px-5 md:px-12 pb-5 md:pb-12" id="jord" data-reveal data-reset-on-close="false">
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-left left-[-37px]" data-open="amy"></i>
                    <img class="h-36 md:h-44 lg:h-60 -mt-16 md:-mt-20 lg:-mt-28 mb-4 border-4 border-white rounded-full overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team/jord-paul.jpg">
                    <h5><strong>Jordan Paul</strong></h5>
                    <p>Creative Director</p>
                    <p class="text-left mt-4 select-none">Jordan Paul joined Musora Media in 2008 and became the Creative Director in 2017. Jordan has been the lead designer for every brand and major launch since joining the team. Outside of the office, Jordan loves spending time with his wife (Katie) and 3 children (Addie, Ellie & Maycie) and playing baseball, golf and hockey.</p>
                    <i class="absolute top-[50%] text-white cursor-pointer text-[50px] p-[10px] fas fa-angle-right right-[-37px] opacity-30"></i>
                </div>

            </div>
        </div>
    </section>

    @include('musora._partials._lets-chat')

@stop

@section('layout-scripts')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" defer></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/plugins/unveilhooks/ls.unveilhooks.min.js" defer></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
@stop