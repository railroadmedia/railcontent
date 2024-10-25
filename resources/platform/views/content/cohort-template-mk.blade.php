@extends('partials.layout')

@section('styles')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>     <!-- Alpine Plugin -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>

    <style>
        .timeline-container::after {
            top: 30px;
        }
        @media (min-width: 768px) {
            .timeline-container .timeline:after {
                left: 50% !important;
            }
        }

        .join {
            display: inline-block;
            font: 500 22px/1em 'Bebas Neue', sans-serif;
            text-transform: uppercase;
            background: #0c1524;
            border-radius: 50px;
            color: #fff!important;
            padding: 17px 7%;
            outline: none;
            cursor: pointer;
            text-align: center;
            user-select: none;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s, opacity 0.3s;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0.35);
        }
        @media (min-width: 768px) {
            .join {
                font-size: 30px;
            }
        }
        .join:hover, .join:focus {
            color: #fff;
            background:#14233d;
            box-shadow: 0 0 7px rgba(0, 0, 0, 0.35);
        }
        .join.drumeo {
            background:#0b76db;
        }
        .join.drumeo:hover {
            background:#0c84f5;
        }
        .join.white {
            background:#fff;
            color:#000!important;
        }
        .join.white:hover {
            background:#eee;
        }
        .join.sold-out {
            background: #777;
        }
        .join.sold-out:hover, .join.sold-out:focus {
            background: #919191;
        }
        .join.smaller {
            padding: 8px 30px;
            font-size: 16px;
        }
        @media (min-width: 768px) {
            .join.smaller {
                font-size: 18px;
                padding:11px 30px;
            }
        }


        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        form ::-webkit-input-placeholder, form ::-moz-placeholder, form :-ms-input-placeholder, form :-moz-placeholder {
            color:#777
        }

        form {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        @media (min-width: 768px) {
            form {
                margin: 0 auto 10px;
            }
        }

        form input, form button {
            font: 400 18px/50px 'Open Sans', sans-serif;
            height: 50px;
            color: #999;
            border-radius: 100px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 15px;
        }
        @media (min-width: 768px) {
            form input, form button {
                font-size: 22px;
                height: 65px;
                line-height: 65px;
            }
        }
        form input[type="submit"], form button[type="submit"], form input button, form button button {
            font-family: 'Bebas Neue', sans-serif;
            color: #fff;
            background: #0b76db;
            text-transform: uppercase;
            margin: 0 auto 15px;
            display: block;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
            padding: 0;
        }
        form input[type="submit"]:hover, form button[type="submit"]:hover, form input button:hover, form button button:hover {
            background: #258ff4;
        }
        .disclaimer {
            display: none;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }

        .thank-you-box {
            width:100%;
            max-width:960px;
            border-radius:5px;
            height:auto;
            max-height:0;
            visibility:hidden;
            opacity:0;
            transition:all .4s ease-in;
            display:block;
            margin:0 auto;
            background:#FFF;
            text-align:center;
            overflow:hidden;
            color:#000
        }

        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:15px
        }

        @media (min-width:40em) {
            .thank-you-box.active {
                padding:20px
            }
        }

        @media (min-width:64em) {
            .thank-you-box.active {
                padding:30px
            }
        }

        .thank-you-box p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto
        }

        @media (min-width:40em) {
            .thank-you-box p {
                font-size:19px
            }
        }

        @media (min-width:64em) {
            .thank-you-box p {
                font-size:23px
            }
        }

        .thank-you-box p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px
        }

        @media (min-width:40em) {
            .thank-you-box p em {
                font-size:14px
            }
        }

        .thank-you-box h2 {
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#0b76db
        }

        @media (min-width:40em) {
            .thank-you-box h2 {
                font-size:37px;
                margin:20px auto
            }
        }

        @media (min-width:64em) {
            .thank-you-box h2 {
                font-size:44px
            }
        }

        .thank-you-box .social-media a {
            background:#000;
            color:#fff;
            border-radius:50%;
            display:inline-block;
            text-align:center;
            margin:20px 3px 0;
            width:50px;
            height:50px;
            line-height:50px;
            font-size:26px
        }

        @media (min-width:64em) {
            .thank-you-box .social-media a {
                width:70px;
                height:70px;
                line-height:70px;
                font-size:35px;
                margin:25px 10px 0
            }
        }

        @media (min-width: 768px) {
            .timeline-container .timeline:after {
                left: 50% !important;
            }
        }

        /*  Carousel   */
        .splide__pagination__page.is-active {
            background: white;
            transform: none !important;
        }
        .splide__arrow svg{
            fill: #0B76DB !important;
        }

        .splide__arrow--next {
            right: -12px;
        }

        @media (min-width: 1140px) {
            .splide__arrow--next {
                right: -100px;
            }
        }
    </style>
    <style>
        .join.guitareo {
            background:#00C9AC;
        }
        .join.guitareo:hover {
            background:#00e3c1;
        }
        .timeline-container.guitareo:after {
            background-color: #00C9AC;
        }
        .timeline-container.guitareo .timeline:after {
            background-color: #00C9AC;
        }
        .join.pianote {
            background:#F61A30;
        }
        .join.pianote:hover {
            background:#ff263c;
        }
        .timeline-container.pianote:after {
            background-color: #F61A30;
        }
        .timeline-container.pianote .timeline:after {
            background-color: #F61A30;
        }
        .join.singeo {
            background:#8300E9;
        }
        .join.singeo:hover {
            background:#9000ff;
        }
        .timeline-container.singeo:after {
            background-color: #8300E9;
        }
        .timeline-container.singeo .timeline:after {
            background-color: #8300E9;
        }
    </style>
