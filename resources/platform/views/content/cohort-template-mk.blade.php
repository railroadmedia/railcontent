@extends('partials.layout')

@section('styles')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">

    <style>
        .join {
            display: inline-block;
            font: 500 22px/1em 'Bebas Neue', sans-serif;
            text-transform: uppercase;
            background: #0c1524;
            border-radius: 50px;
            color: #fff;
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
        .join.green {
            background: #10d05f;
        }
        .join.green:hover, .join.green:focus {
            background: #25ee78;
        }
        .join.white {
            background: #fff;
            color: #000;
        }
        .join.white:hover, .join.white:focus {
            background: #eee;
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
        .join.smaller.outline {
            padding: 8px 28px 6px;
            font-size: 16px;
        }
        @media (min-width: 768px) {
            .join.smaller.outline {
                font-size: 18px;
                padding: 10px 28px 8px;
            }
        }
        .join.coaches {
            background-color: #fe9f13;
            color: #000;
        }
        .join.coaches:hover, .join.coaches:focus {
            background: #feb446;
            color: #000;
        }
        .join.promo {
            background: #ffac00;
            color: #000;
        }
        .join.promo:hover, .join.promo:focus {
            background: #ffbd33;
            color: #000;
        }
        .join.outline {
            background: transparent;
            outline-style: none !important;
            border: 1px solid #fff;
            color: #fff;
            padding: 6px 12px;
        }
        @media (min-width: 768px) {
            .join.outline {
                border-width: 2px;
                padding: 11px 30px;
            }
        }
        .join.outline:hover, .join.outline:focus {
            background: #fff;
            color: #000;
        }
        .join.outline.light-navy {
            border-color: #a1afc9;
            color: #a1afc9;
        }
        .join.outline.light-navy:hover, .join.outline.light-navy:focus {
            background: #a1afc9;
            color: #000;
        }
        .join.outline.method, .join.outline.pianote {
            border-color: #f61a30;
            color: #f61a30;
        }
        .join.outline.method:hover, .join.outline.pianote:hover, .join.outline.method:focus, .join.outline.pianote:focus {
            background: #f61a30;
            color: #fff;
        }
        .join.outline.songs {
            border-color: #17d1fa;
            color: #17d1fa;
        }
        .join.outline.songs:hover, .join.outline.songs:focus {
            background: #17d1fa;
            color: #fff;
        }
        .join.outline.coaches {
            border-color: #fe9f13;
            color: #fe9f13;
        }
        .join.outline.coaches:hover, .join.outline.coaches:focus {
            background: #fe9f13;
            color: #fff;
        }
        .join.outline.promo {
            border-color: #ffac00;
            color: #ffac00;
        }
        .join.outline.promo:hover, .join.outline.promo:focus {
            background: #ffac00;
            color: #fff;
        }

        .text-musora {
            color: #0c1524;
            -webkit-text-fill-color: #0c1524 !important;
        }

        .text-musora-gold {
            color: #FFAE00!important;
        }

        .bg-musora {
            background:#0c1524 !important;
        }
        .border-musora {
            border-color:#0c1524!important;
        }
        .border-musora-gold {
            border-color:#FFAE00!important;
        }
        .border-musora::before {
            content:none!important;
        }
        .bg-musora-gold {
            background:#FFAE00 !important;
        }
    </style>


    @php
        $isEnrolled = $hasProduct;
        $token = csrf_token();
        $cohortStartDate = \Carbon\Carbon::parse($cohort['cohort_start_date']);
        $cohortEndDate = \Carbon\Carbon::parse($cohort['cohort_end_date']);
        $enrollmentEndDate = \Carbon\Carbon::parse($cohort['enrollment_end_date']);
    @endphp
@endsection

@section('meta')
    <title>Cohort Enrollment | Musora</title>
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
    @include('partials._railanalytics-brand-tracking-iframe')
@endsection
