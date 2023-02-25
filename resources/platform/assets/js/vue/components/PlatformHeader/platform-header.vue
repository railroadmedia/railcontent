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
        titleIcon: {
            type: String,
            default: ''
        },
    })
</script>
<template>
    <div id="page-header" 
         class="tw-flex tw-w-full tw-min-h-[240px] tw-relative tw-z-0 tw-items-center tw-justify-center" 
    >
        <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top tw-overflow-hidden">
            <img :src="`https://musora.com/cdn-cgi/image/quality=100,width=800,fit=cover,metadata=none/${ backgroundImage }`" 
                class="tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
                :class="{ 'tw-blur-sm' : blurBG }"
                onload="this.classList.remove('tw-opacity-0')"
            >
        </div>

        <div class="tw-absolute tw-w-full tw-z-10 tw-h-full tw-bottom-0" 
             style="background: linear-gradient(0deg, rgba(11, 118, 219, 0.23), rgba(11, 118, 219, 0.23)), linear-gradient(180deg, rgba(0, 0, 0, 0.72) 0%, rgba(0, 0, 0, 0.9) 100%);">
        </div>
        
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-z-20 tw-w-full tw-h-auto tw-flex tw-flex-wrap">

            <div class="tw-flex tw-flex-col tw-mr-8">
                <!-- Title -->
                <h1 v-if="title.length" class="tw-text-white tw-flex tw-items-center tw-mb-1">
                    <musora-icon :icon-name="titleIcon" class="tw-w-[36px] tw-mr-2 tw-text-white">
                    </musora-icon>
                    <span class="tw-text-32 tw-font-bold">{{ title }}</span>
                </h1>
                <!-- CONTENT Slot-->
                <slot name="content" />
            </div>

            <!-- Header CTA's Slot -->
            <div class="tw-flex tw-items-center tw-justify-start tw-ml-auto tw-w-full md:tw-w-auto tw-mt-4">
              <slot name="ctas" />
            </div>

        </div>
    </div>

</template>

