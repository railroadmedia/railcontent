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
@endsection

@section('meta')
    <title>Challenge Enrollment | Musora</title>
@endsection

@section('body-data')
    x-data ="{
    trailer : false,
    trailerM: false,
    }"
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
