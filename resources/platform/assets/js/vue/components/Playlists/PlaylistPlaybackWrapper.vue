<script setup>
/* Todo:
    RE add captions
    fix tracking for videos
*/
import { onBeforeMount, computed, reactive } from 'vue';
import { usePlaylistsStore } from '../../../stores/playlists';
import SoundSlice from '../SoundSlice/SoundSlice.vue';
import PlaybackCue from './PlaybackCue.vue';
import Comments from '../../vuesora/views/comments/Comments.vue';
import PlaybackNavButtons from './PlaybackNavButtons.vue';
import RelatedLesson from './RelatedLesson.vue';
import Breadcrumb from './Breadcrumb.vue';
import VideoMediaElement from '../../vuesora/components/MediaElement/MediaElement.vue';
import VideoPlayer from '../../vuesora/components/VideoPlayer/VideoPlayer.vue';
import VideoResources from '../../vuesora/components/VideoResources/VideoResources.vue';
import YoutubePlayer from '../../vuesora/components/YoutubePlayer/YoutubePlayer.vue';
import ContentUnavailable from './ContentUnavailable.vue';
import AssignmentsContainer from '../../vuesora/components/AssignmentsContainer/AssignmentsContainer.vue';

//-----------Props-----------//
const props = defineProps({
    additionalSoundsliceParams: {
        type: String,
        default: ''
    },
    assignments: {
        type: Array,
        default: () => []
    },
    brand: {
        type: String,
        default: ''
    },
    castTitle: {
        type: String,
        default: ''
    },
    contentId: {
        type: [Number, String],
        default: ''
    },
    currentSecond: {
        type: [Number, String],
        default: ''
    },
    description: {
        type: String,
        default: ''
    },
    endSecond: {
        type: [String, Number],
        default: null
    },
    hlsManifestUrl: {
        type: String,
        default: ''
    },
    instructors: {
        type: Array,
        default: []
    },
    isMyPlaylist: {
        type: Number,
    },
    isLiked: {
        type: Boolean,
        default: false
    },
    lessonData:{
        type: Array,
        default: () => []
    },
    lessonType: {
        type: String,
        default: ''
    },
    likeCount: {
        type: [Number, String],
        default: ''
    },
    nextLessonUrl: {
        type: String,
        default: '/'
    },
    playlistItems: {
        type: Object,
        default: {}
    },
    playlistDuration: {
        type: [Number, String],
        default: ''
    },
    playlistUrl: {
        type: String,
        default: ''
    },
    playlistName: {
        type: String,
        default: ''
    },
    playlistId: {
        type: [String, Number],
        default: ''
    },
    playlistItemId: {
        type: [String, Number],
        default: ''
    },
    playlistItemTitle: {
        type: String,
        default: ''
    },
    playlistItemPosition: {
        type: [String, Number]
    },
    progressState: {
        type: [Number, String],
        default: ''
    },
    parentTitle: {
        type: String,
        default: ''
    },
    prevLessonUrl: {
        type: String,
        default: '/'
    },
    rangesVideoIds: {
        type: Array,
        default: []
    },
    relatedLesson: {
        type: Object,
        default: {}
    },
    relatedPlaylists: {
        type: Object,
        default: {}
    },
    showInfoButton: {
        type: Boolean,
        default: false
    },
    startSecond: {
        type: [String, Number],
        default: 0
    },
    songRanges: {
        type: Array,
        default: []
    },
    soundsliceSlug: {
        type: String,
        default: ''
    },
    totalDuration: {
        type: [Number, String],
        default: ''
    },
    thumbnailUrl: {
        type: String,
        default: ''
    },
    userId: {
        type: [String, Number],
        default: ''
    },
    userName: {
        type: String,
        default: ''
    },
    userAvatar: {
        type: String,
        default: ''
    },
    userXp: {
        type: [String, Number],
        default: ''
    },
    userAccessLevel: {
        type: [String, Number],
        default: ''
    },
    useLegacyVideoPlayer: {
        type: Boolean,
        default: false,
    },
    videoPosterImageUrl: {
        type: String,
        default: ''
    },
    videoMediaSources: {
        type: [Array, Object],
        default: {}
    },
    videoChapters: {
        type: Array,
        default: []
    },
    videoLength: {
        type: [Number, String],
        default: ''
    },
    vimeoVideoId: {
        type: [Number, String],
        default: ''
    },
    videoResources: {
        type: Array,
        default: []
    },
    youtubeVideoId: {
        type: [Number, String],
        default: ''
    },
    subscriptionCalendarId: {
        type: String,
        default: ''
    },
});

