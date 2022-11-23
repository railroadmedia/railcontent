<script setup>
import { ref } from "vue";
import { EyeIcon, EyeOffIcon } from '@heroicons/vue/outline'
import InputLabel from "../InputLabel/InputLabel.vue";
import LoginButton from "../Button/LoginButton.vue";
import LoadingSpinner from "../LoadingSpinner/LoadingSpinner.vue";

const props = defineProps({
  reseturl: {
    type: String,
    default: "",
  },
  usecsrftoken: {
    type: Boolean,
    default: false,
  },
  errors: {
    type: Array,
    default: [],
  },
  resettoken: {
    type: String,
    default: "",
  },
  email: {
    type: String,
    default: "",
  },
});

const passwordInput = ref('');
const confirmPasswordInput = ref('');
const isLoading = ref(false);
const isPasswordVisible = ref(false);

const handleConfirmPasswordChange = (val) => {
  confirmPasswordInput.value = val;
};

const handlePasswordChange = (val) => {
  passwordInput.value = val;
};

const handleButtonClick = (e) => {
  isLoading.value = true;
  document.getElementById('hidden-submit').click();
};

const toggleSeePassword = () => {
  isPasswordVisible.value = !isPasswordVisible.value;
};
</script>

<template>
  <div>
    <section id="resetPasswordForm" class="
        tw-flex
        tw-flex-col
        tw-bg-[#081825]/[90]
        tw-rounded-xl
        tw-w-[423px]
        tw-min-h-[369px]
        tw-border-[1px]
        tw-border-[#445F74]
        tw-px-[32px]
      ">
      <form method="post" :action="reseturl" class="tw-flex tw-flex-col tw-py-[42px]">
        <ul v-if="errors.length > 0" class="tw-flex tw-flex-col tw-mb-3 text-error list-style-none tw-px-[13px]">
          <li v-for="(error, i) in errors" v-bind:key="i + 'error'">
            {{ error }}
          </li>
        </ul>
        <slot v-if="usecsrftoken" name="csrf"></slot>
        <input type="hidden" name="token" :value="resettoken">
        <input type="hidden" name="email" :value="email">
        <div class="tw-flex tw-flex-col tw-mb-[20px]">
          <p class="tw-mb-3 tw-px-[13px]">Reset password for: <br><strong>{{ email }}</strong></p>
          <InputLabel inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]"
            :inputType="isPasswordVisible ? 'text' : 'password'" id="newPassword" inputName="password"
            labelValue="New Password (8 characters min)" placeholder="Enter your new password..." :inputErrors="[]"
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
          <InputLabel wrapperOverride="tw-text-[16px]" inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]"
            :inputType="isPasswordVisible ? 'text' : 'password'" id="confirmNewPassword"
            inputName="password_confirmation" labelValue="Confirm New Password" placeholder="Confirm your new password..."
            :inputErrors="[]" @onChange="handleConfirmPasswordChange" @onEnter="handleButtonClick"
            :showCustomButton="true">
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

        <LoginButton :disabled="!confirmPasswordInput.length || isLoading" type="button"
          @on-button-click="handleButtonClick">
          <span class="tw-flex tw-justify-center tw-items-center" v-if="isLoading">
            <LoadingSpinner /> RESETTING...
          </span>
          <span v-if="!isLoading">RESET</span>
        </LoginButton>
        <button id="hidden-submit" type="submit" hidden>Submit</button>
      </form>
    </section>
  </div>
</template>

<style type="text/css">
.password-label,
.password_confirmation-label {
  font-weight: 700;
  font-size: 16px;
}
</style>