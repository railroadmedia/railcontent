<template>
    <div>
        <Breadcrumb
            :first-level-url="breadcrumbFirstLevelUrl"
            :first-level-title="breadcrumbFirstLevelTitle"
            :second-level-url="breadcrumbSecondLevelUrl"
            :second-level-title="breadcrumbSecondLevelTitle"
            :last-level-title="breadcrumbLastLevelTitle"
        />

        <div class="tw-grid tw-grid-cols-3 xl:tw-gird-rows-4 xl:tw-grid-cols-[auto_auto_420px] tw-w-full tw-max-w-[1450px] tw-mx-auto tw-px-4 tw-mt-3 tw-flex-col tw-gap-4">
            <!-- VIDEO WRAPPER -->
            <section class="tw-col-span-3 xl:tw-row-span-2 tw-w-full tw-flex" :class="isRelatedSectionOpen ? 'xl:tw-col-span-2' : 'tw-mb-4'">
                <!-- Video Content -->
                <div class="tw-w-full">
                    <!--Video-->
                    <div class="tw-w-full tw-aspect-video dark:tw-bg-[#081825] tw-bg-[#EDEDED]">
                        <template v-if="videoProps.videoId">
                            <!-- YouTube -->
                            <transition v-if="videoProps.videoType === 'youtube'" appear name="fade">
                                <YoutubePlayer 
                                    :video-id="videoProps.videoId" 
                                    ref="mediaElementVueInstance" 
                                    :brand="brand" 
                                    :theme-color="brand" 
                                    :video-length="videoProps.videoLength" 
                                    :progress-state="videoProps.progressState"
                                    :content-id="videoProps.id" 
                                    :use-intersection-observer="true" 
                                    :start-second="seekToTime" 
                                    :end-second="videoProps.videoLength" 
                                    :total-duration="videoProps.videoLength"
                                    :seek-to-time="seekToTime"
                                    @play="handleVideoPlay" 
                                    @pause="handleVideoPause" 
                                    @onVideoEnd="handleVideoEnd"
                                />
                            </transition>
                            <!-- Vimeo video (legacy player) -->
                            <transition v-else-if="videoProps.videoType === 'vimeo' && videoProps.useLegacyPlayer" appear
                                name="fade">
                                <video-media-element 
                                    ref="mediaElementVueInstance" 
                                    element-id="lessonPlayer"
                                    :brand="videoProps.brand" 
                                    :theme-color="videoProps.brand"
                                    :poster="videoProps.videoPosterImageUrl" 
                                    :sources="videoProps.videoPlaybackEndpoints"
                                    :hls-manifest-url="videoProps.hlsManifestUrl" 
                                    :video-id="videoProps.vimeoVideoId"
                                    :content-id="videoProps.id" 
                                    :current-second="videoProps.lastWatchPositionInSeconds"
                                    :progress-state="videoProps.progressState" 
                                    :video-length="videoProps.videoLength"
                                    :chapters="videoProps.chapters" 
                                    :user-id="videoProps.userId" 
                                    :like-count="videoProps.likeCount"
                                    :is-liked="videoProps.isLiked" 
                                    :check-for-timecode="videoProps.checkForTimecode"
                                    :seek-to-time="seekToTime"
                                    @playing="handleVideoPlay"
                                    @pause="handleVideoPause"
                                    @ended="handleVideoEnd"
                                >
                                    <div :class="`widescreen title tw-text-${brand}`">
                                        <i class="fas fa-spinner fa-spin absolute-center"></i>
                                    </div>
                                </video-media-element>
                            </transition>
                            <!-- Vimeo -->
                            <transition v-else-if="videoProps.videoType === 'vimeo' && !videoProps.useLegacyPlayer" appear
                                name="fade">
                                <video-player ref="mediaElementVueInstance"
                                    :theme-color="brand"
                                    :brand="brand"
                                    :poster="videoProps.thumbnailUrl"
                                    :sources="videoProps.sources"
                                    :ranges="videoProps.ranges ? videoProps.ranges : {}"
                                    :ranges-video-ids="videoProps.rangesVideoIds ? videoProps.rangesVideoIds : {}"
                                    :show-range-buttons="videoProps.showRangeButtons ? videoProps.showRangeButtons : false"
                                    :hls-manifest-url="videoProps.hlsManifestUrl"
                                    :captions="videoProps.captions"
                                    :chapters="videoProps.chapters"
                                    :current-second="videoProps.currentSecond"
                                    :content-id="videoProps.contentId"
                                    :user-id="videoProps.userId"
                                    :video-id="videoProps.videoId"
                                    :video-length="videoProps.videoLength"
                                    :total-duration="videoProps.totalDuration"
                                    :cast-title="videoProps.castTitle"
                                    :use-intersection-observer="videoProps.useIntersectionObserver"
                                    :seek-to-time="seekToTime"
                                    @play="handleVideoPlay"
                                    @pause="handleVideoPause"
                                    @onVideoEnd="handleVideoEnd"
                                >
                                    <div :class="`widescreen title tw-text-${brand} tw-mb-2`"></div>
                                </video-player>
                            </transition>
                            <div v-else class="tw-w-full tw-flex tw-flex-col tw-justify-center tw-items-center tw-aspect-video tw-text-black dark:tw-text-white tw-text-3xl tw-font-bold">
                                ERROR LOADING VIDEO...
                            </div>
                        </template>
                        <template v-else>
                            <div class="tw-w-full tw-flex tw-flex-col tw-justify-center tw-items-center tw-aspect-video tw-text-black dark:tw-text-white tw-text-3xl tw-font-bold">
                                No Video Data
                            </div>
                        </template>
                    </div>

                    <VideoResources
                        :theme-color="videoResources.themeColor"
                        :brand="videoResources.brand"
                        :title="videoResources.title"
                        :lesson-type="videoResources.lessonType"
                        :thumbnail-url="videoResources.thumbnailUrl"
                        :description="videoResources.description"
                        :instructors="videoResources.instructors"
                        :parent-title="videoResources.parentTitle"
                        :is-liked="videoResources.isLiked"
                        :like-count="videoResources.likeCount"
                        :is-added="videoResources.isAdded"
                        :content-id="videoResources.contentId"
                        :user-id="videoResources.userId"
                        :resources="videoResources.resources"
                        :show-add-to-list="videoResources.showAddToList"
                        :show-info-button="videoResources.showInfoButton"
                        :show-practice-button="true"
                        :show-share-button="false"
                        :show-complete-button="true"
                        :report-user-email="videoResources.reportUserEmail"
                        :report-user-name="videoResources.reportUserName"
                        :report-recipient="videoResources.reportRecipient"
                        :report-logo="videoResources.reportLogo"
                        @open-practice-soundslice="openSlice(videoResources.title, formattedChapters.length, 0, false)"
                    />

                    <ContentInfo :breadcrumbs="contentBreadcrumb" :content-description="contentDescription"
                        :content-chapters="videoProps.chapters" :instructors="contentInstructors" />

                    <VideoChapters
                        v-if="formattedChapters.length"
                        :chapters="formattedChapters"
                        @open-slice="openSlice"
                        @seek-to-chapter="seekToChapter"
                    />

                    <VideoButtons :prev-lesson-url="videoButtons.prevLessonUrl" :next-lesson-url="videoButtons.nextLessonUrl"
                        :brand="brand" :prev-label="videoButtons.prevLabel" :next-label="videoButtons.nextLabel"
                        :has-qa-video="videoButtons.hasQAVideo"
                    />
                </div>
                <!-- Close Expanded View -->
                <div class="xl:tw-ml-[10px] xl:tw-pt-6 xl:tw-pr-4 tw-transition-all tw-overflow-hidden tw-shrink-0 tw-hidden" :class=" {'xl:tw-inline-block' : !isRelatedSectionOpen }">
                    <button @click="isRelatedSectionOpen = !isRelatedSectionOpen" class="tw-text-black dark:tw-text-white tw-group">
                        <!-- Expand Icon outlined -->
                        <svg class="tw-border tw-border-black dark:tw-border-white tw-rounded-full tw-rotate-180 group-hover:tw-hidden" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.7125 20.2017C25.0958 19.8124 25.0958 19.1876 24.7125 18.7983L19.2958 13.2983C18.9083 12.9048 18.2751 12.9 17.8816 13.2875C17.4882 13.675 17.4833 14.3082 17.8709 14.7017L21.6116 18.5L11 18.5C10.4477 18.5 10 18.9477 10 19.5C10 20.0523 10.4477 20.5 11 20.5L21.6116 20.5L17.8708 24.2983C17.4833 24.6918 17.4882 25.325 17.8816 25.7125C18.2751 26.1 18.9083 26.0952 19.2958 25.7017L24.7125 20.2017Z" fill="currentColor"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M27.5498 11C27.1356 11 26.7998 11.3358 26.7998 11.75L26.7998 26.75C26.7998 27.1642 27.1356 27.5 27.5498 27.5C27.964 27.5 28.2998 27.1642 28.2998 26.75L28.2998 11.75C28.2998 11.3358 27.964 11 27.5498 11Z" fill="currentColor"/>
                        </svg>
                        <!-- Expand Icon filled -->
                        <svg class="tw-rotate-180 tw-hidden group-hover:tw-block" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M38 19C38 8.50659 29.4934 0 19 0C8.50659 0 0 8.50659 0 19C0 29.4934 8.50659 38 19 38C29.4934 38 38 29.4934 38 19ZM24.7125 18.7983L19.2958 13.2983C18.9083 12.9048 18.2751 12.9 17.8816 13.2875C17.4882 13.675 17.4833 14.3082 17.8708 14.7017L21.6116 18.5H11C10.4477 18.5 10 18.9477 10 19.5C10 20.0523 10.4477 20.5 11 20.5H21.6116L17.8708 24.2983C17.4833 24.6918 17.4882 25.325 17.8816 25.7125C18.2751 26.1 18.9083 26.0952 19.2958 25.7017L24.7125 20.2017C25.0958 19.8124 25.0958 19.1876 24.7125 18.7983ZM26.8 11.75C26.8 11.3358 27.1358 11 27.55 11C27.9643 11 28.3 11.3358 28.3 11.75V26.75C28.3 27.1642 27.9643 27.5 27.55 27.5C27.1358 27.5 26.8 27.1642 26.8 26.75V11.75Z" fill="currentColor"/>
                        </svg>
                    </button>
                </div>
            </section>

            <!--Related Setion -->
            <aside class="tw-w-full tw-col-span-3 xl:tw-row-span-4 tw-flex tw-flex-col xl:tw-mb-4 xl:tw-mt-0 xl:tw-col-span-1" :class=" {'xl:tw-hidden' : !isRelatedSectionOpen } ">
                <div class="tw-flex tw-w-full">
                    <div class="tw-w-full tw-border dark:tw-border-[#002039] tw-border-[#e5e7ea] dark:tw-bg-[#000C17] tw-bg-[#F9F9F9] tw-overflow-hidden tw-transition-all">
                        <header class="tw-flex tw-flex-col">
                            <div class="tw-bg-white dark:tw-bg-[#081825] tw-pt-[24px] tw-pb-[16px] tw-flex tw-justify-between tw-px-[18px]">
                                <h3 class="tw-text-xl tw-font-bold tw-font-open-sans dark:tw-text-white">Related Workouts</h3>
                                <button @click="isRelatedSectionOpen = !isRelatedSectionOpen" class="tw-text-black dark:tw-text-white tw-hidden xl:tw-inline-block">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27.55 11.5L27.55 26.5" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" />
                                        <path d="M17.1334 24.5L22.55 19M22.55 19L17.1334 13.5M22.55 19L9.55005 19"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </header>
                        <!-- Cards -->
                        <section class="tw-w-full tw-flex tw-flex-col tw-max-h-[1000px] tw-relative tw-overflow-y-auto lg:tw-block">
                            <div v-for="(item, i) in relatedLessons.data "
                                 :key="i"
                                 class="tw-group tw-flex tw-w-full tw-items-center tw-transition-colors hover:tw-bg-[#E0E0E1] dark:hover:tw-bg-[#102230] even:tw-bg-white dark:even:tw-bg-[#081825] tw-px-2"
                            >
                                <CatalogueCard
                                    :item="item"
                                    :content-type="item.type"
                                    :brand="brand"
                                    :force-list-view="true"
                                />
                            </div>
                        </section>
                    </div>
                </div>
            </aside>

            <!-- Lesson Content Wrapper -->
            <section class="tw-col-span-3 xl:tw-row-span-2" :class="{'xl:tw-col-span-2' : isRelatedSectionOpen }">
                <div class="tw-flex tw-flex-col tw-flex-grow tw-w-full">
                    <div class="tw-flex tw-flex-row tw-w-full">
                        <VideoComments :theme-color="commentsProps.themeColor" :brand="commentsProps.brand"
                            :content-id="commentsProps.contentId" :user-id="commentsProps.userId"
                            :user-name="commentsProps.userName" :user-avatar="commentsProps.userAvatar"
                            :user-xp="commentsProps.userXp" :user-access-level="commentsProps.userAccessLevel"
                            :profile-base-route="commentsProps.profileBaseRoute" :is-admin="commentsProps.isAdmin === 'true' ? true : false">
                        </VideoComments>
                    </div>
                </div>
            </section>
        </div>

        <!-- Workout Chapter Soundslice -->
        <transition name="show-from-bottom">
            <div v-if="openSoundslice" id="practiceOverlay" class="bg-white">
                <SoundSlice
                    :user-id="videoProps.userId"
                    :theme-color="brand"
                    :additional-params="`${getBrandSpecificParams()}&layout=3&recording_idx=1`"
                    :soundslice-slug="soundsliceSlug"
                    :contentId="videoProps.contentId"
                    :force-start-time="true"
                    :start-time="chapterStartTime"
                    :end-time="chapterEndTime"
                    :loop="startLooping"
                >
                    <template v-slot:soundsliceControls>
                        <SoundSliceControls
                            :title="soundsliceTitle || videoResources.title"
                            :disable-next="true"
                            :disable-prev="true"
                            @onClose="handleCloseSoundslice"
                        />
                    </template>
                </SoundSlice>
            </div>
        </transition>
    </div>
