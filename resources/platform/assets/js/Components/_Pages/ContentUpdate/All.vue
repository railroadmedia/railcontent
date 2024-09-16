<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs />

        <PageHeader
            :title="`Content Updates, New, Returning & Leaving - ${month}`"
        />

        <div class="tw-mt-[30px]">
            <MiniCatalogueSection
                v-if="comingSoon?.data?.length"
                title="Coming Soon"
                seeAllAriaLabel="See All Coming Soon"
                :seeAllUrl="`/${brand}/content-updates/coming-soon`"
                :preLoadedContent="comingSoon?.data"
            />

            <MiniCatalogueSection
                v-if="returning?.data?.length"
                title="Returning"
                seeAllAriaLabel="See All Returning"
                :seeAllUrl="`/${brand}/content-updates/returning`"
                :preLoadedContent="returning?.data"
            />

            <MiniCatalogueSection
                v-if="leaving?.data?.length"
                title="Leaving"
                seeAllAriaLabel="See All Leaving"
                :seeAllUrl="`/${brand}/content-updates/leaving`"
                :preLoadedContent="leaving?.data"
            />
        </div>
    </div>
</template>
<script setup>
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PageHeader from '@collections/PageHeader/PageHeader.vue';
import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection.vue';

const props = defineProps({
    returning: {
        type: Object,
        default: {},
    },
    leaving: {
        type: Object,
        default: {},
    },
    comingSoon: {
        type: Object,
        default: {},
    },
    month: {
        type: String,
        default: '',
    },
})

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const breadcrumbs = [
    {
        title: 'Content Updates',
    },
];
</script>
