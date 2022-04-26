<div id="subHeader" class="tw-container tw-mx-auto collapsed-h fluid bg-grey-5 pv-1">
    <div class="tw-container tw-mx-auto">
        <div class="tw-flex tw-flex-row align-center tw-flex-wrap nmh-1">
            <div class="tw-flex tw-flex-col tw-justify-center tw-text-white ph-1 meta-info-col hide-xs-only">
                <div class="tw-flex tw-flex-row tw-items-center">
                    @foreach($infoData as $key => $value)
                        <p class="subheading tw-uppercase tw-mr-3">
                            {{ $value  }}  <span class="body">{{ $key }}</span>
                        </p>
                    @endforeach
                </div>
            </div>

            @if(!empty($addToList) && $addToList === true)
                <div class="tw-flex tw-flex-col button-col">
                    <button class="addToList btn {{ $isAdded ? 'added' : '' }}"
                            data-content-id="{{ $contentId }}">
                        <span class="un-added tw-bg-white inverted tw-text-white">
                            <i class="fas fa-plus"></i>
                        </span>

                        <span class="is-added tw-bg-white text-x-dark">
                            <i class="fas fa-plus tw-rotate-45"></i>
                        </span>
                    </button>
                </div>
            @endif

            @if(!empty($downloadableResources))
                <div class="tw-flex tw-flex-col button-col">
                    <div class="btn tw-bg-white inverted is-dropdown">
                        <i class="unopen fas fa-download no-events tw-text-white"></i>
                        <i class="open fas fa-download no-events text-x-dark"></i>

                        <div class="dropdown-content tw-bg-white tw-shadow tiny tw-text-black">
                            <ul>
                                @foreach($downloadableResources as $resource)
                                    <li>
                                        <a class="tw-no-underline tw-text-black pa-1"
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
                <div class="tw-flex tw-flex-col button-col">
                    <button class="resetProgress btn" title="Reset Progress"
                            data-content-id="{{ $contentId }}"
                            data-brand="{{ $brand }}">
                        <span class="tw-text-white tw-bg-white inverted">
                            <i class="fas fa-redo-alt fa-flip-horizontal"></i>
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
