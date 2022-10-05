@extends('musora._partials.layout')

@section('head-includes')
    @parent

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@endsection

@section('body-data')
    x-data="{ modal: false }"
@endsection

<!-- Main -->
@section('layout-body')
    <header class="bg-cover bg-center text-center text-white py-12 md:py-20 lg:py-24 px-4 relative" style="background-color:#011223;background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/affiliate/background-drums.jpg);">
        <div class="background-fade">
            <div class="drums" style="background-image: url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/affiliate/background-drums.jpg);"></div>
            <div class="piano"  style="background-image: url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/affiliate/background-piano.jpg);"></div>
            <div class="guitar"  style="background-image: url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/affiliate/background-guitar.jpg);"></div>
        </div>
        <div class="container mx-auto max-w-6xl relative z-10">
            <img class="w-full mx-auto max-w-xs md:max-w-sm lg:max-w-md mb-10 md:mb-14 lg:mb-20" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://musora-center.s3.amazonaws.com/affiliate/musora-logos.png">

            <h2><strong>Musora’s<br class="inline sm:hidden"> Ambassador Program</strong></h2>
            <h4 class="mt-3 mb-5 md:mb-10 leading-normal">Get paid to promote world-class<br class="inline md:hidden"> online music lessons.</h4>

            <a class="join smaller gradient-outline mb-3 md:mb-0 md:mx-2 cursor-pointer bg-[#031627] border-musora hover:bg-musora" x-on:click="modal = true">Guidelines</a>
            <a class="join smaller gradient md:mx-2 bg-musora" href="https://airtable.com/shrmKAXQyoWLbKKW6">APPLY NOW</a>
        </div>
    </header>
    <section class="text-white py-8 md:py-10 lg:py-12 px-4" style="background:#000c18;">
        <div class="container mx-auto max-w-6xl">
            <p class="leading-normal px-3">
                Musora is the home of Drumeo, Pianote, Guitareo, and Singeo -- and the leader in online music education with more than 15 years experience, 500 million video views, and 100 world-class instructors.
                <br><br>
                Each brand offers a membership platform for music students to learn with step-by-step lessons, useful practice tools, and a supportive community of qualified teachers. The unique differentiator is that we provide a home for students, blending technology with tradition to give them an affordable and supportive home base to reach their musical goals.
                <br><br>
                We believe in a transparent environment where diversity, equity, and inclusion are celebrated. All humans are unique and we care about ensuring that all of our people feel welcome, heard and appreciated.
                <br><br>
                Let’s work together to support and inspire musicians around the world!
            </p>
        </div>
    </section>
    <section class="text-white py-8 md:py-14 lg:py-20 px-4" style="background:#000c18;">
        <div class="container mx-auto max-w-6xl">
            <h3 class="text-center mb-8 md:mb-16"><strong>Program Benefits</strong></h3>
            <ul class="fa-ul flex flex-wrap">
                <li class="w-full md:w-1/2 md:pr-12 lg:pr-24 leading-relaxed mb-6 md:mb-12 lg:mb-16"><i class="far fa-li fa-check-circle text-musora text-4xl"></i><strong class="font-black">Built For Creators</strong><br> If you’re a publisher, influencer, or content creator -- this program is designed for you! You have an audience who cares about music, and we’d love to support their educational journeys!</li>
                <li class="w-full md:w-1/2 md:pr-12 lg:pr-24 leading-relaxed mb-6 md:mb-12 lg:mb-16"><i class="far fa-li fa-check-circle text-musora text-4xl"></i><strong class="font-black">Get Paid Consistently & On Time</strong><br> We always put our students first. After that, it’s you! You’ll be paid consistently and on-time -- with a clear breakdown of your earnings so you can attribute your efforts and successes.</li>
                <li class="w-full md:w-1/2 md:pr-12 lg:pr-24 leading-relaxed mb-6 md:mb-12 lg:mb-16"><i class="far fa-li fa-check-circle text-musora text-4xl"></i><strong class="font-black">World-Class Student Experience</strong><br> You’ll always have confidence that you’re promoting meaningful products and services. Students are always supported with world-class platforms, teachers, and communities.</li>
                <li class="w-full md:w-1/2 md:pr-12 lg:pr-24 leading-relaxed mb-6 md:mb-12 lg:mb-16"><i class="far fa-li fa-check-circle text-musora text-4xl"></i><strong class="font-black">Free Membership For Active Partners</strong><br> If you’re promoting our memberships, we want you to be a part of the community so you see the impact it makes! You’ll receive a free membership for as long as you remain an ambassador.</li>
                <li class="w-full md:w-1/2 md:pr-12 lg:pr-24 leading-relaxed mb-6 md:mb-12 lg:mb-16"><i class="far fa-li fa-check-circle text-musora text-4xl"></i><strong class="font-black">Unique Offers & Creatives</strong><br> Depending on the partnership, you’ll have access to a dedicated storefront page and custom creatives to support your goals as an ambassador.</li>
                <li class="w-full md:w-1/2 md:pr-12 lg:pr-24 leading-relaxed mb-6 md:mb-12 lg:mb-16"><i class="far fa-li fa-check-circle text-musora text-4xl"></i><strong class="font-black">Sponsored Content & Giveaways</strong><br> Have an idea? We’re all ears. We want to support your community and help you find the best ways to promote the partnership with your audience.</li>
                <li class="w-full md:w-1/2 md:pr-12 lg:pr-24 leading-relaxed mb-6 md:mb-0"><i class="far fa-li fa-check-circle text-musora text-4xl"></i><strong class="font-black">Monthly Newsletter</strong><br> You’ll get a monthly newsletter about opportunities, initiatives, and Musora events. We want to help spark ideas for collaborating on exciting campaigns.</li>
                <li class="w-full md:w-1/2 md:pr-12 lg:pr-24 leading-relaxed"><i class="far fa-li fa-check-circle text-musora text-4xl"></i><strong class="font-black">Dedicated & Responsive Support</strong><br> You’ll have an account manager to support your campaigns -- brainstorm what’s working, what’s not, and how we can work together to reach the goal of supporting and inspiring musicians.</li>
            </ul>
        </div>
    </section>
    <section class="bg-cover bg-center text-center text-white py-8 md:py-10 lg:py-14 px-4 relative">
        {{-- background --}}
        <img src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/affiliate/background-piano.jpg"
            class="absolute object-cover object-center transition-opacity opacity-0 inset-0 w-full h-full"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
        />
        <div class="container mx-auto max-w-6xl relative z-0">
            <h3><strong>How Do I Start?</strong></h3>
            <div class="flex flex-wrap my-8 md:my-12 lg:my-16">
                <div class="w-full md:w-1/3 px-2 mb-8 md:mb-0">
                    <div class="inline-block rounded-full p-3 text-center border-musora before:m-[-6px] relative" style="background-color:#091724;width: 78px;"><h1 class="text-5xl text-musora"><strong>1</strong></h1></div>
                    <h4 class="leading-normal mt-4 lg:mt-5 mb-2 lg:mb-4"><strong>Read The Guidelines</strong></h4>
                    <p><em><a class="cursor-pointer" x-on:click="modal = true"><u>Click here to open &raquo;</u></a></em></p>
                </div>
                <div class="w-full md:w-1/3 px-2 mb-8 md:mb-0">
                    <div class="inline-block rounded-full p-3 text-center border-musora before:m-[-6px] relative" style="background-color:#161e29;width: 78px;"><h1 class="text-5xl text-musora"><strong>2</strong></h1></div>
                    <h4 class="leading-normal mt-4 lg:mt-5 mb-2 lg:mb-4"><strong>Apply For The Program</strong></h4>
                    <p><em><a href="https://airtable.com/shrmKAXQyoWLbKKW6"><u>Just fill out the short form &raquo;</u></a></em></p>
                </div>
                <div class="w-full md:w-1/3 px-2">
                    <div class="inline-block rounded-full p-3 text-center border-musora before:m-[-6px] relative" style="background-color:#020e1a;width: 78px;"><h1 class="text-5xl text-musora"><strong>3</strong></h1></div>
                    <h4 class="leading-normal mt-4 lg:mt-5 mb-2 lg:mb-4"><strong>Review & Processing</strong></h4>
                    <p><em>We’ll reach out if you’re approved.</em></p>
                </div>
            </div>
            <div class="inline-block text-left">
                <p><strong>Thanks for your interest in our partner program!</strong></p>
                <ul class="fa-ul">
                    <li><i class="fas fa-li fa-asterisk"></i><em>Your site and/or channel will be reviewed to join the Musora  Affiliate program.</em></li>
                    <li><i class="fas fa-li fa-asterisk"></i><em>If approved, you’ll have access to all the links, logos and banners for your chosen Musora brand(s).</em></li>
                    <li><i class="fas fa-li fa-asterisk"></i><em>We will not approve coupon sites, sites under construction, or sites with long load times or functionality issues.</em></li>
                </ul>
            </div>
        </div>
    </section>

    <div
        x-data="{
            init() {
                new Splide(this.$refs.splide, {
                    perPage: 3,
                    rewind : true,
                    perMove: 1,
                    classes: {
                        arrow: 'splide__arrow bg-white',
                        pagination: 'splide__pagination hidden',
                    },
                    breakpoints: {
                        767: {
                            perPage: 1,
                        },
                        1023: {
                            perPage: 2,
                            type   : 'loop',
                        },
                    },
                }).mount()
            },
        }"
        class="bg-[#000c18]"
    >
        <section x-ref="splide" class="splide text-white px-7 py-8 md:py-14 lg:py-20 mx-auto max-w-6xl" aria-label="Splide/Alpine.js Carousel Example">
            <div class="splide__track relative">
                <ul class="splide__list">
                    <li class="splide__slide flex flex-col items-center justify-center">
                        <div class="px-3">
                            <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(#000c18, #01132b)">
                                <p class="leading-normal md:leading-relaxed">
                                    "Drumeo is by far the greatest drum community out there. Literally you can find everything about drums, from lessons, to play alongs, live streams, documentaries, tips, drum sheets. Everything is extremely well organized. It’s amazing!"
                                </p>
                                <div class="flex items-center justify-center pt-5 md:pt-8">
                                    <img 
                                        class="rounded-full w-1/4 transition-opacity opacity-0" 
                                        src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://musora-center.s3.amazonaws.com/affiliate/testimonial-alejandro.jpg"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                    >
                                    <div class="text pl-3 md:pl-5">
                                        <h6 class="uppercase"><strong>Alejandro Sifuentes</strong></h6>
                                        <h6 style="color:#405575" class="uppercase pt-2 leading-none">Drum YouTuber &<br>
                                            Musora Ambassador</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
    
                    <li class="splide__slide flex flex-col items-center justify-center">
                        <div class="px-3">
                            <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(#000c18, #01132b)">
                                <p class="leading-normal md:leading-relaxed">
                                    "Pianote avoids the one-size-fits-all feel that online piano methods can have, and gives in-person piano teachers a run for their money with several instructors with whom students can interact."
                                </p>
                                <div class="flex items-center justify-center pt-5 md:pt-8">
                                    <img 
                                        class="rounded-full w-1/4 transition-opacity opacity-0" 
                                        src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://musora-center.s3.amazonaws.com/affiliate/testimonial-piano-dreamers.jpg"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                    >
                                    <div class="text pl-3 md:pl-5">
                                        <h6 class="uppercase"><strong>Piano Dreamers</strong></h6>
                                        <h6 style="color:#405575" class="uppercase pt-2 leading-none">Piano Community &<br>
                                            Musora Ambassador</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
    
                    <li class="splide__slide flex flex-col items-center justify-center">
                        <div class="px-3">
                            <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(#000c18, #01132b)">
                                <p class="leading-normal md:leading-relaxed">
                                    "The reason this approach appeals to me is because it’s kind of a more guided way to how I learned guitar. And that’s just doing the cool stuff! So if you tried the theory and exercise way and it’s just not working or you already play guitar and just want to have fun, check it out!"
                                </p>
                                <div class="flex items-center justify-center pt-5 md:pt-8">
                                    <img 
                                        class="rounded-full w-1/4 transition-opacity opacity-0" 
                                        src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://musora-center.s3.amazonaws.com/affiliate/testimonial-aguafish.jpg"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                    >
                                    <div class="text pl-3 md:pl-5">
                                        <h6 class="uppercase"><strong>Agufish</strong></h6>
                                        <h6 style="color:#405575" class="uppercase pt-2 leading-none">Guitar YouTuber &<br>
                                            Musora Ambassador</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
    
                    <li class="splide__slide flex flex-col items-center justify-center">
                        <div class="px-3">
                            <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(#000c18, #01132b)">
                                <p class="leading-normal md:leading-relaxed">
                                    "I always recommend Drumeo because of the absolute wealth of knowledge they offer from so many of the world’s greatest drummers! Not only will you learn just about anything you could desire to learn, but you will be so inspired and entertained by your drum heroes with some of the best production value on the internet!"
                                </p>
                                <div class="flex items-center justify-center pt-5 md:pt-8">
                                    <img 
                                        class="rounded-full w-1/4 transition-opacity opacity-0" 
                                        src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/trials/casey-cooper.jpg"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                    >
                                    <div class="text pl-3 md:pl-5">
                                        <h6 class="uppercase"><strong>Casey Cooper</strong></h6>
                                        <h6 style="color:#405575" class="uppercase pt-2 leading-none">Drum YouTuber &<br>
                                            Musora Ambassador</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>

    <section class="bg-cover bg-center text-center text-white py-24 md:py-32 lg:py-52 px-4 relative">
        <img src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/affiliate/background-guitar.jpg"
            class="absolute object-cover transition-opacity opacity-0 z-[-2] w-full h-full top-0 left-0 object-cover"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
        />
        <div class="container mx-auto max-w-6xl">
            <h2><strong>Musora’s<br class="inline sm:hidden"> Ambassador Program</strong></h2>
            <a class="join bg-musora my-8 md:my-10 inline-block" href="https://airtable.com/shrmKAXQyoWLbKKW6">APPLY NOW</a>
            <p class="leading-normal">Have any questions? Please email <a href="mailto:natalie@musora.com"><u>natalie@musora.com</u></a> after<br class="hidden md:inline">
                reviewing the <a class="cursor-pointer" x-on:click="modal = true"><u>brand guidelines</u></a> and <a href="https://airtable.com/shrmKAXQyoWLbKKW6"><u>application page</u></a>.</p>
        </div>
    </section>

    <!-- Modal -->
    <div
        x-show="modal"
        style="display: none"
        x-on:keydown.escape.prevent.stop="modal = false"
        role="dialog"
        aria-modal="true"
        x-id="['modal-title']"
        :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 z-10 overflow-y-auto"
    >
        <!-- Overlay -->
        <div x-show="modal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>
 
        <!-- Panel -->
        <div
            x-show="modal" x-transition
            x-on:click="modal = false"
            class="relative flex min-h-screen items-center justify-center p-4"
        >
            <!-- Close button -->
            <i class="fal fa-times fa-2x fixed top-16 right-2 text-white cursor-pointer text-5xl"></i>
            <div
                x-on:click.stop
                x-trap.noscroll.inert="modal"
                class="relative w-full max-w-5xl overflow-y-auto rounded-xl bg-white p-12 shadow-lg"
            >
                <div class="py-4 md:py-6 px-3 md:px-6 text-left">
                    <h5 class="text-center mb-2"><strong>Partnership and Brand Guidelines</strong></h5>
                    <p>Requirements:</p>
                    <ul class="list-disc list-outside pl-5 mb-2">
                        <li>Must disclose either affiliate partnership or sponsorship.</li>
                        <li>All sponsored content must be approved by Musora Account Manager prior to publishing.</li>
                        <li>All content must live permanently on respective channel (unless platform removes on time schedule, e.g. Snapchat, IG Stories, etc.).</li>
                        <li>Honest and fair reviews. If you’re unhappy with the product, please give us the opportunity to resolve any issue prior to posting your review.</li>
                    </ul>
                    <p>Restrictions:</p>
                    <ul class="list-disc list-outside pl-5 mb-2">
                        <li>Must not promote or contain sexually explicit or obscene materials.</li>
                        <li>Must not promote violence or contain violent materials.</li>
                        <li>Must not promote or contain materials or activity that is hateful, harassing, harmful, invasive of another’s privacy, abusive, or discriminatory (including on the basis of race, color, sex, religion, nationality, disability, sexual orientation, political affiliation or age.)</li>
                        <li>Must not promote or undertake in illegal activities.</li>
                        <li>Must not incorporate any materials which infringe or assist others to infringe on any copyright, trademark or other intellectual property rights or to violate the law.</li>
                        <li>Must not include any unapproved trademark, including logos, of Musora Media brands or its partners.</li>
                        <li>Must not make inaccurate, deceptive or otherwise misleading claims about Musora Media brands, Musora Media partners, products, policies, promotions, or prices.</li>
                        <li>You will not artificially generate clicks or impressions on your Site(s) or create Sessions on Musora Media Inc.  site(s), whether by way of fake redirects, automated software, or other mechanisms to generate Actions;</li>
                        <li>You must not create or design your website(s) or any other website(s) that you operate,  explicitly or implied in a manner which resembles our website(s) nor design your website(s) in a  manner which leads customers to believe you are Musora Media Inc. or any other affiliated business.</li>
                        <li>Affiliates that bid in their Pay-Per-Click campaigns using keywords such as  drumeo.com, Drumeo, www.drumeo, www.drumeo.com, and/or any  misspellings or similar alterations of these – be it separately or in combination with other  keywords – and do not direct the traffic from such campaigns to their own website prior to re directing it to ours, will be considered trademark violators, and will be banned from Musora Media Inc.’s Affiliate Program.</li>
                        <li>Affiliate shall not transmit any so-called “interstitials,” “Parasiteware™,” “Parasitic  Marketing,” “Shopping Assistance Application,” “Toolbar Installations and/or Add-ons,”  “Shopping Wallets” or “deceptive pop-ups and/or pop-unders” to consumers from the time the consumer clicks on a qualifying link until such time as the consumer has fully exited Musora Media Inc.’s sites (i.e., where no page from our site or any of Musora Media Inc. brand’s content or  branding is visible on the end-user’s screen).</li>
                        <li>You will not sell, resell, redistribute, sublicense, or transfer any Program Content or any  application that uses, incorporates, or displays any Program Content or Data Feeds.</li>
                    </ul>
                    <p>We reserve the right to terminate our agreement at any time.</p>
                </div>
            </div>
        </div>
    </div>
@stop
