@extends('guitareo.products.guitar-quest.guitar-quest-layout')

@section('meta')
    @parent
    <title>GuitarQuest | Your Guitar Journey Starts Here</title>
    <meta name="description" content="Rob Scallon’s online guitar lessons for getting started on the guitar and making your favorite musical projects come to life."/>

    <meta property="og:url" content="https://www.guitareo.com/guitar-quest"/>
    <meta property="og:title" content="GuitarQuest | Your Guitar Journey Starts Here"/>
    <meta property="og:description" content="Rob Scallon’s online guitar lessons for getting started on the guitar and making your favorite musical projects come to life."/>
    <meta property="og:image" content="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2Fshare-image.png?auto=format&ixlib=php-1.2.1&w=1500&s=4294b260a12b5d809a9b8182414e2312"/>
@stop()

@section('styles')
    @parent
    <style>
        .hover-yellow:hover {
            transition:background-color .3s;
            background-color:#FFB500!important;
        }
    </style>
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/guitar-quest.css') }}" rel="stylesheet">

@stop()

@section('scripts')
    @parent
    <script src="{{ asset('/marketing/parcel/drumeo/svg-polyfil.js') }}"></script>
    <script>
        // Polyfill that alows template elements in svgs for alpine js
        // https://github.com/alpinejs/alpine/issues/637
        (function(){
            var templates = document.querySelectorAll('svg template');
            var el, template, attribs, attrib, count, child, content;
            for (var i=0; i<templates.length; i++) {
                el = templates[i];
                template = el.ownerDocument.createElement('template');
                el.parentNode.insertBefore(template, el);
                attribs = el.attributes;
                count = attribs.length;
                while (count-- > 0) {
                    attrib = attribs[count];
                    template.setAttribute(attrib.name, attrib.value);
                    el.removeAttribute(attrib.name);
                }
                el.parentNode.removeChild(el);
                content = template.content;
                while ((child = el.firstChild)) {
                    content.appendChild(child);
                }
            }
        })();
    </script>
    <script src="{{ asset('/marketing/js/app.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".infusion-form").submit(function(event) {
                if(event.originalEvent != null) {
                    var formId = $(this).find('input[name="inf_form_xid"]').val();

                    dataLayer.push({
                        'event': 'gtm.formSubmit',
                        'formId': formId,
                        'formSuccess': true
                    });
                }
            });
        });
    </script>
@stop()

@section('content')
    <!-- Guitareo Nav -->
    @include("guitareo.sales.partials._nav")
    <!-- Guitar Quest Nav -->
    @include("guitareo.products.guitar-quest.partials._nav")


    <main>
        @yield('top-promo-banner')
        <!-- Your Quest Section -->
        @hasSection ('quest-section')
            @yield('quest-section')
        @else
            @include("guitareo.products.guitar-quest.partials.sections._your-quest")
        @endif

        @yield('promo-banner')

        <!-- Fixed Image Featues (x3) -->
        @include("guitareo.products.guitar-quest.partials.sections._fixed-image-features")

        <!-- Your Map Section -->
        @include("guitareo.products.guitar-quest.partials.sections._your-map")

        <!-- Your Skills Section -->
        @include("guitareo.products.guitar-quest.partials.sections._your-skills")

        <!-- Your Teacher Section -->
        @include("guitareo.products.guitar-quest.partials.sections._your-teacher")

        <!-- Your Way -->
        @include("guitareo.products.guitar-quest.partials.sections._your-way")

        <!-- Start Here -->
        @yield('final')

        <!-- Trailer Modal -->
        @include("guitareo.products.guitar-quest.partials._trailer-modal")

    </main>
    {{--<div id="exitPop" class="tw-opacity-0" x-on:click.prevent="modalOpen = 'exitModal';"></div>--}}
    {{--<div x-show.transition.opacity="modalOpen === 'exitModal'"--}}
            {{--x-cloak--}}
            {{--class="tw-overflow-y-scroll tw-p-4 tw-fixed tw-inset-0 tw-bg-black tw-bg-opacity-75 tw-z-250 soft-block">--}}
        {{--<button class="tw-text-white tw-text-4xl md:tw-text-7xl tw-cursor-pointer tw-ml-auto tw-mb-6"--}}
                {{--x-on:click.prevent="modalOpen = false;">--}}
            {{--<i class="fas fa-times"></i>--}}
        {{--</button>--}}
        {{--<div x-show.transition="modalOpen === 'exitModal'"--}}
                {{--x-on:click.away="modalOpen = false;"--}}
                {{--class="tw-flex tw-flex-wrap tw-items-start tw-max-w-screen tw-mx-auto tw-bg-white tw-p-3 md:tw-p-6 tw-rounded-lg tw-max-w-lg tw-text-center">--}}
            {{--<img style="filter:invert(1)" class="tw-h-8 md:tw-h-10 tw-mx-auto" src="https://d122ay5chh2hr5.cloudfront.net/lead-gen/song-in-an-hour/logo-white.png">--}}
            {{--<br>--}}
            {{--<h1 style="color:#9101f6;" class="tw-w-full tw-uppercase tw-leading-none tw-text-6xl md:tw-text-8xl font-bison-bold tw-mt-2">* WAIT *</h1>--}}
            {{--<br>--}}
            {{--<h2 class="tw-w-full tw-uppercase tw-leading-none tw-text-3xl md:tw-text-5xl font-bison-bold">GET YOUR FIRST MISSION FREE!</h2>--}}
            {{--<br>--}}
            {{--<p class="tw-w-full tw-text-md md:tw-text-xl tw-my-3">Enter your email to start your GuitarQuest <br class="tw-hidden md:tw-inline">--}}
                {{--for free, no credit card required.</p>--}}
            {{--<div class="tw-w-full">--}}
                {{--@include("guitareo.lead-gen.partials._sign-up-form-tw", [--}}
                        {{--"stacked" => true,--}}
                        {{--"formId" => "Guitareo - Engagement - Trigger - Song Hour - Web Form",--}}
                        {{--"formName" => 'Song Hour',--}}
                        {{--"redirectURL" => "/song-in-an-hour/thank-you",--}}
                        {{--"buttonText" => "Send My First Mission "--}}
                   {{--])--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    @include("guitareo.sales.partials._footer")
@stop
