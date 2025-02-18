<template>
    <div class="tw-flex tw-no-scrollbar tw-overflow-x-scroll -tw-mr-1 lg:-tw-mr-[15px]" :class="`${rowStyles} ${sectionTitle}-container`">
        <SkeletonChallengeCard v-if="isLoading || loading" v-for="i in skeletonNum" :key="`skeleton-challenge-card-${i}`" :is-grouped-view="isGroupedView" />
        <template v-else v-for="(item, i) in content">
            <div v-if="isGroupedView && item.type === 'fill'" class="lg:tw-w-1/4 xl:tw-w-1/5 3xl:tw-w-1/6 tw-shrink-0"></div>
            <ChallengeCard v-else :item="item" :key="`challenge-card-${i}`" :is-grouped-view="isGroupedView" />
        </template>

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
    sectionTitle: {
        type: String,
        default: () => '',
    },
});

const rowStyles = computed(() => {
    if(props.isGroupedView) {
        return 'tw-flex-nowrap';
    } else {
        return 'tw-flex-wrap';
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
