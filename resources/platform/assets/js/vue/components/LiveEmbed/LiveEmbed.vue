<template>
    <div class="tw-flex tw-flex-col lg:tw-flex-row">
        <!-- Video -->
        <div id="video-container" class="tw-w-full tw-flex tw-flex-col sm:tw-mb-8 lg:tw-mb-0" dusk="video-player">
            <div class="widescreen">
                <iframe id="player" frameborder="0" allowfullscreen="1" allow="autoplay; encrypted-media" title="YouTube video player" :src="`https://www.youtube.com/embed/${youtubeId}?rel=0&autoplay=1&playsinline=1&modestthemeColoring=1`"></iframe>
            </div>
            <div class="video-title tw-pt-1">
                <div class="tw-flex tw-flex-row">
                    <!-- Lesson Title -->
                    <div class="tw-flex tw-flex-wrap tw-items-center tw-grow tw-py-[15px] tw-pr-2">
                        <div class="tw-text-[#00101D] dark:tw-text-white">
                            <h1 class="heading">{{ lessonTitle }}</h1>
                        </div>
                    </div>

                    <div v-if="hasLessonResources" class="flex flex-column align-center sq-btn-col">
                        <div :class="`btn bg-${brand} inverted text-${brand} is-dropdown`"
                             data-tooltip="Download Resources">
                            <i :class="`unopen fas fa-download no-events text-${brand}`"></i>
                            <i class="open fas fa-download no-events text-white"></i>

                            <div class="dropdown-content bg-white shadow tiny text-black">
                                <ul>
                                    <li v-for="resource in lessonResources">
                                        <a class="no-decoration text-black pa-1"
                                           :href="resource['resource_url']"
                                           target="_blank"
                                           download>
                                            <i :class="`fas ${getResourceIcon(resource['resource_url'])} mr-1 tw-w-5`"></i>  {{ resource['resource_name'] }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Live Indicator -->
                    <div class="">
                        <p id="liveIndicator" class="bg-error tw-mt-1 tw-text-white tw-text-xs tw-font-bold corners-3 tw-text-center tw-uppercase tw-px-1">live</p>
                    </div>

                </div>

                <!-- Lesson Instructors -->
                <h4 :class="`body text-grey-3 ${contentType}`">
                    <template v-if="parentTitle">
                        From <a :href="courseUrl" :class="`tw-text-${brand} tw-no-underline`">
                        {{ parentTitle }}
                        </a>
                    </template>
                    <template v-else>
                        With
                        {{ instructorNames }}
                    </template>
                </h4>
            </div>
        </div>

        <!-- Chat -->
        <div id="chat-container" class="tw-flex tw-flex-col tw-w-full lg:tw-w-[420px] tw-mb-4 lg:tw-ml-4 tw-overflow-hidden" dusk="chat-container">
            <Chat
                :api-key="apiKey"
                :token="token"
                :user-id="userId"
                :chat-channel-name="chatChannelName"
                :questions-channel-name="questionsChannelName"
                :is-administrator="isAdministrator"
                :user-data="userData"
                :embed-url="embedUrl"
            />
        </div>
    </div>

</template>
<script setup>
import { useUserStore } from "../../../stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import { computed } from "vue";
import Chat from '../../Libraries/Chatsora/components/Chat/Chat';

const props = defineProps({
    apiKey: {
        type: String,
        default: '',
    },
    chatChannelName: {
        type: String,
        default: '',
    },
    courseUrl: {
        type: String,
        default: '',
    },
    embedUrl: {
        type: String,
        default: '',
    },
    isAdministrator: {
        type: Boolean,
        default: false,
    },
    lessonContent: {
        type: Object,
        default: () => {},
    },
    lessonTitle: {
        type: String,
        default: '',
    },
    lessonResources: {
        type: Array,
        default: [],
    },
    parentTitle:{
        type: String,
        default: '',
    },
    questionsChannelName: {
        type: String,
        default: '',
    },
    token: {
        type: String,
        default: '',
    },
    youtubeId: {
        type: String,
        default: '',
    },
    userData: {
        type: Object,
        default: () => {},
    },
    userId: {
        type: String,
        default: '',
    },
})

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const hasLessonResources = computed(() => {
    return props.lessonResources.length > 0;
})

const lessonTitle = computed(() => {
    return props.lessonContent.fields.find((l) => l.key === 'title')?.value;
})

const contentType = computed(() => {
    return props.lessonContent.type?.value;
})

const instructors = computed(() => {
    return props.lessonContent.fields.find((l) => l.key === 'instructor')?.value;
})

const instructorNames = computed(() => {
    if(Array.isArray(instructors.value)){
        const arr = [];
        instructors.value.map((instructor) => {
            arr.push(instructor.fields.find((i) => i.key === 'name')?.value);
        });

        return arr.join(', ')
    } else {
        return instructors.value?.name;
    }


})

const getResourceIcon = (url) => {
    const extension = url.split('.').pop();

    switch(extension) {
        case 'png':
            return 'fa-file-text';
        case 'pdf':
            return 'fa-file-pdf';
        case 'zip':
            return 'fa-file-archive';
        case 'mp3':
        case 'wav':
            return 'fa-file-audio';
        case 'mp4':
            return 'fa-file-video';
        default:
            return 'fa-cloud-download';
    }
}
</script>
