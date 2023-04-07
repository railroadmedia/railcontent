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

const emit = defineEmits(['onAudioEnd']);

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
    if (event.keyCode === 32) {
        event.preventDefault();

        const embeddedPlayer = document.getElementById('ssEmbed').contentWindow;

        if (isPlaying.value) {
            embeddedPlayer.postMessage('{"method": "pause"}', 'https://www.soundslice.com');
        } else {
            embeddedPlayer.postMessage('{"method": "play"}', 'https://www.soundslice.com');
        }
    }
};

const click = (x, y) => {
    var ev = new MouseEvent('click', {
        'view': window,
        'bubbles': true,
        'cancelable': true,
        'screenX': x,
        'screenY': y
    });

    var el = document.elementFromPoint(x, y);

    el.dispatchEvent(ev);
}

const handleSoundsliceEvent = (event) => {
    //const embeddedPlayer = document.getElementById('ssEmbed').contentWindow;
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
            case 'ssAudioEnd':
                const isRepeatOn = localStorage.getItem("playbackRepeatOn") ? JSON.parse(localStorage.getItem("playbackRepeatOn")) : false;
                const isInPlaybackMode = window.location.href.includes('playlist-item');

                if (isRepeatOn && isInPlaybackMode) {
                    var ssiframe = document.getElementById('ssEmbed').contentWindow;
                    ssiframe.postMessage('{"method": "seek", "arg": 0}', 'https://www.soundslice.com');
                    ssiframe.postMessage('{"method": "play"}', 'https://www.soundslice.com');
                } else {
                    emit('onAudioEnd');
                }
                break;
            case 'ssAudioLoaded':
                console.log('AUDIO LOADED')
                if (false && props.autoplay) {
                    console.log('autoplay code')
                    setTimeout(() => {
                        const soundsliceWrapper = document.getElementById('soundslice-container');
                        const { x, y } = soundsliceWrapper.getBoundingClientRect();
                        click(x + 153, y + 130);
                        console.log('done calling')
                    }, 600);
                }
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
