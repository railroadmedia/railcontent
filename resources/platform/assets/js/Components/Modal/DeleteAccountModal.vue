<template>
    <ModalRenderer>
        <div class="tw-max-w-[600px] tw-w-full tw-p-[30px] tw-border tw-border-[#223F57] tw-rounded-xl tw-text-white tw-bg-[#081825]">
            <template v-if="step === '1'">
                <div class="tw-flex tw-justify-between tw-items-center">
                    <h1 class="tw-text-white tw-font-extrabold tw-text-2xl">Delete Account</h1>
                    <XIcon class="tw-w-[35px] tw-h-[35px] tw-cursor-pointer" @click="closeModal" />
                </div>
                <p class="tw-my-5">
                    You are about to <b>permanently delete your account</b> and erase all of your personal data.
                    <br /><br />
                    When you delete your account, your subscription will be canceled, all of your account history will be erased, and you will lose access to any products you have purchased.
                    <br /><br />
                    You will not be able to log in again or recover your account.
                    <br /><br />
                    <b>THIS ACTION CANNOT BE UNDONE.</b>
                    <br /><br />
                    Are you sure you want to continue?
                </p>
                <div class="tw-flex tw-justify-end">
                    <button class="tw-btn-primary tw-text-[#00101D] tw-px-10 dark:tw-text-white tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D] tw-mr-[10px]" @click="closeModal">Cancel</button>
                    <button class="tw-btn-primary tw-bg-[#DC2626] tw-px-10" @click="goToNextStep">Delete Account</button>
                </div>
            </template>
            <template v-else>
                <div class="tw-flex tw-justify-between tw-items-center">
                    <h1 class="tw-text-white tw-font-extrabold tw-text-2xl">Verify Account Deletion</h1>
                    <XIcon class="tw-w-[35px] tw-h-[35px] tw-cursor-pointer" @click="closeModal" />
                </div>
                <p class="tw-my-5">
                    This will permanently delete your account and cannot be undone.
                    <br /><br />
                    To proceed, please type <b>DELETE</b> and confirm.
                </p>
                <input class="tw-w-full tw-rounded-full tw-text-black tw-mb-5" placeholder="DELETE" v-model="textInput" />
                <div v-if="showWarning && textInput !== 'DELETE'" class="tw-italic tw-text-[#EF4444] tw-mb-5">
                    Please type <b>DELETE</b> and confirm.
                </div>
                <div class="tw-flex tw-items-center tw-mb-[10px]">
                    <input class="tw-rounded-md tw-mr-[10px]" type="checkbox" v-model="agreement1" />
                    I understand that all my data will be lost if I delete my account
                </div>
                <div v-if="showWarning && !agreement1" class="tw-italic tw-text-[#EF4444] tw-mb-5">
                    Please confirm that you understand that deleting your account will result in the permanent loss of your account data.
                </div>
                <div class="tw-flex tw-items-center tw-mb-5">
                    <input class="tw-rounded-md tw-mr-[10px]" type="checkbox" v-model="agreement2" />
                    I acknowledge that deleting my account will NOT cancel any active subscriptions if my subscription was purchased through the Musora app
                </div>
                <div v-if="showWarning && !agreement2" class="tw-italic tw-text-[#EF4444] tw-mb-5">
                    Please acknowledge that deleting your account will NOT cancel your subscription if purchased through the Musora app.
                </div>
                <div class="tw-flex tw-justify-end">
                    <button class="tw-btn-primary tw-text-[#00101D] tw-px-10 dark:tw-text-white tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D] tw-mr-[10px]" @click="closeModal">Cancel</button>
                    <button class="tw-btn-primary tw-bg-[#DC2626] tw-px-10" @click="confirmDelete">Confirm & Delete Account</button>
                </div>
            </template>
        </div>
    </ModalRenderer>
</template>

<script setup>
    import { ref } from "vue";
    import axios from "axios";
    import ModalRenderer from "./ModalRenderer";
    import { XIcon } from "@heroicons/vue/solid";
    import { useUserStore } from '../../Stores/user';

    const userStore = useUserStore();

    //Emits
    const emit = defineEmits(['onCloseModal']);

    //Refs
    const step = ref('1');
    const textInput = ref('');
    const agreement1 = ref(false);
    const agreement2 = ref(false);
    const showWarning = ref(false);

    //Methods
    const closeModal = () => {
        step.value = '1';
        textInput.value = '';
        agreement1.value = false;
        agreement2.value = false;
        showWarning.value = false;
        emit('onCloseModal')
    }
    const goToNextStep = () => {
        step.value = '2';
    }
    const confirmDelete = () => {
        if (!agreement1.value || !agreement2.value || textInput.value !== 'DELETE') {
            showWarning.value = true;
            return;
        }
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': userStore.token
        }
        // Delete account
        axios({
            method: 'DELETE',
            url: `/user-management-system/user/delete/${userStore.userId}`,
            headers
        })
        .then(() => {
            window.location.replace('/')
        })
        .catch(() => {
            window.shownotification({
                icon: 'error',
                text: 'An error occurred while deleting your account. Please try again later.'
            });
        });
    }
</script>