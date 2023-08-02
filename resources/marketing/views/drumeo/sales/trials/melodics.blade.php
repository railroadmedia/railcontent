@extends('drumeo.sales.subscription')

@section('global-head')
    <title>Drumeo Trial</title>
    <meta property="og:title" content="Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/trial/">
    <meta name="robots" content="noindex">
    @parent
@endsection

@section('promo-banner')
    <div class="text-white px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="sm:flex mx-auto items-start text-center" style="max-width: 1050px;">
                <img class="avatar mx-auto mb-3 sm:mb-0 w-36 md:w-48 lg:w-72" src="https://dpwjbsxqtam5n.cloudfront.net/promos/april-fools/melodics.png">
                <div class="md:text-left px-2 md:pl-7 lg:pl-10">
                    <h2 class="uppercase"><strong><strong>SPECIAL OFFER:</strong> YOUR FIRST<br class="inline sm:hidden"> MONTH IS FREE!</strong></h2>
                    <h6 class="leading-normal my-3 md:my-5"><strong>Melodics Drummers:</strong> We love technology. We also think there’s a ton of value in studying with the best drummers in the world and having real support from real teachers. And that’s why Melodics + Drumeo is the perfect combination.
                        <br><br>
                        So we wanted to welcome you with an extended 30-day trial to Drumeo where you’ll get everything you need to reach your drumming goals. Scroll around this page to see what it’s all about — and if you think it looks good, we hope you’ll join us.</h6>
                    <a href="/choose-your-trial-month/" class="join smaller">START MY FREE TRIAL</a>
                </div>
            </div>
        </div>
    </div>
@endsection
