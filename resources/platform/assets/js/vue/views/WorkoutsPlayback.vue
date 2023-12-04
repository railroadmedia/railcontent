<template>
    <div>
        <Breadcrumb
            :first-level-url="breadcrumbFirstLevelUrl"
            :first-level-title="breadcrumbFirstLevelTitle"
            :last-level-title="breadcrumbLastLevelTitle"
        />
        <div class="tw-flex tw-w-full">
            <div class="tw-grow">
                <div class="tw-w-full" v-if="videoType && videoId">
                    <YoutubePlayer v-if="videoType === 'youtube'"
                        :video-id="videoId"
                    />
                    <VideoPlayer v-if="false" />
                </div>
                <div v-else>ERROR LOADING VIDEO</div>
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
import VideoPlayer from "../vuesora/components/VideoPlayer/VideoPlayer.vue";

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
    videoType: {
        type: String,
        default: null
    },
    videoId: {
        type: String,
        default: null
    },
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
</script>
