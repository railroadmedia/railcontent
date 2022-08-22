<script setup>
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import SquaredCard from "../../SquaredCard/SquaredCard.vue";
import SquaresContainer from "../../SquaredCard/SquaresContainer.vue";
import ExperienceCardContent from "../../SquaredCard/ExperienceCardContent.vue";
import StepWrapper from "../StepWrapper.vue";
import StepHeader from "../StepHeader.vue";
import SkipStep from "../SkipStep.vue";
import { saveExperience } from "../services"

const experienceDescriptionMap = {
  pianote: {
    0: 'Start from the beginning. No experience required!',
    1: 'For beginners who are familiar with the layout of the keyboard, have good piano posture, and can play chords and scales in at least 2 key signatures.',
    2: 'For intermediate players who are comfortable playing a few songs and have some hand independence and dexterity.',
    3: 'For advanced players who are comfortable playing many songs in multiple styles from start to finish and are looking to improve specific skills.',
  },
  singeo: {
    0: 'Start from the beginning. No experience required!',
    1: 'For beginners who want to know more about how their voice works and what specific exercises they should focus on to become a better singer.',
    2: 'For intermediate singers who want to become better at singing songs and developing their vocal style.',
    3: 'For singers who have a solid understanding of their own voices and want to deepen their knowledge of music theory, harmony, and performance technique.',
  },
  drumeo: {
    0: 'Start from the beginning. No experience required!',
    1: 'For beginners who can hold your sticks, set up your kit, and can play a few beats and fills.',
    2: 'For intermediate players who are comfortable playing some songs and have some hand and foot independence.',
    3: 'For advanced players who are comfortable playing many songs in many styles start to finish, and are looking to improve in specific skills.',
  },
  guitareo: {
    0: 'Start from the beginning. No experience required!',
    1: 'For beginners who can hold your sticks, set up your kit, and can play a few beats and fills.',
    2: 'For intermediate players who are comfortable playing some songs and have some hand and foot independence.',
    3: 'For advanced players who are comfortable playing many songs in many styles start to finish, and are looking to improve in specific skills.',
  }
}

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
  emit("onChangeInfo", { ...props.info, experience: { ...props.info.experience, [props.brand]: selection } });
  handleNextStep(selection);
}

const handleNextStep = (selection) => {
  saveExperience({
    level: selection,
    brand: props.brand,
  }).then(() => {
    emit("onCheckStep", 3, true);
    emit("onChangeStep", 4);
  }).catch(() => {
    showErrorNotification.value = true;
  });
};

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
          :active="info.experience[brand] === 0"
          defaultBorderColor="tw-border-[#7E9AB1]"
          @onSelect="() => onExperienceSelection(0)"
        >
          <ExperienceCardContent
            title="Level 1"
            :subtitle="experienceDescriptionMap[brand][0]"
            level="1"
          />
        </SquaredCard>
        <SquaredCard
          :active="info.experience[brand] === 1"
          type="blue"
          defaultBorderColor="tw-border-[#7E9AB1]"
          @onSelect="() => onExperienceSelection(1)"
        >
          <ExperienceCardContent
            title="Level 2-3"
            :subtitle="experienceDescriptionMap[brand][1]"
            level="2-3"
          />
        </SquaredCard>
        <SquaredCard
          :active="info.experience[brand] === 2"
          defaultBorderColor="tw-border-[#7E9AB1]"
          type="yellow"
          @onSelect="() => onExperienceSelection(2)"
        >
          <ExperienceCardContent
            title="Level 4-6"
            :subtitle="experienceDescriptionMap[brand][2]"
            level="4-6"
          />
        </SquaredCard>
        <SquaredCard
          :active="info.experience[brand] === 3"
          defaultBorderColor="tw-border-[#7E9AB1]"
          type="red"
          @onSelect="() => onExperienceSelection(3)"
        >
          <ExperienceCardContent
            title="Level 7-10"
            :subtitle="experienceDescriptionMap[brand][3]"
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
      <SkipStep :brand="brand" />
    </div>
  </StepWrapper>
</template>
