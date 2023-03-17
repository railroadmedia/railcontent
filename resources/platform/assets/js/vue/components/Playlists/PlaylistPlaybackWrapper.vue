<script setup>
    import { onBeforeMount, reactive, ref } from 'vue';
    import YoutubePlayer from '../../vuesora/components/YoutubePlayer/YoutubePlayer.vue';
    import SoundSlice from '../SoundSlice/SoundSlice.vue';
    import PlaybackCue from './PlaybackCue.vue';
    import VideoMediaElement from '../../vuesora/components/MediaElement/MediaElement.vue';
    import VideoPlayer from '../../vuesora/components/VideoPlayer/VideoPlayer.vue';
    import VideoResources from '../../vuesora/components/VideoResources/VideoResources.vue';
    import Comments from '../../vuesora/views/comments/Comments.vue';
    import ContentCatalogue from '../../vuesora/views/catalogues/ContentCatalogue.vue';

    //-----------Reactive-----------//
    const state = reactive({
        commentsCollapsed: true,
    })

    //-----------Refs-----------//


    //-----------Props-----------//
    const props = defineProps({
        lessonType: {
            type: String,
        },
        brand: {
            type: String,
        },
        userId: {
            type: [String, Number],
        },
        additionalSoundsliceParams: {
            type: String,
        },
        soundsliceSlug: {
            type: String,
        },
        contentId: {
            type: [Number, String],
        },
        youtubeVideoId: {
            type: [Number, String]
        },
        vimeoVideoId: {
            type: [Number, String]
        },
        currentSecond: {
            type: [Number, String]
        },
        totalDuration: {
            type: [Number, String]
        },
        videoLength: {
            type: [Number, String]
        },
        progressState: {
            type: [Number, String]
        },
        useLegacyVideoPlayer: {
            type: Boolean,
            default: false,
        },
        videoPosterImageUrl: {
            type: String,
        },
        videoMediaSources: {
            type: [Array, Object],
        },
        hlsManifestUrl: {
            type: String,
        },
        videoChapters: {
            type: Array
        },
        likeCount: {
            type: [Number, String]
        },
        isLiked: {
            type: Boolean,
        },
        songRanges: {
            type: Array,
        },
        rangesVideoIds: {
            type: Array,
        },
        castTitle: {
            type: String,
        },
        thumbnailUrl: {
            type: String,
        },
        description: {
            type: String,
        },
        instructors: {
            type: Array,
        },
        parentTitle: {
            type: String,
        },
        videoResources: {
            type: Array,
        },
        playlistItems: {
            type: Array,
        },
        playlistDuration: {
            type: Number
        },
        lockUnowned: {
            type: Boolean,
        },
        relatedLessons: {
            type: Array,
        },
        playlistName: {
            type: String,
        },
        userName: {
            type: String,
        },
        userAvatar: {
            type: String,
        },
        userXp: {
            type: [String, Number],
        },
        userAccessLevel: {
            type: [String, Number]
        }
    });
    onBeforeMount(() => {
        console.log(props)
    });
</script>

