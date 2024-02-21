<template>
    <!-- Header -->
    <PageHeader pageType="songs" title="Songs" iconName="headphones" :infoData="headerInfoData" />
    <!-- Continue section -->
    <div v-if="startedContent?.data?.length" class="tw-container tw-mx-auto tw-px-0 md:tw-px-8 tw-mt-[33px]">
        <MiniCatalogueSection title="Continue" seeAllAriaLabel="See All Songs In Progress" :seeAllUrl="continueUrl"
            :preLoadedContent="startedContent.data" :isMiniView="true" :show-dropdown="true" />
    </div>

    <!-- Song Results -->
    <div
        :class="`tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white songs-catalogue-container ${startedContent?.data?.length ? 'tw-mt-[14px] lg:tw-mt-[6px]' : 'tw-mt-[30px]'}`">
        <transition appear name="fade">
            <CollectionWrapper :preLoadedContent="listLessons" collectionType="song" :tabs="tabs"
                :filterableValues="filterableValues" />
        </transition>
    </div>
</template>

<script setup>
import { defineProps, computed } from 'vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from "../../stores/user";

import PageHeader from '../components/PageHeader/PageHeader.vue';
import MiniCatalogueSection from '../components/MiniCatalogueSection/MiniCatalogueSection.vue';
import CollectionWrapper from "../components/CollectionWrapper/CollectionWrapper.vue";

const props = defineProps({
    continueUrl: {
        type: String,
        default: '#'
    },
    artistsNumber: {
        type: Number,
        default: 0
    },
    songsNumber: {
        type: Number,
        default: 0
    },
    startedContent: {
        type: [Object, String],
        default: () => ({
            data: []
        })
    },
    listLessons: {
        type: Object,
        default: () => ({
            data: []
        })
    },
    filterableValues: {
        type: Array,
        default: () => ([]),
    },
    tabs: {
        type: Array,
        default: () => ([]),
    }
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const headerInfoData = computed(() => {
    return {
        artistsNumber: props.artistsNumber.value,
        songsNumber: props.songsNumber.value,
    }
})


</script>
