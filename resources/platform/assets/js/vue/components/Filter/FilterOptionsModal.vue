<template>
    <ModalRenderer>
        <div class="tw-h-full tw-w-full tw-overflow-hidden tw-relative tw-bg-[#F9F9F9] dark:tw-bg-[#000C17]">
            <div class="tw-font-bold tw-flex tw-items-end tw-h-[93px] tw-px-[18px] tw-py-[18px] tw-text-[24px] tw-text-[#000C17] dark:tw-text-white dark:tw-bg-[#081825]">
                Filter
                <button @click="emit('onClose')" class="tw-absolute tw-right-[18px] tw-top-[18px] tw-ml-auto tw-flex tw-items-center tw-justify-center tw-w-[40px] tw-h-[40px]">
                    <XIcon class="tw-w-[35px] tw-h-[35px] tw-text-black dark:tw-text-white" />
                </button>
            </div>
            <div class="tw-h-[calc(100%-200px)] tw-w-full tw-flex tw-flex-col tw-overflow-scroll">
                <filter-options
                    :selected-filters="selectedFilters"
                    :multi-select-columns="multiSelectColumns"
                    :single-select-columns="singleSelectColumns"
                    :selected-progress="selectedProgress"
                    @on-filter-click-handle="(selection) => emit('handleFilterClick', selection)"
                    @on-progress-click="progress => emit('handleProgressClick', progress)"
                />
            </div>
            <div class="tw-sticky tw-flex tw-items-center tw-justify-center tw-gap-[10px] tw-px-[12px] tw-bottom-0 tw-h-[107px] tw-bg-[#081825] tw-border-y tw-border-[#081825] tw-text-white" style="z-index: 2000;">
                <button class="tw-btn-secondary tw-bg-black tw-h-[50px] tw-max-w-[164px]" @click="emit('clearFilter')">
                    Clear All
                </button>
                <button class="tw-btn-primary tw-bg-white tw-text-black tw-h-[50px] tw-max-w-[164px]" @click="emit('onClose')">
                    Show Results
                </button>
            </div>
        </div>
    </ModalRenderer>
</template>

<script setup>
import { XIcon } from '@heroicons/vue/outline';
import FilterOptions from './FilterOptions.vue';
import ModalRenderer from '../Modal/ModalRenderer.vue';

const props = defineProps({
    multiSelectColumns: {
        type: Array,
        default: [],
    },
    singleSelectColumns: {
        type: Array,
        default: [],
    },
    selectedFilters: {
        type: Array,
        default: () => [],
    },
    selectedProgress: {
        type: String,
        default: '',
    },
});

const emit = defineEmits(['onClose', 'handleProgressClick', 'clearFilter', 'handleFilterClick'])

</script>

<style scoped>

</style>
