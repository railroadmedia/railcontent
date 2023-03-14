@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Access Pass Redeem | Pianote</title>
    <meta name="description" content="To redeem your access pass enter your code below!">
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/lead-gen.css') }}">
    <style>
        [placeholder]:focus::-webkit-input-placeholder {
            color: transparent;
        }

        input::-webkit-input-placeholder,
        textarea::-webkit-input-placeholder {
            color: #AAA;
        }

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            color: #AAA;
        }

        input:-ms-input-placeholder,
        textarea:-ms-input-placeholder {
            color: #AAA;
        }

        input::placeholder,
        textarea::placeholder {
            color: #AAA;
        }

        .error {
            color: red;
            font: 500 16px "Open Sans", sans-serif;
        }

        input.jq-couponcode-part {
            width: 69px;
        }

        input.jq-couponcode-good {
            background-color: #77ff77;
        }

        input.jq-couponcode-good-nohighlight {
            text-align: center;
            padding: 2px 10px;
        }

        input.jq-couponcode-bad {
            background-color: #ff7777;
        }

        .jq-couponcode-sep {
            width: 6px;
        }

        #content {
            max-width: 800px;
            width: 100%;
            margin: 30px auto 50px;
            padding: 15px;
        }

        .apply {
            background: #F61A30;
            border-radius: 70px;
            color: #FFF;
            font: 700 28px/60px "Open Sans", sans-serif;
            height: 60px;
            width: 100%;
            margin: 20px auto 0;
            border: none;
            cursor: pointer;
        }

        .apply:hover {
            background:#ff364a;
        }

        input[type="text"],
        input[type="password"] {
            background: #FFF;
            color: #000;
            border: 1px solid #ccc;
            font: 400 12px/23px "Open Sans", sans-serif;
            margin: 0;
            padding: 10px;
            box-sizing: border-box;
            box-shadow: none !important;
            height: 45px;
            border-radius: 70px;
        }

        .error-form-field {
            width: 442px;
            padding-right: 38px;
            background-repeat: no-repeat;
            background-image: url("https://d2vyvo0tyx8ig5.cloudfront.net/redeem/error.png");
            background-position: 454px 16px
        }

        .correct-form-field {
            width: 442px;
            padding-right: 38px;
            background-repeat: no-repeat;
            background-image: url("https://d2vyvo0tyx8ig5.cloudfront.net/redeem/correct.png");
            background-position: 454px 16px
        }

        .loading-form-field {
            width: 442px;
            padding-right: 38px;
            background-repeat: no-repeat;
            background-image: url("https://d2vyvo0tyx8ig5.cloudfront.net/redeem/loading.gif");
            background-position: 460px 18px
        }

        .default-form-field {
            width: 100%;
        }

        .help-message {
            color: #666;
            font: 400 14px "Open Sans", sans-serif;
            padding: 0 0.9375rem;
        }

        .validation-error {
            color: red;
            font: 600 14px "Open Sans", sans-serif;
        }

        #commentform .code-input {
            text-align: center;
            display: inline-block;
            margin: 0;
            font-size: 10px;
        }

        #content .redeem-switcher {
            font: 400 16px "Open Sans", sans-serif;
            text-align: center;
            display: block;
            margin: 20px auto 5px;
        }

        #content .redeem-switcher .red {
            font-weight: 600;
            color: red;
        }

        .input-describer {
            font: 700 14px "Open Sans", sans-serif;
            margin: 15px auto 10px;
        }

        @media only screen and (min-width: 40em) {
            #content {
                padding: 25px;
            }

            #content .redeem-switcher {
                margin: 30px auto 15px;
            }

            input[type="text"],
            input[type="password"] {
                font-size: 16px;
                width: 99%;
            }

            #commentform .code-input {
                font-size: 16px;
                width: 95%;
            }
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav')

    <div id="content">
        <h1 class="text-center mb-3">Claim A Membership Access Code</h1>

        @if($newAccount)
            @if(empty($noSwitch))
                <div class="redeem-switcher rounded-xl py-4" style="background:#E3E8EC;">
                    <strong><b>Existing Member?</b>
                        <br>
                        <a class="text-pianote underline" href="/pianote/redeem/existing">Click here to add to your account.</a>
                    </strong>
                    <br>
                    <em>(The form below is only for new accounts)</em>
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <p class="validation-error">{{ $error }}</p>
            @endforeach

            <form id="commentform" name="pianote" method="post" action="{{ get_musora_brand_base_url() }}/ecommerce/access-codes/redeem">
                {{ csrf_field() }}
                <input type="hidden" name="credentials_type" value="new">
                <input type="hidden" name="redirect" value="{{ $redirectUrl ?? '/members' }}">
                <div class="container mx-auto clearfix">
                    <div class="flex flex-wrap w-full">
                        <p class="w-full input-describer">Code</p>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code1" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code1') }}">
                        </div>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code2" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code2') }}">
                        </div>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code3" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code3') }}">
                        </div>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code4" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code4') }}">
                        </div>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code5" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code5') }}">
                        </div>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code6" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code6') }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <p class="input-describer">Email</p>
                        <input class="default-form-field" type="text" id="email" name="email" placeholder="Email"
                               value="{{ old('email') }}">
                    </div>
                    <div class="w-full">
                        <p class="input-describer">Create A Password</p>
                        <input class="default-form-field" type="password" id="password" name="password"
                               placeholder="Password" value="">
                    </div>
                    <div class="w-full">
                        <p class="input-describer">Confirm Password</p>
                        <input class="default-form-field" type="password" id="password_confirmation"
                               name="password_confirmation" placeholder="Password Confirm" value="">
                    </div>
                    <div class="w-full">
                        <input name="button" type="submit" id="button" class="apply" value="Click To Redeem &raquo;"/>
                    </div>
                </div>
            </form>

        @else
            @if(empty($noSwitch))
                <div class="redeem-switcher rounded-xl py-4" style="background:#E3E8EC;">
                    <strong> <b>Not already a member?</b>
                        <br>
                        <a class="text-pianote underline" href="/pianote/redeem">Click here to redeem on a new account.</a>
                    </strong>
                    <br>
                    <em>(The form below is only for existing members)</em>
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <p class="validation-error">{{ $error }}</p>
            @endforeach


            <form id="commentform" name="pianote" method="post" action="{{ get_musora_brand_base_url() }}/ecommerce/access-codes/redeem">
                <input type="hidden" name="credentials_type" value="existing">
                <input type="hidden" name="redirect" value="{{ $redirectUrl ?? '/members' }}">
                {{ csrf_field() }}

                <div class="container mx-auto  clearfix">
                    <div class="flex flex-wrap w-full">
                        <p class="w-full input-describer">Code</p>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code1" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code1') }}">
                        </div>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code2" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code2') }}">
                        </div>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code3" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code3') }}">
                        </div>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code4" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code4') }}">
                        </div>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code5" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code5') }}">
                        </div>
                        <div class="w-1/6">
                            <input class="w-full code-input" type="text" name="code6" size="5" maxlength="4" placeholder="XXXX"
                                   value="{{ old('code6') }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <p class="input-describer">Email</p>
                        <input class="default-form-field" type="text" id="email" name="user_email"
                               placeholder="Email/Username" value="{{ old('user_email') }}">
                    </div>
                    <div class="w-full">
                        <p class="input-describer">Password</p>
                        <input class="default-form-field" type="password" id="password" name="user_password"
                               placeholder="Password" value="">
                    </div>
                    <div class="w-full">
                        <input name="button" type="submit" id="button" class="apply" value="Click To Redeem &raquo;"/>
                    </div>
                </div>
            </form>

        @endif
        <br>
        <p class="help-message">
            ** If you enter the email of an account that already has an existing valid
            subscription, your subscription will be extended based on the time associated with
            your card. </p>
        <p class="help-message">
            ** If you enter a new email address, a Pianote account will be created for you and
            your new password will be emailed to you shortly after claiming your card. </p>
    </div>

    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
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

@stop
