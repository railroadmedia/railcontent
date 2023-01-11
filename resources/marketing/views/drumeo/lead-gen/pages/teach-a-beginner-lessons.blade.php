@extends('drumeo._partials.global-layout')

@section('global-head')

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>How To Teach A Beginner Drummer - Lessons</title>
    <meta name="description"
          content="In this free video course, you’ll get the detailed video training you need to help you make a powerful impact on your beginner drumming students!">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/sales/2023/share-image-drumeo.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/teach-a-beginner/">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    @include('_partials.layout._fonts')

    <style>
        body {
            background: #fff;
        }

        .hiw-header {
            background: #EEEEEE;
        }

        .title p {
            color: #1B1B1B;
            margin: 0 auto 5px;
            text-align: center;
        }

        .title .sub {
            color: #666;
            margin: 0;
            text-align: center;
        }

        .hiw-item-container {
            text-align: center;
            padding: 0 10px;
        }

        .hiw-item-container a {
            display: block;
        }

        .hiw-item-container .title {
            font: 400 18px/1em "Open Sans", sans-serif;
            margin: 10px auto 5px;
            text-align: center;
            color: #2C2C2C;
        }

        @media only screen {
            .hiw-header {
                padding: 15px 0;
            }

            .title p {
                font: 700 30px/1.2em "Open Sans", sans-serif;
            }

            .title .sub {
                font: 300 16px/1em "Open Sans", sans-serif;
            }

            .hiw-item-container {
                margin: 15px auto 5px;
                min-width: none;
            }
        }

        @media only screen and (min-width: 40.063em) {
            .hiw-header {
                padding: 15px 0 30px;
            }

            .title p {
                font: 700 45px/1.3em "Open Sans", sans-serif;
            }

            .title .sub {
                font: 300 21px/1.2em "Open Sans", sans-serif;
            }

            .hiw-lesson-grid {
                margin: 10px auto 5px;
            }

            .hiw-item-container {
                margin: 10px auto 0;
                min-height: 170px;
            }
        }

        @media only screen and (min-width: 64.063em) {
            .hiw-header {
                padding: 30px 0;
            }

            .title p {
                font: 700 50px/1.3em "Open Sans", sans-serif;
            }

            .title .sub {
                font: 300 26px/1.4em "Open Sans", sans-serif;
            }

            .hiw-lesson-grid {
                margin: 20px auto;
            }

            .hiw-item-container {
                margin: 20px auto 0;
            }
        }
    </style>

@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <div class="hiw-header">
        <div class="row">
            <div class="large-12 columns title">
                <p>How To Teach A Beginner Drummer</p>
                <p class="sub">In this free video course, you’ll get the detailed video training you need to
                    <br class="show-for-large-up"> help you make a powerful impact on your beginner drumming
                    students!</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="hiw-lesson-grid large-12 columns">
            <div class="large-4 medium-6 small-12 columns hiw-item-container">
                <a href="/teach-a-beginner/1-introduction-to-the-drum-kit-and-stick-grips/" class="hiw-item"
                   title="">
                    <p class="title">Intro to the Drum Kit & Stick Grips</p>
                </a>
            </div>
            <div class="large-4 medium-6 small-12 columns hiw-item-container">
                <a href="/teach-a-beginner/2-quarter-note-beats-and-fills/" class="hiw-item" title="">
                    <p class="title">Quarter Note Beats & Fills</p>
                </a>
            </div>
            <div class="large-4 medium-6 small-12 columns hiw-item-container">
                <a href="/teach-a-beginner/3-the-four-basic-rudiments/" class="hiw-item" title="">
                    <p class="title">The Four Basic Rudiments</p>
                </a>
            </div>
            <div class="large-4 medium-6 small-12 columns hiw-item-container">
                <a href="/teach-a-beginner/4-eighth-notes-and-16th-notes/" class="hiw-item" title="">
                    <p class="title">Eighth Notes & 16th Notes</p>
                </a>
            </div>
            <div class="large-4 medium-6 small-12 columns hiw-item-container">
                <a href="/teach-a-beginner/5-triplets-shuffles-and-review/" class="hiw-item" title="">
                    <p class="title">Triplets, Shuffles, & Review</p>
                </a>
            </div>
            <div class="large-4 medium-6 small-12 columns hiw-item-container">
                <a href="/teach-a-beginner/6-5-tips-to-attract-more-students/" class="hiw-item" title="">
                    <p class="title">5 Tips To Attract More Students</p>
                </a>
            </div>
        </div>
    </div>


    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).foundation();
    </script>

    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
