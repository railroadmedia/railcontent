<template>
    <ul v-if="Object.keys(filters).length" class="tw-flex tw-flex-wrap tw-gap-4 tw-text-sm tw-mb-5 tw-px-4 md:tw-px-0">
        <template v-for="key in Object.keys(filters)">
            <li class="tw-flex tw-items-center tw-p-2 tw-rounded tw-border dark:tw-border-[#223F57] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] dark:tw-text-white tw-font-semibold" v-for="filter in filters[key]">
                {{ filter.name }}
                <button class="tw-text-[#000C17] dark:tw-text-white">
                    <XIcon class="tw-h-[20px] tw-w-[20px] tw-ml-1" @click="$emit('clickColumnItem', key, filter)" />
                </button>
            </li>
        </template>
    </ul>
</template>

<script setup>
    import { XIcon } from "@heroicons/vue/solid";

    const props = defineProps({
        filters: {
            type: Object,
            default: {},
        },
    })
</script>

<style scoped>

</style>
