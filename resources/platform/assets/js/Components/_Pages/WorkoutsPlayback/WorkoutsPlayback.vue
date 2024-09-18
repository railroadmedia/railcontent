<template>
    <div class="tw-w-full">
        <div class="tw-w-full tw-mx-auto tw-max-w-[1450px] tw-px-4">
            <Breadcrumb :breadcrumbs="breadcrumbProps" classOverride="" />
        </div>
        <div class="tw-grid tw-grid-cols-3 xl:tw-gird-rows-4 xl:tw-grid-cols-[auto_auto_420px] tw-w-full tw-max-w-[1450px] tw-mx-auto tw-px-4 tw-mt-3 tw-flex-col tw-gap-4">
            <!-- VIDEO WRAPPER -->
            <section class="tw-col-span-3 xl:tw-row-span-2 tw-w-full tw-flex"
                :class="isRelatedSectionOpen ? 'xl:tw-col-span-2' : 'tw-mb-4'">
                <!-- Video Content -->
                <div class="tw-w-full">
                    <!--Video-->
                    <div class="tw-w-full tw-aspect-video dark:tw-bg-[#081825] tw-bg-[#EDEDED] tw-relative">
                        <!-- Skeleton Loading -->
                        <div v-if="isLoading" class="tw-animate-pulse tw-absolute tw-top-0 tw-left-0 tw-w-full tw-h-full tw-bg-[#F2F2F2] dark:tw-bg-[#002039]"></div>
                        <!-- Upgrade Cover -->
                        <MembershipUpgradeVideoCover v-else-if="noAccess" :thumbnail-url="videoData.thumbnail_url" />
                        <template v-else-if="videoData?.video?.external_id">
                            <!-- Draft Label -->
                            <DraftLabel v-show="showDraftLabel" />

                            <!-- YouTube -->
                            <transition v-if="videoData?.video?.type === 'youtube'" appear name="fade">
                                <YoutubePlayer :video-id="videoData?.video?.external_id" ref="mediaElementVueInstance" :brand="brand"
                                    :theme-color="brand" :video-length="videoData.length_in_seconds"
                                     :content-id="videoData.id"
                                    :use-intersection-observer="true" :start-second="startSecond"
                                    :end-second="videoData.length_in_seconds" :total-duration="videoData.length_in_seconds"
                                    :seek-to-time="seekToTime" @play="handleVideoPlay" @pause="handleVideoPause"
                                    @onVideoEnd="handleVideoEnd"

                                    :progress-state="videoProps.progressState"
                                />
                            </transition>
                            <!-- Vimeo video (legacy player) -->
                            <transition v-else-if="videoData?.video?.type === 'vimeo-video' && videoProps.useLegacyPlayer" appear
                                name="fade">
                                <video-media-element ref="mediaElementVueInstance" element-id="lessonPlayer"
                                    :brand="brand" :theme-color="brand"
                                    :poster="videoData.thumbnail_url" :sources="videoData?.video?.video_playback_endpoints"
                                    :hls-manifest-url="videoData?.video?.hlsManifestUrl" :video-id="videoData?.video?.external_id"
                                    :content-id="videoData.id" :video-length="videoData.length_in_seconds"
                                    :chapters="videoData?.chapters" :user-id="userId" :seek-to-time="seekToTime"
                                    @playing="handleVideoPlay" @pause="handleVideoPause" @ended="handleVideoEnd"

                                   :current-second="videoProps.lastWatchPositionInSeconds" :progress-state="videoProps.progressState"
                                   :check-for-timecode="videoProps.checkForTimecode"
                                >
                                    <div :class="`widescreen title tw-text-${brand}`">
                                        <i class="fas fa-spinner fa-spin absolute-center"></i>
                                    </div>
                                </video-media-element>
                            </transition>
                            <!-- Vimeo -->
                            <transition v-else-if="videoData?.video?.type === 'vimeo-video' && !videoProps.useLegacyPlayer" appear
                                name="fade">
                                <video-player ref="mediaElementVueInstance"
                                    :theme-color="brand" :brand="brand"
                                    :poster="videoData.thumbnail_url" :sources="videoData?.video?.video_playback_endpoints"
                                    :hls-manifest-url="videoData?.video?.hlsManifestUrl"
                                    :chapters="videoData?.chapters"
                                    :content-id="videoData.id" :user-id="userId"
                                    :video-id="videoData?.video?.external_id"
                                    :total-duration="videoData.length_in_seconds"
                                    :use-intersection-observer="videoProps.useIntersectionObserver"
                                    :seek-to-time="seekToTime" @play="handleVideoPlay" @pause="handleVideoPause"
                                    @onVideoEnd="handleVideoEnd"

                                    :cast-title="videoProps.castTitle"
                                    :captions="videoProps.captions"
                                    :current-second="videoProps.currentSecond"
                                    :ranges="videoProps.ranges ? videoProps.ranges : {}"
                                    :ranges-video-ids="videoProps.rangesVideoIds ? videoProps.rangesVideoIds : {}"
                                    :show-range-buttons="videoProps.showRangeButtons ? videoProps.showRangeButtons : false"
                                >
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

                    <VideoResources
                        :theme-color="brand" :brand="brand"
                        :title="videoData.title" :lesson-type="videoData.type"
                        :thumbnail-url="videoData.thumbnail_url" :description="videoData.description"
                        :instructors="videoData.instructor" :content-id="videoData.id"
                        :user-id="userId" :resources="videoData.resources"
                        :show-practice-button="showPracticeButton" :show-share-button="false" :show-complete-button="true"
                        :report-user-email="userEmail" :report-user-name="userDisplayName" report-recipient="support+question-and-answer@drumeo.com"
                        :difficulty="videoData.difficulty"
                        :is-liked="likeData?.isLiked" :like-count="likeData?.likeCount" :is-completed="isCompleted"
                        :report-logo="videoResources.reportLogo"
                         :no-access="noAccess"
                        :show-add-to-list="videoResources.showAddToList" :show-info-button="videoResources.showInfoButton"

                        @open-practice-soundslice="openSlice(videoData.title, videoData.chapters?.length, 0, false)"
                        @on-like-content="likeContent" @on-complete-content="completeContent"
                    />

                    <ContentInfo :breadcrumbs="contentBreadcrumb" :content-description="contentDescription"
                        :content-chapters="videoData?.chapters" :instructors="contentInstructors" />

                    <VideoChapters v-if="!noAccess && videoData.chapters?.length" :chapters="videoData.chapters" @open-slice="openSlice"
                        @seek-to-chapter="seekToChapter" />

                    <VideoButtons :prev-lesson-url="videoButtons.prevLessonUrl"
                        :next-lesson-url="videoButtons.nextLessonUrl" :brand="brand" :prev-label="videoButtons.prevLabel"
                        :next-label="videoButtons.nextLabel" :has-qa-video="videoButtons.hasQAVideo" />
                </div>
                <!-- Related Lessons Toggle -->
                <RelatedLessonsToggle
                    v-if="relatedLessons.data && relatedLessons.data.length > 0"
                    :relatedLessons="relatedLessons"
                    :isRelatedSectionOpen="isRelatedSectionOpen"
                    v-model:isRelatedSectionOpen="isRelatedSectionOpen"
                />
            </section>

            <!--Related Section -->
            <RelatedLessons
                v-if="relatedLessons.data && relatedLessons.data.length > 0"
                :isRelatedSectionOpen="isRelatedSectionOpen"
                :relatedLessons="relatedLessons"
                v-model:isRelatedSectionOpen="isRelatedSectionOpen"
            />

            <!-- Lesson Content Wrapper -->
            <section v-if="!noAccess" class="tw-col-span-3 xl:tw-row-span-2" :class="isRelatedSectionOpen ? 'xl:tw-col-span-2' : 'xl:tw-mr-[64px]'">
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

        <!-- Workout Chapter Soundslice -->
        <transition name="show-from-bottom">
            <div v-if="openSoundslice" id="practiceOverlay" class="bg-white">
                <SoundSlice :user-id="userId" :theme-color="brand"
                    :additional-params="`${getBrandSpecificParams()}&layout=3&recording_idx=1`"
                    :soundslice-slug="soundsliceSlug" :contentId="videoProps.contentId" :force-start-time="true"
                    :start-time="chapterStartTime" :end-time="chapterEndTime" :loop="startLooping">
                    <template v-slot:soundsliceControls>
                        <SoundSliceControls :title="soundsliceTitle || videoResources.title" :disable-next="true"
                            :disable-prev="true" @onClose="handleCloseSoundslice" />
                    </template>
                </SoundSlice>
            </div>
        </transition>
    </div>
