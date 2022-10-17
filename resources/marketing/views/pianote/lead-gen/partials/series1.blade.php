<div class="container series-boxes mx-auto lg:max-w-6xl flex flex-wrap justify-center mb-10">
    @foreach ($lessons as $lesson) 
        <div class="box px-4 @if(!empty($customSize)) {{ $customSize }} @else w-3/4 md:w-1/3 @endif @if(!empty($lesson['watchLink'])) with-video @endif">
            <a @if(!empty($lesson['watchLink']))
                    href="{{ $lesson['watchLink'] }}"
            @else
                data-toggle="modal" data-target="#signupModal" data-open="signUpModal"
                @endif >
                @if(!empty($lesson['watchLink']))
                    <i class="fas fa-play-circle"></i>
                @endif
                @if(!empty($lesson['badge']))
                    <div class="box-badge">
                        {{ $lesson['badge'] }}
                    </div>
                @endif
                <img src="{{ $lesson['boxImage'] }}" alt="{{ $lesson['boxAlt'] }}">
                    @if(!empty($lesson['title']))
                        <p>{{ $lesson['title'] }}</p>
                    @endif
            </a>
        </div>
    @endforeach
</div>