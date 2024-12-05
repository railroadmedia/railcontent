<template>
    <div class="lg:tw-grid-cols-4 2xl:tw-grid-cols-6 tw-gap-1 lg:tw-gap-[15px]" :class="rowStyles">
        <SkeletonChallengeCard v-if="isLoading || loading" v-for="i in skeletonNum" :key="`skeleton-challenge-card-${i}`" :is-grouped-view="isGroupedView" />
        <ChallengeCard v-else v-for="(item, i) in content" :item="item" :key="`challenge-card-${i}`" :is-grouped-view="isGroupedView" />
    </div>
</template>
<script setup>
import { computed } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { usePlatformStore } from "@stores/platform";
import { useCollectionStore } from "@stores/collection";
import ChallengeCard from '@collections/Catalogue/ChallengeCard';
import SkeletonChallengeCard from '@collections/SkeletonLoader/SkeletonChallengeCard';

const props = defineProps({
    isGroupedView: {
        type: Boolean,
        default: () => false,
    },
    content: {
        type: Array,
        default: () => [],
    },
});

const rowStyles = computed(() => {
    if(props.isGroupedView) {
        return 'tw-flex tw-flex-no-wrap tw-overflow-x-scroll lg:tw-overflow-x-clip lg:tw-grid';
    } else {
        return 'tw-grid tw-grid-cols-2 sm:tw-grid-cols-3'
    }
})

const skeletonNum = computed(() => {
    return props.isGroupedView ? 4 : 12;
})

const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);
const collectionStore = useCollectionStore();
const { loading } = storeToRefs(collectionStore);
</script>
