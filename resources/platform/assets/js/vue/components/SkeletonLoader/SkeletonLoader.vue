<template>
    <component :is="skeletonComponent" v-for="n in count" :key="n" v-bind="props" />
</template>


<script setup>
import { computed } from 'vue';
import SkeletonCard from './SkeletonCard.vue';
import SkeletonListElement from './SkeletonListElement.vue';
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
    isSingleRow: {
		type: Boolean,
        default: () => false,
    },
    isGroupedView: {
        type: Boolean,
        default: () => false,
    },
});

const skeletonComponent = computed(() => {
    switch (props.type) {
        case 'card':
            return SkeletonCard;
        case 'listElement':
            return SkeletonListElement;
        case 'songCard':
            return SkeletonSongCard;
        case 'card-group-header':
            return SkeletonCardGroupHeader;
        default:
            return SkeletonCard;
    }
});
</script>

