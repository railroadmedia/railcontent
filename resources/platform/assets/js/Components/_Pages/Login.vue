<script setup>
import { ref, onBeforeMount, computed } from "vue";
import axios from "axios";
import NotificationToasts from "@vuesora/Components/NotificationToasts/NotificationToasts.vue";
import EmailForm from "./Login/EmailForm.vue";
import PasswordForm from "./Login/PasswordForm.vue";
import ResetForm from "./Login/ResetForm.vue";
import SetupForm from "./Login/SetupForm.vue";
import { brandUrl as brandLogos } from "@constants/brands";

// TODO: SPLIT INTO STEP COMPONENTS

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
      passwordError.value = "Incorrect password. Try again or reset it below.";
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
      console.log('error');
      emailError.value = "We can't find your account. Click below to join!";
      console.log(emailError.value);
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

      <div class="tw-flex tw-flex-col tw-w-full tw-items-center">
        <EmailForm v-if="currentForm === 'login-email'" :emailError="emailError"
          :hassessionstatus="hassessionstatus" :sessionstatus="sessionstatus" :emailInput="emailInput"
          :userStore="userStore" :isLoading="isLoading" :orderNowUrl="orderNowUrl" @email-change="handleEmailChange"
          @validate-email="validateEmail" />
        <PasswordForm v-if="currentForm === 'login-password'" :emailInput="emailInput"
          :passwordError="passwordError" :hassessionstatus="hassessionstatus" :sessionstatus="sessionstatus"
          :userStore="userStore" :isPasswordVisible="isPasswordVisible" :isLoading="isLoading"
          :isButtonDisabled="isButtonDisabled" @password-change="handlePasswordChange" @button-click="handleButtonClick"
          @toggle-password="toggleSeePassword" @change-form="changeCurrentForm" />
        <ResetForm v-if="currentForm === 'reset'" :emailInput="emailInput" :reseturl="reseturl"
          :usecsrftoken="usecsrftoken" :userStore="userStore" @email-change="handleEmailChange"
          @change-form="changeCurrentForm" />
        <SetupForm v-if="currentForm === 'setup'" :emailInput="emailInput"
          :isResendButtonDisabled="isResendButtonDisabled" @resend-email="resendEmail" />
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
