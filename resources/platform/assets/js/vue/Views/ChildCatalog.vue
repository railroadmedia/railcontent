<template>
    <div class="tw-w-full tw-relative">
        <!-- BREADCRUMBS -->
        <Breadcrumb
            :first-level-url="firstLevelUrl" 
            :first-level-title="firstLevelTitle"
            :last-level-title="lastLevelTitle"
        />
        <!-- Child Catalog -->
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[10px] lg:tw-mt-8 dark:tw-text-white">
            <CollectionWrapper
                :title="title"
                :collection-type="collectionType"
                :filterable-values="filterableValues"
                :include-future-scheduled-content-only="includeFutureScheduledContentOnly"
                :included-types="includedTypes"
                :pre-loaded-content="preLoadedContent"
                :statuses="statuses"
                :showBackButton="true"
                :parentUrl="firstLevelUrl"
                :subscription-calendar-id="subscriptionCalendarId" 
            />
        </div>
    </div>
</template>
<script setup>
    import CollectionWrapper from '../components/CollectionWrapper/CollectionWrapper.vue';
    import Breadcrumb from '../components/Breadcrumb/Breadcrumb.vue';

    const props = defineProps({
        firstLevelUrl: String,
        firstLevelTitle: String,
        secondLevelUrl: String,
        secondLevelTitle: String,
        lastLevelTitle: String,
        collectionType: {
            default: '',
        },
        subscriptionCalendarId: {
            type: String,
            default: () => '',
        },
        filterableValues: {
            type: Array,
            default: () => [],
        },
        includeFutureScheduledContentOnly: {
            type: Boolean,
            default: () => false,
        },
        limit: {
            type: String,
            default: () => "10",
        },
        preLoadedContent: {
            type: Object,
            default: () => ({}),
        },
        requiredFields: {
            type: Array,
            default: () => [],
        },
        requiredUserStates: {
            type: Array,
            default: () => [],
        },
        statuses: {
            type: Array,
            default: () => ["published"],
        },
        tabOptions: {
            type: Array,
            default: () => [],
        },
        title: {
            type: String,
            default: () => '',
        },
        parentTitle: {
            type: String,
            default: () => '',
        }
    });
</script>
