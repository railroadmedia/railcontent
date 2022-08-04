@extends('musora._partials.layout')

<!-- Main -->
@section('layout-body')

    <section class="py-24 md:py-40 text-white text-center bg-center bg-cover" style="background-color:#1a1e58;background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/header-careers.jpg);">
        <div class="container mx-auto relative z-0">
            <img class="h-5 md:h-7 mx-1 md:mx-3" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
            <img class="h-5 md:h-7 mx-1 md:mx-3" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png">
            <img class="h-5 md:h-7 mx-1 md:mx-3" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png">
            <img class="h-5 md:h-7 mx-1 md:mx-3" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png">
            <h1 class="mt-6"><strong>Let's fill the world<br class="inline sm:hidden"> with music!</strong></h1>
        </div>
    </section>
    <section class="content-section relative overflow-hidden text-white text-center" style="background-color:#000c17;">
        <div class="container mx-auto max-w-5xl relative z-0 px-5">
            <p class="text-navy">Want to whistle while you work? Bang on your drums all day? We’re looking for exceptional<br>
                people to join our mission to create more musicians and keep them playing longer. </p>
            <div class="my-7 md:my-10 mx-auto">
                {{--@include('public.partials._jobs')--}}
                <div class="w-full relative" style="padding-bottom: 90%;">
                    <iframe style="filter: invert(1) hue-rotate(200deg);" class="absolute w-full h-full rounded-lg" src="https://musoramediainc.bamboohr.com/jobs/" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <h3><strong>Not the right time or opportunity?</strong></h3>
            <p class="text-navy my-5">No problem! We’re always looking for good people -- so if now isn’t the <br class="hidden md:inline">
                right time, or there’s not an opening for what you do best -- just click the <br class="hidden md:inline">
                link below to join our talent pool for future opportunities.</p>
            <a class="join gradient-outline smaller" target="_blank" href="https://musoramediainc.bamboohr.com/jobs/view.php?id=58">JOIN TALENT POOL <i class="fal fa-smile-plus"></i></a>

            <div class="flex flex-wrap md:flex-nowrap items-center justify-center mt-16">
                <img class="flex-shrink-0 md:order-1 h-60 md:h-96 rounded-xl overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team-1.jpg">
                <div class="w-full md:w-auto mt-5 md:mt-0 md:pr-10 lg:pr-12 md:text-left">
                    <h3 class="mb-5"><strong>Meaningful work matters.</strong></h3>
                    <p class="text-navy">We believe that music can change the world -- that an instrument provides a voice, and a voice empowers an individual to express themselves. So when we’re building our music lesson communities, we always put relationships before technology. It’s our job to make sure students reach their musical goals.
                        <br><br>
                        When you join our team, you’ll join our mission to create new musicians and keep them playing longer. That means caring about the details -- the messaging, the experience, and the impact. It also means that we’ll care about you -- with perks, benefits, and opportunities for growth. It’s a fantastic time to join us, and we’d love to hear from you.</p>
                </div>
            </div>
            <img class="bg-white w-full my-8 md:my-12 rounded-xl overflow-hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team-2.jpg">
            <div class="flex flex-wrap md:flex-nowrap items-start lg:items-center justify-center">
                <img class="flex-shrink-0 h-40 md:h-96 rounded-xl overflow-hidden hidden md:inline lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/team-3.jpg">
                <div class="w-full md:w-auto mt-5 md:mt-0 md:pl-4 lg:pl-8 text-left">
                    <h3 class="mb-5"><strong>The DNA of a Musora team member</strong></h3>
                    <ul class="fa-ul text-navy ml-6">
                        <li><i class="fa-li fas fa-check text-gradient"></i> We believe that all of our students should be treated like family members.</li>
                        <li><i class="fa-li fas fa-check text-gradient"></i> We believe that staff should love what they do, even if it means not working here.</li>
                        <li><i class="fa-li fas fa-check text-gradient"></i> We believe that staff should always keep pushing, in our successes and failures.</li>
                        <li><i class="fa-li fas fa-check text-gradient"></i> We believe in sticking to deadlines and will work extra hours to get the job done right.</li>
                        <li><i class="fa-li fas fa-check text-gradient"></i> We believe in connecting with our students, regardless of whether they’ve paid us or not.</li>
                        <li><i class="fa-li fas fa-check text-gradient"></i> We believe that strong relationships are more important than powerful technology.</li>
                        <li><i class="fa-li fas fa-check text-gradient"></i> We believe that every day is an opportunity to do a better job than the previous day.</li>
                        <li><i class="fa-li fas fa-check text-gradient"></i> We believe that music education can have a positive effect on people’s lives.</li>
                        <li><i class="fa-li fas fa-check text-gradient"></i> We believe in an open-door policy; staff and instructors should be approachable.</li>
                        <li><i class="fa-li fas fa-check text-gradient"></i> We believe in a transparent environment where diversity, equity, and inclusion are celebrated. All humans are unique and we care about ensuring that all of our people feel welcome, heard and appreciated.</li>
                    </ul>
                </div>
            </div>
            <div class="my-12 md:my-24">
                <h3 class="mb-8 md:mb-12"><strong>Our team is built on 3 core values...</strong></h3>
                <div class="flex flex-wrap items-center max-w-xs md:max-w-none mx-auto px-6 md:px-0">
                    <div class="w-full md:w-1/3">
                        <div class="inline-block rounded-full py-12 md:py-10 lg:py-20 px-5 md:px-3 lg:px-4 text-center gradient-border" style="background-color:#020e1a;">
                            <h3><strong>Empathy</strong></h3>
                            <p class="leading-tight"><em class="text-navy inline-block mt-1 mb-2 lg:mb-7">caring, thoughtful,<br class="inline lg:hidden"> humble.</em><br>
                            We listen deeply, ask questions, and celebrate achievements. Students know that we care.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3">
                        <div class="inline-block rounded-full py-12 md:py-10 lg:py-20 px-5 md:px-3 lg:px-4 text-center gradient-border" style="background-color:#020e1a;">
                            <h3><strong>Grit</strong></h3>
                            <p class="leading-tight"><em class="text-navy inline-block mt-1 mb-2 lg:mb-7">reliable, brave,<br class="inline lg:hidden"> resilient.</em><br>
                            We strive for excellence, overcome setbacks, and keep pushing. Students know that we’ll deliver.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3">
                        <div class="inline-block rounded-full py-12 md:py-10 lg:py-20 px-5 md:px-3 lg:px-4 text-center gradient-border" style="background-color:#020e1a;">
                            <h3><strong>Passion</strong></h3>
                            <p class="leading-tight"><em class="text-navy inline-block mt-1 mb-2 lg:mb-7">creative, innovative,<br class="inline lg:hidden"> problem-solver.</em><br>
                            We care more about the impact of our work than the output. Students smile when we help them.</p>
                        </div>
                    </div>
                </div>
            </div>
            <h3><strong>Hard work has its perks.</strong></h3>
            <p class="text-navy leading-tight mt-2 md:mt-5 mb-8 md:mb-12">Just a few reasons you’ll<br class="inline md:hidden"> love being on our team...</p>
            <div class="flex flex-wrap items-start max-w-xs md:max-w-6xl mx-auto">
                <div class="w-full px-4 md:px-2 lg:px-4 md:w-1/3 mb-8">
                    <i class="fal fa-heartbeat text-3xl md:text-5xl leading-none text-gradient"></i><br>
                    <h5 class="leading-tight mt-5 mb-3"><strong>Health Benefits</strong></h5>
                    <p class="text-navy leading-relaxed">Our people matter -- so you’ll gain access to a benefits package including health, dental, and vision.</p>
                </div>
                <div class="w-full px-4 md:px-2 lg:px-4 md:w-1/3 mb-8">
                    <i class="fal fa-laptop text-3xl md:text-5xl leading-none text-gradient"></i><br>
                    <h5 class="leading-tight mt-5 mb-3"><strong>The Right Tools</strong></h5>
                    <p class="text-navy leading-relaxed">We’ll provide the right computer for your needs, with everything you need to get the job done!</p>
                </div>
                <div class="w-full px-4 md:px-2 lg:px-4 md:w-1/3 mb-8">
                    <i class="fal fa-file-certificate text-3xl md:text-5xl leading-none text-gradient"></i><br>
                    <h5 class="leading-tight mt-5 mb-3"><strong>Stay Sharp</strong></h5>
                    <p class="text-navy leading-relaxed">Stay up to date and improve your skills. We’ll support your journey to being the best you can be!</p>
                </div>
                <div class="w-full px-4 md:px-2 lg:px-4 md:w-1/3 mb-8">
                    <i class="fal fa-dumbbell text-3xl md:text-5xl leading-none text-gradient"></i><br>
                    <h5 class="leading-tight mt-5 mb-3"><strong>Stay Strong</strong></h5>
                    <p class="text-navy leading-relaxed">You’ll have access to an onsite gym loaded with weights and cardio equipment to keep you going.</p>
                </div>
                <div class="w-full px-4 md:px-2 lg:px-4 md:w-1/3 mb-8">
                    <i class="fal fa-watch-fitness text-3xl md:text-5xl leading-none text-gradient"></i><br>
                    <h5 class="leading-tight mt-5 mb-3"><strong>Time Freedom</strong></h5>
                    <p class="text-navy leading-relaxed">Put in an honest days work, everyday, and you’ll earn flexibility for what days and hours you do it.</p>
                </div>
                <div class="w-full px-4 md:px-2 lg:px-4 md:w-1/3">
                    <i class="fal fa-house-user text-3xl md:text-5xl leading-none text-gradient"></i><br>
                    <h5 class="leading-tight mt-5 mb-3"><strong>Remote Choice</strong></h5>
                    <p class="text-navy leading-relaxed">Depending on the role, you’ll have the freedom to work in-office or at home, whatever suits you best.</p>
                </div>
            </div>
        </div>
    </section>
    @include('musora._partials._lets-chat')

@stop
