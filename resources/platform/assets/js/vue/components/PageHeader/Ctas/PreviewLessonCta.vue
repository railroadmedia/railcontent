<template>
    <PageHeaderCta v-bind="$attrs" text="Play Trailer" faIconClass="fa-play" @click="handleOpen" />

    <InfoModal v-if="modalOpen" modalId="previewModal"
        :classOverride="'tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]'"
        :selfContained="true" @onClose="handleClose">
        <div class="flex flex-column corners-10 tw-px-5 tw-pt-8">
            <template v-if="brand !== 'drumeo'">
                <div class="video-wrap">
                    <div class="widescreen">
                        <div class="flex flex-column video-player user-active">
                            <iframe
                                style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: 1;"
                                :src="vimeoUrl[brand]" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <video-player ref="learningPathPreview" :theme-color="brand" :poster="poster" :sources="sources"
                    hls-manifest-url="" captions="" :current-second="0" :video-id="videoId" :content-id="contentId"
                    :user-id="userId" :cast-title="castTitle" :use-intersection-observer="true" :controls="videoControls">
                </video-player>
            </template>
            <div class="tw-flex tw-flex-row tw-mt-4 tw-items-center tw-flex-wrap">
                <h1 class="subheading text-white grow tw-pb-3">
                    {{ castTitle }}
                </h1>
                <a :href="nextLessonUrl" class="tw-btn-primary" :class="`tw-bg-${brand}`">
                    <i class="fas fa-play mr-1"></i>
                    Start Next Lesson
                </a>
            </div>
        </div>
    </InfoModal>
</template>

<script setup>
import { ref, computed } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../../stores/user';
import InfoModal from '../../Modal/InfoModal.vue';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    contentId: [String, Number],
    videoId: String,
    castTitle: String,
    poster: String,
    sources: Array,
    nextLessonUrl: String,
});

const modalOpen = ref(false);

const handleOpen = () => {
    modalOpen.value = true;
};

const handleClose = () => {
    modalOpen.value = false;
};

const userId = computed(() => userStore.id);

const vimeoUrl = {
    guitareo: '//player.vimeo.com/video/494183465',
    singeo: '//player.vimeo.com/video/494183465',
    pianote: '//player.vimeo.com/video/494183465',
};

const videoControls = {
    backward: false,
    forward: false,
    progress: true,
    play: true,
    time: true,
    volume: true,
    settings: false,
    fullscreen: false,
};
</script>