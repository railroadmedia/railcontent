@extends('drumeo.sales.standard-layout', [
    "trialVersion" => true
])

@section('meta')
    <title>Drumeo Power Pack</title>
    <meta property="og:title" content="Drumeo Power Pack">
    <meta property="og:url" content="https://www.drumeo.com/power-pack/">
    <meta name="robots" content="noindex">
@endsection

@section('global-head')
@parent

<style>
    .yellow-banner {
        background: #FDCE02;
        padding: 20px 0;
        text-align:center;
    }

    @media (min-width: 40em) {
        .yellow-banner {
            padding: 30px 0;
            text-align:left;
        }
    }

    @media (min-width: 64em) {
        .yellow-banner {
            padding: 40px 20px
        }
    }

    .yellow-banner .container {
        padding: 0 10px
    }

    @media (min-width: 40em) {
        .yellow-banner .container {
            padding: 0 15px
        }
    }

    .yellow-banner .container img {
        width: 130px;
    }

    @media (min-width: 40em) {
        .yellow-banner .container img {
            float:left;
            width: 150px;
        }
    }


    .yellow-banner .container p {
        font: 400 13px/1.5em "Open Sans", sans-serif;
        margin: 10px auto 0;
        width: 100%;
    }

    @media (min-width: 40em) {
        .yellow-banner .container p {
            font-size: 16px;
            width: calc(100% - 150px);
            padding-left: 25px;
            margin: 0 auto;
        }
    }

    @media (min-width: 64em) {
        .yellow-banner .container p {
            font-size: 18px;
            margin: 15px auto 0;
        }
    }

    .yellow-banner .container p a {
        color: #000;
        text-decoration: underline;
        display:inline-block;
    }
</style>
@endsection

@section('promo-banner')

    <section class="yellow-banner clearfix">
        <div class="container mx-auto">
            <div class="float-left w-full px-3 md:px-4">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/promos/february/hlag-logo.png">
                <p class="float-left"><strong>Power Pack 2020:</strong> You’re eligible for a FREE 30-day membership to Drumeo. Browse
                    around this page for all the details and then
                    <a class="anchor-slide" href="#customize-anchor">click here to claim your gift</a>. </p>
            </div>
        </div>
    </section>
@endsection

