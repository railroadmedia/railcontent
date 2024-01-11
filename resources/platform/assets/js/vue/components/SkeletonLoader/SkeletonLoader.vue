<template>
    <component :is="skeletonComponent" v-for="n in count" :key="n" />
</template>
  
  
<script setup>
import { ref, computed } from 'vue';
import SkeletonCard from './SkeletonCard.vue';
import SkeletonCardGroupHeader from './SkeletonCardGroupHeader.vue';

const props = defineProps({
    type: {
        type: String,
        default: 'card'
    },
    count: {
        type: Number,
        default: 1
    }
});

const skeletonComponent = computed(() => {
    switch (props.type) {
        case 'card':
            return SkeletonCard;
        case 'card-group-header':
            return SkeletonCardGroupHeader;
        default:
            return SkeletonCard;
    }
});
</script>

  