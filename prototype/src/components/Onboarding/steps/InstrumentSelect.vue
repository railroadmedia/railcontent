<script setup>
import InstrumentCard from '../../InstrumentCard/InstrumentCard.vue'
import ProgressBar from '../../ProgressBar/ProgressBar.vue'
const props = defineProps({
    brand: {
        type: String
    },
    steps: {
        type: Array
    }
})
const emit = defineEmits(['changeStep'])
</script>

<template>
    <div
        class="tw-flex tw-h-full tw-w-full tw-flex-col tw-items-center tw-justify-center tw-bg-[#000C17]"
    >
        <h2
            class="tw-mb-[5px] tw-w-full tw-text-center tw-font-bold tw-text-white"
        >
            Select your instrument
        </h2>
        <p class="tw-mb-[40px] tw-max-w-[624px] tw-text-white">
            Want to learn more than one instument? You can change your
            instrument at any time in your profile or by using the instrument
            selector in the navigation.
        </p>
        <div class="tw-mb-[40px] tw-flex tw-space-x-6">
            <InstrumentCard
                :bgColor="'gray'"
                :brand="brand"
                @onInstrumentSelect="() => handleSelect(brandName)"
            >
                DRUMS
            </InstrumentCard>
            <InstrumentCard
                :bgColor="'gray'"
                :brand="brand"
                @onInstrumentSelect="() => handleSelect(brandName)"
            >
                PIANO
            </InstrumentCard>
            <InstrumentCard
                :bgColor="'gray'"
                :brand="brand"
                @onInstrumentSelect="() => handleSelect(brandName)"
            >
                GUITAR
            </InstrumentCard>
            <InstrumentCard
                :bgColor="'gray'"
                :brand="brand"
                @onInstrumentSelect="() => handleSelect(brandName)"
            >
                SINGING
            </InstrumentCard>
        </div>
        <ProgressBar :brand="brand" :currentStep="1" :steps="steps" />
    </div>
</template>
