<header class="text-center py-8 md:py-14 px-4 text-white" style="background:{{ $bgColor }} @isset($bgImg) url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/{{ $bgImg }}) center center/cover; @endisset ">
    <div class="container mx-auto">
        {!! $img !!}<br>
    </div>
</header>

<section class="lesson-catalogue guitar-tricks">
    <div class="max-w-6xl mx-auto clearfix">
        <div class="list-wrapper float-left w-full">
                @foreach($bonuses as $bonus)
                    <a href="{{ $rootLink }}{{ $bonus['URL'] }}" class="lesson-row float-left w-full text-center">
                        <div class="lesson-number float-left px-3 md:px-4">{{ $bonus['lessonNumber'] }}</div>
                        <div class="lesson-thumb float-left hidden md:inline-block"><img src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{ $bonus['thumbUrl'] }}"></div>
                        <div class="lesson-name float-left px-3 md:px-4 text-left">{{ $bonus['lessonName'] }}</div>
                        <div class="duration float-left px-3 md:px-4">{{ $bonus['duration'] }} @if($bonus['duration'] > 1) Min<span class="hidden md:inline">utes</span> @else Min<span class="hidden md:inline">ute</span> @endif</div>
                        <div class="status-icon float-left px-3 md:px-4 hidden md:inline-block"><i class="fas fa-play-circle"></i></div>
                    </a>
                @endforeach
        </div>
    </div>
</section>
