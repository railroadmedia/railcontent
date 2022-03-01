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
        class="tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center tw-bg-[#000C17]"
    >
        <InstrumentCard
            :bgColor="'gray'"
            :active="brand === brandName"
            :brand="brandName"
            @onInstrumentSelect="() => handleSelect(brandName)"
        >
            DRUMS
        </InstrumentCard>
    </div>
</template>
