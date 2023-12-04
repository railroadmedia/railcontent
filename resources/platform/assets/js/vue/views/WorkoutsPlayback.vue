<template>
    <Breadcrumb
        :first-level-url="breadcrumbFirstLevelUrl"
        :first-level-title="breadcrumbFirstLevelTitle"
        :last-level-title="breadcrumbLastLevelTitle"
    />
</template>

<script setup>
import {onMounted, ref} from "vue";
import { storeToRefs } from 'pinia';
import {useUserStore} from "../../stores/user";

import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import CatalogueCardContainer from '../components/Catalogue/CatalogueCardContainer';
import CollectionWrapper from '../components/CollectionWrapper/CollectionWrapper';

const props = defineProps({
    breadcrumbFirstLevelUrl: {
        type: String,
        default: ''
    },
    breadcrumbFirstLevelTitle: {
        type: String,
        default: ''
    },
    breadcrumbLastLevelTitle: {
        type: String,
        default: ''
    },
    collectionType: {
        type: String,
        default: ''
    },
    filterableValues: {
        type: Array,
        default: () => [],
    },
    includeFutureScheduledContentOnly: {
        type: Boolean,
        default: () => false,
    },
    statuses: {
        type: Array,
        default: () => ["published"],
    },
});

onMounted(()=> {
    console.log('continueData',props.carouselData.length)
})
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const videoModalOpen = ref(false);
const videoSrc = ref('');

const openVideo = (src) => {
    videoSrc.value = src;
    videoModalOpen.value = true;
}

const closeVideo = () => {
    videoModalOpen.value = false;
}
</script>
