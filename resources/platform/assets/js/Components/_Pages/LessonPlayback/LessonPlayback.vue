<template>
    <div class="tw-w-full tw-mx-auto tw-px-4 md:tw-px-8"
        :class="hasRelatedLessons ? 'tw-max-w-[1703px]' : 'tw-max-w-[1450px]'">
        <Breadcrumb :is-loading="isLoading" :breadcrumbs="breadcrumbsData" />
        <div
            class="tw-grid tw-grid-cols-3 xl:tw-gird-rows-4 xl:tw-grid-cols-[auto_auto_420px] tw-mt-3 tw-flex-col tw-gap-4">
            <!-- VIDEO WRAPPER -->
            <section class="tw-col-span-3 xl:tw-row-span-2 tw-w-full tw-flex"
                :class="isRelatedSectionOpen ? 'xl:tw-col-span-2' : 'tw-mb-4'">
                <!-- Video Content -->
                <div class="tw-w-full">
                    <!--Video-->
                    <div class="tw-w-full tw-aspect-video dark:tw-bg-[#081825] tw-bg-[#EDEDED] tw-relative">
                        <!-- Skeleton Loading -->
                        <div v-if="isLoading"
                            class="tw-animate-pulse tw-absolute tw-top-0 tw-left-0 tw-w-full tw-h-full tw-bg-[#F2F2F2] dark:tw-bg-[#002039]">
                        </div>
                        <!-- Upgrade Cover  -->
                        <MembershipUpgradeVideoCover v-else-if="noAccess" :thumbnail-url="videoData.thumbnail_url" />
                        <template v-else-if="videoData?.video?.external_id">

                            <!-- YouTube -->
                            <transition v-if="videoData?.video?.type === 'youtube-video'" appear name="fade">
                                <YoutubePlayer ref="mediaElementVueInstance" :brand="brand" :theme-color="brand"
                                    :use-intersection-observer="true" :start-second="lastWatchedPositionInSeconds"
                                    :progress-state="progress_state" :video-id="videoData?.video?.external_id"
                                    :video-length="videoData.length_in_seconds" :content-id="videoData?.id"
                                    :end-second="videoData.length_in_seconds"
                                    :total-duration="videoData.length_in_seconds" :seek-to-time="seekToTime"
                                    @play="handleVideoPlay" @pause="handleVideoPause" @onVideoEnd="handleVideoEnd" />
                            </transition>
                            <!-- Vimeo video (legacy player) -->
                            <transition v-else-if="videoData?.video?.type === 'vimeo-video' && useLegacyVideoPlayer"
                                appear name="fade">
                                <video-media-element ref="mediaElementVueInstance" element-id="lessonPlayer"
                                    :brand="brand" :theme-color="brand"
                                    :current-second="lastWatchedPositionInSeconds"
                                    :progress-state="progress_state" :seek-to-time="seekToTime"
                                    :is-liked="isLiked" :check-for-timecode="true"
                                    :poster="videoData?.thumbnail_url"
                                    :sources="videoData?.video?.video_playback_endpoints"
                                    :hls-manifest-url="videoData?.video?.hlsManifestUrl"
                                    :video-id="videoData?.video?.external_id" :content-id="videoData?.id"
                                    :video-length="videoData?.length_in_seconds" :chapters="videoData?.chapters"
                                    :user-id="userId" :like-count="likeData?.likeCount" @playing="handleVideoPlay"
                                    @pause="handleVideoPause" @ended="handleVideoEnd">
                                    <div :class="`widescreen title tw-text-${brand}`">
                                        <i class="fas fa-spinner fa-spin absolute-center"></i>
                                    </div>
                                </video-media-element>
                            </transition>
                            <!-- Vimeo -->
                            <transition v-else-if="videoData?.video?.type === 'vimeo-video' && !useLegacyVideoPlayer"
                                appear name="fade">
                                <video-player ref="mediaElementVueInstance" :theme-color="brand" :brand="brand"
                                    :current-second="lastWatchedPositionInSeconds"
                                    :seek-to-time="seekToTime" :poster="videoData?.thumbnail_url"
                                    :sources="videoData?.video?.video_playback_endpoints"
                                    :hls-manifest-url="videoData?.video?.hlsManifestUrl" :chapters="videoData?.chapters"
                                    :content-id="videoData?.id" :user-id="userId"
                                    :video-id="videoData?.video?.external_id"
                                    :video-length="videoData?.length_in_seconds"
                                    :total-duration="videoData.length_in_seconds" @play="handleVideoPlay"
                                    @pause="handleVideoPause" @onVideoEnd="handleVideoEnd">
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

                    <VideoResources :theme-color="brand" :brand="brand" :report-user-email="userEmail"
                        :report-user-name="userDisplayName" :no-access="noAccess" :report-logo="emailLogo"
                        :title="videoData.title" :lesson-type="videoData.type" :thumbnail-url="videoData.thumbnail_url"
                        :description="videoData.description" :instructors="videoData.instructor" :is-liked="isLiked"
                        :like-count="likeData?.likeCount" :content-id="videoData.id" :user-id="userId"
                        :resources="videoData.resources" :difficulty="videoData.difficulty" :is-challenge="isChallenge"
                        :show-practice-button="showPracticeButton" :show-share-button="false"
                        :show-complete-button="isWorkout || isChallenge"
                        report-recipient="support+question-and-answer@drumeo.com" :is-completed="isCompleted"
                        :show-add-to-list="true" :show-info-button="showInfoButton"
                        @open-practice-soundslice="openSlice(videoData.title, videoData.chapters?.length, 0, false)"
                        @on-like-content="likeContent" @on-complete-content="toggleCompleteContent"
                        @open-challenge-completion-modal="openChallengeCompletionModal" />

                    <ContentInfo :breadcrumbs="breadcrumbsData" :content-description="videoData.description"
                        :content-chapters="videoData?.chapters" :instructors="videoData?.instructor" />

                    <VideoButtons v-if="!isWorkout" :prev-lesson-url="nextPreviousLessons?.prevLesson?.web_url_path"
                        :next-lesson-url="nextPreviousLessons?.nextLesson?.web_url_path" :brand="brand"
                        prev-label="Previous Lesson" next-label="Next Lesson" :qaVideo="qaVideo" />

                    <ContentProgress v-if="!noAccess && !isWorkout && !isChallenge" :brand="brand"
                        :is-completed="isCompleted" :progress="progress_percent" :xp-amount="videoData?.xp"
                        :is-started="progress_percent > 0"
                        :next-lesson-url="nextPreviousLessons?.nextLesson?.web_url_path" :show-complete-button="true"
                        :content-id="videoData.id" />
                </div>
                <!-- Related Lessons Toggle -->
                <RelatedLessonsToggle v-if="hasRelatedLessons" :is-loading="isLoading" :relatedLessons="relatedLessons"
                    :isRelatedSectionOpen="isRelatedSectionOpen" v-model:isRelatedSectionOpen="isRelatedSectionOpen" />
            </section>

            <!--Related Section -->
            <RelatedLessons :isRelatedSectionOpen="isRelatedSectionOpen" :is-loading="isLoading"
                :relatedLessons="relatedLessons" v-model:isRelatedSectionOpen="isRelatedSectionOpen"
                :is-challenge="isChallenge" />

            <!-- Lesson Content Wrapper -->
            <section v-if="!noAccess" class="tw-col-span-3 xl:tw-row-span-2"
                :class="isRelatedSectionOpen ? 'xl:tw-col-span-2' : `${hasRelatedLessons ? 'xl:tw-mr-[64px]' : ''}`">
                <!-- Chapters -->
                <VideoChapters v-if="videoData?.chapters?.length && isWorkout" :chapters="videoData.chapters"
                    @open-slice="openSlice" @seek-to-chapter="seekToChapter" />

                <!-- Assignments -->
                <div v-if="videoData?.assignments?.length > 0 && !isWorkout"
                    class="tw-flex tw-flex-col tw-flex-grow tw-mt-3 tw-w-full">
                    <div
                        class="tw-flex tw-flex-row tw-w-full tw-justify-between tw-items-center tw-border-b tw-border-[#e5e8e8] dark:tw-border-[#223F57] tw-pb-4">
                        <h1 class="heading dark:tw-text-white">Assignments</h1>
                        <button class="tw-z-10" @click="state.assignmentCollapsed = !state.assignmentCollapsed">
                            <div class="tw-border-2 tw-text-[#000C17] tw-border-[#000C17] dark:tw-text-white dark:tw-border-white tw-h-[35px] sm:tw-h-[50px] tw-w-[35px] sm:tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center"
                                :class="!state.assignmentCollapsed && 'tw-rotate-180'">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </button>
                    </div>
                    <div class="tw-flex-row tw-w-full" :class="state.assignmentCollapsed ? 'tw-hidden' : 'tw-flex'">
                        <AssignmentsContainer :lesson-data="videoData" :assignments="videoData?.assignments"
                            :brand="brand" :user-id="userId" />
                    </div>
                </div>
                <div class="tw-flex tw-flex-col tw-flex-grow tw-w-full">
                    <div class="tw-flex tw-flex-row tw-w-full">
                        <VideoComments :is-loading="isLoading" :theme-color="brand" :brand="brand" :user-id="userId"
                            :is-admin="isAdmin" :content-id="videoData?.railcontent_id" :user-name="userDisplayName"
                            :user-avatar="userProfilePictureUrl" :user-xp="userXP" :user-access-level="userAccessLevel"
                            :profile-base-route="`/${brand}/profile/${userId}/dashboard`" />
                    </div>
                </div>
            </section>
        </div>
        <LessonComplete v-if="!isWorkout && videoData.id && videoData.type"
            :next-lesson-json="nextPreviousLessons?.nextLesson" :contentId="videoData.id"
            :contentType="videoData.type" />

        <!-- Chapter Soundslice -->
        <transition name="show-from-bottom">
            <div v-if="openSoundslice" id="practiceOverlay" class="bg-white">
                <SoundSlice
                    :key="`${Math.floor(chapterStartTime)}${Math.floor(chapterEndTime)}${startLooping ? 'loop' : 'noloop'}`"
                    :user-id="userId" :theme-color="brand"
                    :additional-params="`${getBrandSpecificParams()}&layout=3&recording_idx=1`"
                    :soundslice-slug="videoData?.soundslice_slug" :contentId="videoData?.id"
                    :start-time="chapterStartTime" :end-time="chapterEndTime" :loop="startLooping">
                    <template v-slot:soundsliceControls>
                        <SoundSliceControls :title="soundsliceTitle || videoData.title" :disable-next="true"
                            :disable-prev="true" @onClose="handleCloseSoundslice" />
                    </template>
                </SoundSlice>
            </div>
        </transition>
    </div>

    <ChallengeCompletionModal v-if="isChallengeCompletionModalOpen" :completion-data="completionData"
        @close-modal="closeChallengeCompletionModal" />
