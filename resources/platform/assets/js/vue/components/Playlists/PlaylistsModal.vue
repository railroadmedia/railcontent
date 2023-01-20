<script setup>
import { XCircleIcon } from '@heroicons/vue/outline'
import InfoModal from '../Modal/InfoModal.vue';

const props = defineProps({
    modalProps: {
        type: Object,
        default: () => ({
            modalType: null,
            imgSrc: 'asdasdsad',
        })
    }
});

const emit = defineEmits(['onClosePlaylistsModal']);

const handleClose = () => {
    emit('onClosePlaylistsModal');
};

const { modalType, imgSrc } = props.modalProps;
</script>

<template>
    <InfoModal classOverride="tw-bg-[#081825] tw-max-w-[654px]" key="create-playlist-modal-instance" modalId="create-playlist-modal"
        @onClose="handleClose" :selfContained="true">
        <div class="tw-px-[64px] tw-pt-[12px]">
            <div class="tw-flex tw-flex-col tw-justify-center tw-text-white" v-if="modalType === 'create'">
                <h2 class="tw-font-bold tw-font-open-sans tw-text-[24px] tw-text-center">
                    Create Playlist
                </h2>
                <div class="tw-flex tw-pt-[24px]">
                    <div class="tw-flex tw-flex-col tw-pr-[42px]">
                        <img class="tw-w-[158px] tw-h-[158px] tw-rounded-[9px]" :src="`${imgSrc ? imgSrc : 'https://placehold.jp/158x158.png'}`" />
                        <div class="tw-flex tw-pt-[12px] tw-justify-center tw-items-center">
                            <button class="tw-underline tw-text-[#7E9AB1] tw-italic tw-text-[13px]">
                                <span v-if="!(imgSrc && imgSrc.length)">Upload Playlist Image</span>
                                <span v-if="(imgSrc && imgSrc.length)">Change Image</span>
                            </button>
                            <button tw- v-if="(imgSrc && imgSrc.length)" class="tw-ml-[3px]"><XCircleIcon class="tw-text-[#7E9AB1] tw-w-[14px] tw-h-[14px]" /></button>
                        </div>
                    </div>
                    <div class="tw-flex tw-flex-col">
                        
                    </div>
                </div>
            </div>
            <div v-if="modalProps.modalType === 'edit'">
                EDIT MODAL
            </div>
            <div v-if="modalProps.modalType === 'edit'">
                REMOVE MODAL
            </div>
            <div v-if="modalProps.modalType === 'startEnd'">
                START END MODAL
            </div>
            <div v-if="modalProps.modalType === 'addItem'">
                ADD ITEM MODAL
            </div>
            <div v-if="modalProps.modalType === 'alreadyAddedItem'">
                ALREADY ADDED MODAL
            </div>
        </div>
    </InfoModal>
</template>
