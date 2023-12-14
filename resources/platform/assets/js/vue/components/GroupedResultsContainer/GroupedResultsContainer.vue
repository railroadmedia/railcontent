<template>
    <GroupedCard v-for="item in content" :item="item" />
</template>

<script setup>
import GroupedCard from '../GroupedCard/GroupedCard';

const props = defineProps({
    content: {
        type: Array,
        default: () => [],
    },
})
</script>
