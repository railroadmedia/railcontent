<template>
    <div class="tw-flex tw-flex-nowrap lg:tw-grid tw-grid-cols-4 xl:tw-grid-cols-6 tw-gap-4 tw-no-scrollbar tw-overflow-x-scroll">
        <SkeletonChallengeAwardCard v-if="isLoading" v-for="n in 4" :key="n" />
        <ChallengeAwardCard v-else v-for="award in preLoadedContent" :award="award" />
    </div>
</template>
<script setup>
import { usePlatformStore } from "@stores/platform";
import { storeToRefs } from "pinia/dist/pinia";
import ChallengeAwardCard from '@collections/ChallengeAwardContainer/ChallengeAwardCard';
import SkeletonChallengeAwardCard from '@collections/SkeletonLoader/SkeletonChallengeAwardCard';

const props = defineProps({
    preLoadedContent: {
        type: Array,
        default: () => [],
    },
})

const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);
</script>
