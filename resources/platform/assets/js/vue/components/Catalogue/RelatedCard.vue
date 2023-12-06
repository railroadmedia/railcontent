<script setup>
import { ref, computed } from 'vue';

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
    level: {
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
    switch (props.level) {
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
    <div class="tw-flex">
        <div class="tw-h-[71px] tw-w-[123px] tw-rounded-[7px]" :style="{ backgroundImage: `url(${thumbnail})` }"></div>
        <div class="tw-w-1/2">
            <div class="tw-flex tw-flex-col tw-h-full">
                <div class="tw-text-[12px] dark:tw-text-[#9EC0DC]">{{ instructor }}</div>
                <div class="tw-text-lg">{{ title }}</div>
                <div class="tw-text-sm">
                    <span :class="levelColor">⬤</span>
                    &nbsp;
                    <span>{{ level }}</span>
                    &nbsp;•&nbsp;
                    <span>{{ contentType }}</span>
                </div>
            </div>
        </div>
        <div class="tw-w-1/4">
            <button class="tw-w-10 tw-h-10 tw-bg-blue-500 tw-rounded-full" @click="handleClick">{{ buttonText }}</button>
        </div>
    </div>
</template>
