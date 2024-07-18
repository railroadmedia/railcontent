<template>
    <div class="tw-w-full tw-relative">
        <!-- BREADCRUMBS -->
        <Breadcrumb
            :breadcrumbs="[{ title: firstLevelTitle, url: firstLevelUrl }, { title: lastLevelTitle }]"
            classOverride="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 lg:tw-px-8"
        />
        <!-- Child Catalog -->
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 lg:tw-px-8 tw-pt-6 dark:tw-text-white">
            <CollectionWrapper
                :title="title"
                :collection-type="collectionType"
                :filterable-values="filterableValues"
                :include-future-scheduled-content-only="includeFutureScheduledContentOnly"
                :included-types="includedTypes"
                :pre-loaded-content="preLoadedContent"
                :statuses="statuses"
                :parentUrl="firstLevelUrl"
                :subscription-calendar-id="subscriptionCalendarId" 
            />
        </div>
    </div>
</template>
<script setup>
    import CollectionWrapper from '../CollectionWrapper/CollectionWrapper.vue';
    import Breadcrumb from '../Breadcrumb/Breadcrumb.vue';

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
        includedTypes: {
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