</template>

<script setup>
// TODO: ADD THE PLAY AND PAUSE EVENTS TO THE VIDEO PLAYERS
import { onMounted, ref, computed } from "vue";
import { storeToRefs } from 'pinia';
import { useUserStore } from "../../stores/user";

import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import VideoMediaElement from "../vuesora/components/MediaElement/MediaElement.vue";
import VideoPlayer from "../vuesora/components/VideoPlayer/VideoPlayer.vue";
import YoutubePlayer from "../vuesora/components/YoutubePlayer/YoutubePlayer.vue";
import VideoButtons from "../components/VideoButtons/VideoButtons.vue";
import VideoResources from "../vuesora/components/VideoResources/VideoResources.vue";
import VideoComments from "../vuesora/views/comments/Comments.vue";
import VideoChapters from "../components/VideoChapters/VideoChapters.vue";
import ContentInfo from "../components/ContentInfo/ContentInfo.vue";
import SoundSlice from "../components/SoundSlice/SoundSlice.vue";
import SoundSliceControls from "../components/SoundSlice/SoundSliceControls.vue";
import CatalogueCard from "../components/Catalogue/CatalogueCard.vue";
import Intercom from "../vuesora/assets/js/services/intercom";
import Helpscout from "../vuesora/assets/js/services/helpscout";
import ProgressTracker from "../vuesora/assets/js/classes/progress-tracker";
import ContentService from '../vuesora/assets/js/services/content';

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
    }
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
let hasBeenPlayed = false;
let progressTracker;

