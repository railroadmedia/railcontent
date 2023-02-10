<script setup>
const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    price: {
        type: String,
        default: '',
    },
    priceDescription: {
        type: String,
        default: '',
    },
    ctaTitle: {
        type: String,
        default: '',
    },
    discount: {
        type: String,
        default: '',
    },
});

const emit = defineEmits(['onCTAClick']);
</script>

<template>
    <div class="tw-w-full tw-h-full">

        <div v-if="!discount.length"
            class="tw-flex tw-flex-col tw-grow tw-text-black tw-overflow-hidden tw-rounded-2xl tw-mx-auto tw-mb-4 md:tw-mb-0 tw-group">
            <div class="tw-px-3 tw-pt-6 md:tw-pt-8 tw-pb-5 md:tw-pb-8 tw-bg-[#00101D] dark:tw-bg-white tw-text-white dark:tw-text-black">
                <h2 class="tw-leading-none tw-mb-3"><strong>{{ title }}</strong></h2>
                <h4 class="tw-inline-block tw-leading-none"><strong>{{
                    price
                }}</strong></h4>
                <p class="tw-text-sm tw-mb-4"><em>{{
                    priceDescription
                }}</em></p>
                <button @click="() => emit('onCTAClick')" class="tw-btn-primary dark:tw-bg-[#00101D] tw-bg-white dark:tw-text-white tw-text-black">{{ ctaTitle }}</button>
            </div>
            <div class="tw-grow tw-px-3 tw-pt-5 md:tw-pt-6 tw-pb-9 md:tw-pb-10"
                style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                <slot></slot>
            </div>
        </div>
        <div v-if="discount.length" class="tw-w-full tw-h-full">
            <p class="tw-inline-block tw-absolute -tw-mt-3 tw-px-5 tw-py-1 tw-z-10 tw-text-[12px] tw-text-black tw-rounded-full tw-mx-auto tw-left-0 tw-right-0 tw-w-[100px]"
                style="background-color:#ffac00;">{{ discount }}</p>
            <div
                class="tw-flex tw-flex-col tw-h-full tw-text-black tw-overflow-hidden tw-rounded-2xl tw-mx-auto tw-mb-4 md:tw-mb-0 tw-group">
                <div class="tw-px-3 tw-pt-6 md:tw-pt-8 tw-pb-5 md:tw-pb-8 tw-bg-[#00101D] dark:tw-bg-white tw-text-white dark:tw-text-black">
                    <h2 class="tw-leading-none tw-mb-3"><strong>{{ title }}</strong></h2>
                    <h4 class="tw-inline-block tw-leading-none"><strong>{{
                        price
                    }}</strong></h4>
                    <p class="tw-text-sm tw-mb-4"><em>{{
                        priceDescription
                    }}</em></p>
                    <button @click="() => emit('onCTAClick')" class="tw-btn-primary dark:tw-bg-[#00101D] tw-bg-white dark:tw-text-white tw-text-black">{{ ctaTitle }}</button>
                </div>
                <div class="tw-grow tw-h-full tw-px-3 tw-pt-5 md:tw-pt-6 tw-pb-9 md:tw-pb-10"
                    style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>