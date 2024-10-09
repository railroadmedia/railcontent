<template>
    <div className="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs"/>
        <PageHeader
            title="Challenges"
            icon-name="whistle"
            description="Challenges are a collection of Workout-style videos that build your skills one step at a time. They help you develop broader musical skills at a manageable pace — usually over a few days."
        />

        <div className="tw-mt-[30px]">
            <CollectionWrapper
                collection-type="challenge"
                :hide-filter-icon="true"
                :hide-search="true"
                :tab-options="tabData"
            />
        </div>
    </div>
</template>
<script setup>
import { computed, onBeforeMount } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import { usePlatformStore } from "@stores/platform";
import { useCollectionStore } from "@stores/collection";

import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PageHeader from '@collections/PageHeader/PageHeader.vue';
import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper.vue';

const collectionStore = useCollectionStore();
const userStore = useUserStore();
const platformStore = usePlatformStore();
const { brand } = storeToRefs(userStore);

const breadcrumbs = [{title: 'Challenges'}];

const tabData = computed(() => {
    if (brand.value === 'drumeo' || brand.value === 'pianote') {
        return [
            {
                value: 'All',
                groupByView: false,
                key: '',
            },
            {
                value: 'Skill Level',
                groupByView: true,
                key: [''],
            },
            {
                value: 'Genres',
                groupByView: true,
                key: ['genre'],
            },
            {
                value: 'Completed',
                groupByView: false,
                key: [''],
            },
            {
                value: 'Owned Challenges',
                groupByView: false,
                key: [''],
            },
        ]
    } else {
        return [
            {
                value: 'Completed',
                groupByView: false,
                key: [''],
            },
            {
                value: 'Owned Challenges',
                groupByView: false,
                key: [''],
            },
        ]
    }
})

onBeforeMount(() => {
    collectionStore.setDefaults({
        tabOptions: tabData.value,
        queryType: 'challenge',
    });
})
</script>
