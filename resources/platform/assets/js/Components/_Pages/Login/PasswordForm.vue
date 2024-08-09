<template>
    <form id="loginPasswordForm" class="tw-flex tw-flex-col tw-rounded-xl tw-w-full tw-max-w-[423px]">
        <h2 class="tw-text-[24px] tw-leading-[36px] tw-w-full tw-text-center tw-pt-[40px]">Welcome back!</h2>
        <p
            class="tw-w-full tw-text-center tw-text-[14px] tw-leading-[21px] tw-pb-[30px] tw-pt-[10px] tw-text-[#9EC0DC]">
            <span>{{ emailInput }}</span><span>&nbsp;|&nbsp;</span><a
                class="tw-text-white tw-text-[14px] tw-leading-[21px]"
                @click="() => emit('change-form', 'login-email')">Change</a>
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
            @click="() => emit('change-form', 'reset')">Forgot your password?</a>
    </form>
</template>

<script setup>
import { EyeIcon, EyeOffIcon } from '@heroicons/vue/outline'
import InputLabel from "@units/InputLabel/InputLabel.vue";
import LoginButton from "@units/Button/LoginButton.vue";
import LoadingSpinner from "@units/LoadingSpinner/LoadingSpinner.vue";

const props = defineProps({
    emailInput: String,
    passwordError: Array,
    hassessionstatus: Boolean,
    sessionstatus: String,
    userStore: Object,
    isPasswordVisible: Boolean,
    isLoading: Boolean,
    isButtonDisabled: Boolean
});

const emit = defineEmits(['password-change', 'button-click', 'toggle-password', 'change-form']);

function handlePasswordChange(value) {
    emit('password-change', value);
}

function handleButtonClick() {
    emit('button-click');
}

function toggleSeePassword() {
    emit('toggle-password');
}
</script>
