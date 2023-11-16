<template>
    <div class="tw-flex tw-flex-col tw-grow tw-justify-center">
        <div :class="`tw-block tw-no-scrollbar ${isMiniView ? 'tw-overflow-x-scroll tw-max-h-[181px] tw-overflow-y-hidden' : 'tw-overflow-x-clip'}`">
            <div
                :class="`
                    tw-px-4 lg:tw-px-0 tw-no-scrollbar
                    ${isMiniView ? 'tw-grid tw-auto-rows-min tw-grid-flow-row tw-auto-cols-min lg:tw-auto-cols-auto tw-grid-cols-4 lg:tw-grid-cols-3 xl:tw-grid-cols-4 4xl:tw-grid-cols-5 lg:tw-w-auto tw-gap-y-[25px] tw-gap-x-[8px] tw-overflow-x-auto tw-min-w-max lg:tw-min-w-full' : 'tw-flex tw-overflow-x-scroll lg:tw-overflow-x-clip tw-flex-nowrap'}
                    ${extraPaddingBottom ? ' tw-pb-5' : ''}
                `
                "
                >
                <CatalogueCard
                    v-for="item in content"
                    :key="'grid' + item.id"
                    :item="item"
                    :content-type="item.type"
                    :brand="brand"
                    :theme-color="brand"
                    :use-theme-color="useThemeColor"
                    :user-id="userId"
                    :is-admin="isAdmin"
                    :lock-unowned="lockUnowned"
                    :force-wide-thumbs="forceWideThumbs"
                    :content-type-override="contentTypeOverride"
                    :is-mini-card="isMiniView"
                    :show-my-list-action="showMyListAction"
                    :display-inline="displayInline"
                    @addToList="addToList"
                    @progressReset="resetProgressEventHandler"
                    :show-dropdown="showDropdown"
                />
            </div>
        </div>
        <div v-if="content.length === 0 && noResultsMessage.length > 0" class="tw-flex tw-flex-row tw-py-4 tw-justify-center tw-items-center tw-px-4 lg:tw-px-0">
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
// TODO: Find a way to re add the smily face or change the icon
import { ref } from 'vue'
// In order for the horizontal scroll to work, you need to make parent container a block.
import CatalogueCard from '../Catalogue/CatalogueCard.vue';
import useUserCatalogueEvents from '../../hooks/useUserCatalogueEvents';
import {storeToRefs} from "pinia";
import { useUserStore} from "../../../stores/user";

const props = defineProps({
    isMiniView: {
        type: Boolean,
        default: () => false,
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
    extraPaddingBottom: {
        type: Boolean,
        default: () => false,
    },
},
);

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const { addToList, resetProgressEventHandler } = useUserCatalogueEvents({ ...props, content: props.preLoadedContent.data });
const content = ref(props.preLoadedContent ? props.preLoadedContent.data : []);
</script>
