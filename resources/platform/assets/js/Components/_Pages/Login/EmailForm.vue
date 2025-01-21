<template>
    <form id="loginEmailForm" class="tw-flex tw-flex-col tw-rounded-xl tw-w-full tw-max-w-[400px]">
        <h2 class="tw-text-[24px] tw-leading-[36px] tw-w-full tw-text-center tw-pt-[40px] tw-pb-[30px]">Sign in</h2>
        <ul v-if="hassessionstatus && sessionstatus"
            class="tw-flex tw-flex-col tw-mb-2 tw-text-xs text-success list-style-none">
            <li>{{ sessionstatus }}</li>
        </ul>
        <div class="tw-flex tw-flex-col tw-mb-[20px]">
            <InputLabel :initialValue="emailInput"
                inputOverride="tw-w-full tw-h-[40px] tw-text-[#00101D] tw-text-[14px] tw-leading-[21px]"
                :brand="userStore.brand" inputType="email" id="loginEmail" inputName="email" labelValue="Email address"
                placeholder="Enter your email..." :inputErrors="inputErrors" @onChange="handleEmailChange"
                labelOverride="tw-font-normal" clearButtonOverride="tw-text-black" @onEnter="validateEmail"
                :showClearButton="true" />
        </div>
        <LoginButton :disabled="emailInput.length === 0 || !isValidEmail(emailInput)" type="button" @on-button-click="validateEmail">
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
            <a class="tw-text-white tw-text-[14px] tw-leading-[21px]" :href="orderNowUrl">Join the community here!</a>
        </p>
    </form>
</template>

<script setup>
import { onMounted } from "vue";
import InputLabel from "@units/InputLabel/InputLabel.vue";
import LoginButton from "@units/Button/LoginButton.vue";
import LoadingSpinner from "@units/LoadingSpinner/LoadingSpinner.vue";

const props = defineProps({
    emailError: String,
    hassessionstatus: Boolean,
    sessionstatus: String,
    emailInput: String,
    userStore: Object,
    isLoading: Boolean,
    orderNowUrl: String
});

import { computed } from "vue";

const inputErrors = computed(() => {
    if (props.emailInput && !isValidEmail(props.emailInput)) {
        return "The email must be a valid email address";
    }
    return props.emailError;
});

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

const emit = defineEmits(['email-change', 'validate-email']);

function handleEmailChange(value) {
    emit('email-change', value);
}

function validateEmail() {
    emit('validate-email');
}

onMounted(() => {
    document.getElementById('loginEmail').focus();
});
</script>