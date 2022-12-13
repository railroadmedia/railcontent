@extends('members.layout', ["hideNav" => true])

@section('meta')
    @parent
    <title>Join Pianote</title>
@stop()

@section('styles')
    @parent
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>

    <style>
        body {
            padding-top:0;
        }
    </style>
    <style>
        .shipping-delay .delay-bar {
            background:#e3e3e3;
            padding:10px;
            cursor:pointer;
        }

        .shipping-delay .delay-bar p {
            font:400 13px/1.4em 'Open Sans';
            margin:0 auto;
        }

        .shipping-delay .delay-bar p a {
            color:inherit;
            display:inline-block;
        }

        .shipping-delay .delay-bar p a:hover {
            text-decoration:underline;
        }

        .shipping-delay .info-wrap {
            display:none;
            opacity:0;
            transition:all .3s;
            position:absolute;
            top:15px;
            left:50%;
            z-index:98;
            background:#f5f5f5;
            transform:translate(-50%, 0);
            padding:20px;
            box-shadow:0 0 15px hsla(0, 0%, 0%, 0.34);
            border-radius:7px;
            font:400 13px/1.4em 'Open Sans';
            width:98%;
            max-width:700px;
        }

        .shipping-delay .info-wrap h3 {
            font-size:15px;
            margin:0 auto 5px;
        }


        .shipping-delay .info-wrap.active {
            display:block;
            opacity:1;
        }

        .shipping-delay .info-wrap .close-modal {
            cursor:pointer;
            z-index:99;
            opacity:0.8;
            position:absolute;
            margin:0;
            line-height:1em;
            text-align:center;
            display:inline-block;
            outline:none;
            top:7px;
            right:7px;
            font-size:20px;
            width:20px;
        }
        .shipping-delay .delay-overlay {
            position:absolute;
            top:40px;
            height:calc(100% - 40px);
            width:100%;
            background:rgba(0, 0, 0, .2);
            z-index:98;
            visibility:hidden;
            opacity:0;
            transition:all .1s linear;
        }
        .shipping-delay .delay-overlay.active {
            visibility:visible;
            opacity:1;
        }

        .shipping-delay .info-wrap li {
            margin:0 auto 15px;
        }

        @media (min-width: 40em) {
            .shipping-delay .delay-bar p {
                font-size:14px;
            }
            .shipping-delay .info-wrap {
                font-size:14px;
                padding:50px;
            }

            .shipping-delay .info-wrap h3 {
                font-size:16px;
            }

            .shipping-delay .info-wrap .close-modal {
                top:10px;
                right:10px;
                font-size:25px;
                width:25px;
            }
            .shipping-delay .delay-overlay {
                top:56px;
                height:calc(100% - 56px);
            }
        }
    </style>
@stop()

