<template>
    <div class="tw-flex tw-flex-col">
      <SkeletonPackCatalogueItem v-if="isLoading" v-for="i in 6" :key="i" />
      <PackCatalogueItem v-else v-for="item in content" :pack="item" />
    </div>
</template>
<script setup>
import { storeToRefs } from "pinia/dist/pinia";
import { usePlatformStore } from "@stores/platform";
import PackCatalogueItem from "./PackCatalogueItem";
import SkeletonPackCatalogueItem from '@collections/SkeletonLoader/SkeletonPackCatalogueItem';

const props = defineProps({
    content: {
        type: Array,
        default: [],
    },
})

const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);
</script>
