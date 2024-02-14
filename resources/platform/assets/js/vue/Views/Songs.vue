<template>
    <!-- Header -->
    <UnifiedHeader :brand="brand" header-background="https://i.ibb.co/PQVRRZP/songs-bg-1.png">
        <template v-slot:left-content>
            <div class="tw-flex tw-flex-col tw-pr-4 tw-h-full tw-justify-end">
                <h1 class="tw-text-white tw-flex tw-items-center">
                    <musora-icon icon-name="headphones-filled" :class="`tw-w-[36px] tw-mr-2 tw-text-${brand}`">
                    </musora-icon>
                    <span class="tw-text-[28px] lg:tw-text-32 tw-font-bold">Songs</span>
                </h1>
                <p
                    class="tw-text-white tw-text-sm lg:tw-text-base tw-max-w-4xl tw-pr-12 tw-uppercase tw-font-open-sans tw-font-semibold">
                    {{ artistsNumber }} ARTISTS | {{ songsNumber }} SONGS
                </p>
            </div>
        </template>
        <template v-slot:right-content>
            <SongRequest :brand="brand" />
        </template>
    </UnifiedHeader>

    <!-- Continue section -->
    <div v-if="startedContent?.data?.length" class="tw-container tw-mx-auto tw-px-0 md:tw-px-8 tw-mt-[33px]">
        <MiniCatalogueSection title="Continue" seeAllAriaLabel="See All Songs In Progress"
        :seeAllUrl="continueUrl" :preLoadedContent="startedContent.data" :isMiniView="true" :show-dropdown="true" />
    </div>

    <!-- Song Results -->
    <div :class="`tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white songs-catalogue-container ${startedContent?.data?.length ? 'tw-mt-[14px] lg:tw-mt-[6px]' : 'tw-mt-[30px]'}`">
        <transition appear name="fade">
            <CollectionWrapper
                :preLoadedContent="listLessons"
                collectionType="song"
                :tabs="tabs"
                :filterableValues="filterableValues"
            />
        </transition>
    </div>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useUserStore } from "../../stores/user";

import UnifiedHeader from '../components/Unified/UnifiedHeader';
import MiniCatalogueSection from '../components/MiniCatalogueSection/MiniCatalogueSection.vue';
import SongRequest from "../components/Songs/SongRequest.vue";
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

</script>
