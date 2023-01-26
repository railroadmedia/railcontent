<script setup>
import InfoModal from '../Modal/InfoModal.vue';
import CreatePlaylist from './CreatePlaylist.vue';

const props = defineProps({
    modalProps: {
        type: Object,
        default: () => ({
            modalType: null,
            imgSrc: 'asdasdsad',
        })
    },
    brand: {
        type: String,
        default: 'drumeo'
    }
});

const emit = defineEmits(['onClosePlaylistsModal']);

</script>

<template>
    <InfoModal classOverride="tw-bg-[#081825] tw-max-w-[654px] tw-border-[1px] tw-border-[#445F74]" key="create-playlist-modal-instance" modalId="create-playlist-modal"
        @onClose="handleClose" :selfContained="true">
        <div class="tw-px-[64px] tw-pt-[12px]">
            <CreatePlaylist mode="create" @onCancel="() => emit('onClosePlaylistsModal')" :modalProps="modalProps" v-if="modalProps.modalType === 'create'"  />
            <CreatePlaylist mode="edit" @onCancel="() => emit('onClosePlaylistsModal')" :modalProps="modalProps" v-if="modalProps.modalType === 'edit'"  />
            <div v-if="modalProps.modalType === 'remove'">
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
