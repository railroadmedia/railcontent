<script setup>
import { computed } from 'vue';
import { storeToRefs } from 'pinia';

import Breadcrumb from '../Breadcrumb/Breadcrumb.vue';
import UnifiedHeader from '../Unified/UnifiedHeader.vue';

//Vuesora components
import CollectionWrapper from '../CollectionWrapper/CollectionWrapper.vue';
import SongRequest from "../Songs/SongRequest";
import { useUserStore } from "../../../stores/user";

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

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const defaultThumbnail = computed(() => {
    return {
        drumeo: "https://www.musora.com/musora-cdn/image/width=200,quality=95/https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/5dc27a49-ce17-4b73-5a35-ac3f19f96f00/public",
        singeo: "https://www.musora.com/musora-cdn/image/width=200,quality=95/https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/1f558634-9b71-4dd8-1a80-12670df39900/public",
        guitareo: "https://www.musora.com/musora-cdn/image/width=200,quality=95/https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/169b1f03-dc93-4b0f-105f-71921cbc2a00/public",
        pianote: "https://www.musora.com/musora-cdn/image/width=200,quality=95/https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/6441483e-102a-4e46-6a7b-eae2bdd46400/public",
    }[brand.value];
});
</script>
<template>
    <Breadcrumb :breadcrumbs="[{ title: contentName, url: goBackUrl }, { title: contentTitle }]" />
    <UnifiedHeader classOverride="tw-mt-[20px]">
        <template v-slot:left-content>
            <div class="tw-flex">
                <div class="tw-rounded-full tw-w-[115px] tw-h-[115px] tw-border-[2px] tw-border-white tw-bg-cover" :style="{ backgroundImage: `url(${defaultThumbnail})` }"></div>
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
