<template>
    <PageHeaderCta v-bind="$attrs" :text="text" :faIconClass="faIconClass" showAllAlways iconPosition="right"
        @click="handleOpen" />
    <InfoModal
        v-if="modalOpen"
        :modalId="modalId"
        :classOverride="'tw-max-w-[654px]'"
        :selfContained="true"
        :showOverlay="true"
        title="Student Review Application"
        @onClose="handleClose"
    >
        <div class="tw-text-[#00101D] tw-flex tw-flex-col tw-rounded-[10px] tw-shadow tw-p-[30px] tw-relative tw-px-5 tw-pt-8 tw-bg-white">
            <div class="flex flex-column tw-w-full">
                <StudentReviewForm :url="iframeSrc" height="600" />
            </div>
        </div>
    </InfoModal>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import InfoModal from '@collections/Modal/InfoModal.vue';

const props = defineProps({
    text: String,
    faIconClass: String,
    iframeSrc: String,
});

const modalId = ref('');

const modalOpen = ref(false);

const handleOpen = () => {
    modalOpen.value = true;
};

const handleClose = () => {
    modalOpen.value = false;
};

onMounted(() => {
    modalId.value = `googleFormCta-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
});
</script>
