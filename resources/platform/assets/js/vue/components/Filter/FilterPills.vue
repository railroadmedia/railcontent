<template>
    <ul v-if="showPills" class="tw-flex tw-flex-wrap tw-gap-4 tw-text-sm tw-mb-5 tw-px-4 md:tw-px-0">
        <template v-for="category in Object.keys(selectedFilters)">
            <li class="tw-flex tw-items-center tw-p-2 tw-rounded tw-border dark:tw-border-[#223F57] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] dark:tw-text-white tw-font-semibold" v-for="item in selectedFilters[category]">
                {{ item.value }}
                <button class="tw-text-[#000C17] dark:tw-text-white">
                    <XIcon class="tw-h-[20px] tw-w-[20px] tw-ml-1" @click="handleCancel(category, item)" />
                </button>
            </li>
        </template>
        <li class="tw-flex tw-items-center tw-p-2 tw-rounded tw-border dark:tw-border-[#223F57] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] dark:tw-text-white tw-font-semibold tw-uppercase">
            Clear all
            <button class="tw-text-[#000C17] dark:tw-text-white">
                <XIcon class="tw-h-[20px] tw-w-[20px] tw-ml-1" @click="handleClearFilters" />
            </button>
        </li>
    </ul>
</template>

<script setup>
    import { XIcon } from "@heroicons/vue/solid";
    import {computed} from "vue";

    const props = defineProps({
        selectedFilters: {
            type: Object,
            default: {},
        },
    })

    const emit = defineEmits(['cancelFilter', 'clearFilter']);

    const handleCancel = (category, item) => {
        emit('cancelFilter', category, item);
    }

    const handleClearFilters = () => {
        emit('clearFilter');
    }

    const showPills = computed(() => {
        return Object.keys(props.selectedFilters).length !== 0;
    })
</script>

<style scoped>

</style>
