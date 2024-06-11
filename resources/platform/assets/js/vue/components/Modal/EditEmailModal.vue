<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="loginModal" 
        :selfContained="true" 
        @onClose="handleClose"
    >
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <h2 class="tw-text-2xl tw-mb-4 tw-text-[#00101D] dark:tw-text-white">Edit Login Email</h2>
            <form 
                accept-charset="UTF-8" 
                method="POST" 
                @submit.prevent="submitUserForm"
            >
                <div class="tw-flex tw-flex-col tw-mb-4">
                    <MuInput 
                        type="email"
                        id="loginEmail" 
                        name="email" 
                        label="Login Email"
                        :disabled="formProcessing"
                        required
                        title="Email cannot be empty"
                        placeholder="Enter Email" 
                        v-model="formData.email"
                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                        customErrorMessage="Please enter a valid email address"
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] ">
                    <MuButton
                        class="tw-w-full sm:tw-w-auto sm:tw-mx-1 dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        type="submit"
                        :disabled="!formData.email.length"
                        :processing="formProcessing"
                        @click="handleClick"
                    >
                        Save
                    </MuButton>
                    <MuButton
                        @click="handleClose"
                        style-type="secondary"
                        class="tw-w-full sm:tw-w-auto sm:tw-mx-1 tw-btn-secondary tw-text-[#00101D] dark:tw-text-[#9EC0DC]"
                    >
                        Cancel
                    </MuButton>
                </div>
            </form>
        </div>
    </InfoModal>
</template>
<script setup>
    import { ref } from 'vue';
    import InfoModal from '../Modal/InfoModal.vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../../stores/user';
    import MuButton from '../Button/MuButton.vue';
    import MuInput from '../FormInputs/MuInput.vue';

    const userStore = useUserStore();
    const { userEmail } = storeToRefs(userStore);

    const emit = defineEmits(['onCloseModal']);

    //Refs
    const formProcessing = ref(false);
    const formData = ref({
        email: userEmail.value || ''
    });

    //Methods
    const handleClose = () => {
        emit('onCloseModal');
    };
    
    const submitUserForm = async () => {
        formProcessing.value = true;
        try {
            await userStore.updateEmail(formData.value);
        } catch (error) {
            console.error("Failed to update your email:", error.message);
        }
        handleClose(); // Close modal
    };
</script>