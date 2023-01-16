@extends('pianote._partials.global-layout')

@section('global-head')
    <title>500 Songs In 5 Days | Pianote</title>
    <meta name="description" content="Develop The Skills To Play 500+ Songs On The Piano In 5 Days">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/header.jpg" style="display: none;">
    <meta property="og:title" content="500 Songs In 5 Days">
    <meta property="og:description" content="Develop The Skills To Play 500+ Songs On The Piano In 5 Days">
    <meta property="og:url" content="https://www.pianote.com/500-songs">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <style>
        h1, h2, h3, h4, h5, h6 {
            font-family:"Open Sans", sans-serif;
            font-weight:700;
            margin-bottom:20px;
        }

        body {
            background:#DFDFDF;
        }

        .join {
            display:inline-block;
            font:700 20px / 1em "Roboto Condensed", sans-serif;
            text-transform:uppercase;
            background:#F61A30;
            border-radius:50px;
            color:#FFF;
            padding:17px 7%;
            cursor:pointer;
        }

        @media (min-width:40em) {
            .join {
                font-size:28px;
            }
        }

        .join.sold-out {
            background:#777;
        }

        .join:hover,
        .join:active,
        .join:focus {
            color:#FFF;
            background:#ff525a;
            text-decoration:none;
        }


        .container {
            padding:0;
        }


        .white-box {
            position:relative;
            background:#FFF;
            padding:25px 10px;
        }

        @media (min-width:40em) {
            .white-box {
                padding:40px 20px;
                margin:30px auto 60px;
                border-radius:5px;
                border:1px solid #BBB;
            }
        }

        @media (min-width:64em) {
            .white-box {
                padding:50px 30px;
            }
        }

        @media (min-width:64em) {
            .white-box .post-wrap {
                padding:0 40px;
            }
        }

        .white-box .post-wrap h1,
        .white-box .post-wrap h2,
        .white-box .post-wrap h3,
        .white-box .post-wrap h4,
        .white-box .post-wrap p {
            width:100%;
            max-width:800px;
            margin-left:auto;
            margin-right:auto;
        }

        .white-box .post-wrap img {
            border-radius:7px;
            width:100%;
            max-width:700px;
            margin:10px auto;
        }

        .level-breakdown-wrap {
            margin:5px auto 15px;
        }

        .level-breakdown-wrap .question-dropdown {
            border-radius:5px;
            border:1px solid #ccc;
            background:#fff;
            color:#000;
            margin:10px auto 0;
            height:auto;
            max-height:62px;
            overflow:hidden;
            cursor:pointer;
            transition:all .3s ease-in-out;
            -webkit-transform:translateZ(0);
            transform:translateZ(0)
        }

        .level-breakdown-wrap .question-dropdown.active {
            max-height:1500px
        }

        .level-breakdown-wrap .question-dropdown div {
            padding:0 7px
        }

        @media (min-width:768px) {
            .level-breakdown-wrap .question-dropdown div {
                padding:0 15px
            }
        }

        .level-breakdown-wrap .question-dropdown div {
            padding:0
        }

        .level-breakdown-wrap .question-dropdown .drop-down-wrap {
            position:relative
        }

        .level-breakdown-wrap .question-dropdown .drop-down-wrap p {
            font:400 13px/1.6em Open Sans, sans-serif;
            margin:0 auto 15px
        }

        @media (min-width:768px) {
            .level-breakdown-wrap .question-dropdown .drop-down-wrap p {
                font-size:14px
            }
        }

        @media (min-width:991px) {
            .level-breakdown-wrap .question-dropdown .drop-down-wrap p {
                font-size:15px
            }
        }

        .level-breakdown-wrap .question-dropdown .drop-down-wrap p.details {
            font:italic 400 14px/1.2em Open Sans, sans-serif;
            position:absolute;
            color:#8c9698;
            top:50%;
            right:0;
            -webkit-transform:translateY(-50%);
            transform:translateY(-50%);
            margin:0 auto
        }

        .level-breakdown-wrap .question-dropdown .drop-down-wrap .week-number {
            background:#F61A30;
            color:#fff;
            text-transform:uppercase;
            font:400 13px/60px Open Sans, sans-serif;
            height:100%;
            position:absolute;
        }

        .level-breakdown-wrap .question-dropdown .drop-down-wrap .week-number .number {
            font-size:25px;
        }

        .level-breakdown-wrap .question-dropdown .drop-down-wrap .question {
            height:60px;
            width:100%;
            position:relative
        }

        .level-breakdown-wrap .question-dropdown .drop-down-wrap .question h2 {
            font:700 14px/1.2em Open Sans, sans-serif;
            position:absolute;
            top:50%;
            left:0;
            -webkit-transform:translateY(-50%);
            transform:translateY(-50%);
            user-select:none;
            margin:0 auto
        }

        @media (min-width:768px) {
            .level-breakdown-wrap .question-dropdown .drop-down-wrap .question h2 {
                font-size:15px
            }
        }

        @media (min-width:991px) {
            .level-breakdown-wrap .question-dropdown .drop-down-wrap .question h2 {
                font-size:18px
            }
        }

        .level-breakdown-wrap .question-dropdown .fa-chevron-down {
            line-height:60px;
            transition:all .3s ease-in-out;
            font-size:14px
        }

        @media (min-width:768px) {
            .level-breakdown-wrap .question-dropdown .fa-chevron-down {
                font-size:30px
            }
        }

        .level-breakdown-wrap .question-dropdown .fa-chevron-down.rotated {
            transform:rotate(-180deg)
        }
    </style>
