<script setup>
import LoadingSpinner from '../LoadingSpinner/LoadingSpinner.vue';

const props = defineProps({
    bgImgUrl: String,
});
</script>

<template>
    <div :class="`tw-flex tw-items-center tw-justify-center tw-w-full tw-aspect-video tw-bg-[url('${bgImgUrl}')]`">
        <LoadingSpinner />
    </div>
</template>