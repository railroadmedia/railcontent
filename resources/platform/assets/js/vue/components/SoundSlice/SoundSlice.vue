<script setup>
import { onMounted, onBeforeUnmount, ref } from 'vue';
import LoadingAnimation from '../../vuesora/components/LoadingAnimation/LoadingAnimation.vue';
import ProgressTracker from '../../vuesora/assets/js/classes/progress-tracker';
import ContentService from "../../vuesora/assets/js/services/content";

const props = defineProps({
    themeColor: {
        type: String,
        default: () => 'drumeo',
    },
    additionalParams: {
        type: String,
        default: '',
    },
    soundsliceSlug: {
        type: String,
        default: () => '',
    },
    userId: {
        type: [Number, String],
        default: () => 0,
    },
    contentId: {
        type: [Number, String]
    },
    autoplay: {
        type: Boolean,
        default: false,
    }
});

const scoreOrSlice = () => {
    if (/^\d+$/.test(props.soundsliceSlug)) {
        return 'scores';
    }
    return 'slices';
};

const isPlaying = ref(false);
const isLoading = ref(true);
const hasBeenPlayed = ref(false);
const progressTrackerEventListener = ref(null);
let progressTracker = new ProgressTracker();

const spacebarToPlayPause = (event) => {
    const embeddedPlayer = document.getElementById('ssEmbed').contentWindow;

    if (event.keyCode === 32) {
        event.preventDefault();

        if (isPlaying.value) {
            embeddedPlayer.postMessage('{"method": "pause"}', 'https://www.soundslice.com');
        } else {
            embeddedPlayer.postMessage('{"method": "play"}', 'https://www.soundslice.com');
        }
    }
};

const handleSoundsliceEvent = (event) => {
    const embeddedPlayer = document.getElementById('ssEmbed').contentWindow;
    //const videoContainer = embeddedPlayer.document.getElementById('ytvid0')

    if (event.origin === 'https://www.soundslice.com') {
        const cmd = JSON.parse(event.data);

        switch (cmd.method) {
            case 'ssPlay':
                if (!hasBeenPlayed) {
                    //embeddedPlayer.postMessage('{"method": "play"}', 'https://www.soundslice.com');
                }
                isPlaying.value = true;
                handlePlay();
                break;
            case 'ssPause':
                isPlaying.value = false;
                handlePause();
                break;
        }
    }
};


const sendProgressTracking = () => {
    progressTracker.send({
        mediaId: props.contentId,
        mediaType: 'assignment',
        mediaCategory: 'soundslice',
    });
}

const handlePlay = () => {
    if (!hasBeenPlayed.value) {
        hasBeenPlayed.value = true;
        ContentService.markContentAsStarted(props.contentId);
    }

    progressTracker.start();

    if (!progressTrackerEventListener.value) {
        progressTrackerEventListener.value = true;

        window.addEventListener('unload', sendProgressTracking);
    }
}

const handlePause = () => {
    progressTracker.stop();
}

const handleOnLoad = () => {
    isLoading.value = false;
};

onMounted(() => {
    window.addEventListener('message', handleSoundsliceEvent);
    document.addEventListener('keyup', spacebarToPlayPause);

    if(props.autoplay) {
        //const soundsliceWrapper = 
        //const x = 
        //document.elementFromPoint(x, y).click();
    }
});

onBeforeUnmount(() => {
    progressTracker.sendAsync({
        mediaId: props.contentId,
        mediaType: 'assignment',
        mediaCategory: 'soundslice',
    });

    progressTracker = null;

    window.removeEventListener('unload', () => sendProgressTracking);
    window.removeEventListener('message', handleSoundsliceEvent);
    document.removeEventListener('keyup', spacebarToPlayPause);
});

</script>

<template>
    <div v-if="soundsliceSlug" class="tw-h-full tw-w-full">
        <div class="flex flex-column tw-h-full">
            <slot name="soundsliceControls"></slot>
            <div class="flex flex-row grow">
                <div id="soundslice-container" class="flex flex-column relative">
                    <iframe id="ssEmbed"
                        :src="'https://www.soundslice.com/' + scoreOrSlice() + '/' + soundsliceSlug + '/embed/?api=1&scroll_type=2&branding=0&top_controls=1&u=' + userId + additionalParams"
                        frameBorder="0" allowfullscreen @load="handleOnLoad"></iframe>
                </div>
            </div>
        </div>

        <div v-if="isLoading" class="loading-exercise heading ph-4 pv-2">
            <LoadingAnimation :theme-color="themeColor" />
        </div>
    </div>
</template>
