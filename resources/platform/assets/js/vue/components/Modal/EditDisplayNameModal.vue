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
                        placeholder="Enter Display Name" 
                        v-model="formData.display_name"
                        :inputErrors="[]" 
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] ">
                    <button
                        :disabled="!formData.display_name.length" 
                        type="submit"
                        class="tw-mx-1 tw-btn-primary dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        :class="!formData.display_name.length ? 'tw-opacity-50' : ''"
                    >
                        Save
                    </button>
                    <button
                        @click="handleClose"
                        class="tw-mx-1 tw-btn-secondary tw-text-[#00101D] dark:tw-text-[#9EC0DC]"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </InfoModal>
</template>
<script setup>
    import { ref } from 'vue';
    import InfoModal from '../Modal/InfoModal.vue';
    import MuInput from "../../components/FormInputs/MuInput.vue"
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../../stores/user';

    const userStore = useUserStore();
    const { token, userId, userDisplayName } = storeToRefs(userStore);

    //Refs
    const emit = defineEmits(['onCloseDisplayNameModal']);

    const formData = ref({
        display_name: userDisplayName.value || '' // Initialize with current displayName or empty string
    });

    //Methods
    const handleClose = () => {
        emit('onCloseDisplayNameModal');
    };
        
    const submitUserForm = async () => {
        try {
            await userStore.updateProfile(token.value, userId.value, formData.value);
        } catch (error) {
            console.error("Failed to update the display name:", error.message);
        }
        handleClose(); // Close modal
    };
</script>