//Refs
const isRelatedSectionOpen = ref(false);
const openSoundslice = ref(false);
const seekToTime = ref(0);
const chapterStartTime = ref(0);
const chapterEndTime = ref(props.videoProps.totalDuration);
const soundsliceTitle = ref('');
const startLooping = ref(false);
const mediaElementVueInstance = ref(null)

//Computed
const formattedChapters = computed(() => {
    if(props.videoProps.chapters?.length) {
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

//Methods
const handleVideoPlay = (payload) => {
    if (['started', 'completed'].indexOf(payload.progressState) === -1 && !hasBeenPlayed) {
        ContentService.markContentAsStarted(payload.contentId);
    }
    if (progressTracker == null) {
        progressTracker = new ProgressTracker();

        const sessionTokenElement = document.querySelector('#sessionToken');

        if (mediaElementVueInstance) {
            window.addEventListener('unload', (event) => {
                progressTracker.send({
                    mediaId: mediaElementVueInstance.videoId,
                    mediaType: 'video',
                    mediaCategory: 'vimeo',
                    watchPosition: mediaElementVueInstance.currentTimeInSeconds
                        || mediaElementVueInstance.currentTime,
                    totalDuration: mediaElementVueInstance.videoLength
                        || mediaElementVueInstance.totalDuration,
                    sessionToken: sessionTokenElement.value || null,
                    brand:mediaElementVueInstance.brand,
                    contentId: mediaElementVueInstance.contentId
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
    console.log('handle video end')
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

onMounted(() => {
    console.log(props.videoProps)
})
</script>
