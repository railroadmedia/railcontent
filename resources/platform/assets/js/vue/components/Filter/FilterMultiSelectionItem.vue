<template>
    <ul class="lg:tw-w-[252px] tw-text-sm">
        <div class="md:tw-static tw-sticky tw-top-0">
            <div class="tw-flex tw-justify-between tw-items-center tw-py-[15px] tw-px-4 md:tw-px-0 tw-bg-[#F9F9F9] dark:tw-bg-[#081825] md:tw-bg-transparent md:dark:tw-bg-transparent">
                <div class="tw-uppercase tw-font-bold">{{ column.category }}</div>
                <button class="tw-font-bold lg:tw-hidden" @click="toggleCollapse">&mdash;</button>
            </div>
            <hr class="tw-border-[rgba(101, 101, 107, 0.25)] dark:tw-border-[#223F57] tw-mb-[15px] tw-sticky" />
        </div>
        <div :class="isCollapsed ? 'tw-hidden lg:tw-block' : 'tw-pb-6 lg:tw-pb-0'">
            <li v-for="item in column.items" class="tw-mb-2 tw-px-4 md:tw-px-0" :class="isSelected(column.category, item.value) ? 'tw-font-bold' : ''" >
                <button class="tw-flex tw-justify-between tw-items-center tw-w-full" @click="$emit('clickColumnItem', `${column.category},${item.value}`)">
                {{ item.key }} <input class="tw-border tw-border-[#D1D5DB] dark:tw-border-[#445F74] tw-rounded dark:tw-bg-[#002039] checked:tw-bg-[#FFAE00] checked:dark:tw-bg-[#FFAE00] tw-cursor-pointer" type="checkbox" :checked="isSelected(column.category, item.value)" />
                </button>
            </li>
        </div>
    </ul>
</template>

<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        column: {
            type: Object,
            default: {},
        },
        selectedFilters:{
            type: Object,
            default: () => ({}),
        },
    })

    const isCollapsed = ref(false);

    const toggleCollapse = () => {
        isCollapsed.value = !isCollapsed.value;
    }

    const isSelected = (category, value) => {
        return props.selectedFilters.find(f => f === `${category},${value}`);
    }
</script>

<style scoped>

</style>
