<script setup>
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import StepHeader from "../StepHeader.vue";
import CoachCarousel from "../../CoachCarousel/CoachCarousel.vue";
import InputLabel from "../../InputLabel/InputLabel.vue";
import { SearchIcon } from "@heroicons/vue/solid";
import { useDebounceFn } from "../../../hooks/debounce/useDebounce";
import { searchCoaches, transformCoachesCardData } from "../../../utils";
import { ref, onMounted } from "vue";

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

const coachResults = ref([]);

const handleCoachSearch = (value) => {
  searchCoaches(props.brand, value).then((result) => {
    coachResults.value = transformCoachesCardData(result);
  });
};

onMounted(() => {
  handleCoachSearch();
});

const debouncedSearch = useDebounceFn((value) => {
  handleCoachSearch(value);
}, 350);

const onInputChange = (value) => {
  debouncedSearch(value);
};

function goBack() {
  emit("onChangeStep", 5);
}

const handleRedirect = () => {
    window.location.href = '/members'
};
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
        title="Finally, choose your coaches."
        subtitle="Here are some coaches we think you’ll like based on your experience and
      genre preferences. When you follow a coach you will get notified when they
      release new content."
        @onGoBack="goBack"
      />
      <div
        class="
          tw-relative tw-h-[42px] tw-mb-[20px]
          md:tw-mb-[40px]
          tw-w-[90vw]
          md:tw-w-[600px]
        "
      >
        <InputLabel
          placeholder="Find a coach..."
          inputOverride="tw-text-white tw-w-full tw-bg-[#002039]/90 tw-absolute tw-pl-[36px] tw-box-border"
          @onChange="onInputChange"
        />
        <SearchIcon
          class="
            tw-absolute
            tw-w-[16px]
            tw-h-[16px]
            tw-text-[#7E9AB1]
            tw-mt-[14px]
            tw-ml-[14px]
          "
        />
      </div>
      <CoachCarousel :brand="brand" :coachResults="coachResults" />
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
            emit('onChangeStep', 1);
          }
        "
        :isDisabled="!steps[0].checked"
        classOverride="tw-mx-[16px] tw-w-[90vw] tw-mb-[20px] tw-uppercase md:tw-hidden tw-block"
        >Complete Your Account</Button
      >
      <ProgressBar
        :brand="brand"
        :currentStep="6"
        :steps="steps"
        @onChangeStep="(s) => emit('onChangeStep', s)"
      />
      <Button
        :brand="brand"
        @onButtonClick="handleRedirect"
        :isDisabled="!steps[0].checked"
        classOverride="md:tw-w-[543px] tw-uppercase tw-mt-[40px] tw-hidden md:tw-block"
        >Complete Your Account</Button
      >
    </div>
  </StepWrapper>
</template>