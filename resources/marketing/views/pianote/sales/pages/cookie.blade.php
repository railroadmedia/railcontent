@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Cookie Policy | Pianote</title>
    <meta property="og:title" content="Cookie Policy">
    <meta name="description" content="When you visit or access Musora Media, Inc websites, we may use web beacons, cookies, pixel tags, scripts, tags, API and other technologies.">
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-pianote.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/cookie/">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">

    <style>
        h1, h2, h3, p {
            font-family:"Open Sans", sans-serif;
        }
    </style>
@stop

@section('global-body')
    @include('pianote._partials._nav', [
        "subscriptionVersion" => true
    ])

    <div class="hero-header px-4 py-12 md:py-20 lg:py-32 bg-black bg-center bg-cover" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/sales/customize-bg.jpg);">
        <div class="container mx-auto">
            <h1 class="mx-auto text-center text-white text-2xl md:text-4xl font-bold">Cookie Policy</h1>
            <p class="text-sm text-center text-white opacity-75"><em>Last updated: January 2021</em></p>
        </div>
    </div>
    <div class="container mx-auto py-12 px-3 md:px-4">
        <p class="py-2">When you visit or access Musora Media, Inc websites, which include drumeo.com, pianote.com, guitareo.com and any other product or service that links to this policy, we may use web beacons, cookies, pixel tags, scripts, tags, API and other technologies (“Tracking Technologies”). This is explained in this policy (“Cookie Policy”) which is a part of our <a class="text-blue-600" href="/privacy">Privacy Policy</a>.</p>

        <p class="py-2">Tracking Technologies allow us to automatically collect information about you and your online behavior in order to enhance your navigation on our websites, improve our performance and customize your experience on it. We also use this information to collect statistics about the usage of our service, perform analytics, serve ads, and to administer services to our users, customers and partners.</p>

        <h3 class="font-bold md:text-2xl mt-10 mb-4">What are cookies?</h3>

        <p class="py-2">Cookies are a commonly used tracking technology, comprised of small text files (composed only of letters and numbers) that a web server places on your computer or mobile device when you visit a webpage. When used, the cookie can help make our websites more user-friendly, for example by remembering your language preferences and settings. You can find more information about cookies at <a class="text-blue-600" target="_blank" href="https://www.aboutcookies.org">www.aboutcookies.org</a>.</p>

        <p class="py-2">Cookies are widely used in order to make websites work in an efficient way. The use of cookies allows you to navigate between pages efficiently. Cookies remember your preferences, and make the interaction between you and our websites smoother and more efficient.</p>

        <h3 class="font-bold md:text-2xl mt-10 mb-4">Cookie settings</h3>

        <p class="py-2">You can decide whether or not to accept Cookies. You may opt out of any non-essential Cookies by adjusting your Cookie Settings. Most web browsers automatically accept cookies, but also usually allow you to modify your settings to disable or reject cookies.  If you delete your cookies or set your web browser to decline cookies, some features of the website may not work or may not work as designed and you may have to manually adjust some preferences every time you visit a site. We recommend that you leave cookies active, because they enable you to take advantage of the website in its entirety.</p>

        <p class="py-2">You can usually find these settings in the Options or Preferences menu of your browser; links to instructions provided by several of the most common browsers are below:</p>

        <p class="py-2"> <a class="text-blue-600" target="_blank" href="https://support.google.com/chrome/answer/95647?hl=en">Cookie settings in Google Chrome</a><br>
            <a class="text-blue-600" target="_blank" href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer">Cookie settings in Firefox</a><br>
            <a class="text-blue-600" target="_blank" href="https://support.microsoft.com/en-us/kb/260971">Cookie settings in Internet Explorer</a><br>
            <a class="text-blue-600" target="_blank" href="https://support.apple.com/en-ca/guide/safari/sfri11471/mac">Cookie settings in Safari (Web)</a><br>
            <a class="text-blue-600" target="_blank" href="https://support.apple.com/en-us/HT201265">Cookie settings in Safari (Mobile)</a><br>
            <a class="text-blue-600" target="_blank" href="http://support.google.com/ics/nexus/bin/answer.py?hl=en&answer=2425067">Cookie settings in Android Browser</a></p>


        {{-- Contact Us --}}
        <h3 class="font-bold md:text-2xl mt-10 mb-4">Contact Us</h3>

        <p class="py-2">If you have any questions about these Terms, please <a href="{{ get_musora_brand_base_url() }}/contact" class="text-blue-600">contact us</a>.</p>
    </div>


    @include('pianote._partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