</template>

<script setup>
// TODO: ADD THE PLAY AND PAUSE EVENTS TO THE VIDEO PLAYERS
import { ref, computed, reactive, onBeforeMount } from "vue";
import { storeToRefs } from 'pinia';
import { useUserStore } from "@stores/user";
import { usePlatformStore } from "@stores/platform";
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import YoutubePlayer from "@vuesora/Components/YoutubePlayer/YoutubePlayer.vue";
import VideoButtons from "@collections/VideoButtons/VideoButtons.vue";
import VideoResources from "@vuesora/Components/VideoResources/VideoResources.vue";
import VideoComments from "@vuesora/views/comments/Comments.vue";
import ContentInfo from "@collections/ContentInfo/ContentInfo.vue";
import Intercom from "@vuesora/assets/js/Services/intercom";
import Helpscout from "@vuesora/assets/js/Services/helpscout";
import ProgressTracker from "@vuesora/assets/js/classes/progress-tracker";
import ContentService from "@vuesora/assets/js/Services/content";
import ContentProgress from "@collections/ContentProgress/ContentProgress.vue";
import RelatedLessonsToggle from "@collections/RelatedLessons/RelatedLessonsToggle.vue";
import RelatedLessons from "@collections/RelatedLessons/RelatedLessons.vue";
import LessonComplete from "@collections/ContentProgress/LessonComplete.vue";
import VideoChapters from "@collections/VideoChapters/VideoChapters.vue";
import MembershipUpgradeVideoCover from '@collections/MembershipUpgradeVideoCover/MembershipUpgradeVideoCover';
import SoundSlice from "@collections/SoundSlice/SoundSlice.vue";
import SoundSliceControls from "@collections/SoundSlice/SoundSliceControls.vue";
import ChallengeCompletionModal from '@collections/Modal/ChallengeCompletionModal';
import {
    fetchLessonContent,
    fetchRelatedLessons,
    fetchNextPreviousLesson,
    isContentLiked,
    fetchChallengeLessonData,
    // this is not getting percentage, this is getting lats watched position in seconds, possibly rename this function
    getProgressPercentage,
} from 'musora-content-services';
import { getContentId } from '@hooks/utils';
import { getBreadcrumbs } from './breadcrumbUtils'; 

