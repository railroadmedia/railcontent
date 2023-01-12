@extends('drumeo.sales.standard-layout')

@section('meta')
    <title>Drumeo | The Ultimate Online Drum Lesson Experience</title>
    <meta property="og:title" content="Drumeo | Learn the drums with your favorite drummers.">
    <meta property="og:url" content="https://www.drumeo.com/">
@endsection

@section('promo-banner')
    <div class="coach-trial-banner text-white text-center px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="px-2 mx-auto" style="max-width: 650px;">
                <h2 class="text-drumeo"><strong>The ultimate beginner bundle</strong></h2>
                <h6 class="leading-normal my-3 md:my-5">Getting started on the drums has never been easier. With the Ultimate Beginner Bundle, you’ll have everything you need to start your drumming journey. The P4 Practice Pad will give you four unique playing surfaces to get your hands used to all the different feels of a real drum set. Plus, you’ll have a fresh pair of sticks to kick things off! Click the link to get started on the drums the right way!</h6>
                <a href="#customize-anchor" class="join smaller blue anchor-slide">Get Started</a>
            </div>
        </div>
    </div>
@endsection

@section('final')
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="content-section grey text-center customize trial" style="background-color:#000;">
        <div class="container mx-auto">
            <img class="h-7 md:h-9 lg:h-14 mb-4" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
            <br>
            <h2><strong>Improve your drumming <br class="inline lg:hidden">for just <span class="text-blue">${{ round((Prices::$plusSubscriptionAnnual / 52), 2) }}</span> per week.</strong></h2>
            <h5 class="my-2">(Billed annually at ${{ Prices::$plusSubscriptionAnnual }} per year. Cancel anytime.<br class="inline-block lg:hidden"> 90-Day Money Back Guarantee)</h5>
            <br>
            <a class="join" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[practicepad]=1&products[Drumeo-VaterSticks]=1&locked=true">Click Here To Get Started &raquo;</a>


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
