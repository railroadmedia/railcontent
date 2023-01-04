<div class="col-xs-12 no-padding question-dropdown text-left @if(!empty($defaultOpen)) active @endif @if(!empty($customClass)) {!! $customClass !!} @endif @if(empty($weekDescription)) no-drop @endif">
    <div class="col-xs-12 no-padding drop-down-wrap">
        <div class="col-xs-12 no-padding text-center week-number">
            @if(!empty($question))<strong class="number"><i class="fas fa-question"></i></strong> @endif
            @if(!empty($chapter))<span class="hidden-xs"> CHAPTER</span> <strong class="number">{{ $chapter }}</strong> @endif
            @if(!empty($level))<span class="hidden-xs"> LEVEL</span> <strong class="number">{{ $level }}</strong> @endif
            @if(!empty($weekNumber))<span class="hidden-xs"> Week</span> <strong class="number">{{ $weekNumber }}</strong> @endif
            @if(!empty($bonusNumber))<span class="hidden-xs"> Bonus <strong class="number">{{ $bonusNumber }}</strong></span> <span class="hidden-sm hidden-md hidden-lg"><strong class="number"><i class="fas fa-plus"></i></strong></span> @endif
        </div>
        <div class="col-xs-12 pull-right drop-down-content">
            <div class="question">
                <h2>{!! $weekTitle !!}</h2>

                @if(!empty($weekDate)) <p class="details hidden-xs"><em> {!!  $weekDate !!} </em></p> @endif
            </div>
            @if(!empty($weekDescription))
                <p>@if(!empty($weekDate)) <em class="hidden-sm hidden-md hidden-lg"> {!!  $weekDate !!} <br><br></em> @endif {!! nl2br( $weekDescription) !!}</p>
            @endif
        </div>
    </div>
    @if(!empty($weekDescription))
        <div class="col-xs-12 no-padding text-center arrow-wrap">
                <i class="fas fa-chevron-down @if(!empty($defaultOpen)) rotated @endif"></i>
        </div>
    @endif
</div>