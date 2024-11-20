<template>
    <div class="tw-flex tw-flex-nowrap lg:tw-grid tw-grid-cols-4 xl:tw-grid-cols-6 tw-gap-4 tw-no-scrollbar tw-overflow-x-scroll">
        <ChallengeAwardCard v-for="award in preLoadedContent" :award="award" />
    </div>
</template>
<script setup>
import ChallengeAwardCard from '@collections/ChallengeAwardContainer/ChallengeAwardCard';

const props = defineProps({
    preLoadedContent: {
        type: Array,
        default: () => [],
    },
})
</script>
