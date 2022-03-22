@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>Student Focus | Singeo</title>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')

    @include('members.partials._content-sidebar')

    @component('members.partials._header-banner')
        @slot('content')
            <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4 tw-mt-14">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <i class="icon-student-focus tw-text-singeo tw-mr-3 tw-text-3xl"></i>
                    <span class="tw-text-32">Student Focus</span>
                </h1>

                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                    We want to create a learning experience that best suits your singing goals. Within Student Focus, we
                    offer personalized feedback and Q&A lessons to help you reach your potential. These live sessions
                    are available on-demand, so you can catch up anytime - no matter where life takes you.
                </p>
            </div>
        @endslot
    @endcomponent

    <div class="container">
        <div class="flex flex-column  mv-3">
            <div class="flex flex-row flex-wrap">
                @foreach($lessonTypes as $lessonType)
                    <a href="{{ url()->route('members.catalogues.show', ["contentType" => $lessonType['type']]) }}"
                       class="flex flex-column xs-6 sm-3 pa-1"
                       dusk="{{$lessonType['type']}}">

                        {{--                        <div class="show-index-card square corners-10 shadow relative" style="background-image:url({{ $lessonType['thumbnail'] }});">--}}
                        <div class="show-index-card square corners-10 shadow relative" style="background-image:url({{imgix(
            $lessonType['thumbnail'],
            ["q" => 80, "w" => 650, "h" => 650, "auto" => "format"]
        )}});">
                            <span class="box-hover heading corners-10">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
