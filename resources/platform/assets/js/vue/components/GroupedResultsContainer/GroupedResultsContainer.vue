<template>
    <GroupedCard v-for="(item, index) in content" :item="item" :key="index" :content-type-override="contentTypeOverride" />
</template>

<script setup>
import GroupedCard from '../GroupedCard/GroupedCard';

const props = defineProps({
    content: {
        type: Array,
        default: () => [],
    },
    contentTypeOverride: {
        type: String,
        default: () => '',
    }
})
</script>