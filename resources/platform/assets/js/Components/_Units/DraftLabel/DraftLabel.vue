<template>
    <div
        class="tw-text-white tw-absolute tw-z-20 tw-font-extrabold tw-text-xl tw-rounded-xl tw-bg-red-700 tw-px-6 tw-py-1"
        :class="position ? position : 'tw-right-2 md:tw-right-6 tw-top-2 md:tw-top-6'"
    >
        DRAFT
    </div>
</template>
<script setup>
const props = defineProps({
    position: {
        type:String,
        default: '',
    }
})
</script>
