@extends('partials.layout')

@section('meta')
    <title>Drumeo Dictionary of Terms | Musora</title>
@endsection

@section('content')

    @component('partials._header-banner', [
        'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
    ])
        @slot('content')
            <div class="tw-flex tw-flex-col tw-pr-1 tw-text-center">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2 tw-text-center">
                    <i class="icon-dictionary-drum-terms tw-text-{{ $brand }} tw-mr-3 tw-text-3xl"></i>
                    <span class="tw-text-32 tw-font-bold">Drumeo Dictionary of Terms</span>
                </h1>
            </div>
        @endslot
    @endcomponent

    <div id="dictionaryNav" class="container fluid bg-grey-5 pv tw-sticky tw-w-full tw-top-0 tw-z-10">
        <div class="flex flex-row flex-wrap align-center">
            @foreach($dictionaryTerms as $letter => $definition)
                <div class="text-white flex flex-column letter-anchor align-center">
                    <a class="subheading uppercase text-white no-decoration"
                       href="#{{ $letter }}">{{ $letter }}</a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 mv-3">
        <div class="flex flex-column">
            @foreach($dictionaryTerms as $letter => $terms)
                <div class="flex flex-column mb-2 tw-relative">
                    <a id="{{ $letter }}" class="tw-absolute tw--top-[165px] sm:tw--top-[125px]"></a>
                    <div class="tw-flex tw-flex-row bg-grey-2 dark:tw-bg-[#223457] tw-rounded-lg tw-items-center tw-justify-center pa">
                        <h1 class="heading tw-text-[#00101D] dark:tw-text-white tw-uppercase tw-text-center">
                            {{ $letter }}
                        </h1>
                    </div>
                    <div class="tw-flex tw0flex-row pa">
                        <div class="flex flex-column">
                            @foreach($terms as $term => $definition)
                                <p class="body mb-1 dark:tw-text-white">
                                    <strong>{{ $term }}</strong> - {{ $definition }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('layout-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var toTopButton = document.getElementById('backToTop');
            var dictionaryNav = document.getElementById('dictionaryNav');

            window.addEventListener('scroll', function(event){
                var offset = window.pageYOffset;
                var nav_offset = dictionaryNav.offsetTop;

                if(offset > nav_offset){
                    toTopButton.classList.remove('hide');
                }
                else {
                    toTopButton.classList.add('hide');
                }
            });
        });
    </script>
@endsection
