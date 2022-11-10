@extends('guitareo.sales.standard-layout', [
"openVersion" => true
])

@section('meta')
    <meta name="robots" content="noindex">
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:url" content="https://www.guitareo.com"/>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    @parent
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
                    <h6 class="leading-normal"><strong>Musora Students</strong> To thank you for already being a Musora student, you’ll save {{ round(100 - (100 * (77 / GuitareoPrices::$guitareoMembershipAnnualFull))) }}% when you add a Guitareo membership to your existing account. (Normally ${{ GuitareoPrices::$guitareoMembershipAnnualFull }} per year, yours for just $77.)</h6>
                </div>
            </div>
        </div>
    </div>
    <a href="#customize-anchor" class="promo-banner anchor-slide methodcta text-white" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="text text-center">
                <p class="uppercase"><strong>Musora Students Join Guitareo<br> For Just <s class="opacity-60">${{ GuitareoPrices::$guitareoMembershipAnnualFull }}</s> $77 per year</strong></p>
            </div>
        </div>
    </a>
@endsection

@section('comparison')
    <td><s>${{ GuitareoPrices::$guitareoMembershipAnnualFull }}</s> <strong>$77</strong><br>PER YEAR</td>
@endsection

@section('final')
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="content-section relative overflow-hidden text-white grey text-center customize py-8 md:py-12 lg:py-20" style="background-color:#000;">
        <div class="container mx-auto">
            <img class="h-5 md:h-7 lg:h-10 mb-2" src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png">
            <h1 class="tw-font-roboto uppercase text-2xl md:text-4xl lg:text-5xl"><strong>{{ round(100 - (100 * (77 / GuitareoPrices::$guitareoMembershipAnnualFull))) }}%-OFF MUSORA DISCOUNT</strong></h1>
            <h2 class="mt-4 md:mt-7"><strong>Join Guitareo for just<br class="inline md:hidden"> <s class="opacity-60">${{ GuitareoPrices::$guitareoMembershipAnnualFull }}</s> <span class="text-guitareo">$77</span> per year.</strong></h2>
            <h5 class="mt-3 mb-4 md:mb-7 text-navy"> (90-Day Money Back Guarantee.)</h5>
            <a class="join blue methodcta" href="/ecommerce/add-to-cart?products[GUITAREO-1-YEAR-MEMBERSHIP]=1&redirect=/order&promo-code=student-discount&locked=true">Get Started &raquo;</a>
            <p class="text-navy my-5"><em>Your discounted rate is conditional on your continuation as a multi-platform student. If you  <br class="hidden md:inline">
                    cancel your other membership, then you will no longer be eligible for your Guitareo discount.</em></p>

            <div class="credit-cards text-navy float-left px-3 md:px-4 w-full">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <div class="float-left px-3 md:px-4 w-full questions text-navy">
                <p><strong>Any questions?</strong><br class="inline md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
    </section>
@endsection
