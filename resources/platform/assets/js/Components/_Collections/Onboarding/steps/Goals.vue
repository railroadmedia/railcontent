<script setup>
import { ref } from "vue";
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "@units/Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import Branding from "../Branding.vue";
import { getMultiSelectOptions } from "../utils";
import { saveGoals } from "../services";
import MultiSelect from "../../MultiSelect/MultiSelect.vue";

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
  },
  currentStep: {
    type: Number,
  },
});

const emit = defineEmits(["onChangeStep", "onCheckStep", "onChangeInfo"]);

const options = getMultiSelectOptions({
  property: 'goals',
  ...props
});

const currentSelection = ref(props.info.goals[props.brand]);

function handleSelect(selection) {
  currentSelection.value = selection;
}

function goBack() {
  emit('onChangeStep', props.currentStep - 1);
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
  const data = [];

  emit("onChangeInfo", { ...props.info, goals: { ...props.info.goals, [props.brand]: currentSelection.value } });

  Object.entries(currentSelection.value).forEach(([type, isChecked]) => {
    if (isChecked) {
      data.push(type);
    }
  })

  saveGoals({
    goals: data,
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
  title: "Before we finish, let's select your goals!",
  hideCloseButton: true,
};
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="true" @on-header-go-back="goBack" :headerProps="headerProps"
    :hideBranding="true" topPaddingClasses="tw-pt-[24px] md:tw-pt-[40px]">
    <template v-slot:content>
      <div class="
        tw-w-full tw-min-h-full tw-flex tw-flex-col tw-items-center
        tw-justify-between
        xl:tw-justify-center
        tw-px-[18px]
        lg:tw-pb-[80px]
      ">
        <MultiSelect :bigOption="true" :options="options" :initialSelection="currentSelection" @onChangeSelection="handleSelect">
        </MultiSelect>
      </div>
    </template>
    <template v-slot:footer>
      <Button :brand="brand" @onButtonClick="handleRedirect" :isDisabled="isNextButtonDisabled()"
        classOverride="tw-mx-[16px] tw-w-[90vw] tw-mb-[20px] md:tw-hidden tw-block">GET STARTED
      </Button>
      <ProgressBar :brand="brand" :currentStep="props.currentStep" :steps="steps" @onChangeStep="(s) => emit('onChangeStep', s)" />
      <Button :brand="brand" @onButtonClick="handleRedirect" :isDisabled="isNextButtonDisabled()"
        classOverride="md:tw-w-[543px] tw-mt-[40px] tw-hidden md:tw-block">GET STARTED
      </Button>
      <Branding :brand="brand" :showInstrumentBrand="true" classOverride="tw-pt-[12px]" />
    </template>
  </StepWrapper>
</template>