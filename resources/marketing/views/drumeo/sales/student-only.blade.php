@extends('drumeo.sales.standard-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Drumeo | The Ultimate Online Drum Lesson Experience</title>
    <meta property="og:title" content="Drumeo | Learn the drums with your favorite drummers.">
    <meta property="og:url" content="https://www.drumeo.com/">
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
                    <h6 class="leading-normal mb-3"><strong>Musora Students</strong> To thank you for already being a Musora student, you’ll save {{ round(100 - (100 * (197 / Prices::$drumeoEdgeAnnualFull))) }}% when you add a Drumeo membership to your existing account. (Normally ${{ Prices::$drumeoEdgeAnnualFull }} per year, yours for just $197.)</h6>
                    <a class="join blue smaller" href="/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&promo-code=student-discount&locked=true">Get Started &raquo;</a>
                </div>
            </div>
        </div>
    </div>
    <a href="#customize-anchor" class="promo-banner bg-black w-full py-1 mx-auto -mt-10 block z-10 whitespace-nowrap shadow-md overflow-hidden leading-none text-xs transition-colors duration-300 text-center text-white hover:text-gray-50 bg-black text-white">
        <div class="container mx-auto">
            <div class="text text-center">
                <p class="leading-tight uppercase"><strong>Musora Students Join Drumeo<br> For Just <s class="opacity-60">${{ Prices::$drumeoEdgeAnnualFull }}</s> $197 per year</strong></p>
            </div>
        </div>
    </a>
@endsection

@section('comparison')
    <td><s>${{ Prices::$drumeoEdgeAnnualFull }}</s> <strong>$197</strong><br>PER YEAR</td>
@endsection

@section('final')
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="content-section grey text-center customize trial" style="background-color:#000;">
        <div class="container mx-auto">
            <img class="h-5 md:h-7 lg:h-10 mb-2" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
            <h1 class="uppercase text-2xl md:text-4xl lg:text-5xl"><strong>{{ round(100 - (100 * (197 / Prices::$drumeoEdgeAnnualFull))) }}%-OFF MUSORA DISCOUNT</strong></h1>
            <h2 class="mt-4 md:mt-7"><strong>Join Drumeo for just<br class="inline md:hidden"> <s class="opacity-60">${{ Prices::$drumeoEdgeAnnualFull }}</s> <span class="text-drumeo">$197</span> per year.</strong></h2>
            <h5 class="mt-3 mb-4 md:mb-7 text-light-navy"> (90-Day Money Back Guarantee.)</h5>
            <a class="join blue" href="/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&promo-code=student-discount&locked=true">Get Started &raquo;</a>
            <p class="text-light-navy mb-5"><em>Your discounted rate is conditional on your continuation as a multi-platform student. If you  <br class="hidden md:inline">
                    cancel your other membership, then you will no longer be eligible for your Drumeo discount.</em></p>

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
@endsection
