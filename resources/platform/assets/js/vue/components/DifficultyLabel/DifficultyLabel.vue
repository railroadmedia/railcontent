<template>
    <div :class="[difficultyClass]">
        {{ formattedDifficulty }}
    </div>
</template>
  
<script setup>
import { computed, defineProps } from 'vue';

const props = defineProps({
    difficulty: {
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

const difficultyClass = computed(() => {
    switch (props.difficulty.toUpperCase()) {
        case 'BEGINNER':
            return 'beginner';
        case 'INTERMEDIATE':
            return 'intermediate';
        case 'ADVANCED':
            return 'advanced';
        default:
            return '';
    }
});

const formattedDifficulty = computed(() => {
    switch (props.textCase) {
        case 'uppercase':
            return props.difficulty.toUpperCase();
        case 'lowercase':
            return props.difficulty.toLowerCase();
        case 'capitalize':
            return props.difficulty.charAt(0).toUpperCase() + props.difficulty.slice(1).toLowerCase();
        default:
            return props.difficulty;
    }
});


</script>
  
<style lang="scss" scoped>
.beginner {
    color: #0B76DB;
}
.intermediate {
    color: #EAB308;
}
.advanced {
    color: #F06314;
}
</style>
  