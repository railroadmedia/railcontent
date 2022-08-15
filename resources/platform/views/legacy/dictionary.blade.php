@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>Dictionary of Terms | Drumeo</title>
@endsection

@section('styles')
    <style>
        #backToTop {
            position:fixed;
            bottom:15px;
            left:15px;
            z-index:97;
        }
    </style>
@endsection

@section('scripts')
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

@section('content')
    @include('members.partials._drumeo-sidebar')

    <header id="pageHeader" class="container fluid pv-4" style="background-image:url({{ cdn('headers/members-header-background-image.jpg') }});">
        <div class="container text-center">
            <h1 class="heading text-white mb-2">
                <i class="icon-dictionary-drum-terms text-drumeo"></i> Dictionary of Terms
            </h1>
        </div>
    </header>

    <a href="#pageHeader" id="backToTop" class="btn collapse-square bg-grey-5 text-white hide"
       title="Back to Top">
        <i class="fas fa-arrow-circle-up"></i>
    </a>

    <div id="dictionaryNav" class="container fluid bg-grey-5 pv">
        <div class="flex flex-row flex-wrap align-center">
            @foreach($dictionaryTerms as $letter => $definition)
                <div class="text-white flex flex-column letter-anchor align-center">
                    <a class="subheading uppercase text-white no-decoration"
                       href="#{{ $letter }}">{{ $letter }}</a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mv-3">
        <div class="flex flex-column">
            @foreach($dictionaryTerms as $letter => $terms)
                <div class="flex flex-column mb-2" style="position:relative;">
                    <a id="{{ $letter }}" style="position:absolute;top:-65px;"></a>
                    <div class="flex flex-row bg-grey-2 align-center pa">
                        <h1 class="heading text-drumeo uppercase text-center">{{ $letter }}</h1>
                    </div>
                    <div class="flex flex-row bg-white pa">
                        <div class="flex flex-column">
                            @foreach($terms as $term => $definition)
                                <p class="body mb-1">
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

