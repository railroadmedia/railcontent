<template>
    <div v-if="showCompletionBonus" class="tw-flex tw-flex-row tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457] ph-1">
        <div class="tw-flex tw-flex-col tw-text-[#00101D] dark:tw-text-white tw-items-center tw-w-full pv-2">
            <h3 class="tw-font-bebas-neue tw-text-base tw-uppercase tw-font-normal tw-text-center">Completion Bonus</h3>
            <span class="heading tw-text-center tw-text-[30px]">
                        <i class="fas fa-trophy tw-text-2xl"></i>
                        {{ xpBonus }} XP
                    </span>
        </div>
    </div>
</template>
<script setup>
import { computed } from "vue";

const props = defineProps({
    xpBonus: {
        type: Number,
        default: 0
    }
});

const showCompletionBonus = computed(() => {
    return props.xpBonus > 0;
});
</script>
