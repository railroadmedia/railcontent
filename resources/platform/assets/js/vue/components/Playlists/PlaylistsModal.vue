<script setup>
    import InfoModal from '../Modal/InfoModal.vue';

    const props = defineProps({
        modalProps: {
            type: Object,
            default: () => ({
                modalType: null,
            })
        }
    });

    const emit = defineEmits(['onClosePlaylistsModal']);

    const handleClose = () => {
        emit('onClosePlaylistsModal');
    };
</script>

<template>
    <InfoModal classOverride="tw-bg-[#081825]" key="create-playlist-modal-instance" modalId="create-playlist-modal" @onClose="handleClose" :selfContained="true">
        <div v-if="modalProps.modalType === 'create'">
            CREATE MODAL
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
    </InfoModal>
</template>
