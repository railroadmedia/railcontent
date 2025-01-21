<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" />

        <PageHeader
            :title="`Coming Soon`"
        />

        <div class="tw-mt-[30px]">
            <CollectionWrapper
                endpoint="/railcontent/content-updates/coming-soon"
                limit="20"
                :pre-loaded-content="comingSoon"
                :hide-controls-section="true"
            />
        </div>
    </div>
</template>
<script setup>
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PageHeader from '@collections/PageHeader/PageHeader.vue';
import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper.vue';

const props = defineProps({
    comingSoon: {
        type: Object,
        default: {},
    },
})

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const breadcrumbs = [
    {
        title: 'Content Updates',
        url: `/${brand.value}/content-updates`
    },
    {
        title: 'Coming Soon',
    }
];
</script>
