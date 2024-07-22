<template>
    <InfoModal title="Student Review Application" :self-contained="true" modal-id="student-review-form-modal" class-override="tw-max-w-[800px]" @onClose="$emit('onCloseStudentReviewModal')">
        <div class="flex flex-column tw-w-full tw-bg-white tw-rounded-md">
            <student-review-form
                v-if="brand === 'drumeo'"
                url="https://docs.google.com/forms/d/e/1FAIpQLSdRzf0Wg4meObJi0ovKlUDgbBDYDpJP7MCguIDmPFDybchViQ/viewform?embedded=true"
                height="600"
            >
            </student-review-form>

            <student-review-form
                v-if="brand === 'pianote'"
                url="https://docs.google.com/forms/d/e/1FAIpQLSe4Soy7CDxk9Aw9_kuJvK9f3FyojMfLkuqezIsvKNUFQPD51w/viewform?embedded=true"
                height="600"
            >
            </student-review-form>

            <student-review-form
                v-if="brand === 'guitareo'"
                url="https://docs.google.com/forms/d/e/1FAIpQLSfqS5HTrmln2sd7QaNt9Er31fY2becXt4n6isN57HbGwVPHFg/viewform?embedded=true"
                height="600"
            >
            </student-review-form>

            <student-review-form
                v-if="brand === 'singeo'"
                url="https://docs.google.com/forms/d/e/1FAIpQLSeWyMtqVuQjMdA7rrZMK2jCkAIaPLeycTr0zXUE6LEaD6OmyQ/viewform?embedded=true"
                height="600"
            >
            </student-review-form>
        </div>
    </InfoModal>
</template>

<script setup>
import InfoModal from '@collections/Modal/InfoModal';

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    }
});
</script>
