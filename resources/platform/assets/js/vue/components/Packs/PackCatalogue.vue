<template>
    <div class="tw-container tw-mx-auto tw-px-4 lg:tw-px-0">
        <div class="tw-flex tw-flex-col">
          <PackCatalogueItem v-for="item in content" :pack="item" />
        </div>
    </div>
</template>
<script setup>
import { onMounted } from 'vue';
import PackCatalogueItem from "./PackCatalogueItem";

const props = defineProps({
    content: {
        type: Array,
        default: [],
    },
})

onMounted(() => {
    console.log('content', props.content);
})
</script>
