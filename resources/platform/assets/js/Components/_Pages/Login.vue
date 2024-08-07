<script setup>
import { ref, onBeforeMount, computed } from "vue";
import axios from "axios";
import { EyeIcon, EyeOffIcon } from '@heroicons/vue/outline'
import InputLabel from "@units/InputLabel/InputLabel.vue";
import LoginButton from "@units/Button/LoginButton.vue";
import LoadingSpinner from "@units/LoadingSpinner/LoadingSpinner.vue";
import MuButton from "@units/Button/MuButton.vue";
import NotificationToasts from "@vuesora/Components/NotificationToasts/NotificationToasts.vue";
import { brandUrl as brandLogos } from "@constants/brands";

import { useNotificationStore } from '@stores/notification';
import { useUserStore } from "@stores/user";
const userStore = useUserStore();
const notification = useNotificationStore();

const props = defineProps({
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
  orderNowUrl: {
    type: String,
    default: '',
  },
});

const currentForm = ref("login-email");
const emailError = ref('');
const passwordError = ref('');
const emailInput = ref('');
const passwordInput = ref('');
const isLoading = ref(false);
const isPasswordVisible = ref(false);
const isResendButtonDisabled = ref(false);

const changeCurrentForm = (val) => {
  currentForm.value = val;
  emailError.value = '';
  passwordError.value = '';
};

const handleEmailChange = (val) => {
  emailError.value = '';
  emailInput.value = val;
};

const handlePasswordChange = (val) => {
  passwordError.value = '';
  passwordInput.value = val;
};

const handleButtonClick = () => {
  isLoading.value = true;
  localStorage.setItem("lastEmailUsed", emailInput.value);

  axios.post('/user-management-system/login', { email: emailInput.value, password: passwordInput.value })
    .then((response) => {
      if (response.status === 200) {
        const redirectTo = new URLSearchParams(window.location.search).get('redirect_to');
        if (redirectTo) {
          window.location.href = redirectTo;
        } else {
          window.location.href = response.data.redirect_to;
        }
      }
    })
    .catch((e) => {
      isLoading.value = false;
      passwordError.value = "Wrong password. If you’ve forgotten your password, click on “Forgot Your Password?” below to reset it.";
    });
};

const toggleSeePassword = () => {
  isPasswordVisible.value = !isPasswordVisible.value;
};

const isButtonDisabled = computed(() => {
  return !(emailInput && passwordInput && emailInput.value && passwordInput.value && !isLoading.value);
});

onBeforeMount(() => {
  if (localStorage.getItem("lastEmailUsed") && props.errors?.length) {
    emailInput.value = localStorage.getItem("lastEmailUsed");
  }

  let urlParams = new URLSearchParams(window.location.search);

  if (urlParams.has('email')) {
    emailInput.value = urlParams.get('email');
  }

});

const showNotification = (payload) => {
  notification.push(payload);
};

const validateEmail = () => {
  emailError.value = '';
  axios.post('/user-management-system/login/check-email', { email: emailInput.value })
    .then((response) => {
      if (response.data.is_setup) {
        changeCurrentForm('login-password');
      } else {
        changeCurrentForm('setup');
      }
    })
    .catch(() => {
      emailError.value = "This account does not exist. If you believe this is an error, please contact support.";
    });
};

const resendEmail = () => {
  axios.post('/user-management-system/login/send-setup-email', { email: emailInput.value })
    .then(() => {
      isResendButtonDisabled.value = true;

      showNotification({
        icon: 'check',
        text: 'We’ve sent the link to complete your account. Please check your email.'
      });
    })
    .catch(() => {
      showNotification({
        icon: 'error',
        text: 'There was an error processing this request, please try again later.'
      });
    });
};
</script>

