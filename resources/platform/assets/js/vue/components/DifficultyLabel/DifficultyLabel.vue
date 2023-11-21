<template>
    <div :class="difficultyClass">
        {{ formattedDifficulty }}
    </div>
</template>

<script setup>
import { computed, defineProps } from 'vue';

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
            return 'tw-text-[#16A34A]';
        case 'beginner':
            return 'tw-text-[#0B76DB]';
        case 'intermediate':
            return 'tw-text-[#EAB308]';
        case 'advanced':
            return 'tw-text-[#F06314]';
        case 'expert':
            return 'tw-text-[#B91C1C]';
        default:
            return 'tw-text-[#E5E7EB]';
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
