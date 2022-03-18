<div class="columns no-padding question-dropdown text-left">
    <div class="small-11 columns no-padding drop-down-wrap">
        <div class="small-2 large-1 columns no-padding text-center week-number">
            <span class="show-for-medium">Week</span> <strong class="number">{{ $weekNumber }}</strong>
        </div>
        <div class="small-10 large-11 columns">
            <div class="question">
                <h2>{{ $weekTitle }}</h2>
                @if(!empty($minutes))
                    <p class="details show-for-medium"><em>{{ $minutes }} MINUTES</em></p>
                @endif
            </div>
            <p><em class="hide-for-medium">@if(!empty($minutes)){{ $minutes }} MINUTES<br><br> @endif</em>{!! nl2br( $weekDescription) !!}</p>
        </div>
    </div>
    <div class="small-1 columns text-right">
        <i class="fas fa-chevron-down"></i>
    </div>
</div>