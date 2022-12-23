<div class="dropdown text-center border-2 border-gray-500 rounded-md overflow-hidden flex cursor-pointer mb-3 select-none
@if(!empty($defaultOpen)) active @endif
@if(!empty($customClass)) {!! $customClass !!} @endif
@if(empty($weekDescription)) no-drop @endif">
    <div class="bg-pred py-3 px-2 sm:px-3">
        @if(!empty($level))<p class="whitespace-nowrap"><span class="hidden md:inline"> LEVEL</span> <strong class="text-sm sm:text-xl">{{ $level }}</strong></p>@endif
        @if(!empty($book))<p><span class="hidden md:inline"> BOOK</span> <strong class="text-sm sm:text-xl">{{ $book }}</strong></p>@endif
        @if(!empty($question))<p><strong class="text-xl"><i class="fas fa-question"></i></strong></p>@endif
    </div>
    <div class="p-3 text-left flex-grow relative">
        <h6 class="leading-normal"><strong>{!! $title !!}</strong></h6>
        @if(!empty($date)) <p class="hidden sm:inline-block absolute right-0 top-1/2 text-navy-600" style="transform: translate(0, -50%);"><em><strong> {!!  $date !!} </strong></em></p> @endif
        @if(!empty($description))
            <p class="description transition-all duration-300 text-xs sm:text-sm"><br>{!! nl2br( $description) !!}</p>
        @endif
    </div>
    @if(!empty($description))
        <div class="py-3 px-2 sm:px-3 ml-auto text-sm sm:text-xl text-navy-600 @if(!empty($customArrow)) {{ $customArrow }} @endif">
            <i class="fas fa-chevron-down transform transition-all duration-300 @if(!empty($defaultOpen)) rotate-180 @endif"></i>
        </div>
    @endif
</div>