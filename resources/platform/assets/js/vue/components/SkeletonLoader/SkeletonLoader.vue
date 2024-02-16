<template>
    <component :is="skeletonComponent" v-for="n in count" :key="n" v-bind="props" />
</template>


<script setup>
import { ref, computed } from 'vue';
import SkeletonCard from './SkeletonCard.vue';
import SkeletonSongCard from './SkeletonSongCard.vue';
import SkeletonCardGroupHeader from './SkeletonCardGroupHeader.vue';

const props = defineProps({
    type: {
        type: String,
        default: 'card'
    },
    count: {
        type: Number,
        default: 1
    },
    forceListView: {
        type: Boolean,
        default: false,
    },
    breakToListView: {
        type: Boolean,
        default: false,
    }
});

const skeletonComponent = computed(() => {
    switch (props.type) {
        case 'card':
            return SkeletonCard;
        case 'songCard':
            return SkeletonSongCard;
        case 'card-group-header':
            return SkeletonCardGroupHeader;
        default:
            return SkeletonCard;
    }
});
</script>

