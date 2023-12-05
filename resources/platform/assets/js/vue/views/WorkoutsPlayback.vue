<template>
    <div>
        <Breadcrumb
            :first-level-url="breadcrumbFirstLevelUrl"
            :first-level-title="breadcrumbFirstLevelTitle"
            :last-level-title="breadcrumbLastLevelTitle"
        />
        <div class="tw-flex tw-w-full">
            <div class="tw-grow">
                <div class="tw-w-full" v-if="videoProps.videoId">
                    <YoutubePlayer v-if="videoProps.videoType === 'youtube'"
                        :video-id="videoProps.videoId"
                    />
                    <video-player v-else-if="videoProps.videoType === 'vimeo' && videoProps.useLegacyPlayer"
                        ref="mediaElementVueInstance"
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
                    >
                        <div :class="`widescreen title tw-text-${brand} tw-mb-2`"></div>
                    </video-player>
                    <video-player v-else-if="videoProps.videoType === 'vimeo' && !videoProps.useLegacyPlayer"
                        ref="mediaElementVueInstance"
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
                    >
                        <div :class="`widescreen title tw-text-${brand} tw-mb-2`"></div>
                    </video-player>
                    <div v-else>ERROR LOADING VIDEO...</div>
                </div>
            </div>
            <div >sidebar</div>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from "vue";
import { storeToRefs } from 'pinia';
import {useUserStore} from "../../stores/user";

import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import YoutubePlayer from "../vuesora/components/YoutubePlayer/YoutubePlayer.vue";
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
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

onMounted(()=> {
    console.log('videoType',props.videoType)
})
</script>
