<div class="container fluid bg-grey-7 collapsed-h">
    <div class="container">
        <div class="flex flex-column grow pv-2">
            <div class="flex flex-row align-v-center">
                @if(!empty($showLogo))
                    <a href="{{ url()->route('members.learning-paths.show', ['singeo-method', config('railcontent.singeo_method_id')]) }}">
                        <img
                            src="{{ imgix('https://musora-ui.s3.amazonaws.com/logos/singeo-method.svg',
                            ["q" => 80, "w" => 200]) }}"
                            alt="The Singeo Method Logo"
                            class="invert-fill"
                            style="max-width:225px;width:200px;height:auto; padding-left: 1px;"
                        >
                    </a>

                    <div class="flex flex-column grow"></div>

                    <a href="{{ url()->route('members.learning-paths.show', ['singeo-method', config('railcontent.singeo_method_id')]) }}"
                       aria-label="See All Singeo Method Lessons"
                       class="text-singeo tiny no-decoration nowrap raised-hover pa-1 dense font-bold uppercase corners-10">
                        See All
                    </a>
                @else
                    <p class="body text-grey-3 uppercase">
                        Your Next Lesson...
                    </p>
                @endif
            </div>
            <div class="flex flex-row remove-borders">
                <transition appear name="fade">
                    <content-catalogue
                        brand="singeo"
                        catalogue-type="list"
                        theme-color="singeo"
                        :pre-loaded-content="{{ $currentLearningPathLesson }}"
                        :display-items-as-overview="true"
                        :lock-unowned="true"
                        data-user-id="{{ auth()->id() }}"
                        :is-admin="{{ json_encode(current_user()->getPermissionLevel() === 'administrator') }}"
                    >
                        @include('bladesora::members.skeletons.list-item', [
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
