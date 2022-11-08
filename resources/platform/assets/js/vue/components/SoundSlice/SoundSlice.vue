<script setup>
import { onMounted, onBeforeUnmount } from 'vue';
import LoadingAnimation from '../../vuesora/components/LoadingAnimation/LoadingAnimation.vue';

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
});

const emit = defineEmits(['', '', '', '', '', '', '', '',]);

const scoreOrSlice = () => {
    if (/^\d+$/.test(props.soundsliceSlug)) {
        return 'scores';
    }
    return 'slices';
};

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
    if (event.origin === 'https://www.soundslice.com') {
        const cmd = JSON.parse(event.data);

        switch (cmd.method) {
            case 'ssPlay':
                isPlaying.value = true;
                emit('onPlay');
                break;
            case 'ssPause':
                isPlaying.value = false;
                emit('onPause');
                break;
        }
    }
};

onMounted(() => {
    window.addEventListener('message', handleSoundsliceEvent);
    document.addEventListener('keyup', spacebarToPlayPause);
});

onBeforeUnmount(() => {
    window.removeEventListener('message', handleSoundsliceEvent);
    document.removeEventListener('keyup', spacebarToPlayPause);
});

</script>

<template>
    <div class="tw-h-full tw-w-full">
        <div class="flex flex-column tw-h-full">
            <slot name="soundsliceControls"></slot>
            <div class="flex flex-row grow">
                <div class="flex flex-column relative">
                    <iframe id="ssEmbed"
                        :src="'https://www.soundslice.com/' + scoreOrSlice() + '/' + soundsliceSlug + '/embed/?api=1&scroll_type=2&branding=0&top_controls=1&u=' + userId + additionalParams"
                        frameBorder="0" allowfullscreen @load="emit('onLoad')"></iframe>
                </div>
            </div>
        </div>

        <div v-if="loading" class="loading-exercise heading ph-4 pv-2">
            <LoadingAnimation :theme-color="themeColor" />
        </div>
    </div>
</template>
