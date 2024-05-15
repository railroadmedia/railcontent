<template>
    <PageHeader
        pageType="lesson-history"
        iconName="bookmark"
        title="Lesson History"
    ></PageHeader>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[30px]">
        <CollectionWrapper
            :collection-type="collectionType"
            :hide-controls="false"
            :hide-search="hideSearch"
            :hide-sort-icon="hideSortIcon"
            :included-types="includedTypes"
            :multiple-types="true"
            :pre-loaded-content="preLoadedContent"
            :show-reset-progress="showResetProgress"
            :tab-options="tabOptions"
        />
    </div>
</template>
<script setup>
import CollectionWrapper from "../components/CollectionWrapper/CollectionWrapper";
import PageHeader from "../components/PageHeader/PageHeader.vue";

const props = defineProps({
    collectionType: {
        type: String,
        default: () => '',
    },
    hideSearch: {
        type: Boolean,
        default: false,
    },
    hideSortIcon: {
        type: Boolean,
        default: false,
    },
    includedTypes: {
        type: Array,
        default: () => [],
    },
    preLoadedContent: {
        type: Object,
        default: () => {},
    },
    showResetProgress: {
        type: Boolean,
        default: false,
    },
    tabOptions: {
        type: Array,
        default: () => [],
    },

})
</script>