@endsection

@section('layout-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function startCountdown() {
                const countdownElement = document.getElementById('countdown');
                const endTime = new Date(countdownElement.getAttribute('data-countdown-date')).getTime();
                const expiredElement = document.getElementById('expired');
                const units = ['days', 'hours', 'minutes', 'seconds'];
                const timeElements = {};
                const valueElements = {};
                const textElements = {};

                units.forEach(unit => {
                    timeElements[unit] = document.getElementById(unit);
                    valueElements[unit] = document.getElementById(`${unit.slice(0, -1)}Value`);
                    textElements[unit] = document.getElementById(`${unit.slice(0, -1)}Text`);
                });

                function updateCountdown() {
                    const now = new Date().getTime();
                    const timeLeft = endTime - now;

                    if (timeLeft <= 0) {
                        countdownElement.classList.add('hidden');
                        expiredElement.classList.remove('hidden');
                        return;
                    }

                    const timeValues = {
                        days: Math.floor(timeLeft / (1000 * 60 * 60 * 24)),
                        hours: Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                        minutes: Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60)),
                        seconds: Math.floor((timeLeft % (1000 * 60)) / 1000)
                    };

                    if (timeValues.days > 6) {
                        units.slice(1).forEach(unit => timeElements[unit].classList.add('hidden'));
                        timeElements.days.classList.remove('hidden');
                        valueElements.days.textContent = timeValues.days;
                        textElements.days.textContent = timeValues.days === 1 ? ' day ' : ' days ';
                    } else {
                        units.forEach(unit => {
                            timeElements[unit].classList.toggle('hidden', timeValues[unit] <= 0 && unit !== 'seconds');
                            valueElements[unit].textContent = timeValues[unit];
                            textElements[unit].textContent = timeValues[unit] === 1 ? ` ${unit.slice(0, -1)} ` : ` ${unit} `;
                        });
                    }
                }

                setInterval(updateCountdown, 1000);
                updateCountdown();
            }

            startCountdown();
        });
    </script>
    <script>
        const postMessageTest = () => {
            window.postMessage('post message');
        }

        const reactNativeTest = () => {
            window.ReactNativeWebView.postMessage('react native');
        }
    </script>
@endsection

@section('meta')
    <title>Challenge Enrollment | Musora</title>
@endsection

@section('body-data')
    x-data ="{
    trailer : false,
    trailerM: false,
    waitlistModal: false,
    }"
@endsection

@section('content')

    <div class="bg-white text-black">
        @if($cohort['slug'] == '30-day-jazz-piano')
            @include('pianote.products._30D-jazz-piano', [
                'theme' => 'pianote',
                'platformVersion' => true,
                'hasProduct' => json_encode($hasProduct)
            ])
        @elseif($cohort['slug'] == 'everyday-improv')
            @include('singeo.products._everyday-improv', [
                'theme' => 'singeo',
                'platformVersion' => true,
                'hasProduct' => json_encode($hasProduct)
            ])
        @elseif($cohort['slug'] == '30-day-jazz')
            @include('drumeo.products._30D-jazz', [
                'theme' => 'drumeo',
                'platformVersion' => true,
                'hasProduct' => json_encode($hasProduct)
            ])
        @elseif($cohort['slug'] == '30-day-double-bass')
            @include('drumeo.products._30D-double-bass', [
                'theme' => 'drumeo',
                'platformVersion' => true,
                'hasProduct' => json_encode($hasProduct)
            ])
        @elseif($cohort['slug'] == 'electric-guitarists-start-here')
            @include('guitareo.products._electric-guitarists-start-here', [
                'theme' => 'guitareo',
                'platformVersion' => true,
                'hasProduct' => json_encode($hasProduct)
            ])
        @endif
    </div>
    <Cohort
        :cohort="{{ json_encode($cohort) }}"
        :register-url="{{ json_encode($registerButtonUrl) }}"
        :n-pack-owners="{{ json_encode(number_format($nPackOwners ?? 0)) }}"
        :dropdowns="{{ json_encode($cohort->dropdowns) }}"
        :has-product="{{ json_encode($hasProduct) }}"
        :is-custom="true"
    ></Cohort>

    @include('partials._railanalytics-brand-tracking-iframe')
@endsection
