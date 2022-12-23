<div class="columns tile">
    <div class="thumb" style="background-image:url({{ $lessonThumb }});">
        <p>{!! $lessonText !!}</p>
    </div>
    @if(!empty($description))
    <p class="description">{!!  $description !!}</p>
    @endif
</div>