@stop

@section('global-body')
    @include('pianote._partials._nav')

        <div class="container mx-auto clearfix">
            <div class="white-box text-center">
                <div class="post-wrap">
            <h1>WELCOME TO YOUR FREE <br>500 SONGS IN 5 DAYS LESSON!</h1>
            <p>Get started playing songs right from the first lesson. You’ll learn how to form chords, and start playing the most popular chord progression in the world!

                PLUS you’ll get downloadable chord charts for 3 songs that you can print and start playing. Just click the DOWNLOAD button to get your songs. And have fun!</p>
                    <br>

                    <div class="aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/345751946" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                    </div>

                    <div class="float-left w-full px-2 md:px-3 level-breakdown-wrap">
                        <div class="float-left w-full question-dropdown text-left">
                            <div class="float-left w-11/12 drop-down-wrap">
                                <div class="float-left w-2/12 md:w-1/12 no-padding text-center week-number">
                                    <span class="hidden sm:inline"></span> <strong class="number">1</strong>
                                </div>
                                <div class="w-10/12 px-2 md:px-3  md:w-11/12 float-right">
                                    <div class="question">
                                        <h2>‘Let It Be’ by the Beatles</h2>
                                    </div>
                                    <p><img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/chord-chart-3-song-page-1.jpg"> <br>
                                        <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/chord-chart-3-song-page-2.jpg"></p>
                                </div>
                            </div>
                            <div class="float-left w-1/12 px-2 md:px-3 text-right">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="float-left w-full question-dropdown text-left">
                            <div class="float-left w-11/12 drop-down-wrap">
                                <div class="float-left w-2/12 md:w-1/12 no-padding text-center week-number">
                                    <span class="hidden sm:inline"></span> <strong class="number">2</strong>
                                </div>
                                <div class="w-10/12 px-2 md:px-3  md:w-11/12 float-right">
                                    <div class="question">
                                        <h2>‘When I’m Gone (Cups)’ by Anna Kendrick </h2>
                                    </div>
                                    <p><img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/chord-chart-3-song-page-3.jpg"> <br>
                                        <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/chord-chart-3-song-page-4.jpg"></p>
                                </div>
                            </div>
                            <div class="float-left w-1/12 px-2 md:px-3 text-right">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="float-left w-full question-dropdown text-left">
                            <div class="float-left w-11/12 drop-down-wrap">
                                <div class="float-left w-2/12 md:w-1/12 no-padding text-center week-number">
                                    <span class="hidden sm:inline"></span> <strong class="number">3</strong>
                                </div>
                                <div class="w-10/12 px-2 md:px-3  md:w-11/12 float-right">
                                    <div class="question">
                                        <h2>‘The Rose’ by Bette Middler</h2>
                                    </div>
                                    <p><img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/chord-chart-3-song-page-5.jpg"> <br>
                                        <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/chord-chart-3-song-page-6.jpg"></p>
                                </div>
                            </div>
                            <div class="float-left w-1/12 px-2 md:px-3 text-right">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>

                    </div>

                    <br><br>
            <a href="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/chord-chart-3-song.pdf">Click here</a> to download ‘Let It Be’ by the Beatles, ‘When I’m Gone (Cups)’ by Anna Kendrick & ‘The Rose’ by Bette Middler
                    <br><br>
                    <a href="/500-songs-fb" class="join">Get All The Other Songs &raquo;</a>
        </div>
    </div>
        </div>

    @include("pianote._partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(document).ready(function () {
            // 10 levels dropdowns
            $('.question-dropdown').on('click', questionDropdown);
            function questionDropdown() {
                $(this).toggleClass('active');
                $(this).find('.fa-chevron-down').toggleClass('rotated');
            }
        });
    </script>

    @yield('scripts')


@stop
