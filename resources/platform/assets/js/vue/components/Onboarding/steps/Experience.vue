<script setup>
import ProgressBar from '../../ProgressBar/ProgressBar.vue'
import SquaredCard from '../../SquaredCard/SquaredCard.vue'
import InstrumentCardContent from '../InstrumentCardContent.vue'
import ExperienceCardContent from '../ExperienceCardContent.vue'
import Button from '../../Button/Button.vue'
import StepWrapper from '../StepWrapper.vue'
import SkipStep from '../SkipStep.vue'
import { defineEmits, defineProps, ref } from 'vue'
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

function onExperienceSelection(selection) {
    emit('onCheckStep', 3, true)
    emit('onChangeStep', 4)
    emit('onChangeInfo', { ...props.info, experience: selection })
}

function skipStep() {
    alert('* the user skipped the step *')
}
</script>

<template>
    <StepWrapper :brand="brand" :showBgImg="true">
        <h2
            class="tw-mb-[5px] tw-w-full tw-text-center tw-font-bold tw-text-white"
        >
            What experience level best describes you?
        </h2>
        <p class="tw-font-[16px] tw-mb-[40px] tw-max-w-[624px] tw-text-white">
            Now it’s time to choose your experience level. You can change your
            experience level at anytime in your profile.
        </p>
        <div class="tw-mb-[40px] tw-flex tw-space-x-6">
            <SquaredCard
                type="green"
                :active="info.experience === 1"
                defaultBorderColor="tw-border-[#7E9AB1]"
                @onSelect="() => onExperienceSelection(1)"
            >
                <ExperienceCardContent
                    title="Level 1"
                    subtitle="Start from the beginning. No experience required!"
                    color="green"
                />
            </SquaredCard>
            <SquaredCard
                :active="info.experience === 2"
                type="blue"
                defaultBorderColor="tw-border-[#7E9AB1]"
                @onSelect="() => onExperienceSelection(2)"
            >
                <ExperienceCardContent
                    title="Level 2-3"
                    subtitle="For beginners who can hold your sticks, set-up your kit, and can play a few beats and fills"
                    color="blue"
                />
            </SquaredCard>
            <SquaredCard
                :active="info.experience === 4"
                defaultBorderColor="tw-border-[#7E9AB1]"
                type="yellow"
                @onSelect="() => onExperienceSelection(4)"
            >
                <ExperienceCardContent
                    title="Level 4-6"
                    subtitle="For intermediate player who are comfortable playing some songs and have some hand and foot independence."
                    color="yellow"
                />
            </SquaredCard>
            <SquaredCard
                :active="info.experience === 7"
                defaultBorderColor="tw-border-[#7E9AB1]"
                type="red"
                @onSelect="() => onExperienceSelection(7)"
            >
                <ExperienceCardContent
                    title="Level 7-10"
                    subtitle="For advanced player who are comfortable playing many songs in many styles start to finish, and are looking to improve in specific skills."
                    color="red"
                />
            </SquaredCard>
        </div>
        <ProgressBar
            :brand="brand"
            :currentStep="3"
            :steps="steps"
            @onChangeStep="(s) => emit('onChangeStep', s)"
        />
        <SkipStep @onSkip="skipStep" />
    </StepWrapper>
</template>
