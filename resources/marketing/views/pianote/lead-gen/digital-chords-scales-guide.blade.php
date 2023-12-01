@extends('pianote.lead-gen.lead-gen-layout-tw', [
    'appTailwind' => true,
])

@section('meta')
    @parent
    <title>Digital Chords & Scales Guide | Pianote</title>
    <meta property="og:title" content="Digital Chords & Scales Guide | Pianote">

    <meta name="description" content="This comprehensive e-book will help you learn every chord shape, chord variation, and scale in EVERY key.">
    <meta property="og:description" content="This comprehensive e-book will help you learn every chord shape, chord variation, and scale in EVERY key.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/digital-chords-and-scales/master-every-chord-bg.png" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/digital-chords-scales-guide">
@endsection

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        header .disclaimer,
        .final .disclaimer {
            display: none!important;
        }
    </style>
@endsection

@section('page-body')
    <header class="px-4 py-7 sm:py-14 bg-cover bg-center" style="background:linear-gradient(to bottom, #fcfbf9 70%, #f4f1ec);">
        <div class="max-w-6xl mx-auto sm:flex items-center container text-center sm:text-left">
            <div class="w-full sm:w-auto sm:order-1">
                <img
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/digital-chords-and-scales/master-every-chord-bg.png"
                    class="transition-opacity opacity-0" alt="header hero image" loading="lazy" onload="this.classList.remove('opacity-0')"
                />
            </div>
            <div class="w-full sm:w-7/12 lg:w-1/2 sm:pr-5 mx-auto sm:max-w-full flex-shrink-0">
                <div class="px-2 sm:px-3">
                    <img
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/430x0/filters:quality(95)/marketing/pianote/lead-gen/digital-chords-and-scales/Chords-scales-digital-logo.png"
                        class="h-20 sm:h-24 lg:h-28 transition-opacity opacity-0" alt="FWTGF logo" loading="lazy" onload="this.classList.remove('opacity-0')"
                    />
                    <p class="my-4">This comprehensive e-book will help you learn every chord shape, chord variation, and scale in EVERY key.
                        <br><br>It’s the ultimate guide to mastering the building blocks of music on the piano.
                        <br><br><strong class="font-black">Enter your {{--name and--}} email address to get<br class="lg:hidden"> your FREE E-Book instantly.</strong></p>
                </div>
                @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Digital Chords And Scales',
                            "formId" => "Pianote - Engagement - Trigger - Digital Chords And Scales - Web Form",
                    "buttonText" => "Get my book",
                    "stacked" => true,
                ])
            </div>
        </div>
    </header>
    <section class="text-left sm:px-6 pt-8 sm:py-10 lg:py-14 bg-white relative">
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/lead-gen/digital-chords-and-scales/master-every-chord-bg.jpg')"></div>
        <div class="container max-w-5xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-start lg:items-center">
                <div class="w-full sm:w-1/2 px-5 sm:pl-0 sm:pr-10 lg:pr-12">
                    <h4 class="leading-tight mb-4 sm:mb-6"><strong>Master Every Chord.<br> Every Scale. In Every Key.</strong></h4>
                    <p class="leading-normal">Chords and scales are the building blocks of all music.
                        <br><br>This book is your blueprint.
                        <br><br>With this comprehensive 174-page E-Book, you’ll know every chord shape, variation, and scale in EVERY key. Color diagrams make it easy to play any chord even if you can’t read music notation.</p>
                </div>
                <div class="w-full sm:w-1/2 px-5 pt-14 pb-8 sm:py-0 sm:pr-0 sm:pl-5 lg:pl-14 justify-center relative">
                    <h4 class="leading-tight mb-3 sm:mb-5 relative z-10"><strong>You’ll get:</strong></h4>
                    <style>
                        @media only screen and (min-width:64em) {
                            ul {
                                column-count: 2;
                            }
                        }
                    </style>
                    <ul class="ml-6 fa-ul relative z-10" style="column-gap: 20px;">
                        <li class="leading-none mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Major scales</li>
                        <li class="leading-none mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Minor scales (all 3)</li>
                        <li class="leading-none mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Blues scales</li>
                        <li class="leading-none mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Pentatonic scales</li>
                        <li class="leading-none mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Major chords (all inversions)</li>
                        <li class="leading-none mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Minor chords (all inversions)</li>
                        <li class="leading-none mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> 7th chords (all inversions)</li>
                        <li class="leading-none mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Sus chords</li>
                    </ul>
                    <div class="inset-0 absolute z-0 bg-bottom block sm:hidden" style="background-size: 370px;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/750x0/filters:quality(95)/marketing/pianote/lead-gen/digital-chords-and-scales/master-every-chord-bg-m.jpg')"></div>
                </div>
            </div>

        </div>
    </section>
    <section class="text-center px-5 py-10 md:py-20 lg:py-24 text-white" style="background-color:#0e1523;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2 class="leading-tight mb-5 sm:mb-10"><strong>Take a look inside:</strong></h2>
            @php
                $slides = [
                 [
                     'img' => 'marketing/pianote/lead-gen/digital-chords-and-scales/gallery-01.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/lead-gen/digital-chords-and-scales/gallery-02.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/lead-gen/digital-chords-and-scales/gallery-03.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/lead-gen/digital-chords-and-scales/gallery-04.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/lead-gen/digital-chords-and-scales/gallery-05.jpg',
                 ],
             ];
            @endphp

            <div class="flex flex-wrap items-center">
                <div class="w-full sm:w-1/2 sm:order-1">
                    <div class="p-2 w-full"><div data-open="image1" class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[0]['img'] }}')"></div></div>
                </div>
                <div class="w-1/2 sm:w-1/4">
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')"></div></div>
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[2]['img'] }}')"></div></div>
                </div>
                <div class="w-1/2 sm:w-1/4 sm:order-2">
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[3]['img'] }}')"></div></div>
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[4]['img'] }}')"></div></div>
                </div>
            </div>
        </div>
    </section>
    @include('pianote.lead-gen.partials.quick-questions', [
        'textColor' => 'black',
        'bgColor' => 'white'
    ])

    <section class="final px-4 py-10 sm:py-14 bg-cover bg-center" style="background:linear-gradient(to bottom, #fcfbf9 66%, #f4f1ec);">
        <div class="max-w-6xl mx-auto sm:flex items-center container text-center lg:text-left">
            <div class="w-full sm:w-auto sm:order-1">
                <img
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/digital-chords-and-scales/master-every-chord-bg.png"
                    class="transition-opacity opacity-0" alt="header hero image" loading="lazy" onload="this.classList.remove('opacity-0')"
                />
            </div>
            <div class="w-full sm:w-7/12 lg:w-1/2 sm:pr-5 mx-auto sm:max-w-full flex-shrink-0">
                <div class="px-2 sm:px-3">
                    <img
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/430x0/filters:quality(95)/marketing/pianote/lead-gen/digital-chords-and-scales/Chords-scales-digital-logo.png"
                        class="h-20 sm:h-24 lg:h-28 transition-opacity opacity-0" alt="FWTGF logo" loading="lazy" onload="this.classList.remove('opacity-0')"
                    />
                    <h5 class="leading-tight my-4"><strong>Master Every Chord.<br> Every Scale. In Every Key.</strong></h5>
                    <p class="mb-4">Enter your {{--name and--}} email address to get<br class="lg:hidden">  your FREE E-Book instantly.</p>
                </div>
                @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Digital Chords And Scales',
                            "formId" => "Pianote - Engagement - Trigger - Digital Chords And Scales - Web Form2",
                    "buttonText" => "Get my book",
                    "stacked" => true,
                ])
            </div>
        </div>
    </section>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@endsection
