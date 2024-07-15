<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 ">
        <Breadcrumb :breadcrumbs="[{ title: 'Lesson History' }]" />
        <PageHeader
            pageType="lesson-history"
            iconName="bookmark"
            title="Lesson History"
        ></PageHeader>
        
        <div class="tw-mt-[30px]">
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
    </div>
</template>
<script setup>
import CollectionWrapper from "../CollectionWrapper/CollectionWrapper";
import PageHeader from "../PageHeader/PageHeader.vue";
import Breadcrumb from "../Breadcrumb/Breadcrumb.vue";

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
