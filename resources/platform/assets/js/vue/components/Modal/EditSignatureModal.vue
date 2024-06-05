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
                @submit.prevent="submitUserForm"
            >
                <div class="tw-flex tw-flex-col tw-mb-[20px]">
                    <TextEditor 
                        fieldKey="signature-editor"
                        ref="textEditor" 
                        v-model="formData.signature"
                        :is-student-comment="false"
                        toolbar="bold italic underline | link"
                        :disabled="formProcessing"
                        :height="150" 
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] ">
                    <mu-button
                        class="tw-mx-1 dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        type="submit"
                        :processing="formProcessing"
                        @click="handleClick"
                    >
                        Save
                    </mu-button>
                    <mu-button
                        @click="handleClose"
                        style-type="secondary"
                        class="tw-mx-1 tw-btn-secondary tw-text-[#00101D] dark:tw-text-[#9EC0DC]"
                    >
                        Cancel
                    </mu-button>
                </div>
            </form>
        </div>
    </InfoModal>
</template>
<script setup>
    import { ref } from 'vue';
    import InfoModal from '../Modal/InfoModal.vue';
    import TextEditor from '../../vuesora/components/TextEditor/TextEditor.vue';
    import MuButton from '../Button/MuButton.vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '../../../stores/user';

    const userStore = useUserStore();
    const { token, userId, userSignature } = storeToRefs(userStore);

    //Emits
    const emit = defineEmits(['onCloseSignatureModal']);

    //Refs
    const formProcessing = ref(false);
    const formData = ref({
        signature: userSignature.value || '', 
    });

    //Methods
    const handleClose = () => {
        emit('onCloseSignatureModal');
    };
        
    const submitUserForm = async () => {
        formProcessing.value = true;
        try {
            await userStore.updateSignature(token.value, userId.value, formData.value);
        } catch (error) {
            console.error("Failed to update the display name:", error.message);
        }
        handleClose(); // Close modal
    };
</script>