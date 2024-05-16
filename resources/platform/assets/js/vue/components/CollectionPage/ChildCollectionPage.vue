<script setup>
import { computed } from 'vue';
import { storeToRefs } from 'pinia';

import Breadcrumb from '../Breadcrumb/Breadcrumb.vue';

//Vuesora components
import CollectionWrapper from '../CollectionWrapper/CollectionWrapper.vue';
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
    },
    includedTypes: {
        type: Array,
        default: () => [],
    },
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

const ctaConfig = computed(() => {
    if (props.contentType === 'song') {
        return [
            {
                type: 'SongRequest'
            },
        ];
    }
});

const infoData = computed(() => {
    const regex = /(\d+\s\w+\-?\w+\-?\w+)/g;
    const items = props.contentSubtitle.match(regex);
    return items
})

const heroImg = computed(() => {
    return props.collectionAvatar ?? defaultThumbnail;
});

const capitalizeFirstLetter = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
</script>
<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="[{ title: contentName, url: goBackUrl }, { title: contentTitle }]" />
        <PageHeader :pageType="contentType" :title="contentTitle" :heroImg="heroImg"
            :infoData="infoData" :ctas="ctaConfig" />
        <div class="tw-pt-[30px]">
            <CollectionWrapper :pre-loaded-content="preLoadedContent" :tab-options="[
                { key: 'allContent', value: `All ${capitalizeFirstLetter(pluralContentType)}` },
            ]" :filterable-values="filterableValues" :required-fields="requiredFields" :collection-type="contentType"  :included-types="includedTypes" :multiple-types="true" />
        </div>
    </div>
</template>
