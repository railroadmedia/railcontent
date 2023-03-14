@extends('musora._partials.layout')

@section('head-includes')
    <title>Access Pass Redeem | Drumeo</title>
    <meta name="description" content="To redeem your access pass enter your code below!">
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <style>
        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent;
        }

        input::-webkit-input-placeholder,
        textarea::-webkit-input-placeholder {
            color:#AAA;
        }

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            color:#AAA;
        }

        input:-ms-input-placeholder,
        textarea:-ms-input-placeholder {
            color:#AAA;
        }

        input::placeholder,
        textarea::placeholder {
            color:#AAA;
        }

        .error {
            color:red;
            font:500 16px "Open Sans", sans-serif;
        }

        input.jq-couponcode-part {
            width:69px;
        }

        input.jq-couponcode-good {
            background-color:#77ff77;
        }

        input.jq-couponcode-good-nohighlight {
            text-align:center;
            padding:2px 10px;
        }

        input.jq-couponcode-bad {
            background-color:#ff7777;
        }

        .jq-couponcode-sep {
            width:6px;
        }

        #headerWide {
            background:#808080;
            margin-bottom:20px;
            text-align:center;
        }

        #content {
            max-width:800px;
            width:100%;
            margin:0 auto;
            padding:30px 15px;
        }

        .apply {
            background:#00060B;
            border-radius:70px;
            color:#FFF;
            font:400 28px/60px "Bebas Neue", sans-serif;
            text-transform:uppercase;
            height:60px;
            width:100%;
            margin:20px auto 0;
            border:none;
            cursor:pointer;
        }

        input[type="text"],
        input[type="password"] {
            background:#FFF;
            color:#000;
            border:1px solid #ccc;
            font:400 12px/23px "Open Sans", sans-serif;
            margin:0;
            padding:10px 15px;
            box-sizing:border-box;
            box-shadow:none !important;
            height:45px;
            border-radius:70px;
        }

        .error-form-field {
            width:442px;
            padding-right:38px;
            background-repeat:no-repeat;
            background-image:url("https://dpwjbsxqtam5n.cloudfront.net/'redeem/error.png");
            background-position:454px 16px
        }

        .correct-form-field {
            width:442px;
            padding-right:38px;
            background-repeat:no-repeat;
            background-image:url("https://dpwjbsxqtam5n.cloudfront.net/redeem/correct.png");
            background-position:454px 16px
        }

        .loading-form-field {
            width:442px;
            padding-right:38px;
            background-repeat:no-repeat;
            background-image:url("https://dpwjbsxqtam5n.cloudfront.net/redeem/loading.gif");
            background-position:460px 18px
        }

        .default-form-field {
            width:100%;
        }

        .help-message {
            color:#666;
            font:400 14px "Open Sans", sans-serif;
            padding:0 0.9375rem;
        }

        .validation-error {
            color: red;
            font: 600 16px/1em "Open Sans", sans-serif;
        }

        #commentform .code-input {
            text-align:center;
            display:inline-block;
            margin:0;
            font-size:10px;
        }

        #content .redeem-switcher {
            font:400 16px "Open Sans", sans-serif;
            text-align:center;
            display:block;
            margin:20px auto 5px;
        }

        #content .redeem-switcher .red {
            font-weight:600;
            color:red;
        }

        .input-describer {
            font:700 14px "Open Sans", sans-serif;
            margin:15px auto 10px;
        }

        @media only screen and (min-width:40em) {
            #content {
                padding:50px 25px;
            }
            #content .redeem-switcher {
                margin:30px auto 15px;
            }

            input[type="text"],
            input[type="password"] {
                font-size:16px;
                width:99%;
            }

            #commentform .code-input {
                font-size:16px;
                width:95%;
            }
        }

        @media only screen and (min-width:64em) {
            #content {
                padding:50px 25px;
            }
        }
    </style>
    @if(!empty($thomann))
        <style>
            .apply {
                background:#0b76db;
            }

            .apply:hover {
                background:#258ff4;
            }
        </style>
    @endif
@endsection

<!-- Main -->
@section('layout-body')
    <div id="content">
        @if(empty($thomann))
            <div class="aspect-16:9 w-full relative border-2 rounded-xl overflow-hidden">
                <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/113327941" frameborder="0" allowfullscreen allow="autoplay" title="10year-video"></iframe>
            </div>
            <p class="redeem-switcher text-left"><i class="fal fa-info-circle"></i> Although the card is for Drumeo, this card will give you full access to Drumeo, Pianote, Guitareo, and Singeo.</p>
        @else
            <div class="text-center">
                <img style="height:30px;width:auto;filter:invert(1);margin-bottom: 15px;" src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/thomann-logo.png">
                <h3 style="font-family: 'Open Sans', sans-serif;"><strong style="font-weight: 900;">CLAIM YOUR DRUMEO 3-MONTH MEMBERSHIP</strong></h3>
                {{--        <p>Redeem your free 1-year Drumeo membership here.</p>--}}
            </div>
            <div class="redeem-switcher">
                <span class="red"> These access codes can only be <br class="inline sm:hidden"> redeemed for new accounts</span>
            </div>
        @endif
         @if($newAccount)
            @if(empty($thomann))
                <div class="redeem-switcher rounded-xl py-4" style="background:#E3E8EC;">
                    <strong><b>Existing Member?</b>
                        <br>
                        <a class="text-drumeo underline" href="/redeem/existing">Click here to add to your account.</a>
                    </strong>
                    <br>
                    <em>(The form below is only for new accounts)</em>
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <br>
                <p class="validation-error">{{ $error }}</p>
            @endforeach

            @include('musora.pages.redeem._redeem-form')
         @else
            <div class="redeem-switcher rounded-xl py-4" style="background:#E3E8EC;">
                <strong> <b>Not already a member?</b>
                    <br>
                    <a class="text-drumeo underline" href="/redeem">Click here to redeem on a new account.</a>
                </strong>
                <br>
                <em>(The form below is only for existing members)</em>
            </div>

            @foreach ($errors->all() as $error)
                <br>
                <p class="validation-error">{{ $error }}</p>
            @endforeach

            @include('musora.pages.redeem._redeem-form', [
                "existing" => true
            ])
         @endif


        <br>
        <p class="help-message">
            ** If you enter the email of an account that already has an existing valid subscription, your subscription will be extended based on the time associated with your card.
        </p>
        <p class="help-message">
            ** If you enter a new email address, an account will be created for you and your new password will be emailed to you shortly after claiming your card.
        </p>
        <p class="help-message">
            ** Your Access Page may look like it’s only for Drumeo, but this pass will give you access to all four of our communities: Drumeo, Pianote, Guitareo, and Singeo!
        </p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(
            function () {
                $('.code-input').bind(
                    'paste', function (e) {
                        var value = e.originalEvent.clipboardData.getData('text');
                        value = value.toUpperCase().replace(/[^0-9A-Z]/g, "");
                        var chunks = value.match(new RegExp('.{1,4}', 'g'));
                        for (var i = 0; i < chunks.length; i++) {
                            $('.code-input').eq(i).val(chunks[i]);
                        }
                    }
                ).bind(
                    'input',
                    function (e) {
                        console.log($(this).val().length);
                        if ($(this).val().length == 4) {
                            $('.code-input').eq($(this).index('.code-input') + 1).focus();
                        }
                    }
                );
            }
        );
    </script>
@endsection
