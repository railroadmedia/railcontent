<div class="question-dropdown">
    <div class="w-11/12 float-left question-wrap">
        <div class="w-1/6 lg:w-1/12 question-icon"><i class="fas fa-question"></i></div>
        <div class="w-5/6 lg:w-11/12 float-right question-answer">
            <div class="question"><h2>{!!  $question  !!}</h2></div>
            @if(!empty($richAnswer))
                {!! $answer !!}
            @else
                <p>{!! nl2br( $answer) !!}</p>
            @endif
        </div>
    </div>
    <div class="w-1/12 float-right"><i class="fas fa-chevron-down"></i></div>
</div>