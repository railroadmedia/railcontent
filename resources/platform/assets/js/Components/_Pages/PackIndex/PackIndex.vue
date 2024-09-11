<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" />

        <PageHeader
            page-type="packs"
            title="Packs"
            icon-name="box"
            :description="headerDescription"
        />

        <div class="tw-mt-[30px]">
            <CollectionWrapper
                collection-type="pack"
                title="Packs"
                :hide-filter-icon="true"
                :sort-options="sortOptions"
            />
        </div>
    </div>
</template>
<script setup>
import { computed, onBeforeMount } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import { useCollectionStore } from "@stores/collection";
import { breadcrumbs, descriptions, sortOptions, tabData } from './pageData';

import PageHeader from "@collections/PageHeader/PageHeader";
import Breadcrumb from "@collections/Breadcrumb/Breadcrumb.vue";
import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper';

const collectionStore = useCollectionStore();
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const headerDescription = computed(() => {
    return descriptions[brand.value];
})

onBeforeMount(() => {
    collectionStore.setDefaults({
        tabOptions: tabData,
        filter: {
            sort: '-published_on'
        },
        queryType: 'pack',
    });
})
</script>

