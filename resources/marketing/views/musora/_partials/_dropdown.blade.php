<div onclick="this.classList.toggle('active')" class="dropdown text-center border-2 border-gray-500 rounded-md overflow-hidden flex cursor-pointer mb-3 select-none
@if(!empty($defaultOpen)) active @endif
@if(!empty($customClass)) {!! $customClass !!} @endif
@if(!empty($navyBorder)) border-sky-900 @endif
@if(empty($weekDescription)) no-drop @endif">
    <div class="bg-singeo py-3 px-2 sm:px-3 ">
        @if(!empty($level))
            <h5 class="leading-tight whitespace-nowrap inline-flex items-center">
                <span class="text-xs hidden md:inline mr-1"> LEVEL</span>
                <strong>{{ $level }}</strong>
            </h5>
        @endif
        @if(!empty($book))<h5 class="leading-tight"><span class="text-xs hidden md:inline"> BOOK</span> <strong>{{ $book }}</strong></h5>@endif
        @if(!empty($question))<h5 class="leading-tight"><strong><i class="fas fa-question"></i></strong></h5>@endif
    </div>
    <div class="p-3 text-left flex-grow">
        <div class="flex items-center text-left flex-col sm:flex-row relative">
            <h5 class="leading-tight flex-grow w-full sm:w-auto font-bold">{!! $title !!}</h5>
            @if(!empty($date))
                <p class="inline-flex text-sky-900 w-full sm:w-auto">
                    <em><strong> {!!  $date !!} </strong></em>
                </p>
            @endif
        </div>
        @if(!empty($description))
            <p class="description transition-all duration-300">
                <br>
                {!! nl2br( $description) !!}
            </p>
        @endif
    </div>
    @if(!empty($description))
        <div class="py-3 px-2 sm:px-3 ml-auto">
            <i class="text-sm sm:text-xl @if(!empty($navyBorder)) text-sky-900 @endif fas fa-chevron-down transform transition-all duration-300 @if(!empty($defaultOpen)) rotate-180 @endif"></i>
        </div>
    @endif
</div>
