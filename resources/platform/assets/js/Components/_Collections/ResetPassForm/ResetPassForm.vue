<script setup>
import { ref, onMounted, computed } from "vue";
import { EyeIcon, EyeOffIcon } from '@heroicons/vue/outline'
import InputLabel from "@units/InputLabel/InputLabel.vue";
import LoginButton from "@units/Button/LoginButton.vue";
import LoadingSpinner from "@units/LoadingSpinner/LoadingSpinner.vue";
import { brandUrl as brandLogos } from "@constants/brands";

const props = defineProps({
  submiturl: {
    type: String,
    default: "",
  },
  usecsrftoken: {
    type: Boolean,
    default: false,
  },
  errors: {
    type: String,
    default: '',
  },
  token: {
    type: String,
    default: "",
  },
  email: {
    type: String,
    default: "",
  },
  formType: {
    type: String,
    default: "reset",
  },
});

const passwordInput = ref('');
const confirmPasswordInput = ref('');
const passwordErrors = ref('');
const confirmPasswordErrors = ref('');
const isLoading = ref(false);
const isPasswordVisible = ref(false);

const handleConfirmPasswordChange = (val) => {
  if (val.length < 8 && val.length > 0) {
    confirmPasswordErrors.value = 'The password must be at least 8 characters';
  } else if (val !== passwordInput.value) {
    confirmPasswordErrors.value = 'Must match the new password';
  } else {
    confirmPasswordErrors.value = '';
  }
  confirmPasswordInput.value = val;
};

const handlePasswordChange = (val) => {
  if (val.length < 8 && val.length > 0) {
    passwordErrors.value = 'The password must be at least 8 characters';
  }  else {
    passwordErrors.value = '';
  }
  passwordInput.value = val;
};

const handleButtonClick = (e) => {
  isLoading.value = true;
  document.getElementById('hidden-submit').click();
};

const toggleSeePassword = () => {
  isPasswordVisible.value = !isPasswordVisible.value;
};

const isButtonDisabled = computed(() => {
  return passwordInput.value.length === 0 || confirmPasswordInput.value.length === 0 || passwordInput.value !== confirmPasswordInput.value || isLoading.value;
});

const constantTexts = {
  reset: {
    formTitle: 'Create your new password',
    descriptionFirst: 'Create a new password for',
    descriptionLast: '',
    ctaText: 'RESET PASSWORD',
    ctaLoadingText: 'RESETTING PASSWORD...',
  },
  create: {
    formTitle: 'Create your password',
    descriptionFirst: 'Create a password for',
    descriptionLast: 'You’ll use this password to log in to your account.',
    ctaText: 'CREATE YOUR ACCOUNT',
    ctaLoadingText: 'CREATING ACCOUNT...',
  },
};

onMounted(() => {
    document.getElementById('newPassword').focus();
});
</script>

