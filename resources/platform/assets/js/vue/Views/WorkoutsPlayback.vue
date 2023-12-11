<template>
    <div>
        <Breadcrumb :first-level-url="breadcrumbFirstLevelUrl" :first-level-title="breadcrumbFirstLevelTitle"
            :last-level-title="breadcrumbLastLevelTitle" />
        <div class="lg:tw-container tw-mx-auto lg:tw-px-8 dark:tw-text-white tw-flex tw-w-full tw-mt-[30px] tw-mb-[15px]">
            <div class="tw-grow">
                <div class="tw-w-full" v-if="videoProps.videoId">
                    <!-- YouTube video -->
                    <transition v-if="videoProps.videoType === 'youtube'" appear name="fade">
                        <YoutubePlayer :video-id="videoProps.videoId" />
                    </transition>
                    <!-- Vimeo video (legacy player) -->
                    <transition v-else-if="videoProps.videoType === 'vimeo' && videoProps.useLegacyPlayer" appear
                        name="fade">
                        <video-media-element ref="mediaElementVueInstance" element-id="lessonPlayer"
                            :brand="videoProps.brand" :theme-color="videoProps.brand"
                            :poster="videoProps.videoPosterImageUrl" :sources="videoProps.videoPlaybackEndpoints"
                            :hls-manifest-url="videoProps.hlsManifestUrl" :video-id="videoProps.vimeoVideoId"
                            :content-id="videoProps.id" :current-second="videoProps.lastWatchPositionInSeconds"
                            :progress-state="videoProps.progressState" :video-length="videoProps.videoLength"
                            :chapters="videoProps.chapters" :user-id="videoProps.userId" :like-count="videoProps.likeCount"
                            :is-liked="videoProps.isLiked" :check-for-timecode="videoProps.checkForTimecode">

                            <div :class="`widescreen title tw-text-${brand}`">
                                <i class="fas fa-spinner fa-spin absolute-center"></i>
                            </div>
                        </video-media-element>
                    </transition>
                    <!-- Vimeo video -->
                    <transition v-else-if="videoProps.videoType === 'vimeo' && !videoProps.useLegacyPlayer" appear
                        name="fade">
                        <video-player ref="mediaElementVueInstance" :theme-color="brand" :brand="brand"
                            :poster="videoProps.poster" :sources="videoProps.sources"
                            :ranges="videoProps.ranges ? videoProps.ranges : {}"
                            :ranges-video-ids="videoProps.rangesVideoIds ? videoProps.rangesVideoIds : {}"
                            :show-range-buttons="videoProps.showRangeButtons ? videoProps.showRangeButtons : false"
                            :hls-manifest-url="videoProps.hlsManifestUrl" :captions="videoProps.captions"
                            :chapters="videoProps.chapters" :current-second="videoProps.currentSecond"
                            :content-id="videoProps.contentId" :user-id="videoProps.userId" :video-id="videoProps.videoId"
                            :video-length="videoProps.videoLength" :total-duration="videoProps.totalDuration"
                            :cast-title="videoProps.castTitle"
                            :use-intersection-observer="videoProps.useIntersectionObserver">
                            <div :class="`widescreen title tw-text-${brand} tw-mb-2`"></div>
                        </video-player>
                    </transition>
                    <div v-else>ERROR LOADING VIDEO...</div>
                </div>
                <VideoResources :theme-color="videoResources.themeColor" :brand="videoResources.brand"
                    :title="videoResources.title" :lesson-type="videoResources.lessonType"
                    :thumbnail-url="videoResources.thumbnailUrl" :description="videoResources.description"
                    :instructors="videoResources.instructors" :parent-title="videoResources.parentTitle"
                    :is-liked="videoResources.isLiked" :like-count="videoResources.likeCount"
                    :is-added="videoResources.isAdded" :content-id="videoResources.contentId"
                    :user-id="videoResources.userId" :resources="videoResources.resources"
                    :show-add-to-list="videoResources.showAddToList" :show-info-button="videoResources.showInfoButton"
                    :report-user-email="videoResources.reportUserEmail" :report-user-name="videoResources.reportUserName"
                    :report-recipient="videoResources.reportRecipient" :report-logo="videoResources.reportLogo">
                </VideoResources>
                <VideoChapters :chapters="formattedChapters"></VideoChapters>
                <VideoButtons :prev-lesson-url="videoButtons.prevLessonUrl" :next-lesson-url="videoButtons.nextLessonUrl"
                    :brand="brand" :prev-label="videoButtons.prevLabel" :next-label="videoButtons.nextLabel"
                    :has-qa-video="videoButtons.hasQAVideo" />
                <div class="tw-flex tw-flex-col tw-flex-grow tw-w-full">
                    <div class="tw-flex tw-flex-row tw-w-full">
                        <VideoComments :theme-color="commentsProps.themeColor" :brand="commentsProps.brand"
                            :content-id="commentsProps.contentId" :user-id="commentsProps.userId"
                            :user-name="commentsProps.userName" :user-avatar="commentsProps.userAvatar"
                            :user-xp="commentsProps.userXp" :user-access-level="commentsProps.userAccessLevel"
                            :profile-base-route="commentsProps.profileBaseRoute" :is-admin="commentsProps.isAdmin">
                        </VideoComments>
                    </div>
                </div>
            </div>
            <div class="tw-ml-[10px] tw-flex tw-transition-all tw-h-full">
                <div class="tw-flex tw-w-[402px]" v-if="!isSidebarOpen">
                    <div class="tw-rounded-[5px] tw-border tw-border-[#1E364A] tw-overflow-hidden tw-transition-all">
                    <div class="tw-flex tw-flex-col">
                        <div class="tw-bg-[#081825] tw-pt-[24px] tw-pb-[16px] tw-flex tw-justify-between tw-px-[18px]">
                            <h3 class="tw-text-[20px] tw-font-bold tw-font-open-sans">Related Workouts</h3>
                            <button @click="isSidebarOpen = !isSidebarOpen">
                                <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.55 11.5L27.55 26.5" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" />
                                    <path d="M17.1334 24.5L22.55 19M22.55 19L17.1334 13.5M22.55 19L9.55005 19"
                                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <RelatedCard v-for=" relatedLesson  in  formattedRelatedLessons " :key="relatedLesson.id"
                        :thumbnail="relatedLesson.thumbnail" :instructor="relatedLesson.instructor"
                        :title="relatedLesson.title" :difficulty="relatedLesson.difficulty"
                        :content-type="relatedLesson.contentType" :id="relatedLesson.id" :url="relatedLesson.url" />
                </div>
                </div>
                <div class="tw-ml-[21px] tw-transition-all tw-overflow-hidden" v-if="isSidebarOpen">
                    <button @click="isSidebarOpen = !isSidebarOpen">
                        <svg id="icon-workouts-filled" width="38" height="38" viewBox="0 0 38 38" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.5" y="0.5" width="37" height="37" rx="18.5" transform="matrix(-1 0 0 1 37 0)"
                                fill="black" stroke="#223F57" />
                            <path d="M9 11.0498L9 26.0498" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M19.4167 24.0498L14 18.5498M14 18.5498L19.4167 13.0498M14 18.5498L27 18.5498"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
