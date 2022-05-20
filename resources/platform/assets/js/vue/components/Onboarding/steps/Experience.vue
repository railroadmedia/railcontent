<script setup>
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import SquaredCard from "../../SquaredCard/SquaredCard.vue";
import SquaresContainer from "../../SquaredCard/SquaresContainer.vue";
import ExperienceCardContent from "../../SquaredCard/ExperienceCardContent.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import StepHeader from "../StepHeader.vue";
import SkipStep from "../SkipStep.vue";
import { ref } from "vue";
const props = defineProps({
  brand: {
    type: String,
  },
  steps: {
    type: Array,
  },
  info: {
    type: Object,
  },
});
const emit = defineEmits(["onChangeStep", "onCheckStep", "onChangeInfo"]);

function onExperienceSelection(selection) {
  emit("onCheckStep", 3, true);
  emit("onChangeStep", 4);
  emit("onChangeInfo", { ...props.info, experience: selection });
}

function skipStep() {
  alert("* the user skipped the step *");
}

function goBack() {
  emit('onChangeStep', 2);
}
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="true">
    <div
      class="
        tw-flex-grow
        md:tw-flex-grow-0
        md:tw-h-auto
        tw-w-full tw-flex tw-flex-col tw-items-center
        md:tw-justify-center
        tw-pt-[40px]
        md:tw-mt-0
        tw-overflow-y-scroll
      "
    >
      <StepHeader
        title="What experience level best describes you?"
        subtitle="Now it’s time to choose your experience level. You can change your
            experience level at anytime in your profile."
        @onGoBack="goBack"
      />
      <SquaresContainer>
        <SquaredCard
          type="green"
          :active="info.experience === 1"
          defaultBorderColor="tw-border-[#7E9AB1]"
          @onSelect="() => onExperienceSelection(1)"
        >
          <ExperienceCardContent
            title="Level 1"
            subtitle="Start from the beginning. No experience required!"
            level="1"
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
            level="2-3"
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
            level="4-6"
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
            level="7-10"
          />
        </SquaredCard>
      </SquaresContainer>
    </div>

    <div
      class="
        tw-justify-self-end
        md:tw-justify-self-center
        tw-flex tw-flex-col
        tw-items-center
        tw-pb-[30px]
        tw-pt-[10px]
        md:tw-pb-0
        md:tw-pt-0
      "
    >
      <ProgressBar
        :brand="brand"
        :currentStep="3"
        :steps="steps"
        @onChangeStep="(s) => emit('onChangeStep', s)"
      />
      <SkipStep @onSkip="skipStep" />
    </div>
  </StepWrapper>
</template>
