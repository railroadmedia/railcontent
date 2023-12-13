<template>
    <div class="lg:tw-flex tw-flex-wrap lg:tw-gap-14 tw-text-[#000C17] dark:tw-text-white">
        <filter-multi-selection-item v-for="column in multiSelectColumns" :column="column" @click-column-item="param => emit('onFilterClickHandle', param)" :selected-filters="selectedFilters">
        </filter-multi-selection-item>
        <filter-single-selection-item v-for="column in singleSelectColumns" :column="column" @click-progress="progress => emit('onProgressClick', progress)" :selected-value="selectedProgress">
        </filter-single-selection-item>
    </div>
</template>

<script setup>
import FilterMultiSelectionItem from './FilterMultiSelectionItem';
import FilterSingleSelectionItem from './FilterSingleSelectionItem';

const props = defineProps({
    multiSelectColumns: {
        type: Array,
        default: [],
    },
    selectedFilters: {
        type: Object,
        default: () => ({}),
    },
    selectedProgress: {
        type: String,
        default: '',
    },
    singleSelectColumns: {
        type: Array,
        default: [],
    },
});

const emit = defineEmits(['onFilterClickHandle', 'onProgressClick']);
</script>

<style scoped>

</style>
