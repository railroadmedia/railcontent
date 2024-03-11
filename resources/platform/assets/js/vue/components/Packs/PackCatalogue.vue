<template>
    <div class="tw-flex tw-flex-col">
      <PackCatalogueItem v-for="item in content" :pack="item" />
    </div>
</template>
<script setup>
import PackCatalogueItem from "./PackCatalogueItem";

const props = defineProps({
    content: {
        type: Array,
        default: [],
    },
})
</script>
