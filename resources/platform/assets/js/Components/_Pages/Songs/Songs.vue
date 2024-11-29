<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <div class="">
            <!-- Header -->
            <Breadcrumb :breadcrumbs="[{ title: 'SONGS' }]" />
            <PageHeader
                pageType="songs"
                title="Songs"
                iconName="headphones"
                :infoData="headerInfoData"
                :ctas="ctaConfig"
                :is-loading="isLoading"
            />

            <!-- Continue section -->
            <div v-if="continueSection.length" class="tw-mt-[33px]">
                <MiniCatalogueSection
                    title="Continue"
                    seeAllAriaLabel="See All Songs In Progress"
                    :seeAllUrl="`/${brand}/lesson-history/in-progress?sort=-published_on&included_fields%5B%5D=type%2CSong&tabs%5B%5D=inProgress&included_user_states%5B%5D=started`"
                    :preLoadedContent="continueSection"
                    :isMiniView="true"
                    :show-dropdown="true"
                    :use-ref-data="true"
                    trackingSection="continue"
                />
            </div>

            <!-- Song Results -->
            <div :class="`dark:tw-text-white songs-catalogue-container ${startedContent?.data?.length ? 'tw-mt-[14px] lg:tw-mt-[6px]' : 'tw-mt-[30px]'}`">
                <transition appear name="fade">
                    <CollectionWrapper collectionType="song" :tab-options="tabData" :infinite-scroll="!membershipUpgradeModal.disableClose" />
                </transition>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, ref } from 'vue';
import { usePlatformStore } from "@stores/platform";
import { storeToRefs } from "pinia";
import { getTabData } from './tabData';
import { useCollectionStore } from "@stores/collection";
import { useUserStore } from "@stores/user";
import { fetchArtists, fetchContentInProgress, fetchByRailContentIds } from 'musora-content-services';

import PageHeader from '@collections/PageHeader/PageHeader.vue';
import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection.vue';
import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper.vue';
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';

const props = defineProps({
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
    showUpgradeModal: {
        type: Boolean,
        default: false
    }
});

const collectionStore = useCollectionStore();
const platformStore = usePlatformStore();
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
const { membershipUpgradeModal } = storeToRefs(platformStore);

const artistCount = ref(0);
const isLoading = ref(false);
const continueSection = ref([]); // Ref for storing started lessons

const ctaConfig = computed(() => {
    return [
        {
            type: 'SongRequest'
        },
    ];
});

const headerInfoData = computed(() => {
    return {
        type: 'Link',
        text: `See all ${artistCount.value} artists`,
        url: `/${brand.value}/artists`
    }
})

const tabData = computed(() => {
    return getTabData();
})

onBeforeMount(async() => {
    isLoading.value = true;
    try {
        const artists = await fetchArtists(brand.value);
        artistCount.value = artists.length;

        // Set default collection store values
        collectionStore.setDefaults({
            tabOptions: tabData.value,
            filter: {
                sort: '-published_on'
            },
            queryType: 'song',
        });

        if (props.showUpgradeModal) {
            platformStore.openMembershipUpgradeModal();
            platformStore.disableCloseMembershipUpgradeModal();
        } else {
            // Fetch started content (in-progress lessons)
            const startedIds = await fetchContentInProgress('song', brand.value);
            const lessons = await fetchByRailContentIds(startedIds.started);
            const startedLessons = lessons.filter(lesson => startedIds.started.includes(lesson.id));

            // Set the continue section with started lessons
            continueSection.value = startedLessons;
        }
    } catch (error) {
        console.error('Error in onBeforeMount:', error);
    } finally {
        isLoading.value = false;
    }
});
</script>
