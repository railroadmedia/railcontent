<script setup>
const props = defineProps({
    disableNext: {
        type: Boolean,
        default: true,
    },
    disablePrev: {
        type: Boolean,
        default: true,
    },
    title: {
        type: String,
        default: '',
    },
});

const emit = defineEmits(['onGoToPrevious', 'onGoToNext', 'onClose']);
</script>

<template>
    <div class="tw-flex tw-flex-row bb-grey-4-1 bg-grey-5 ph tw-relative tw-h-12 tw-items-center">
        <div v-if="!disableNext || !disablePrev" class="self-start">
            <button v-if="disablePrev"
                class="tw-text-sm sm:tw-text-md tw-text-white  tw-opacity-30 tw-text-left tw-bg-transparent tw-border-none">
                <i class="fas fa-chevron-left ml-1"></i> <span
                    class="tw-hidden sm:tw-inline-block tw-pl-2">Previous</span>
            </button>
            <button v-else
                class="tw-text-sm sm:tw-text-md tw-text-white tw-text-left tw-bg-transparent tw-border-none pointer"
                @click="emit('onGoToPrevious')">
                <i class="fas fa-chevron-left ml-1"></i> <span
                    class="tw-hidden sm:tw-inline-block tw-pl-2">Previous</span>
            </button>
        </div>
        <div class="tw-flex tw-flex-column self-center tw-text-center tw-flex-grow">
            <h2 class="tw-text-sm sm:tw-text-xl tw-text-white text-truncate-1-line tw-text-center tw-px-2 tw-w-full">
                {{ title }}
            </h2>
        </div>
        <div v-if="!disableNext || !disablePrev" class="self-end tw-mr-12">
            <button v-if="disableNext"
                class="tw-text-sm sm:tw-text-md tw-text-white tw-opacity-30 tw-text-right tw-bg-transparent tw-border-none">
                <span class="tw-hidden sm:tw-inline-block tw-pr-2">Next</span> <i
                    class="fas fa-chevron-right tw-mr-2"></i>
            </button>
            <button v-else
                class="tw-text-sm sm:tw-text-md tw-text-white tw-text-right tw-bg-transparent tw-border-none pointer"
                @click="emit('onGoToNext')">
                <span class="tw-hidden sm:tw-inline-block tw-pr-2">Next</span> <i
                    class="fas fa-chevron-right tw-mr-2"></i>
            </button>
        </div>
        <div class="tw-flex tw-flex-row close-exercise uppercase tw-text-white tw-items-center pointer flex-auto self-end"
            @click="emit('onClose')">
            <div
                class="tw-flex tw-flex-row tw-items-center title bg-error tw-absolute tw-right-0 tw-top-0 tw-w-12 tw-h-full">
                <i class="fas fa-times tw-text-center tw-w-full"></i>
            </div>
        </div>
    </div>
</template>