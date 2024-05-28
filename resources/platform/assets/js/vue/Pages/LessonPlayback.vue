<template>
    <div class="tw-w-full tw-mx-auto tw-px-4 md:tw-px-8"
        :class="hasRelatedLessons ? 'tw-max-w-[1703px]' : 'tw-max-w-[1450px]'">
        <Breadcrumb :breadcrumbs="contentBreadcrumb.pages" />

        <div
            class="tw-grid tw-grid-cols-3 xl:tw-gird-rows-4 xl:tw-grid-cols-[auto_auto_420px] tw-mt-3 tw-flex-col tw-gap-4">
            <!-- VIDEO WRAPPER -->
            <section class="tw-col-span-3 xl:tw-row-span-2 tw-w-full tw-flex"
                :class="hasRelatedLessons && isRelatedSectionOpen ? 'xl:tw-col-span-2' : 'tw-mb-4'">
                <!-- Video Content -->
                <div class="tw-w-full">
                    <!--Video-->
                    <div class="tw-w-full tw-aspect-video dark:tw-bg-[#081825] tw-bg-[#EDEDED]">
                        <template v-if="videoProps.videoId">
                            <!-- YouTube -->
                            <transition v-if="videoProps.videoType === 'youtube'" appear name="fade">
                                <YoutubePlayer :video-id="videoProps.videoId" ref="mediaElementVueInstance"
                                    :brand="brand" :theme-color="brand" :video-length="videoProps.videoLength"
                                    :progress-state="videoProps.progressState" :content-id="videoProps.id"
                                    :use-intersection-observer="true" :start-second="startSecond"
                                    :end-second="videoProps.videoLength" :total-duration="videoProps.videoLength"
                                    :seek-to-time="seekToTime" @play="handleVideoPlay" @pause="handleVideoPause"
                                    @onVideoEnd="handleVideoEnd" />
                            </transition>
                            <!-- Vimeo video (legacy player) -->
                            <transition v-else-if="videoProps.videoType === 'vimeo' && videoProps.useLegacyPlayer"
                                appear name="fade">
                                <video-media-element ref="mediaElementVueInstance" element-id="lessonPlayer"
                                    :brand="videoProps.brand" :theme-color="videoProps.brand"
                                    :poster="videoProps.thumbnailUrl" :sources="videoProps.sources"
                                    :hls-manifest-url="videoProps.hlsManifestUrl" :video-id="videoProps.vimeoVideoId"
                                    :content-id="videoProps.id" :current-second="videoProps.lastWatchPositionInSeconds"
                                    :progress-state="videoProps.progressState" :video-length="videoProps.videoLength"
                                    :chapters="videoProps.chapters" :user-id="videoProps.userId"
                                    :like-count="videoProps.likeCount" :is-liked="videoProps.isLiked"
                                    :check-for-timecode="videoProps.checkForTimecode" :seek-to-time="seekToTime"
                                    @playing="handleVideoPlay" @pause="handleVideoPause" @ended="handleVideoEnd">
                                    <div :class="`widescreen title tw-text-${brand}`">
                                        <i class="fas fa-spinner fa-spin absolute-center"></i>
                                    </div>
                                </video-media-element>
                            </transition>
                            <!-- Vimeo -->
                            <transition v-else-if="videoProps.videoType === 'vimeo' && !videoProps.useLegacyPlayer"
                                appear name="fade">
                                <video-player ref="mediaElementVueInstance" :theme-color="brand" :brand="brand"
                                    :poster="videoProps.thumbnailUrl" :sources="videoProps.sources"
                                    :ranges="videoProps.ranges ? videoProps.ranges : {}"
                                    :ranges-video-ids="videoProps.rangesVideoIds ? videoProps.rangesVideoIds : {}"
                                    :show-range-buttons="videoProps.showRangeButtons ? videoProps.showRangeButtons : false"
                                    :hls-manifest-url="videoProps.hlsManifestUrl" :captions="videoProps.captions"
                                    :chapters="videoProps.chapters" :current-second="videoProps.currentSecond"
                                    :content-id="videoProps.contentId" :user-id="videoProps.userId"
                                    :video-id="videoProps.videoId" :video-length="videoProps.videoLength"
                                    :total-duration="videoProps.totalDuration" :cast-title="videoProps.castTitle"
                                    :use-intersection-observer="videoProps.useIntersectionObserver"
                                    :seek-to-time="seekToTime" @play="handleVideoPlay" @pause="handleVideoPause"
                                    @onVideoEnd="handleVideoEnd">
                                    <div :class="`widescreen title tw-text-${brand} tw-mb-2`"></div>
                                </video-player>
                            </transition>
                            <div v-else
                                class="tw-w-full tw-flex tw-flex-col tw-justify-center tw-items-center tw-aspect-video tw-text-black dark:tw-text-white tw-text-3xl tw-font-bold">
                                ERROR LOADING VIDEO...
                            </div>
                        </template>
                        <template v-else>
                            <div
                                class="tw-w-full tw-flex tw-flex-col tw-justify-center tw-items-center tw-aspect-video tw-text-black dark:tw-text-white tw-text-3xl tw-font-bold">
                                No Video Data
                            </div>
                        </template>
                    </div>

                    <VideoResources :theme-color="videoResources.themeColor" :brand="videoResources.brand"
                        :title="videoResources.title" :lesson-type="videoResources.lessonType"
                        :thumbnail-url="videoResources.thumbnailUrl" :description="videoResources.description"
                        :instructors="videoResources.instructors" :parent-title="videoResources.parentTitle"
                        :is-liked="videoResources.isLiked" :like-count="videoResources.likeCount"
                        :is-added="videoResources.isAdded" :content-id="videoResources.contentId"
                        :user-id="videoResources.userId" :resources="videoResources.resources"
                        :show-add-to-list="videoResources.showAddToList"
                        :show-info-button="videoResources.showInfoButton" :show-practice-button="showPracticeButton"
                        :show-share-button="false" :show-complete-button="true"
                        :report-user-email="videoResources.reportUserEmail"
                        :report-user-name="videoResources.reportUserName"
                        :report-recipient="videoResources.reportRecipient" :report-logo="videoResources.reportLogo"
                        :lesson="{ completed: videoButtons.isCompleted }"
                        @open-practice-soundslice="openSlice(videoResources.title, formattedChapters.length, 0, false)"
                        :difficulty="videoResources.difficulty" />

                    <ContentInfo :breadcrumbs="contentBreadcrumb.pages" :content-description="contentDescription"
                        :content-chapters="videoProps.chapters" :instructors="contentInstructors" />

                    <VideoButtons :has-branded-color="true" :prev-lesson-url="videoButtons.prevLessonUrl"
                        :next-lesson-url="videoButtons.nextLessonUrl" :brand="brand"
                        :prev-label="videoButtons.prevLabel" :next-label="videoButtons.nextLabel"
                        :has-qa-video="videoButtons.hasQAVideo" />

                    <ContentProgress :brand="brand" :is-completed="lessonData.completed"
                        :progress="lessonData.progress_percent" :xp-amount="progressXp" :is-started="lessonData.progress_percent > 0"
                        :next-lesson-url="videoButtons.nextLessonUrl" :show-complete-button="true"
                        :content-id="videoProps.contentId" />
                </div>
                <!-- Related Lessons Toggle -->
                <RelatedLessonsToggle
                    v-if="hasRelatedLessons && relatedLessons.data.length > 0"
                    :relatedLessons="relatedLessons"
                    :isRelatedSectionOpen="isRelatedSectionOpen"
                    v-model:isRelatedSectionOpen="isRelatedSectionOpen"
                />
            </section>

            <!--Related Section -->
            <RelatedLessons
                v-if="hasRelatedLessons && relatedLessons.data.length > 0"
                :isRelatedSectionOpen="isRelatedSectionOpen"
                :relatedLessons="relatedLessons"
                v-model:isRelatedSectionOpen="isRelatedSectionOpen"
            />

            <!-- Lesson Content Wrapper -->
            <section class="tw-col-span-3 xl:tw-row-span-2"
                :class="isRelatedSectionOpen ? 'xl:tw-col-span-2' : `${hasRelatedLessons ? 'xl:tw-mr-[64px]' : ''}`">
                <div v-if="assignments.length > 0" class="tw-flex tw-flex-col tw-flex-grow tw-mt-3 tw-w-full">
                    <div
                        class="tw-flex tw-flex-row tw-w-full tw-justify-between tw-items-center tw-border-b tw-border-[#e5e8e8] dark:tw-border-[#223F57] tw-pb-4">
                        <h1 class="heading dark:tw-text-white">Assignments</h1>
                        <button class="tw-z-10" @click="state.assignmentCollapsed = !state.assignmentCollapsed">
                            <div class="tw-border-2 tw-text-[#000C17] tw-border-[#000C17] dark:tw-text-white dark:tw-border-white tw-h-[50px] tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center"
                                :class="!state.assignmentCollapsed && 'tw-rotate-180'">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </button>
                    </div>
                    <div class="tw-flex-row tw-w-full" :class="state.assignmentCollapsed ? 'tw-hidden' : 'tw-flex'">
                        <assignments-container :lesson-data="lessonData" :assignments="assignments" :brand="brand"
                            :user-id="videoResources.userId">
                        </assignments-container>
                    </div>
                </div>
                <div class="tw-flex tw-flex-col tw-flex-grow tw-w-full">
                    <div class="tw-flex tw-flex-row tw-w-full">
                        <VideoComments :theme-color="commentsProps.themeColor" :brand="commentsProps.brand"
                            :content-id="commentsProps.contentId" :user-id="commentsProps.userId"
                            :user-name="commentsProps.userName" :user-avatar="commentsProps.userAvatar"
                            :user-xp="commentsProps.userXp" :user-access-level="commentsProps.userAccessLevel"
                            :profile-base-route="commentsProps.profileBaseRoute"
                            :is-admin="commentsProps.isAdmin === 'true' ? true : false">
                        </VideoComments>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
