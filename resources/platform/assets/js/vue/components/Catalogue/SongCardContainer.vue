<template>
    <div class="tw-flex tw-flex-col tw-grow tw-justify-center">
        <div :class="`tw-block tw-no-scrollbar ${isGroupedView ? 'tw-overflow-x-scroll tw-overflow-y-hidden' : 'tw-overflow-x-clip tw-overflow-y-hidden'}`">
            <div
                :class="`
                    tw-no-scrollbar
                    ${!isGroupedView ? 'tw-flex tw-flex-wrap' : 'tw-flex tw-flex-row tw-flex-nowrap tw-w-auto'}
                `">
                <!-- Skeleton Loader -->
                <template v-if="showSkeletonLoader">
                    <SkeletonLoader :count="skeletonCardCount" type="songCard" />
                </template>
                <!-- Catalogue Cards -->
                <template v-else>
                    <SongCard
                        v-for="item in data"
                        :key="'grid' + item.id"
                        :item="item"
                        :isGroupedView="isGroupedView"
                        @addToList="addToList"
                        @progressReset="resetProgressEventHandler"
                    />
                </template>
            </div>
        </div>
        <div v-if="!collectionStoreLoading && data.length === 0 && noResultsMessage.length > 0" class="tw-flex tw-flex-row tw-py-4 tw-justify-center tw-items-center tw-px-4 lg:tw-px-0">
            <div class="tw-flex tw-flex-column icon-col face-icon tw-mr-1">
                <div class="icon-wrap square"></div>
            </div>
            <div class="tw-flex tw-flex-column">
                <h4 class="body tw-text-[#00101D] dark:tw-text-white">{{ noResultsMessage }}</h4>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, ref } from 'vue'
// In order for the horizontal scroll to work, you need to make parent container a block.
import SongCard from '../Catalogue/SongCard.vue';
import useUserCatalogueEvents from '../../hooks/useUserCatalogueEvents';
import { storeToRefs } from "pinia";
import { useCollectionStore } from "../../../stores/collection";
import SkeletonLoader from '../SkeletonLoader/SkeletonLoader.vue';

const props = defineProps({
    isGroupedView: {
        type: Boolean,
        default: () => false,
    },
    preLoadedContent: {
        type: [Array, Object],
        default: () => [],
    },
    noResultsMessage: {
        type: String,
        default: 'No lessons found',
    },
});

const collectionStore = useCollectionStore();
const { loading: collectionStoreLoading, tabData, filter } = storeToRefs(collectionStore);

const { addToList, resetProgressEventHandler } = useUserCatalogueEvents({ ...props, content: props.preLoadedContent.data });
const content = ref(props.preLoadedContent ? props.preLoadedContent.data : []);

//Computed Props
const data = computed(() => {
    return Array.isArray(props.preLoadedContent) ? props.preLoadedContent : content.value;
})

const showSkeletonLoader = computed(() => {
    return collectionStoreLoading.value;
})

const skeletonCardCount = computed(() => {
    return showGroupBy.value ? 5 : 12;
})

const showGroupBy = computed(() => {
    return tabData.value[filter.value.activeTab]?.groupByView;
})

</script>
