<div class="dropdown text-center rounded-xl overflow-hidden flex cursor-pointer mb-3 select-none py-4 sm:py-6 px-4 sm:px-5 text-black
@if(!empty($defaultOpen)) active @endif
@if(!empty($customClass)) {!! $customClass !!} @endif
@if(empty($weekDescription)) no-drop @endif" style="background-color:#f6f8fc;">
    @if(!empty($level) || !empty($book))
        <div class="bg-pred  pr-2 sm:pr-3">
            @if(!empty($level))<p class="whitespace-nowrap"><span class="hidden md:inline"> LEVEL</span> <strong class="text-sm sm:text-xl">{{ $level }}</strong></p>@endif
            @if(!empty($book))<p><span class="hidden md:inline"> BOOK</span> <strong class="text-sm sm:text-xl">{{ $book }}</strong></p>@endif
        </div>
    @endif
    <div class=" pr-3 text-left flex-grow relative">
        <h6 class="leading-tight sm:leading-loose font-bold">{!! $title !!}</h6>
        @if(!empty($date)) <p class="hidden sm:inline-block absolute right-0 top-1/2 text-navy-600" style="transform: translate(0, -50%);"><em><strong> {!!  $date !!} </strong></em></p> @endif
        @if(!empty($description))
            <p class="description transition-all duration-300 text-xs sm:text-sm"><br>{!! nl2br( $description) !!}</p>
        @endif
    </div>
    @if(!empty($description))
        <div class="ml-auto text-lg sm:text-3xl text-drumeo @if(!empty($customArrow)) {{ $customArrow }} @endif">
            <i class="fas fa-plus transform transition-all duration-300 @if(!empty($defaultOpen)) rotate-45 @endif"></i>
        </div>
    @endif
</div>
