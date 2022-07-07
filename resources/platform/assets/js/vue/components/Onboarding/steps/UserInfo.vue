<script setup>
import { ref, onMounted } from 'vue';
import AvatarUpload from "../../AvatarUpload/AvatarUpload.vue";
import InputLabel from "../../InputLabel/InputLabel.vue";
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import StepHeader from "../StepHeader.vue";
import NotificationToast from "../../NotificationToastV2/NotificationToast.vue"
import { saveDisplayName } from '../services';

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
const showErrorNotification = ref(false);

const onInputChange = (value) => {
  emit("onChangeInfo", {
    ...props.info,
    user: { ...props.info.user, name: value },
  });
}

const hideErrorNotification = () => {
  showErrorNotification.value = false;
};

const handleSkipStep = () => {
  emit('onChangeStep', 1);
  emit('onCheckStep', 0, true);
};

const handleNextStep = () => {
  saveDisplayName({
    name: props.info.user.name,
    userId: props.info.user.id,
  }).then((res) => {
    emit('onChangeStep', 1);
    emit('onCheckStep', 0, true);
  }).catch(() => {
    showErrorNotification.value = true;
  });
};

const handleUploadError = () => {
  showErrorNotification.value = true;
};

</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="false" :showInstrumentBrand="false">
    <div
      class="tw-h-full md:tw-h-auto tw-w-full tw-flex tw-flex-col tw-items-center md:tw-justify-center tw-mt-[40px] md:tw-mt-0">
      <StepHeader title="Just a few quick questions to set up your account" subtitle="Your musical journey is personalized to you. Tell us a little bit
            about yourself so that we can get it right." :hideBackButton="true" />
      <AvatarUpload :imgUrl="info.user.avatarUrl" :userName="info.user.name" @onError="handleUploadError"
        :userId="info.user.id" />
      <InputLabel labelOverride="tw-text-white" wrapperOverride="tw-mb-[56px]" :initialValue="info.user.name"
        labelValue="Display Name" placeholder="Enter your display name..." inputOverride="tw-w-[90vw] md:tw-w-[471px]"
        @onChange="onInputChange" :showClearButton="true" />
    </div>
    <div
      class="tw-justify-self-end md:tw-justify-self-center tw-flex tw-flex-col tw-items-center tw-pb-[20px] md:tw-pb-0">
      <Button :brand="brand" @onButtonClick="handleNextStep"
        :isDisabled="!info.user.avatarUrl.length && !info.user.name.length"
        classOverride="tw-mx-[16px] tw-w-[90vw] tw-mb-[20px] md:tw-hidden tw-block">Next</Button>
      <ProgressBar :brand="brand" :currentStep="0" :steps="steps" @onChangeStep="(s) => emit('onChangeStep', s)" />
      <Button :brand="brand" @onButtonClick="handleNextStep"
        :isDisabled="!info.user.avatarUrl.length && !info.user.name.length"
        classOverride="md:tw-w-[543px] tw-mt-[40px] tw-hidden md:tw-block">Next</Button>
      <button class="tw-mt-[20px] md:tw-mt-0 tw-text-[18px] tw-text-white tw-underline tw-font-bebas-neue"
        @click="handleSkipStep">
        SKIP THIS STEP
      </button>
    </div>
    <NotificationToast v-if="showErrorNotification"
      text="Hmm, something has gone wrong. Your information has been saved up to this point."
      @onHide="hideErrorNotification" classOverride="tw-bg-[#002039] tw-text-white tw-opacity-95">
    </NotificationToast>
  </StepWrapper>
</template>