const state = reactive({
    assignmentCollapsed: false,
});

//Pinia Stores
const playlistsStore = usePlaylistsStore();

const handleGoToNext = () => {
    const isShuffleOn = localStorage.getItem("playbackShuffleOn") ? JSON.parse(localStorage.getItem("playbackShuffleOn")) : false;
    const isPlaylistRepeatOn = localStorage.getItem("isPlaybackPlaylistRepeatOn") ? JSON.parse(localStorage.getItem("isPlaybackPlaylistRepeatOn")) : false;

    if (isShuffleOn) {
        const randIndex = Math.floor(Math.random() * playlistsStore.lessons.length);
        window.location.href = playlistsStore.lessons[randIndex].url;
    } else if (isPlaylistRepeatOn && (String(props.playlistItemPosition) === String(props.playlistItems?.meta?.totalResults))) {
        window.location.href = playlistsStore.lessons[0].url;
    } else if (isPlaylistRepeatOn && props.nextLessonUrl && props.nextLessonUrl !== '/') {
        window.location.href = props.nextLessonUrl;
    }
};

//Constants
const activeItem = props.playlistItems.data.find(l => l.id === props.playlistItemId);
const dateNow = Date.now();
const lessonDateParsed = activeItem.published_on_in_timezone ? Date.parse(activeItem.published_on_in_timezone) : Date.parse(activeItem.published_on);
const lessonDate = activeItem.published_on_in_timezone ? activeItem.published_on_in_timezone : activeItem.published_on;

//computed
const homeUrl = computed(() => `/${props.brand}/playlists`);
const secondLevelUrl = computed(() => `/${props.brand}/playlist/${props.playlistId}`);
const released = computed(() => {
    return lessonDateParsed < dateNow;
})
const needAccess = computed(() => {
    return activeItem.need_access;
})

const needAccessMessage = computed(() => {
    return activeItem.need_access_message;
})
const isSong = computed(() => {
    return activeItem.type === 'song';
})

const unavailableType = computed(() => {
    if (!released) {
        return 'unreleased';
    }
    if (needAccess) {
        if (props.lessonType === 'song') {
            return 'song';
        }
        if (needAccessMessage && String(needAccessMessage).toLowerCase().includes('pack')) {
            return 'pack';
        }
        if (needAccessMessage && String(needAccessMessage).toLowerCase().includes('lifetime')) {
            return 'lifetime';
        }
        return 'expired';
    }
    return null;
});

const handleVideoPause = () => {};
const handleVideoPlay = () => {};

onBeforeMount(() => {
    //console.log(activeItem)
    //console.log('released', props.released, 'need access', activeItem.need_access, 'no access message', activeItem.need_access_message)
});
</script>