// TODO: ADD THE PLAY AND PAUSE EVENTS TO THE VIDEO PLAYERS
import { ref, computed, reactive } from "vue";
import { storeToRefs } from 'pinia';
import { useUserStore } from "../../stores/user";

import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import YoutubePlayer from "../vuesora/components/YoutubePlayer/YoutubePlayer.vue";
import VideoButtons from "../components/VideoButtons/VideoButtons.vue";
import VideoResources from "../vuesora/components/VideoResources/VideoResources.vue";
import VideoComments from "../vuesora/views/comments/Comments.vue";
import ContentInfo from "../components/ContentInfo/ContentInfo.vue";
import Intercom from "../vuesora/assets/js/services/intercom";
import Helpscout from "../vuesora/assets/js/services/helpscout";
import ProgressTracker from "../vuesora/assets/js/classes/progress-tracker";
import ContentService from '../vuesora/assets/js/services/content';
import ContentProgress from "../components/ContentProgress/ContentProgress.vue";
import RelatedLessonsToggle from "../components/RelatedLessons/RelatedLessonsToggle.vue";
import RelatedLessons from "../components/RelatedLessons/RelatedLessons.vue";

const props = defineProps({
    progressXp: {
        type: String,
        default: ''
    },
    lessonData: {
        type: [Array, Object],
        default: () => []
    },
    assignments: {
        type: Array,
        default: [],
    },
    hasRelatedLessons: {
        type: Boolean,
        default: false,
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
    contentBreadcrumb: {
        type: Object,
        default: {},
    },
    contentDescription: {
        type: String,
        default: ''
    },
    contentInstructors: {
        type: Array,
        default: []
    }
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
let hasBeenPlayed = false;
let progressTracker;

//Refs
const isRelatedSectionOpen = ref(props.hasRelatedLessons);
const openSoundslice = ref(false);
const seekToTime = ref(0);
const chapterStartTime = ref(0);
const chapterEndTime = ref(props.videoProps.totalDuration);
const soundsliceTitle = ref('');
const startLooping = ref(false);
const mediaElementVueInstance = ref(null)

const state = reactive({
    assignmentCollapsed: false,
});

//Computed
const formattedChapters = computed(() => {
    if (props.videoProps.chapters?.length) {
        return props.videoProps.chapters.map(({ chapter_description, chapter_thumbnail_url, chapter_timecode }) => {
            return {
                title: chapter_description,
                thumbnail: chapter_thumbnail_url,
                time: chapter_timecode
            }
        })
    }
    return [];
});

const showPracticeButton = computed(() => {
    return !!props.soundsliceSlug;
});

//Methods
const handleVideoPlay = (payload) => {
    if (['started', 'completed'].indexOf(payload.progressState) === -1 && !hasBeenPlayed) {
        ContentService.markContentAsStarted(payload.contentId);
    }
    if (progressTracker == null) {
        progressTracker = new ProgressTracker();
        const sessionTokenElement = document.querySelector('#sessionToken');
        if (mediaElementVueInstance.value) {
            window.addEventListener('unload', (event) => {
                progressTracker.send({
                    mediaId: mediaElementVueInstance.value.videoId,
                    mediaType: 'video',
                    mediaCategory: 'vimeo',
                    watchPosition: mediaElementVueInstance.value.currentTimeInSeconds
                        || mediaElementVueInstance.value.currentTime,
                    totalDuration: mediaElementVueInstance.value.videoLength
                        || mediaElementVueInstance.value.totalDuration,
                    sessionToken: sessionTokenElement.value || null,
                    brand: props.videoProps.brand,
                    contentId: mediaElementVueInstance.value.contentId
                });
            });
        }
    }
    hasBeenPlayed = true;
    progressTracker.start();
};

const handleVideoPause = (payload) => {
    progressTracker.stop();
};

const handleVideoEnd = () => {
    isRelatedSectionOpen.value = true;
};

const getBrandSpecificParams = () => {
    return ({
        drumeo: '&show_chords=0',
        singeo: '&show_staff_t1=0&show_staff_t2=0&show_chords=0',
        guitareo: '',
        pianote: '&show_chords=1'
    }[brand]);
};

const openSlice = (title, index, startAt, loop) => {
    if (mediaElementVueInstance.value) {
        mediaElementVueInstance.value.pauseVideo();
    }
    soundsliceTitle.value = title;
    chapterStartTime.value = startAt;
    chapterEndTime.value = formattedChapters.value.length === index ? props.videoProps.totalDuration : formattedChapters.value[index].time;
    startLooping.value = loop;
    openSoundslice.value = true;
};

const seekToChapter = (time) => {
    isRelatedSectionOpen.value = false; //Run by Mitch
    seekToTime.value = time;
};

const handleCloseSoundslice = () => {
    openSoundslice.value = false;
    startLooping.value = false;

    document.body.classList.remove('no-scroll', 'dim-sidebar');

    Helpscout.showWidget();
    Intercom.showWidget();
};
</script>
