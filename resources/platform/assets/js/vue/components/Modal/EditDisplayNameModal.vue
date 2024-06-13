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
                        placeholder="Enter Display Name" 
                        v-model="formData.display_name"
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] tw-flex-wrap sm:tw-flex-nowrap tw-gap-2 sm:tw-gap-0">
                    <MuButton
                        class="tw-w-full sm:tw-w-auto sm:tw-mx-1 dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        type="submit"
                        :processing="formProcessing"
                        processing-text="Saving..."
                        @click="handleClick"
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
    import MuInput from "../../components/FormInputs/MuInput.vue"
    import MuButton from '../Button/MuButton.vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../../stores/user';

    const userStore = useUserStore();
    const { userDisplayName } = storeToRefs(userStore);

    //Emits
    const emit = defineEmits(['onCloseDisplayNameModal']);

    //Refs
    const formProcessing = ref(false);
    const formData = ref({
        display_name: userDisplayName.value || ''
    });

    //Methods
    const handleClose = () => {
        emit('onCloseDisplayNameModal');
    };
        
    const submitUserForm = async () => {
        formProcessing.value = true;
        try {
            await userStore.updateProfile(formData.value);
            handleClose(); 
        } catch (error) {
            console.error("Failed to update the display name:", error.message);
            formProcessing.value = false;
        }
    };
</script>