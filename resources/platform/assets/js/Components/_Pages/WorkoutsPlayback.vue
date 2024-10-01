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
                        <!-- Upgrade Cover -->
                        <MembershipUpgradeVideoCover v-if="noAccess" :thumbnail-url="videoProps.thumbnailUrl" />
                        <template v-else-if="videoProps.videoId">
                            <!-- Draft Label -->
                            <DraftLabel v-show="showDraftLabel" />

                            <!-- YouTube -->
                            <transition v-if="videoProps.videoType === 'youtube'" appear name="fade">
                                <YoutubePlayer :video-id="videoProps.videoId" ref="mediaElementVueInstance" :brand="brand"
                                    :theme-color="brand" :video-length="videoProps.videoLength"
                                    :progress-state="videoProps.progressState" :content-id="videoProps.id"
                                    :use-intersection-observer="true" :start-second="startSecond"
                                    :end-second="videoProps.videoLength" :total-duration="videoProps.videoLength"
                                    :seek-to-time="seekToTime" @play="handleVideoPlay" @pause="handleVideoPause"
                                    @onVideoEnd="handleVideoEnd" />
                            </transition>
                            <!-- Vimeo video (legacy player) -->
                            <transition v-else-if="videoProps.videoType === 'vimeo' && videoProps.useLegacyPlayer" appear
                                name="fade">
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
                            <transition v-else-if="videoProps.videoType === 'vimeo' && !videoProps.useLegacyPlayer" appear
                                name="fade">
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
                        :show-add-to-list="videoResources.showAddToList" :show-info-button="videoResources.showInfoButton"
                        :show-practice-button="showPracticeButton" :show-share-button="false" :show-complete-button="true"
                        :report-user-email="videoResources.reportUserEmail"
                        :report-user-name="videoResources.reportUserName" :report-recipient="videoResources.reportRecipient"
                        :report-logo="videoResources.reportLogo" :lesson="{ completed: videoButtons.isCompleted }"
                        @open-practice-soundslice="openSlice(videoResources.title, formattedChapters.length, 0, false)" :difficulty="videoResources.difficulty" :no-access="noAccess"
                    />

                    <ContentInfo :breadcrumbs="contentBreadcrumb" :content-description="contentDescription"
                        :content-chapters="videoProps.chapters" :instructors="contentInstructors" />

                    <VideoChapters v-if="!noAccess && formattedChapters.length" :chapters="formattedChapters" @open-slice="openSlice"
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
                <SoundSlice :key="`${Math.floor(chapterStartTime)}${Math.floor(chapterEndTime)}${startLooping ? 'loop' : 'noloop'}`" :user-id="videoProps.userId" :theme-color="brand"
                    :additional-params="`${getBrandSpecificParams()}&layout=3&recording_idx=1`"
                    :soundslice-slug="soundsliceSlug" :contentId="videoProps.contentId" 
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
import {ref, computed} from "vue";
import { storeToRefs } from 'pinia';
import { useUserStore } from "@stores/user";

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
import MembershipUpgradeVideoCover from '../_Collections/MembershipUpgradeVideoCover/MembershipUpgradeVideoCover';
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
const { brand } = storeToRefs(userStore);
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
const mediaElementVueInstance = ref(null)

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
    }[brand.value]);
};

const openSlice = (title, index, startAt, loop) => {
    if (mediaElementVueInstance.value) {
        mediaElementVueInstance.value.pauseVideo();
    }
    soundsliceTitle.value = title;
    chapterStartTime.value = startAt;
    chapterEndTime.value = props.videoProps.totalDuration;
    startLooping.value = loop;

    if (loop) {
        chapterEndTime.value = formattedChapters.value.length === index ? props.videoProps.totalDuration : formattedChapters.value[index].time;
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

const noAccess = computed(() => {
    return props.videoProps.need_access;
})

const showDraftLabel = computed(() => {
    return props.lessonData.status === 'draft';
})
</script>
