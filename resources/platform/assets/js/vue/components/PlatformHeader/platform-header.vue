<script setup>
    const props = defineProps({
        backgroundImage: {
            type: String,
            default: ''
        },
        brand: {
            type: String,
            default: 'drumeo'
        },
        blurBG: {
            type: Boolean,
            default: false,
        },
        title: {
            type: String,
            default: ''
        },
        contentQuantity: {
            type: [String, Number],
            default: null
        },
        titleIcon: {
            type: String,
            default: ''
        },
    })
</script>
<template>
    <div id="page-header"
         class="tw-flex tw-w-full tw-min-h-[140px] tw-py-5 tw-relative tw-z-30 tw-items-center tw-justify-center"
    >
        <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top tw-overflow-hidden">
            <img :src="`https://musora.com/cdn-cgi/image/quality=95,width=800,fit=cover,metadata=none/${ backgroundImage }`"
                class="tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
                :class="{ 'tw-blur-sm' : blurBG }"
                onload="this.classList.remove('tw-opacity-0')"
            >
        </div>

        <div class="tw-absolute tw-w-full tw-z-10 tw-h-full tw-bottom-0"
             style="background: linear-gradient(0deg, rgba(11, 118, 219, 0.23), rgba(11, 118, 219, 0.23)), linear-gradient(180deg, rgba(0, 0, 0, 0.72) 0%, rgba(0, 0, 0, 0.9) 100%);">
        </div>

        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-z-40 tw-w-full tw-h-auto tw-flex tw-flex-wrap">

            <div v-if="title.length" class="tw-flex tw-flex-col tw-mr-8">
                <!-- Title -->
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-1">
                    <musora-icon :icon-name="titleIcon" class="tw-w-[36px] tw-mr-2 tw-text-white">
                    </musora-icon>
                    <span class="tw-text-32 tw-font-bold tw-mr-2">{{ title }}</span>
                    <span v-if="contentQuantity !== null" class="tw-rounded-full tw-aspect-square tw-min-w-[33px] tw-min-h-[33px] tw-p-1 tw-inline-flex tw-items-center tw-justify-center tw-text-base tw-font-bold dark:tw-bg-[#002039] dark:tw-text-white tw-bg-[#E6E7E9] tw-text-[#0D0D0D]">{{ contentQuantity }}</span>
                </h1>
                <!-- CONTENT Slot-->
                <slot name="content" />
            </div>

            <slot v-else name="content" />

            <!-- Header CTA's Slot -->
            <slot name="ctas" />


        </div>
    </div>

</template>

