<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="SignatureModal" 
        :selfContained="true" 
        @onClose="handleClose"
    >
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <h2 class="tw-text-2xl tw-text-[#00101D] dark:tw-text-white">Edit Forum Signature</h2>
            <small class="tw-text-sm tw-italic tw-text-gray-400 dark:tw-text-[#9EC0DC] tw-block tw-mb-6">Limit of 200 Characters</small>

            <form 
                accept-charset="UTF-8" 
                method="POST" 
                @submit.prevent="submitSignatureForm"
            >
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <!-- <MuInput 
                        type="text"
                        id="Signature" 
                        name="signature" 
                        label="Display Name"
                        placeholder="Enter Display Name" 
                        v-model="formData.signature"
                        :inputErrors="[]" 
                    /> -->
                    <TextEditor 
                        fieldKey="signature-editor"
                        ref="textEditor" 
                        v-model="formData.signature"
                        :is-student-comment="false"
                        toolbar="bold italic underline | link"
                        :height="150" 
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] ">
                    <button
                        type="submit"
                        class="tw-mx-1 tw-btn-primary dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
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
    import TextEditor from '../../vuesora/components/TextEditor/TextEditor.vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../../stores/user';

    const userStore = useUserStore();
    const { userId, userSignature } = storeToRefs(userStore);

    //Refs
    const emit = defineEmits(['onCloseSignatureModal']);

    const formData = ref({
        signature: userSignature.value || '', // Initialize with current Signature or empty string
    });

    //Methods
    const handleClose = () => {
        emit('onCloseSignatureModal');
    };
        
    const submitSignatureForm = async () => {
        try {
            await userStore.updateSignature(userId.value, formData.value.signature);
        } catch (error) {
            console.error("Failed to update the display name:", error.message);
        }
        handleClose(); // Close modal
    };
</script>