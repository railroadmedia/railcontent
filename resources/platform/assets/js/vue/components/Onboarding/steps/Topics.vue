<script setup>
import { ref } from "vue";
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import StepHeader from "../StepHeader.vue";
import SkipStep from "../SkipStep.vue";
import MultiSelect from "../../MultiSelect/MultiSelect.vue";
import { getMultiSelectOptions } from "../utils";
import { saveTopics } from "../services";

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
  }
});

const emit = defineEmits(["onChangeStep", "onCheckStep", "onChangeInfo"]);

const options = ref(
  getMultiSelectOptions({
    property: 'topics',
    ...props
  })
);

const currentSelection = ref(props.info.topics[props.brand]);

function handleMultiSelection(selection) {
  currentSelection.value = selection;
}

const handleNextStep = () => {
  const data = [];

  emit("onChangeInfo", { ...props.info, topics: { ...props.info.topics, [props.brand]: currentSelection.value } });

  Object.entries(currentSelection.value).forEach(([type, isChecked]) => {
    if (isChecked) {
      data.push(type);
    }
  })

  saveTopics({
    data,
    brand: props.brand
  }).then(() => {
    emit('onChangeStep', 6);
    emit('onCheckStep', 5, true);
  }).catch(() => {
    showErrorNotification.value = true;
  });
};

function goBack() {
  emit('onChangeStep', 4);
}

const isNextButtonDisabled = () => {
  return !Object.values(currentSelection.value).filter(val => {
    return val;
  }).length;
};
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="true">
    <div class="
        tw-w-full tw-min-h-full tw-flex tw-flex-col tw-items-center
        tw-justify-between
        xl:tw-justify-center
      ">
      <StepHeader
        title="Okay, and what topics would you like to study?"
        subtitle="You can select more than one topic and change your settings in your profile at any time."
        @onGoBack="goBack"
      />
      <MultiSelect :options="options" :initialSelection="currentSelection" classOverride="md:tw-mb-[52px]"
        @onChangeSelection="handleMultiSelection" />

      <div class="
        tw-flex tw-flex-col tw-items-center tw-pt-[20px] tw-pb-[20px]
        xl:tw-pb-0
      ">
        <Button :brand="brand" @onButtonClick="handleNextStep" :isDisabled="isNextButtonDisabled()"
          classOverride="tw-mx-[16px] tw-w-[90vw] tw-mb-[20px] md:tw-hidden tw-block">Next</Button>
        <ProgressBar :brand="brand" :currentStep="5" :steps="steps" @onChangeStep="(s) => emit('onChangeStep', s)" />
        <Button :brand="brand" @onButtonClick="handleNextStep" :isDisabled="isNextButtonDisabled()"
          classOverride="md:tw-w-[543px] tw-mt-[40px] tw-hidden md:tw-block">Next</Button>
        <SkipStep :brand="brand" classOverride="tw-mt-[20px] md:tw-mt-0" />
      </div>
    </div>
  </StepWrapper>
</template>
