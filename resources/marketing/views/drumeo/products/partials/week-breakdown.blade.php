<div class="question-dropdown text-left flex @if(!empty($defaultOpen)) active @endif @if(!empty($customClass)) {!! $customClass !!} @endif @if(empty($weekDescription)) no-drop @endif">
    <div class="w-full float-left drop-down-wrap">
        <div class="w-1/6 lg:w-1/12 text-center week-number">
            @if(!empty($chapter))<span class="hidden sm:inline"> CHAPTER</span> <strong class="number">{{ $chapter }}</strong> @endif
            @if(!empty($level))<span class="hidden sm:inline"> LEVEL</span> <strong class="number">{{ $level }}</strong> @endif
            @if(!empty($weekNumber))<span class="hidden sm:inline"> Week</span> <strong class="number">{{ $weekNumber }}</strong> @endif
            @if(!empty($bonusNumber))<span class="hidden sm:inline"> Bonus <strong class="number">{{ $bonusNumber }}</strong></span> <span class="hide-for-medium"><strong class="number"><i class="fas fa-plus"></i></strong></span> @endif
        </div>
        <div class="w-5/6 lg:w-11/12 float-right px-4">
            <div class="question">
                <h6>{!! $weekTitle !!}</h6>

                @if(!empty($weekDate)) <p class="details hidden sm:block"><em> {!!  $weekDate !!} </em></p> @endif
            </div>
            @if(!empty($weekDescription))
                <p class="text-[14px] lg:text-[15px]">@if(!empty($weekDate)) <em class="inline sm:hidden"> {!!  $weekDate !!} <br><br></em> @endif {!! nl2br( $weekDescription) !!}</p>
            @endif
        </div>
    </div>
    @if(!empty($weekDescription))
        <div class="w-1/12 text-right">
                <i class="fas fa-chevron-down @if(!empty($defaultOpen)) rotated @endif"></i>
        </div>
    @endif
</div>
