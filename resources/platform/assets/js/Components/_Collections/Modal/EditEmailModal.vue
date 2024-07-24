<template>
    <InfoModal
        classOverride="tw-max-w-[654px]"
        modalId="loginModal"
        title="Edit Login Email"
        :selfContained="true"
        @onClose="handleClose"
    >
        <form
            accept-charset="UTF-8"
            method="POST"
            @submit.prevent="submitUserForm"
        >
            <div class="tw-grid tw-grid-cols-1 tw-gap-3 tw-mb-4">
                <MuInput
                    type="email"
                    id="loginEmail"
                    name="email"
                    label="Login Email"
                    :disabled="formProcessing"
                    required
                    placeholder="Enter Email"
                    v-model="formData.email"
                    title="Please enter a valid email address"
                    pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                />
                <MuInput
                    type="password"
                    id="userPassword"
                    name="user_password"
                    label="Confirm Password"
                    :disabled="formProcessing"
                    required
                    placeholder="Enter Current Password"
                    v-model="formData.user_password"
                    pattern="^.{8,}$"
                    title="Password must be 8 characters"
                />
            </div>
            <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] tw-flex-wrap sm:tw-flex-nowrap tw-gap-2 sm:tw-gap-0">
                <MuButton
                    class="tw-w-full sm:tw-w-auto sm:tw-mx-1"
                    type="submit"
                    :processing="formProcessing"
                    processing-text="Saving..."
                >
                    Save
                </MuButton>
            </div>
        </form>
    </InfoModal>
</template>
<script setup>
    import { ref } from 'vue';
    import InfoModal from '@collections/Modal/InfoModal.vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '@stores/user';
    import MuButton from '@units/Button/MuButton.vue';
    import MuInput from '@units/FormInputs/MuInput.vue';

    const userStore = useUserStore();
    const { userEmail } = storeToRefs(userStore);

    const emit = defineEmits(['onCloseModal', 'onSuccess']);

    //Refs
    const formProcessing = ref(false);
    const formData = ref({
        email: userEmail.value || '',
        user_password: '',
    });

    //Methods
    const handleClose = () => {
        emit('onCloseModal');
    };

    const submitUserForm = async () => {
        formProcessing.value = true;
        try {
            await userStore.updateEmail(formData.value);
            emit('onSuccess')
            handleClose();
        } catch (error) {
            console.error("Failed to update your email:", error.message);
            formProcessing.value = false;
        }
    };
</script>