// TODO: ADD THE PLAY AND PAUSE EVENTS TO THE VIDEO PLAYERS
import { onMounted, ref, computed } from "vue";
import { storeToRefs } from 'pinia';
import { useUserStore } from "../../stores/user";

import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import YoutubePlayer from "../vuesora/components/YoutubePlayer/YoutubePlayer.vue";
import RelatedCard from "../components/Catalogue/RelatedCard.vue";
import VideoButtons from "../components/VideoButtons/VideoButtons.vue";
import VideoResources from "../vuesora/components/VideoResources/VideoResources.vue";
import VideoComments from "../vuesora/views/comments/Comments.vue";
import VideoChapters from "../components/VideoChapters/VideoChapters.vue";
// READ ME: Importing video player breaks the app for some reason.
// We need further investigation on this matter, but for now let's use it globally.
//import VideoPlayer from "../vuesora/components/VideoPlayer/VideoPlayer.vue";

const props = defineProps({
    breadcrumbFirstLevelUrl: {
        type: String,
        default: ''
    },
    breadcrumbFirstLevelTitle: {
        type: String,
        default: ''
    },
    breadcrumbLastLevelTitle: {
        type: String,
        default: ''
    },
    videoProps: {
        type: Object,
        default: {},
    },
    relatedLessons: {
        type: Object,
        default: {},
    },
    videoResources: {
        type: Object,
        default: {},
    },
    videoButtons: {
        type: Object,
        default: {},
    },
    commentsProps: {
        type: Object,
        default: {},
    },
    soundsliceSlug: {
        type: String,
        default: '',
    },
});

const isSidebarOpen = ref(false);

const formattedRelatedLessons = computed(() => {
    return props.relatedLessons.data.map((lesson) => {
        const { compiled_view_data, difficulty_string, instructors } = lesson;
        const { id, title, type, thumbnail_url, url } = JSON.parse(compiled_view_data);
        const instructor = instructors[0] || 'INSTRUCTOR';

        return {
            id,
            thumbnail: thumbnail_url,
            instructor,
            title,
            difficulty: difficulty_string,
            contentType: type,
            url,
            lesson
        }
    })
});

const formattedChapters = computed(() => {
    return props.videoProps.chapters.map(({ chapter_description, chapter_thumbnail_url, chapter_timecode }) => {
        return {
            title: chapter_description,
            thumbnail: chapter_thumbnail_url,
            time: chapter_timecode
        }
    })
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

onMounted(() => {
    console.log('chapters', props.relatedLessons.data)
})
</script>
