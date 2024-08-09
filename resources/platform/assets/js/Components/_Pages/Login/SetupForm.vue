<template>
    <section id="setupForm" class="tw-flex tw-flex-col tw-rounded-xl tw-w-full tw-max-w-[423px] tw-text-center">
        <h2 class="tw-font-bold tw-text-[20px] tw-leading-[30px] tw-mb-[30px]">You're almost there!</h2>
        <p class="tw-mb-[30px]">
            We’ve sent the link to complete your account to <strong>{{ emailInput }}</strong>
            <br /><br />
            Didn’t get it? Please check your spam or resend the email link to try again.
        </p>
        <MuButton styleType="secondary"
            class="tw-bg-[#081825] tw-border-[2px] tw-border-white hover:tw-bg-white tw-text-white hover:tw-text-[#081825]"
            :disabled="isResendButtonDisabled" @click="resendEmail">RESEND EMAIL</MuButton>
    </section>
</template>

<script setup>
import MuButton from "@units/Button/MuButton.vue";

const props = defineProps({
    emailInput: String,
    isResendButtonDisabled: Boolean
});

const emit = defineEmits(['resend-email']);

function resendEmail() {
    emit('resend-email');
}
</script>