<template>
    <div class="tw-flex tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3 tw-flex-col 2xl:tw-flex-row tw-mb-4">
        <div class="tw-flex tw-flex-col tw-w-full">
            <!--Player Wrapper -->
            <div class="fluid tw-pb-3 tw-max-w-[1280px] tw-w-full tw-mx-auto">
                <!-- Soundslice Player -->
                <div v-if="lessonType === 'song' || lessonType === 'assignment'"
                    class="tw-w-full tw-max-w-[1280px] tw-aspect-video">
                    <SoundSlice :user-id="userId" :theme-color="brand" :additional-params="additionalSoundsliceParams"
                        :soundslice-slug="soundsliceSlug" :content-id="contentId">
                    </SoundSlice>
                </div>
                <!-- Video Players -->
                <div class="p-lg-only lean">
                    <div v-if="youtubeVideoId && String(youtubeVideoId).length" class="widescreen mb-2 bg-black">
                        <YoutubePlayer ref="mediaElementVueInstance" :brand="brand" :video-id="youtubeVideoId"
                            :current-second="currentSecond" :total-duration="totalDuration" :video-length="videoLength"
                            :progress-state="progressState" :content-id="contentId" :use-intersection-observer="true"
                            :theme-color="brand" @play="handleVideoPlay" @pause="handleVideoPause">
                        </YoutubePlayer>
                    </div>
                    <div v-else-if="lessonType !== 'song' && lessonType !== 'assignment'" id="lessonVideoWrap">
                        <transition v-if="useLegacyVideoPlayer" appear name="fade">
                            <VideoMediaElement ref="mediaElementVueInstance" element-id="lessonPlayer" :brand="brand"
                                :theme-color="brand" :poster="videoPosterImageUrl" :sources="videoMediaSources"
                                :hls-manifest-url="hlsManifestUrl" :video-id="vimeoVideoId" :content-id="contentId"
                                :current-second="currentSecond" :progress-state="progressState" :video-length="videoLength"
                                :chapters="videoChapters" :user-id="userId" :like-count="likeCount" :is-liked="isLiked"
                                :check-for-timecode="true" @playing="handleVideoPlay" @pause="handleVideoPause">

                                <div :class="`widescreen title tw-text-${brand}`">
                                    <i class="fas fa-spinner fa-spin absolute-center"></i>
                                </div>
                            </VideoMediaElement>
                        </transition>
                        <transition v-else appear name="fade">
                            <VideoPlayer ref="mediaElementVueInstance" :theme-color="brand" :brand="brand"
                                :poster="videoPosterImageUrl" :sources="videoMediaSources" :ranges="songRanges"
                                :ranges-video-ids="rangesVideoIds" :show-range-buttons="true"
                                :hls-manifest-url="hlsManifestUrl" :captions="captions" :chapters="videoChapters"
                                :current-second="currentSecond" :content-id="contentId" :user-id="userId"
                                :video-id="vimeoVideoId" :video-length="videoLength" :total-duration="totalDuration"
                                :cast-title="castTitle" :use-intersection-observer="true" @play="handleVideoPlay"
                                @pause="handleVideoPause">
                                <div :class="`widescreen title tw-text-${brand} tw-mb-2`"></div>
                            </VideoPlayer>
                        </transition>
                    </div>
                </div>
                <!-- Video Resources -->
                <div class="tw-container tw-mx-auto lean">
                    <VideoResources :theme-color="brand" :brand="brand" :title="castTitle" :lesson-type="lessonType"
                        :thumbnail-url="thumbnailUrl" :description="description" :instructors="instructors"
                        :parent-title="parentTitle" :is-liked="isLiked" :like-count="likeCount" :content-id="contentId"
                        :user-id="userId" :resources="videoResources" :show-add-to-list="true"></VideoResources>
                    <slot></slot>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="tw-flex tw-flex-col tw-flex-grow tw-w-full tw-mb-4">
                <div class="tw-flex tw-flex-col tw-w-full">
                    <Comments  
                        :collapsable="true"
                        :theme-color="brand" 
                        :brand="brand" 
                        :content-id="contentId" 
                        :user-id="userId"
                        :user-name="userName" 
                        :user-avatar="userAvatar" 
                        :user-xp="userXp"
                        :user-access-level="userAccessLevel" 
                        profile-base-route="/profile/" 
                        :is-admin="false"
                    />
                </div>
            </div>
        </div>

        <div class="related-lessons-section">
            <!-- Playback Cue -->
            <div v-if="playlistItems.data && playlistItems.data.length" 
                 id="lessonInfo" 
                 class="tw-flex tw-flex-row reverse tw-items-start"
            >
                <div class="tw-flex tw-flex-col tw-w-full 2xl:tw-w-[420px] tw-my-4 2xl:tw-mt-0 2xl:tw-ml-4 ">
                    <playback-cue
                        :autoplay="false"
                        :repeat="false"
                        :brand="brand"
                        :lessons="playlistItems"
                        :playlist-name="playlistName"
                        :duration="playlistDuration"
                    />
                </div>
            </div>
            <!-- Related Lessons -->
            <div id="lessonInfo" class="tw-flex tw-flex-row reverse tw-items-start">
                <div class="tw-flex tw-flex-col tw-w-full 2xl:tw-w-[420px] tw-my-4 2xl:tw-mt-0 2xl:tw-ml-4 ">
                    <div class="tw-flex tw-flex-col tw-mb-5">
                        <h6 class="tw-text-2xl tw-leading-none tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                            Related Lessons
                        </h6>
                    </div>

                    <ContentCatalogue v-if="relatedLessons.data && relatedLessons.data.length" catalogue-type="grid" :theme-color="brand" :use-theme-color="true" :brand="brand"
                        :pre-loaded-content="relatedLessons" :lock-unowned="lockUnowned" :display-inline="true"
                        :user-id="userId"></ContentCatalogue>
                </div>
            </div>
        </div>
    </div>
</template>