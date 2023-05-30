<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {!! \App\Analytics\Tracker::headTop() !!}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">
        {!! \App\Analytics\Tracker::trackPageView() !!}
        <title>Page Not Found | Musora</title>

        <script defer src="https://pro.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-8nTbev/iV1sg3ESYOAkRPRDMDa5s0sknqroAe9z4DiM+WDr1i/VKi5xLWsn87Car" crossorigin="anonymous"></script>
        <link href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css" rel="stylesheet">
        @include('partials._fonts')
        @include('partials._favicons')
        <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">

        @yield('styles')
        {!! \App\Analytics\Tracker::headBottom() !!}
    </head>

    <body class="tw-text-white tw-flex
                @if($brand == 'drumeo')
                    tw-bg-drumeo
                @elseif($brand == 'pianote')
                     tw-bg-pianote
                @elseif($brand == 'guitareo')
                     tw-bg-guitareo
                @elseif($brand == 'singeo')
                     tw-bg-singeo
                @else
                     tw-bg-[#000C17]
                 @endif
     ">
        <div class="tw-flex-1 tw-flex tw-flex-col tw-items-center tw-justify-center">
            <div class="tw-text-center tw-max-w-md tw-px-6 md:tw-px-0 md:tw-max-w-full">
                <img alt="404 - Not Found" class="w-full md:tw-h-60 lg:tw-h-72 tw-mx-auto"
                    @if($brand == 'drumeo')
                        src="https://dmmior4id2ysr.cloudfront.net/assets/images/drumeo-404.svg"
                    @elseif($brand == 'pianote')
                        src="https://dmmior4id2ysr.cloudfront.net/assets/images/pianote-404.svg"
                    @elseif($brand == 'guitareo')
                        src="https://dmmior4id2ysr.cloudfront.net/assets/images/guitareo-404.svg"
                    @else
                        src="https://dmmior4id2ysr.cloudfront.net/logos/404_musora_logo.png"
                    @endif
                >
                <div class="tw-mb-2 tw-text-xl md:tw-text-2xl lg:tw-text-3xl">
                    @if($brand == 'drumeo')
                        Oops, this link is lost in your hardware case.
                    @elseif($brand == 'pianote')
                        Oops, this link is lost in your piano bench.
                    @elseif($brand == 'guitareo')
                        Oops, this link is lost in your guitar case.
                    @elseif($brand == 'singeo')
                        Oops, look like this link hit the wrong note.
                    @else
                        Oops, this link is lost in your stack of notes.
                    @endif
                </div>
                <div class="tw-font-normal tw-mb-3 md:tw-mb-6 tw-text-sm md:tw-text- tw-text-[#E4E4E7]">The page you're looking for doesn't exist.</div>
                <button onclick="history.back()" class="tw-btn-primary tw-bg-white tw-text-black tw-mb-3 md:tw-mb-4">Go Back</button>
                <p class="tw-text-sm md:tw-text-base tw-text-[#E4E4E7]">
                    Go back or <a href="https://www.musora.com/contact"><u class="tw-text-sm md:tw-text-base">contact us</u></a>
                </p>
            </div>
        </div>
    </body>
</html>
