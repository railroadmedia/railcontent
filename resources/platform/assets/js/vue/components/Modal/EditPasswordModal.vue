<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="displayNameModal" 
        :selfContained="true" 
        @onClose="handleClose"
    >
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <h2 class="tw-text-2xl tw-mb-4 tw-text-[#00101D] dark:tw-text-white">Edit Login Password</h2>
            <form 
                accept-charset="UTF-8" 
                method="POST" 
                @submit.prevent="submitUserForm"
            >
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <MuInput 
                        type="password"
                        id="currentPassword" 
                        name="current_password" 
                        label="Current Password"
                        :disabled="formProcessing"
                        required
                        placeholder="Enter Current Password" 
                        v-model="formData.current_password"
                    />
                </div>
                <div class="tw-flex tw-flex-col tw-mb-4">
                    <MuInput 
                        type="password"
                        id="loginPassword" 
                        name="new_password" 
                        label="New Password"
                        :disabled="formProcessing"
                        required
                        placeholder="Enter New Password" 
                        v-model="formData.new_password"
                        pattern="^.{8,}$"
                        title="Password must be 8 characters"
                    />
                </div>
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <MuInput 
                        type="password"
                        id="loginPasswordConfirm" 
                        name="new_password_confirmation" 
                        label="Confirm Password"
                        :disabled="formProcessing"
                        required
                        placeholder="Confirm Password" 
                        v-model="formData.new_password_confirmation"
                        title="Passwords must match"
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] tw-flex-wrap sm:tw-flex-nowrap tw-gap-2 sm:tw-gap-0">
                    <MuButton
                        class="tw-w-full sm:tw-w-auto sm:tw-mx-1 dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        type="submit"
                        :processing="formProcessing"
                        processing-text="Saving..."
                    >
                        Save
                    </MuButton>
                </div>
            </form>
        </div>
    </InfoModal>
</template>
<script setup>
    import { ref } from 'vue';
    import InfoModal from '../Modal/InfoModal.vue';
    import MuInput from '../FormInputs/MuInput.vue';
    import MuButton from '../Button/MuButton.vue';
    import { useUserStore } from '../../../stores/user';

    const userStore = useUserStore();

    //Emits
    const emit = defineEmits(['onCloseModal']);

    //Refs
    const formProcessing = ref(false);
    const formData = ref({
        current_password: '',
        new_password: '',
        new_password_confirmation: '',
    });

    //Methods
    const handleClose = () => {
        emit('onCloseModal');
    };
    
    const submitUserForm = async () => {
        formProcessing.value = true;
        try {
            await userStore.updatePassword(formData.value);
            handleClose();
        } catch (error) {
            console.error("Failed to update your password:", error.message);
            formProcessing.value = false;
        }
    };
</script>