<template>
    <ModalRenderer v-if="isModalOpen">
        <button class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50" @click="$emit('closeModal')">
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
        </button>

        <div class="tw-bg-white tw-max-w-[800px] tw-w-full tw-p-[30px] tw-rounded-[3px] tw-m-2 lg:tw-m-0">
            <h2 class="subheading tw-mb-3">Login To Drumeo</h2>
            <p class="tw-mb-1">
                To access some of the resources on this page you must be logged in to Drumeo. If you do not have your Drumeo account set up yet, <span class="tw-font-bold tw-underline tw-cursor-pointer" @click="$emit('openRedeemModal')">click here to redeem</span> your free One Month Drumeo Access Pass that came with your copy of the book.
            </p>
            <p class="tw-mb-1">Or login with an existing account below.</p>

            <form @submit.prevent="submitForm" :action="api" method="POST" novalidate="">
                <input type="hidden" name="_method" value="POST" class="has-input">

                <!-- Hidden inputs -->
                <slot name="hidden-inputs"></slot>

                <div class="tw-mb-[10px]">
                    <div class="form-group">
                        <p class="tw-font-bold">Email</p>
                        <input id="emailNew" name="email" type="email" class="tw-caret-black" :class="{'tw-border-[#EF4444] tw-bg-[#FECACA]': errors.email}" autocomplete="off" spellcheck="false">
                        <span v-show="errors.email" class="tw-text-xs tw-text-[#EF4444]" v-text="errors.email"></span>
                    </div>
                </div>
                <div class="tw-mb-[10px]">
                    <div class="form-group">
                        <p class="tw-font-bold">Password</p>
                        <input id="passwordNew" name="password" type="password" class="tw-caret-black" :class="{'tw-border-[#EF4444] tw-bg-[#FECACA]': errors.password}" autocomplete="off" spellcheck="false">
                        <span v-show="errors.password" class="tw-text-xs tw-text-[#EF4444]" v-text="errors.password"></span>
                    </div>
                </div>
                <div>
                    <button
                        class="btn big-text tw-rounded-[25px]"
                        :class="isLoading ? 'tw-bg-[#B2D4F4] tw-text-black' : !isFormValid ? 'tw-bg-[#B91C1C] tw-text-white' : 'tw-bg-drumeo tw-text-white'"
                        type="submit"
                    >
                        <span v-show="!isLoading && isFormValid">Click To Redeem</span>
                        <span v-show="isLoading"><i class="fa-solid fa-spinner mr-1"></i> Loading</span>
                        <span v-show="!isFormValid"><i class="fa-solid fa-rotate-left mr-1"></i> Retry login</span>
                    </button>
                </div>
            </form>
        </div>
    </ModalRenderer>
</template>
<script setup>
import { ref } from "vue";
import { XIcon } from "@heroicons/vue/solid";
import ModalRenderer from "../Modal/ModalRenderer";

const props = defineProps({
    api: {
        type: String,
        default: ''
    },
    isModalOpen: {
        type: Boolean,
        default: false
    },
})

const emits = defineEmits(['closeModal', 'openRedeemModal']);

const isLoading = ref(false);
const isFormValid = ref(true);
const errors = ref({
    email: '',
    password: '',
})

const submitForm = async (event) => {
    errors.value = {
        email: '',
        password: '',
    }
    isFormValid.value = true;
    isLoading.value = true;

    const form = event.target;

    const email = form.email.value;
    const emailFormat = /^\w+([\.-^+]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!email.match(emailFormat)) {
        errors.value.email = 'Email is not a valid email address.';
    }

    const password = form.password.value;
    if (password.length < 8) {
        errors.value.password = 'Password must be at least 8 characters long.';
    }

    Object.keys(errors.value).forEach(key => {
        if (errors.value[key]) {
            isLoading.value = false;
            isFormValid.value = false;
        }
    })

    if (isFormValid.value) {
        form.submit();
    }
}
</script>
