<div class="tw-flex tw-flex-row tw-flex-wrap">
    <div id="video-container" class="tw-flex tw-flex-col" dusk="video-player">
        <div class="widescreen">
            <iframe id="player" frameborder="0" allowfullscreen="1" allow="autoplay; encrypted-media" title="YouTube video player" src="https://www.youtube.com/embed/{{ $youtubeId }}?rel=0&autoplay=1&playsinline=1&modestthemeColoring=1"></iframe>
        </div>
        <div class="video-title tw-pt-1">
            <div class="tw-flex tw-flex-row">
                <h1 class="tw-flex heading tw-text-white">{{ $lessonTitle }}</h1>

                @if(!empty($lessonResources))
                    <div class="tw-flex tw-flex-col tw-align-top sq-btn-col tw-mr-2">
                        <div class="btn tw-bg-{{ $brand }} inverted tw-text-{{ $brand }} is-dropdown"
                             data-tooltip="Download Resources">
                            <i class="unopen fas fa-download no-events tw-text-{{ $brand }}"></i>
                            <i class="open fas fa-download no-events tw-text-white"></i>

                            <div class="dropdown-content tw-bg-white tw-shadow tiny tw-text-black">
                                <ul>
                                    @foreach($lessonResources as $resource)
                                        <li>
                                            <a class="tw-no-underline tw-text-black pa-1"
                                               href="{{ $resource['resource_url'] }}"
                                               target="_blank"
                                               download>
                                                <i class="fas {{ get_resource_icon($resource['resource_url']) }} tw-mr-1" style="width:20px;text-align:center;"></i>  {{ $resource['resource_name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="">
                    <p id="liveIndicator" class="bg-error tw-text-white tiny tw-font-bold corners-3 tw-text-center tw-uppercase tw-px-1">live</p>
                </div>
            </div>
            <h4 class="body text-grey-3 {{ $contentType }}">
            @if(!empty($parentTitle))
                From <a href="{{ $courseUrl }}" class="tw-text-{{ $brand }} tw-no-underline">
                    {{ $parentTitle }}
                </a>
            @else
                With
                @foreach($instructors as $index => $instructor)
                    {{ $instructor->fetch('fields.name') }}
                    @if($index < (count($instructors) - 1)),@endif
                @endforeach
            @endif
            </h4>
        </div>
    </div>
    <div id="chat-container" class="tw-flex tw-flex-col" dusk="chat-container">
        <chat
            api-key="{{ $apiKey }}"
            token="{{ $token }}"
            user-id="{{ current_user()->getId() }}"
            chat-channel-name="{{ $chatChannelName }}"
            questions-channel-name="{{ $questionsChannelName }}"
            :is-administrator="{{ json_encode(boolval($isAdministrator)) }}"
            :user-data="{{ json_encode($userData) }}"
            embed-url="{{ $embedUrl }}"
        ></chat>
    </div>
</div>