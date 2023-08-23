<template>
    <div class="tw-flex tw-flex-col tw-grow tw-justify-center">
        <div class="tw-block tw-no-scrollbar tw-overflow-x-clip">
            <div
                class="tw-flex tw-flex-nowrap tw-px-4 lg:tw-px-0 tw-no-scrollbar lg:tw-overflow-x-clip">
                <catalogue-card v-for="item in content" :key="'grid' + item.id" :item="item" :content-type="item.type"
                    :brand="brand" :theme-color="themeColor" :use-theme-color="useThemeColor" :user-id="userId"
                    :is-admin="isAdmin" :lock-unowned="lockUnowned" :force-wide-thumbs="forceWideThumbs"
                    :content-type-override="contentTypeOverride" :six-wide="sixWide" :five-wide="fiveWide"
                    :show-my-list-action="showMyListAction" :display-inline="displayInline" @addToList="addToList" :show-dropdown="showDropdown" />
            </div>
        </div>
        <div v-if="content.length === 0 && noResultsMessage.length > 0" class="tw-flex tw-flex-row tw-py-4 tw-justify-center tw-items-center tw-px-4 lg:tw-px-0">
            <div class="flex flex-column icon-col face-icon mr-1">
                <div class="icon-wrap square" :class="noResultsIcon"></div>
            </div>
            <div class="flex flex-column">
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

const props = defineProps({
    preLoadedContent: {
        type: Array,
        default: () => [],
    },
    themeColor: {
        type: String,
        default: () => 'drumeo',
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
    }
},
);

const { addToList } = useUserCatalogueEvents(props);
const content = ref(props.preLoadedContent ? props.preLoadedContent.data : []);
</script>
