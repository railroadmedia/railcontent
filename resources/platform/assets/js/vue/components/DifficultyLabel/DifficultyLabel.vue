<template>
    <div class="tw-flex tw-items-center">
        <div class="tw-w-1.5 tw-h-1.5 tw-rounded-full tw-inline-block tw-mr-1.5" :class="difficultyClass" />
        <span>
            {{ formattedDifficulty }}
        </span>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    difficultyValue: {
        type: String,
        required: true
    },
    textCase: {
        type: String,
        default: 'capitalize',
        validator: (value) => {
            return ['uppercase', 'lowercase', 'capitalize', 'none'].includes(value);
        }
    }
});

const difficultyText = computed(() => {
    switch (props.difficultyValue.toString()) {
        case '1':
            return 'novice';
        case '2':
        case '3':
            return 'beginner';
        case '4':
        case '5':
            return 'intermediate';
        case '6':
        case '7':
            return 'advanced';
        case '8':
        case '9':
        case '10':
            return 'expert';
        default:
            return 'all';
    }
});

const difficultyClass = computed(() => {
    switch (difficultyText.value) {
        case 'novice':
            return 'tw-bg-[#16A34A]';
        case 'beginner':
            return 'tw-bg-[#0B76DB]';
        case 'intermediate':
            return 'tw-bg-[#EAB308]';
        case 'advanced':
            return 'tw-bg-[#F06314]';
        case 'expert':
            return 'tw-bg-[#B91C1C]';
        default:
            return 'tw-bg-[#3F3F46] dark:tw-bg-[#E7EFF6]';
    }
});

const formattedDifficulty = computed(() => {
    switch (props.textCase) {
        case 'uppercase':
            return difficultyText.value.toUpperCase();
        case 'lowercase':
            return difficultyText.value.toLowerCase();
        case 'capitalize':
            return difficultyText.value.charAt(0).toUpperCase() + difficultyText.value.slice(1).toLowerCase();
        default:
            return difficultyText.value;
    }
});
</script>
