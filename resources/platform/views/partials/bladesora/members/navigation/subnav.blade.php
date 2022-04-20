<div id="subNav" class="tw-container tw-mx-auto fluid collapsed tw-bg-black bb-grey-5-1">
    <div class="tw-container tw-relative {{ count($subSections) > 4 ? 'pad-sides' : 'collapsed' }}">
        <div id="subNavWrap" class="tw-flex tw-flex-row tw-items-center overflow">
            @foreach($subSections as $section)
                <a href="{{ $section['url'] }}"
                   class="tw-flex tw-flex-col subnav-link pa-1 tw-uppercase align-center text-grey-4 tw-no-underline
                    {{ $section['active'] ? 'active' : '' }}"
                    dusk="subnav-link-{{ strtolower(str_replace(" ", "-", $section['title'])) }}">
                    <i class="{{ $section['icon'] }} tw-relative
                            {{ $section['active'] ? ('tw-text-' . $themeColor) : 'text-grey-4' }}" style="font-size:20px;">


                        @if(!empty($section['badge']))
                            <span class="notification-badge tw-rounded smaller" dusk="notification-dot-small"></span>
                        @endif

                    </i>
                    <p class="x-tiny tw-font-bold wrap tw-text-center
                            {{ $section['active'] ? 'tw-text-white' : 'text-grey-4' }}" style="max-width:100%;white-space:normal;">
                        {{ $section['title'] }}
                    </p>
                </a>
            @endforeach
        </div>

        <div id="scrollSubNavLeft" class="scroll-sub-nav body text-grey-3 bh-grey-5-1 hide" dusk="scroll-subnav-left">
            <i class="fas fa-chevron-left"></i>
        </div>

        <div id="scrollSubNavRight" class="scroll-sub-nav body text-grey-3 bh-grey-5-1 hide" dusk="scroll-subnav-right">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>
</div>