<script setup>
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import SquaredCard from "../../SquaredCard/SquaredCard.vue";
import SquaresContainer from "../../SquaredCard/SquaresContainer.vue";
import ExperienceCardContent from "../../SquaredCard/ExperienceCardContent.vue";
import StepWrapper from "../StepWrapper.vue";
import {saveExperience} from "../services"

const experienceDescriptionMap = {
  pianote: {
    0: 'I’m just starting out on the piano. Show me the basics first!',
    1: "I'm familiar with the keyboard layout and can play a few chords and scales.",
    2: 'I can play a few songs and have some hand independence.',
    3: 'I can play many songs in multiple styles from start to finish.',
    4: "I'm confident playing the piano and can learn and play most songs easily.",
  },
  singeo: {
    0: 'I’m just learning to sing, show me the basics first!',
    1: 'I want to understand my voice and learn basic tips for how to be a better singer.',
    2: 'I know a few vocal warm-ups, but I want to learn how to improve my voice.',
    3: 'I’ve got the essentials of singing down and want to develop my vocal style.',
    4: 'I already understand my voice, and now I want to dive into music theory, harmony, and performance techniques.',
  },
  drumeo: {
    0: 'I’m just starting out on the drums. Show me the basics first!',
    1: 'I know how to hold my sticks, set up my kit, and play a few beats and fills.',
    2: 'I’m comfortable playing some songs and have some hand and foot independence.',
    3: 'I can play many songs in multiple styles from start to finish.',
    4: 'I can experiment with polyrhythms and have years of experience.',
  },
  guitareo: {
    0: 'I’m just starting out on guitar, show me the basics first!',
    1: 'I know simple chords and strumming patterns, and can play the Em pentatonic and blues scales.',
    2: 'I’m comfortable playing bar chords and basic major and minor scales across the neck.',
    3: 'I know all kinds of riffs, chords & patterns but I want to refine my skills.',
    4: 'I have a solid grasp of the guitar and can play lots of tunes. I want to learn more advanced techniques and theories.',
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
  stepName: {
    type: String,
  },
  currentStep: {
    type: Number,
  },
});

const emit = defineEmits(["onChangeStep", "onCheckStep", "onChangeInfo"]);

function onExperienceSelection(selection) {
  emit("onChangeInfo", {...props.info, experience: {...props.info.experience, [props.brand]: selection}});
  handleNextStep(selection);
}

const handleNextStep = (selection) => {
  saveExperience({
    level: selection,
    brand: props.brand,
  }).catch(() => {
    window.shownotification({
      icon: 'error',
      text: 'There was an error saving your experience, please try again later.'
    });
  });

  emit("onCheckStep", props.currentStep, true);
  emit("onChangeStep", props.currentStep + 1);
};

function goBack() {
  emit('onChangeStep', props.currentStep - 1);
}

const stepHeaderProps = {
  title: "What skill level best describes you?",
};
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="true" @on-header-go-back="goBack" :headerProps="stepHeaderProps">
    <template v-slot:content>
      <div class="
        tw-w-full tw-min-h-full tw-flex tw-flex-col tw-items-center
        tw-justify-between
        xl:tw-justify-center
      ">
        <SquaresContainer>
          <SquaredCard :isLevelCard="true" type="green" :active="info.experience[brand] === 0" defaultBorderColor="tw-border-[#7E9AB1]"
                       @onSelect="() => onExperienceSelection(0)">
            <ExperienceCardContent title="New" :subtitle="experienceDescriptionMap[brand][0]" level="new"/>
          </SquaredCard>
          <SquaredCard :isLevelCard="true" :active="info.experience[brand] === 1" type="blue" defaultBorderColor="tw-border-[#7E9AB1]"
                       @onSelect="() => onExperienceSelection(1)">
            <ExperienceCardContent title="Beginner" :subtitle="experienceDescriptionMap[brand][1]" level="beginner"/>
          </SquaredCard>
          <SquaredCard :isLevelCard="true" :active="info.experience[brand] === 2" defaultBorderColor="tw-border-[#7E9AB1]" type="yellow"
                       @onSelect="() => onExperienceSelection(2)">
            <ExperienceCardContent title="Intermediate" :subtitle="experienceDescriptionMap[brand][2]" level="intermediate"/>
          </SquaredCard>
          <SquaredCard :isLevelCard="true" :active="info.experience[brand] === 3" defaultBorderColor="tw-border-[#7E9AB1]" type="orange"
                       @onSelect="() => onExperienceSelection(3)">
            <ExperienceCardContent title="Advanced" :subtitle="experienceDescriptionMap[brand][3]" level="advanced"/>
          </SquaredCard>
          <SquaredCard :isLevelCard="true" :active="info.experience[brand] === 4" defaultBorderColor="tw-border-[#7E9AB1]" type="red"
                       @onSelect="() => onExperienceSelection(4)">
            <ExperienceCardContent title="Expert" :subtitle="experienceDescriptionMap[brand][4]" level="expert"/>
          </SquaredCard>
        </SquaresContainer>
      </div>
    </template>
    <template v-slot:footer>
      <ProgressBar :brand="brand" :currentStep="props.currentStep" :steps="steps" @onChangeStep="(s) => emit('onChangeStep', s)"/>
    </template>
  </StepWrapper>
</template>
