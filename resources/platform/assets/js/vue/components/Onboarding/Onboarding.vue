<script setup>
import { ref } from 'vue'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import UserInfo from './steps/UserInfo.vue'
import InstrumentSelect from './steps/InstrumentSelect.vue'
import InstrumentType from './steps/InstrumentType.vue'
import Experience from './steps/Experience.vue'
import Genre from './steps/Genre.vue'
import Topics from './steps/Topics.vue'
import Coaches from './steps/Coaches.vue'

const props = defineProps({
    brand: {
        type: String,
    }
})
const initialSteps = [
    { label: 'ABOUT', checked: false },
    { label: 'INSTRUMENT', checked: false },
    { label: 'TYPE', checked: false },
    { label: 'EXPERIENCE', checked: false },
    { label: 'GENRES', checked: false },
    { label: 'TOPICS', checked: false },
    { label: 'COACHES', checked: false }
]

const instrumentBrand = {
    piano: 'pianote',
    drums: 'drumeo',
    guitar: 'guitareo',
    singing: 'singeo',
    default: 'drumeo'
}
const initialInfo = {
    user: {
        name: '',
        avatarUrl: ''
    },
    instrument: 'default',
    instrumentTypes: {}
}

let currentStep = ref(0)
let info = ref(initialInfo)
let steps = ref(initialSteps)

function changeStep(step) {
    currentStep.value = step
}
function changeInfo(newInfo) {
    info.value = newInfo

    if (newInfo.user.name && newInfo.user.name.length > 0) {
        checkStepToggle(0, true)
    } else {
        checkStepToggle(0, false)
    }
}
function checkStepToggle(step, val) {
    const newSteps = steps.value
    newSteps[step].checked = val
    steps.value = newSteps
}
</script>

<template>
    <ModalRenderer>
        <UserInfo
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 0"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
        />
        <InstrumentSelect
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 1"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
        />
        <InstrumentType
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 2"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
        />
        <Experience
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 3"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
        />
        <Genre
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 4"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
        />
        <Topics
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 5"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
        />
        <Coaches
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 6"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
        />
    </ModalRenderer>
</template>
