@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | The Free Stuff</title>
    <meta property="og:title" content="Musora | The Free Stuff">

    <meta name="description" content="Sign up to get access to FREE lessons, giveaways, exclusive discounts and any other cool stuff we do.">
    <meta property="og:description" content="Sign up to get access to FREE lessons, giveaways, exclusive discounts and any other cool stuff we do.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/membership/homepage/2023/share-image3.jpg">

    <style>
        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }
    </style>
@endsection


<!-- Main -->
@section('layout-body')

    <div class="container mx-auto max-w-7xl px-4 md:px-10">
        <header class="py-10 md:py-20">
            <h1 class="text-3xl md:text-5xl lg:text-7xl"><strong>Free Resources</strong></h1>
            <p class="pb-10">Explore blogs, newsletters, and free tools for insights and productivity.</p>
            <h5 class="border-y border-y-black py-4 uppercase tracking-widest font-bold">Free Video Lessons</h5>
        </header>
    
              @php
            $benefits = [
                ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/lead-gen/youtube/item-1.jpg', 'title' => 'Getting Started On The Drums', 'link' => 'https://www.drumeo.com/getting-started/lessons'],
                ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/item-2.png', 'title' => 'Getting Started On The Piano', 'link' => 'https://www.pianote.com/getting-started-on-the-piano/lessons'],
                ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/lead-gen/youtube/singeo.jpg', 'title' => 'Improve Any Voice', 'link' => 'https://www.singeo.com/improve-any-voice/lessons'],
                ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/lead-gen/youtube/guitar.png', 'title' => 'Getting Started On The Acoustic Guitar', 'link' => 'https://www.guitareo.com/free-acoustic-guitar-lessons/lessons'],
            ];
        @endphp
        
        <div class="grid grid-col-1 md:grid-cols-2 gap-2 md:gap-5 lg:gap-8 pb-10 md:pb-20">
            @foreach ($benefits as $benefit)
                <div class="text-left">
                    <a href="{{ $benefit['link'] }}" target="_blank">
                        <img src="{{ $benefit['image'] }}" alt="{{ $benefit['title'] }}" class="mx-auto rounded-lg transform hover:scale-105 transition-transform duration-300">
                        <h4 class="mb-6 md:mb-0 mt-2 capitalized font-bold">{{ $benefit['title'] }}</h4>
                    </a>
                </div>
            @endforeach
        </div>
    
        <section class="px-5 sm:px-6 py-8 sm:py-16 text-white rounded-3xl" style="background-color:#0C1523;">
            <div class="flex flex-col lg:flex-row items-center lg:items-start">
                <div class="w-full lg:w-5/12 px-6 text-center">
                    <img class="w-64 h-64 rounded-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/musora/lead-gen/youtube/item-1.jpg" alt="Musora Team Image">
                </div>
                <div class="w-full md:w-10/12 lg:w-6/12 xl:w-5/12 text-center lg:text-left">
                    <h3 class="uppercase pt-10 leading-tight lg:pl-6">
                        <strong>
                            ENTER TO Win A FREE GUITAR 
                            <br class="block lg:hidden" />
                            SIGNED BY PEACH PIT
                        </strong>
                    </h3>
                    <p class="tracking-tight pb-4 lg:pb-6 italic lg:pl-6 font-light">
                        Win a signed Fender Telecaster (value of $1200) signed by the Peach Pit crew.
                    </p>
                    <div class="w-full sm:w-10/12 lg:w-full mx-auto">
                        @include("_partials.components.forms.sign-up-form-options", [
                            "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Today in Music History',
                            "formId" => "Musora - Engagement - Trigger - Today in Music History - WebForm", //TODO: Update form ID
                            "buttonText" => "ENTER NOW",
                            'stacked' => false,
                            "checkboxTitle" => "Preferred Instrument",
                            "minimalForm" => true,
                            "buttonColor" => "bg-musora text-black",
                        ])
                    </div>
                </div>
            </div>
        </section>
          <section class="px-5 sm:px-6 py-6 text-black rounded-3xl my-10 lg:my-20 bg-musora border-2 border-black">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="w-full lg:w-7/12 text-center px-6 flex jusitfy-center flex-col items-center">
                    <h1 class="capitalize leading-tight"><strong>The ultimate music  <br/> lessons experience  <br/> at a special price</strong></h1>
                    <p class="tracking-tight py-4 lg:py-6">
                        An exclusive discount for our YouTube community.
                    </p>
                </div>
                <div class="w-full md:w-1/2 lg:w-5/12 xl:w-4/12 text-center max-w-[400px]">
                @php
                    $annualLink = '/ecommerce/add-to-cart?products=annual-plan'; //TODO: Update link
                    $points = [
                        '<strong>Learn piano, guitar, drums, & singing.</strong>',
                        '<strong>300+ popular songs.</strong>',
                        '<strong>Unlimited personal support.</strong>',
                        'Join a community of ' .  number_format(Prices::$students)  . ' students.',
                        '90-day money-back guarantee.',
                        'Cancel anytime.'
                    ];
                @endphp
                
                <div class="w-full px-2 md:px-3 mb-4 md:mb-0 relative text-center">
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-black text-musora border border-black">EXCLUSIVE OFFER</p>
                    <a href="{{ $annualLink }}" class="text-black overflow-hidden rounded-2xl block mx-auto group border-2 border-black" aria-label="Annual Plan">
                        <div class="bg-white px-3 py-6 md:py-9">
                            <h2 class="mb-2 text-3xl lg:text-4xl"><strong>Annual</strong></h2>
                            <h4 class="inline-block leading-tight">
                                <span class="line-through opacity-60">$240</span>
                                <strong class="text-4xl">$180</strong>
                            </h4>
                            <p class="text-sm"><em>Save $60!</em></p>
                            <button class="my-5 py-2 bg-musora text-black w-full rounded-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px] uppercase font-medium font-bebas text-xl" role="button" tabindex="0">TRY FOR FREE FOR 7 DAYS</button>
                            @foreach ($points as $point)
                                <p class="text-sm mb-1.5">{!! $point !!}</p>
                            @endforeach
                        </div>
                    </a>
                </div>
                </div>
            </div>
        </section>
     <section class="px-5 sm:px-6 sm:pb-16 lg:pb-24 text-black">
        <div class="flex flex-col lg:flex-row gap-16 md:gap-8 justify-between items-start relative border-l-2 border-black">
            <div class="flex flex-col justify-evenly gap-4 w-full lg:w-5/12">
                <h5 class="border-y border-y-black py-4 uppercase tracking-widest font-bold">YouTube Channels</h5>
                <div class="flex flex-col space-y-4">
                    <a href="https://youtube.com/musoraofficial" class="bg-musora text-white font-bold py-16 lg:py-14 rounded-2xl text-center">
                        <div class="relative">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/logo-light.svg" alt="Musora Logo" class="h-6">
                        </div>
                    </a>
                    <a href="https://youtube.com/drumeoofficial" class="bg-drumeo text-white font-bold py-20 md:py-14 rounded-2xl text-center">
                        <div class="relative">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/drumeo.svg" alt="Drumeo Logo" class="h-8">
                        </div>
                    </a>
                    <a href="https://youtube.com/pianoteofficial" class="bg-pianote text-white font-bold py-20 md:py-14 rounded-2xl text-center">
                        <div class="relative">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/pianote.svg" alt="Pianote Logo" class="h-8">
                        </div>
                    </a>
                </div>
            </div>
    
            <div class="flex flex-col gap-2 lg:w-6/12">
                <h5 class="border-y border-y-black py-4 uppercase tracking-widest font-bold mb-2">Newsletters</h5>
                <div class="space-y-4">
                    <a href="/playlist" class="bg-cover bg-center">
                        <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/musora-playlist.png" alt="Musora Playlists" class="rounded-lg">
                    </a>
                    <a href="/history" class="bg-cover bg-center">
                        <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/history.png" alt="Today in Music History" class="rounded-lg">
                    </a>
                </div>
            </div>
        </div>
    </section>

    </div>

@stop