<template>
    <div class="tw-w-full tw-h-full">
        <!-- Breadcrumbs -->
        <Breadcrumb :class="{ 'lg:tw-hidden': playlistsStore.playerExpanded }" :brand="brand"
            :first-level-url="`/${brand}/playlists`" first-level-title="Playlists" :secondLevelUrl="secondLevelUrl"
            :secondLevelTitle="playlistName" :lastLevelTitle="playlistItemTitle" />
        <div class="tw-grid tw-grid-cols-3 2xl:tw-grid-cols-[auto_auto_420px] tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 tw-mt-3 tw-flex-col"
             :class="{ 'tw-gap-4' : !playlistsStore.playerExpanded }"
        >
            <!--Video Wrapper -->
            <div class="tw-col-span-3 tw-w-full"
                 :class="playlistsStore.playerExpanded ? '2xl:tw-col-span-3' : '2xl:tw-col-span-2'"
            >
                <!-- Content Unavailable -->
                <ContentUnavailable v-if="!released || needAccess" @goToNext="handleGoToNext"
                    :subscriptionCalendarId="subscriptionCalendarId" :bgImgUrl="thumbnailUrl"
                    :releaseDate="lessonDateParsed" :unavailableType="unavailableType" :itemName="playlistItemTitle"
                    :message="needAccessMessage" />
                <!-- Soundslice Player -->
                <div v-if="(lessonType === 'song' || lessonType === 'assignment' || lessonType === 'routine') && !needAccess && released"
                    class="tw-w-full tw-aspect-video tw-max-h-[90vh] tw-mb-4"
                    :class="{ 'tw-max-w-[1280px]' : !playlistsStore.playerExpanded }"
                >
                    <SoundSlice :user-id="userId" :theme-color="brand" :additional-params="additionalSoundsliceParams"
                        :soundslice-slug="soundsliceSlug" :content-id="contentId" @onAudioEnd="handleGoToNext">
                    </SoundSlice>
                </div>
                <!-- Video Players -->
                <div v-if="released && !needAccess" class="p-lg-only lean tw-relative">
                    <div v-if="youtubeVideoId && String(youtubeVideoId).length" class="widescreen mb-2 bg-black">
                        <YoutubePlayer ref="mediaElementVueInstance" :brand="brand" :video-id="youtubeVideoId"
                            :start-second="startSecond" :end-second="endSecond"
                            :total-duration="totalDuration" :video-length="videoLength" :progress-state="progressState"
                            :content-id="contentId" :use-intersection-observer="true" :theme-color="brand"
                            @play="handleVideoPlay" @pause="handleVideoPause" @onVideoEnd="handleGoToNext">
                        </YoutubePlayer>
                    </div>
                    <div v-else-if="lessonType !== 'song' && lessonType !== 'assignment' && lessonType !== 'routine'"
                        id="lessonVideoWrap">
                        <transition v-if="useLegacyVideoPlayer" appear name="fade">
                            <VideoMediaElement ref="mediaElementVueInstance" element-id="lessonPlayer" :brand="brand"
                                :theme-color="brand" :poster="videoPosterImageUrl" :sources="videoMediaSources"
                                :hls-manifest-url="hlsManifestUrl" :video-id="vimeoVideoId" :content-id="contentId"
                                :current-second="currentSecond" :progress-state="progressState"
                                :video-length="videoLength" :chapters="videoChapters" :user-id="userId"
                                :like-count="likeCount" :is-liked="isLiked" :check-for-timecode="true"
                                @playing="handleVideoPlay" @pause="handleVideoPause" @ended="handleGoToNext">
                                <div :class="`widescreen title tw-text-${brand}`">
                                    <i class="fas fa-spinner fa-spin absolute-center"></i>
                                </div>
                            </VideoMediaElement>
                        </transition>
                        <transition v-else appear name="fade">
                            <VideoPlayer ref="mediaElementVueInstance" :start-second="startSecond"
                                :end-second="endSecond" :theme-color="brand" :brand="brand"
                                :poster="videoPosterImageUrl" :sources="videoMediaSources" :ranges="songRanges"
                                :ranges-video-ids="rangesVideoIds" :show-range-buttons="true"
                                :hls-manifest-url="hlsManifestUrl" :chapters="videoChapters"
                                :current-second="currentSecond" :content-id="contentId" :user-id="userId"
                                :video-id="vimeoVideoId" :video-length="videoLength" :total-duration="totalDuration"
                                :cast-title="playlistItemTitle" :use-intersection-observer="true" @play="handleVideoPlay"
                                @pause="handleVideoPause" @onVideoEnd="handleGoToNext">
                                <div :class="`widescreen title tw-text-${brand} tw-mb-2`"></div>
                            </VideoPlayer>
                        </transition>
                    </div>
                </div>
                <!-- Video Resources -->
                <div class="tw-mb-4">
                    <VideoResources :theme-color="brand" :brand="brand" :title="playlistItemTitle" :lesson-type="lessonType"
                        :thumbnail-url="thumbnailUrl" :description="description" :instructors="instructors"
                        :parent-title="parentTitle" :is-liked="isLiked" :like-count="likeCount" :content-id="contentId"
                        :user-id="userId" :resources="videoResources" :show-add-to-list="true"
                        :show-complete-button="released && !needAccess" :relatedLesson="relatedLesson"
                        :lesson="playlistItems.data[props.playlistItemPosition - 1]" :show-info-button="showInfoButton" />
                    <PlaybackNavButtons :next-lesson-url="nextLessonUrl" :prev-lesson-url="prevLessonUrl" />
                    <RelatedLesson v-if="relatedLesson && relatedLesson.data && relatedLesson.data.length"
                        :relatedLesson="relatedLesson.data[0]" :brand="brand" />
                </div>
                <!-- Info Section -->
                <slot name="info-section"></slot>
            </div>

            <!-- Cue and Realted Playlist Wrapper -->
            <div class="tw-w-full tw-col-span-3 tw-flex tw-flex-col"
                :class="playlistsStore.playerExpanded ? 'tw-mb-0 2xl:tw-col-span-3 lg:tw-order-first' : '2xl:tw-mt-0 2xl:tw-col-span-1'"
            >
                <!-- Playback Cue -->
                <div v-if="playlistItems.data && playlistItems.data.length" class="tw-flex tw-flex-col tw-w-full tw-my-4 lg:tw-my-0">
                    <playback-cue :autoplay="false" :repeat="false" :brand="brand" :lessons="playlistItems"
                        :playlist-name="playlistName" :duration="playlistDuration" :playlist-url="playlistUrl"
                        :playlist-item-id="playlistItemId" :playlist-id="playlistId" :infinite-scroll="true"
                        :playlist-item-position="playlistItemPosition" :next-lesson-url="nextLessonUrl"
                        :prev-lesson-url="prevLessonUrl" :is-my-playlist="isMyPlaylist" :is-playback-cue="true" />
                </div>
                <!-- Related Playlists -->
                <div v-if="relatedPlaylists.data && relatedPlaylists.data.length"
                    class="tw-flex tw-flex-row reverse tw-items-start"
                    :class="playlistsStore.playerExpanded ? 'lg:tw-hidden' : ''"
                >
                    <div class="tw-flex tw-flex-col tw-w-full tw-my-4 2xl:tw-mt-0 2xl:tw-ml-4 ">
                        <div class="tw-flex tw-flex-col tw-mb-5">
                            <h6 class="tw-text-2xl tw-leading-none tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                                Related Playlists
                            </h6>
                        </div>
                        <RelatedPlaylists :playlists="relatedPlaylists" :brand="brand" />
                    </div>
                </div>
            </div>

            <!-- Assignments and Comments Wrapper -->
            <div class="tw-col-span-3 2xl:tw-col-span-2" :class="playlistsStore.playerExpanded ? 'lg:tw-hidden' : ''">
                <!-- Assignments Section -->
                <div v-if="assignments.length > 0" class="tw-flex tw-flex-col tw-flex-grow tw-mt-3 tw-w-full">
                    <div class="tw-flex tw-flex-row tw-w-full tw-justify-between tw-items-center tw-border-b tw-border-[#e5e8e8] dark:tw-border-[#223F57] tw-pb-4">
                        <h1 class="heading dark:tw-text-white">Assignments</h1>
                        <button @click="state.assignmentCollapsed = !state.assignmentCollapsed">
                            <div class="tw-border-2 tw-text-[#000C17] tw-border-[#000C17] dark:tw-text-white dark:tw-border-white tw-h-[50px] tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center" :class="!state.assignmentCollapsed && 'tw-rotate-180'">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </button>
                    </div>
                    <div class="tw-flex-row tw-w-full" :class="state.assignmentCollapsed ? 'tw-hidden' : 'tw-flex'">
                        <assignments-container
                            :lesson-data="lessonData"
                            :assignments="assignments"
                            :brand="brand"
                            :user-id="userId"
                        >
                        </assignments-container>
                    </div>
                </div>
                <!-- Comments Section -->
                <div class="tw-flex tw-flex-col tw-flex-grow tw-w-full tw-mb-4">
                    <div class="tw-flex tw-flex-col tw-w-full">
                        <Comments :collapsable="true" :theme-color="brand" :brand="brand" :content-id="contentId"
                            :user-id="userId" :user-name="userName" :user-avatar="userAvatar" :user-xp="userXp"
                            :user-access-level="userAccessLevel" profile-base-route="/profile/" :is-admin="false" />
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>
