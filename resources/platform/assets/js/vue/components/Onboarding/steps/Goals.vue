<script setup>
import {ref} from "vue";
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import StepHeader from "../StepHeader.vue";
import SkipStep from "../SkipStep.vue";
import MultiSelect from "../../MultiSelect/MultiSelect.vue";
import {getMultiSelectOptions} from "../utils";
import {saveGoals} from "../services";
import SingleChoicePills from "../../SingleChoicePills/SingleChoicePills.vue";

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
  configOptions: {
    type: Object,
  },
  stepName: {
    type: String
  }
});

const emit = defineEmits(["onChangeStep", "onCheckStep", "onChangeInfo"]);

const options = getMultiSelectOptions({
  property: 'goals',
  ...props
});

const currentSelection = ref(props.info.goals[brand]);

function handleSelect(selection) {
  currentSelection.value = selection;
}

function goBack() {
  emit('onChangeStep', 4);
}

const isNextButtonDisabled = () => {
  if (!currentSelection.value) {
    return true;
  }
  return !Object.values(currentSelection.value).filter(val => {
    return val;
  }).length;
};

const handleRedirect = () => {
  emit("onChangeInfo", {...props.info, goals: {...props.info.goals, [props.brand]: currentSelection.value}});

  saveGoals({
    goals: currentSelection.value,
    brand: props.brand
  }).then(() => {
    window.location.href = '/members';
  }).catch(() => {
    window.shownotification({
      icon: 'error',
      text: 'There was an error saving your goals preferences, please try again later.'
    });
  });
};

const headerProps = {
  title: "Great, now let’s set some goals!",
  subtitle: "Select the goal that describes your aspirations the most.",
  hideCloseButton: true,
};
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="true" @on-header-go-back="goBack" :headerProps="headerProps">
    <template v-slot:content>
      <div class="
        tw-w-full tw-min-h-full tw-flex tw-flex-col tw-items-center
        tw-justify-between
        xl:tw-justify-center
        tw-px-[18px]
      ">
        <SingleChoicePills :options="options" :selectedOption="currentSelection" @onSelect="handleSelect">
        </SingleChoicePills>
      </div>
    </template>
    <template v-slot:footer>
      <Button :brand="brand" @onButtonClick="handleRedirect" :isDisabled="isNextButtonDisabled()"
              classOverride="tw-mx-[16px] tw-w-[90vw] tw-mb-[20px] md:tw-hidden tw-block">Complete Your Account
      </Button>
      <ProgressBar :brand="brand" :currentStep="6" :steps="steps" @onChangeStep="(s) => emit('onChangeStep', s)"/>
      <Button :brand="brand" @onButtonClick="handleRedirect" :isDisabled="isNextButtonDisabled()"
              classOverride="md:tw-w-[543px] tw-mt-[40px] tw-hidden md:tw-block">Complete Your Account
      </Button>
      <SkipStep :brand="brand" :step="stepName" classOverride="tw-mt-[20px] md:tw-mt-0"/>
    </template>
  </StepWrapper>
</template>
