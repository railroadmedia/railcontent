<script setup>
import { ref, computed } from 'vue';
import { PlusIcon } from '@heroicons/vue/solid';

const props = defineProps({
    thumbnail: {
        type: String,
        default: '',
    },
    instructor: {
        type: String,
        default: '',
    },
    title: {
        type: String,
        default: '',
    },
    difficulty: {
        type: String,
        default: '',
    },
    contentType: {
        type: String,
        default: '',
    },
});

const buttonText = ref('Click me');

const levelColor = computed(() => {
    switch (props.difficulty) {
        case 'Beginner':
            return 'tw-text-green-500';
        case 'Intermediate':
            return 'tw-text-yellow-500';
        case 'Advanced':
            return 'tw-text-red-500';
        default:
            return 'tw-text-gray-500';
    }
});

const handleClick = () => {
    console.log('Button clicked');
};
</script>

<template>
    <div class="tw-flex tw-pl-[8px] tw-pr-[18px] tw-py-[4px]">
        <a href="/" class="tw-h-[71px] tw-w-[123px] tw-rounded-[7px] tw-shrink-0"
            :style="{ backgroundImage: `url(${thumbnail})` }"></a>
        <div class="tw-ml-[8px] tw-flex tw-flex-col tw-h-full tw-flex-grow tw-justify-center tw-overflow-hidden tw-py-[4px]">
            <a href="/" class="tw-text-[12px] dark:tw-text-[#9EC0DC] tw-uppercase">{{ instructor }}</a>
            <a href="/" class="tw-text-[14px] tw-truncate">{{ title }}</a>
            <a href="/" class="tw-text-[12px] dark:tw-text-[#9EC0DC]">
                <span :class="levelColor">⬤</span>
                &nbsp;
                <span>{{ difficulty }}</span>
                &nbsp;•&nbsp;
                <span>{{ contentType }}</span>
            </a>
        </div>
        <div class="tw-flex tw-justify-center tw-items-center tw-shrink-0">
            <button @click="handleClick">
                <PlusIcon class="tw-w-[27px] tw-h-[27px]" />
            </button>
        </div>
    </div>
</template>