@section('final')
    <style>
        [placeholder]:focus::-webkit-input-placeholder {
            color: transparent;
        }

        .thank-you-box{width:100%;max-width:960px;border-radius:5px;height:auto;max-height:0;visibility:hidden;opacity:0;transition:all .4s ease-in;display:block;margin:0 auto;background:#FFF;text-align:center;overflow:hidden;color:#000}.thank-you-box.active{max-height:1000px;visibility:visible;opacity:1;padding:15px}@media (min-width: 40em){.thank-you-box.active{padding:20px}}@media (min-width: 64em){.thank-you-box.active{padding:30px}}.thank-you-box p{font:400 15px/1.4em "Open Sans",sans-serif;margin:0 auto}@media (min-width: 40em){.thank-you-box p{font-size:19px}}@media (min-width: 64em){.thank-you-box p{font-size:23px}}.thank-you-box p em{line-height:1.4em;max-width:550px;display:inline-block;font-size:12px}@media (min-width: 40em){.thank-you-box p em{font-size:14px}}.thank-you-box h2{font:700 30px/1em "Roboto Condensed",sans-serif;margin:15px auto;text-transform:uppercase;color:#0b76db}@media (min-width: 40em){.thank-you-box h2{font-size:37px;margin:20px auto}}@media (min-width: 64em){.thank-you-box h2{font-size:44px}}.thank-you-box .social-media a{background:#000;color:#fff;border-radius:50%;display:inline-block;text-align:center;margin:20px 3px 0;width:50px;height:50px;line-height:50px;font-size:26px}@media (min-width: 64em){.thank-you-box .social-media a{width:70px;height:70px;line-height:70px;font-size:35px;margin:25px 10px 0}}

        .power-pack-signup {
            background: #191B1C url(https://dpwjbsxqtam5n.cloudfront.net/promos/spring/customize-bg.jpg) no-repeat center center;
            color: #fff;
            padding: 40px 0;
        }
        @media (min-width: 40em) {
            .power-pack-signup {
                padding: 70px 0;
            }
        }
        @media (min-width: 64em) {
            .power-pack-signup {
                padding: 90px 0;
            }
        }
        .power-pack-signup .logo img {
            width: 100%;
            max-width: 190px;
            margin: 0 auto 15px;
        }
        @media (min-width: 40em) {
            .power-pack-signup .logo img {
                max-width: 260px;
                margin: 0 auto 20px;
            }
        }
        @media (min-width: 64em) {
            .power-pack-signup .logo img {
                max-width: 340px;
                margin: 0 auto 25px;
            }
        }
        .power-pack-signup h3 {
            margin: 0 auto 35px;
        }
        @media (min-width: 40em) {
            .power-pack-signup h3 {
                margin: 0 auto 40px;
            }
        }
        @media (min-width: 64em) {
            .power-pack-signup h3 {
                margin: 0 auto 55px;
            }
        }
        .power-pack-signup form {
            position: relative;
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
        }
        @media (min-width: 40em) {
            .power-pack-signup form {
                margin: 0 auto 10px;
                max-width: 640px;
            }
        }
        @media (min-width: 64em) {
            .power-pack-signup form {
                max-width: 900px;
            }
        }
        .power-pack-signup form input {
            font: 400 18px/50px "Open Sans", sans-serif;
            height: 50px;
            color: #999;
            border-radius: 5px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 15px;
            width: 100%;
            border: none;
        }
        @media (min-width: 40em) {
            .power-pack-signup form input {
                font-size: 22px;
                height: 65px;
                line-height: 65px;
            }
        }
        @media (min-width: 64em) {
            .power-pack-signup form input {
                font-size: 26px;
                height: 75px;
                line-height: 75px;
            }
        }
        .power-pack-signup form input[type="submit"] {
            font-family: "Roboto Condensed", sans-serif;
            font-weight: 700;
            color: #FFF;
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
        .power-pack-signup form input[type="submit"]:hover {
            background: #258ff4;
        }
        .power-pack-signup .questions p {
            margin: 0;
            opacity: 0.7;
            max-width: 100%;
            font-size: 13px;
        }
        .power-pack-signup .questions p a {
            color: inherit;
            display: inline-block;
        }

        .disclaimer {
            display: inline-block;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }
        .disclaimer i {
            width: 40px;
            font-size: 29px;
            line-height: 1em;
            float: left;
        }
        .disclaimer p {
            font: 400 12px/1.4em "Open Sans", sans-serif;
            margin: 0 auto;
            width: calc(100% - 40px);
            float: left;
            text-align: left;
        }

        .success, .error  {
            width: 100%;
            max-width: 590px;
            margin: 0 auto 25px;
            background: #fff;
            border-radius: 5px;
            color: #000;
            padding: 30px;
        }
        .success p, .error p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto;
        }

        @media (min-width:40em) {
            .success p, .error p {
                font-size:19px;
            }
        }

        @media (min-width:64em) {
            .success p, .error p {
                font-size:23px;
            }
        }

        .success h2, .error h2 {
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#0b76db;
        }

        @media (min-width:40em) {
            .success h2, .error h2 {
                font-size:40px;
                margin:20px auto;
            }
        }

        @media (min-width:64em) {
            .success h2, .error h2 {
                font-size:50px;
            }
        }

        .success p em, .error p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px;
        }

        @media (min-width:40em) {
            .success p em, .error p em {
                font-size:14px;
            }
        }

        .power-pack-signup .text-error {
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#d9cf0d;
        }

        @media (min-width:40em) {
            .power-pack-signup .text-error {
                font-size:40px;
                margin:20px auto;
            }
        }

        @media (min-width:64em) {
            .power-pack-signup .text-error {
                font-size:50px;
            }
        }
    </style>
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="customize" style="padding: 0;"></section>
    <section class="power-pack-signup text-center">
        <div class="row">
            <div class="logo"><img src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png"> </div>
            <div class="logo"><img src="https://dpwjbsxqtam5n.cloudfront.net/promos/february/hlag-logo.png"> </div>
            <h3>Claim Your Free 30-Day <br class="hide-for-medium"> Membership To Drumeo</h3>
            <div class="columns">
                @if(!empty($errors))
                    @foreach ($errors->all() as $error)
                        <p class="mb-1 text-error body">{{ $error }}</p>
                    @endforeach
                @endif

                @if(session()->has('success'))
                        <div class="success">
                            <p><strong>Success!</strong></p>
                            <h2>{{ session()->get('success') }}</h2>
                            <p><em>You will receive an email with your access code for your free 30-day membership. <br>
                                    This access code can be used anytime, so you can start your free membership whenever it works best for you.</em></p>
                        </div>
                        <br><br>
                    @elseif(session()->has('error'))
                        <div class="error">
                            <p><strong>Error</strong></p>
                            <p><em>We're sorry, but there's been a problem on our end. <br>Please <a class="text-white" href="/support">contact us</a> or call 1-800-439-8921 and we'll get things sorted out!</em></p>
                        </div>
                        <br><br>
                    @else
                        <form accept-charset="UTF-8" action="/laravel/public/hlag-submit" id="inf_form" class="clearfix infusion-form" method="POST">
                            <input name="inf_form_xid" type="hidden" value=""/>
                            <input name="inf_form_name" type="hidden" value=""/>
                            <div class="infusion-field columns medium-6">
                                <input class="infusion-field-input-container" id="first_name" name="first_name" placeholder="First Name..." required/>
                            </div>
                            <div class="infusion-field columns medium-6">
                                <input class="infusion-field-input-container" id="last_name" name="last_name" placeholder="Last Name..." required/>
                            </div>
                            <div class="infusion-field columns">
                                <input class="infusion-field-input-container" id="email" name="email" type="email" placeholder="Email Address..." required/>
                            </div>
                            <div class="infusion-submit columns">
                                <input class="submit" type="submit" value="Claim Your Access Code &raquo;"/>
                            </div>
                        </form>
                        <div class="disclaimer">
                            <i class="fal fa-info-circle"></i>
                            <p>By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</p>
                        </div>
                    <br><br>
                @endif
            </div>
            <div class="columns questions">
                <p><strong>Any questions?</strong> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>. </p>
            </div>
        </div>
    </section>
@endsection