@section('content')
    <header id="nav" class="bg-black-1 flex flex-row" style="background-color:#00162a;position: relative;padding: 7px 10px;">
        <a href="/" class="logo flex flex-column align-center ph-1" style="max-width:144px;">
            <img src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png">
        </a>
        <div class="flex flex-column align-h-right align-v-center ph-2">
            <a href="/shop" class="btn text-white ba-white-2 collapse-150">Shop</a>
        </div>
    </header>

    <div class="shipping-delay">
        <div class="delay-bar text-center">
            <div class="container">
                <p><a class="shipping-trigger"><i class="fas fa-truck"></i> <strong>FREE SHIPPING OVER $100</strong></a> &nbsp; &nbsp;
                    <a class="timing-trigger"><i class="fas fa-clock"></i> <strong>SHIPPING TIMELINES & SAFETY</strong></a></p>
            </div>
        </div>

        <div class="delay-overlay">
            <div class="info-wrap shipping-info" >
                <i class="fas fa-times close-modal"></i>
                <h3><strong>Free Shipping Over $100</strong></h3>
                <p>Spend over $100 and you'll unlock free worldwide shipping on any order.</p>
            </div>
            <div class="info-wrap timing-info" >
                <i class="fas fa-times close-modal"></i>
                <h3><strong>Shipping Timelines & Safety</strong></h3>
                <p class="mb-1">In these unprecedented and challenging times, we are doing our best to support pianists with online lessons and practice tools while staying committed to the safety and wellbeing of our team: encouraging staff to work from home and practice social distancing.
                    <br><br>
                    Right now there are two ways the COVID-19 crisis might impact your Pianote order:</p>
                <ul>
                    <li><strong>Shipping Delays:</strong> There are shipping delays worldwide and shipping challenges in some countries. During checkout for any physical goods, if your location is experiencing a shipping suspension due to COVID-19, we’ve added red text to notify you of this impact. However, even if you don’t see this warning, we cannot ensure typical shipping timelines due to delays that are outside of our control.</li>
                    <li><strong>Support Requests:</strong> With more pianists staying at home, there are more people practicing than ever before. And we’re SO excited about this! However, this also means we’re getting more requests for personalized lesson plans, student reviews, technology questions, and transactional questions. We’re continuing to help you the best we can, but please be patient if you experience any delays. (Our typical response time is within less than one hour during business hours.)</li>
                </ul>
                <p>We thank you for your patience and understanding. We wouldn’t exist without you, our students, and we’re so thankful for your continued support.
                    <br><br>
                    Have Fun Playing Piano,
                    <br>
                    - Lisa Witt<br><br>
                    <strong>Have questions?</strong> <a target="_blank" class="text-pianote" href="https://help.pianote.com/"><u>Click here for our FAQs and answers.</u></a></p>
            </div>
        </div>
    </div>

    <div class="container order-form mv-3">
        <transition appear name="fade">
            <order-form
                theme-color="pianote"
                brand="pianote"
                :cart="{{ json_encode($cart) }}"
                cart-data-url='{{ get_musora_brand_base_url() }}'
                :billing-address="{{ json_encode($billingAddress) }}"
                :shipping-address="{{ json_encode($shippingAddress) }}"
                :user="{{ json_encode($user) }}"
                :login-url="{{ json_encode($loginUrl) }}"
                :logout-url="{{ json_encode($logoutUrl) }}"
                :stripe-publishable-key="{{ json_encode($stripePublishableKey) }}"
                :countries="{{ $countries }}"
                :banned-countries="{{ $bannedCountries }}"
                :provinces="{{ $provinces }}"
                :bonuses="{{ $bonuses }}"
                :payment-methods="{{ $paymentMethodsJson }}"
                :shipping-addresses = "{{ $shippingAddressesJson }}"
                :all-membership-product-skus = "{{ json_encode($allMembershipProductSkus) }}"
                :lifetime-membership-product-skus = "{{ json_encode($lifetimeMembershipProductSkus) }}"
                :memberships-number-of-free-days= "{{ json_encode($membershipsNumberOfFreeDays) }}"
            >
                <div class="widescreen skeleton-loader corners-3"></div>
            </order-form>
        </transition>
    </div>


    <div class="container fluid bg-grey-4">
        <div class="container collapsed-h">
            <div class="flex flex-row flex-wrap text-center features">
                <div class="flex flex-column xs-12 sm-4 align-center pa-3">
                    <i
                            class="fal fa-mobile text-white mb-2"
                            style="font-size:40px;"
                    ></i>

                    <p class="tiny font-bold text-white">
                        We're always here to help
                    </p>
                    <p class="x-tiny text-white">
                        <a target="_blank" class="text-white" href="https://help.pianote.com/">See our FAQs & answers</a>, or<br>
                        <a target="_blank" class="text-white" href="{{ get_musora_brand_base_url() }}/contact">click here to contact us directly</a>.
                    </p>
                </div>

                <div class="flex flex-column xs-12 sm-4 display pa-3 align-center">
                    <img
                            src="https://dmmior4id2ysr.cloudfront.net/icons/icon-trusted.png"
                            style="height:40px;width:auto;"
                    >

                    <p class="tiny font-bold text-white mt-2">
                        Your Information is Secure
                    </p>
                    <p class="x-tiny text-white">
                        This page is securely encrypted <br>
                        with world-class SSL protection.
                    </p>
                </div>

                <div class="flex flex-column xs-12 sm-4 pa-3 pv-2 align-center">
                    <i
                            class="fal fa-check-circle text-white mb-2"
                            style="font-size:40px;"
                    ></i>
                    <p class="tiny font-bold text-white">
                        100% Money Back Guarantee
                    </p>
                    <p class="x-tiny text-white">
                        Order risk-free with our 90-day, <br>
                        100% money back guarantee.
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('inject-components')
    @parent

    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    <script>
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.shipping-trigger')) return;

            document.querySelector('.shipping-info').classList.add("active");
            document.querySelector('.delay-overlay').classList.add("active");

        }, false);
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.timing-trigger')) return;

            document.querySelector('.timing-info').classList.add("active");
            document.querySelector('.delay-overlay').classList.add("active");

        }, false);
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.close-modal')) return;

            document.querySelector('.shipping-info').classList.remove("active");
            document.querySelector('.timing-info').classList.remove("active");
            document.querySelector('.delay-overlay').classList.remove("active");

        }, false);
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.delay-overlay')) return;

            document.querySelector('.shipping-info').classList.remove("active");
            document.querySelector('.timing-info').classList.remove("active");
            document.querySelector('.delay-overlay').classList.remove("active");

        }, false);
    </script>
@endsection
