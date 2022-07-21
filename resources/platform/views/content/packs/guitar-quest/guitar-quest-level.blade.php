@extends('partials.layout')

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | {{ $brand }} | Musora</title>
@endsection

@section('content')
    @include('content.breadcrumbs._lesson-breadcrumbs')

    <header id="pageHeader" class="container fluid collapsed">
        <div class="container">
            <div class="flex flex-column pack-header align-h-center align-v-top relative pv gq-header">
                <img id="packLogo"
                     src="{{ imgix("https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/guitar-quest-logo.png", ["auto" => "format", "w" => 1000]) }}"
                     class="mt-5">

                <h1 class="heading text-white mb-2 mt-3 uppercase text-center">
                    {{ $parentContent->fetch('fields.title') }}
                </h1>

                <a href="{{ url()->route('members.guitar-quest.show') }}">
                    <button class="btn mt-3" style="width: 300px;">
                    <span class="text-white bg-white inverted uppercase">
                            Back To All Levels
                        </span>
                    </button>
                </a>
            </div>
        </div>
    </header>

    {{-- progress bar --}}
    <div class="container fluid collapsed bg-gq-blue">
        @include('members.partials._content-progress', [
            "contentType" => $parentContent->fetch('type'),
            "progress" => $parentContent->fetch('progress_percent'),
            "nextLessonUrl" => '',
            "xpAmount" => $parentContent->fetch('xp'),
            "showCompleteButton" => false,
            "contentId" => $parentContent->fetch('id'),
            "brand" => 'guitareo',
            "isCompleted" => $parentContent->fetch('completed', false),
            "isStarted" => $parentContent->fetch('started', false),
        ])
    </div>

    <div class="container mv-3">
        <div class="flex flex-column bg-white corners-10">
            <div class="flex flex-row bb-grey-1-1">
                <content-catalogue
                    brand="guitareo"
                    catalogue-type="grid"
                    theme-color="guitareoGuitarQuest"
                    :use-theme-color="true"
                    :pre-loaded-content="{{ $childContent }}"
                    user-id="{{ auth()->id() }}"
                ></content-catalogue>
            </div>
        </div>
    </div>
@endsection
