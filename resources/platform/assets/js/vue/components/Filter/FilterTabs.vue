<template>
    <div class="tw-flex tw-flex-wrap tw-gap-[4px] md:tw-gap-[10px] tw-text-sm">
        <button
            v-for="option in tabOptions"
            @click="onTabClick(option.value)"
            class="tw-flex tw-items-center tw-justify-center tw-text-center tw-h-[40px] md:tw-h-[50px] tw-uppercase tw-text-[14px] md:tw-text-[20px] tw-font-bebas-neue tw-rounded-[55px] tw-border hover:dark:tw-bg-[#223F57] hover:tw-text-white tw-font-semibold dark:tw-border-[#445F74] tw-px-4 lg:tw-px-6"
            :class="isActive(option.value) ? `tw-bg-[#28282D] dark:tw-bg-[#445F74] tw-text-white` : `tw-bg-white dark:tw-bg-[#000C17] tw-border-[#CBCBCD] dark:tw-text-white`"
        >
           {{ option.key }}
        </button>
    </div>
</template>

<script setup>
    const props = defineProps({
        tabOptions: {
            type: Array,
            default: [],
        },
        selectedTab: {
            type: String,
            default: 'songs',
        },
    });
    const emit = defineEmits(['onTabClick']);

    const isActive = (key) => {
        return key === props.selectedTab;
    };

    const onTabClick = (key) => {
        emit('onTabClick', key);
    };
</script>

<style scoped>

</style>
