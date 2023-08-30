<template>
    <ul class="lg:tw-w-[252px] tw-text-sm tw-mb-6 lg:tw-mb-0">
        <div class="tw-flex tw-justify-between tw-items-center tw-py-[15px] tw-px-4 md:tw-px-0  tw-bg-[#F9F9F9] dark:tw-bg-[#081825] md:tw-bg-transparent md:dark:tw-bg-transparent">
            <div class="tw-uppercase tw-font-bold">{{ column.category }}</div>
            <button class="tw-font-bold lg:tw-hidden" @click="toggleDropdown">&mdash;</button>
        </div>
        <hr class="tw-border-[rgba(101, 101, 107, 0.25)] dark:tw-border-[#223F57] tw-mb-[15px]" />
        <li class="tw-justify-between tw-items-center tw-mb-2 tw-px-4 md:tw-px-0" :class="dropdown ? 'tw-flex' : 'tw-hidden lg:tw-flex'" v-for="item in column.items">
            {{ item.name }} <input class="tw-border tw-border-[#D1D5DB] dark:tw-border-[#445F74] tw-rounded dark:tw-bg-[#002039] checked:tw-bg-[#FFAE00] checked:dark:tw-bg-[#FFAE00]" type="checkbox" @click="$emit('clickColumnItem', column.category, item)" :checked="filters[column.category] ? filters[column.category].find((f)=> f.value === item.value) : false" />
        </li>
    </ul>
</template>

<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        column: {
            type: Object,
            default: {},
        },
        filters: {
            type: Object,
            default: {},
        },
    })

    const dropdown = ref(true);

    const toggleDropdown = () => {
        dropdown.value = !dropdown.value;
    }
</script>

<style scoped>

</style>
