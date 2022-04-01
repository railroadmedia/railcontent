<script setup>
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import SkipStep from "../SkipStep.vue";
import StepHeader from "../StepHeader.vue";
import MultiSelect from "../../MultiSelect/MultiSelect.vue";
import { defineEmits, defineProps, ref } from "vue";
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
const options = [
  { value: "a", text: "Hipopotamo" },
  { value: "b", text: "Rinoceronte" },
  { value: "c", text: "Cachicamo" },
  { value: "aa", text: "Hipopotamo" },
  { value: "bb", text: "Perro" },
  { value: "cc", text: "Cachicamo" },
  { value: "aas", text: "Gato" },
  { value: "bbs", text: "Rinoceronte" },
  { value: "ccs", text: "Ave" },
];
function handleMultiSelection(selection) {
  emit(
    "onCheckStep",
    2,
    Object.values(selection).find((val) => val)
  );
  emit("onChangeInfo", { ...props.info, instrumentTypes: selection });
}
function skipStep() {
  alert("* the user skipped the step *");
}

function goBack() {
  emit('onChangeStep', 1);
}
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="true">
    <div
      class="
        tw-h-full
        md:tw-h-auto
        tw-w-full tw-flex tw-flex-col tw-items-center
        md:tw-justify-center
        tw-mt-[40px]
        md:tw-mt-0
      "
    >
      <StepHeader
        title="What kind of gear will you be practicing with?"
        :subtitle="`You selected ${info.instrument}! Now it’s time to tell us about
            your practice set-up. You can select multiple gear types and change
            your settings in your profile at anytime.`"
        @onGoBack="goBack"
      />
      <MultiSelect
        :options="options"
        :initialSelection="info.instrumentTypes"
        classOverride="tw-mb-[52px]"
        @onChangeSelection="handleMultiSelection"
      />
    </div>
    <div
      class="
        tw-justify-self-end
        md:tw-justify-self-center
        tw-flex tw-flex-col tw-items-center tw-pb-[20px]
        md:tw-pb-0
      "
    >
      <Button
        :brand="brand"
        @onButtonClick="
          () => {
            emit('onChangeStep', 3);
          }
        "
        :isDisabled="!steps[2].checked"
        classOverride="tw-mx-[16px] tw-w-[90vw] tw-mb-[20px] md:tw-hidden tw-block"
        >Next</Button
      >
      <ProgressBar
        :brand="brand"
        :currentStep="2"
        :steps="steps"
        @onChangeStep="(s) => emit('onChangeStep', s)"
      />
      <Button
        :brand="brand"
        @onButtonClick="
          () => {
            emit('onChangeStep', 3);
          }
        "
        :isDisabled="!steps[2].checked"
        classOverride="md:tw-w-[543px] tw-mt-[40px] tw-hidden md:tw-block"
        >Next</Button
      >
      <SkipStep
        @onSkip="skipStep"
        title="SKIP ACCOUNT SETUP"
        classOverride="tw-mt-[20px] md:tw-mt-0"
      />
    </div>
  </StepWrapper>
</template>
