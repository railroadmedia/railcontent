@extends('drumeo.sales.standard-layout', [
    "trialVersion" => true
])
@section('meta')
    <title>Drumeo Trial</title>
    <meta property="og:title" content="Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/bestbook-trial/">
@endsection

@section('global-head')
    @parent

    <style>
        .yellow-banner {
            background: #FDCE02;
            padding: 20px 0;
            text-align:center;
        }

        @media (min-width: 40em) {
            .yellow-banner {
                padding: 25px 0;
                text-align:left;
            }
        }

        @media (min-width: 64em) {
            .yellow-banner {
                padding: 30px 20px
            }
        }

        .yellow-banner .container {
            padding: 0 10px;
            max-width: 350px;
        }

        @media (min-width: 40em) {
            .yellow-banner .container {
                padding: 0 15px;
                max-width: 690px;
            }
        }

        @media (min-width: 64em) {
            .yellow-banner .container {
                max-width: 900px;
            }
        }

        .yellow-banner .container img {
            width: 100px;
        }

        @media (min-width: 40em) {
            .yellow-banner .container img {
                float:left;
                width: 110px;
            }
        }


        .yellow-banner .container p {
            font: 400 13px/1.5em "Open Sans", sans-serif;
            margin: 5px auto 0;
            width: 100%;
        }

        @media (min-width: 40em) {
            .yellow-banner .container p {
                font-size: 16px;
                width: calc(100% - 110px);
                padding-left: 25px;
                margin: 15px auto 0;
            }
        }

        @media (min-width: 64em) {
            .yellow-banner .container p {
                font-size: 18px;
                margin: 25px auto 0;
            }
        }

        .yellow-banner .container p a {
            color: #000;
            text-decoration: underline;
            display:inline-block;
        }
    </style>
@endsection

@section('promo-banner')
    <section class="yellow-banner clearfix">
        <div class="container mx-auto">
            <div class="float-left w-full px-3 md:px-4">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/book-alt.png">
                <p class="float-left">Welcome! We’re so thankful you’re enjoying the Best Beginner Drum Book. If you’d
                    like to take your education up a notch, Drumeo is the perfect next step -- and you’ll get a
                    free 7-day trial when you click any of the big green buttons on this page.</p>
            </div>
        </div>
    </section>
@endsection

@section('final')
    @include('drumeo.sales.trials._final-trial', [ "sevenDay" => true, "url" => "/choose-your-trial/" ])
@stop
