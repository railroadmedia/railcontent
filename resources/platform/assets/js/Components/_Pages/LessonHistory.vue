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
                collection-type="history"
                :multiple-types="true"
                :show-reset-progress="true"
            />
        </div>
    </div>
</template>
<script setup>
import { onBeforeMount } from "vue";
import { useCollectionStore } from "@stores/collection";
import CollectionWrapper from "@collections/CollectionWrapper/CollectionWrapper";
import PageHeader from "@collections/PageHeader/PageHeader.vue";
import Breadcrumb from "@collections/Breadcrumb/Breadcrumb.vue";

const collectionStore = useCollectionStore();

onBeforeMount(() => {
    collectionStore.setDefaults({
        filter: {
            sort: '-published_on',
            activeTab: 'inProgress'
        },
        fetchType: 'lessonHistory',
        queryType: 'lesson-history'
    });
})
</script>
