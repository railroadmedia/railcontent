<template>
    <div class="tw-flex tw-overflow-x-auto tw-no-scrollbar">
        <div class="tw-flex tw-flex-nowrap tw-px-4 lg:tw-px-0 tw-gap-[4px] md:tw-gap-[10px] tw-text-sm">
            <button v-for="(option, i) in tabOptions" :key="i" @click="onTabClick(option)"
                class="tw-btn-primary tw-flex tw-items-center tw-justify-center tw-text-center tw-border tw-text-[#000C17] dark:tw-text-white dark:tw-border-[#445F74] tw-px-4 lg:tw-px-6 tw-mb-0 tw-leading-[1px]"
                :class="isActive(option.key) ? `tw-bg-[#28282D] dark:tw-bg-[#445F74] tw-text-white` : `hover:tw-bg-[#E7E7E8] hover:dark:tw-bg-[#223F57] hover:dark:tw-text-white tw-bg-white dark:tw-bg-[#000C17] tw-border-[#CBCBCD] dark:tw-text-white`">
                {{ option.value }}
            </button>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    tabOptions: {
        type: Array,
        default: [],
    },
    activeTab: {
        type: String,
        default: '',
    },
});
const emit = defineEmits(['onTabClick']);

const isActive = (key) => {
    return key === props.activeTab;
};

const onTabClick = (tab) => {
    emit('onTabClick', tab);
};
</script>