</template>

<script setup>
// TODO: ADD THE PLAY AND PAUSE EVENTS TO THE VIDEO PLAYERS
import { computed, onBeforeMount, ref } from "vue";
import { storeToRefs } from 'pinia';
import { useUserStore } from "@stores/user";
import { usePlatformStore } from "@stores/platform";
import axios from 'axios';
import { getContentId } from '@hooks/utils';

import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
//import VideoMediaElement from "@vuesora/Components/MediaElement/MediaElement.vue";
//import VideoPlayer from "@vuesora/Components/VideoPlayer/VideoPlayer.vue";
import YoutubePlayer from "@vuesora/Components/YoutubePlayer/YoutubePlayer.vue";
import VideoButtons from "@collections/VideoButtons/VideoButtons.vue";
import VideoResources from "@vuesora/Components/VideoResources/VideoResources.vue";
import VideoComments from "@vuesora/views/comments/Comments.vue";
import VideoChapters from "@collections/VideoChapters/VideoChapters.vue";
import ContentInfo from "@collections/ContentInfo/ContentInfo.vue";
import SoundSlice from "@collections/SoundSlice/SoundSlice.vue";
import SoundSliceControls from "@collections/SoundSlice/SoundSliceControls.vue";
import Intercom from "@vuesora/assets/js/Services/intercom";
import Helpscout from "@vuesora/assets/js/Services/helpscout";
import ProgressTracker from "@vuesora/assets/js/classes/progress-tracker";
import ContentService from '@vuesora/assets/js/Services/content';
import RelatedLessonsToggle from '@collections/RelatedLessons/RelatedLessonsToggle';
import RelatedLessons from '@collections/RelatedLessons/RelatedLessons';
import MembershipUpgradeVideoCover from '@collections/MembershipUpgradeVideoCover/MembershipUpgradeVideoCover';
import DraftLabel from '@units/DraftLabel/DraftLabel';

