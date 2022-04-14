@extends('partials.layout')

@section('meta')
    <title>Musora | Invite A Friend</title>
@endsection

@section('layout-styles')
    <style>
        h1 strong,
        label strong {
            font-weight:900
        }
        h1, h5, li, p {
            font-weight:400;
            line-height:1em;
            font-family:"Open Sans", sans-serif;
            margin:0 auto
        }
        h1 {
            line-height:1.2em;
            font-size:24px
        }
        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }
        @media (min-width:1024px) {
            h1 {
                font-size:48px
            }
        }
        h5, li {
            font-size:15px
        }
        @media (min-width:768px) {
            h5, li {
                font-size:18px
            }
        }
        @media (min-width:1024px) {
            h5, li {
                font-size:20px
            }
        }
        p, label {
            line-height:1.6em;
            font-size:15px
        }
        @media (min-width:1024px) {
            p, label {
                font-size:16px
            }
        }
        input[type=email], input[type=tel], input[type=password], input[type=text], input[type=url] {
            height: 50px;
            border-radius: 25px;
            background: #fff;
            color: #000;
            box-shadow: none;
            border: 1px solid #d1d1d1;
            outline: none;
            width: 100%;
            font: 400 16px/1.5em Open Sans, sans-serif;
            padding-left: 25px;
            padding-right: 25px;
        }
        .bg-referral {
            background:linear-gradient(to bottom, #010e2c, #000c17);
        }
    </style>
@endsection

@section('content')
    <page-container>
        <div v-cloak>

            @include(
                'partials.bladesora.members.referral.join',
                [
                    'joinUrl' => url()->route('referral.email-invite'),
                    'brand' => 'singeo',
                ]
            )

        </div>
    </page-container>           
@endsection