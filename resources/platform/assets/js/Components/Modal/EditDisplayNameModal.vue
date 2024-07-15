<template>
    <InfoModal
        classOverride="tw-max-w-[654px]"
        modalId="displayNameModal"
        title="Edit Display Name"
        :selfContained="true"
        @onClose="handleClose"
    >
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
    import InfoModal from '../Modal/InfoModal.vue';
    import MuInput from "../../Components/FormInputs/MuInput.vue"
    import MuButton from '../Button/MuButton.vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../Stores/user';

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
