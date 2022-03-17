@php
if (!isset($assignmentID)) {
    $assignmentID = '';
}
@endphp

<div @if(!empty($assignmentID)) id="{{ $assignmentID }}" @endif
    class="assignment-row border-gray-100 border-b-2 py-4 sm:px-3">
    <div class="w-full flex text-left items-center justify-between">
        @if(!empty($assignmentID))
            <i class="complete-button {{ ($songInAnHourProgress->$assignmentID ?? null) == 'completed' ? 'active' : '' }} far fa-check text-center text-2xl text-gray-300 border-4 rounded-full cursor-pointer transition-all duration-300 hover:bg-gray-200 hover:text-white"
                    data-content-id="{{ $assignmentID }}" style="min-width: 39px;"></i>
        @elseif(!empty($pdfURL))
            <i class="fal fa-fw fa-file-music text-3xl flex-shrink-0"></i>
        @elseif(!empty($mp3URL))
            <a href="{{ $mp3URL }}" target="_blank"><i class="fal fa-fw fa-music text-3xl"></i></a>
        @endif

        <div class="pl-3 sm:pl-4 max-w-2xl max-w-2xl mr-auto">
            <p class="flex-grow"><strong>{!! $title !!}</strong></p>

            @if(!empty($subTitle))
                <p class="flex-grow mt-1 sm:mt-2">{!!  $subTitle  !!}</p>
            @endif
        </div>

        @if(!empty($pdfURL) || !empty($mp3URL))
            @if(!empty($soundslice))
                <i class="fas fa-fw fa-play pl-2 mr-2 sm:mr-6 ml-auto text-xl outline-none cursor-pointer text-yellow relative z-10 autoplay-video flex-shrink-0" data-open="{{ $assignmentID }}Modal"></i>
            @endif
            <i class="fal fa-fw fa-angle-down transition-all duration-300 @if(empty($soundslice)) ml-auto  @endif @if(!empty($pdfURL)) cursor-pointer @endif text-4xl flex-shrink-0 w-9"></i>
        @endif
    </div>


    @if(!empty($pdfURL) || !empty($mp3URL))
        <div class="w-full dropdown px-2 invisible opacity-0 h-auto max-h-0 overflow-hidden transition-all duration-300">
            @if(!empty($mp3URL))
                <audio class="outline-none min-w-full mt-4" controls src="{{ $mp3URL }}"></audio>
            @endif

            @if(!empty($pdfURL))
                <img class="mt-4" src="{{ $pdfURL }}">
            @endif
        </div>
    @endif
</div>

@if(!empty($soundslice))
    <div class="reveal-overlay">
        <div class="reveal mt-3 sm:mt-6" @if(!empty($assignmentID)) id="{{ $assignmentID }}Modal" @endif data-reveal data-reset-on-close="true">
            <div class="w-full relative overflow-hidden" style="padding-bottom: 66vh;">
                <iframe class="fixed inset-0 h-full w-full absolute reset-on-close"
                        src="" data-lazy-load-url="https://www.soundslice.com/slices/{{ $soundslice }}/embed/?api=1&amp;scroll_type=2&amp;branding=0"
                        frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            </div>
        </div>
    </div>
@endif