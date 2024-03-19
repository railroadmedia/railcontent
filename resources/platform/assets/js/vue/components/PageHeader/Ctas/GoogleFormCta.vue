<template>
    <PageHeaderCta :text="text" :faIconClass="faIconClass" :data-open-modal="modalId" showAllAlways iconPosition="right" />
    <div :id="modalId" class="modal">
        <div class="tw-text-[#00101D] tw-flex tw-flex-col tw-rounded-[10px] tw-shadow tw-p-[30px] tw-relative"
            style="background: white !important;">
            <div class="tw-flex tw-flex-row tw-mb-[30px]">
                <h1 class="subheading">Student Review Application</h1>
            </div>
            <div class="flex flex-column tw-w-full">
                <StudentReviewForm :url="iframeSrc" height="600" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';

const props = defineProps({
    text: String,
    faIconClass: String,
    iframeSrc: String,
});

const modalId = ref('');

onMounted(() => {
    modalId.value = `googleFormCta-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
});
</script>