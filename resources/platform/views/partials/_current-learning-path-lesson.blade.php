<div class="tw-w-full dark:tw-bg-[#002039] tw-bg-[#E7EFF6]">
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8">
        <div class="flex flex-column grow pv-2">
            <div class="flex flex-row align-v-center">
                @if(!empty($showLogo))
                    <a href="{{ url()->route('members.learning-paths.show', ['singeo-method', config('railcontent.singeo_method_id')]) }}">
                        <img
                            src="https://musora-ui.s3.amazonaws.com/logos/singeo-method.svg"
                            alt="The {{ $brand }} Method Logo"
                            class="invert-fill"
                            style="max-width:225px;width:200px;height:auto; padding-left: 1px;"
                        >
                    </a>

                    <div class="flex flex-column grow"></div>

                    <a href="{{ url()->route('members.learning-paths.show', ['singeo-method', config('railcontent.singeo_method_id')]) }}"
                       aria-label="See All {{ $brand }} Method Lessons"
                       class="text-{{ $brand }} tw-text-xs no-decoration nowrap raised-hover pa-1 dense font-bold uppercase corners-10">
                        See All
                    </a>
                @else
                    <p class="tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-xl tw-font-bold tw-mt-2 tw-ml-3 tw-leading-none">
                        Your Next Lesson...
                    </p>
                @endif
            </div>
            <div class="flex flex-row remove-borders">
                <transition appear name="fade">
                    <content-catalogue
                        brand="{{ $brand }}"
                        catalogue-type="list"
                        theme-color="{{ $brand }}"
                        :pre-loaded-content="{{ $currentLearningPathLesson }}"
                        :display-items-as-overview="true"
                        :lock-unowned="true"
                        data-user-id="{{ auth()->id() }}"
                        :is-admin="{{ json_encode(user()->isAdmin()) }}"
                    >
                        @include('partials.bladesora.members.skeletons.list-item', [
                            "overview" => true,
                            "showNumbers" => false,
                            "thumbnailType" => 'widescreen'
                        ])
                    </content-catalogue>
                </transition>
            </div>
        </div>
    </div>
</div>