//Pinia
const userStore = useUserStore();
const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);
const {
    userId,
    userEmail,
    isAdmin,
    userDisplayName,
    userAccessLevel,
    userXP,
    userProfilePictureUrl,
    brand,
    useLegacyVideoPlayer
} = storeToRefs(userStore);

let hasBeenPlayed = false;
let progressTracker;

//Refs
const progress_percent = ref(0);
const progress_state = ref(0);
const lastWatchedPositionInSeconds = ref(0);
const isRelatedSectionOpen = ref(true);
const isChallengeCompletionModalOpen = ref(false);
const openSoundslice = ref(false);
const seekToTime = ref(0);
const chapterStartTime = ref(0);
const chapterEndTime = ref(0);
const soundsliceTitle = ref('');
const startLooping = ref(false);
const mediaElementVueInstance = ref(null);
const contentId = ref(getContentId());

const videoData = ref({});
const likeData = ref({});
const isLiked = ref(false);
const isCompleted = ref(false);
const relatedLessons = ref([]);
const nextPreviousLessons = ref(null);
const completionData = ref(null);

//Reactive
const state = reactive({
    assignmentCollapsed: false,
});

const showPracticeButton = computed(() => {
    return !!videoData.value?.soundslice_slug;
});

const showInfoButton = computed(() => {
    return videoData.value?.instructor?.length > 0 || videoData.value?.description?.length > 0 || videoData.value?.chapters?.length > 0;
});