const props = defineProps({
    breadcrumbFirstLevelUrl: {
        type: String,
        default: ''
    },
    breadcrumbFirstLevelTitle: {
        type: String,
        default: ''
    },
    breadcrumbSecondLevelUrl: {
        type: String,
        default: ''
    },
    breadcrumbSecondLevelTitle: {
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
    },
    lessonData: {
        type: [Array, Object],
        default: () => []
    },
});

const userStore = useUserStore();
const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);
const { brand, userId, userDisplayName, userEmail } = storeToRefs(userStore);
let hasBeenPlayed = false;
let progressTracker;

//Refs
const isRelatedSectionOpen = ref(false);
const isRelatedSectionCollapsed = ref(false);
const openSoundslice = ref(false);
const seekToTime = ref(0);
const chapterStartTime = ref(0);
const chapterEndTime = ref(props.videoProps.totalDuration);
const soundsliceTitle = ref('');
const startLooping = ref(false);
const mediaElementVueInstance = ref(null);

const videoData = ref({});
const likeData = ref({});
const isCompleted = ref(false);

//Computed
const breadcrumbProps = computed(() => {
    const breadcrumbLevels = [
        {
            title: props.breadcrumbFirstLevelTitle,
            url: props.breadcrumbFirstLevelUrl
        }
    ];

    if (props.breadcrumbSecondLevelTitle.length) {
        breadcrumbLevels.push({
            title: props.breadcrumbSecondLevelTitle,
            url: props.breadcrumbSecondLevelUrl
        });
    }

    breadcrumbLevels.push({
        title: props.breadcrumbLastLevelTitle,
        url: ''
    });

    return breadcrumbLevels;
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

const handleVideoPause = () => {
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
    chapterEndTime.value = videoData.value?.chapters?.length === index ? videoData.value?.length_in_seconds : videoData.value?.chapters[index]?.time;
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

const noAccess = computed(() => {
    return props.videoProps.need_access;
})

const showDraftLabel = computed(() => {
    return props.lessonData.status === 'draft';
})

const completeContent = () => {
    isCompleted.value = !isCompleted.value;
}

const likeContent = () => {
    likeData.value.isLiked = !likeData.value.isLiked;

    if (likeData.value.isLiked) {
        likeData.value.likeCount += 1;
    } else {
        likeData.value.likeCount -= 1;
    }
}

import { fetchLessonContent, fetchRelatedLessons, fetchNextPreviousLesson } from 'musora-content-services';


onBeforeMount(async() => {
    console.log('original',  props.videoProps)

    const contentId = getContentId();

    const data = await fetchLessonContent(contentId);
    videoData.value = data;
    console.log(data)

    const like = await axios.get(`/content/${contentId}/user_data/${userId.value}`);
    likeData.value = like?.data;

    const completed = await axios.get(`/content/user_progress/${userId.value}?content_ids[]=${contentId}`);
    isCompleted.value = completed?.data[contentId]?.state === 'completed';

    // Not implemented yet in MCS
    // const lessons = await fetchNextPreviousLesson(contentId);

    platformStore.setLoadingState(false);
})
</script>
