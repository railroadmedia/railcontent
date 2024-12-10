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
                <img class="avatar mx-auto mb-3 sm:mb-0 w-36 md:w-48 lg:w-72" src="https://dpwjbsxqtam5n.cloudfront.net/promos/february/earthworks-logo.png">
                <div class="md:text-left px-2 md:pl-7 lg:pl-10">
                    <h2 class="uppercase"><strong><strong>SPECIAL OFFER:</strong> YOUR FIRST<br class="inline sm:hidden"> MONTH IS FREE!</strong></h2>
                    <h6 class="leading-normal my-3 md:my-5"><em>New Drummers Start Here</em> covers your first 90 days on the drums. But what next? Take Drumeo for a test drive with 30 free days of access. It’s the perfect way to build on your new skills and keep your progress going. <em>This page gives you an exclusive 30-day free trial with access to everything Drumeo has to offer.</em></h6>
                    <a href="/choose-your-trial-month/" class="join smaller">START MY FREE TRIAL</a>
                </div>
            </div>
        </div>
    </div>
@endsection
