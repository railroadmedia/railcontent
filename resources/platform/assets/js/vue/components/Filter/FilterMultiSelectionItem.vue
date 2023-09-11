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
            <li v-for="item in column.items" class="tw-flex tw-justify-between tw-items-center tw-mb-2 tw-px-4 md:tw-px-0" :class="isSelected(item.value) ? 'tw-font-bold' : ''" >
                {{ item.name }} <input class="tw-border tw-border-[#D1D5DB] dark:tw-border-[#445F74] tw-rounded dark:tw-bg-[#002039] checked:tw-bg-[#FFAE00] checked:dark:tw-bg-[#FFAE00] tw-cursor-pointer" type="checkbox" @click="$emit('clickColumnItem', column.category, item)" :checked="isSelected(item.value)" />
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
        filters: {
            type: Object,
            default: {},
        },
    })

    const isCollapsed = ref(false);

    const toggleCollapse = () => {
        isCollapsed.value = !isCollapsed.value;
    }

    const isSelected = (value) => {
        return props.filters[props.column.category] && props.filters[props.column.category].find((f)=> f.value === value) ? true : false;
    }
</script>

<style scoped>

</style>
