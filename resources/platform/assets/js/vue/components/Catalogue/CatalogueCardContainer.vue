<template>
    <div class="tw-flex tw-flex-col tw-grow tw-justify-center">
        <div :class="`tw-block tw-no-scrollbar ${isMiniView ? 'tw-overflow-x-scroll tw-max-h-[181px] tw-overflow-y-hidden' : 'tw-overflow-x-clip tw-overflow-y-hidden'}`">
            <div
                :class="`
                    tw-px-4 lg:tw-px-0 tw-no-scrollbar
                    ${isMiniView && willScroll ? 'tw-grid tw-auto-rows-min tw-grid-flow-row tw-auto-cols-min lg:tw-auto-cols-auto tw-grid-cols-4 lg:tw-grid-cols-3 xl:tw-grid-cols-4 4xl:tw-grid-cols-5 lg:tw-w-auto tw-gap-y-[25px] tw-gap-x-[8px] tw-overflow-x-auto tw-min-w-max lg:tw-min-w-full' : ''}
                    ${!isMiniView && willScroll ? 'tw-flex lg:tw-overflow-x-clip tw-flex-nowrap' : ''}
                    ${!isMiniView && willScroll && !collectionStoreLoading ? 'tw-overflow-x-scroll' : ''}
                    ${!isMiniView && !willScroll ? 'tw-flex tw-flex-wrap' : ''}
                    ${breakToListView ? 'tw-@container/breakToList' : ''}
                `">
                <!-- Skeleton Loader -->
                <template v-if="showSkeletonLoader">
                    <SkeletonLoader :count="skeletonCardCount" type="card" :force-list-view="displayInline"
                        :break-to-list-view="breakToListView" />
                </template>
                <!-- Catalogue Cards -->
                <template v-else>
                    <CatalogueCard
                        v-for="item in data"
                        :key="'grid' + item.id"
                        :item="item"
                        :content-type="item.type"
                        :brand="brand"
                        :use-theme-color="useThemeColor"
                        :user-id="userId"
                        :is-admin="isAdmin"
                        :lock-unowned="lockUnowned"
                        :force-wide-thumbs="forceWideThumbs"
                        :content-type-override="contentTypeOverride"
                        :is-mini-card="isMiniView"
                        :show-my-list-action="showMyListAction"
                        :force-no-links="forceNoLinks"
                        :force-list-view="displayInline"
                        :break-to-list-view="breakToListView"
                        @addToList="addToList"
                        @progressReset="resetProgressEventHandler"
                        :show-dropdown="showDropdown"
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
    
        <AddEventModal 
            v-if="contentTypeOverride === 'challenge'" 
            modal-id="notifyModal"
            :subscription-calendar-id="subscriptionCalendarId" 
            :theme-color="brand" 
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
import { useUserStore } from "../../../stores/user";
import { useCollectionStore } from "../../../stores/collection";
import SkeletonLoader from '../SkeletonLoader/SkeletonLoader.vue';

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
    useThemeColor: {
        type: Boolean,
        default: () => true,
    },
    userId: {
        type: String,
        default: () => '',
    },
    isAdmin: {
        type: Boolean,
        default: () => false,
    },
    brand: {
        type: String,
        default: () => 'drumeo',
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
    }

},
);
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const collectionStore = useCollectionStore();
const { loading: collectionStoreLoading, tabData, filter } = storeToRefs(collectionStore);

const { addToList, resetProgressEventHandler } = useUserCatalogueEvents({ ...props, content: props.preLoadedContent.data });
const content = ref(props.preLoadedContent ? props.preLoadedContent.data : []);

//Computed Props
const data = computed(() => {
    return Array.isArray(props.preLoadedContent) ? props.preLoadedContent : content.value;
})

const breakToListView = computed( () => {
    return !showGroupBy.value && (isWorkout.value || isChallenge.value);
})

const showSkeletonLoader = computed(() => {
    return collectionStoreLoading.value && (isWorkout.value || isChallenge.value)
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
})

</script>
