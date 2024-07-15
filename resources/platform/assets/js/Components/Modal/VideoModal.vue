<template>
    <ModalRenderer @onClose="handleClose">
        <button @click="handleClose"
            class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
        </button>
        <div class="tw-w-full tw-mx-6 lg:tw-mx-0 lg:tw-w-1/2 tw-relative" style="padding-bottom: 56.25%;">
            <iframe class="tw-absolute tw-w-full tw-h-full reset-on-close" :src="videoUrl" frameborder="0" allowfullscreen
                allow="autoplay" title="primaryVideo"></iframe>
        </div>
    </ModalRenderer>
</template>

<script setup>
import ModalRenderer from './ModalRenderer.vue';
import { XIcon } from '@heroicons/vue/outline';

const props = defineProps({
    videoUrl: {
        type: String,
        default: ''
    }
});

const handleClose = () => {
    emit('onCloseModal');
};

const emit = defineEmits(['onCloseModal']);
</script>