<template>
    <section id="resetForm" class="tw-flex tw-flex-col tw-rounded-xl tw-w-full tw-max-w-[423px] tw-h-[369px]">
        <h2 class="tw-text-[24px] tw-leading-[36px] tw-w-full tw-text-center tw-pt-[40px]">Forgot your password?</h2>
        <p class="tw-w-full tw-text-[16px] tw-leading-[24px] tw-text-center tw-text-white tw-pt-[10px] tw-mb-[30px]">
            Enter your email address and we will send you instructions to reset your password.
        </p>
        <form method="post" class="tw-flex tw-flex-col">
            <slot v-if="usecsrftoken" name="csrf"></slot>
            <div class="tw-flex tw-flex-col tw-mb-[20px]">
                <InputLabel :initialValue="emailInput"
                    inputOverride="tw-w-full tw-h-[40px] tw-text-[#00101D] tw-text-[14px] tw-leading-[21px]"
                    :brand="userStore.brand" inputType="email" id="resetEmail" inputName="email" labelValue="Email"
                    placeholder="Enter your email..." :inputErrors="[]" @onChange="handleEmailChange"
                    labelOverride="tw-font-normal" clearButtonOverride="tw-text-black" />
            </div>
            <LoginButton @onButtonClick="handleButtonClick" :disabled="!emailInput.length" type="button" label="GET NEW PASSWORD" />
        </form>
        <a id="loginToggle" class="tw-text-[14px] tw-leading-[21px] tw-text-center tw-text-white tw-pt-[40px]"
            @click="() => emit('change-form', 'login-email')">Back to Login</a>
    </section>
</template>

<script setup>
import axios from 'axios';
import InputLabel from "@units/InputLabel/InputLabel.vue";
import LoginButton from "@units/Button/LoginButton.vue";

const props = defineProps({
    emailInput: String,
    reseturl: String,
    usecsrftoken: Boolean,
    userStore: Object
});

const emit = defineEmits(['email-change', 'change-form', 'change-confirmation-screen']);

function handleEmailChange(value) {
    emit('email-change', value);
}

function handleButtonClick(e) {
    e.preventDefault();
    axios.post(props.reseturl, { email: props.emailInput })
        .then(() => {
            emit('change-confirmation-screen', 'reset');
        })
        .catch((e) => {
            console.log('Error sending email', e);
        });
}
</script>
