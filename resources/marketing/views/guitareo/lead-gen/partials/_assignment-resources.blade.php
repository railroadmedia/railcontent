<div @if(!empty($assignmentID)) id="{{ $assignmentID }}" @endif class="assignment-row border-gray-100 border-b-2 py-4 sm:px-3" style="border-bottom-style: solid;">
    <div class="w-full flex text-left items-center justify-between">
        @if(!empty($assignmentID))
            {{--<i class="complete-button {{ ($songInAnHourProgress->$assignmentID ?? null) == 'completed' ? 'active' : '' }} far fa-check text-center text-2xl text-gray-300 border-4 rounded-full cursor-pointer transition-all duration-300 hover:bg-gray-200 hover:text-white"--}}
                    {{--data-content-id="{{ $assignmentID }}" style="min-width: 39px;"></i>--}}
        @elseif(!empty($pdfURL))
            <a class="text-black" href="{{ $pdfURL }}" target="_blank"><i class="fa-light fa-fw fa-file-music text-3xl flex-shrink-0 text-black"></i></a>
        @elseif(!empty($imgURL))
            <a class="text-black" href="{{ $imgURL }}" target="_blank"><i class="fa-light fa-fw fa-file-music text-3xl flex-shrink-0 text-black"></i></a>
        @elseif(!empty($mp3URL))
            <a class="text-black" href="{{ $mp3URL }}" target="_blank"><i class="fa-light fa-fw fa-music text-3xl text-black"></i></a>
        @elseif(!empty($zipURL))
            <a class="text-black" href="{{ $zipURL }}" target="_blank"><i class="fa-light fa-fw fa-cloud-download text-3xl text-black"></i></a>
        @endif

        <div class="pl-3 sm:pl-4 max-w-2xl max-w-2xl mr-auto">
            <p class="flex-grow"><strong>{!! $title !!}</strong></p>

            @if(!empty($subTitle))
                <p class="flex-grow mt-1 sm:mt-2">{!!  $subTitle  !!}</p>
            @endif
        </div>

        @if(!empty($soundslice))
            <i class="fas fa-fw fa-play pl-2 mr-2 sm:mr-6 ml-auto text-xl outline-none cursor-pointer text-yellow relative z-10 autoplay-video flex-shrink-0" data-open="{{ $assignmentID }}Modal"></i>
        @endif
        @if(!empty($pdfURL) || !empty($mp3URL) || !empty($imgURL))
            <i class="fa-light fa-fw fa-angle-down transition-all duration-300 @if(empty($soundslice)) ml-auto  @endif @if(!empty($pdfURL)) cursor-pointer @endif text-4xl flex-shrink-0 w-9"></i>
        @endif
    </div>


    @if(!empty($pdfURL) || !empty($mp3URL) || !empty($imgURL))
        <div class="w-full dropdown px-2 invisible opacity-0 h-auto max-h-0 overflow-hidden transition-all duration-300">
            @if(!empty($mp3URL))
                <audio class="outline-none min-w-full mt-4" controls src="{{ $mp3URL }}"></audio>

            @elseif(!empty($pdfURL))
            <object
                data="{{ $pdfURL }}"
                type="application/pdf"
                width="100%"
                height="250px"
            >
                <p>
                    Your browser does not support PDFs.
                    <a href="{{ $pdfURL }}">Download the PDF</a>
                    .
                </p>
            </object>

            @elseif(!empty($imgURL))
                <img class="mt-4" src="{{ $imgURL }}" alt="lesson chart/sheet">
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
