@extends('pianote.lead-gen.lead-gen-layout-tw', [
    'appTailwind' => true,
])

@section('global-head')
    @parent
    <title>The Pianote Digital Christmas Songbook | Pianote</title>
    <meta property="og:title" content="The Pianote Digital Christmas Songbook">
    <meta name="description" content="Christmas classics to make your holiday season extra special. Presented in original and simplified arrangements.">
    <meta property="og:description" content="Christmas classics to make your holiday season extra special. Presented in original and simplified arrangements.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">

   <style>
    @media only screen and (min-width:64em) {
        ol {
            column-count: 2;
        }
    }
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])

    <header class="text-white px-5 sm:px-6 pt-96 pb-10 sm:py-20 lg:py-36 relative" style="background-color:#0f5e8a;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/header-m.png')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/header.jpg')"></div>
        <div class="container max-w-4xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-6/12 text-center lg:text-left">
                    <img class="h-24 lg:h-36 lg:-ml-5 mx-0 pl-2 sm:pl-3" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/christmas-songbook-logo-left.png">
                    <p class="leading-normal my-4 sm:my-6 pl-2 sm:pl-3">Play 10 of the most beautiful and popular Christmas classics.</p>
                    <p class="leading-normal my-4 sm:my-6 pl-2 sm:pl-3"><strong>Enter your email address to get your FREE E-Book instantly.</strong></p>
                   @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Digital Christmas Songbook',
                            "formId" => "Pianote - Engagement - Trigger - Digital Christmas Songbook - Web Form",
                    "buttonText" => "Get my book",
                    "stacked" => true,
                    "nameInput" => true,
                    'inputBorder' => '1px solid #CCC',
                ])
                </div>
            </div>
        </div>
    </header>
    <section class="text-left px-5 sm:px-6 py-12 sm:py-10 lg:py-14 relative" style="background:#F1F7FE;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/song-list-bg-m.png')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/song-list-bg.jpg')"></div>
        <div class="container max-w-6xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-start lg:items-center">
                <div class="w-full sm:w-1/2 mb-5 sm:mb-0 sm:pr-10 lg:pr-12 lg:pl-4">
                    <h4 class="leading-tight text-dull-navy"><strong>All Your Favorites</strong></h4>
                    <img class="h-8 sm:h-9 lg:h-11 mt-1 mb-4 sm:mb-6" alt="In One Book." src="https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/in-one-book.png">
                     <p class="leading-normal">
                        Every year we find comfort and joy in the beautiful sounds of Christmas.
                        <br><br>
                        And now you can create your own beautiful holiday sounds with The Pianote Christmas Songbook.
                        <br><br>
                        You’ll find 10 favorite Christmas songs arranged specifically for solo piano.
                        <br><br>
                        Whether you like to play the full score note for note or experiment with a bit of improvisation to add your own flavor, you’ll be able to play beloved holiday songs for your loved ones to sing along with.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 sm:pl-5">
                <p class="leading-normal mb-3 sm:mb-5 text-dull-navy"><strong>Here’s the full list:</strong></p>
                    <ol class="pl-6 list-decimal text-dull-navy" style="column-gap: 20px;">
                        <li class="leading-none mb-3">Away in a Manger</li>
                        <li class="leading-none mb-3">Carol of the Bells</li>
                        <li class="leading-none mb-3">Dance of the Sugar Plum Fairy</li>
                        <li class="leading-none mb-3">God Rest Ye Merry Gentlemen</li>
                        <li class="leading-none mb-3">Joy to the World</li>
                        <li class="leading-none mb-3">O Christmas Tree</li>
                        <li class="leading-none mb-3">O Holy Night</li>
                        <li class="leading-none mb-3">Silent Night</li>
                        <li class="leading-none mb-3">The First Noel</li>
                        <li class="leading-none mb-3">We Wish You a Merry Christmas</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>

    <section class="text-center text-white pt-10 sm:pt-14 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/sample-bg.jpg');">
        <h3 class="leading-tight"><strong>Take A Look Inside.</strong></h3>
        <p class="leading-normal mt-1 sm:mt-2 mb-4 sm:mb-5"><i class="fa-light fa-arrow-turn-down fa-flip-horizontal mr-1 relative" style="bottom:-7px"></i> <em>Click to see inside the book!</em> <i class="fa-light fa-arrow-turn-down ml-1 relative" style="bottom:-7px"></i></p>
        <a target="_blank" href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/christmas-songbook/preview-christmas-songbook.pdf" class="relative">
            <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/piano-m.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/piano.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </a>
    </section>

    <section class="text-white px-5 sm:px-6 pt-96 pb-10 sm:py-20 lg:py-36 relative" style="background-color:#0f5e8a;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/header-m.png')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/header.jpg')"></div>
        <div class="container max-w-4xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-6/12 text-center lg:text-left">
                    <img class="h-24 lg:h-36 lg:-ml-5 mx-0" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/christmas-songbook-logo-left.png">
                    <p class="leading-normal my-4 sm:my-6 pl-2 sm:pl-3">Play 10 of the most beautiful and popular Christmas classics.</p>
                    <p class="leading-normal my-4 sm:my-6 pl-2 sm:pl-3"><strong>Enter your email address to get your FREE E-Book instantly.</strong></p>
                    @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Digital Christmas Songbook',
                            "formId" => "Pianote - Engagement - Trigger - Digital Christmas Songbook - Web Form2",
                    "buttonText" => "Get my book",
                    "stacked" => true,
                    "nameInput" => true,
                    'inputBorder' => '1px solid #CCC',
                ])
                </div>
            </div>
        </div>
    </section>
    <section class="text-white px-4 sm:px-6 py-8 sm:py-12 text-center" style="background: #012c41;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921" class="text-pianote">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605" class="text-pianote">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>


    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

@stop
