@extends('partials.layout')

@section('meta')
    <title>Drumeo Dictionary of Terms | Musora</title>
@endsection

@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mb-4">
        <breadcrumb 
            :breadcrumbs="{{ json_encode([ 
                [
                    "title" => "Legacy Resources",
                    "url" => "/drumeo/legacy-resources",
                ],
                [
                    'title' => 'Dictionary of Terms'
                ]
            ])}}"
        ></breadcrumb>
        <page-header
            page-type="dictionary"
            title="Drumeo Dictionary of Terms"
            icon-name="question-mark-circle"
            description="Here you'll find a comprehensive list of commonly used drumming terms that we frequently reference in our videos and on our website."
        ></page-header>
    </div>

    <div id="dictionaryNav" class="tw-px-3 md:tw-px-8 tw-sticky tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-top-0 tw-z-10">
        <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-justify-center sm:tw-justify-around tw-p-3 tw-bg-[#191b1c] tw-rounded-md">
            @foreach($dictionaryTerms as $letter => $definition)
                <div class="tw-text-white tw-flex tw-flex-col">
                    <a class="tw-text-xl md:tw-text-2xl tw-leading-none tw-p-1 tw-font-semibold tw-uppercase tw-text-white tw-no-underline"
                       href="#{{ $letter }}">{{ $letter }}</a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-py-6">
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
