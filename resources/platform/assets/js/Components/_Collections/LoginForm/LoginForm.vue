<script setup>
import { ref, onBeforeMount, computed } from "vue";
import { EyeIcon, EyeOffIcon } from '@heroicons/vue/outline'
import InputLabel from "@units/InputLabel/InputLabel.vue";
import LoginButton from "@units/Button/LoginButton.vue";
import LoadingSpinner from "@units/LoadingSpinner/LoadingSpinner.vue";

const props = defineProps({
  brand: {
    type: String,
  },
  loginurl: {
    type: String,
  },
  reseturl: {
    type: String,
  },
  joinurl: {
    type: String,
  },
  usecsrftoken: {
    type: Boolean,
  },
  errors: {
    type: Array,
  },
  hassessionstatus: {
    type: Boolean,
    default: false,
  },
  sessionstatus: {
    type: String,
    default: "",
  },
});

const currentForm = ref("login");
const emailInput = ref('');
const passwordInput = ref('');
const isLoading = ref(false);
const isPasswordVisible = ref(false);

const changeCurrentForm = (val) => {
  currentForm.value = val;
};

const handleEmailChange = (val) => {
  emailInput.value = val;
};

const handlePasswordChange = (val) => {
  passwordInput.value = val;
};

const handleButtonClick = (e) => {
  isLoading.value = true;
  localStorage.setItem("lastEmailUsed", emailInput.value);
  document.getElementById('hidden-submit').click();
};

const toggleSeePassword = () => {
  isPasswordVisible.value = !isPasswordVisible.value;
};

const isButtonDisabled = computed(() => {
  return !(emailInput && passwordInput && emailInput.value && passwordInput.value && !isLoading.value);
});

onBeforeMount(() => {
  if(localStorage.getItem("lastEmailUsed") && props.errors?.length) {
    emailInput.value = localStorage.getItem("lastEmailUsed");
  }

  let urlParams = new URLSearchParams(window.location.search);

  if(urlParams.has('email')) {
      emailInput.value = urlParams.get('email');
  }

});
</script>

<template>
  <div class="tw-flex tw-flex-col tw-w-full tw-px-4 tw-items-center">
    <section
      v-if="currentForm === 'login'"
      id="loginForm"
      class="
        tw-flex
        tw-flex-col
        tw-bg-[#081825]/[90]
        tw-rounded-xl
        tw-w-full
        tw-max-w-[423px]
        tw-min-h-[369px]
        tw-border-[1px]
        tw-border-[#445F74]
        tw-px-[32px]
      "
    >
      <form
        method="post"
        :action="loginurl"
        class="tw-flex tw-flex-col tw-py-[42px]"
      >
        <slot v-if="usecsrftoken" name="csrf"></slot>
        <ul
          v-if="errors && errors.length > 0"
          class="tw-flex tw-flex-col tw-mb-3 tw-text-xs text-error list-style-none"
        >
          <li v-for="(error, i) in errors" v-bind:key="i + 'error'">
            {{ error }}
          </li>
        </ul>
        <ul
          v-if="hassessionstatus && sessionstatus"
          class="tw-flex tw-flex-col tw-mb-2 tw-text-xs text-success list-style-none"
        >
          <li>{{ sessionstatus }}</li>
        </ul>
        <div class="tw-flex tw-flex-col tw-mb-[20px]">
          <InputLabel
            :initialValue="emailInput"
            inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]"
            :brand="brand"
            inputType="email"
            id="loginEmail"
            inputName="email"
            labelValue="Email Address"
            placeholder="Enter your email..."
            :inputErrors="[]"
            @onChange="handleEmailChange"
          />
        </div>
        <div class="tw-flex tw-flex-col tw-mb-[20px] tw-relative">
          <InputLabel
            wrapperOverride="tw-text-[16px]"
            inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]"
            :brand="brand"
            :inputType="isPasswordVisible ? 'text' : 'password'"
            id="loginPassword"
            inputName="password"
            labelValue="Password"
            placeholder="Enter your password..."
            :inputErrors="[]"
            @onChange="handlePasswordChange"
            @onEnter="handleButtonClick"
            :showCustomButton="true"
          >
          <template #custom-btn>
            <button
              type="button"
              class="tw-w-[24px] tw-h-[24px] tw-absolute tw-flex tw-items-center tw-justify-center tw-right-3 tw-text-black"
              @click="toggleSeePassword"
            >
              <EyeIcon class="tw-w-[24px] tw-h-[24px]" v-if="!isPasswordVisible" />
              <EyeOffIcon class="tw-w-[24px] tw-h-[24px]" v-if="isPasswordVisible" />
            </button>
          </template>
          </InputLabel>
        </div>

        <LoginButton :disabled="isButtonDisabled" type="button" @on-button-click="handleButtonClick">
          <span class="tw-flex tw-justify-center tw-items-center" v-if="isLoading"><LoadingSpinner /> SIGNING IN</span>
          <span v-if="!isLoading">SIGN IN</span>
        </LoginButton>

        <button id="hidden-submit" type="submit" hidden>Submit</button>
        <a
          id="resetToggle"
          class="text-center text-grey-3 noselect tw-text-[16px]"
          @click="() => changeCurrentForm('reset')"
          >Forgot your password?</a
        >
      </form>
    </section>
    <section
      v-if="currentForm === 'reset'"
      id="resetForm"
      class="
        tw-flex
        tw-flex-col
        tw-bg-[#081825]/[90]
        tw-rounded-xl
        tw-w-full
        tw-max-w-[423px]
        tw-h-[369px]
        tw-border-[1px]
        tw-border-[#445F74]
        tw-py-[42px]
        tw-px-[32px]
      "
    >
      <p class="text-grey-3 tw-mb-[20px]">
        Please enter your email address and we will send you instructions to reset
        your password.
      </p>

      <form method="post" :action="reseturl" class="tw-flex tw-flex-col">
        <slot v-if="usecsrftoken" name="csrf"></slot>
        <div class="tw-flex tw-flex-col tw-mb-[20px]">
          <InputLabel
            :initialValue="emailInput"
            inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]"
            :brand="brand"
            inputType="email"
            id="resetEmail"
            inputName="email"
            labelValue="Email Address"
            placeholder="Enter your email..."
            :inputErrors="[]"
            @onChange="handleEmailChange"
          />
        </div>
        <LoginButton :disabled="!emailInput.length" type="submit" label="GET NEW PASSWORD" />
      </form>

      <a
        id="loginToggle"
        class="tw-text-center text-grey-3 noselect"
        @click="() => changeCurrentForm('login')"
        >Back to Login</a
      >
    </section>
  </div>
</template>

<style type="text/css">
.loginEmail-label,
.loginPassword-label {
  font-weight: 700;
  font-size: 16px;
}
</style>