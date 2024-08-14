@extends('partials.layout')

@section('styles')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">

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
    </style>
@endsection

@section('layout-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            function startCountdown() {
                const countdownElement = document.getElementById('countdown');
                const endTimeString = countdownElement.getAttribute('data-countdown-date');
                const promoVersion = countdownElement.getAttribute('data-promo-version') === 'true';

                const endTime = new Date(endTimeString).getTime();
                const expiredElement = document.getElementById('expired');
                const dayElement = document.getElementById('days');
                const hourElement = document.getElementById('hours');
                const minuteElement = document.getElementById('minutes');
                const secondElement = document.getElementById('seconds');

                const dayValue = document.getElementById('dayValue');
                const hourValue = document.getElementById('hourValue');
                const minuteValue = document.getElementById('minuteValue');
                const secondValue = document.getElementById('secondValue');

                const dayText = document.getElementById('dayText');
                const hourText = document.getElementById('hourText');
                const minuteText = document.getElementById('minuteText');
                const secondText = document.getElementById('secondText');

                function updateCountdown() {
                    const now = new Date().getTime();
                    const timeLeft = endTime - now;

                    if (timeLeft <= 0) {
                        countdownElement.classList.add('hidden');
                        expiredElement.classList.remove('hidden');
                        return;
                    }

                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    dayElement.classList.toggle('hidden', days <= 0);
                    hourElement.classList.toggle('hidden', hours <= 0);
                    minuteElement.classList.toggle('hidden', minutes <= 0);
                    secondElement.classList.toggle('hidden', seconds <= 0);

                    dayValue.textContent = days;
                    hourValue.textContent = hours;
                    minuteValue.textContent = minutes;
                    secondValue.textContent = seconds;

                    if (promoVersion) {
                        dayText.textContent = 'DAYS';
                        hourText.textContent = 'HRS';
                        minuteText.textContent = 'MIN';
                        secondText.textContent = 'SEC';
                    } else {
                        dayText.textContent = days === 1 ? ' day ' : ' days ';
                        hourText.textContent = hours === 1 ? ' hour ' : ' hours ';
                        minuteText.textContent = minutes === 1 ? ' minute ' : ' minutes ';
                        secondText.textContent = seconds === 1 ? ' second' : ' seconds';
                    }
                }

                setInterval(updateCountdown, 1000);
                updateCountdown();
            }

            // Start the countdown on page load
            startCountdown();
        });
    </script>
@endsection

@section('meta')
    <title>Challenge Enrollment | Musora</title>
@endsection

@section('content')
    @if($cohort['slug'] == '30-day-double-bass')
        <div class="bg-white text-black">
            @include('drumeo.products._30D-double-bass', [
                'theme' => 'drumeo',
                'platformVersion' => true
            ])
        </div>
    @endif
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
