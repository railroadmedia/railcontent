<script setup>
const props = defineProps({
    prevLabel: {
        type: String,
        default: 'Prev'
    },
    nextLabel: {
        type: String,
        default: 'Next'
    },
    prevLessonUrl: {
        type: String,
        default: ''
    },
    nextLessonUrl: {
        type: String,
        default: ''
    },
});
</script>

<template>
    <div class="tw-flex tw-w-full tw-justify-between">
        <div class="tw-flex tw-flex-col " dusk="previous-lesson">
            <a v-if="prevLessonUrl" :href="prevLessonUrl" data-tooltip="Previous Lesson" :class="`tw-btn-secondary tw-btn-circle sm:tw-btn-regular tw-text-[#0D0D0D] tw-border-[#0D0D0D] dark:tw-text-white dark:tw-border-white`">
                <i class="fas fa-chevron-left"></i>
                <span class="tw-hidden sm:tw-inline ml-1">{{ prevLabel }}</span>
            </a>
            <a v-else class="tw-btn-secondary tw-btn-circle sm:tw-btn-regular tw-text-gray-400 dark:tw-text-[#7E9AB1] no-events">
                <i class="fas fa-chevron-left"></i>
                <span class="tw-hidden sm:tw-inline ml-1">{{ prevLabel }}</span>
            </a>
        </div>

        <div class="tw-flex tw-flex-col" dusk="next-lesson">
            <a v-if="nextLessonUrl" :href="nextLessonUrl" :class="`tw-btn-secondary tw-btn-circle sm:tw-btn-regular tw-text-[#0D0D0D] tw-border-[#0D0D0D] dark:tw-text-white dark:tw-border-white`" data-tooltip="Next Lesson">
                <span class="tw-hidden sm:tw-inline mr-1">{{ nextLabel }}</span>
                <i class="fas fa-chevron-right"></i>
            </a>
            <a v-else class="tw-btn-secondary tw-btn-circle sm:tw-btn-regular tw-text-gray-400 dark:tw-text-[#7E9AB1] no-events">
                <span class="tw-hidden sm:tw-inline mr-1">{{ nextLabel }}</span>
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
</template>
