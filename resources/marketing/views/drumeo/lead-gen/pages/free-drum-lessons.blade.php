@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/pages/free-drum-lesson-data.php'))
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')

    <title>Free Drum Lessons</title>
    <meta name="description" content="Whether you want to learn your favorite tunes, find out how to play different drum fills and rudiments or improve your technique, make sure you bookmark this page!">
    <meta property="og:image" content="https://drumeoblog.s3.amazonaws.com/beat/wp-content/uploads/2020/10/02125549/150-free-lesson-videos.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/free-drum-lessons/">
    <meta property="og:title" content="Free Drum Lessons">
    <meta property="og:description" content="Whether you want to learn your favorite tunes, find out how to play different drum fills and rudiments or improve your technique, make sure you bookmark this page!">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/blog.css')}}" />

    @include('_partials.layout._fonts')
    <style>
        header {
            background:#061221 url(https://dpwjbsxqtam5n.cloudfront.net/beat/free-lessons-header.jpg) center center/cover;
            color:#fff;
            text-align:center;
            padding:30px 10px;
        }

        header h1 {
            font-weight:800;
        }

        @media (min-width:40em) {
            header {
                padding:40px 0;
            }
            .toc-wrap {
                display:flex;
                align-items:flex-start;
            }
        }

        #toc_container {
            background:#f3f3f3;
            border-radius:10px;
            padding:20px;
            margin:0 auto 25px;
        }

        @media (min-width:40em) {
            #toc_container {
                padding:30px;
                margin:0 0 25px 15px;
                min-width:310px;
            }
        }

        @media (min-width:64em) {
            #toc_container {
                margin:0 0 25px 25px;
                min-width:400px;
            }
        }

        .anchor {
            float:left;
            width:100%;
            display:block;
            position:relative;
            top:-104px;
            visibility:hidden;
        }

        @media (min-width:40em) {
            .anchor {
                top:-118px;
            }
        }

        @media (min-width:64em) {
            .anchor {
                top:-117px;
            }
        }
        hr {
            margin:40px auto 60px;
        }
        .subnav-shim {
            height:54px;
        }
        .subnav {
            margin-top:-54px;
            opacity:0;
            width: 100%;
            background: #f3f3f3;
            padding: 3px 0;
            text-align: center;
            z-index: 2;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            font: 700 12px/1em "Roboto Condensed", sans-serif;
        }
        .subnav.stick-to-top {
            position: fixed;
            opacity:1;
            margin:0 auto;
            top: 40px;
            left: 0;
        }
        .subnav a {
            color: #444;
            text-transform: uppercase;
            padding: 6px 3px;
            text-align: center;
            display: inline-block;
        }
        .subnav a.active {
            color:#000;
            text-decoration:underline;
        }
        @media (min-width:40em) {
            .subnav-shim {
                height:58px;
            }
            .subnav {
                padding: 7px 0;
            }
            .subnav.stick-to-top {
                top: 56px;
            }
            .subnav a {
                padding: 5px 31px;
            }
        }
        @media (min-width:64em) {
            .subnav-shim {
                height:42px;
            }
            .subnav {
                padding: 10px 0;
            }
            .subnav a {
                padding: 5px 21px;
            }
        }
        .content-grid .white-box .post-grid .post-tile .image-fill {
            padding-bottom: 56.25%;
        }
        .content-grid .white-box .post-grid .post-tile .image-fill .thumbnail-pic {
            transform: scale(1.001);
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

<header>
    <div class="row">
        <h1>Free Drum Lessons</h1>
        <h5>Drum videos. Everywhere. Pro ones. DIY ones. Where do you start? How do you<br class="show-for-medium"> compare info from one to the next? How do you know the content is good?</h5>
    </div>
</header>

    <div class="content-grid homepage">
        <div class="row">
            <div class="white-box columns">
                <div class="toc-wrap">
                    <p>If you’re on the hunt for free drum lessons, congrats: you’ve come to the right place. If you scroll down, you’ll find dozens of drum videos for beginner and experienced drummers, created by industry pros and organized by category.
                        <br><br> Whether you want to learn your favorite tunes, find out how to play different drum fills and rudiments or improve your technique, make sure you bookmark this page!
                        <br><br> (P.S. If you’re a new drummer, you should also check out this <a
                                href="https://www.drumeo.com/beat/how-to-play-drums/">complete guide for beginners</a> - it includes photos, videos, gear basics, and diagrams, too.)</p>

                    <div id="toc_container">
                        <h5><strong>Table of Contents</strong></h5>
                        <ul class="toc_list">
                            <li><a class="anchor-slide" href="#fills">Free drum fill lessons</a></li>
                            <li><a class="anchor-slide" href="#bass">Free bass drum lessons</a></li>
                            <li><a class="anchor-slide" href="#technique">How to improve your drum technique</a></li>
                            <li><a class="anchor-slide" href="#rudiments">Drum rudiments free lessons</a></li>
                            <li><a class="anchor-slide" href="#warmUp">How to warm up on the drums</a></li>
                            <li><a class="anchor-slide" href="#drummers">Free lessons from your favorite drummers</a></li>
                            <li><a class="anchor-slide" href="#songs">Learn to play your favorite beats and fills</a></li>
                            <li><a class="anchor-slide" href="#tricks">How to do stick tricks</a></li>
                            <li><a class="anchor-slide" href="#rock">Free rock drumming lessons</a></li>
                            <li><a class="anchor-slide" href="#jazz">Free jazz drumming lessons</a></li>
                        </ul>
                    </div>
                </div>
                <div class="columns subnav-shim"></div>
                <div class="subnav">
                    <a class="anchor-slide fills" href="#fills">fills</a>
                    <a class="anchor-slide bass" href="#bass">bass drum</a>
                    <a class="anchor-slide technique" href="#technique">technique</a>
                    <a class="anchor-slide rudiments" href="#rudiments">rudiments</a>
                    <a class="anchor-slide warmUp" href="#warmUp">warm ups</a>
                    <a class="anchor-slide songs" href="#songs">popular beats<span class="show-for-medium"> &amp; fills</span></a>
                    <a class="anchor-slide tricks" href="#tricks">tricks</a>
                    <a class="anchor-slide rock" href="#rock">rock</a>
                    <a class="anchor-slide jazz" href="#jazz">jazz</a>
                    <a class="anchor-slide drummers" href="#drummers">famous drummers</a>
                </div>
                <hr class="columns no-padding">
                <div id="fills" class="anchor"></div>
                <h3><strong>Free Drum Fill Lessons</strong></h3>
                <p>Drum fills (or ‘fill-ins’) are used to transition from one section in a song to another. Are you bored of playing the same ones over and over again, want to take your fills to the next level, or have never played a fill before? Check out all the great ideas here:</p>
                <br>
                <div class="post-grid columns no-padding large-up-3 medium-up-2">
                    @foreach($drumFillLessons as $drumFillLesson)
                        <div class="post-tile columns">
                            <a href="{{ $drumFillLesson['url'] }}">
                                <div class="image-fill">
                                    <div class="thumbnail-pic" style="background-image:url(https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $drumFillLesson['thumb'] }})"></div>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </div>
                                <p>
                                    <span class="grey hide">{{ $drumFillLesson['artist'] }}</span>
                                    <br class="hide"><strong>{!! $drumFillLesson['title'] !!}</strong>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr class="columns no-padding">
                <div id="bass" class="anchor"></div>
                <h3><strong>Free Bass Drum Lessons</strong></h3>
                <p>The bass drum is the anchor of most beats and fills on the drum set, and getting your bass drum foot (or feet) up to snuff can be a challenge. Are your lower limbs not doing what you want them to do? Do they have a mind of their own? Do you want to play faster? Here are some practical lessons to improve your single and double bass technique:</p>
                <br>
                <div class="post-grid columns no-padding large-up-3 medium-up-2">
                    @foreach($bassDrumLessons as $bassDrumLesson)
                        <div class="post-tile columns">
                            <a href="{{ $bassDrumLesson['url'] }}">
                                <div class="image-fill">
                                    <div class="thumbnail-pic" style="background-image:url(https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $bassDrumLesson['thumb'] }})"></div>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </div>
                                <p>
                                    <span class="grey hide">{{ $bassDrumLesson['artist'] }}</span>
                                    <br class="hide"><strong>{!! $bassDrumLesson['title'] !!}</strong>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr class="columns no-padding">
                <div id="technique" class="anchor"></div>
                <h3><strong>How To Improve Your Drum Technique</strong></h3>
                <p>Bad technique can negatively affect your sound, and in the worst case scenario, cause injury. If you’re feeling rigid on the drums or your hands just don’t want to do what you tell them, it might help to get a close-up view and specific instructions and exercises that work for pro drummers around the world. Play more relaxed, get tighter, play faster, and sound better and smoother on the drums:</p>

                <br>
                <div class="post-grid columns no-padding large-up-3 medium-up-2">
                    @foreach($drumTechniqueLessons as $drumTechniqueLesson)
                        <div class="post-tile columns">
                            <a href="{{ $drumTechniqueLesson['url'] }}">
                                <div class="image-fill">
                                    <div class="thumbnail-pic" style="background-image:url(https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $drumTechniqueLesson['thumb'] }})"></div>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </div>
                                <p>
                                    <span class="grey hide">{{ $drumTechniqueLesson['artist'] }}</span>
                                    <br class="hide"><strong>{!! $drumTechniqueLesson['title'] !!}</strong>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr class="columns no-padding">
                <div id="rudiments" class="anchor"></div>
                <h3><strong>Drum Rudiments Free Lessons</strong></h3>
                <p>Rudiments are sticking patterns that give drummers a foundation for beats, rolls, fills, and more. Most players start learning rudiments on a snare drum or practice pad before applying them to a drum set. The most common ones are single stroke rolls, double stroke rolls, and single paradiddles, but many drummers also use flams, drags, and other techniques in their daily playing. Here are the 40 standard rudiments, starting with a few of the most important (you can also find them organized by rudiment type <a href="/beat/rudiments/"><u>on this page</u></a>):</p>
                <div class="post-list with-rudiment columns no-padding">
                    @foreach($rudimentLessons as $rudimentLesson)
                        <a href="{{ $rudimentLesson['url'] }}" class="post-tile">
                            <div class="image-fill" style='background-image:url({{ $rudimentLesson['thumb'] }})'></div>
                            <p class="text-wrap"><strong>{!! $rudimentLesson['title'] !!}</strong></p>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @endforeach
                </div>
                <div class="post-grid columns no-padding large-up-3 medium-up-2">
                    @foreach($extraLessons as $extraLesson)
                        <div class="post-tile columns">
                            <a href="{{ $extraLesson['url'] }}">
                                <div class="image-fill">
                                    <div class="thumbnail-pic" style="background-image:url(https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $extraLesson['thumb'] }})"></div>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </div>
                                <p>
                                    <span class="grey hide">{{ $extraLesson['artist'] }}</span>
                                    <br class="hide"><strong>{!! $extraLesson['title'] !!}</strong>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr class="columns no-padding">
                <div id="warmUp" class="anchor"></div>
                <h3><strong>How To Warm Up On The Drums</strong></h3>
                <p>It doesn’t matter how long you’ve been playing drums - warming up is always important. If you’re about to start an intense practice session or a gig, here are some exercises to get the blood flowing and help you avoid injury:</p>
                <br>
                <div class="post-grid columns no-padding large-up-3 medium-up-2">
                    @foreach($warmupLessons as $warmupLesson)
                        <div class="post-tile columns">
                            <a href="{{ $warmupLesson['url'] }}">
                                <div class="image-fill">
                                    <div class="thumbnail-pic" style="background-image:url(https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $warmupLesson['thumb'] }})"></div>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </div>
                                <p>
                                    <span class="grey hide">{{ $warmupLesson['artist'] }}</span>
                                    <br class="hide"><strong>{!! $warmupLesson['title'] !!}</strong>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr class="columns no-padding">
                <div id="songs" class="anchor"></div>
                <h3><strong>Learn To Play Your Favorite Songs</strong></h3>
                <p>Sure - we all want to be better drummers. But playing songs is a big part of what makes the instrument so much fun. In these videos, you’ll learn how to play some of your favorite tracks, like “When The Levee Breaks”, “Superstition”, “Hot For Teacher”, “Smooth Criminal” and more:</p>
                <br>
                <div class="post-grid columns no-padding large-up-3 medium-up-2">
                    @foreach($songLessons as $songLesson)
                        <div class="post-tile columns">
                            <a href="{{ $songLesson['url'] }}">
                                <div class="image-fill">
                                    <div class="thumbnail-pic" style="background-image:url(https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $songLesson['thumb'] }})"></div>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </div>
                                <p>
                                    <span class="grey hide">{{ $songLesson['artist'] }}</span>
                                    <br class="hide"><strong>{!! $songLesson['title'] !!}</strong>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr class="columns no-padding">
                <div id="tricks" class="anchor"></div>
                <h3><strong>How To Do Stick Tricks</strong></h3>
                <p>“How did they do that?” Today’s the day you stop wondering about the secret to showmanship and start learning how to add flare to your own performance. Watch these videos from master performers like Glen Sobel, Chip Ritter, Gerry Brown and Marco Minnemann:</p>
                <br>
                <div class="post-grid columns no-padding large-up-3 medium-up-2">
                    @foreach($stickTrickLessons as $stickTrickLesson)
                        <div class="post-tile columns">
                            <a href="{{ $stickTrickLesson['url'] }}">
                                <div class="image-fill">
                                    <div class="thumbnail-pic" style="background-image:url(https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $stickTrickLesson['thumb'] }})"></div>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </div>
                                <p>
                                    <span class="grey hide">{{ $stickTrickLesson['artist'] }}</span>
                                    <br class="hide"><strong>{!! $stickTrickLesson['title'] !!}</strong>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr class="columns no-padding">
                <div id="rock" class="anchor"></div>
                <h3><strong>Free Rock Drumming Lessons</strong></h3>
                <p>Focusing on any genre means learning the elements that make it unique. Rock drumming is based on specific concepts, beats and fills, many of which developed over time or were made popular by the greats (<a href="/beat/a-drummers-guide-to-rock/"><u>check out this guide if you want to know more</u></a>). If you want to be a solid rock drummer, these videos cover everything from basic beats to lessons that both newbies and experienced players can learn from:</p>
                <br>
                <div class="post-grid columns no-padding large-up-3 medium-up-2">
                    @foreach($rockDrummingLessons as $rockDrummingLesson)
                        <div class="post-tile columns">
                            <a href="{{ $rockDrummingLesson['url'] }}">
                                <div class="image-fill">
                                    <div class="thumbnail-pic" style="background-image:url(https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $rockDrummingLesson['thumb'] }})"></div>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </div>
                                <p>
                                    <span class="grey hide">{{ $rockDrummingLesson['artist'] }}</span>
                                    <br class="hide"><strong>{!! $rockDrummingLesson['title'] !!}</strong>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr class="columns no-padding">
                <div id="jazz" class="anchor"></div>
                <h3><strong>Free Jazz Drumming Lessons</strong></h3>
                <p>Jazz is a unique genre because not only are there certain concepts, licks and techniques that make something ‘jazz’, but because there’s more of an emphasis on improvisation and freeform playing than other styles (<a href="/beat/a-drummers-guide-to-jazz/"><u>check out this guide if you want to know more</u></a>). Here are a few videos to help you build a foundation and learn how to solo and improvise, plus some cool licks you can borrow:</p>
                <br>
                <div class="post-grid columns no-padding large-up-3 medium-up-2">
                    @foreach($jazzDrummingLessons as $jazzDrummingLesson)
                        <div class="post-tile columns">
                            <a href="{{ $jazzDrummingLesson['url'] }}">
                                <div class="image-fill">
                                    <div class="thumbnail-pic" style="background-image:url(https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $jazzDrummingLesson['thumb'] }})"></div>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </div>
                                <p>
                                    <span class="grey hide">{{ $jazzDrummingLesson['artist'] }}</span>
                                    <br class="hide"><strong>{!! $jazzDrummingLesson['title'] !!}</strong>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr class="columns no-padding">
                <div id="drummers" class="anchor"></div>
                <h3><strong>Free Full Lessons From Your Favorite Drummers</strong></h3>
                <p>We like to emulate our heroes, right? Many of Drumeo’s lessons are taught by your favorite drummers, including Larnell Lewis, Gavin Harrison, David Garibaldi, Luke Holland, Anika Nilles, Tony Royster Jr. and Dennis Chambers. Here’s a whole slew of full lessons from the pros (don’t forget to take notes):</p>
                <br>
                <div class="post-grid columns no-padding large-up-3 medium-up-2">
                    @foreach($drummerLessons as $drummerLesson)
                        <div class="post-tile columns">
                            <a href="{{ $drummerLesson['url'] }}">
                                <div class="image-fill">
                                    <div class="thumbnail-pic" style="background-image:url(https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $drummerLesson['thumb'] }})"></div>
                                    <i class="fas fa-arrow-circle-right"></i>
                                </div>
                                <p>
                                    <span class="grey hide">{{ $drummerLesson['artist'] }}</span>
                                    <br class="hide"><strong>{!! $drummerLesson['title'] !!}</strong>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
                <p class="share-buttons"><strong>SHARE THIS: &nbsp;
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://www.drumeo.com/free-drum-lessons/" aria-label="facebook link"><i class="fab fa-facebook-f"></i></a>
                        &nbsp; <a target="_blank" href="https://twitter.com/intent/tweet?url=https://www.drumeo.com/free-drum-lessons/" aria-label="twitter link"><i class="fab fa-twitter"></i></a>
                        &nbsp; <a target="_blank" href="mailto:?body=https://www.drumeo.com/free-drum-lessons/" aria-label="email link"><i class="fas fa-envelope"></i></a></strong>
                </p>
            </div>
        </div>


    </div>


    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {

            //sub nav sticky function
            var navigation = $(".subnav");
            var navigationLinks = $(".subnav .anchor-slide");

            $(window).scroll(function () {
                var header = $(".subnav-shim").offset().top;
                var fills = $('#fills').offset().top - 50;
                var bass = $('#bass').offset().top - 150;
                var technique = $('#technique').offset().top - 150;
                var rudiments = $('#rudiments').offset().top - 150;
                var warmUp = $('#warmUp').offset().top - 150;
                var drummers = $('#drummers').offset().top - 150;
                var songs = $('#songs').offset().top - 150;
                var tricks = $('#tricks').offset().top - 150;
                var rock = $('#rock').offset().top - 150;
                var jazz = $('#jazz').offset().top - 150;

                if ($(this).scrollTop() > (header - 50)) {
                    navigation.addClass('stick-to-top');
                    navigationLinks.removeClass('active');
                    $(".subnav .features").addClass('active');
                } else {
                    navigationLinks.removeClass('active');
                    navigation.removeClass('stick-to-top');
                }

                if ($(this).scrollTop() > fills && $(this).scrollTop() < bass) {
                    navigationLinks.removeClass('active');
                    $(".subnav .fills").addClass('active');
                }

                if ($(this).scrollTop() > bass && $(this).scrollTop() < technique) {
                    navigationLinks.removeClass('active');
                    $(".subnav .bass").addClass('active');
                }

                if ($(this).scrollTop() > technique && $(this).scrollTop() < rudiments) {
                    navigationLinks.removeClass('active');
                    $(".subnav .technique").addClass('active');
                }

                if ($(this).scrollTop() > rudiments && $(this).scrollTop() < warmUp) {
                    navigationLinks.removeClass('active');
                    $(".subnav .rudiments").addClass('active');
                }

                if ($(this).scrollTop() > warmUp && $(this).scrollTop() < songs) {
                    navigationLinks.removeClass('active');
                    $(".subnav .warmUp").addClass('active');
                }

                if ($(this).scrollTop() > songs && $(this).scrollTop() < tricks) {
                    navigationLinks.removeClass('active');
                    $(".subnav .songs").addClass('active');
                }

                if ($(this).scrollTop() > tricks && $(this).scrollTop() < rock) {
                    navigationLinks.removeClass('active');
                    $(".subnav .tricks").addClass('active');
                }

                if ($(this).scrollTop() > rock && $(this).scrollTop() < jazz) {
                    navigationLinks.removeClass('active');
                    $(".subnav .rock").addClass('active');
                }

                if ($(this).scrollTop() > jazz && $(this).scrollTop() < drummers) {
                    navigationLinks.removeClass('active');
                    $(".subnav .jazz").addClass('active');
                }

                if ($(this).scrollTop() > drummers) {
                    navigationLinks.removeClass('active');
                    $(".subnav .drummers").addClass('active');
                }
            });

        });
    </script>

    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
