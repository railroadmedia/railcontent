@extends('drumeo.sales.standard-layout', [
    "trialVersion" => true
])
@section('meta')
    <title>Drumeo Trial</title>
    <meta property="og:title" content="Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/toolbox-trial/">
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
                padding: 25px 0;
                text-align:left;
            }
        }

        @media (min-width: 64em) {
            .yellow-banner {
                padding: 30px 20px
            }
        }

        .yellow-banner .container {
            padding: 0 10px;
            max-width: 350px;
        }

        @media (min-width: 40em) {
            .yellow-banner .container {
                padding: 0 15px;
                max-width: 690px;
            }
        }

        @media (min-width: 64em) {
            .yellow-banner .container {
                max-width: 900px;
            }
        }

        .yellow-banner .container img {
            width: 100px;
        }

        @media (min-width: 40em) {
            .yellow-banner .container img {
                float:left;
                width: 110px;
            }
        }


        .yellow-banner .container p {
            font: 400 13px/1.5em "Open Sans", sans-serif;
            margin: 5px auto 0;
            width: 100%;
        }

        @media (min-width: 40em) {
            .yellow-banner .container p {
                font-size: 16px;
                width: calc(100% - 110px);
                padding-left: 25px;
                margin: 15px auto 0;
            }
        }

        @media (min-width: 64em) {
            .yellow-banner .container p {
                font-size: 18px;
                margin: 25px auto 0;
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
                <img src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/book.png">
                <p class="float-left">Welcome! We’re so thankful you’re enjoying The Drummer's Toolbox. If you’d
                    like to take your education up a notch, Drumeo is the perfect next step -- and you’ll get a
                    free 30-day trial when you click any of the big green buttons on this page.</p>
            </div>
        </div>
    </section>
@endsection

@section('final')
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="content-section text-center px-4 lg:px-6 customize trial" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/sales/sub-options-bg.jpg);">
        <div class="container mx-auto">
            <img class="h-7 md:h-9 lg:h-14 mb-4" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
            <br>
            <h2><strong>Start Your Free 30 Day <br class="hide-for-medium">Trial To Drumeo</strong></h2>
            <h4 class="my-3 max-w-2xl" style="line-height: 1.4em;"><em>Your Drumeo free trial lasts for 30 days. You'll get access to everything in our members area for a full-week, and after your trial ends you'll simply continue at the monthly rate of $30/month, which is less than $1 per day.
                    <br><br>
                    And don't worry, you can cancel anytime before you are billed by <a class="text-white" href="{{ get_musora_brand_base_url() }}/contact">contact us</a> - or you can keep using Drumeo risk-free for another three months, thanks to our 90-day money back guarantee!</em></h4>

            <div class="text-3xl md:text-4xl text-shadow-4">
                <i class="mx-6 md:mx-12 fal fa-chevron-down animated infinite pulse"></i>
                <i class="mx-6 md:mx-12 fal fa-chevron-down animated delay-1s infinite pulse"></i>
                <i class="mx-6 md:mx-12 fal fa-chevron-down animated delay-2s infinite pulse"></i>
            </div>

            <a class="join" href="/ecommerce/add-to-cart?products[DLM-Trial-Drummers-Toolbox-1-month]=1&locked=true">Click Here To Get Started &raquo;</a><br>

            <div class="inline-block w-full px-3 md:px-4 my-5 text-light-navy">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-light-navy" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>
@stop
