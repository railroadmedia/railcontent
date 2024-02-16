<script setup>
import Breadcrumb from '../Breadcrumb/BreadcrumbV2.vue';
import UnifiedHeader from '../Unified/UnifiedHeader.vue';

//Vuesora components
import CollectionWrapper from '../CollectionWrapper/CollectionWrapper.vue';
import SongRequest from "../Songs/SongRequest";

//-----------Props-----------//
const props = defineProps({
    collectionAvatar: {
        type: String,
        default: ""
    },
    contentSubtitle: {
        type: String,
        default: ""
    },
    contentName: {
        type: String,
        default: ""
    },
    contentTitle: {
        type: String,
        default: ""
    },
    goBackUrl: {
        type: String,
        default: "#"
    },
    contentType: {
        type: String,
        default: ""
    },
    pluralContentType: {
        type: String,
        default: ""
    },
    preLoadedContent: {
        type: Object,
        default: () => ({})
    },
    filterableValues: {
        type: Array,
        default: () => ([]),
    },
    requiredFields: {
        type: Array,
        default: () => ([]),
    }
});

</script>
<template>
    <Breadcrumb :breadcrumbs="[{ title: contentName, url: goBackUrl }, { title: contentTitle }]" />
    <UnifiedHeader>
        <template v-slot:left-content>
            <div class="tw-flex">
                <div class="tw-rounded-full tw-w-[115px] tw-h-[115px] tw-border-[2px] tw-border-white" :style="{ backgroundImage: `url(${collectionAvatar})` }"></div>
                <div class="tw-flex tw-flex-col tw-justify-center dark:tw-text-white tw-pl-[20px]">
                    <h3 class="tw-pb-[10px] tw-text-[32px] tw-font-bold">{{ contentTitle }}</h3>
                    <div class="tw-text-[14px] tw-font-bold tw-leading-none">{{ contentSubtitle }}</div>
                </div>
            </div>
        </template>
        <template v-if="contentType === 'song'" v-slot:right-content>
            <SongRequest />
        </template>
    </UnifiedHeader>
    <div class="lg:tw-container lg:tw-px-[50px] tw-mx-auto tw-pt-[30px]">
        <CollectionWrapper
            :pre-loaded-content="preLoadedContent"
            :tab-options="[
                { key: 'allContent', value: `All ${pluralContentType}` },
            ]"
            :filterable-values="filterableValues"
            :required-fields="requiredFields"
            :collection-type="contentType"
        />
    </div>
</template>
