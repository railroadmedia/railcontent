<div class="flex flex-row pv-3 content-overview {{ !empty($hideBorder) && $hideBorder ? '' : 'tw-border-b tw-border-[#D4D4D8] dark:tw-border-[#223F57]' }}">
    <div class="flex flex-column align-v-center large-thumbnail {{ !empty($showBackgroundCards) && $showBackgroundCards === true ? 'background-cards' : '' }} {{ $themeColor }} {{ !empty($releaseDate) && \Carbon\Carbon::parse($releaseDate) > \Carbon\Carbon::now() ? 'desaturate' : '' }}">
        <div class="thumb-wrap corners-10">
            <a @if((empty($noLink) || $noLink === false) && $isOwned) href="{{ $lessonsUrl }}" @endif>
                <div class="thumb-img bg-center corners-10 bg-grey-2 dark:tw-bg-[#081825] {{ $forceSquareThumb === true ? 'square' : 'widescreen' }}">
                    <img
                        src="https://www.musora.com/musora-cdn/image/width=280,height=280,quality=90/{{ $itemThumbnail }}"
                        alt="{{ $itemTitle }} Thumbnail"
                        class="tw-transition-opacity tw-opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('tw-opacity-0')"
                    >

                    @if(!empty($logoImage))
                        <div class="logo-image pa-1 corners-bottom-3">
                            <img
                                src="{{ $logoImage }}"
                                alt="{{ $itemTitle }} Logo">
                        </div>
                    @endif

                    @if(!empty($progressPercent))
                        <div class="lesson-progress overflow">
                            <span class="progress bg-{{ $themeColor }}"
                                  style="width:{{ $progressPercent }}%"></span>
                        </div>
                    @endif

                    @if(\Carbon\Carbon::parse($releaseDate) < \Carbon\Carbon::now() && $isOwned)
                        <span class="thumb-hover flex-center">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    @endif
                </div>
            </a>
        </div>
    </div>
    <div class="flex flex-column grow">
        <div class="flex flex-row align-v-center
                    {{ !$isOwned && \Carbon\Carbon::parse($releaseDate) < \Carbon\Carbon::now() ? 'flex-wrap-xs-only' : '' }}">
            <div class="flex flex-column align-v-center grow ph p-sm-up">
                @if(\Carbon\Carbon::parse($releaseDate) > \Carbon\Carbon::now())
                    <p class="tiny text-{{ $themeColor }} uppercase">
                        Opening {{ \Carbon\Carbon::parse($releaseDate)->format('l, F j \a\t g:i A') }}
                    </p>
                @endif

                @if(isset($includedWithEdge) && $includedWithEdge === true)
                    <p class="tiny tw-uppercase tw-flex tw-items-center tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]" style="margin-bottom: 8px;">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-mr-1">
                            <path d="M5.80262 0.917433L4.21589 4.02017L0.665805 4.51933C0.0291704 4.60838 -0.225969 5.36532 0.235712 5.79886L2.80412 8.21263L2.19664 11.6224C2.0873 12.2387 2.76038 12.7004 3.32412 12.4121L6.5 10.8021L9.67588 12.4121C10.2396 12.698 10.9127 12.2387 10.8034 11.6224L10.1959 8.21263L12.7643 5.79886C13.226 5.36532 12.9708 4.60838 12.3342 4.51933L8.78411 4.02017L7.19738 0.917433C6.91308 0.364376 6.08935 0.357346 5.80262 0.917433Z" fill="currentColor"/>
                        </svg>
                        Included With Edge
                    </p>
                @endif
                    
                @if(!empty($statusText))
                        <div class="tw-mb-2"><p class="tw-text-white tw-bg-{{ $brand }} tw-uppercase tiny tw-rounded-lg tw-font-bold tw-py-1 tw-px-2.5 tw-inline-block">{{ $statusText }}</p></div>
                @endif

                @if($itemTitle === '30 Day Drummer: Season 2')<div class="tw-mb-2"><p class="tw-uppercase tiny tw-rounded-lg tw-font-bold tw-py-1 tw-px-2.5 tw-inline-block tw-bg-[#000C17] tw-text-white dark:tw-bg-white dark:tw-text-black">March 2023</p></div>
                @endif

                @if($itemTitle === '30-Day Drummer')<div class="tw-mb-2"><p class="tw-uppercase tiny tw-rounded-lg tw-font-bold tw-py-1 tw-px-2.5 tw-inline-block tw-bg-[#000C17] tw-text-white dark:tw-bg-white dark:tw-text-black">September 2022</p></div>
                @endif

                <a @if((empty($noLink) || $noLink === false) && $isOwned) href="{{ $lessonsUrl }}" @endif
                   class="tw-font-bold tw-text-[#00101D] dark:tw-text-white no-decoration tw-mb-2 tw-text-xl">
                   {{ $itemTitle }}
                </a>

                <div class="tiny tw-mb-2 dark:tw-text-white md:tw-mr-14" >{!! $itemDescription !!}</div>

                @if(\Carbon\Carbon::parse($releaseDate) < \Carbon\Carbon::now() && $isOwned)
                    <div class="flex flex-row align-v-center overview-links tw-mt-2 tw-flex-wrap">
                        <a href="{{ $itemUrl }}"
                           class="tw-btn-primary tw-bg-{{ $brand }} tw-text-xl go-to-button tw-mb-2 tw-mr-3">
                            @if($itemProgress === 'started')
                                <i class="fas fa-play mr-1"></i>
                                Next Lesson
                            @elseif($itemProgress === 'completed')
                                <i class="fas fa-check-circle mr-1"></i>
                                Completed
                            @else
                                <i class="fas fa-play mr-1"></i>
                                First Lesson
                            @endif
                        </a>

                        @if(!empty($lessonsUrl))
                            <a href="{{ $lessonsUrl }}"
                               class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white tw-text-xl go-to-button tw-mr-3">
                                <i class="fas fa-arrow-circle-right mr-1"></i>
                                See Lessons
                            </a>
                        @endif
                    </div>
                @endif

            </div>

            @if(!empty($itemDetails) && $isOwned)
                <div class="flex flex-column align-center basic-col tw-uppercase text-grey-3 dark:tw-text-[#9EC0DC] font-italic tw-text-xs hide-sm-down">
                    {{ $itemDetails }}
                </div>
            @endif

            @if(!$isOwned && \Carbon\Carbon::parse($releaseDate) < \Carbon\Carbon::now())
                <div class="flex flex-column buy-col align-center">
                    <a  href="/#customize-anchor"
                        target="_blank"
                        class="tw-btn-primary tw-bg-{{ $brand }} tw-text-xl go-to-button tw-mb-2">
                        <i class="fas fa-plus mr-1"></i>
                        Upgrade Membership
                    </a>

                    <p class="tiny font-bold uppercase text-black dark:text-white dense">
                        <a href="{{ $salesUrl }}"
                           target="_blank"
                           class="text-black">Or Get a Single Learning Path</a>
                        ($97)
                    </p>
                </div>
            @endif

            @if($isOwned || \Carbon\Carbon::parse($releaseDate) > \Carbon\Carbon::now())
                <div class="flex flex-column icon-col align-v-center hide-sm-down ">
                    <div class="body {{ \Carbon\Carbon::parse($releaseDate) > \Carbon\Carbon::now() ? 'addeventatc' : '' }}"
                         data-dropdown-y="up"
                         data-dropdown-x="right"
                         data-intel-apple="true">

                        @if(\Carbon\Carbon::parse($releaseDate) < \Carbon\Carbon::now())
                            <a @if(empty($noLink) || $noLink === false) href="{{ $lessonsUrl }}" @endif class="no-decoration">
                                @if(!empty($itemProgress))
                                    <i class="fas {{ $itemProgress == 'completed' ? 'fa-check-circle' : 'fa-adjust' }} flex-center text-{{ $themeColor }} rounded"></i>
                                @else
                                    <i class="fas fa-arrow-circle-right flex-center text-grey-2 dark:tw-text-[#9EC0DC] rounded"></i>
                                @endif
                            </a>
                            @else
                            <i class="fas fa-calendar-plus flex-center text-grey-2 dark:tw-text-[#9EC0DC] rounded"></i>

                            <span class="start">{{ $releaseDate }}</span>
                            <span class="timezone">UTC</span>
                            <span class="title">{{ $itemTitle }}</span>
                            <span class="description">{{ $itemDescription }}</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
