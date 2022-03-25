<script setup>
import SquaredCard from '../../SquaredCard/SquaredCard.vue'
import InstrumentCardContent from '../InstrumentCardContent.vue'
import ProgressBar from '../../ProgressBar/ProgressBar.vue'
import StepWrapper from '../StepWrapper.vue'

import { brandUrl, bgColor, bgImg } from '../../../../constants/brands'
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
    emit('onChangeInfo', { user: props.info.user, instrument })
    emit('onCheckStep', 1, true)
    emit('onChangeStep', 2)
    for (let i = 2; i < 6; i++) {
        emit('onCheckStep', i, false)
    }
}
</script>

<template>
    <StepWrapper :brand="brand" :showBgImg="false">
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
            <SquaredCard
                :backgroundUrl="bgImg.drumeo"
                type="drumeo"
                :active="info.instrument === 'drums'"
                @onSelect="() => onInstrumentSelection('drums')"
            >
                <InstrumentCardContent
                    instrumentText="DRUMS"
                    :logoUrl="brandUrl.drumeo"
                    logoAltText="Drumeo Logo"
                />
            </SquaredCard>
            <SquaredCard
                :backgroundUrl="bgImg.pianote"
                :active="info.instrument === 'piano'"
                type="pianote"
                @onSelect="() => onInstrumentSelection('piano')"
            >
                <InstrumentCardContent
                    instrumentText="PIANO"
                    :logoUrl="brandUrl.pianote"
                    logoAltText="Pianote Logo"
                />
            </SquaredCard>
            <SquaredCard
                :backgroundUrl="bgImg.guitareo"
                :active="info.instrument === 'guitar'"
                type="guitareo"
                @onSelect="() => onInstrumentSelection('guitar')"
            >
                <InstrumentCardContent
                    instrumentText="GUITAR"
                    :logoUrl="brandUrl.guitareo"
                    logoAltText="Guitareo Logo"
                />
            </SquaredCard>
            <SquaredCard
                :backgroundUrl="bgImg.singeo"
                :active="info.instrument === 'singing'"
                type="singeo"
                @onSelect="() => onInstrumentSelection('singing')"
            >
                <InstrumentCardContent
                    instrumentText="SINGING"
                    :logoUrl="brandUrl.singeo"
                    logoAltText="Singeo Logo"
                />
            </SquaredCard>
        </div>
        <ProgressBar
            :brand="brand"
            :currentStep="1"
            :steps="steps"
            @onChangeStep="(s) => emit('onChangeStep', s)"
        />
    </StepWrapper>
</template>
