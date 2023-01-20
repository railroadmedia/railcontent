<a href="/{{ $lessonURL }}" class="lesson-row text-center flex">
    <div class="lesson-number">{{ $lessonNumber }}</div>
    <div class="lesson-thumb hidden mr-4 md:block"><img src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/{{ $lessonImg }}" alt="lesson {{ $lessonNumber }}" alt="thumbnail {{ $lessonNumber }}"></div>
    <div class="lesson-name text-left">{{ $lessonTitle }}</div>
    <div class="duration">{{ $duration }} @if($duration > 1) Min<span class="hidden sm:inline">utes</span> @else Min<span class="hidden sm:inline">ute</span> @endif</div>
    <div class="status-icon sm:block"><i class="fas fa-play-circle"></i></div>
</a>
