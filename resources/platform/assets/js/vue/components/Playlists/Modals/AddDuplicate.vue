<script setup>
import InfoModal from '../../Modal/InfoModal.vue';

//Emits
const emit = defineEmits(['oClose', 'onConfirm']);

//-----------Props-----------//
const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    title: {
        type: String,
        default: 'LESSON_TITLE'
    },
});
</script>

<template>
    <InfoModal :classOverride="`tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[468px] tw-px-[30px]`"
        key="duplicate-playlist-modal-instance" modalId="duplicate-playlist-modal" @onClose="() => emit('onClose')"
        :selfContained="false" :showOverlay="true">
        <div class="tw-h-full tw-w-full tw-flex tw-flex-col tw-items-center tw-justify-center">
            <h2 class="tw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center tw-mb-4">
                Already Added
            </h2>

            <p class="dark:tw-text-white tw-text-center">
                <span class="tw-font-bold dark:tw-text-[#9EC0DC] tw-capitalize">{{ title }}</span> already exists in this playlist.
                <br />
                Add anyway?
            </p>

            <div class="tw-pt-8 tw-flex tw-flex-col sm:tw-flex-row tw-items-center tw-justify-center tw-w-full">
                <!-- Delete Lesson -->
                <button :class="`tw-mb-2 sm:tw-mb-0 sm:tw-order-1 tw-btn-primary tw-px-[30px] tw-w-[218px] tw-text-white dark:tw-text-[#00101D] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57]`"
                    @click.prevent="() => emit('onConfirm')">
                    CONFIRM
                </button>
                <!-- Close Modal -->
                <button @click="() => emit('onClose')"
                    class="tw-btn-secondary tw-w-[218px] sm:tw-mr-2 tw-text-[#00101D] dark:tw-text-white tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D]">
                    CANCEL
                </button>
            </div>
        </div>
    </InfoModal>
</template>
