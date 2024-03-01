<template>
    <div ref="tooltipContainer" class="tw-relative tw-flex tw-justify-center tw-items-center">
        <div @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave" @focus="show = true" @blur="handleBlur"
            @click="handleClick" class="tw-cursor-pointer">
            <slot name="trigger"></slot>
        </div>
        <div v-if="show"
            :class="[tooltipPosition, 'tw-absolute tw-p-[15px] tw-text-sm tw-text-[#00101D] dark:tw-text-white tw-border tw-border-[#B2B2B5] dark:tw-border-[#444447] tw-bg-[#F4F4F5] dark:tw-bg-[#232327] tw-z-30 tw-min-w-max']">
            <slot name="content"></slot>
        </div>
    </div>
</template>


<script setup>
import { ref, onMounted, onUnmounted, computed, defineProps } from 'vue';

const props = defineProps({
    position: {
        type: String,
        default: 'bottom',
    },
});

const show = ref(false);
const clicked = ref(false);
const tooltipContainer = ref(null);


const handleDocumentClick = (event) => {
    if (tooltipContainer.value && !tooltipContainer.value.contains(event.target)) {
        clicked.value = false;
        show.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleDocumentClick);
});

onUnmounted(() => {
    document.removeEventListener('click', handleDocumentClick);
});

const handleMouseEnter = () => {
    if (!clicked.value) {
        show.value = true;
    }
};

const handleMouseLeave = () => {
    if (!clicked.value) {
        show.value = false;
    }
};

const handleClick = (event) => {
    clicked.value = true;
    show.value = true;
    event.stopPropagation();
};

const handleBlur = () => {
    clicked.value = false;
    show.value = false;
};

const tooltipPosition = computed(() => {
    switch (props.position) {
        case 'top':
            return 'tw-bottom-full tw-mb-2';
        case 'bottom':
            return 'tw-top-full tw-mt-2';
        case 'left':
            return 'tw-right-full tw-mr-2';
        case 'right':
            return 'tw-left-full tw-top-0 tw-ml-2';
        default:
            return 'tw-top-full tw-mt-2';
    }
});
</script>
