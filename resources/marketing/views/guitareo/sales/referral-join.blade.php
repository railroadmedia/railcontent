@extends('guitareo._partials.layout')

@section('head-includes')
    @parent

    <title>Join | Guitareo</title>
    <meta property="og:title" content="Guitareo | The Ultimate Online Guitar Lesson Experience">

    <meta name="description" content="Learn playing the guitar faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee. ">
    <meta property="og:description" content="Reach your playing guitar goals with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">

    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/fb-share-image.jpg" style="display: none;">

    @include('_partials.components.google-optimize')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css" />
    <link rel="stylesheet" href="/assets/marketing/nav-footer.css">
    <link href="/assets/css/tailwind-helpers.css" rel="stylesheet">
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
@section('layout-scripts')
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function onSubmit(token) {
            document.getElementById("join-form").submit();
        }
    </script>
@endsection

@section('body-class', 'tw-m-0')


@section('global-layout-body')
    @include('guitareo.sales.partials._nav', [
        'cartVersion' => true
    ])

    @include(
        'bladesora::members.referral.join'
    )

    @include('guitareo.sales.partials._footer')
@endsection
