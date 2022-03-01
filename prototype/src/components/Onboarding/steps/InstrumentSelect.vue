<script setup>
import InstrumentCard from '../../InstrumentCard/InstrumentCard.vue'
const props = defineProps({
    brand: {
        type: String
    }
})
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
        <div class="tw-flex tw-space-x-6">
            <InstrumentCard
                :bgColor="'gray'"
                :active="brand === brandName"
                :brand="brandName"
                @onInstrumentSelect="() => handleSelect(brandName)"
            >
                DRUMS
            </InstrumentCard>
            <InstrumentCard
                :bgColor="'gray'"
                :active="brand === brandName"
                :brand="brandName"
                @onInstrumentSelect="() => handleSelect(brandName)"
            >
                PIANO
            </InstrumentCard>
            <InstrumentCard
                :bgColor="'gray'"
                :active="brand === brandName"
                :brand="brandName"
                @onInstrumentSelect="() => handleSelect(brandName)"
            >
                GUITAR
            </InstrumentCard>
            <InstrumentCard
                :bgColor="'gray'"
                :active="brand === brandName"
                :brand="brandName"
                @onInstrumentSelect="() => handleSelect(brandName)"
            >
                SINGING
            </InstrumentCard>
        </div>
    </div>
</template>
