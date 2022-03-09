<script setup>
import { bgImg } from '../../constants/brands'
const props = defineProps({
    brand: {
        type: String
    },
    showBgImg: {
        type: Boolean
    }
})
</script>

<template>
    <div
        :class="`tw-flex tw-h-full tw-w-full tw-flex-col tw-items-center tw-justify-center tw-bg-[#000C17]`"
        :style="
            brand && showBgImg
                ? `background-image: url('${bgImg[brand]}') background-size: cover`
                : ''
        "
    >
        <slot />
    </div>
</template>
