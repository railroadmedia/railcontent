<script setup>
import {ref, onMounted} from "vue";
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "@units/Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import SkipStep from "../SkipStep.vue";
import StepHeader from "../StepHeader.vue";
import MultiSelect from "../../MultiSelect/MultiSelect.vue";
import {saveGear} from "../services"
import {getMultiSelectOptions} from "../utils";

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
    type: String,
  },
  currentStep: {
    type: Number,
  },
});

const emit = defineEmits(["onChangeStep", "onCheckStep", "onChangeInfo"]);

const options = ref(
  getMultiSelectOptions({
    property: 'gears',
    ...props
  })
);

const currentSelection = ref(props.info.instrumentTypes[props.brand]);

function handleMultiSelection(selection) {
  currentSelection.value = selection;
}

const handleNextStep = () => {
  const data = [];

  emit("onChangeInfo", {
    ...props.info,
    instrumentTypes: {...props.info.instrumentTypes, [props.brand]: currentSelection.value}
  });

  Object.entries(currentSelection.value).forEach(([type, isChecked]) => {
    if (isChecked) {
      data.push(type);
    }
  });

  saveGear({
    data,
    brand: props.brand
  }).catch(() => {
    window.shownotification({
      icon: 'error',
      text: 'There was an error saving your gear preferences, please try again later.'
    });
  });

  emit("onCheckStep", props.currentStep, true);
  emit("onChangeStep", props.currentStep + 1);
};

function goBack() {
  emit('onChangeStep', props.currentStep - 1);
}

const isNextButtonDisabled = () => {
  return !Object.values(currentSelection.value).filter(val => {
    return val;
  }).length;
};
const headerProps = {
  title: "What gear will you be practicing with?",
}
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="true" @onHeaderGoBack="goBack" :headerProps="headerProps">
    <template v-slot:content>
      <div class="
        tw-w-full tw-flex tw-flex-col tw-items-center
        md:tw-justify-center
        md:tw-mt-0
      ">
        <MultiSelect :options="options" :initialSelection="currentSelection" classOverride="md:tw-mb-[52px]"
                     @onChangeSelection="handleMultiSelection"/>
      </div>
    </template>
    <template v-slot:footer>
      <Button :brand="brand" @onButtonClick="handleNextStep" :isDisabled="isNextButtonDisabled()"
              classOverride="tw-mx-[16px] tw-w-[90vw] tw-mb-[20px] md:tw-hidden tw-block">Next
      </Button>
      <ProgressBar :brand="brand" :currentStep="props.currentStep" :steps="steps" @onChangeStep="(s) => emit('onChangeStep', s)"/>
      <Button :brand="brand" @onButtonClick="handleNextStep" :isDisabled="isNextButtonDisabled()"
              classOverride="md:tw-w-[543px] tw-mt-[40px] tw-hidden md:tw-block">Next
      </Button>
      <SkipStep :brand="brand" :step="stepName" classOverride="tw-mt-[20px] md:tw-mt-0"/>
    </template>
  </StepWrapper>
</template>
