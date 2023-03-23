<script setup>
const props = defineProps({
    relatedLesson: {
        type: Object,
        default: {}
    }
});
</script>
<template>
    <div class="tw-flex tw-flex-col tw-py-[32px]">
        <h3 class="tw-text-[18px] tw-font-bold dark:tw-text-white tw-pb-[12px]">Related Lesson</h3>
        <div class="tw-flex">
        <div class="tw-h-[70px]">
            <img src="https://placehold.jp/130x70.png" class="tw-h-[70px] tw-rounded" />
        </div>
        <div class="tw-flex tw-flex-col tw-px-[16px]">
            <div class="tw-text-[12px] dark:tw-text-[#9EC0DC]">
                HARDCODED - HARDCODED - HARDCODED
            </div>
            <div class="tw-text-[16px] tw-text-white tw-font-bold">
                HARDCODED HARDCODED
            </div>
            <div class="tw-text-[12px] dark:tw-text-[#9EC0DC]">
                hardcoded hardcoded
            </div>
        </div>
    </div>
    </div>
</template>