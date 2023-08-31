<template>
    <ModalRenderer>
        <div class="tw-h-[100vh] tw-w-full tw-overflow-hidden tw-relative">
            <div class="tw-flex tw-items-end tw-h-[93px] tw-px-[18px] tw-py-[18px] tw-text-[24px] tw-text-white">
                Filter
                <button @click="() => emit('onClose')" class="tw-absolute tw-right-[18px] tw-top-[18px] tw-ml-auto tw-flex tw-items-center tw-justify-center tw-w-[40px] tw-h-[40px]">
                    <XIcon class="tw-w-[35px] tw-h-[35px] tw-text-black dark:tw-text-white" />
                </button>
            </div>
            <div class="tw-h-[calc(100%-200px)] tw-w-full tw-flex tw-flex-col tw-overflow-scroll">
                <filter-options v-if="!isCollapsedMobile"></filter-options>
            </div>
            <div class="tw-sticky tw-flex tw-px-[12px] tw-bottom-0 tw-h-[107px] tw-bg-[#081825] tw-border-y tw-border-[#081825] tw-text-white" style="z-index: 2000;">
                <button class="tw-btn-secondary">
                    Clear All
                </button>
                <button class="tw-btn-primary">
                    Show Resuls
                </button>
            </div>
        </div>
    </ModalRenderer>
</template>

<script setup>
    import { XIcon } from '@heroicons/vue/outline';
    import FilterOptions from './FilterOptions.vue';
    import ModalRenderer from '../Modal/ModalRenderer.vue';

    const emit = defineEmits(['onClose']);
</script>

<style scoped>

</style>
