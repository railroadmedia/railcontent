<template>
    <div
        @click="closeModal"
        id="modal-overlay"
        class="tw-fixed tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-[rgba(0,12,23,0.75)] tw-z-[150]"
    ></div>
    <div id="modal-wrapper" @click="onWrapperClick"
         class="tw-absolute tw-flex tw-flex-wrap tw-h-screen tw-w-full tw-items-center tw-justify-center tw-top-0 tw-left-0 tw-z-[150]"
    >
        <button
            class="tw-text-white tw-absolute tw-right-2 tw-top-[60px] lg:tw-top-[90px] lg:tw-right-[48px] tw-z-[150]"
            @click="closeModal"
        >
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
        </button>

        <div class="tw-bg-white tw-max-w-[800px] tw-w-full tw-p-[30px] tw-rounded-[3px] tw-m-2 lg:tw-m-0">
            <h2 class="subheading tw-mb-[30px]">Redeem Your Drumeo Access Pass</h2>
            <div class="sm:tw-flex sm:tw-flex-wrap">
                <button
                    v-if="!isUser"
                    :class="`tw-block change-form body tw-uppercase tw-mb-[10px] sm:tw-mr-[15px] ${isNewAccount ? 'tw-text-drumeo tw-border-b tw-border-[#0B76DB] tw-font-bold' : 'tw-text-[#ccd3d3]'}`"
                    @click="isNewAccount = true">Create New Account
                </button>
                <button
                    :class="`tw-block change-form body tw-uppercase  tw-mb-[10px] sm:tw-mr-[15px] ${!isNewAccount ? 'tw-text-drumeo tw-border-b tw-border-[#0B76DB] tw-font-bold' : 'tw-text-[#ccd3d3]'}`"
                    @click="isNewAccount = false">Add to My Account
                </button>
            </div>
            <p class="tw-mb-1">
                Fill out the form below to start your 30-Day Drumeo Membership.
            </p>

            <form @submit.prevent="submitForm" action="https://www.musora.com/ecommerce/access-codes/redeem"
                  method="POST" novalidate="">
                <input type="hidden" name="_method" value="POST" class="has-input">
                <input type="hidden" name="credentials_type" :value="isNewAccount ? 'new' : 'existing'">
                <input v-if="!isNewAccount && isUser" type="hidden" name="claim_for_user_id" :value="user.id">

                <!-- Hidden inputs -->
                <slot name="hidden-inputs"></slot>
                <input v-if="isUser" type="hidden" name="_token" :value="token" class="has-input">

                <div class="tw-mb-[10px]">
                    <div class="form-group">
                        <p class="tw-font-bold">Access Code</p>
                        <input id="accessCodeNew" name="access_code" type="text" class="tw-caret-black"
                               :class="{'tw-border-[#EF4444] tw-bg-[#FECACA]': errors.access_code}" autocomplete="off"
                               spellcheck="false" :disabled="isLoading" placeholder="XXXX - XXXX - XXXX - XXXX - XXXX - XXXX" maxlength="24" >
                        <span v-show="errors.access_code" class="tw-text-xs tw-text-[#EF4444]"
                              v-text="errors.access_code"></span>
                    </div>
                </div>
                <div v-if="isNewAccount || !isUser" class="tw-mb-[10px]">
                    <div class="form-group">
                        <p class="tw-font-bold">Email</p>
                        <input id="emailNew" name="email" type="email" class="tw-caret-black"
                               :class="{'tw-border-[#EF4444] tw-bg-[#FECACA]': errors.email}" autocomplete="off"
                               spellcheck="false" :disabled="isLoading" >
                        <span v-show="errors.email" class="tw-text-xs tw-text-[#EF4444]" v-text="errors.email"></span>
                    </div>
                </div>
                <div v-if="isNewAccount || !isUser" class="tw-mb-[10px]">
                    <div class="form-group">
                        <p class="tw-font-bold">Password <span v-if="isNewAccount">(min. 8 characters)</span></p>
                        <input id="passwordNew" name="password" type="password" class="tw-caret-black"
                               :class="{'tw-border-[#EF4444] tw-bg-[#FECACA]': errors.password}" autocomplete="off"
                               spellcheck="false" :disabled="isLoading" >
                        <span v-show="errors.password" class="tw-text-xs tw-text-[#EF4444]"
                              v-text="errors.password"></span>
                    </div>
                </div>
                <div v-if="isNewAccount" class="tw-mb-[10px]">
                    <div class="form-group">
                        <p class="tw-font-bold">Confirm Password</p>
                        <input id="confirmPasswordNew" name="password_confirmation" type="password"
                               class="tw-caret-black"
                               :class="{'tw-border-[#EF4444] tw-bg-[#FECACA]': errors.passwordCheck}" autocomplete="off"
                               spellcheck="false" :disabled="isLoading" >
                        <span v-show="errors.passwordCheck" class="tw-text-xs tw-text-[#EF4444]"
                              v-text="errors.passwordCheck"></span>
                    </div>
                </div>
                <div>
                    <button
                        class="btn big-text tw-rounded-[25px]"
                        :class="isLoading ? 'tw-bg-[#B2D4F4] tw-text-black' : !isFormValid ? 'tw-bg-[#B91C1C] tw-text-white' : isSubmitted ? 'tw-bg-[#15803D] tw-text-white' : 'tw-bg-drumeo tw-text-white'"
                        type="submit"
                        :disabled="isLoading"
                    >
                        <span v-show="!isLoading && isFormValid && !isSubmitted">Click To Redeem</span>
                        <span v-show="isLoading"><i class="fa-solid fa-spinner mr-1"></i> Loading</span>
                        <span v-show="!isFormValid"><i class="fa-solid fa-rotate-left mr-1"></i> Retry submission</span>
                        <span v-show="isSubmitted"><i class="fa-solid fa-check mr-1"></i>Successfully Submitted</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import {computed, inject, onBeforeMount, ref} from "vue";