<template>
  <div class="tw-w-full tw-h-[100vh] tw-bg-[#000C17] tw-z-0">
    <NotificationToasts :icon="notification.icon" :text="notification.text" :isError="notification.isError"
      :isMembersArea="false" />
    <div
      class="tw-absolute tw-flex tw-w-full tw-min-h-screen tw-flex-col tw-justify-center tw-items-center tw-text-white tw-z-20 tw-px-[20px]">
      <section id="logoContainer"
        class="tw-w-full tw-flex-col tw-flex tw-items-center tw-text-center tw-border-[#223F57] tw-border-b-[1px] tw-pb-[40px]">
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

      <div class="tw-flex tw-flex-col tw-w-full tw-items-center">
        <form v-if="currentForm === 'login-email'" id="loginEmailForm" class="
        tw-flex
        tw-flex-col
        tw-rounded-xl
        tw-w-full
        tw-max-w-[423px]
      ">
          <h2 class="tw-text-[24px] tw-leading-[36px] tw-w-full tw-text-center tw-pt-[40px] tw-pb-[30px]">
            Sign in
          </h2>
          <ul v-if="emailError.length" class="tw-flex tw-flex-col tw-mb-3 tw-text-xs text-error list-style-none">
            {{ emailError }}
          </ul>
          <ul v-if="hassessionstatus && sessionstatus"
            class="tw-flex tw-flex-col tw-mb-2 tw-text-xs text-success list-style-none">
            <li>{{ sessionstatus }}</li>
          </ul>
          <div class="tw-flex tw-flex-col tw-mb-[20px]">
            <InputLabel :initialValue="emailInput"
              inputOverride="tw-w-full tw-h-[40px] tw-text-[#00101D] tw-text-[14px] tw-leading-[21px]"
              :brand="userStore.brand" inputType="email" id="loginEmail" inputName="email" labelValue="Email address"
              placeholder="Enter your email..." :inputErrors="[]" @onChange="handleEmailChange"
              labelOverride="tw-font-normal" clearButtonOverride="tw-text-black" @onEnter="validateEmail"
              :showClearButton="true" />
          </div>

          <LoginButton :disabled="emailInput.length === 0" type="button" @on-button-click="validateEmail">
            <span class="tw-flex tw-justify-center tw-items-center" v-if="isLoading">
              <LoadingSpinner /> NEXT
            </span>
            <span v-if="!isLoading">NEXT</span>
          </LoginButton>
          <div class="tw-flex tw-w-full tw-items-center tw-my-[40px]">
            <hr class="tw-flex-1 tw-border-[#223F57] tw-grow" />
            <span class="tw-mx-[10px] tw-grow-0 tw-text-[#9EC0DC] tw-text-[12px] tw-leading-[18px]">OR</span>
            <hr class="tw-flex-1 tw-border-[#223F57] tw-grow" />
          </div>
          <p class="tw-text-center tw-text-[14px] tw-leading-[21px]">
            <span class="tw-text-[#9EC0DC]">Not a member yet?</span>
            <br />
            <a class="tw-text-white tw-text-[14px] tw-leading-[21px]" :href="orderNowUrl">
              Join the community here!
            </a>
          </p>
        </form>
        <form v-if="currentForm === 'login-password'" id="loginPasswordForm" class="
        tw-flex
        tw-flex-col
        tw-rounded-xl
        tw-w-full
        tw-max-w-[423px]
      ">
          <h2 class="tw-text-[24px] tw-leading-[36px] tw-w-full tw-text-center tw-pt-[40px]">
            Welcome back!
          </h2>
          <p class="tw-w-full tw-text-center tw-text-[14px] tw-leading-[21px] tw-pb-[30px] tw-pt-[10px] tw-text-[#9EC0DC]">
            <span>{{ emailInput }}</span><span>&nbsp;|&nbsp;</span><a class="tw-text-white tw-text-[14px] tw-leading-[21px]" @click="changeCurrentForm('login-email')">Change</a>
          </p>
          <div v-if="passwordError && passwordError.length > 0" class="tw-flex tw-mb-3 tw-text-xs tw-text-pianote">
            {{ passwordError }}
          </div>
          <ul v-if="hassessionstatus && sessionstatus"
            class="tw-flex tw-flex-col tw-mb-2 tw-text-xs text-success list-style-none">
            <li>{{ sessionstatus }}</li>
          </ul>
          <input type="hidden" name="email" :value="emailInput" />
          <div class="tw-flex tw-flex-col tw-mb-[20px] tw-relative">
            <InputLabel wrapperOverride="tw-text-[16px]"
              inputOverride="tw-w-full tw-h-[40px] tw-text-[#00101D] tw-text-[14px] tw-leading-[21px]"
              :brand="userStore.brand" :inputType="isPasswordVisible ? 'text' : 'password'" id="loginPassword"
              inputName="password" labelValue="Password" placeholder="Enter your password..." :inputErrors="[]"
              @onChange="handlePasswordChange" @onEnter="handleButtonClick" :showCustomButton="true"
              labelOverride="tw-font-normal" clearButtonOverride="tw-text-black">
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

          <LoginButton :disabled="isButtonDisabled" type="button" @on-button-click="handleButtonClick">
            <span class="tw-flex tw-justify-center tw-items-center" v-if="isLoading">
              <LoadingSpinner /> SIGNING IN
            </span>
            <span v-if="!isLoading">SIGN IN</span>
          </LoginButton>

          <button id="hidden-submit" type="submit" hidden>Submit</button>

          <a class="tw-text-center tw-text-white tw-text-[14px] tw-leading-[21px] tw-mt-[40px]"
            @click="() => changeCurrentForm('reset')">Forgot your password?</a>
        </form>
        <section v-if="currentForm === 'reset'" id="resetForm" class="
        tw-flex
        tw-flex-col
        tw-rounded-xl
        tw-w-full
        tw-max-w-[423px]
        tw-h-[369px]
      ">
          <h2 class="tw-text-[24px] tw-leading-[36px] tw-w-full tw-text-center tw-pt-[40px]">
            Forgot your password?
          </h2>
          <p class="tw-w-full tw-text-[16px] tw-leading-[24px] tw-text-center tw-text-white tw-pt-[10px] tw-mb-[30px]">
            Enter your email address and we will send you instructions to reset your password.
          </p>

          <form method="post" :action="reseturl" class="tw-flex tw-flex-col">
            <slot v-if="usecsrftoken" name="csrf"></slot>
            <div class="tw-flex tw-flex-col tw-mb-[20px]">
              <InputLabel :initialValue="emailInput"
                inputOverride="tw-w-full tw-h-[40px] tw-text-[#00101D] tw-text-[14px] tw-leading-[21px]"
                :brand="userStore.brand" inputType="email" id="resetEmail" inputName="email" labelValue="Email"
                placeholder="Enter your email..." :inputErrors="[]" @onChange="handleEmailChange"
                labelOverride="tw-font-normal" clearButtonOverride="tw-text-black" />
            </div>
            <LoginButton :disabled="!emailInput.length" type="submit" label="GET NEW PASSWORD" />
          </form>

          <a id="loginToggle" class="tw-text-[14px] tw-leading-[21px] tw-text-center tw-text-white tw-pt-[40px]"
            @click="() => changeCurrentForm('login-email')">Back
            to
            Login</a>
        </section>
        <section v-if="currentForm === 'setup'" id="setupForm" class="
        tw-flex
        tw-flex-col
        tw-rounded-xl
        tw-w-full
        tw-max-w-[423px]
        tw-text-center
      ">
          <h2 class="tw-font-bold tw-text-[20px] tw-leading-[30px] tw-mb-[30px]">You're almost there!</h2>
          <p class="tw-mb-[30px]">
            We’ve sent the link to complete your account to <strong>{{ emailInput }}</strong>
            <br /><br />
            Didn’t get it? Please check your spam or resend the email link to try again.
          </p>
          <MuButton styleType="secondary"
            class="tw-bg-[#081825] tw-border-[2px] tw-border-white hover:tw-bg-white tw-text-white hover:tw-text-[#081825]"
            :disabled="isResendButtonDisabled" @click="resendEmail">RESEND EMAIL
          </MuButton>
        </section>
      </div>
    </div>
  </div>
</template>

<style type="text/css">
.loginEmail-label,
.loginPassword-label {
  font-weight: 700;
  font-size: 16px;
}
</style>
