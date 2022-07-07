<script setup>
import { ref } from "vue";
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import StepHeader from "../StepHeader.vue";
import SkipStep from "../SkipStep.vue";
import MultiSelect from "../../MultiSelect/MultiSelect.vue";
import { getMultiSelectOptions } from "../utils";
import { saveGenres } from '../services';

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
    property: 'genres',
    ...props
  })
);

function handleMultiSelection(selection) {
  emit(
    "onCheckStep",
    4,
    !!Object.values(selection).find((val) => val)
  );
  emit("onChangeInfo", { ...props.info, genres: { ...props.info.genres, [props.brand]: selection} });
}

const handleNextStep = () => {
  const data = [];

  Object.entries(props.info.genres[props.brand]).forEach(([type, isChecked]) => {
    if (isChecked) {
      data.push(type);
    }
  })

  saveGenres({
    data,
    brand: props.brand
  }).then(() => {
    emit('onChangeStep', 5);
  }).catch(() => {
    setTimeout(() => {
      showErrorNotification.value = true;
    }, 3000)
  });
};

function goBack() {
  emit('onChangeStep', 3);
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
      <StepHeader title="Great. What kind of songs are you into these days?" 
        @onGoBack="goBack" />
      <MultiSelect
        :options="options"
        :initialSelection="info.genres[brand]"
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
        @onButtonClick="handleNextStep"
        :isDisabled="!steps[4].checked"
        classOverride="tw-mx-[16px] tw-w-[90vw] tw-mb-[20px] md:tw-hidden tw-block"
        >Next</Button
      >
      <ProgressBar
        :brand="brand"
        :currentStep="4"
        :steps="steps"
        @onChangeStep="(s) => emit('onChangeStep', s)"
      />
      <Button
        :brand="brand"
        @onButtonClick="handleNextStep"
        :isDisabled="!steps[4].checked"
        classOverride="md:tw-w-[543px] tw-mt-[40px] tw-hidden md:tw-block"
        >Next</Button
      >
      <SkipStep
        classOverride="tw-mt-[20px] md:tw-mt-0"
      />
    </div>
  </StepWrapper>
</template>
