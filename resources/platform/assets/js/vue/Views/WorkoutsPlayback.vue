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
                            <!-- Vimeo -->
                            <transition v-else-if="videoProps.videoType === 'vimeo' && !videoProps.useLegacyPlayer" appear
                                name="fade">
                                <video-player ref="mediaElementVueInstance"
                                    :theme-color="brand"
                                    :brand="brand"
                                    :poster="videoProps.poster"
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
                <div class="xl:tw-ml-4 tw-transition-all tw-overflow-hidden tw-shrink-0 tw-hidden" :class=" {'xl:tw-inline-block' : !isRelatedSectionOpen }">
                    <button @click="isRelatedSectionOpen = !isRelatedSectionOpen" class="tw-text-black dark:tw-text-white tw-group">
                        <!-- Expand Icon outlined -->
                        <svg class="group-hover:tw-hidden" width="38" height="38" viewBox="0 0 38 38" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.5" y="0.5" width="37" height="37" rx="18.5" transform="matrix(-1 0 0 1 37 0)"
                                fill="transparent" stroke="currentColor" />
                            <path d="M9 11.0498L9 26.0498" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M19.4167 24.0498L14 18.5498M14 18.5498L19.4167 13.0498M14 18.5498L27 18.5498"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <!-- Expand Icon filled -->
                        <svg class="tw-rotate-180 tw-hidden group-hover:tw-block" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="path-1-inside-1_3137_43271" fill="currentColor">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M38 19C38 8.50659 29.4934 0 19 0C8.50659 0 0 8.50659 0 19C0 29.4934 8.50659 38 19 38C29.4934 38 38 29.4934 38 19ZM28.2 10.7502C27.7858 10.7502 27.45 11.086 27.45 11.5002V26.5002C27.45 26.9144 27.7858 27.2502 28.2 27.2502C28.6142 27.2502 28.95 26.9144 28.95 26.5002V11.5002C28.95 11.086 28.6142 10.7502 28.2 10.7502ZM16.7458 12.7985L22.1625 18.2985C22.5458 18.6878 22.5458 19.3126 22.1625 19.7019L16.7458 25.2019C16.3583 25.5954 15.7251 25.6002 15.3316 25.2127C14.9381 24.8251 14.9333 24.192 15.3208 23.7985L19.0616 20.0002H8.45C7.89771 20.0002 7.45 19.5525 7.45 19.0002C7.45 18.4479 7.89771 18.0002 8.45 18.0002H19.0616L15.3208 14.2019C14.9333 13.8084 14.9382 13.1752 15.3316 12.7877C15.7251 12.4002 16.3583 12.405 16.7458 12.7985Z"/>
                            </mask>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M38 19C38 8.50659 29.4934 0 19 0C8.50659 0 0 8.50659 0 19C0 29.4934 8.50659 38 19 38C29.4934 38 38 29.4934 38 19ZM28.2 10.7502C27.7858 10.7502 27.45 11.086 27.45 11.5002V26.5002C27.45 26.9144 27.7858 27.2502 28.2 27.2502C28.6142 27.2502 28.95 26.9144 28.95 26.5002V11.5002C28.95 11.086 28.6142 10.7502 28.2 10.7502ZM16.7458 12.7985L22.1625 18.2985C22.5458 18.6878 22.5458 19.3126 22.1625 19.7019L16.7458 25.2019C16.3583 25.5954 15.7251 25.6002 15.3316 25.2127C14.9381 24.8251 14.9333 24.192 15.3208 23.7985L19.0616 20.0002H8.45C7.89771 20.0002 7.45 19.5525 7.45 19.0002C7.45 18.4479 7.89771 18.0002 8.45 18.0002H19.0616L15.3208 14.2019C14.9333 13.8084 14.9382 13.1752 15.3316 12.7877C15.7251 12.4002 16.3583 12.405 16.7458 12.7985Z" fill="currentColor"/>
                            <path d="M22.1625 18.2985L22.875 17.5968L22.875 17.5968L22.1625 18.2985ZM16.7458 12.7985L17.4583 12.0968L17.4583 12.0968L16.7458 12.7985ZM22.1625 19.7019L21.45 19.0002L21.45 19.0002L22.1625 19.7019ZM16.7458 25.2019L16.0333 24.5002L16.0333 24.5002L16.7458 25.2019ZM15.3316 25.2127L16.0333 24.5002L16.0333 24.5002L15.3316 25.2127ZM15.3208 23.7985L16.0333 24.5002L16.0333 24.5002L15.3208 23.7985ZM19.0616 20.0002L19.7741 20.7019L21.45 19.0002H19.0616V20.0002ZM19.0616 18.0002V19.0002H21.45L19.7741 17.2985L19.0616 18.0002ZM15.3208 14.2019L16.0333 13.5002L16.0333 13.5002L15.3208 14.2019ZM15.3316 12.7877L16.0333 13.5002L16.0333 13.5002L15.3316 12.7877ZM19 1C28.9411 1 37 9.05887 37 19H39C39 7.95431 30.0457 -1 19 -1V1ZM1 19C1 9.05887 9.05887 1 19 1V-1C7.95431 -1 -1 7.95431 -1 19H1ZM19 37C9.05887 37 1 28.9411 1 19H-1C-1 30.0457 7.95431 39 19 39V37ZM37 19C37 28.9411 28.9411 37 19 37V39C30.0457 39 39 30.0457 39 19H37ZM28.45 11.5002C28.45 11.6383 28.3381 11.7502 28.2 11.7502V9.75019C27.2335 9.75019 26.45 10.5337 26.45 11.5002H28.45ZM28.45 26.5002V11.5002H26.45V26.5002H28.45ZM28.2 26.2502C28.3381 26.2502 28.45 26.3621 28.45 26.5002H26.45C26.45 27.4667 27.2335 28.2502 28.2 28.2502V26.2502ZM27.95 26.5002C27.95 26.3621 28.0619 26.2502 28.2 26.2502V28.2502C29.1665 28.2502 29.95 27.4667 29.95 26.5002H27.95ZM27.95 11.5002V26.5002H29.95V11.5002H27.95ZM28.2 11.7502C28.0619 11.7502 27.95 11.6383 27.95 11.5002H29.95C29.95 10.5337 29.1665 9.75019 28.2 9.75019V11.7502ZM22.875 17.5968L17.4583 12.0968L16.0333 13.5002L21.45 19.0002L22.875 17.5968ZM22.875 20.4036C23.6417 19.6251 23.6417 18.3753 22.875 17.5968L21.45 19.0002L21.45 19.0002L22.875 20.4036ZM17.4583 25.9036L22.875 20.4036L21.45 19.0002L16.0333 24.5002L17.4583 25.9036ZM14.63 25.9252C15.4169 26.7002 16.6832 26.6906 17.4583 25.9036L16.0333 24.5002L16.0333 24.5002L14.63 25.9252ZM14.6084 23.0968C13.8333 23.8838 13.843 25.1501 14.63 25.9252L16.0333 24.5002L16.0333 24.5002L14.6084 23.0968ZM18.3491 19.2985L14.6084 23.0968L16.0333 24.5002L19.7741 20.7019L18.3491 19.2985ZM8.45 21.0002H19.0616V19.0002H8.45V21.0002ZM6.45 19.0002C6.45 20.1048 7.34543 21.0002 8.45 21.0002V19.0002H8.45H6.45ZM8.45 17.0002C7.34543 17.0002 6.45 17.8956 6.45 19.0002H8.45H8.45V17.0002ZM19.0616 17.0002H8.45V19.0002H19.0616V17.0002ZM14.6084 14.9036L18.3491 18.7019L19.7741 17.2985L16.0333 13.5002L14.6084 14.9036ZM14.63 12.0752C13.843 12.8503 13.8333 14.1166 14.6084 14.9036L16.0333 13.5002L16.0333 13.5002L14.63 12.0752ZM17.4583 12.0968C16.6832 11.3098 15.4169 11.3002 14.63 12.0752L16.0333 13.5002L16.0333 13.5002L17.4583 12.0968Z" fill="currentColor" mask="url(#path-1-inside-1_3137_43271)"/>
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
// READ ME: Importing video player breaks the app for some reason.
// We need further investigation on this matter, but for now let's use it globally.
// import VideoPlayer from "../vuesora/components/VideoPlayer/VideoPlayer.vue";

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
    //console.log(props.videoProps.totalDuration)
})
</script>
