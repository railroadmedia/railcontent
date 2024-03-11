<template>
    <div class="tw-flex tw-flex-col tw-grow tw-justify-center">
        <div
            :class="`tw-block tw-no-scrollbar ${isMiniView ? 'tw-overflow-x-scroll tw-max-h-[211px] tw-overflow-y-hidden' : 'tw-overflow-x-clip tw-overflow-y-hidden'}`">
            <div :class="`
                    tw-no-scrollbar
                    ${isMiniView && willScroll ? 'tw-grid tw-auto-rows-min tw-pb-[8px] tw-grid-flow-row tw-auto-cols-min lg:tw-auto-cols-auto tw-grid-cols-4 lg:tw-grid-cols-2 xl:tw-grid-cols-3 2xl:tw-grid-cols-4 4xl:tw-grid-cols-5 lg:tw-w-auto tw-gap-[5px] tw-overflow-x-auto tw-min-w-max lg:tw-min-w-full' : ''}
                    ${!isMiniView && willScroll ? 'tw-flex lg:tw-overflow-x-clip tw-flex-nowrap ' : ''}
                    ${!isMiniView && willScroll && !collectionStoreLoading ? 'tw-overflow-x-scroll' : ''}
                    ${!isMiniView && !willScroll ? 'tw-flex tw-flex-wrap' : ''}
                    ${!isMiniView ? 'lg:tw-grid lg:tw-grid-cols-4 2xl:tw-grid-cols-5 lg:tw-gap-3 2xl:tw-gap-4' : ''}
                `">
                <!-- Skeleton Loader -->
                <template v-if="showSkeletonLoader">
                    <SkeletonLoader :count="skeletonCardCount" type="card" :force-list-view="displayInline"
                        :break-to-list-view="breakToListView" :is-single-row="isSingleRow" />
                </template>
                <!-- Catalogue Cards -->
                <template v-else-if="isMiniView">
                    <MiniCatalogueCard v-for="item in getData" :key="'grid' + item.id" :item="item" :content-type="item.type"
                        :user-id="userId" :is-admin="isAdmin" :lock-unowned="lockUnowned"
                        :force-wide-thumbs="forceWideThumbs" :content-type-override="contentTypeOverride"
                        :show-my-list-action="showMyListAction" :force-no-links="forceNoLinks" @addToList="addToList"
                        @progressReset="handleProgressReset" :show-dropdown="showDropdown" />
                </template>
                <template v-else>
                    <CatalogueCard v-for="item in getData" :key="'grid' + item.id" :item="item" :content-type="item.type"
                        :user-id="userId" :is-admin="isAdmin" :lock-unowned="lockUnowned"
                        :force-wide-thumbs="forceWideThumbs" :content-type-override="contentTypeOverride"
                        :show-my-list-action="showMyListAction" :force-no-links="forceNoLinks"
                        :force-list-view="displayInline" :break-to-list-view="breakToListView" :is-single-row="isSingleRow" @addToList="addToList"
                        @progressReset="handleProgressReset" :show-dropdown="showDropdown" />
                </template>
            </div>
        </div>
        <div v-if="!collectionStoreLoading && getData.length === 0 && noResultsMessage.length > 0"
            class="tw-flex tw-flex-row tw-py-4 tw-justify-center tw-items-center tw-px-4 lg:tw-px-0">
            <div class="tw-flex tw-flex-column icon-col face-icon tw-mr-1">
                <div class="icon-wrap square"></div>
            </div>
            <div class="tw-flex tw-flex-column">
                <h4 class="body tw-text-[#00101D] dark:tw-text-white">{{ noResultsMessage }}</h4>
            </div>
        </div>
        <AddEventModal
            v-if="contentTypeOverride === 'challenge'"
            modal-id="notifyModal"
            :subscription-calendar-id="subscriptionCalendarId"
            :brand="brand"
        />
    </div>
</template>
<script setup>
// TODO: Find a way to re add the smily face or change the icon
import { computed, ref } from 'vue'
// In order for the horizontal scroll to work, you need to make parent container a block.
import CatalogueCard from '../Catalogue/CatalogueCard.vue';
import AddEventModal from '../../vuesora/components/AddEvent/AddEventModal.vue';
import useUserCatalogueEvents from '../../hooks/useUserCatalogueEvents';
import { storeToRefs } from "pinia";
import { useCollectionStore } from "../../../stores/collection";
import SkeletonLoader from '../SkeletonLoader/SkeletonLoader.vue';
import MiniCatalogueCard from './MiniCatalogueCard.vue';
import { useResetProgress } from "../../hooks/useResetProgress";
import { useUserStore } from "../../../stores/user";

const props = defineProps({
    willScroll: {
        type: Boolean,
        default: () => true,
    },
    isMiniView: {
        type: Boolean,
        default: () => false,
    },
    forceNoLinks: {
        type: Boolean,
        default: () => false,
    },
    subscriptionCalendarId: {
        type: String,
        default: () => '',
    },
    preLoadedContent: {
        type: [Array, Object],
        default: () => [],
    },
    userId: {
        type: String,
        default: () => '',
    },
    isAdmin: {
        type: Boolean,
        default: () => false,
    },
    noWrap: {
        type: Boolean,
        default: () => false,
    },
    forceWideThumbs: {
        type: Boolean,
        default: () => false,
    },
    contentTypeOverride: {
        type: String,
        default: () => '',
    },
    lockUnowned: {
        type: Boolean,
        default: () => false,
    },
    displayInline: {
        type: Boolean,
        default: () => false,
    },
    showMyListAction: {
        type: Boolean,
        default: () => true,
    },
    showDropdown: {
        type: Boolean,
        default: () => false,
    },
    noResultsMessage: {
        type: String,
        default: 'No lessons found',
    },
    groupByCards: {
        type: Boolean,
        default: () => false,
    },
    useRefData: {
        type: Boolean,
        default: () => false,
    },
    isSingleRow: {
		type: Boolean,
        default: () => false,
    },
    noSkeleton: {
        type: Boolean,
        default: () => false,
    },
});

const collectionStore = useCollectionStore();
const userStore = useUserStore();
const { resetProgress } = useResetProgress();
const { brand } = storeToRefs(userStore);
const resetIcon = ref('fas fa-redo-alt fa-flip-horizontal');
const data = ref(props.preLoadedContent);

const { loading: collectionStoreLoading, tabData, filter } = storeToRefs(collectionStore);

const getData = computed(() =>{
    return props.useRefData ? data.value : props.preLoadedContent;
})

const breakToListView = computed(() => {
    return !showGroupBy.value && (isWorkout.value || isChallenge.value);
})

const showSkeletonLoader = computed(() => {
    return !props.noSkeleton && collectionStoreLoading.value;
})

const skeletonCardCount = computed(() => {
    return showGroupBy.value ? 5 : 12;
})

const showGroupBy = computed(() => {
    return tabData.value[filter.value.activeTab]?.groupByView;
})

const isWorkout = computed(() => {
    return props.contentTypeOverride === 'workout';
})

const isChallenge = computed(() => {
    return props.contentTypeOverride === 'challenge';
});

const { addToList } = useUserCatalogueEvents({ ...props });

const handleProgressReset = (payload) => {
    resetProgress(payload.content_id, resetIcon, true, data);
}
</script>
