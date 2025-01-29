<template>
    <div class="tw-flex tw-flex-col tw-grow tw-justify-center">
        <div :class="`tw-block tw-no-scrollbar ${isGroupedView ? ' tw-overflow-y-hidden' : 'tw-overflow-x-clip tw-overflow-y-hidden'}`">
            <div
                :class="`
                    ${sectionTitle}-container
                    tw-no-scrollbar tw-flex
                    ${isGroupedView ? 'tw-flex-row tw-flex-nowrap tw-overflow-x-scroll lg:-tw-mr-3' : 'tw-flex-wrap sm:tw-grid sm:tw-grid-cols-4 lg:tw-grid-cols-5 2xl:tw-grid-cols-7 sm:tw-gap-3'}
                `">
                <!-- Skeleton Loader -->
                <template v-if="showSkeletonLoader">
                    <SkeletonLoader :is-grouped-view="isGroupedView" :count="skeletonCardCount" type="songCard" />
                </template>
                <!-- Catalogue Cards -->
                <template v-else>
                    <template  v-for="item in data">
                        <div v-if="item.type === 'fill'" class="tw-w-[145px] sm:tw-w-[170px] lg:tw-pr-3 lg:tw-w-1/5 2xl:tw-w-[calc(14.2857%)]"></div>
                        <SongCard
                            v-else
                            :key="'grid' + item.id"
                            :item="item"
                            :isGroupedView="isGroupedView"
                            :add-margin-bottom="addMarginBottom"
                            @addToList="addToList"
                            @progressReset="resetProgressEventHandler"
                        />
                    </template>

                </template>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, ref } from 'vue';
import { storeToRefs } from "pinia";
import { useCollectionStore } from "@stores/collection";
import { usePlatformStore } from "@stores/platform";
import useUserCatalogueEvents from '@hooks/useUserCatalogueEvents';

import SongCard from '../Catalogue/SongCard.vue';
import SkeletonLoader from '@collections/SkeletonLoader/SkeletonLoader.vue';

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
    addMarginBottom: {
        type: Boolean,
        default: () => true,
    },
    sectionTitle: {
        type: String,
        default: '',
    },
});

const collectionStore = useCollectionStore();
const platformStore = usePlatformStore();

const { isLoading: platformStoreLoading } = storeToRefs(platformStore);
const { loading: collectionStoreLoading, tabData, filter } = storeToRefs(collectionStore);

const { addToList, resetProgressEventHandler } = useUserCatalogueEvents({ ...props, content: props.preLoadedContent.data });
const content = ref(props.preLoadedContent ? props.preLoadedContent.data : []);

//Computed Props
const data = computed(() => {
    return Array.isArray(props.preLoadedContent) ? props.preLoadedContent : content.value;
})

const showSkeletonLoader = computed(() => {
    return collectionStoreLoading.value || platformStoreLoading.value;
})

const skeletonCardCount = computed(() => {
    return showGroupBy.value ? 5 : 12;
})

const showGroupBy = computed(() => {
    return tabData.value[filter.value.activeTab]?.groupByView;
})

</script>
