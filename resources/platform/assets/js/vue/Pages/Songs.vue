<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <div class="">
            <!-- Header -->
            <Breadcrumb :breadcrumbs="[{ title: 'SONGS' }]" />
            <PageHeader pageType="songs" title="Songs" iconName="headphones" :infoData="headerInfoData" :ctas="ctaConfig" />

            <!-- Continue section -->
            <div v-if="startedContent?.data?.length" class="tw-mt-[33px]">
                <MiniCatalogueSection title="Continue" seeAllAriaLabel="See All Songs In Progress" :seeAllUrl="continueUrl"
                    :preLoadedContent="startedContent.data" :isMiniView="true" :show-dropdown="true" />
            </div>

            <!-- Song Results -->
            <div :class="`dark:tw-text-white songs-catalogue-container ${startedContent?.data?.length ? 'tw-mt-[14px] lg:tw-mt-[6px]' : 'tw-mt-[30px]'}`">
                <transition appear name="fade">
                    <CollectionWrapper :preLoadedContent="listLessons" collectionType="song" :tabs="tabs"
                        :filterableValues="filterableValues" />
                </transition>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { computed } from 'vue';
    import PageHeader from '../components/PageHeader/PageHeader.vue';
    import MiniCatalogueSection from '../components/MiniCatalogueSection/MiniCatalogueSection.vue';
    import CollectionWrapper from "../components/CollectionWrapper/CollectionWrapper.vue";
    import Breadcrumb from '../components/Breadcrumb/Breadcrumb.vue';

    const props = defineProps({
        continueUrl: {
            type: String,
            default: '#'
        },
        allArtistsUrl: {
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
            text: `See all ${props.artistsNumber} artists >`,
            url: props.allArtistsUrl
        }
    })
</script>
