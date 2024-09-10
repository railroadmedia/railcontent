<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <div class="">
            <!-- Header -->
            <Breadcrumb :breadcrumbs="[{ title: 'SONGS' }]" />
            <PageHeader pageType="songs" title="Songs" iconName="headphones" :infoData="headerInfoData" :ctas="ctaConfig" />

            <!-- Continue section -->
            <div v-if="startedContent?.data?.length" class="tw-mt-[33px]">
                <MiniCatalogueSection title="Continue" seeAllAriaLabel="See All Songs In Progress" :seeAllUrl="`/${brand}/lesson-history/in-progress`"
                    :preLoadedContent="startedContent.data" :isMiniView="true" :show-dropdown="true" />
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
import { fetchSongArtistCount, fetchSongCount } from 'musora-content-services';

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
    if(props.showUpgradeModal){
        props.showUpgradeModal && platformStore.openMembershipUpgradeModal();
        props.showUpgradeModal && platformStore.disableCloseMembershipUpgradeModal();
    } else {
        const artists = await fetchSongArtistCount(brand.value);
        artistCount.value = artists;

        collectionStore.setDefaults({
            tabOptions: tabData.value,
            filter: {
                sort: '-published_on'
            },
            queryType: 'song',
        });
    }
})
</script>
