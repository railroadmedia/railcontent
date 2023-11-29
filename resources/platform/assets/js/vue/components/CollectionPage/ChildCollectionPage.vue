<script setup>
//Libraries
import { onBeforeMount, inject, computed } from 'vue';

//Services
import ContentAPI from "../../../vue/vuesora/assets/js/services/content";

//Components
import { ArrowLeftIcon } from '@heroicons/vue/solid';
import Breadcrumb from '../Breadcrumb/Breadcrumb.vue';
import UnifiedHeader from '../Unified/UnifiedHeader.vue';

//Vuesora components
import CollectionWrapper from '../CollectionWrapper/CollectionWrapper.vue';

//Inject
const token = inject('csrf_token');

//-----------Props-----------//
const props = defineProps({
    brand: {
        type: String,
        default: "drumeo"
    },
    headerBackground: {
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

onBeforeMount(() => {
    //console.log(props.goBackUrl);
});

</script>
<template>
    <Breadcrumb :brand="brand" :first-level-url="goBackUrl" :first-level-title="contentName"
        :last-level-title="contentTitle" />
    <UnifiedHeader :brand="brand" :header-background="headerBackground">
        <template v-slot:left-content>
            <div class="tw-bg-[#00101D] tw-rounded-full tw-h-[28px] tw-w-[28px]">
                <a class="tw-w-full tw-h-full tw-flex tw-items-center tw-justify-center" :href="goBackUrl">
                    <ArrowLeftIcon class="tw-w-[14px] tw-h-[14px] tw-text-white" />
                </a>
            </div>
            <div class="tw-flex tw-flex-col tw-text-white">
                <h3 class="tw-pb-[10px] tw-text-[32px] tw-font-bold">{{ contentTitle }}</h3>
                <div class="tw-text-[14px] tw-font-bold tw-leading-none">{{ contentSubtitle }}</div>
            </div>
        </template>
        <template v-if="contentType === 'song'" v-slot:right-content>
            <song-request brand="{{ brand }}"></song-request>
        </template>
    </UnifiedHeader>
    <div class="lg:tw-container lg:tw-px-[50px] tw-mx-auto tw-pt-[30px]">
        <CollectionWrapper
            :use-theme-color="true"
            :lock-unowned="true"
            :pre-loaded-content="preLoadedContent"
            :tab-options="[
                { key: 'allContent', value: `All ${contentType}` },
            ]"
            :initial-tab-data="{
                allContent: {
                    searchTerm: '',
                    sort: 'slug'
                },
            }"
            :filterable-values="filterableValues"
            :required-fields="requiredFields"
            :collection-type="contentType"
            :brand="brand"
            >
        </CollectionWrapper>
    </div>
</template>
