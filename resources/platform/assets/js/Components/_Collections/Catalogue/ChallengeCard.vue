<template>
    <div class="tw-shrink-0 tw-text-primary-2 tw-text-[11px] lg:tw-text-xs " :class="widthStyles">
        <img class="tw-rounded-lg tw-overflow-hidden tw-border tw-border-primary-7" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://www.musora.com/musora-cdn/image/width=300,quality=95/https://cdn.musora.com/image/fetch/c_fill,w_660,h_960,q_auto:good/https://d1923uyy6spedc.cloudfront.net/coaches-2022/drumeo/Domino-Santantonio-HEAD.jpg" />
        <div class="tw-my-[7px] tw-uppercase">
            El Estepario Siberiano
        </div>
        <DifficultyLabel />
    </div>
</template>
<script setup>
import { computed } from "vue";
import DifficultyLabel from '@units/DifficultyLabel/DifficultyLabel';

const props = defineProps({
    isGroupedView: {
        type: Boolean,
        default: () => false,
    },
});

const widthStyles = computed(() => {
    if(props.isGroupedView){
        return 'tw-w-[168px] sm:tw-w-[230px] lg:tw-w-auto'
    }
})
</script>
