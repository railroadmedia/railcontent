<div class="columns lesson-tile">
    <img src="{{ $imageURL }}" alt="{{ $tileTitle }} thumbnail">
    <h1>{{ $tileTitle }}</h1>
    <p>@if(!empty($tileDescription))
            {{ $tileDescription }}<br>
        @endif
        <span class="duration">
            @if(!empty($exercises))
                {{ $lessonDuration }} MINS &nbsp;/&nbsp;
                @if(($exercises < 2))
                    {{ $exercises }} EXERCISE
                @else
                    {{ $exercises }} EXERCISES
                @endif
            @elseif(!empty($lessonNumber))
                {{ $lessonNumber }} LESSONS &nbsp;/&nbsp; {{ $lessonDuration }} MINS
            @else
                {{ $lessonDuration }} MINS
            @endif
        </span>
    </p>
</div>
