<script setup>
import AvatarUpload from "../../AvatarUpload/AvatarUpload.vue";
import InputLabel from "../../InputLabel/InputLabel.vue";
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import StepHeader from "../StepHeader.vue";
import SkipStep from "../SkipStep.vue";
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

function onInputChange(value) {
  emit("onChangeInfo", {
    ...props.info,
    user: { ...props.info.user, name: value },
  });
}

function skipStep() {
  alert("* the user skipped the step *");
}
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="false" :showInstrumentBrand="false">
    <div class="tw-h-full md:tw-h-auto tw-w-full tw-flex tw-flex-col tw-items-center md:tw-justify-center tw-mt-[40px] md:tw-mt-0">
      <StepHeader
        title="Just a few quick questions to set up your account"
        subtitle="Your musical journey is personalized to you. Tell us a little bit
            about yourself so that we can get it right."
        :hideBackButton="true"
      />
      <AvatarUpload />
      <InputLabel
        :initialValue="info.user.name"
        labelValue="Display Name"
        placeholder="Enter your display name..."
        classOverride="tw-mb-[56px] tw-w-[90vw] md:tw-w-[471px]"
        @onChange="onInputChange"
      />
    </div>
    <div class="tw-justify-self-end md:tw-justify-self-center tw-flex tw-flex-col tw-items-center tw-pb-[20px] md:tw-pb-0">
      <Button
        :brand="brand"
        @onButtonClick="
          () => {
            emit('onChangeStep', 1);
          }
        "
        :isDisabled="!steps[0].checked"
        classOverride="tw-mx-[16px] tw-w-[90vw] tw-mb-[20px] md:tw-hidden tw-block"
        >Next</Button
      >
      <ProgressBar
        :brand="brand"
        :currentStep="0"
        :steps="steps"
        @onChangeStep="(s) => emit('onChangeStep', s)"
      />
      <Button
        :brand="brand"
        @onButtonClick="
          () => {
            emit('onChangeStep', 1);
          }
        "
        :isDisabled="!steps[0].checked"
        classOverride="md:tw-w-[543px] tw-mt-[40px] tw-hidden md:tw-block"
        >Next</Button
      >
      <SkipStep @onSkip="skipStep" title="SKIP THIS STEP" classOverride="tw-mt-[20px] md:tw-mt-0" />
    </div>
  </StepWrapper>
</template>
