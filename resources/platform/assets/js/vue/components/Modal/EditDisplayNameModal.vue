<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="displayNameModal" 
        :selfContained="true" 
        @onClose="handleClose"
    >
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <h2 class="tw-text-2xl tw-mb-4 tw-text-[#00101D] dark:tw-text-white">Edit Display Name</h2>
            <form 
                accept-charset="UTF-8" 
                @submit.prevent="submitUserForm"
            >
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <MuInput 
                        type="text"
                        id="displayName" 
                        name="display_name" 
                        label="Display Name"
                        :disabled="formProcessing"
                        required
                        title="Display Name cannot be empty"
                        :error="!formData.display_name.length"
                        placeholder="Enter Display Name" 
                        v-model="formData.display_name"
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] tw-flex-wrap sm:tw-flex-nowrap tw-gap-2 sm:tw-gap-0">
                    <MuButton
                        class="tw-w-full sm:tw-w-auto sm:tw-mx-1 dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        type="submit"
                        :disabled="!formData.display_name.length"
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
    import MuInput from "../../components/FormInputs/MuInput.vue"
    import MuButton from '../Button/MuButton.vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../../stores/user';

    const userStore = useUserStore();
    const { token, userId, userDisplayName } = storeToRefs(userStore);

    //Refs
    const emit = defineEmits(['onCloseDisplayNameModal']);

    const formProcessing = ref(false);
    const formData = ref({
        display_name: userDisplayName.value || '' // Initialize with current displayName or empty string
    });

    //Methods
    const handleClose = () => {
        emit('onCloseDisplayNameModal');
    };
        
    const submitUserForm = async () => {
        formProcessing.value = true;
        try {
            await userStore.updateProfile(formData.value);
        } catch (error) {
            console.error("Failed to update the display name:", error.message);
        }
        handleClose(); // Close modal
    };
</script>