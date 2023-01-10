<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <title>Access Pass Redeem | Drumeo</title>
    <meta name="description" content="To redeem your access pass enter your code below!">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/members-area/js/gulp/navigation-sales.js') }}"></script>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <link href="{{ asset('/assets/members-area/css/gulp/navigation-sales.css') }}" rel="stylesheet">

    <style>
        .tipsy { font-size: 10px; position: absolute; padding: 5px; z-index: 100000; }
        .tipsy-inner { background-color: #000; color: #FFF; max-width: 200px; padding: 5px 8px 4px 8px; text-align: center; }

        /* Rounded corners */
        .tipsy-inner { border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; }

        /* Uncomment for shadow */
        /*.tipsy-inner { box-shadow: 0 0 5px #000000; -webkit-box-shadow: 0 0 5px #000000; -moz-box-shadow: 0 0 5px #000000; }*/

        .tipsy-arrow { position: absolute; width: 0; height: 0; line-height: 0; border: 5px dashed #000; }

        /* Rules to colour arrows */
        .tipsy-arrow-n { border-bottom-color: #000; }
        .tipsy-arrow-s { border-top-color: #000; }
        .tipsy-arrow-e { border-left-color: #000; }
        .tipsy-arrow-w { border-right-color: #000; }

        .tipsy-n .tipsy-arrow { top: 0px; left: 50%; margin-left: -5px; border-bottom-style: solid; border-top: none; border-left-color: transparent; border-right-color: transparent; }
        .tipsy-nw .tipsy-arrow { top: 0; left: 10px; border-bottom-style: solid; border-top: none; border-left-color: transparent; border-right-color: transparent;}
        .tipsy-ne .tipsy-arrow { top: 0; right: 10px; border-bottom-style: solid; border-top: none;  border-left-color: transparent; border-right-color: transparent;}
        .tipsy-s .tipsy-arrow { bottom: 0; left: 50%; margin-left: -5px; border-top-style: solid; border-bottom: none;  border-left-color: transparent; border-right-color: transparent; }
        .tipsy-sw .tipsy-arrow { bottom: 0; left: 10px; border-top-style: solid; border-bottom: none;  border-left-color: transparent; border-right-color: transparent; }
        .tipsy-se .tipsy-arrow { bottom: 0; right: 10px; border-top-style: solid; border-bottom: none; border-left-color: transparent; border-right-color: transparent; }
        .tipsy-e .tipsy-arrow { right: 0; top: 50%; margin-top: -5px; border-left-style: solid; border-right: none; border-top-color: transparent; border-bottom-color: transparent; }
        .tipsy-w .tipsy-arrow { left: 0; top: 50%; margin-top: -5px; border-right-style: solid; border-left: none; border-top-color: transparent; border-bottom-color: transparent; }
    </style>
    <style type="text/css">
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
            margin:30px auto 50px;
            padding:15px;
        }

        .apply {
            background:#10D05F;
            border-radius:70px;
            color:#FFF;
            font:700 28px/60px "Open Sans", sans-serif;
            height:60px;
            width:100%;
            margin:20px auto 0;
            border:none;
            cursor:pointer;
        }

        .apply:hover {
            background:#13e868;
        }

        .tipsy {
            font-size:12px;
            font-family:"Open Sans", sans-serif;
        }

        .tipsy-arrow {
            border:5px dashed red;
        }

        .tipsy-inner {
            background-color:red;
        }

        input[type="text"],
        input[type="password"] {
            background:#FFF;
            color:#000;
            border:1px solid #ccc;
            font:400 12px/23px "Open Sans", sans-serif;
            margin:0;
            padding:10px;
            box-sizing:border-box;
            box-shadow:none !important;
            height:45px;
            border-radius:70px;
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
            color:#A21B1B;
            font:400 14px "Open Sans", sans-serif;
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
                padding:25px;
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
    </style>
</head>
<body>

<div id="content">
    @yield('title')
    <div class="flex-video widescreen vimeo">
        @yield('video')
    </div>
    @foreach ($errors->all() as $error)
        <p class="validation-error">{{ $error }}</p>
    @endforeach

    @if($newAccount)
        @if(empty($noSwitch))
            <div class="redeem-switcher">
                <span class="red"><i class="fas fa-user"></i> Existing Member? <a href="/redeem/existing">Click here to add Drumeo to your account.</a> </span><br>
                (The form below is only for new accounts)
            </div>
        @endif


        @include('musora.pages.action-codes.redeem-form-new')
    @else
        @if(empty($noSwitch))
            <div class="redeem-switcher">
                <span class="red"><i class="fas fa-user-slash"></i> Not already a member? <a href="/redeem">Click here to redeem on a new Drumeo account.</a> </span><br>
                (The form below is only for existing members)
            </div>
        @endif

        @include('musora.pages.action-codes.redeem-form-existing')
    @endif
    <br>
    <p class="help-message">
        ** If you enter the email of an account that already has an existing valid
        subscription, your subscription will be extended based on the time associated with
        your card. </p>
    <p class="help-message">
        ** If you enter a new email address, a Drumeo account will be created for you and
        your new password will be emailed to you shortly after claiming your card. </p>
</div>

</body>
</html>
