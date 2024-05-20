<template>
    <div>
        <PageHeaderCta 
            v-bind="$attrs" 
            text="Ask A Question" 
            showAllAlways
            @click="handleOpen" 
        />
        <InfoModal v-if="modalOpen"
            :classOverride="'tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px] tw-p-6'"
            modalId="surveyModall" :selfContained="true" @onClose="handleClose"
        >
            <h1 class="tw-text-2xl tw-mb-3 tw-text-[#00101D] dark:tw-text-white">Ask a Question</h1>
            <p class="tw-text-sm tw-mb-4 tw-text-[#00101D] dark:tw-text-white">
                Please submit your question(s) using the form below. Once submitted your question(s) will be answered in the next scheduled Q&A lesson.
            </p>
            <EmailForm
                :recipient="emailRecipient"
                :email-logo="emailLogo"
                :email-subject="`Question Asked by: ${userStore.userDisplayName} ${userStore.userEmail}`"
                :brand="brand"
                input-label="Ask your question here..."
                email-type="layouts/inline/alert"
                email-endpoint="/mailora/secure/send"
                :email-alert="`Question Asked by: ${userStore.userDisplayName} ${userStore.userEmail}`"
                :theme-color="brand"
                success-message="Question successfully sent!"
                :lesson-page="false"
                @closeForm="handleClose"
            />
        </InfoModal>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../../stores/user';
import InfoModal from '../../Modal/InfoModal.vue';
import EmailForm from '../../../vuesora/components/EmailForm/EmailForm.vue'

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    text: String,
    emailLogo: String,
    emailRecipient: String,
});

const modalOpen = ref(false);

const handleOpen = () => {
    modalOpen.value = true;
};

const handleClose = () => {
    modalOpen.value = false;
};
</script>