@extends('guitareo._partials.global-layout')

@section('meta')
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta name="description" content="Nate Savage’s step-by-step video guitar lessons for complete beginners — with topics on both electric and acoustic guitar, live lessons, progress tracking, jam tracks, community forums, and much more." />
    <meta property="og:url" content="https://www.guitareo.com"/>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    <meta property="og:description" content="Nate Savage’s step-by-step video guitar lessons for complete beginners — with topics on both electric and acoustic guitar, live lessons, progress tracking, jam tracks, community forums, and much more."/>
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2022/og-image.jpg"/>
    <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "Organization",
          "name": "Guitareo",
          "url": "https://www.guitareo.com",
          "sameAs": [
            "https://www.facebook.com/guitareoofficial",
            "https://www.youtube.com/user/guitarlessonscom",
            "https://www.instagram.com/guitareoofficial/",
            "https://twitter.com/guitarlessons/"
          ]
        }
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link rel="stylesheet" href="{{ asset('/marketing/css/guitareo/tailwind-helpers.css') }}">
    <link href="/assets/marketing/homepage.css" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">
    <style>
        .lead-gen-banner {
            background: linear-gradient(to right, rgba(2, 2, 36, 0.6), rgba(2, 2, 36, 0.6)), url(https://cdn.musora.com/image/fetch/w_3000,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/header.jpg) 45% 45%/1150px;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
        }
        @media (min-width: 40em) {
            .lead-gen-banner {
                background: linear-gradient(to right, rgba(0, 0, 10, 0) 20%, #020224 60%, #020224 100%), url(https://cdn.musora.com/image/fetch/w_3000,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/header.jpg) 65% 40%/1300px;
            }
        }
        @media (min-width: 64em) {
            .lead-gen-banner {
                background: linear-gradient(to right, rgba(0, 0, 10, 0) 30%, #020224 80%, #020224 100%), url(https://cdn.musora.com/image/fetch/w_3000,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/header.jpg) 60% 40%/1600px;
            }
        }
        @media (min-width: 40em) {
            .lead-gen-banner {
                padding: 40px 15px;
            }
        }
        @media (min-width: 64em) {
            .lead-gen-banner {
                padding: 60px 34px;
            }
        }
        .lead-gen-banner .text-wrap {
            text-align: center;
        }
        .lead-gen-banner .text-wrap .logo {
            width: 100%;
            max-width: 310px;
        }
        @media (min-width: 40em) {
            .lead-gen-banner .text-wrap .logo {
                max-width: 440px;
            }
        }
        @media (min-width: 64em) {
            .lead-gen-banner .text-wrap .logo {
                max-width: 500px;
            }
        }
        .lead-gen-banner .text-wrap h2 {
            font: 400 15px/1.6em 'Open Sans', sans-serif;
            margin: 15px auto;
        }
        @media (min-width: 64em) {
            .lead-gen-banner .text-wrap h2 {
                font-size: 20px;
                margin: 20px auto;
            }
        }
        .lead-gen-banner .text-wrap form {
            max-width:600px;
            margin:0 auto;
        }
        .lead-gen-banner .text-wrap input {
            width:100%;
            font: 400 18px/50px 'Open Sans', sans-serif;
            height: 50px;
            color: #999;
            border-radius: 100px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 10px;
        }
        .lead-gen-banner .text-wrap input[type="submit"] {
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: 700;
            color: #fff;
            background: #9200f6;
            text-transform: uppercase;
            display: block;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
            padding: 0;
        }
        .lead-gen-banner .text-wrap input[type="submit"]:hover {
            background:#9f1aff;
        }
        @media (min-width: 40em) {
            .lead-gen-banner .text-wrap input {
                margin:0 auto 15px;
            }

        }
        .lead-gen-banner .text-wrap .disclaimer {
            display: inline-block;
            margin: 0 auto;
            opacity: 0.7;
        }
        .lead-gen-banner .text-wrap .disclaimer i {
            width: 40px;
            font-size: 29px;
            line-height: 1em;
            float: left;
        }
        .lead-gen-banner .text-wrap .disclaimer p {
            font: 400 10px/1.4em 'Open Sans', sans-serif;
            margin: 0 auto;
            width: calc(100% - 40px);
            float: left;
            text-align: left;
            max-width: 320px;
        }
        @media (min-width: 40em) {
            .lead-gen-banner .text-wrap .disclaimer p {
                max-width: 370px;
            }
        }
    </style>
@endsection

@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])

    <header class="header text-center text-white pt-24 md:pt-32 pb-5 md:pb-8 bg-right md:bg-center bg-cover relative" style="background-image:url(https://cdn.musora.com/image/fetch/w_2500,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/shop/card-thumbs/guitar-quest-background.jpg);">
        <div class="container mx-auto relative tw-clearfix">
            <div class="px-3 md:px-4 w-full md:w-2/3 float-right">
                <img class="logo" src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2Fguitar-quest-logo.png?auto=format&ixlib=php-1.2.1&w=1000&s=44e6146b6f2aed70b7a6adb1d18cb50f"><br>
                <h6 class="my-4 md:my-5 leading-normal max-w-sm lg:max-w-md">Start your journey on the guitar with the only mission-based training program that transforms your practice time into exciting real-world challenges. </h6>
                <a href="/guitar-quest/" class="join smaller gq mb-4 md:mb-5 w-full max-w-sm lg:max-w-md">See More &raquo;</a>
                <p class="uppercase text-xs"><em>24/7 Online Access // No Subscriptions<br class="inline md:hidden"> // 90-Day Guarantee</em></p>
                {{--<a href="#pageContent" class="anchor-slide down-icon"><i class="fal fa-chevron-down"></i></a>--}}
            </div>
        </div>
    </header>

    <section class="wasted-practice text-center relative">
        <div class="container mx-auto">
            <h4 class="mb-8"><strong>Because guitar lessons<br class="inline md:hidden"> shouldn’t be boring...</strong></h4>
            <div class="px-3 md:px-4 w-full list-wrap">
                <ul class="fa-ul text-left">
                    <li><i class="fas fa-li fa-check-circle"></i> If you can walk and talk at the same time,<br class="hidden md:inline"> you will play your first song within an hour.</li>
                    <li><i class="fas fa-li fa-check-circle"></i> Unlock addicting missions to keep you <br class="hidden md:inline"> motivated as you develop your guitar skills.</li>
                </ul>
                <ul class="fa-ul text-left">
                    <li><i class="fas fa-li fa-check-circle"></i> Build a technical foundation for writing music<br class="hidden md:inline"> and making creative projects come to life!</li>
                    <li><i class="fas fa-li fa-check-circle"></i> Plus get two free bonuses loaded with lessons<br class="hidden md:inline"> and songs worth $294 (this month only).</li>
                </ul>
            </div>
            <p class="leading-normal" style="max-width: 770px;">GuitarQuest was designed to be different. It’s NOT a step-by-step curriculum -- but rather an exciting adventure filled with missions based on real-life scenarios to get you playing guitar faster and keep you MOTIVATED to continue playing. If you’re tired of lesson plans that feel like a grind, try this adventure-based plan that’ll have you playing songs, jamming to your favorite tunes, and writing your own music.</p>
            <a class="join gq smaller" href="/guitar-quest">CHECK OUT Guitar Quest &raquo;</a>

            <p class="tw-font-roboto uppercase"><strong><i class="fas fa-arrow-circle-down"></i> Or See Other Lessons &amp;<br class="inline md:hidden"> Solutions For Guitarists <i class="fas fa-arrow-circle-down"></i></strong></p>
        </div>
    </section>
    <div id="pageContent" class="anchor"></div>
    <section class="tile-container text-center px-2 lg:px-4 pt-5 md:pt-7 lg:pt-12">
        <div class="container mx-auto tw-clearfix">
            <div class="flex flex-wrap items-center">
                <div class="px-2 md:px-3 pb-4 md:pb-6 w-full tile-wrap">
                    <a href="/song-in-an-hour" class="px-3 md:px-4 w-full gq-bundle block" style="background-image:url(https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/header.jpg);">
                        <div class="text-wrap text-center">
                            <img class="logo" src="https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/logo-purple.png">
                            <h1 class="my-4 leading-none font-bison-bold uppercase"><strong>Play Your First Song,  <br> Start To Finish!</strong></h1>

                            <div class="join purple smaller">Click Here &raquo;</div>
                        </div>
                    </a>
                </div>
                <div class="px-2 md:px-3 pb-4 md:pb-6 w-full md:w-1/2 tile-wrap">
                    <a href="/guitar-system/" class="float-left px-3 md:px-4 w-full practice-pad block tw-clearfix" style="background:linear-gradient(to right, transparent 40%, #000), url(https://cdn.musora.com/image/fetch/w_1250,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/sales/storefront/guitar-system-image.jpg) center top/cover;">
                        <div class="float-right px-3 md:px-4 w-full lg:w-3/5">
                            <img class="mt-28 lg:mt-0" src="https://guitareo.s3.amazonaws.com/sales/promos/june/guitar-system-logo.png">
                            <p class="my-3 md:my-3 lg:my-4 leading-normal"><em>The ultimate encyclopedia<br> of guitar lessons.</em></p>
                            <span class="join outline white smaller">Click Here &raquo;</span>
                        </div>
                    </a>
                </div>
                <div class="px-2 md:px-3 pb-4 md:pb-6 w-full md:w-1/2 tile-wrap">
                    <a href="/acoustic-guitar-made-easy/" class="float-left px-3 md:px-4 w-full practice-pad block tw-clearfix" style="background:linear-gradient(to right, transparent 40%, #000), url(https://cdn.musora.com/image/fetch/w_1250,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/sales/storefront/acoustic-guitar-made-easy-image.jpg) center top/cover;">
                        <div class="float-right px-3 md:px-4 w-full lg:w-3/5">
                            <img class="mt-28 lg:mt-0" src="https://guitareo.s3.amazonaws.com/shop/logos/acoustic-guitar-made-easy.png">
                            <p class="my-3 md:my-3 lg:my-4 leading-normal"><em>Learn the five pillars of<br> playing acoustic guitar.</em></p>
                            <span class="join outline white smaller">Click Here &raquo;</span>
                        </div>
                    </a>
                </div>
                <div class="px-2 md:px-3 pb-4 md:pb-6 w-full md:w-1/2 tile-wrap">
                    <a href="/guitar-technique-made-easy/" class="float-left px-3 md:px-4 w-full practice-pad block tw-clearfix" style="background:linear-gradient(to right, transparent 40%, #000), url(https://cdn.musora.com/image/fetch/w_1250,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/sales/storefront/guitar-technique-made-easy-image.jpg) center top/cover;">
                        <div class="float-right px-3 md:px-4 w-full lg:w-3/5">
                            <img class="mt-28 lg:mt-0" src="https://guitareo.s3.amazonaws.com/shop/logos/guitar-technique-made-easy.png">
                            <p class="my-3 md:my-3 lg:my-4 leading-normal"><em>Improve your technique & achieve total freedom on the guitar.</em></p>
                            <span class="join outline white smaller">Click Here &raquo;</span>
                        </div>
                    </a>
                </div>
                <div class="px-2 md:px-3 pb-4 md:pb-6 w-full md:w-1/2 tile-wrap">
                    <a href="/500-songs/" class="float-left px-3 md:px-4 w-full practice-pad block tw-clearfix" style="background:linear-gradient(to right, transparent 40%, #000), url(https://cdn.musora.com/image/fetch/w_1250,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/500-songs/customize.jpg) center top/cover;">
                        <div class="float-right px-3 md:px-4 w-full lg:w-3/5">
                            <img class="mt-28 lg:mt-0" src="https://guitareo.s3.amazonaws.com/500-songs/logo.svg">
                            <p class="my-3 md:my-3 lg:my-4 leading-normal"><em>The fastest way to play<br>  your favorite songs.</em></p>
                            <span class="join outline white smaller">Click Here &raquo;</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="beat-posts">
        <div class="container mx-auto">
            <div class="beat-logo px-3 md:px-4 w-full text-center">
                <a href="/riff/"><img style="filter:saturate(0) invert(1) brightness(0)" src="https://guitareo.s3.amazonaws.com/blog/the-riff-logo.png"></a>
                <h5 class="mt-4 md:mt-5 mb-4 md:mb-10">Free Videos, Articles,<br class="inline md:hidden"> and Resources For Guitarists.</h5>
            </div>

            <div class="post-grid px-3 md:px-4 w-full no-padding flex flex-wrap">
                <div class="post-tile px-3 md:px-4 w-full md:w-1/2 lg:w-1/3 Lessons">
                    <a href="/riff/left-hand-challenge/">
                        <div class="image-fill">
                            <div class="thumbnail-pic" style="background-image:url(&quot;https://img.youtube.com/vi/T_dajySe03Q/maxresdefault.jpg&quot;)"></div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </div>
                        <p><span class="grey">
                Ayla Tesler-Mabe &nbsp;/&nbsp;
                Lessons            </span>
                            <br><strong>Left-Handed Guitar Challenge</strong><br>
                            <span class="excerpt">To simulate what it’s like to be a beginner guitarist, Ayla Tesler-Mabe plays her guitar left-handed and goes through Rob Scallon’s Song In An Hour Challenge.</span>
                        </p>
                    </a>
                </div>
                <div class="post-tile px-3 md:px-4 w-full md:w-1/2 lg:w-1/3 Lessons">
                    <a href="/riff/unlocking-the-pentatonic-scale/">
                        <div class="image-fill">
                            <div class="thumbnail-pic" style="background-image:url(&quot;https://img.youtube.com/vi/4fbWTwZ1850/maxresdefault.jpg&quot;)"></div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </div>
                        <p><span class="grey">
                Ayla Tesler-Mabe &nbsp;/&nbsp;
                Lessons            </span>
                            <br><strong>Unlocking the Pentatonic Scale</strong><br>
                            <span class="excerpt">A new approach to the pentatonic scale to help understand the guitar better.</span>
                        </p>
                    </a>
                </div>
                <div class="post-tile px-3 md:px-4 w-full md:w-1/2 lg:w-1/3 Lessons">
                    <a href="/riff/4-beginner-guitarist-tips/">
                        <div class="image-fill">
                            <div class="thumbnail-pic" style="background-image:url(&quot;https://img.youtube.com/vi/qqrYZlW4Hjg/maxresdefault.jpg&quot;)"></div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </div>
                        <p><span class="grey">
                Ayla Tesler-Mabe &nbsp;/&nbsp;
                Lessons            </span>
                            <br><strong>4 Things Beginner Guitarists Should Know</strong><br>
                            <span class="excerpt">Ayla Tesler-Mabe shares four things she wished she knew as a beginner guitarist.</span>
                        </p>
                    </a>
                </div>
                <div class="post-tile px-3 md:px-4 w-full md:w-1/2 lg:w-1/3 Videos">
                    <a href="/riff/midwest-chords/">
                        <div class="image-fill">
                            <div class="thumbnail-pic" style="background-image:url(&quot;https://img.youtube.com/vi/Bk4H06AEHIo/maxresdefault.jpg&quot;)"></div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </div>
                        <p><span class="grey">
                Rob Scallon &nbsp;/&nbsp;
                Videos            </span>
                            <br><strong>The Moveable Midwest Chord Shape</strong><br>
                            <span class="excerpt">In this lesson, Rob goes into details of the moveable midwest chord shape, the notes within them, and the variations he likes to make to the shape to create beautiful music.</span>
                        </p>
                    </a>
                </div>
                <div class="post-tile px-3 md:px-4 w-full md:w-1/2 lg:w-1/3 Videos">
                    <a href="/riff/slap-guitar-101/">
                        <div class="image-fill">
                            <div class="thumbnail-pic" style="background-image:url(&quot;https://img.youtube.com/vi/wC9QTHv2eQ4/maxresdefault.jpg&quot;)"></div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </div>
                        <p><span class="grey">
                Rob Scallon &nbsp;/&nbsp;
                Videos            </span>
                            <br><strong>Slap Guitar 101</strong><br>
                            <span class="excerpt">Rob Scallon shares everything he knows about slap guitar.</span>
                        </p>
                    </a>
                </div>
                <div class="post-tile px-3 md:px-4 w-full md:w-1/2 lg:w-1/3 Articles">
                    <a href="/riff/a-beginner-guitarists-guide-to-rock/">
                        <div class="image-fill">
                            <div class="thumbnail-pic" style="background-image:url(&quot;https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2021/04/26092750/63A9E0A5-0DD3-4C37-A950-B828A571A8B2_4_5005_c.jpeg&quot;)"></div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </div>
                        <p><span class="grey">
                Guitareo &nbsp;/&nbsp;
                Articles            </span>
                            <br><strong>A Beginner Guitarist’s Guide To Rock</strong><br>
                            <span class="excerpt">A Brief History, Techniques, Equipment, The Greats, and a Listening List.</span>
                        </p>
                    </a>
                </div>
                {{--@foreach($blogPosts as $blogPost)--}}
                    {{--<div class="post-tile px-3 md:px-4 w-full md:w-1/2 lg:w-1/3 {{ str_replace(' ', '', $blogPost['category']) }}">--}}
                        {{--<a href="{{ $blogPost['link'] }}">--}}
                            {{--<div class="image-fill">--}}
                                {{--<div class="thumbnail-pic" style='background-image:url("{{ $blogPost['thumbnail_url'] }}")'></div>--}}
                                {{--<i class="fas fa-arrow-circle-right"></i>--}}
                            {{--</div>--}}
                            {{--<p><span class="grey">{{ $blogPost['artist'] }} &nbsp;/&nbsp;{{ $blogPost['category'] }}</span>--}}
                                {{--<br><strong>{!! $blogPost['title'] !!}</strong>--}}
                            {{--</p>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            </div>
            <div class="px-3 md:px-4 w-full text-center">
                <a href="/riff/" class="join outline">Browse Free Content &raquo;</a>
            </div>
        </div>
    </section>

    <div class="lead-gen-banner">
        <div class="container mx-auto tw-clearfix">
            <div class="text-wrap md:w-9/12 lg:w-8/12 float-right w-full">
                <img class="logo" src="https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/logo-purple.png">
                <h2><em>play your first song on the guitar, start to finish, in an hour.<br class="show-for-medium">
                        Enter your email address below to get started!</em></h2>
                <form id="GuitareoEngagementTriggerSongHourWebForm" accept-charset="UTF-8" action="/customer-io/submit-email-form" class="tw-clearfix infusion-form facebook-track-lead" method="POST">
                    <input type="hidden" name="form_name" value="Song Hour">
                    <div class="w-full float-left px-2 md:w-7/12 lg:w-8/12">
                        <input class="infusion-field-input-container" name="email" type="email" placeholder="Email Address..." required="">
                    </div>
                    <div class="infusion-submit float-left w-full px-2 md:w-5/12 lg:w-4/12">
                        <input class="submit infusion-recaptcha join outline" type="submit" value=" Get Started » ">
                    </div>
                    <input name="inf_form_xid" type="hidden" value="GuitareoEngagementTriggerSongHourWebForm">
                    <input name="tag_names_to_add[]" type="hidden" value="Guitareo - Engagement - Trigger - Song Hour - Web Form">
                    <input name="list_ids_to_subscribe_to[]" type="hidden" value="32">
                    <input name="success_redirect" type="hidden" value="/song-in-an-hour/thank-you">
                </form>
                <div class="disclaimer">
                    <i class="fal fa-info-circle"></i>
                    <p> By signing up you’ll also receive our ongoing free lessons and special offers.
                        Don’t worry, we value your privacy and you can unsubscribe at any time.</p>
                </div>
            </div>
        </div>
    </div>

    @include("guitareo.sales.partials._footer")
@endsection

@section('scripts')

    <script src="/marketing/parcel/guitareo/nav-footer.js"></script>
    <script>
        $('document').ready(function() {

            $(".infusion-form").submit(function(event) {
                if(event.originalEvent != null) {
                    var formId = $(this).find('input[name="inf_form_xid"]').val();

                    dataLayer.push({
                        'event': 'gtm.formSubmit',
                        'formId': formId,
                        'formSuccess': true
                    });
                }
            });
        });
    </script>
    <script src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Countdown
            $('.tzcd-full').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-big').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });
        });
    </script>
@endsection