//Methods
const handleVideoPlay = (payload) => {
    if (['started', 'completed'].indexOf(payload.progressState) === -1 && !hasBeenPlayed) {
        ContentService.markContentAsStarted(payload.contentId);
    }
    if (progressTracker == null) {
        progressTracker = new ProgressTracker();
        if (mediaElementVueInstance.value) {
            attachVisibilityAndPagehideEvents();
        }
    }
    hasBeenPlayed = true;
    progressTracker.start();
};

const sendProgressTrackerEvent = () => {
    if (progressTracker) {
        progressTracker.send({
            mediaType: 'video',
            mediaCategory: videoData.value?.video?.type.split('-')[0],
            watchPosition: mediaElementVueInstance.value.currentTimeInSeconds
                || mediaElementVueInstance.value.currentTime,
            totalDuration: mediaElementVueInstance.value.videoLength
                || mediaElementVueInstance.value.totalDuration,
            brand: brand.value,
            contentId: mediaElementVueInstance.value.contentId
        });
    }
};

const attachVisibilityAndPagehideEvents = () => {
    document.addEventListener('visibilitychange', () => {
        sendProgressTrackerEvent();
    });

    window.addEventListener('pagehide', () => {
        sendProgressTrackerEvent();
    });
};

const handleVideoPause = () => {
    progressTracker.stop();
    sendProgressTrackerEvent();
};
const handleVideoEnd = (showRelatedSection = true) => {
    if (showRelatedSection) {
        isRelatedSectionOpen.value = true;
    }
    sendProgressTrackerEvent();
    ContentService.markContentAsComplete(contentId.value);
};

const getBrandSpecificParams = () => {
    return ({
        drumeo: '&show_chords=0',
        singeo: '&show_staff_t1=0&show_staff_t2=0&show_chords=0',
        guitareo: '',
        pianote: '&show_chords=1'
    }[brand.value]);
};

