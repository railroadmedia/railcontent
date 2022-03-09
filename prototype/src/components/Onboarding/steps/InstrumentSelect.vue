<script setup>
import InstrumentCard from '../../InstrumentCard/InstrumentCard.vue'
import InstrumentCardContent from '../../InstrumentCard/InstrumentCardContent.vue'
import ProgressBar from '../../ProgressBar/ProgressBar.vue'
import { brandUrl, bgColor, bgImg } from '../../../constants/brands'
const props = defineProps({
    brand: {
        type: String
    },
    steps: {
        type: Array
    },
    info: {
        type: Object
    }
})
const emit = defineEmits(['onChangeStep', 'onCheckStep', 'onChangeInfo'])
function onInstrumentSelection(instrument) {
    emit('changeInfo', { ...props.info, instrument })
    emit('checkStep', 1, true)
    emit('changeStep', 2)
}
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
                :backgroundUrl="bgImg.drumeo"
                brand="drumeo"
                :active="info.instrument === 'drums'"
                @onInstrumentSelect="() => onInstrumentSelection('drums')"
            >
                <InstrumentCardContent
                    instrumentText="DRUMS"
                    :logoUrl="brandUrl.drumeo"
                    logoAltText="Drumeo Logo"
                />
            </InstrumentCard>
            <InstrumentCard
                :backgroundUrl="bgImg.pianote"
                :active="info.instrument === 'piano'"
                brand="pianote"
                @onInstrumentSelect="() => onInstrumentSelection('piano')"
            >
                <InstrumentCardContent
                    instrumentText="PIANO"
                    :logoUrl="brandUrl.pianote"
                    logoAltText="Pianote Logo"
                />
            </InstrumentCard>
            <InstrumentCard
                :backgroundUrl="bgImg.guitareo"
                :active="info.instrument === 'guitar'"
                brand="guitareo"
                @onInstrumentSelect="() => onInstrumentSelection('guitar')"
            >
                <InstrumentCardContent
                    instrumentText="GUITAR"
                    :logoUrl="brandUrl.guitareo"
                    logoAltText="Guitareo Logo"
                />
            </InstrumentCard>
            <InstrumentCard
                :backgroundUrl="bgImg.singeo"
                :active="info.instrument === 'singing'"
                brand="singeo"
                @onInstrumentSelect="() => onInstrumentSelection('singing')"
            >
                <InstrumentCardContent
                    instrumentText="SINGING"
                    :logoUrl="brandUrl.singeo"
                    logoAltText="Singeo Logo"
                />
            </InstrumentCard>
        </div>
        <ProgressBar
            :brand="brand"
            :currentStep="1"
            :steps="steps"
            @changeStep="(s) => emit('changeStep', s)"
        />
    </div>
</template>
