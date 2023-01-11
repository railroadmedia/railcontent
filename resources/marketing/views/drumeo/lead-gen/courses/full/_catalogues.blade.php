<div class="lesson-catalogue container max-w-5xl mx-auto">
    <div class="list-wrapper px-4">
        <h1>Course Lessons</h1>
        
        @foreach ($lessons as $key => $lesson)
            <a href="{{ $lesson['url'] }}" class="lesson-row text-center flex">
                <div class="lesson-number">{{ (int)$key+1 }}</div>
                <div class="lesson-thumb hidden mr-4 md:block"><img src="{{ $lesson['image'] }}" alt="thumbnail{{ (int)$key+1}}"></div>
                <div class="lesson-name text-left">{{ $lesson['title'] }}</div>
                <div class="duration">{{ $lesson['duration'] }} @if($lesson['duration'] > 1) Min<span class="hidden sm:inline">utes</span> @else Min<span class="hidden sm:inline">ute</span> @endif</div>
                <div class="status-icon sm:block"><i class="fas fa-play-circle"></i></div>
            </a>
        @endforeach
    </div>
</div>