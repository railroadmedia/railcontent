<template>
    <span class="tw-flex sm:tw-hidden lg:tw-flex tw-text-[#00101D] dark:tw-text-white tw-text-[18px] lg:tw-text-[28px] tw-font-bold">
        <span class="tw-hidden lg:tw-block">Your Progress -&nbsp;</span> {{ progress }}%
    </span>
</template>

<script>
export default {
    props: {
        progress: {
            type: Number,
            required: true
        }
    }
}
</script>