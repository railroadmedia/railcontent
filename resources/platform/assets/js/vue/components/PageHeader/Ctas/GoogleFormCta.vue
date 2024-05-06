<template>
    <PageHeaderCta v-bind="$attrs" :text="text" :faIconClass="faIconClass" showAllAlways iconPosition="right"
        @click="handleOpen" />
    <InfoModal v-if="modalOpen" :modalId="modalId"
        :classOverride="'tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]'"
        :selfContained="true" :showOverlay="true" @onClose="handleClose">
        <div class="tw-text-[#00101D] tw-flex tw-flex-col tw-rounded-[10px] tw-shadow tw-p-[30px] tw-relative tw-px-5 tw-pt-8"
            style="background: white !important;">
            <div class="tw-flex tw-flex-row tw-mb-[30px]">
                <h1 class="subheading">Student Review Application</h1>
            </div>
            <div class="flex flex-column tw-w-full">
                <StudentReviewForm :url="iframeSrc" height="600" />
            </div>
        </div>
    </InfoModal>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import InfoModal from '../../Modal/InfoModal.vue';

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