const openSlice = (title, index, startAt, loop) => {
    if (mediaElementVueInstance.value) {
        mediaElementVueInstance.value.pauseVideo();
    }
    soundsliceTitle.value = title;
    chapterStartTime.value = startAt;
    chapterEndTime.value = videoData.value?.length_in_seconds;
    startLooping.value = loop;

    if (loop) {
        chapterEndTime.value = videoData.value?.chapters.length === index ? videoData.value?.length_in_seconds : videoData.value?.chapters[index]?.chapter_timecode;
    }

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

//Computed
const emailLogo = computed(() => {
    if (brand.value === "singeo") {
        return "https://dmmior4id2ysr.cloudfront.net/logos/singeo-logo-purple.png";
    } else {
        return `https://dmmior4id2ysr.cloudfront.net/logos/${brand.value}-logo.png`
    }
});

const hasRelatedLessons = computed(() => {
    return relatedLessons.value.length > 0;
})

const noAccess = computed(() => {
    return videoData.value?.need_access;
})

const isChallenge = computed(() => {
    return videoData.value.type === 'challenge';
})

const toggleCompleteContent = () => {
    isCompleted.value = !isCompleted.value;
}

const likeContent = () => {
    isLiked.value = !isLiked.value;

    if (isLiked.value) {
        likeData.value.likeCount += 1;
    } else {
        likeData.value.likeCount -= 1;
    }
}

const openChallengeCompletionModal = async (data) => {
    completionData.value = data;
    isChallengeCompletionModalOpen.value = true;
}

const closeChallengeCompletionModal = () => {
    isChallengeCompletionModalOpen.value = false;
}

const isWorkout = computed(() => {
    return videoData.value.type === 'workout';
})

const breadcrumbsData = computed(() => {
    return getBreadcrumbs(videoData.value, brand.value);
});

const fetchLessonData = async () => {
    if (isChallenge.value) {
        const results = await Promise.allSettled([
            fetchChallengeLessonData(contentId.value),
            axios.get(`/content/${contentId.value}/user_data/${userId.value}`),
            isContentLiked(contentId.value),
        ])

        const [dataResult, likeResult, likedResult] = results;

        videoData.value = dataResult.status === 'fulfilled' ? dataResult.value.lesson : null;
        likeData.value = likeResult.status === 'fulfilled' ? likeResult.value.data : null;
        isLiked.value = likedResult.status === 'fulfilled' ? likedResult.value : false;
        isCompleted.value = dataResult.status === 'fulfilled' && dataResult.value.lesson.completed;
        nextPreviousLessons.value = dataResult.status === 'fulfilled' ? {
            nextLesson: dataResult.value.next_lesson,
            prevLesson: dataResult.value.previous_lesson,
        } : null;


        relatedLessons.value = dataResult.status === 'fulfilled' ? await dataResult.value.lessons : [];
    } else {

        // Execute all video calls using Promise.allSettled
        const results = await Promise.allSettled([
            fetchLessonContent(contentId.value),
            axios.get(`/content/${contentId.value}/user_data/${userId.value}`),
            isContentLiked(contentId.value),
            axios.get(`/content/user_progress/${userId.value}?content_ids[]=${contentId.value}`),
            fetchNextPreviousLesson(contentId.value),
            fetchRelatedLessons(contentId.value, brand.value),
            getProgressPercentage(contentId.value)
        ]);

        // Process results
        const [
            dataResult,
            likeResult,
            likedResult,
            completedResult,
            nextPrevResult,
            relatedLessonsResult,
            progressResult
        ] = results;

        // needs refactoring
        videoData.value = dataResult.status === 'fulfilled' ? dataResult.value : null;
        likeData.value = likeResult.status === 'fulfilled' ? likeResult.value.data : null;
        isLiked.value = likedResult.status === 'fulfilled' ? likedResult.value : false;
        isCompleted.value = completedResult.status === 'fulfilled' && completedResult.value.data[contentId.value]?.state === 'completed';
        nextPreviousLessons.value = nextPrevResult.status === 'fulfilled' ? nextPrevResult.value : null;
        relatedLessons.value = relatedLessonsResult.status === 'fulfilled' ? relatedLessonsResult.value.related_lessons : [];
        progress_percent.value = completedResult.status === 'fulfilled' ? completedResult.value.data[contentId.value].percent : 0;
        progress_state.value = completedResult.status === 'fulfilled' ? completedResult.value.data[contentId.value]?.state : 'unstarted';
        lastWatchedPositionInSeconds.value = progressResult.status === 'fulfilled' ? progressResult.value : 0;

        // Optional: log errors for any rejected promises
        results.forEach((result, index) => {
            if (result.status === 'rejected') {
                console.error(`Promise at index ${index} failed:`, result.reason);
            }
        });
    }

    platformStore.setLoadingState(false);
}

onBeforeMount(() => {
    fetchLessonData();
});
</script>
