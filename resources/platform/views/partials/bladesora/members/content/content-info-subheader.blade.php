<div id="subHeader" class="collapsed-h fluid bg-grey-5 pv-1">
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-flex">
        <div class="tw-flex tw-flex-row tw-w-full align-center nmh-1">

            <div class="tw-flex tw-flex-col tw-w-full tw-justify-center tw-text-white ph-1 meta-info-col hide-xs-only">
                <div class="tw-flex tw-flex-row tw-items-center">
                    @foreach($infoData as $key => $value)
                        <p class="subheading tw-uppercase tw-mr-3">
                            {{ $value  }}  <span class="body">{{ $key }}</span>
                        </p>
                    @endforeach
                </div>
            </div>

            @if(!empty($downloadableResources))
                <div class="tw-flex tw-flex-col button-col">
                    <div class="btn tw-text-white tw-border tw-border-white is-dropdown">
                        <i class="unopen fas fa-download no-events tw-text-white"></i>
                        <i class="open fas fa-download no-events text-x-dark"></i>

                        <div class="dropdown-content tw-bg-white tw-shadow tw-text-xs tw-text-[#00101D]">
                            <ul>
                                @foreach($downloadableResources as $resource)
                                    <li>
                                        <a class="tw-no-underline tw-text-[#00101D] pa-1"
                                           href="{{ $resource['resource_url'] }}"
                                           target="_blank"
                                           download>
                                            <i class="fas {{ get_resource_icon($resource['resource_url']) }} mr-1" style="width:20px;"></i>  {{ $resource['resource_name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if(!empty($resetProgress) && $resetProgress === true)
                <div class="flex flex-column button-col">
                    <button class="resetProgress btn" title="Reset Progress"
                            tile="Reset Progress"
                            data-content-id="{{ $contentId }}"
                            data-brand="{{ $brand }}">
                        <span class="text-white bg-white inverted">
                            <i class="fas fa-redo-alt fa-flip-horizontal"></i>
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
