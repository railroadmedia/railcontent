@extends('pianote._partials.global-layout')

@section('global-head')
    <title>1 Million Subscribers Party | Pianote</title>
    <meta property="og:title" content="1 Million Subscribers Party | Pianote">

    <meta name="description" content="We’ve just hit an incredible milestone… 1 MILLION SUBSCRIBERS!">
    <meta property="og:description" content="We’ve just hit an incredible milestone… 1 MILLION SUBSCRIBERS!">

    <meta property="og:url" content="https://www.pianote.com/one-million/">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/marketing/parcel/pianote/lead-gen.css">
    <link href="/marketing/parcel/pianote/lead-gen-learn-songs.css" rel="stylesheet">

    <style type="text/css" id="ate_css">.addeventatc{display:inline-block;position:relative;z-index:99998;font-family:"Open Sans",Roboto,"Helvetica Neue",Helvetica,Optima,Segoe,"Segoe UI",Candara,Calibri,Arial,sans-serif;color:#000!important;font-weight:600;line-height:100%;background:#fff;font-size:15px;text-decoration:none;border:1px solid transparent;padding:13px 12px 12px 43px;-webkit-border-radius:3px;border-radius:3px;cursor:pointer;-webkit-font-smoothing:antialiased!important;outline-color:rgba(0,78,255,0.5);text-shadow:1px 1px 1px rgba(0,0,0,0.004);-webkit-user-select:none;-webkit-tap-highlight-color:rgba(0,0,0,0);box-shadow:0 0 0 0.5px rgba(50,50,93,.17), 0 2px 5px 0 rgba(50,50,93,.1), 0 1px 1.5px 0 rgba(0,0,0,.07), 0 1px 2px 0 rgba(0,0,0,.08), 0 0 0 0 transparent!important;background-image:url(https://www.addevent.com/gfx/icon-calendar-t5.png), url(https://www.addevent.com/gfx/icon-calendar-t1.svg), url(https://www.addevent.com/gfx/icon-apple-t5.svg), url(https://www.addevent.com/gfx/icon-facebook-t5.svg), url(https://www.addevent.com/gfx/icon-google-t5.svg), url(https://www.addevent.com/gfx/icon-office365-t5.svg), url(https://www.addevent.com/gfx/icon-outlook-t5.svg), url(https://www.addevent.com/gfx/icon-outlookcom-t5.svg), url(https://www.addevent.com/gfx/icon-yahoo-t5.svg);background-position:-9999px -9999px;background-repeat:no-repeat;}.addeventatc:hover 						{background-color:#fafafa;color:#000;font-size:15px;text-decoration:none;}.addeventatc:active 					{border-width:2px 1px 0px 1px;}.addeventatc-selected 					{background-color:#f9f9f9;}.addeventatc .addeventatc_icon 			{width:18px;height:18px;position:absolute;z-index:1;left:12px;top:10px;background:url(https://www.addevent.com/gfx/icon-calendar-t1.svg) no-repeat;background-size:18px 18px;}.addeventatc .start, .addeventatc .end, .addeventatc .timezone, .addeventatc .title, .addeventatc .description, .addeventatc .location, .addeventatc .organizer, .addeventatc .organizer_email, .addeventatc .facebook_event, .addeventatc .all_day_event, .addeventatc .date_format, .addeventatc .alarm_reminder, .addeventatc .recurring, .addeventatc .attendees, .addeventatc .calname, .addeventatc .uid, .addeventatc .sequence, .addeventatc .status, .addeventatc .method, .addeventatc .client, .addeventatc .transp {display:none!important;}.addeventatc br 						{display:none;}.addeventatc_dropdown 				{width:230px;position:absolute;padding:6px 0px 0px 0px;font-family:"Open Sans",Roboto,"Helvetica Neue",Helvetica,Optima,Segoe,"Segoe UI",Candara,Calibri,Arial,sans-serif;color:#000!important;font-weight:600;line-height:100%;background:#fff;font-size:15px;text-decoration:none;text-align:left;margin-left:-1px;display:none;-moz-border-radius:3px;-webkit-border-radius:3px;-webkit-box-shadow:rgba(0,0,0,0.4) 0px 10px 26px;-moz-box-shadow:rgba(0,0,0,0.4) 0px 10px 26px;box-shadow:rgba(0,0,0,0.4) 0px 10px 26px;transform:scale(.98,.98) translateY(5px);opacity:0.5;z-index:-1;transition:transform .15s ease;-webkit-user-select:none;-webkit-tap-highlight-color:rgba(0,0,0,0);}.addeventatc_dropdown.topdown 			{transform:scale(.98,.98) translateY(-5px)!important;}.addeventatc_dropdown span 				{display:block;line-height:100%;background:#fff;text-decoration:none;cursor:pointer;font-size:15px;color:#333;font-weight:600;padding:14px 10px 14px 55px;margin:-2px 0px;}.addeventatc_dropdown span:hover 		{background-color:#f4f4f4;color:#000;text-decoration:none;font-size:15px;}.addeventatc_dropdown em 				{color:#999!important;font-size:12px!important;font-weight:400;}.addeventatc_dropdown .frs a 			{background:#fff;color:#cacaca!important;cursor:pointer;font-size:9px!important;font-style:normal!important;font-weight:400!important;line-height:110%!important;padding-left:10px;position:absolute;right:10px;text-align:right;text-decoration:none;top:5px;z-index:101;}.addeventatc_dropdown .frs a:hover 		{color:#999!important;}.addeventatc_dropdown .ateappleical 	{background:url(https://www.addevent.com/gfx/icon-apple-t5.svg) 18px 40% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .ategoogle 		{background:url(https://www.addevent.com/gfx/icon-google-t5.svg) 18px 50% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .ateoffice365 	{background:url(https://www.addevent.com/gfx/icon-office365-t5.svg) 19px 50% no-repeat;background-size:18px 100%;}.addeventatc_dropdown .ateoutlook 		{background:url(https://www.addevent.com/gfx/icon-outlook-t5.svg) 18px 50% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .ateoutlookcom 	{background:url(https://www.addevent.com/gfx/icon-outlookcom-t5.svg) 18px 50% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .ateyahoo 		{background:url(https://www.addevent.com/gfx/icon-yahoo-t5.svg) 18px 50% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .atefacebook 		{background:url(https://www.addevent.com/gfx/icon-facebook-t5.svg) 18px 50% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .copyx 			{height:21px;display:block;position:relative;cursor:default;}.addeventatc_dropdown .brx 				{height:1px;overflow:hidden;background:#e8e8e8;position:absolute;z-index:100;left:10px;right:10px;top:9px;}.addeventatc_dropdown.addeventatc-selected {opacity:1;transform:scale(1,1) translateY(0px);z-index:99999999;}.addeventatc_dropdown.topdown.addeventatc-selected {transform:scale(1,1) translateY(0px)!important;}.addeventatc_dropdown .drop_markup {background-color:#f4f4f4;}</style>
    <style>

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h1, h2, h3, h4, h5, h6, li, p {
            font-family:Open Sans, sans-serif;
            font-weight:400;
            line-height:1em;
            margin:0 auto
        }

        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size:50%;
            top:-.75em
        }

        h1 {
            font-size:24px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }

        @media (min-width:991px) {
            h1 {
                font-size:48px
            }
        }

        h2 {
            font-size:20px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h2 {
                font-size:30px
            }
        }

        @media (min-width:991px) {
            h2 {
                font-size:36px
            }
        }

        h3 {
            font-size:18px
        }

        @media (min-width:768px) {
            h3 {
                font-size:24px
            }
        }

        @media (min-width:991px) {
            h3 {
                font-size:30px
            }
        }

        h4 {
            font-size:16px
        }

        @media (min-width:768px) {
            h4 {
                font-size:20px
            }
        }

        @media (min-width:991px) {
            h4 {
                font-size:24px
            }
        }

        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:991px) {
            h5 {
                font-size:20px
            }
        }

        h6 {
            font-size:15px
        }

        @media (min-width:768px) {
            h6 {
                font-size:16px
            }
        }

        @media (min-width:991px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:991px) {
            li, p {
                font-size:16px
            }
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.nav')
    <section class="text-center text-white pb-5 md:pb-10 px-3 md:px-4" style="background:linear-gradient(to bottom, #030a14 50%, #44151d);">
        <div class="container mx-auto max-w-5xl">
            <a href="https://youtu.be/yRdOLuLz2I0" target="_blank"><img class="inline-block h-44 md:h-72 lg:h-96" src="https://pianote.s3.amazonaws.com/lead-gen/one-mil.png"></a>
            <h1 class="md:tracking-widest -mt-1 md:-mt-2 lg:-mt-3">SUBSCRIBER CELEBRATION</h1>
            <h6 class="leading-normal my-3 md:my-5">
                Enter your contact info for your chance to win one<br class="hidden md:inline">
                of 72 prizes at the January 14th celebration party.</h6>
            <a data-open="trailer" class="join">Join Giveaway</a>
            <h5 class="leading-normal text-yellow-400 mt-3 md:mt-5"><strong>Pianote 1M Subscriber Party</strong><br>
                January 14th, 2022<br>
                <a target="_blank" href="https://www.google.com/search?q=10%3A00+am+pdt">10:00 AM (PT) / 1:00 PM (ET) <i class="fas fa-info-circle"></i></a> </h5>
        </div>
    </section>
    <section class="py-8 px-3">
        <div class="container mx-auto max-w-2xl">
            <h2 class="leading-normal mb-4 md:mb-7" style="background: linear-gradient(to bottom, #f61a30, #d3091d);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><strong>We’re having a party.</strong></h2>
            <p>We’ve just hit an incredible milestone… 1 MILLION SUBSCRIBERS!
                <br><br>
                There’s been so much support for Pianote over the years and it’s all because of YOU. So to celebrate we’re going live on January 14th to play some tunes, have some laughs, chat with all of you, and celebrate this amazing journey.
            <br><br>
                <div class="my-2 mx-1 addeventatc" id="addeventatc1">
                    ADD TO CALENDAR <i class="fas fa-caret-down"></i>
                    <span class="hide start">2022/01/14 10:00:00</span>
                    <span class="hide end">2022/01/14 11:00:00</span>
                    <span class="hide timezone">America/Vancouver</span>
                    <span class="hide title">Pianote 1M Subscriber Party</span>
                    <span class="hide description">To celebrate we’re going live on January 14th to play some tunes, have some laughs, chat with all of you, and celebrate this amazing journey.</span>
                    <span class="hide location">https://youtu.be/yRdOLuLz2I0</span>
                    <span class="hide all_day_event">false</span>
                    <span class="hide date_format">MM/DD/YYYY</span>
                    <span class="hide alarm_reminder">15</span>
                </div>
            <br><br>

            <strong>We’re also giving away 2 FREE pianos, Pianote memberships, and extra goodies:</strong></p>
            <ul class="list-disc ml-10 my-4">
                <li>2 Casio AP 470 keyboards (USA entries only)</li>
                <li>10 Annual Pianote memberships</li>
                <li>50 Monthly Pianote memberships</li>
                <li>5 Practice Planners</li>
                <li>5 Chords & Scales Books</li>
            </ul>

            <p>Enter your information at the top of this page to be entered into the random draws we’ll be doing throughout the live stream. The winners will be contacted immediately after -- it’s that simple.</p>

            <br><br>
            <a target="_blank" href="https://youtu.be/yRdOLuLz2I0" class="join blue smaller">1 MILLION SUBSCRIBERS PARTY</a>
        </div>
    </section>
    <div class="reveal large text-center" id="trailer" data-reveal data-reset-on-close="false" style="max-width:440px">
        <iframe class="google-form w-full" src="https://docs.google.com/forms/d/e/1FAIpQLScfFSkurzZdJtpdG_ReoopBLnURr2e0D60OjMST-2GWUsC71A/viewform?embedded=true" height="810" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
    </div>
    @include("pianote.sales.footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="/marketing/js/modal.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js"></script>
@stop
