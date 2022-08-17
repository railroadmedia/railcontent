@extends('musora._partials.layout')

@section('head-includes')
    <title>Join | Pianote</title>

    <style>
        h1 strong,
        label strong {
            font-weight:900
        }
        h1, h5, li, p {
            font-weight:400;
            line-height:1em;
            /* font-family:"Open Sans", sans-serif; */
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
        input[type=email].main-form, input[type=tel].main-form, input[type=password].main-form, input[type=text].main-form, input[type=url].main-form {
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
@stop

<!-- Main -->
@section('layout-body')

    @include('musora.referral.join')
    
@stop

@section('layout-scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function onSubmit(token) {
            document.getElementById("join-form").submit();
        }
    </script>
@endsection