<template>
  <div class="tw-w-full tw-h-[100vh] tw-bg-[#000C17] tw-z-0">
    <div
      class="tw-absolute tw-flex tw-w-full tw-min-h-screen tw-flex-col tw-justify-center tw-items-center tw-text-white tw-z-20 tw-px-[20px]">
      <section id="logoContainer"
        class="tw-w-full tw-flex-col tw-flex tw-items-center tw-text-center tw-border-[#223F57] tw-border-b-[1px] tw-pb-[40px] tw-max-w-[400px]">
        <img class="tw-w-full tw-max-w-[130px] md:tw-max-w-[240px] tw-mb-[15px]"
          src="https://d38h3dn806jqj1.cloudfront.net/logos/musora-white_new.svg" alt="Musora Logo">
        <p class="tw-text-[14px] tw-leading-[21px] tw-text-[#9EC0DC]">The ultimate music lessons experience</p>
        <p class="tw-flex tw-h-[18px] tw-w-full tw-justify-center tw-mt-[4px]">
          <img class="tw-h-[15px] tw-mr-[9px] tw-self-start" :src="brandLogos.drumeo" alt="Drumeo Logo" />
          <img class="tw-h-[15px] tw-mr-[9px] tw-self-center" :src="brandLogos.pianote" alt="Pianote Logo" />
          <img class="tw-h-[16px] tw-mr-[9px] tw-self-end" :src="brandLogos.guitareo" alt="Guitareo Logo" />
          <img class="tw-h-[16px] tw-self-end" :src="brandLogos.singeo" alt="Singeo Logo" />
        </p>
      </section>

      <section class="tw-flex tw-flex-col tw-w-full tw-items-center tw-w-full tw-max-w-[400px]">
        <form method="post" :action="submiturl" class="tw-flex tw-flex-col tw-py-[40px] tw-w-full">
          <slot v-if="usecsrftoken" name="csrf"></slot>
          <input type="hidden" :name="formType === 'create' ? 'verification_token' : 'token'" :value="token">
          <input type="hidden" name="email" :value="email">
          <div class="tw-flex tw-flex-col tw-mb-[20px]">
            <h2 class="tw-text-[24px] tw-leading-[36px] tw-font-bold tw-w-full tw-text-center tw-pb-[10px]">{{ constantTexts[formType].formTitle }}
            </h2>
            <p class="tw-px-[13px] tw-text-[16px] tw-leading-[24px] tw-mb-[30px] tw-text-center">{{ constantTexts[formType].descriptionFirst }} <strong>{{ email }}.</strong> {{ constantTexts[formType].descriptionLast }}</p>
            <InputLabel :inputErrors="passwordErrors" infoMessage="Minimum of 8 characters" inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]"
              :inputType="isPasswordVisible ? 'text' : 'password'" id="newPassword" inputName="password"
              labelValue="Password" placeholder="Enter your password..."
              @onChange="handlePasswordChange" :showCustomButton="true">
              <template #custom-btn>
                <button type="button"
                  class="tw-w-[24px] tw-h-[24px] tw-absolute tw-flex tw-items-center tw-justify-center tw-right-3 tw-text-black"
                  @click="toggleSeePassword">
                  <EyeIcon class="tw-w-[24px] tw-h-[24px]" v-if="!isPasswordVisible" />
                  <EyeOffIcon class="tw-w-[24px] tw-h-[24px]" v-if="isPasswordVisible" />
                </button>
              </template>
            </InputLabel>
          </div>
          <div class="tw-flex tw-flex-col tw-mb-[20px] tw-relative">
            <InputLabel :inputErrors="confirmPasswordErrors" infoMessage="Must match the new password" wrapperOverride="tw-text-[16px]" inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]"
              :inputType="isPasswordVisible ? 'text' : 'password'" id="confirmNewPassword"
              inputName="password_confirmation" labelValue="Confirm password"
              placeholder="Confirm your password..." @onChange="handleConfirmPasswordChange"
              @onEnter="handleButtonClick" :showCustomButton="true">
              <template #custom-btn>
                <button type="button"
                  class="tw-w-[24px] tw-h-[24px] tw-absolute tw-flex tw-items-center tw-justify-center tw-right-3 tw-text-black"
                  @click="toggleSeePassword">
                  <EyeIcon class="tw-w-[24px] tw-h-[24px]" v-if="!isPasswordVisible" />
                  <EyeOffIcon class="tw-w-[24px] tw-h-[24px]" v-if="isPasswordVisible" />
                </button>
              </template>
            </InputLabel>
          </div>

          <LoginButton :disabled="isButtonDisabled" type="button"
            @on-button-click="handleButtonClick">
            <span class="tw-flex tw-justify-center tw-items-center" v-if="isLoading">
              <LoadingSpinner /> {{ constantTexts[formType].ctaLoadingText }}
            </span>
            <span v-if="!isLoading">{{  constantTexts[formType].ctaText }}</span>
          </LoginButton>
          <button id="hidden-submit" type="submit" hidden>Submit</button>
        </form>
      </section>
    </div>
  </div>
</template>

<style type="text/css">
.password-label,
.password_confirmation-label {
  font-weight: 700;
  font-size: 16px;
}
</style>