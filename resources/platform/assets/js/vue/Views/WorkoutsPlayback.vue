<template>
    <div>
        <Breadcrumb :first-level-url="breadcrumbFirstLevelUrl" :first-level-title="breadcrumbFirstLevelTitle"
            :last-level-title="breadcrumbLastLevelTitle" />

        <div class="tw-grid tw-grid-cols-3 2xl:tw-grid-cols-[auto_auto_420px] tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 tw-mt-3 tw-flex-col tw-gap-4">
            
            <!-- VIDEO WRAPPER -->
            <section class="tw-col-span-3 tw-w-full tw-flex" :class="isRelatedSectionOpen ? '2xl:tw-col-span-2' : 'tw-mb-8'">
                <!-- Video Content -->
                <div>
                    <!--Video-->
                    <div class="tw-w-full tw-aspect-video dark:tw-bg-[#081825] tw-bg-[#EDEDED]" v-if="videoProps.videoId">
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
                        @open-practice-soundslice="openSlice(videoResources.title, 0, false)"
                    />

                    <ContentInfo :breadcrumbs="contentBreadcrumb" :content-description="contentDescription"
                        :content-chapters="videoProps.chapters" :instructors="contentInstructors" />

                    <VideoChapters 
                        v-if="formattedChapters.length" 
                        :chapters="formattedChapters" 
                        @open-slice="openSlice"
                    />

                    <VideoButtons :prev-lesson-url="videoButtons.prevLessonUrl" :next-lesson-url="videoButtons.nextLessonUrl"
                        :brand="brand" :prev-label="videoButtons.prevLabel" :next-label="videoButtons.nextLabel"
                        :has-qa-video="videoButtons.hasQAVideo" 
                    />
                </div>
                <!-- Close Expanded View -->
                <div class="2xl:tw-ml-[21px] tw-transition-all tw-overflow-hidden tw-shrink-0 tw-hidden" :class=" {'2xl:tw-inline-block' : !isRelatedSectionOpen }">
                    <button @click="isRelatedSectionOpen = !isRelatedSectionOpen" class="tw-text-black dark:tw-text-white">
                        <svg id="icon-workouts-filled" width="38" height="38" viewBox="0 0 38 38" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.5" y="0.5" width="37" height="37" rx="18.5" transform="matrix(-1 0 0 1 37 0)"
                                fill="transparent" stroke="currentColor" />
                            <path d="M9 11.0498L9 26.0498" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M19.4167 24.0498L14 18.5498M14 18.5498L19.4167 13.0498M14 18.5498L27 18.5498"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </section>

            <!--Related Setion -->
            <aside class="tw-w-full tw-col-span-3 tw-flex tw-flex-col 2xl:tw-mt-0 2xl:tw-col-span-1" :class=" {'2xl:tw-hidden' : !isRelatedSectionOpen } ">
                <div class="tw-flex tw-w-full">
                    <div class="tw-w-full tw-border dark:tw-border-[#002039] tw-border-[#e5e7ea] dark:tw-bg-[#000C17] tw-bg-[#F9F9F9] tw-overflow-hidden tw-transition-all">
                        <header class="tw-flex tw-flex-col">
                            <div class="tw-bg-white dark:tw-bg-[#081825] tw-pt-[24px] tw-pb-[16px] tw-flex tw-justify-between tw-px-[18px]">
                                <h3 class="tw-text-xl tw-font-bold tw-font-open-sans dark:tw-text-white">Related Workouts</h3>
                                <button @click="isRelatedSectionOpen = !isRelatedSectionOpen" class="tw-text-black dark:tw-text-white tw-hidden 2xl:tw-inline-block">
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
                        <section class="tw-w-full tw-flex tw-flex-col tw-max-h-[540px] tw-relative tw-overflow-y-auto lg:tw-block">
                            <div v-for="(item, i) in relatedLessons " 
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
            <section class="tw-col-span-3 2xl:tw-col-span-2" :class="{'2xl:tw-hidden' : !isRelatedSectionOpen }">
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
                    :end-time="videoProps.totalDuration" 
                    :force-start-time="true"
                    :start-time="chapterStartTime"
                >
                    <template v-slot:soundsliceControls>
                        <SoundSliceControls 
                            :title="soundsliceTitle || videoResources.title" 
                            :disable-next="true" 
                            :disable-prev="true"
                            @onClose="handleCloseSoundslice" />
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

const isRelatedSectionOpen = ref(true);
const openSoundslice = ref(false);
const chapterStartTime = ref(0);
const soundsliceTitle = ref('');
const startLooping = ref(false);

const formattedChapters = computed(() => {
    return props.videoProps.chapters.map(({ chapter_description, chapter_thumbnail_url, chapter_timecode }) => {
        return {
            title: chapter_description,
            thumbnail: chapter_thumbnail_url,
            time: chapter_timecode
        }
    })
});

const getBrandSpecificParams = () => {
    return ({
        drumeo: '&show_chords=0',
        singeo: '&show_staff_t1=0&show_staff_t2=0&show_chords=0',
        guitareo: '',
        pianote: '&show_chords=1'
    }[brand]);
};

const openSlice = (title, startAt, loop) => {
    console.log('startAt', startAt);
    soundsliceTitle.value = title;
    chapterStartTime.value = startAt;
    startLooping.value = loop;
    openSoundslice.value = true;
};

const handleCloseSoundslice = () => {
    openSoundslice.value = false;
    startLooping.value = false;

    document.body.classList.remove('no-scroll', 'dim-sidebar');

    Helpscout.showWidget();
    Intercom.showWidget();
};

onMounted(() => {
    //console.log('chapters', props.relatedLessons.data)
})
</script>
