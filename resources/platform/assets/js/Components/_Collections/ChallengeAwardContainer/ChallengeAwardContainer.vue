<template>
    <div class="tw-flex tw-flex-nowrap tw-no-scrollbar tw-overflow-x-scroll" :class="`${sectionTitle}-container`">
        <SkeletonChallengeAwardCard v-if="isLoading" v-for="n in 4" :key="n" />
        <template v-else v-for="award in preLoadedContent">
            <div v-if="award.type === 'fill'" class="tw-shrink-0 tw-w-[150px] lg:tw-w-1/4 xl:tw-w-1/6"></div>
            <ChallengeAwardCard v-else :award="award" />
        </template>

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
    sectionTitle: {
        type: String,
        default: '',
    },
})

const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);
</script>
