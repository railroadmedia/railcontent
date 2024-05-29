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
                method="POST" 
                @submit.prevent="submitDisplayNameForm"
            >
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <InputLabel 
                        inputOverride="tw-w-full tw-h-[50px] tw-text-[#00101D]" 
                        inputType="text"
                        id="displayName" 
                        inputName="display_name" 
                        labelValue="Display Name"
                        placeholder="Enter Display Name" 
                        :initial-value="userDisplayName"
                        :inputErrors="[]" 
                        @onChange="handleDisplayName" 
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
                        class="tw-mx-1 tw-btn-primary tw-bg-transparent dark:hover:tw-bg-white hover:tw-bg-black dark:hover:tw-text-[#00101D] hover:tw-text-white tw-text-[#00101D] dark:tw-text-white"
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
    import InputLabel from "../InputLabel/InputLabel.vue";
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../../stores/user';

    const userStore = useUserStore();
    const { userId, userDisplayName } = storeToRefs(userStore);

    //Refs
    const emit = defineEmits(['onCloseDisplayNameModal']);

    const formData = ref({
        display_name: userDisplayName.value || '' // Initialize with current displayName or empty string
    });


    //Methods
    const handleClose = () => {
        emit('onCloseDisplayNameModal');
    };

    const handleDisplayName = (value) => {
        formData.value.display_name = value;
    };
        
    const submitDisplayNameForm = async () => {
        try {
            await userStore.updateDisplayName(userId.value, formData.value.display_name);
        } catch (error) {
            console.error("Failed to update the display name:", error.message);
        }
        handleClose(); // Close modal
    };
</script>