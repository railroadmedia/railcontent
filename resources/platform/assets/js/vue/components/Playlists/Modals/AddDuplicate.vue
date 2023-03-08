<script setup>
import InfoModal from '../../Modal/InfoModal.vue';

//Emits
const emit = defineEmits(['onCloseModal', 'onConfirm']);

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
    <InfoModal :classOverride="`tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[365px]`"
        key="create-playlist-modal-instance" modalId="create-playlist-modal" @onClose="() => emit('onClosePlaylistsModal')"
        :selfContained="true">
        <div class="tw-h-full tw-w-full tw-flex tw-flex-col tw-items-center tw-justify-center">
            <h2 class="tw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center tw-mb-4">
                Already added
            </h2>

            <p class="dark:tw-text-white tw-text-center">
                Lesson with the title <span class="tw-bg-[#9EC0DC]">{{ title }}</span> already exists in this playlist.
                <br />
                Add anyway?
            </p>

            <div class="tw-pt-8 tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
                <!-- Delete Lesson -->
                <button :class="`tw-mb-2 tw-btn-primary tw-btn-small tw-text-base tw-bg-${brand} tw-px-[30px] tw-w-[218px]`"
                    @click.prevent="() => emit('onConfirm')">
                    CONFIRM
                </button>
                <!-- Close Modal -->
                <button @click="() => emit('onCloseModal')"
                    class="tw-btn-primary tw-btn-small tw-text-base dark:tw-text-white tw-text-[#0D0D0D] hover:tw-bg-slate-200/50 dark:hover:tw-bg-white/10 tw-w-[218px]">
                    CANCEL
                </button>
            </div>
        </div>
    </InfoModal>
</template>