import ModalRenderer from "../Modal/ModalRenderer";
import {XIcon} from "@heroicons/vue/solid";

const props = defineProps({
    api: {
        type: String,
        default: ''
    },
    isModalOpen: {
        type: Boolean,
        default: false
    },
    isUser: {
        type: Boolean,
        default: false
    },
    user: {
        type: Object,
        default: {}
    },
})

const emit = defineEmits(['closeModal']);

const token = computed(() => {
    return props.isUser && inject('csrf_token');
})

const isNewAccount = ref(true);
const isLoading = ref(false);
const isFormValid = ref(true);
const isSubmitted = ref(false);
const errors = ref({
    access_code: '',
    email: '',
    password: '',
    passwordCheck: '',
})

const onWrapperClick = (event) => {
    if (event.target.id === 'modal-wrapper') {
        closeModal();
    }
}

const closeModal = () => {
    errors.value = {
        access_code: '',
        email: '',
        password: '',
        passwordCheck: '',
    }

    isFormValid.value = true;
    isLoading.value = false;
    isSubmitted.value = false;
    emit('closeModal');
}

const submitForm = async (event) => {
    errors.value = {
        access_code: '',
        email: '',
        password: '',
        passwordCheck: '',
    }
    isFormValid.value = true;
    isLoading.value = true;
    isSubmitted.value = false;

    const form = event.target;

    //validation
    const access_code = form.access_code.value;
    if (!access_code.replaceAll(' ', '') || access_code.length < 24) {
        errors.value.access_code = 'Code is not valid.';
    }

    if (isNewAccount.value || !props.isUser) {
        const email = form.email.value;
        const emailFormat = /^\w+([\.-^+]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!email.match(emailFormat)) {
            errors.value.email = 'Email is not a valid email address.';
        }

        const password = form.password.value;
        if (password.length < 8) {
            errors.value.password = 'Password must be at least 8 characters long.';
        }

        if (isNewAccount.value) {
            const passwordCheck = form.password_confirmation.value;
            if (!passwordCheck) {
                errors.value.passwordCheck = 'Password must be confirmed.';
            } else if (password !== passwordCheck) {
                errors.value.passwordCheck = 'Passwords do not match.';
            }
        }
    }

    Object.keys(errors.value).forEach(key => {
        if (errors.value[key]) {
            isLoading.value = false;
            isFormValid.value = false;
        }
    })

    if (isFormValid.value) {
        const data = new FormData(form);

        const response = await fetch(props.api, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                ...Object.fromEntries(data),
            })
        })

        const result = await response.json();
        isLoading.value = false;

        if (result.errors) {
            isFormValid.value = false;
            Object.keys(result.errors).forEach(key => {
                errors.value[key] = result.errors[key][0];
            })
        } else if(result.error){
            isFormValid.value = false;
            errors.value['email'] = 'Invalid credentials.';
            errors.value['password'] = 'Invalid credentials.';

        } else {
            isSubmitted.value = true;

            if(!props.isUser){
                if(isNewAccount.value){
                    window.location.replace('/drumeo');
                } else {
                    location.reload();
                }
            } else {
                closeModal();
            }
        }
    }
}

onBeforeMount(() => {
    if (props.isUser) {
        isNewAccount.value = false;
    }
})
</script>
