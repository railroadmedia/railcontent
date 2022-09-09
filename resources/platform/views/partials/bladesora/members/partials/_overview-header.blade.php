<header id="pageHeader" 
        class="fluid pv-4 relative" 
>
    {{-- Background Image --}}
    <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top">
        <img src="https://musora.com/cdn-cgi/image/width=1000,q_auto:best/{{$backgroundImage}}" 
            class="tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
            onload="this.classList.remove('tw-opacity-0')"
        >
    </div>
    {{-- Background Gradient --}}
    <div class="header-gradient-overlay absolute-fill {{ $themeColor }}"></div>
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-relative">
        <div class="flex flex-row">
            @if(!empty($avatarImage))
                <div class="header-avatar flex flex-column hide-xs-only">
                    <div class="square">
                        <img class="rounded inset-border" src="{{ $avatarImage }}">
                    </div>
                </div>
            @endif

            <div class="flex flex-column ph grow">
                <h2 class="title uppercase text-{{ $themeColor }}">
                    {{ str_replace('-', ' ', ucwords($overviewType)) }}
                    @if(!empty($difficulty))
                        -
                        <span class="font-light">{{ $difficulty }}</span>
                    @endif
                </h2>
                <h1 class="heading text-white mb-2">{{ $pageTitle }}</h1>
                <div class="body text-white">
                    {!! $pageDescription !!}
                </div>

                {{ $interactionSlot }}
            </div>
            <div class="flex flex-column sm-2 hide-xs-only"></div>
        </div>
    </div>
</header>