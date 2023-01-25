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
                <div class="md:text-left px-2 md:pl-7 lg:pl-10">
                    <h3 class="text-coaches"><strong>SPECIAL OFFER:</strong> YOUR FIRST<br class="inline sm:hidden"> MONTH IS FREE!</h3>
                    <h6 class="leading-normal my-3 md:my-5">
                        Thanks for taking the DrumeCOACHES quiz! Now it’s time to join your perfect coach inside Drumeo.
                        <br><br>
                        At the bottom of this page, you’ll get an exclusive 30-day trial to Drumeo -- where you can try out ALL the coaching sessions, lessons, and song breakdowns inside the members’ area. Click below to get started.
                    </h6>
                    <a href="/choose-your-trial-month/" class="join smaller">START MY FREE TRIAL</a>
                </div>
            </div>
        </div>
    </div>
@endsection
