<script setup>
/* TODO:
- Add real reset url
- Define if join url should be out or inside this component
*/

import { ref } from "vue";
import { bgColor } from "../../../constants/brands";
import InputLabel from "../InputLabel/InputLabel.vue";
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
const changeCurrentForm = (val) => {
  currentForm.value = val;
};
</script>

<template>
  <section
    id="loginForm"
    :class="`tw-flex
      tw-flex-col
      tw-bg-[#081825]/[90]
      tw-rounded-xl
      tw-w-[423px]
      tw-min-h-[369px]
      tw-border-[1px]
      tw-border-[#223F57]
      tw-px-[32px]
      ${currentForm !== 'login' ? 'tw-hidden' : ''}`"
  >
    <form
      method="post"
      :action="loginurl"
      class="tw-flex tw-flex-col tw-py-[42px]"
    >
      <slot v-if="usecsrftoken" name="csrf"></slot>
      <ul
        v-if="errors.length > 0"
        class="tw-flex tw-flex-col tw-mb-3 tiny text-error list-style-none"
      >
        <li v-for="(error, i) in errors" v-bind:key="i + 'error'">
          {{ error }}
        </li>
      </ul>
      <ul
        v-if="hassessionstatus && sessionstatus"
        class="tw-flex tw-flex-col tw-mb-2 tiny text-success list-style-none"
      >
        <li>{{ sessionstatus }}</li>
      </ul>
      <div class="tw-flex tw-flex-col tw-mb-[20px]">
        <InputLabel
          inputOverride="tw-w-full tw-h-[50px]"
          :brand="brand"
          inputType="email"
          id="loginEmail"
          inputName="email"
          labelValue="Email Address"
          placeholder="Enter your email..."
          :inputErrors="[]"
        />
      </div>
      <div class="tw-flex tw-flex-col tw-mb-[20px]">
        <InputLabel
          wrapperOverride="tw-text-[16px]"
          inputOverride="tw-w-full tw-h-[50px]"
          :brand="brand"
          inputType="password"
          id="loginPassword"
          inputName="password"
          labelValue="Password"
          placeholder="Enter your password..."
          :inputErrors="[]"
        />
      </div>
      <button
        type="submit"
        class="
          tw-rounded-[25px]
          tw-mb-[20px]
          tw-h-[50px]
          tw-border-[2px]
          tw-text-[#445F74]
          hover:tw-text-white
          tw-border-[#445F74] tw-relative
          login-submit-btn
        "
        dusk="submit-button"
      >
        <span class="tw-font-bebas-neue tw-font-extrabold tw-uppercase"
          >Sign In</span
        >
      </button>
      <a
        id="resetToggle"
        class="text-center text-grey-3 noselect tw-text-[16px]"
        @click="() => changeCurrentForm('reset')"
        >Forgot your password?</a
      >
    </form>
  </section>

  <section
    id="resetForm"
    :class="`tw-flex
      tw-flex-col
      tw-bg-[#081825]/[90]
      tw-rounded-xl
      tw-w-[423px]
      tw-h-[369px]
      tw-border-[1px]
      tw-border-[#223F57]
      tw-py-[42px]
      tw-px-[32px] ${currentForm !== 'reset' ? 'tw-hidden' : ''}`"
  >
    <p class="text-grey-3 tw-mb-[20px]">
      Please enter your email address and we will send you instructions to reset
      your password.
    </p>

    <form
      method="post"
      :action="reseturl"
      class="tw-flex tw-flex-col"
    >
      <slot v-if="usecsrftoken" name="csrf"></slot>
      <div class="tw-flex tw-flex-col tw-mb-[20px]">
        <InputLabel
          inputOverride="tw-w-full tw-h-[50px]"
          :brand="brand"
          inputType="email"
          id="resetEmail"
          inputName="email"
          labelValue="Email Address"
          placeholder="Enter your email..."
          :inputErrors="[]"
        />
      </div>

      <button
        type="submit"
        class="
          tw-rounded-[25px]
          tw-mb-[20px]
          tw-h-[50px]
          tw-border-[2px]
          tw-text-[#445F74]
          hover:tw-text-white
          tw-border-[#445F74] tw-relative
          login-submit-btn
        "
      >
        <span class="tw-font-bebas-neue tw-font-extrabold tw-uppercase"
          >Get New Password</span
        >
      </button>
    </form>

    <a
      id="loginToggle"
      class="tw-text-center text-grey-3 noselect"
      @click="() => changeCurrentForm('login')"
      >Back to Login</a
    >
  </section>
</template>

<style type="text/css">
.login-submit-btn:hover {
  border: none;
}

.loginEmail-label,
.loginPassword-label {
  font-weight: 700;
  font-size: 16px;
}

.login-submit-btn:hover::before {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 25px;
  border: 2px solid transparent;
  background: linear-gradient(
      90.69deg,
      #00c9ac 1.54%,
      #0b76db 30.83%,
      #9a00ee 72.12%,
      #f61a30 95.24%
    )
    border-box;
  -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
  -webkit-mask-composite: xor;
  mask-composite: exclude;
}
</style>