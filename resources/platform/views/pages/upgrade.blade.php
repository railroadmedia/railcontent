@extends('partials.layout')

@section('meta')
    <title>Upgrade Membership | Musora</title>
@endsection

@section('content')
    <page-container>

        <div v-cloak>

            <header id="pageHeader"
                    class="tw-container tw-mx-auto fluid pv-4"
                    style="background-image:url('https://singeo.s3.amazonaws.com/singeo-header-image.jpg');">
                <div class="tw-container tw-mx-auto tw-text-center">
                    <h1 class="heading tw-text-white tw-mb-2">
                        <a href="javascript:history.back()" class="tw-no-underline">
                            <i class="fas fa-arrow-circle-left text-grey-3"></i>
                        </a>
                        Upgrade Your Account
                    </h1>
                    <p class="body tw-text-white">
                        The page you are trying to access requires a singeo Membership.
                    </p>
                    <p class="body tw-text-white tw-mb-2">
                        <a href="/#orderNow"
                        class="tw-font-bold tw-text-white">
                            Upgrade your account
                        </a>
                        or read below to find out what you get with singeo.
                    </p>
                    <div class="tw-flex-center">
                        <a href="/#orderNow"
                        class="btn tw-bg-singeo tw-text-white collapse-250">
                            Get a singeo Membership
                        </a>
                    </div>
                </div>
            </header>

        {{--    <div class="container mv-3">--}}
        {{--        <div class="flex flex-column ">--}}
        {{--            <div class="flex flex-row flex-wrap align-v-center feature-row reverse-xs pa-3 mb-3">--}}

        {{--                <div class="flex flex-column xs-12 sm-6 pa-3 collapsed-xs">--}}
        {{--                    <div class="square-wrap arrow-left bg-white rounded pa-2" style="width:100%;">--}}
        {{--                        <div class="square rounded overflow">--}}
        {{--                            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/support.jpg" style="width:100%;">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}

        {{--                <div class="flex flex-column xs-12 sm-6 pa-3 collapsed-xs">--}}
        {{--                    <h2 class="heading dense uppercase mb-1 text-black" style="line-height:1em;">--}}
        {{--                        Musical Freedom on the Piano--}}
        {{--                    </h2>--}}
        {{--                    <p class="body mb-1 text-black">--}}
        {{--                        Unlike "video-game" learning where you only learn what keys to hit, you'll actually play--}}
        {{--                        music with step-by-step lessons that will build your foundation in sight-reading,--}}
        {{--                        chording, playing by ear, improv skills, and more!--}}
        {{--                    </p>--}}

        {{--                    <p class="body font-italic text-black">--}}
        {{--                        <i class="fas fa-check-circle text-singeo mr-1"></i>--}}
        {{--                        100+ step-by-step lessons--}}
        {{--                    </p>--}}
        {{--                    <p class="body font-italic text-black">--}}
        {{--                        <i class="fas fa-check-circle text-singeo mr-1"></i>--}}
        {{--                        Automatic Progress Tracking--}}
        {{--                    </p>--}}
        {{--                    <p class="body font-italic text-black">--}}
        {{--                        <i class="fas fa-check-circle text-singeo mr-1"></i>--}}
        {{--                        Ideal for beginners and intermediates--}}
        {{--                    </p>--}}
        {{--                </div>--}}
        {{--            </div>--}}

        {{--            <div class="flex flex-row flex-wrap align-v-center feature-row pa-3 mb-3">--}}

        {{--                <div class="flex flex-column xs-12 sm-6 pa-3 collapsed-xs">--}}
        {{--                    <div class="square-wrap arrow-right bg-white rounded pa-2" style="width:100%;">--}}
        {{--                        <div class="square rounded overflow">--}}
        {{--                            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/play.jpg" style="width:100%;">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}

        {{--                <div class="flex flex-column xs-12 sm-6 pa-3 collapsed-xs">--}}
        {{--                    <h2 class="heading dense uppercase mb-1 text-black" style="line-height:1em;">--}}
        {{--                        Play your favorite Songs--}}
        {{--                    </h2>--}}
        {{--                    <p class="body mb-1 text-black">--}}
        {{--                        Nothing is better than playing to real music! So you'll love our play-alongs for applying your--}}
        {{--                        new skills to songs  - plus detailed song breakdowns for music by popular bands of all eras--}}
        {{--                        and styles--}}
        {{--                    </p>--}}

        {{--                    <p class="body font-italic text-black">--}}
        {{--                        <i class="fas fa-check-circle text-singeo mr-1"></i>--}}
        {{--                        100+ play-along songs--}}
        {{--                    </p>--}}
        {{--                    <p class="body font-italic text-black">--}}
        {{--                        <i class="fas fa-check-circle text-singeo mr-1"></i>--}}
        {{--                        A variety of musical genres--}}
        {{--                    </p>--}}
        {{--                    <p class="body font-italic text-black">--}}
        {{--                        <i class="fas fa-check-circle text-singeo mr-1"></i>--}}
        {{--                        Practice along backing tracks--}}
        {{--                    </p>--}}
        {{--                </div>--}}
        {{--            </div>--}}



        {{--            <div class="flex flex-row flex-wrap align-v-center feature-row reverse-xs pa-3 mb-3">--}}

        {{--                <div class="flex flex-column xs-12 sm-6 pa-3 collapsed-xs">--}}
        {{--                    <div class="square-wrap arrow-left bg-white rounded pa-2" style="width:100%;">--}}
        {{--                        <div class="square rounded overflow">--}}
        {{--                            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/new-years/lisa-circle.jpg" style="width:100%;">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}

        {{--                <div class="flex flex-column xs-12 sm-6 pa-3 collapsed-xs">--}}
        {{--                    <h2 class="heading dense uppercase mb-1 text-black" style="line-height:1em;">--}}
        {{--                        Personalized Guidance and Support--}}
        {{--                    </h2>--}}
        {{--                    <p class="body mb-1 text-black">--}}
        {{--                        We're here for you every step of the way. Get direct access to real teachers any time you have--}}
        {{--                        a question, access weekly live-streaming video lessons, an connect with teachers and--}}
        {{--                        students in the community forums.--}}
        {{--                    </p>--}}

        {{--                    <p class="body font-italic text-black">--}}
        {{--                        <i class="fas fa-check-circle text-singeo mr-1"></i>--}}
        {{--                        Live lessons every week--}}
        {{--                    </p>--}}
        {{--                    <p class="body font-italic text-black">--}}
        {{--                        <i class="fas fa-check-circle text-singeo mr-1"></i>--}}
        {{--                        Video reviews & practice plans--}}
        {{--                    </p>--}}
        {{--                    <p class="body font-italic text-black">--}}
        {{--                        <i class="fas fa-check-circle text-singeo mr-1"></i>--}}
        {{--                        Real teachers respond to your questions--}}
        {{--                    </p>--}}
        {{--                </div>--}}
        {{--            </div>--}}

        {{--            <div class="flex flex-row bt-grey-1-1 pa-3 pv-3">--}}
        {{--                <div class="flex flex-column align-center pa-3 collapsed-xs grow">--}}
        {{--                    <img src="https://dmmior4id2ysr.cloudfront.net/assets/images/pianote-membership.png"--}}
        {{--                         class="mb-3" style="width:480px;max-width:100%;height:auto;">--}}
        {{--                    <p class="title capitalize"--}}
        {{--                       style="font-weight:400;">--}}
        {{--                        Rapidly Improve your Piano Playing for just $3.78 per week.--}}
        {{--                    </p>--}}

        {{--                    <p class="body font-italic text-singeo uppercase mb-3">(Billed Anually at $197/Year)</p>--}}

        {{--                    <a href="/#orderNow"--}}
        {{--                       class="btn text-white bg-singeo mb-1">--}}
        {{--                        Click Here to Get Started--}}
        {{--                    </a>--}}

        {{--                    <p class="text-grey-3" style="font-size:42px;">--}}
        {{--                        <i class="fab fa-cc-visa"></i>--}}
        {{--                        <i class="fab fa-cc-mastercard"></i>--}}
        {{--                        <i class="fab fa-cc-amex"></i>--}}
        {{--                        <i class="fab fa-cc-paypal"></i>--}}
        {{--                    </p>--}}
        {{--                    <p class="tiny text-grey-3">--}}
        {{--                        <strong>Any questions?</strong> You can also call us or order by phone toll-free at--}}
        {{--                        1-800-439-8921 or direct at 1-604-855-7605.--}}
        {{--                    </p>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}

        </div>

    </page-container>
@endsection

