<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <title>THANKS FOR CONFIRMING! | Pianote</title>
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    @include('members.partials._fonts')
    @include('members.partials._favicons')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/parcel/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <style>
        body {
            text-align:center;
            overflow: hidden;
        }

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
        .join {
            display: inline-block;
            font: 700 13px/1em "Roboto Condensed",sans-serif;
            text-transform: uppercase;
            background: #F61A30;
            border: 2px solid #F61A30;
            border-radius: 50px;
            color: #FFF;
            outline: none;
            cursor: pointer;
            text-align: center;
            user-select: none;
            text-decoration: none;
            transition: background-color .3s;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0.35);
            padding: 7px 10px;
        }
        @media (min-width: 768px) {
            .join {
                font-size: 14px;
                padding: 13px 30px;
            }
        }

        .join:hover,
        .join:focus {
            background:#ff334b;
            border-color:#ff334b;
        }

        .join.outline {
            background:transparent;
            border:2px solid #F61A30;
            color:#F61A30;
        }

        .join.outline:hover,
        .join.outline:focus {
            background:#F61A30;
            color:#fff;
        }
    </style>
    {{--<style type="text/css" id="ate_css">.addeventatc{display:inline-block;position:relative;z-index:99998;font-family:"Open Sans",Roboto,"Helvetica Neue",Helvetica,Optima,Segoe,"Segoe UI",Candara,Calibri,Arial,sans-serif;color:#000!important;font-weight:600;line-height:100%;background:#fff;font-size:15px;text-decoration:none;border:1px solid transparent;padding:13px 12px 12px 43px;-webkit-border-radius:3px;border-radius:3px;cursor:pointer;-webkit-font-smoothing:antialiased!important;outline-color:rgba(0,78,255,0.5);text-shadow:1px 1px 1px rgba(0,0,0,0.004);-webkit-user-select:none;-webkit-tap-highlight-color:rgba(0,0,0,0);box-shadow:0 0 0 0.5px rgba(50,50,93,.17), 0 2px 5px 0 rgba(50,50,93,.1), 0 1px 1.5px 0 rgba(0,0,0,.07), 0 1px 2px 0 rgba(0,0,0,.08), 0 0 0 0 transparent!important;background-image:url(https://www.addevent.com/gfx/icon-calendar-t5.png), url(https://www.addevent.com/gfx/icon-calendar-t1.svg), url(https://www.addevent.com/gfx/icon-apple-t5.svg), url(https://www.addevent.com/gfx/icon-facebook-t5.svg), url(https://www.addevent.com/gfx/icon-google-t5.svg), url(https://www.addevent.com/gfx/icon-office365-t5.svg), url(https://www.addevent.com/gfx/icon-outlook-t5.svg), url(https://www.addevent.com/gfx/icon-outlookcom-t5.svg), url(https://www.addevent.com/gfx/icon-yahoo-t5.svg);background-position:-9999px -9999px;background-repeat:no-repeat;}.addeventatc:hover 						{background-color:#fafafa;color:#000;font-size:15px;text-decoration:none;}.addeventatc:active 					{border-width:2px 1px 0px 1px;}.addeventatc-selected 					{background-color:#f9f9f9;}.addeventatc .addeventatc_icon 			{width:18px;height:18px;position:absolute;z-index:1;left:12px;top:10px;background:url(https://www.addevent.com/gfx/icon-calendar-t1.svg) no-repeat;background-size:18px 18px;}.addeventatc .start, .addeventatc .end, .addeventatc .timezone, .addeventatc .title, .addeventatc .description, .addeventatc .location, .addeventatc .organizer, .addeventatc .organizer_email, .addeventatc .facebook_event, .addeventatc .all_day_event, .addeventatc .date_format, .addeventatc .alarm_reminder, .addeventatc .recurring, .addeventatc .attendees, .addeventatc .calname, .addeventatc .uid, .addeventatc .sequence, .addeventatc .status, .addeventatc .method, .addeventatc .client, .addeventatc .transp {display:none!important;}.addeventatc br 						{display:none;}.addeventatc_dropdown 				{width:230px;position:absolute;padding:6px 0px 0px 0px;font-family:"Open Sans",Roboto,"Helvetica Neue",Helvetica,Optima,Segoe,"Segoe UI",Candara,Calibri,Arial,sans-serif;color:#000!important;font-weight:600;line-height:100%;background:#fff;font-size:15px;text-decoration:none;text-align:left;margin-left:-1px;display:none;-moz-border-radius:3px;-webkit-border-radius:3px;-webkit-box-shadow:rgba(0,0,0,0.4) 0px 10px 26px;-moz-box-shadow:rgba(0,0,0,0.4) 0px 10px 26px;box-shadow:rgba(0,0,0,0.4) 0px 10px 26px;transform:scale(.98,.98) translateY(5px);opacity:0.5;z-index:-1;transition:transform .15s ease;-webkit-user-select:none;-webkit-tap-highlight-color:rgba(0,0,0,0);}.addeventatc_dropdown.topdown 			{transform:scale(.98,.98) translateY(-5px)!important;}.addeventatc_dropdown span 				{display:block;line-height:100%;background:#fff;text-decoration:none;cursor:pointer;font-size:15px;color:#333;font-weight:600;padding:14px 10px 14px 55px;margin:-2px 0px;}.addeventatc_dropdown span:hover 		{background-color:#f4f4f4;color:#000;text-decoration:none;font-size:15px;}.addeventatc_dropdown em 				{color:#999!important;font-size:12px!important;font-weight:400;}.addeventatc_dropdown .frs a 			{background:#fff;color:#cacaca!important;cursor:pointer;font-size:9px!important;font-style:normal!important;font-weight:400!important;line-height:110%!important;padding-left:10px;position:absolute;right:10px;text-align:right;text-decoration:none;top:5px;z-index:101;}.addeventatc_dropdown .frs a:hover 		{color:#999!important;}.addeventatc_dropdown .ateappleical 	{background:url(https://www.addevent.com/gfx/icon-apple-t5.svg) 18px 40% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .ategoogle 		{background:url(https://www.addevent.com/gfx/icon-google-t5.svg) 18px 50% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .ateoffice365 	{background:url(https://www.addevent.com/gfx/icon-office365-t5.svg) 19px 50% no-repeat;background-size:18px 100%;}.addeventatc_dropdown .ateoutlook 		{background:url(https://www.addevent.com/gfx/icon-outlook-t5.svg) 18px 50% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .ateoutlookcom 	{background:url(https://www.addevent.com/gfx/icon-outlookcom-t5.svg) 18px 50% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .ateyahoo 		{background:url(https://www.addevent.com/gfx/icon-yahoo-t5.svg) 18px 50% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .atefacebook 		{background:url(https://www.addevent.com/gfx/icon-facebook-t5.svg) 18px 50% no-repeat;background-size:22px 100%;}.addeventatc_dropdown .copyx 			{height:21px;display:block;position:relative;cursor:default;}.addeventatc_dropdown .brx 				{height:1px;overflow:hidden;background:#e8e8e8;position:absolute;z-index:100;left:10px;right:10px;top:9px;}.addeventatc_dropdown.addeventatc-selected {opacity:1;transform:scale(1,1) translateY(0px);z-index:99999999;}.addeventatc_dropdown.topdown.addeventatc-selected {transform:scale(1,1) translateY(0px)!important;}.addeventatc_dropdown .drop_markup {background-color:#f4f4f4;}</style>--}}
    {{--<script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js"></script>--}}
</head>
<body class="p-6 md:p-10">
    <h5><strong>THANKS FOR CONFIRMING!</strong></h5>
    <h1 class="text-pianote my-4"><i class="fas fa-check"></i> </h1>
    <p class="mb-5">We will send you an email reminder about Cassi’s live lesson 1 hour before she starts. <br class="hidden md:inline">
        Her next Technique Tuesday is on September 28th, at 2 PM PDT. Hope to see you there!</p>
    {{--<div class="my-2 mx-1 addeventatc" id="addeventatc1">--}}
        {{--Mark Your Calendar <i class="fas fa-caret-down"></i>--}}
        {{--<span class="hide start">2021/09/07 14:00:00</span>--}}
        {{--<span class="hide end">2021/09/07 15:00:00</span>--}}
        {{--<span class="hide timezone">America/Vancouver</span>--}}
        {{--<span class="hide title">Technique Tuesday - Live With Cassi (Gb Major / Eb Minor - Week 2)</span>--}}
        {{--<span class="hide description">Welcome to "Technique Tuesday" with Cassi! This is an all-level live stream that focuses on how you can improve your technique. This is so important because great technique makes great pianists! <br class="atc_node"> <br class="atc_node"> And in this session, join Cassi as she teaches some of her favorite exercises in the key of Gb Major and Eb Minor! <br class="atc_node"> <br class="atc_node"> You Access Link: https://www.pianote.com/members/live<br class="atc_node"> <br class="atc_node"> See you there!</span>--}}
        {{--<span class="hide location">https://www.pianote.com/members/live</span>--}}
        {{--<span class="hide all_day_event">false</span>--}}
        {{--<span class="hide date_format">MM/DD/YYYY</span>--}}
        {{--<span class="hide alarm_reminder">15</span>--}}
    {{--</div>--}}
    {{--<a class="my-2 mx-1 join" href="https://www.addevent.com/event/ro8273845">Mark Your Calendar</a>--}}
    <br><a class="my-2 mx-1 join" href="/members">Go To Members Area &raquo;</a>
</body>
</html>
