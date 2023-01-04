@extends('pianote.sales.standard-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Learn Piano with Step by Step Online Lessons | Pianote</title>
    <meta property="og:title" content="Pianote - The Better Way To Learn Piano">
    <meta property="og:url" content="https://www.pianote.com/">

    {{ App\Analytics\Tracker::trackProductDetailsImpression('PIANOTE-MEMBERSHIP-1-YEAR') }}
@endsection

@section('promo-banner')

    <style>
        .coach-trial-banner .avatar {
            max-width: 150px;
        }
        @media (min-width: 40em) {
            .coach-trial-banner .avatar {
                max-width: 190px;
            }
        }
        @media (min-width: 64em) {
            .coach-trial-banner .avatar {
                max-width: 250px;
            }
        }
    </style>
    <div class="coach-trial-banner text-white px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="sm:flex mx-auto items-center text-center" style="max-width: 890px;">
                <img class="w-full avatar mx-auto mb-3 md:mb-0" src="https://drumeo-assets.s3.amazonaws.com/sales/2021/musora-brands.png">
                <div class="md:text-left px-2 md:pl-8 lg:pl-10">
                    <h6 class="leading-normal"><strong>Musora Students</strong> To thank you for already being a Musora student, you’ll save {{ round(100 - (100 * (147 / Prices::$plusSubscriptionAnnualFull))) }}% when you add a Pianote membership to your existing account. (Normally ${{ Prices::$plusSubscriptionAnnualFull }} per year, yours for just $147.)</h6>
                </div>
            </div>
        </div>
    </div>
    <a href="#customize-anchor" style="background:#0c1429;"
            class="promo-banner anchor-slide block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap text-white bg-cover bg-center shadow-md py-1 hover:text-gray-100 z-0 mx-auto -mt-10 text-xs">
        <div class="container mx-auto">
            <div class="text text-center">
                <p class="leading-tight uppercase"><strong>Musora Students Join Pianote<br> For Just <s class="opacity-60">${{ Prices::$plusSubscriptionAnnualFull }}</s> $147 per year</strong></p>
            </div>
        </div>
    </a>
@endsection

@section('comparison')
    <td><s>${{ Prices::$plusSubscriptionAnnualFull }}</s> <strong>$147</strong><br>PER YEAR</td>
@endsection

@section('final')
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="content-section grey text-center customize trial" style="background-color:#000;">
        <div class="container mx-auto">
            <img class="h-5 md:h-7 lg:h-10 mb-2" src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png">
            <h1 class="font-roboto uppercase text-2xl md:text-4xl lg:text-5xl"><strong>{{ round(100 - (100 * (147 / Prices::$plusSubscriptionAnnualFull))) }}%-OFF MUSORA DISCOUNT</strong></h1>
            <h2 class="mt-4 md:mt-7"><strong>Join Pianote for just<br class="inline md:hidden"> <s class="opacity-60">${{ Prices::$plusSubscriptionAnnualFull }}</s> <span class="text-pianote">$147</span> per year.</strong></h2>
            <h5 class="mt-3 mb-4 md:mb-7 text-navy"><em>(90-Day Money Back Guarantee.)</em></h5>
            <a class="join methodcta" href="/ecommerce/add-to-cart?products%5BPIANOTE-MEMBERSHIP-1-YEAR%5D=1&promo-code=student-discount&redirect=%2Forder&locked=true">Get Started &raquo;</a>
            <p class="text-navy my-5"><em>Your discounted rate is conditional on your continuation as a multi-platform student. If you  <br class="hidden md:inline">
                    cancel your other membership, then you will no longer be eligible for your Pianote discount.</em></p>
        </div>
    </section>
    <section class="content-section text-center" style="background: #0c1429;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
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
@endsection
